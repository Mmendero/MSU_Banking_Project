<?php
  include "../../lib/admin_request_handler.php";

  // Logout Function
  if (isset($_POST["logout"])) {
    $_SESSION['loggedin'] = false;
    header('Location: ../admin_pages/admin_signin.php');
  }

  // Validate Admin Login.
  if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) || !$_SESSION['admin']) {
    $_SESSION['loggedin'] = false;
    header('Location: ../admin_pages/admin_signin.php');
  }

  // Handle Request Approval.
  if (isset($_POST["approve"])) {
    handleRequestApproval($db);
  }

  // Handle Request Rejection.
  if (isset($_POST["reject"])) {
    removeRequest($db, "Account Request Rejected");
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
    <link rel="stylesheet" href="../../styles/admin_styles.css" />

    <!-- FontAwesome Icons -->
    <script
      src="https://kit.fontawesome.com/2727c3ff62.js"
      crossorigin="anonymous"
    ></script>

    <title>Admin Front Page</title>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="admin_homepage.php">Admin Frontpage</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="user_search.html#">Search User</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="manage_users.php#">Manage Users</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="account_requests.php#">Account Creation Requests</a>
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
      if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
        if(isset($_SESSION['request_error']) && $_SESSION['request_error'] == FALSE){
          $message_status = "info";
        }
        else{
          $message_status = "danger";
          $_SESSION['request_error'] = FALSE;
        }
        echo "<div class='alert alert-".$message_status." alert-dismissible fade show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        $_SESSION['message'] = '';
      }
      
      // Query Database For all Account Creation Requests.
      $query = "SELECT * FROM acc_request";
      $result = $db->query($query);

      if ($result->num_rows == 0) {
        echo '<div class="no-requests">';
        echo '<h1 class="display-4">No Account Creation Requests at this time.</h1>';
        echo '</div>';
      }else{
        echo '<div class="requests-title">';
        echo '<h1>Account Creation Requests</h1>';
        echo '</div>';
        echo '<table class="table table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="align-middle" scope="col">#</th>';
        echo '<th class="align-middle" scope="col">Account Type</th>';
        echo '<th class="align-middle" scope="col">First Name</th>';
        echo '<th class="align-middle" scope="col">Last Name</th>';
        echo '<th class="align-middle" scope="col">Email</th>';
        echo '<th class="align-middle" scope="col">Address</th>';
        echo '<th class="align-middle" scope="col"></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        $count = 1;
        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<form action="" method="post">';
          echo '<th class="align-middle" scope="row">'.$count.'</th>';
          echo '<td class="align-middle">'.$row['acc_type'].'</td>';
          echo '<td class="align-middle">'.$row['fname'].'</td>';
          echo '<td class="align-middle">'.$row['lname'].'</td>';
          echo '<td class="align-middle">'.$row['email'].'</td>';
          echo '<td class="align-middle">'.$row['address'].'</td>';
          echo '<td class="align-middle">';
          echo '<button name="approve" class="btn btn-success form-inline my-2 my-lg-0 mr-2 ml-2">';
          echo 'Approve';
          echo '</button>';
          echo '<button name="reject" class="btn btn-danger form-inline my-2 my-lg-0" mr-2 ml-2>';
          echo 'Reject';
          echo '</button>';
          echo '</td>';

          // Hidden Input Forms.
          echo '<input type="hidden" name="acc_id" value='.$row['ID'].'>';
          echo '<input type="hidden" name="acc_type" value='.$row['acc_type'].'>';
          echo '<input type="hidden" name="user" value='.$row['username'].'>';
          echo '<input type="hidden" name="pass" value='.$row['password'].'>';
          echo '<input type="hidden" name="fname" value='.$row['fname'].'>';
          echo '<input type="hidden" name="lname" value='.$row['lname'].'>';
          echo '<input type="hidden" name="email" value='.$row['email'].'>';
          echo '<input type="hidden" name="address" value='.$row['address'].'>';
          echo '</form>';
          echo '</tr>';
        
          // Increment number of requests.
          $count++;
        }
        
        echo '</tbody>';
        echo '</table>';
      }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
