<?php  

include_once './actions/config.php';
include './layout.php';


if(isset($_GET['date'])){
  $date=$_GET['date'];
}else{
  $date= strval(date('Y-m-d',time()));
}


?>

<div class="container-fluid mt-0 d-flex w-100 border border-4 align-items-center justify-content-around" style="background-color:rgba(154, 191, 214,0.6) ;">
    <img src="./assests/images/banner.jpg" alt="" width="80%">
    
  </div>
  <?php

    if(isset($_SESSION['error'])){

      echo "<p class='alert msg  my-2 alert-danger text-center'>{$_SESSION['error']}</p>";
      $_SESSION['error']=null;
    }else if(isset($_SESSION['msg'])){
      echo "<p class='alert msg  my-2 alert-success text-center'>{$_SESSION['msg']}</p>";
      $_SESSION['msg']=null;
    }

    ?>
  <div class="container-fluid align-items-center flex-column d-flex justify-content-around" style="background-color:#bfbfbf ;">
  
    <div class="w-100">
      <p class=" text-center m-0"><strong>Booking Space</strong></p>
    </div>
    <div class="text w-100 p-3">
      <p class=" text-center m-0">
      1. Please  <a href="" class=" text-danger">login here</a>  before continuing, if not already loggedin!</p>
      <p class=" text-center m-0"> 2. You may use the SEARCH date option to view the bicycles available on your date of choice. </p>
      <p class=" text-center m-0"> 3. Then click on the AVAILABLE icon of your bicycle of choice and proceed with your booking. 
      Enjoy our services! </p>

    </div>
  </div>

  <div class="container-fluid my-4">
    <div class="row">
     <div class="col-10 col-md-4 mx-auto">
      <form action="<?= $_SERVER['PHP_SELF']?>" >
        <div class="input-group mb-3">
          
          <input required type="date" class="form-control" name="date" value="<?= strval(date('Y-d-m',time())) ?>"  aria-describedby="button-addon2">
          <button class="btn btn-success" type="submit" id="button-addon2">Button</button>
        </div>
     </form>
     </div>
    </div>
  </div>

  <style>
    .dis{
      height: 60px;
      overflow-y: scroll;
      
    }
    .dis::-webkit-scrollbar{
      display: none;
    }
  </style>

<div class="container-fluid">

    <div class="row w-100 mx-auto justify-content-around" id="view">
        <?php
          $sql="SELECT * FROM bicycles WHERE isavailable=1";
          $res=$conn->query($sql);
          if($res==TRUE){
            if($res->num_rows>0){
              while($row=$res->fetch_assoc()){ ?>
                <div class="col-10 col-md-3 my-3 ">
                  <div class="card text-center p-0" >
                    <div class="card-body">
                      <h5 class="card-title text-center"><?= ucfirst($row['name'])?></h5>
                      <div class="dis w-100 my-2">
                        <p class="card-text"><?= $row['discription']==null?'New Bicycle!':ucfirst($row['discription']) ?> </p>
                      </div>
                      <form action="./booking.php" method="POST" class="w-100">

                        <input type="hidden" name='bid' value="<?= $row['id'] ?>" >
                        <input type="hidden" name="date" value="<?= $date ?>">

                        <input type="submit" class="btn btn-success w-100 m-0" value="Available">
                      </form>
                    </div>
                  </div>
                </div>
          <?php }
            }else{
              echo '<p class="alert alert-warning text-center">No Data Found! </p>';
            }
          }
        ?>
    </div>  
</div>

<?php  include './footer.php'; ?>
