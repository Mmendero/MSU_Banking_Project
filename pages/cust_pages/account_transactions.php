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
      <a class="navbar-brand" href="customer_homepage.php">Accounts</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

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

        <form class="form-inline my-2 my-lg-0" action="" method="POST">
          <button name="logout" class="btn btn-info form-inline my-2 my-lg-0">
            Logout
          </button>
        </form>
        
      </div>
    </nav>
    
    <!-- Homepage Greeting -->
    <?php
      // Get time info.
      date_default_timezone_set('America/New_York');
      $date = date('F, d Y',strtotime(date("Y-m-d")));
      if(date("a") == 'pm'){
        $time = 'evening';
      }
      else{
        $time = 'morning';
      }
      
      // Get user info.
      $query = "SELECT * FROM CUSTOMER WHERE ID = '".$_SESSION['user_id']."'";
      $user = $db->query($query)->fetch_assoc();

      echo '<div class="homepage-greeting">';
      echo '<h1>Good '.$time.' '.$user['fname'].'!</h1>';
      echo '<h6>Today\'s date is '.$date.'</h7>';
      echo '</div>';
    ?>

    <!-- Account Listing -->
    <div class="account_table">

      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">Account</th>
            <th scope="col">Available Balance</th>
            <th scope="col">Pending Transactions</th>
          </tr>
        </thead>
        <?php
          $query = "SELECT * FROM ACCOUNT WHERE cust_id = '".$_SESSION['user_id']."'";
          $result = $db->query($query);

          $account_total = 0;
          while ($row = $result->fetch_assoc()){
            echo '<tbody>';
            echo '<tr>';
            echo '<td class="col-md-6">'.$row['type'].'</td>';
            echo '<td>$'.number_format($row['balance'], 2).'</td>';
            echo '<td>$'.number_format($row['pending'], 2).'</td>';
            echo '</tr>';
            
            $account_total += $row['balance'];
          }
          echo '</tbody>';
          echo '<tfoot>';
          echo '<tr class="table-info">';
          echo '<td class="col-md-6">Total</td>';
          echo '<td colspan="2">$'.number_format($account_total, 2).'</td>';
          echo '</tr>';
          echo '</tfoot>';
        ?>
      </table>

    </div>
  </body>
</html>
