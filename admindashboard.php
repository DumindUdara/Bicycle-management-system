<?php
include_once './actions/config.php';
include './layout.php';

if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1){
  header("Location:../index.php");

}

?>

<style>

  i.bd-icon{
    transform: scale(2.5);
  }
  .item:hover{
    cursor: pointer;
    transition: 300ms linear;
    transform: scale(1.02);
  }
 
   @media (max-width:780px){
      .username {
        width: 50%!important;
      }
      .menu{
        width: 50%!important;
      }

      .items{
        width: 20%!important;
      }
   }

</style>

<div class="container mt-5">
  <div class="row">
    <div class="col-12">
      

      <div class="container d-flex flex-wrap gap-5 item-box">

        <div style="width:15% ; height: 100px; border-radius: 15px;" class=" bg-success d-flex align-items-center justify-content-around item items">
          <i class="fa-solid fa-house text-white bd-icon" ></i>
        </div>

        <div style="width: 15%; height: 100px; border-radius: 15px;" class="item bg-success d-flex align-items-center justify-content-around flex-column items">
          <a href="./index.php" class=" text-white text-decoration-none"><i class="fa-sharp fa-solid fa-bicycle text-white bd-icon"></i></a>
        </div>

        <div style="width: 15%; height: 100px; border-radius: 15px;" class="item bg-success d-flex align-items-center justify-content-around flex-column items">
          <a href="./edit.php" class=" text-white text-decoration-none">
            <i class="fa-sharp fa-solid fa-clipboard-list text-white bd-icon"></i></a>

          
          
        </div>

       

      </div>
    </div>
  </div>
</div>