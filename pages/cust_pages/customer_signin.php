<?php
  include "../../lib/customer_signin_confirm.php";
  
  // Register Form is Submitted
  if (isset($_POST["cust_signin"])) {
    handleSignIn($db);
  }

?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/styles.css" />

    <!-- FontAwesome Icons -->
    <script
      src="https://kit.fontawesome.com/2727c3ff62.js"
      crossorigin="anonymous"
    ></script>

    <title>Login</title>
  </head>

  <body>
    <?php 
      if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
        if(isset($_SESSION['regdone']) && $_SESSION['regdone'] == true){
          $message_status = "success";
          $_SESSION['regdone'] = false;
        }
        else{
          $message_status = "danger";
        }
        echo "<div class='alert alert-".$message_status." alert-dismissible show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        $_SESSION['message'] = '';
      }
    ?>
    <h1 class="signin-card-title">Banking App Sign In</h1>

    <div class="card login-card">
      <div class="card-body">
        <h5 class="card-title">Login</h5>

        <form action="" method="post">

          <div class="form-outline form-white mb-4">
            <label class="form-label" for="typeEmailX"> </label>
            <input type="text" name="user" class="form-control form-control-lg" placeholder="Username"/>
            
          </div>

          <div class="form-outline form-white mb-4">
            <label class="form-label" for="typePasswordX"> </label>
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password"/>
          </div>

          <div class="button-container">
            <button type="submit" class="btn btn-primary" name="cust_signin">
              Sign In
            </button>
          </div>

          <a class="nav-link card-title" href="customer_register.php#"
            >Don't have an account? Register Here!</a
          >
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
