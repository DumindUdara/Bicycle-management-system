<?php
include_once './actions/config.php';
include './layout.php';

if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1){
  header("Location:../index.php");

}

?>


<style>
   @media (max-width:780px){
      .username {
        width: 50%!important;
      }
      .menu{
        width: 50%!important;
      }
   }

   button[type='submit']{
    background-color: transparent;
    border: none;
    outline: none;
   }

</style>


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
      <p class="alert alert-dark text-center">Search a Booking</p>
      <form action="<?= $_SERVER['PHP_SELF']?>"  class=" mx-5">
        <div class="mb-3">
          <label  class="form-label">Booking ID</label>
          <div class="row">
            <div class="col-8">
              <input type="number" value="<?= isset($_GET['bookid'])?$_GET['bookid']:''  ?>" required name="bookid" class="form-control">
            </div>
            <div class="col-4">
              <input type="submit" value="Search" name="search" class="btn btn-success w-100">
            </div>
            </div>
        </div>
      </form>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <?php

              if(isset($_GET['search'])){
                $bid=$_GET['bookid'];
                
                $sql="SELECT user_id,req_on,handover_on FROM bookings WHERE id={$bid}";

                $res=$conn->query($sql);

                if($res==TRUE){
                  if($res->num_rows>0){
                    $data=$res->fetch_assoc();

                    $rd=explode('-',$data['req_on'])[2];

                    $total=0;
                    $du=0;

                    if($data['handover_on']!=null){
                      $hd=explode('-',$data['handover_on'])[2];
                      
                      $du=$hd-$rd;
                      $total=((int)$du)*100;
                    }
                    ?>

                    <div class="mb-3">
                      <label  class="form-label">Required on</label>
                      <input type="text" name="reqon" value="<?= $data['req_on'] ?>" readonly class="form-control" >
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Handover On</label>
                      <input type="email" name="reqat" value="<?= $data['handover_on']==null?'Not Yet Handoverd':$data['handover_on'] ?>" readonly class="form-control">
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Booked By</label>
                      <input type="email" name="uname" value="<?= getUsernameFromID($conn,$data['user_id'])[0]?>" readonly class="form-control">
                    </div>
                    

                    <div class="mb-3">
                      <label  class="form-label">Duration Rental</label>
                      <input type="email" name="reqat" readonly value=" <?= $du ?> Day(s)" readonly class="form-control">
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Fees Per day</label>
                      <input type="email" name="reqat" value="Rs 100" readonly class="form-control">
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Total Fee</label>
                      <input type="email" name="reqat" value="Rs <?= number_format((float)$total,2,'.',',') ?>" readonly class="form-control">
                    </div>

                  <?php }else{?>

                  <p class="alert alert-warning text-center">No Any Booking to this ID!</p>
                    
                  <?php }
                }else{?>
                  <p class="alert alert-warning text-center">Not yet Handovered! sql</p>
                <?php }


              }

            ?>

            
          </div>
          
        </div>
      </div>

    </div>
    <div class="col-12 col-lg-7">
      <p class="alert alert-dark text-center m-0">All Bookings</p>
      <table class="table table-hover mt-2">
        <thead>
          <tr style="font-size:0.8rem ;">
            <th>BICYCLE ID</th>
            <th>RENTED ON</th>
            <th>RENTED AT</th>
            <th>HANDOVER BY</th>
            <th>HANDOVER TIME</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            $books=getAllBookings($conn);
            
            if($books!=null){
              foreach ($books as $book) {
              
              ?>
            
              <tr>
                <td><?= $book['bid']?></td>
                <td  ><?= $book['req_on']?></td>
                <td  ><?= $book['req_at']?></td>
                <?= $book['handover_on']==null?'<td class="text-warning">Not Handoverd!</td>':"<td >{$book['handover_on']}</td>" ?>
                <?= $book['handover_at']==null?'<td class="text-warning">Not Handoverd!</td>':"<td >{$book['handover_at']}</td>" ?>
                
                

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
