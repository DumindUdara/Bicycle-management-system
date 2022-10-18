<?php

include_once './actions/config.php';
include './layout.php';

if(!isset($_SESSION['admin']) || !$_SESSION['admin']==1){
  header("Location:./login.php?msg=you need to login first");
}

?>

<div class="container mt-4">
  <div class="row">
    <div class="col-12 col-lg-10 mx-auto">
      <p class="alert alert-dark text-center m-0">All Bookings</p>
      <table class="table table-hover mt-2">
        <thead>
          <tr style="font-size:0.8rem ;">
            <th>INQUERY ID</th>
            <th>BICYCLE ID</th>
            <th>REQUIRED ON</th>
            <th>REQUIRED AT</th>
            
            <th>CUSTOMER NAME</th>
            <th>CONTANT NO</th>
            <th>Apporov</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            $books=getAllBookings($conn);
            
            if($books!=null){
              foreach ($books as $book) {
              $userdata=getUsernameFromID($conn,$book['user_id']);
              
              ?>
            
              <tr id="tr-<?= $book['id']?>">
                <td><?= $book['id']?></td>
                <td><?= $book['bid']?></td>
                <td  ><?= $book['req_on']?></td>
                <td  ><?= $book['req_at']?></td>
                <td><?= $userdata[0]?></td>
                <td><?= $userdata[1]?></td>
                
                
                <td><button class="btn btn-sm app-btn <?= $book['approve']==0?'btn-danger':'btn-success' ?> w-100"
                data-bid=<?= $book['id']?> 
                data-state=<?= $book['approve']==0?1:0 ?>
                data-bicycle=<?= $book['bid'] ?>
                data-user=<?= $book['user_id']?>
                >
                <?= 
                $book['approve']==0?'&times':'&#10003';
                
                ?>
              </button></td>
              <td><i data-bid="<?= $book['id']?>" class="fa-solid fa-trash del-btn" ></i></td>
              </tr>
              
              
            <?php }



              
            }else{?>

              <td colspan="8">
                <p class="alert alert-warning text-center">No Bookings Found!</p>
              </td>

            <?php }?>

           
          </tr>
        </tbody>
      </table>
      <hr>
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded",()=>{

      setInterval(() => {
          removeErrors()
      }, 2000);


      let appbtns=document.querySelectorAll('.app-btn')
      appbtns.forEach(btn=>{
        btn.addEventListener('click',(e)=>{

          const bid=e.target.dataset.bid;
          const bicycleid=e.target.dataset.bicycle;
          const state=e.target.dataset.state;
          const userid=e.target.dataset.user

          // alert(userid)
          // e.preventDefault()

          try{
            var req=new XMLHttpRequest()

            req.onreadystatechange=function(){
              if(this.readyState==4 && this.status==200){
                if(parseInt(this.responseText)==1){
                  
                  if(state==1){
                    e.target.classList.remove('bg-danger')
                    e.target.classList.add('bg-success')
                    e.target.innerHTML='&#10003'
                  }else{
                    e.target.classList.remove('bg-success')
                    e.target.classList.add('bg-danger')
                    e.target.innerHTML='&times'
                  }
                  
                }else{
                  alert(this.responseText)
                }
              }
            }

            req.open('POST','./actions/register.php')
            req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            req.send(`avalible=true&bid=${bid}&bicycle=${bicycleid}&state=${state}&userid=${userid}`)

            e.preventDefault()

          }catch(e){
            alert(e)
          }
        })
      })

      let btns=document.querySelectorAll('.del-btn')
      btns.forEach(btn=>{
        btn.addEventListener('click',(e)=>{

          const bookid=e.target.dataset.bid

          try{
            var req=new XMLHttpRequest()

            req.onreadystatechange=function(){
              if(this.readyState==4 && this.status==200){
                
                if(this.responseText!=0){
                  let tr=document.querySelector(`#tr-${this.responseText}`)
                  if(tr){
                    tr.remove()
                  }
                }
              }
            }

            req.open('POST','./actions/register.php')
            req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            req.send(`delete=true&bid=${bookid}`)

            e.preventDefault()

          }catch(e){
            alert(e)
          }



        })
      })



      
      
  })
  function removeErrors(){
      let errors=document.querySelectorAll('.msg')
      errors.forEach(e=>{
          e.remove()
      })
  }
</script>