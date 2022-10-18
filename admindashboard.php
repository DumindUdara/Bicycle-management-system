<?php
include_once './actions/config.php';
include './layout.php';

if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1){
  $_SESSION['error']='Not authorized!';
  header("Location:../index.php");

}

?>

<style>

  i.box-icon{
    transform: scale(3);
    color: white;
  }
  .icon-box{
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    justify-items: center;
    height: 95px;
    margin: 20px;
    padding: 5px;
  }

  .icon-box>p{
    font-weight: 500;
    color: white;
    margin: 0;
    text-align: center;
    margin-top: 10px;
    word-wrap: break-word;

  }
  .board-icon{
    border-radius: 25px;
    justify-content: space-around;
    align-items: center;

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
      

      <div class="container">
        <div class="row gap-4 mx-auto ">

          <div 
            class="col-5 col-md-3 col-lg-2 board-icon bg-success  justify-content-around align-items-center " 
            style="height: 120px;">

            <div class="icon-box" style="padding: 0;" >
              
                <i class="fa-solid fa-house box-icon"></i>
              
              
            </div>
          </div>

          <div 
            class="col-5 col-md-3 col-lg-2 board-icon bg-success  justify-content-around align-items-center " 
            style="height: 120px;">

            <div class="icon-box" >
              <a href="./editbicycle.php">
                <i class="fa-solid fa-person-biking box-icon"></i>
              </a>
              <p>
                Bicycle Setup
              </p>
            </div>
          </div>
          <div 
            class="col-5 col-md-3 col-lg-2 board-icon bg-success  justify-content-around align-items-center " 
            style="height: 120px;">

            <div class="icon-box" >
              <a href="./approv.php">
                <i class="fa-solid fa-bicycle box-icon"></i>
              </a>
              <p>
                Booking Approval
              </p>
            </div>
          </div>
          <div 
            class="col-5 col-md-3 col-lg-2 board-icon bg-success  justify-content-around align-items-center " 
            style="height: 120px;">

            <div class="icon-box" >
              <a href="./handover.php">
                <i class="fa-solid fa-bicycle box-icon"></i>
              </a>
              <p>
                Issue Management
              </p>
            </div>
          </div>
          <div 
            class="col-5 col-md-3 col-lg-2 board-icon bg-success  justify-content-around align-items-center " 
            style="height: 120px;">

            <div class="icon-box" >
              <a href="./edit.php">
                <i class="fa-sharp fa-solid fa-reply-all box-icon"></i>
              </a>
              <p>
                Resturn Management
              </p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>