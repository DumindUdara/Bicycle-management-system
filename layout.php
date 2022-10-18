
<?php
$logedin=false;
if(isset($_SESSION['login'])){
  $logedin=true;
}


?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
    crossorigin="anonymous"
      />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <title>BRS System -SLTC</title>
  <script src="./js/remove-error.js"></script>

  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<style>

  @media (max-width:780px) {
    .nav-list{
      width:100%!important;
      justify-content: space-evenly;
      margin: 0;
      padding: 0;
      height: fit-content!important;
      flex: 1;
  
    }
    .nav-list>li{
      font-size: 1.1em;
    }
    .nav2{
      width: 100%!important;
    }
  }
  
  .nav-list>li{
    margin: 5px 10px 5px 10px;
    color: white;
    
  }
  .nav-list>li>a{
    color: white;
  }
  
  
  
</style>
  
  <!-- nav bar  -->
  <nav class="navbar navbar-expand-lg  w-100 " style="background-color:rgba(16, 115, 148) ;">
    <div class="container-fluid d-flex justify-content-between ">
      <div class="logo w-25 d-none d-lg-block">
        <img src="./assests/images/logo.png" class=" ms-5" alt="" width="60%">
      </div>
      
      <div class="icons w-75 d-flex align-items-center w-100 justify-content-end ">

        <ul class="d-flex justify-content-around align-items-center list-unstyled w-50 nav-list">
          
          <li><i class="fa-solid fa-right-from-bracket">

          <?= $logedin? '</i><a href="./actions/config.php?action=logout" class=" text-decoration-none" > Logout</a>' : '</i><a href="./login.php" class=" text-decoration-none"> Login</a>'?>
          </li>
          <li><i class="fa-solid fa-cart-arrow-down"></i><span> Cart</span></li>
          <li>
            <?php

            

            if(isset($_SESSION['login'])){

              if(isset($_SESSION['admin'])){
                echo "<i class='fa-solid fa-user'></i><a href='./admindashboard.php' class=' text-decoration-none'> My Account </a>";
              }else{
                echo "<i class='fa-solid fa-user '></i><a href='./dashboard.php' class='  text-decoration-none'> My Account </a>";
              }
            }else{
              // $_SESSION['error']='you need to login first!';
              echo "<i class='fa-solid fa-user ''></i><a href='./login.php?msg=you need to login first' class=' text-decoration-none'> My Account </a>";
            }


            ?>


          </li>
          <li><i class="fa-solid fa-bookmark"></i>
          <a href="" class="  text-decoration-none"><span> View Order</span></a></li>
        </ul>
        
      </div>
    </div>
  </nav>

  <style>
    .nav-item-bottom{
      
      width: 100%;
      text-align: center;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-around;


    }

    
    .nav-item-bottom:hover{
      cursor: pointer;
      background-color: grey;
    }
    .active{
      background-color: grey;
    }
    li>a{
      text-decoration: none;
      color: #000;

    }
    li>a:hover{
      color: white;
    }
  </style>
  <div class="w-100" style="height:60px;background-color: #b5b5b5;">
    <ul class="list-unstyled nav2 d-flex w-50 align-content-around align-items-center justify-content-around ">
      <li class="nav-item-bottom">
        <a href="./index.php">Home</a>
      </li>
      <li class="nav-item-bottom">
      <a href="">View</a>  
      </li>
      <li class="nav-item-bottom">
        <a href="">Book</a>
      </li>
      <li class="nav-item-bottom">
        
        <a href="">About</a>
      </li>
      <li class="nav-item-bottom">
        <a href="https://edu.sltc.ac.lk/contact">Contact</a>
        
      </li>
    </ul>
  </div>
  
  


 <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin="anonymous"
      ></script>