<?php
include_once './config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
  header('Location:../index.php');
}

if(isset($_POST['register'])){
  $uid=htmlspecialchars($_POST['uid']);
  $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
  $password=$_POST['password'];
  $contact=$_POST['contact'];

    if($email!=FALSE){

      if(isUserExist($conn,$uid,$email)){
        $_SESSION['error']='username or email already registerd!';
        header("Location:../login.php");
      }else{
        $phash=password_hash($password,PASSWORD_DEFAULT);

        if(validateMovbile($contact)){

          $stm=$conn->prepare("INSERT INTO user(username,email,password,contact) VALUES(?,?,?,?)");
          $stm->bind_param('ssss',$uid,$email,$phash,$contact);
          if($stm){
            if($stm->execute()){
              $_SESSION['msg']='user created now you can login';
              header("Location:../login.php");
            }else{
              $_SESSION['error']=$conn->error;
              header("Location:../login.php");
            }
          }else{
            $_SESSION['error']=$conn->error;
            header("Location:../login.php");
          }
        }else{
          $_SESSION['error']='not a valid mobile number';
          header("Location:../login.php");
        }

      }
    }else{
      $_SESSION['error']='not a valid email address';
      header("Location:../login.php");
    }
  


}else if(isset($_POST['login'])){

  $username=htmlspecialchars($_POST['username']);
  $pass=$_POST['password'];
  
  $sql="SELECT * FROM user WHERE email='{$username}' OR username='{$username}'";
  $res=$conn->query($sql);
  if($res==TRUE){
    if($res->num_rows>0){
      $data=$res->fetch_assoc();
      $hash=$data['password'];
      if(password_verify($pass,$hash)){

        // echo isAdmin($conn,$username);


        if(isAdmin($conn,$username)){
          $_SESSION['login']=true;
          $_SESSION['uid']=$data['user_id'];
          $_SESSION['email']=$data['email'];
          $_SESSION['username']=$data['username'];
          $_SESSION['admin']=1;
          $_SESSION['msg']='Loged in successful';
          header("Location:../admindashboard.php");
        }else{
          $_SESSION['login']=true;
          $_SESSION['uid']=$data['user_id'];
          $_SESSION['email']=$data['email'];
          $_SESSION['username']=$data['username'];
          $_SESSION['msg']='Loged in successful';
          header("Location:../dashboard.php");
        }

        
      }else{
        $_SESSION['error']='Invalid Credentials';
        // echo 'pass dont match';
        header("Location:../login.php");
      }
    }else{
      // echo 'not found';
      $_SESSION['error']='Invalid Credentials';
      header("Location:../login.php");
    }
  }else{
    $_SESSION['error']=$conn->error;
    header("Location:../login.php");
  }
}else if(isset($_POST['book'])){
  $bid=$_POST['bid'];
  $reqon=$_POST['reqon'];
  $reqat=$_POST['reqat'];
  $uid=$_SESSION['uid'];

  $co=htmlspecialchars($_POST['comment']);


  $stm=$conn->prepare("INSERT INTO bookings(bid,user_id,comment,req_on,req_at) VALUES(?,?,?,?,?)");
  
  if($stm){
    $stm->bind_param('iisss',$bid,$uid,$co,$reqon,$reqat);

    if($stm->execute()){
      if(setAvailable($conn,0,$bid)){
        $_SESSION['msg']='you bookign is pending!';
        header("Location:../index.php");
      }else{
        $_SESSION['error']='your booking is not added! 232'.$conn->error;
        header("Location:../booking.php?bid={$bid}&date={$reqon}");
      }
    }else{
      $_SESSION['error']='your booking is not added!';
      header("Location:../booking.php?bid={$bid}&date={$reqon}");
    }
  }



}else if(isset($_POST['update'])){

  $hd=$_POST['hd'];
  $ht=$_POST['ht'];
  $bid=$_POST['bid'];
  $bicycle=$_POST['bicycleid'];


  $stm=$conn->prepare("UPDATE bookings SET handover_on=? , handover_at=? WHERE id=?");
  if($stm){
    $stm->bind_param('ssi',$hd,$ht,$bid);
    if($stm->execute()){
      
      if(setAvailable($conn,1,$bicycle)){
        $_SESSION['msg']='Updated! <br>Bicycle is Now available';
        header("Location:../handover.php");
      }else{
        $_SESSION['msg']='Updated! <br> Bicycle is not available';
        header("Location:../handover.php");
      }

      
    }else{
      $_SESSION['error']='update failed!';
      header("Location:../handover.php");
    }
  }else{
    $_SESSION['error']='update failed!';
    header("Location:../handover.php");
  }

  
}else if(isset($_POST['avalible'])){

  $bid=$_POST['bid'];
  $bicycle=$_POST['bicycle'];
  $state=$_POST['state'];
  $userid=$_POST['userid'];

  if($state==0){
    setAvailable($conn,1,$bicycle);
  }

  $email=getUsernameFromID($conn,$userid);


  
  $sql="UPDATE bookings SET approve=? WHERE id=?";
  $stm=$conn->prepare($sql);

  if($stm){
    $stm->bind_param('ii',$state,$bid);

    if($state==1){
      if(sendApproveMail($bid,$email[2])){
        if($stm->execute()){

          echo 1;

        }else{
          echo 0;
        }
      }else{
        echo 0;
      }
    }else{
      if($stm->execute()){

        echo 1;

      }else{
        echo 0;
      }
    }

    
  }else{
    echo 0;
  }

}else if(isset($_POST['delete'])){

  $bookid=$_POST['bid'];

  $sql="DELETE FROM bookings WHERE id={$bookid}";
  if($conn->query($sql)==TRUE){
    echo $bookid;
  }else{
    echo 0;
  }
}else if(isset($_POST['add'])){

  $bname=htmlspecialchars($_POST['bikename']);
  $dis=htmlspecialchars($_POST['dis']);

  $sql="INSERT INTO bicycles(name,discription) VALUES(?,?)";
  $stm=$conn->prepare($sql);

  if($stm){
    $stm->bind_param('ss',$bname,$dis);
    if($stm->execute()){
      $_SESSION['msg']='Bicycle has been added!';
      header("Location:../editbicycle.php");
    }else{
      $_SESSION['error']='Bicycle Added Failed!';
      header("Location:../editbicycle.php");
    }
  }else{
    $_SESSION['error']='Bicycle Added Failed!';
    header("Location:../editbicycle.php");
  }
}

function validateMovbile($number){

  if (strlen($number)==10){
    return true;

  }else{
    return false;
  }
}

function sendApproveMail($bid,$toEmail){

  try{
    $mail = new PHPMailer(true);

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->SMTPDebug=0;//Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.titan.email';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@forgear.lk';                     //SMTP username
    $mail->Password   = 'MtGiUdJsKg@2022';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
     $mail->SMTPSecure='ssl';
    $mail->Port       = 465; 


    $mail->setFrom('info@forgear.lk', 'Admin');   //Add a recipient
    $mail->addAddress($toEmail);               //Name is optional
    $mail->addReplyTo('info@forgear.lk', 'Information');

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Booking Comformation!';
    $mail->Body    = "Your booking has been approved!<br>Conform it by provinding this number to the office <br><h3>{$bid}</h3>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    return true;

  }catch(Exception $e){
    return false;
  }




}









?>