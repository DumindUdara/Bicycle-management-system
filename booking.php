<?php
session_start();
include_once './layout.php';

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
    <div class="col-12 col-lg-5">
      <p class="alert alert-dark text-center">Book a Bicycle</p>
      <form action="" class=" mx-5">
        <div class="mb-3">
          <label  class="form-label">Bicycle ID</label>
          <input type="email" readonly class="form-control">
        </div>
        <div class="mb-3">
          <label  class="form-label">Required on</label>
          <input type="email" readonly class="form-control" >
        </div>
        <div class="mb-3">
          <label  class="form-label">Required at</label>
          <input type="email" value="10:10 AM" readonly class="form-control">
        </div>
        <div class="mb-3">
          <label  class="form-label">Comment</label>
          <textarea class="form-control"  rows="3"></textarea>
        </div>
        <div class="form-group mb-3 d-flex px-5 justify-content-between">
          <input type="submit" value="Book" name="book" class=" btn btn-success ">
          <a href="<?= $_SERVER['HTTP_REFERE'] ?>" class=" btn btn-success">Back</a>
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
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>2323</td>
            <td>43434</td>
            <td>5454</td>
            <td>656565</td>
          </tr>
        </tbody>
      </table>
      <hr>
    </div>
  </div>
</div>