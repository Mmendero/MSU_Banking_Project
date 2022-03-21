<?php
  include "../../lib/admin_request_handler.php";

  // Logout Function
  if (isset($_POST["logout"])) {
      session_destroy();
      $_SESSION['loggedin'] == false;
      header('Location: ../admin_pages/admin_signin.php');
  }

  // Handle Request Approval.
  if (isset($_POST["approve"])) {
    handleRequestApproval($db);
  }

  // Handle Request Rejection.
  if (isset($_POST["reject"])) {
    removeRequest($db);
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
      <a class="navbar-brand" href="admin_homepage.php#">Admin Front Page</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
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

        <form class="form-inline my-2 my-lg-0" action="" method="POST">
          <button name="logout" class="btn btn-info form-inline my-2 my-lg-0">
            Logout
          </button>
        </form>
      </div>
      
    </nav>

    <?php

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
          echo '</form>';
          echo '</tr>';

          echo '<input type="hidden" name="acc_id" value="'.$row['ID'].'">';
          echo '<input type="hidden" name="acc_type" value='.$row['acc_type'].'>';
          echo '<input type="hidden" name="user" value='.$row['username'].'>';
          echo '<input type="hidden" name="pass" value='.$row['password'].'>';
          echo '<input type="hidden" name="fname" value='.$row['fname'].'>';
          echo '<input type="hidden" name="lname" value='.$row['lname'].'>';
          echo '<input type="hidden" name="email" value='.$row['email'].'>';
          echo '<input type="hidden" name="address" value='.$row['address'].'>';

          $count++;
        }
        

        echo '</tbody>';
        echo '</table>';
      }
    ?>

  </body>
</html>
