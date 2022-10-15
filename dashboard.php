<?php  
session_start();
include './layout.php';

if(!isset($_SESSION['login'])){
  $_SESSION['error']='you need to login to veiw the dashboard!';
  header("Location:./login.php");
}

?>

<div class="container-fluid d-flex justify-content-around">
  <p class=" m-0 p-3">SLTC BRS - USER HOME</p>
</div>

<div class="container-fluid d-flex align-items-center py-3 pl-4" style="background-color:rgba(123, 156, 6,1) ;">
  <div class="username w-25">

    <i class="fa-solid fa-user " style="color:white ;transform: scale(1.4);"></i>
    <span class=" text-white ms-4"><?= $_SESSION['username']?></span>
  </div>
  <div class="menu d-flex align-items-center w-25 justify-content-between">
    <p class="m-0"><a href="" class=" text-white text-decoration-none"> USER HOME</a></p>
    <p class="m-0"><a href="./index.php" class=" text-white text-decoration-none"> BOOKINGS</a></p>
  </div>

</div>
<div class="container-fluid m-0" style="background-color:rgba(209, 209, 209,0.7) ;">
  <p class=" text-center p-3" style="font-size:15px ;">USER DASHBOARD <br>
    PLEASE USE BOOKINGS OPTION TO MAKE A BOOKING</p>

</div>

<style>

  i.bd-icon{
    transform: scale(2.5);
  }
  .item:hover{
    cursor: pointer;
    transition: 300ms linear;
    transform: scale(1.02);
  }
  .item-box{
    
  }

</style>

<div class="container d-flex flex-wrap gap-5 item-box">

  <div style="width:15% ; height: 100px; border-radius: 15px;" class=" bg-success d-flex align-items-center justify-content-around item">
    <i class="fa-solid fa-house text-white bd-icon" ></i>
  </div>
  <div style="width: 15%; height: 100px; border-radius: 15px;" class="item bg-success d-flex align-items-center justify-content-around flex-column">
    <a href="./index.php" class=" text-white text-decoration-none"><i class="fa-sharp fa-solid fa-bicycle text-white bd-icon"></i></a>
  </div>

</div>