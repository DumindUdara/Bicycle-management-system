
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

  <title>Document</title>
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
  }

  
</style>
  
  <!-- nav bar  -->
  <nav class="navbar navbar-expand-lg  w-100 bg-light">
    <div class="container-fluid d-flex justify-content-between ">
      <div class="logo w-25 d-none d-lg-block">
        <img src="./assests/images/logo.png" class=" ms-5" alt="" width="60%">
      </div>
      
      <div class="icons w-75 d-flex align-items-center w-100 justify-content-end border border-1 border-white
       ">
        <ul class="d-flex justify-content-around align-items-center list-unstyled w-50 nav-list">
          <li class=" d-none d-lg-block">Si</li>
          <li class=" d-none d-lg-block">En</li>
          <li><i class="fa-solid fa-right-from-bracket">

          <?= $logedin? '</i><a href="./actions/config.php?action=logout" class="text-dark text-decoration-none" > Logout</a>' : '</i><a href="./login.php" class="text-dark text-decoration-none"> Login</a>'?>
          </li>
          <li><i class="fa-solid fa-cart-circle-arrow-up "></i>Cart</li>
          <li><i class="fa-solid fa-user "></i><a href="./dashboard.php" class=" text-dark text-decoration-none"> My Account </a></li>
          <li><i class="fa-regular fa-file-pen"></i><a href="#view" class=" text-dark  text-decoration-none">View Order</a></li>
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
  </style>
  <div class="w-100" style="height:60px;background-color: #b5b5b5;">
    <ul class="list-unstyled nav2 d-flex w-50 align-content-around align-items-center justify-content-around ">
      <li class="nav-item-bottom">
        Home
      </li>
      <li class="nav-item-bottom">View</li>
      <li class="nav-item-bottom">Book</li>
      <li class="nav-item-bottom">Donete</li>
      <li class="nav-item-bottom">Contact</li>
    </ul>
  </div>
  
  


 <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin="anonymous"
      ></script>
</body>
</html>