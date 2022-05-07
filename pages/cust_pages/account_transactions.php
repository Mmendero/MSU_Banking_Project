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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
    rel="stylesheet"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../styles/styles.css" />
    <link rel="stylesheet"  media="print" href="../../styles/print_styles.css" />

    <title>Transactions</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#transFilter').change(function() 
        {
          $.ajax({
              type: 'post',
              url: "account_transactions.php",
              data: $("form.transFilter").serialize(),
              success: function() {
              }
          });
        });

        $('#accountOption').change(function() 
        {
          $.ajax({
              type: 'post',
              url: "account_transactions.php",
              data: $("form.accountOption").serialize(),
              success: function() {
              }
          });
        });
      });
    </script>
  </head>

  <body style="background-color: #cccccc;">
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
              <a class="nav-link" href="withdraw_deposit.php">Withdraw/Deposit</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="transfer_money.php">Transfer Money</a>
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

    <?php
      // Define Current account Number
      if (isset($_POST["accountOption"])){
        $acc_num = $_POST["accountOption"];
        $filter = $_POST["filter"];
      }else{
        $acc_num = $_SESSION['POST']['acc_num'];
      }

      if (isset($_POST["transFilter"])){
        $acc_num = $_POST["acc_num"];
        $filter = $_POST["transFilter"];
      }else{
        $filter = "all";
      }

      $query = "SELECT * FROM `account` WHERE `acc_number` = \"".$acc_num."\"";
      $acc = $db->query($query)->fetch_assoc();
    ?>

    <!-- Total Account Balance -->
    <div class="transaction-section-top">
      <div class="balance">
          <h7>Available Balance</h7>
          <h1 class="balance-amount">$ <?php echo number_format((float)(openssl_decrypt($acc['balance'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv'])), 2);?></h1>
      </div>

      <!-- Switch Account -->
      <div class="accounts-dropdown">
        <form action="" method="post">
          <select class="form-select" name="accountOption" onchange="this.form.submit()">
            <?php
              // Set current viewing account as
              // selected account.
              $acc_name = $acc['type']." (x".substr(strval($acc['acc_number']), -4).")";
              echo "<option selected value=".$acc['acc_number'].">".$acc_name."</option>";

              // Grab all other accounts for user.
              $query = "SELECT * FROM `account` WHERE `cust_id` = \"".$_SESSION['user_id']."\"";
              $result = $db->query($query);

              // Append other acccounts to select tag.
              while ($row = $result->fetch_assoc()){
                if($row['acc_number'] != $acc_num){
                  echo "<option value=".$row['acc_number'].">".$row['type']." (x".substr(strval($row['acc_number']), -4).")</option>";
                }
              }
            ?>
            <input type="hidden" name="filter" value="<?php echo $filter; ?>">
          </select>
          <noscript><input type="submit" value="Submit"/></noscript>
        </form>
      </div>
    </div>
    

    <!-- Account Listing -->
    <div class="transaction-section-mid">
      <div class="transaction_table">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-4 text-center">
            <h3>Account Statement for <?php  echo "(x".substr(strval($acc['acc_number']), -4).")"; ?> </h3>
            <div class="util-bar">

              <!-- Filter Dropdown Button -->
              <div class="filter-dropdown">
                <form action="" method="post">
                  <select class="form-select" name="transFilter" onchange="this.form.submit()">
                    <?php
                      // Dropdown Options hashamp.
                      $options = [
                        "all" => "All", 
                        "30days" => "Last 30 Days", 
                        "60days" => "Last 60 Days", 
                        "pending" => "Pending",
                      ];

                      // Prev Selected Dropdown is current selected.
                      echo "<option selected value='".$filter."'>".$options[$filter]."</option>";

                      // Display all options that are not current option.
                      foreach($options as $option => $message) {
                        if ($option != $filter){
                          echo "<option value='".$option."'>".$message."</option>";
                        }
                      }
                    ?>
                  </select>
                  <input type="hidden" name="acc_num" value="<?php echo $acc_num; ?>">
                  <noscript><input type="submit" value="Submit"/></noscript>
                </form>
              </div>
              
              <!-- Print Transaction Button -->
              <div class="print-trans">
                <div class="d-grid gap-2 d-md-block">
                  <button type="button" style="background-color:gray" class="btn btn-secondary btn-block" onClick="window.print()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                      <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                      <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            <!-- Transaction Table -->
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
                // Set the date limit depending on
                // chosen filter.
                $query = "SELECT * FROM `transaction` WHERE `acc_number` = \"".$acc_num."\" ORDER BY `date` ASC";
                $result = $db->query($query);
                $account_total = 0;

                $year_limit = strtotime("-1 year", strtotime("now"));
                $date_limit = $year_limit;
                if($filter == "30days"){
                  $date_limit = strtotime("-30 days", strtotime("now"));
                }
                elseif($filter == "60days"){
                  $date_limit = strtotime("-60 days", strtotime("now"));
                }
                
                // Build Table of Transactions.
                echo '<tbody>';
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()){
                    // Decrypt Transaction Data.
                    $trans_id = $row['ID'];
                    $balance = (float)(openssl_decrypt($row['balance'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']));
                    $amount = (float)(openssl_decrypt($row['amount'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']));
                    $desc = openssl_decrypt($row['name'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
                    $date = openssl_decrypt($row['date'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

                    // If transaction's date exceeds filter, 
                    // prevent transactions from showing.
                    if (strtotime($date) < $date_limit){

                      // If transaction exceeds a year, remove record.
                      if (strtotime($date) < $year_limit){
                        $query = "DELETE FROM `transaction` WHERE `ID`=".$trans_id;
                        $result = $db->query($query);
                      }
                    }
                    else{
                      // Font Color Condition.
                      $font_color = "text-success";
                      if ($row['type'] == "Withdraw"){
                        $font_color = "text-danger";
                      }

                      // Print Rows.
                      echo '<tr>';
                      echo '<td class="col-md-2">'.date("m-d-Y",strtotime($date)).'</td>';
                      echo '<td class="col-md-2">'.$row['type'].'</td>';
                      echo '<td class="col-md-4">'.$desc.'</td>';
                      echo '<td class="col-md-2 '.$font_color.'">$'.number_format($amount, 2).'</td>';
                      echo '<td class="col-md-2 text-info font-weight-bold">$'.number_format($balance, 2).'</td>';
                      echo '</tr>';
                    }
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
        </div>
      </div>

    </div>
            
  </body>
</html>
