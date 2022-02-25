<?php
    require_once "config.php";

    //informs user if input was not put in correctly
    if ($_SESSION['login_failed'] == 'bad_input') {
        $notice = 'ERROR: Log in info was not properly input. Please try again.';
        $_SESSION['login_failed'] = '';
    }
    
    //informs user if username does not exist
    else if ($_SESSION['login_failed'] == 'userdne') {
        $notice = 'ERROR: Username does not exist. Please try again.';
        $_SESSION['login_failed'] = '';
    }
    
    //informs user if password is incorrect
    else if ($_SESSION['login_failed'] == 'wrong_password') {
        $notice = 'ERROR: Incorrect password. Please try again.';
        $_SESSION['login_failed'] = '';
    }
    
    //informs user if they tried to add items to cart prior to logging in
    else if ($_SESSION['needlog'] == true) {
        $notice = 'ERROR: You are not logged in. Please log in and try again.';
        $_SESSION['needlog'] = false;
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
    <link rel="stylesheet" href="styles/styles.css" />

    <!-- FontAwesome Icons -->
    <script
      src="https://kit.fontawesome.com/2727c3ff62.js"
      crossorigin="anonymous"
    ></script>

    <title>Login</title>
  </head>

  <body>
    <div stype='color: red;'><?php echo $notice; ?></div>
    <h1 class="signin-card-title">Banking App Sign In</h1>

    <div class="card login-card">
      <div class="card-body">
        <h5 class="card-title">Login</h5>

        <form action="../lib/customer_login_confirm.php" method="post">
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
            <button type="submit" class="btn btn-primary" name="but_submit">
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
