<?php
  include "../../lib/customer_signin_confirm.php";
  
  // Register Form is Submitted
  if (isset($_POST["signin_submit"])) {
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
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
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
        if (isset($_SESSION['message'])){
          echo "<p class='message'>".$_SESSION['message']."</p>";
          $_SESSION['message'] = '';
        }
       ?>
    <h1 class="signin-card-title">Banking App Sign In</h1>

    <div class="card login-card">
      <div class="card-body">
        <h5 class="card-title">Login</h5>

        <form action="" method="post">
          <div class="form-group">
            <label for="user">User</label>
            <input
              type="text"
              class="form-control"
              name="user"
              aria-describedby="user"
            />
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" />
          </div>

          <div class="button-container">
            <button type="submit" class="btn btn-primary" name="signin_submit">
              Sign In
            </button>
          </div>

          <a class="nav-link card-title" href="customer_register.php#"
            >Don't have an account? Register Here!</a
          >
        </form>
      </div>
    </div>
  </body>
</html>