<?php
  
    // Logout Function
    if (isset($_POST["logout"])) {
        session_destroy();
        $_SESSION['loggedin'] == false;
        header('Location: ../cust_pages/customer_signin.php');
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
            <a class="nav-link" href="user_homepage.html">Balance</a>
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
            <a class="nav-link" href="customer_manage.php">Manage Account</a>
          </li>
        </ul>

        <form class="form-inline my-2 my-lg-0" action="" method="POST">
          <button name="logout" class="btn btn-info form-inline my-2 my-lg-0">
            Logout
          </button>
        </form>
        
      </div>
    </nav>

    <h1>Manage Account</h1>
    <div>
            <center><p>Welcome back, <?php echo $Fname; ?>!</p></center>
        </div>

        <!--prompts user's information-->
        <div>
            <center>
                <div>
                    Username: <?php echo $user; ?>
                </div>
                <div>
                    Email Address: <?php echo $email; ?>
                </div>
                <div>
                    First Name: <?php echo $Fname; ?>
                </div>
                <div>
                    Last Name: <?php echo $Lname; ?>
                </div>
                <div>
                    Primary Address: <?php echo $address; ?>
                </div>
                <div>
                    
                </div>  
            </center>
  </body>
</html>
