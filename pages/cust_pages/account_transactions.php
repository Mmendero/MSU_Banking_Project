<?php
  include '../../config.php';

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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/styles.css"/>

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
        <a class="navbar-brand" href="customer_homepage.php">Admin Frontpage</a>
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

    <div class="accounts">
      <select class="form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>

    <!-- Total Account Balance -->
    <div class="balance">
        <h7>Available Balance</h7>
        <h1 class="balance-amount">$100.00</h1>
    </div>

    <!-- Account Listing -->
    <div class="account_table">

      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Type</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Balance</th>
          </tr>
        </thead>
        <?php
          $query = "SELECT * FROM TRANSACTION WHERE acc_number = '".$_SESSION['POST']['acc_num']."'";
          $result = $db->query($query);

          $account_total = 0;

          // Build Table of Transactions.
          echo '<tbody>';
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
              echo '<tr>';
              echo '<td class="col-md-2">'.$row['type'].'</td>';
              echo '<td class="col-md-2">$'.$row['date'].'</td>';
              echo '<td class="col-md-4">$'.$row['type'].'</td>';
              echo '<td class="col-md-2">$'.$row['name'].'</td>';
              echo '<td class="col-md-2">$'.number_format($row['amount'], 2).'</td>';
              echo '<td class="col-md-2">$'.number_format($row['balance'], 2).'</td>';
              echo '</tr>';
            }
          }else{
            echo '<tr>';
            echo '<td class="no-transactions" colspan="7">No Transactions Available for this Account</td>';
            echo '</tr>';
          }
          echo '</tbody>';

        ?>
      </table>

    </div>
  </body>
</html>
