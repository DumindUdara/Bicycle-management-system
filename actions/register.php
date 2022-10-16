<?php
include_once './config.php';

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



}

function validateMovbile($number){

  if (strlen($number)==10){
    return true;

  }else{
    return false;
  }
}









?>