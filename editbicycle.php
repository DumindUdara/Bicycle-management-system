<?php
session_start();
include './layout.php';

if(!isset($_SESSION['admin']) || !$_SESSION['admin']==1){
  header("Location:./login.php?msg=you need to login first");
}





?>

<div class="container">
  <div class="row mt-5">
    <div class="col-12 col-md-6 mx-auto">
      <?php

      if(isset($_SESSION['error'])){

        echo "<p class='alert msg alert-danger text-center'>{$_SESSION['error']}</p>";
        $_SESSION['error']=null;
      }else if(isset($_SESSION['msg'])){
        echo "<p class='alert msg alert-success text-center'>{$_SESSION['msg']}</p>";
        $_SESSION['msg']=null;
      }

      ?>
      <form action="./actions/register.php" method="POST">
        <div class="container">
          <div class="mb-3">
              <label  class="form-label">Bike Name</label>
              <input required type="text" class="form-control" name="bikename" placeholder="Bike Name">
          </div>
          <div class="mb-3">
              <label  class="form-label">Description</label>
              <textarea name="dis" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-3 d-flex justify-content-end">
            <input type="submit" value="Add Bicycle" class="btn btn-success" name="add">
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<?php  include './footer.php'; ?>