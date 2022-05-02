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

  // Handle Request Rejection.
  if (isset($_POST["remove_suggestion"])) {
    removeSuggestion($db, "Suggestion Removed");
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
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../../styles/admin_styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <title>Admin Account Requests</title>
  </head>
    <body class="sb-nav-fixed">
      <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
          <!-- Navbar Brand-->
          <a class="navbar-brand ps-3" href="index.html">BLEM Admin Panel</a>
          <!-- Sidebar Toggle-->
          <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
          <!-- Navbar Search-->
          <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="" method="post">
            <button name="logout" class="btn btn-primary form-inline my-2 my-lg-0">
              Logout
            </button>
          </form>
      </nav>
      <div id="layoutSidenav">
          <div id="layoutSidenav_nav">
              <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                  <div class="sb-sidenav-menu">
                      <div class="nav">
                          <div class="sb-sidenav-menu-heading">Core</div>
                          <a class="nav-link" href="admin_homepage.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                              Dashboard
                          </a>
                          <div class="sb-sidenav-menu-heading">Admin Functions</div>
                          <a class="nav-link" href="account_requests.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                              Account Requests
                          </a>
                          <a class="nav-link" href="admin_manage.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                              Manage Users
                          </a>
                          <a class="nav-link" href="suggestions.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-question"></i></div>
                              Suggestions
                          </a>
                      </div>
                  </div>
                  <div class="sb-sidenav-footer">
                      <div class="small">Logged in as:</div>
                      BLEM Admin
                  </div>
              </nav>
          </div>
          <div id="layoutSidenav_content">
              <main>
                  <div class="container-fluid px-4">
                      <div class="p-2">
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
                        ?>
                      </div>
                      
                      <h1 class="mt-4">User Suggestions</h1>
                      <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active"></li>
                      </ol>
                      <div class="card mb-4">
                          <div class="card-header">
                          All User Suggestions
                          </div>
                          <div class="card-body">
                              <!-- USERS TABLE -->

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
                                
                                // Query Database For all Suggestions.
                                $query = "SELECT * FROM `suggestion`";
                                $result = $db->query($query);

                                if ($result->num_rows == 0) {
                                  echo '<div class="no-requests">';
                                  echo '<h3 class="display-4" style="text-align: center;">No user suggestions at this time.</h3>';
                                  echo '</div>';
                                }else{
                                  echo '<div class="requests-title">';
                                  echo '</div>';
                                  echo '<table class="table table-bordered">';
                                  echo '<thead>';
                                  echo '<tr>';
                                  echo '<th class="align-middle" scope="col">#</th>';
                                  echo '<th class="align-middle" scope="col">Name</th>';
                                  echo '<th class="align-middle" scope="col">Email</th>';
                                  echo '<th class="align-middle" scope="col">Phone</th>';
                                  echo '<th class="align-middle" scope="col">Message</th>';
                                  echo '<th class="align-middle" scope="col"></th>';
                                  echo '</tr>';
                                  echo '</thead>';
                                  echo '<tbody>';
                                  
                                  $count = 1;
                                  while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<form action="" method="post">';
                                    echo '<th class="align-middle" scope="row">'.$count.'</th>';
                                    echo '<td class="align-middle">'.openssl_decrypt($row['name'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']).'</td>';
                                    echo '<td class="align-middle">'.openssl_decrypt($row['email'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']).'</td>';
                                    echo '<td class="align-middle">'.openssl_decrypt($row['phone'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']).'</td>';
                                    echo '<td class="col-md-4 col-md-4-5">'.openssl_decrypt($row['message'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']).'</td>';
                                    echo '<td class="col-1">';
                                    echo '<center>';
                                    echo '<button name="remove_suggestion" class="btn btn-danger form-inline">';
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">';
                                    echo '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>';
                                    echo '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>';
                                    echo '</svg>';
                                    echo '</button>';
                                    echo '<center>';
                                    echo '</td>';

                                    // Hidden Input Forms.
                                    echo '<input type="hidden" name="suggestion_id" value='.$row['ID'].'>';
                                    echo '</form>';
                                    echo '</tr>';
                                  
                                    // Increment number of requests.
                                    $count++;
                                  }
                                  
                                  echo '</tbody>';
                                  echo '</table>';
                                }
                              ?>
                          </div>
                      </div>
                  </div>
              </main>
              <footer class="py-4 bg-light mt-auto">
                  <div class="container-fluid px-4">
                      <div class="d-flex align-items-center justify-content-between small">
                          <div class="text-muted">Copyright &copy; BLEM Banking 2022</div>
                          <div>
                              <a href="#">Privacy Policy</a>
                              &middot;
                              <a href="#">Terms &amp; Conditions</a>
                          </div>
                      </div>
                  </div>
              </footer>
          </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
      <script src="../../js/admin_dashboard.js"></script>
  </body>
</html>