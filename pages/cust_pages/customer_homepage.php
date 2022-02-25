<?php
    // Logout Function
    if (isset($_POST["logout"])) {
        session_destroy();
        $_SESSION['loggedin'] == false;
        header('Location: ../customer_signin.php');
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
    <link rel="stylesheet" href="../styles/styles.css" />

    <!-- FontAwesome Icons -->
    <script
      src="https://kit.fontawesome.com/2727c3ff62.js"
      crossorigin="anonymous"
    ></script>

    <title>Banking App</title>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="user_homepage.html#">Banking App</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="user_homepage.html#">Balance</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="withdraw.php#">Withdraw</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="withdraw.php#">Deposit</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="transfer.php#">Transfer Money</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="user_account.php#">Manage Account</a>
          </li>
        </ul>

        
      </div>
      <form class="logout-form" action="" method="POST">
        <button name="logout" class="btn btn-info form-inline my-2 my-lg-0">
          Logout
        </button>
      </form>
    </nav>

    <h1>Account Balance</h1>


    <p>
      maybe here we can put the account summary with like the account balance n
      whatever
    </p>
  </body>
</html>
