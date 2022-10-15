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
