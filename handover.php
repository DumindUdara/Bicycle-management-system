<?php

include_once './actions/config.php';

include './layout.php';


?>

<style>
  .container{
    overflow-x: scroll;
  }
</style>

<div class="container mt-3">
  <div class="row">
    <div class="col-12">
      <?php

      if(isset($_SESSION['error'])){

        echo "<p class='alert msg alert-danger text-center'>{$_SESSION['error']}</p>";
        $_SESSION['error']=null;
      }else if(isset($_SESSION['msg'])){
        echo "<p class='alert msg alert-success text-center'>{$_SESSION['msg']}</p>";
        $_SESSION['msg']=null;
      }

      ?>
      <p class="alert alert-dark text-center w-100">
        Handover Management
      </p>
      <table class="table table-hover mt-2">
        <thead>
          <tr style="font-size:0.8rem ;">
            <th>BICYCLE ID</th>
            <th>RENTED ON</th>
            <th class=" d-none d-md-flex">RENTED AT</th>
            <th>RENTED BY</th>
            <th>HANDOVER BY</th>
            <th>HANDOVER TIME</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            $books=getAllBookings($conn);
            
            if($books!=null){
              foreach ($books as $book) {

              if($book['handover_on']!=null){
                continue;
              }
              $userData=getUsernameFromID($conn,$book['user_id']);
              ?>
            
              <tr>
                <td><?= $book['bid']?></td>
                <td  ><?= $book['req_on']?></td>
                <td  ><?= $book['req_at']?></td>
                <td><?= strtoupper($userData[0]) ?></td>

                <form action="./actions/register.php" method="POST">
                  <td>
                    <input type="date" name="hd" id="" class=" form-control form-control-sm">
                  </td>
                  <td>
                    <input type="time" name="ht" id="" class=" form-control form-control-sm">
                  </td>
                  <td>
                    <input type="hidden" name="bid" value="<?= $book['id']?>">
                    <input type="hidden" name="bicycleid" value="<?= $book['bid']?>">
                    <button type="submit" name="update" class="btn btn-success w-100">
                      <i class="fa-sharp fa-solid fa-floppy-disk"></i>
                    </button>
                  </td>
                </form>
                
                

            <?php }



              
            }else{?>

              <td colspan="8">
                <p class="alert alert-warning text-center">No Bookings Found!</p>
              </td>

            <?php }?>

           
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>
