<?php
include_once './actions/config.php';
include_once './layout.php';


if(!isset($_SESSION['login'])){
  $_SESSION['error']='you need to login to veiw the dashboard!';
  header("Location:./login.php");
}

if(isset($_POST['bid'])){
  $bid=$_POST['bid'];
}else if(isset($_GET['bid'])){
  $bid=$_GET['bid'];
}else{
  header("Location:./index.php");
}

if(isset($_POST['date'])){
  $date=$_POST['date'];
}else if(isset($_GET['date'])){
  $date=$_GET['date'];
}else{
  header("Location:./index.php");
}



?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center p-3" style="background-color:rgba(255,0,0,0.1) ;">

    <p>SLTC BRS - BOOK A BICYCLE</p>
    <p class="m-0"> Dear Customer,</p> 
    <p class="m-0">You will receive an e-mail with the booking number, once your booking is approved. </p>
 <p class=" m-0">Please produce this number when requested!! Thank you!!!</p>

    </div>
  </div>
</div>

<style>
   @media (max-width:780px){
      .username {
        width: 50%!important;
      }
      .menu{
        width: 50%!important;
      }
   }
</style>

<div class="container-fluid d-flex align-items-center py-3 px-5" style="background-color:rgba(123, 156, 6,1) ;">
  <div class="username w-25">

    <i class="fa-solid fa-user " style="color:white ;transform: scale(1.4);"></i>
    <span class=" text-white ms-4"><?= $_SESSION['username']?></span>
  </div>
  <div class="menu d-flex align-items-center w-25 justify-content-between">
    <p class="m-0"><a href="" class=" text-white text-decoration-none"> USER HOME</a></p>
    <p class="m-0"><a href="./index.php" class=" text-white text-decoration-none"> BOOKINGS</a></p>
  </div>

</div>
<div class="container-fluid p-2">
  <div class="row">
    <?php

    if(isset($_SESSION['error'])){

      echo "<p class='alert msg alert-danger text-center'>{$_SESSION['error']}</p>";
      $_SESSION['error']=null;
    }else if(isset($_SESSION['msg'])){
      echo "<p class='alert msg alert-success text-center'>{$_SESSION['msg']}</p>";
      $_SESSION['msg']=null;
    }

    ?>
    <div class="col-12 col-lg-5">
      <p class="alert alert-dark text-center">Book a Bicycle</p>
      <form action="./actions/register.php" method="POST" class=" mx-5">
        <div class="mb-3">
          <label  class="form-label">Bicycle ID</label>
          <input type="email" name="bid" value="<?= $bid ?>" readonly class="form-control">
        </div>
        <div class="mb-3">
          <label  class="form-label">Required on</label>
          <input type="email" name="reqon" value="<?= $date ?>" readonly class="form-control" >
        </div>
        <div class="mb-3">
          <label  class="form-label">Required at</label>
          <input type="email" name="reqat" value="10:00 AM" readonly class="form-control">
        </div>
        <div class="mb-3">
          <label  class="form-label">Comment</label>
          <textarea class="form-control" name="comment"  rows="3"></textarea>
        </div>
        <div class="form-group mb-3 d-flex px-5 justify-content-between">
          <input type="submit" value="Book" name="book" class=" btn btn-success ">
          <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class=" btn btn-success">Back</a>
        </div>
      </form>
    </div>
    <div class="col-12 col-lg-7">
      <p class="alert alert-dark text-center m-0">You Bookings</p>
      <table class="table table-hover mt-2">
        <thead>
          <tr style="font-size:0.8rem ;">
            <th>BICYCLE ID</th>
            <th>REQUIRED ON</th>
            <th>REQUIRED AT</th>
            <th>HANDOVER ON</th>
            <th>HANDOVER AT</th>
            <th>Apporov</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            $books=getBookingsForUser($conn,$_SESSION['uid']);

           foreach ($books as $book) {?>
            <tr>
              <td><?= $book['bid']?></td>
              <td><?= $book['req_on']?></td>
              <td><?= $book['req_at']?></td>
              <td><?= $book['handover_on']?></td>
              <td><?= $book['handover_at']?></td>
              <td><button class="btn btn-sm <?= $book['approve']==0?'btn-danger':'btn-success' ?> w-100">
              <?= 
              $book['approve']==0?'No':'Yes'
              
              ?>
            </button></td>
            </tr>
            
            
           <?php }



            ?>
          </tr>
        </tbody>
      </table>
      <hr>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded",()=>{

        setInterval(() => {
            removeErrors()
        }, 2000);
        
    })
    function removeErrors(){
        let errors=document.querySelectorAll('.msg')
        errors.forEach(e=>{
            e.remove()
        })
    }
    </script>