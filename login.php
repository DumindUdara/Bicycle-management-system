<?php 

include './layout.php';

session_start();


?>
    <!-- nav bar end -->
    <div class="site-wrap mt-3">
        <section class="site-section">
            <div class="container">
                <div class="row">
                    <?php

                    if (isset($_SESSION['error'])){
                        echo "<p class=' alert alert-danger text-center'>{$_SESSION['error']}</p>";
                        $_SESSION['error']=null;
                    }else if(isset($_SESSION['msg'])){
                        echo "<p class=' alert alert-success text-center'>{$_SESSION['msg']}</p>";
                        $_SESSION['msg']=null;
                    }


                    ?>
                    
                    <div class="col-lg-6 mb-5">
                        <h2 class="mb-4" style="background-color: #a4bff0ef; text-align: center; ">Login</h2>
                        <form action="./actions/register.php" method="POST" class="p-4 border rounded">
                            <div class="row form-group">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black">User Name or E-mail</label>
                                    <input type="text" name="username" class="form-control" placeholder="User Name or E-mail">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <br>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" name="login" value="Sign In" class="btn px-4 btn-primary text-white">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="mb-4" style="background-color: #a4bff0ef; text-align: center;;">Register</h2>
                        <form action="./actions/register.php" method="POST" class="p-4 border rounded">

                            <div class="row form-group">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black">User Name (Enter your student no. exactly as it is in your student ID card)</label>
                                    <input type="text" name="uid" class="form-control" placeholder="User Name">
                                </div>
                            </div>
                            <div class="row form-group mb-4">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black">E-mail (Enter your personal e-mail accurately)</label>
                                    <input type="email" name="email" class="form-control" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="row form-group mb-4">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black">Contact No.</label>
                                    <input type="text" name="contact" class="form-control" placeholder="Contact No.">
                                </div>
                            </div>

                            <div class="row form-group mb-4">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black">password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Contact No.">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" value="Sign Up" name="register" class="btn px-4 btn-primary text-white">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded",()=>{

            setInterval(() => {
                removeErrors()
            }, 2000);
            
        })
        function removeErrors(){
            let errors=document.querySelectorAll('.alert')
            errors.forEach(e=>{
                e.remove()
            })
        }
    </script>