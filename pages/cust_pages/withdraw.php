<?php
  include "../../lib/transaction_handler.php";
  
  // Logout Function
  if (isset($_POST["logout"])) {
    $_SESSION['loggedin'] = false;
    header('Location: ../cust_pages/customer_signin.php');
  }

  // Validate Login.
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    $_SESSION['loggedin'] = false;
    header('Location: ../cust_pages/customer_signin.php');
  }

  // Withdraw Function
  if (isset($_POST["withdraw_submit"])) {
    handleWithdraw($db);
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

    <title>Banking App</title>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="customer_homepage.php">Accounts</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="withdraw.php#">Withdraw</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="deposit.php#">Deposit</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="transfer.php#">Transfer Money</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="customer_manage.php">Manage Account</a>
            </li>
          </ul>

          <form class="d-flex form-inline my-2 my-lg-0" action="" method="POST">
            <button name="logout" class="btn btn-info form-inline my-2 my-lg-0">
              Logout
            </button>
          </form>
        </div>
      </div>
    </nav>
    <section class="vh-200">
                <!-- Status Message -->
                <?php 
                    if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
                        echo "<div class='alert alert-danger alert-dismissible show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                        $_SESSION['message'] = '';
                    }
                ?>
                <div class="container py-5 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-7">
                            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                <div class="card-body p-4 p-md-5">
    <h1>Withdraw</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" class="form-control" placeholder="$" name="amount" required />
      </div>
    
      <div class="button-container">
        <button type="submit" class="btn btn-primary" name="withdraw_submit">
        Withdraw
        </button>
      </div>
    </form>
    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
