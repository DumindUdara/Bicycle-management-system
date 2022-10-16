<?php

$username='root';
$password='';
$dbname='brs_system';
$host='localhost';
session_start();

try{
  $conn=new mysqli($host,$username,$password,$dbname);

}catch(Exception $e){
  die();
}

if(isset($_GET['action']) && $_GET['action']=='logout'){
  $_SESSION['login']=null;
  $_SESSION['email']=null;
  $_SESSION['msg']='you have loged out successfuly';
  header("Location:../index.php");
}


function isUserExist($conn,$username,$email){

  $sql="SELECT user_id FROM user WHERE username='{$username}' OR email='{$email}'";

  $res=$conn->query($sql);
  if($res==TRUE){
    if($res->num_rows>0){

      // print_r($res->fetch_assoc());
      return true;
    }else{
      return false;
    }
  }else{
    return true;
  }

}

function setAvailable($conn,$state,$bid){

  $sql="UPDATE bicycles SET isavailable={$state} WHERE id={$bid}";

  if($conn->query($sql)==TRUE){
    return true;
  }else{
    return false;
  }
}

function getBookingsForUser($conn,$id){

  $sql="SELECT bid,req_on,req_at,handover_on,handover_at,approve FROM bookings WHERE user_id={$id}";

  $books=[];

  $res=$conn->query($sql);
  if($res==TRUE){
    if($res->num_rows>0){

      while($row=$res->fetch_assoc()){
        array_push($books,$row);
      }

      return $books;
    }else{
      return null;
    }

  }else{
    return null;
  }
}


function isAdmin($conn,$username){

  $sql="SELECT isadmin FROM user WHERE username='{$username}'";
  $res=$conn->query($sql);
  if($res==TRUE){
    if($res->num_rows>0){
      $data=$res->fetch_assoc();
      if($data['isadmin']==1){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }else{
    // return false;
    return $conn->error;
  }

}


function getUsernameFromID($conn,$id){

  $sql="SELECT username FROM user WHERE user_id={$id}";
  $res=$conn->query($sql);
  if($res==TRUE){
    if($res->num_rows>0){
      return $res->fetch_assoc()['username'];
    }else{
      return null;
    }
  }else{
    return null;
  }
}


function getAllBookings($conn){

  $sql="SELECT * FROM bookings ORDER BY id DESC";
  $res=$conn->query($sql);

  $bookings=[];

  if($res==TRUE){
    if($res->num_rows>0){
      while($row=$res->fetch_assoc()){
        array_push($bookings,$row);
      }

      return $bookings;

    }else{
      return null;
    }
  }else{
    return null;
  }
}