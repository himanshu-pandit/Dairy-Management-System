<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbladmin where  UserName='$adminuser' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['aid']=$ret['ID'];
     header('location:dashboard.php');
    }
    else{
     echo "<script>alert('Invalid details. Please try again.');</script>";  
    }
  }
  ?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Loding font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="./includes/index.css">

    <title>Login Page</title>
    </head>
    <body>
      <!-- Backgrounds -->

      <div id="login-bg" class="container-fluid">
        <div class="bg-img"></div>
        <div class="bg-color"></div>
      </div>

      <!-- End Backgrounds -->

      <div class="container" id="login">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="login">
              <h1>Welcome Back :)</h1>
            
              <!-- Loging form -->
                <form method="post">
                  <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="true">                
                  </div>
                
                  <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="true">
                  </div>
                  <br>
                
                  <button type="submit" class="btn btn-lg btn-block" name="login">Login</button>
                  <label class="forgot-password"><a href="#">Having trouble logging in?<a></label>
                </form>
              <!-- End Loging form -->
            
              </div>
          </div>
        </div>
      </div>
    </body>
</html>