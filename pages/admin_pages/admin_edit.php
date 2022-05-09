<?php
include '../../config.php';

// Logout Function
if (isset($_POST["logout"])) {
    $_SESSION['loggedin'] == false;
    header('Location: ../admin_pages/admin_signin.php');
}

// Validate Admin Login.
if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) || !$_SESSION['admin']) {
    $_SESSION['loggedin'] = false;
    header('Location: ../admin_pages/admin_signin.php');
}
?>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../../styles/admin_styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <title>Admin User Dashboard</title>
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
                <!-- Admin Sidennav Bar-->
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
        <!-- Page Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Overview</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Edit User
                        </div>
                        <div class="card-body">
                            <div class="container py-5 h-100">
                                <div class="row justify-content-center align-items-center h-100">
                                    <div class="col-12 col-lg-9 col-xl-11">
                                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                            <div class="card-body p-4 p-md-5">
                                                <form action="" method="post">
                                                    <!-- Row #2 -->
                                                    <fieldset disabled>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-1">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="user">Username</label>
                                                                    <input type="text" name="user" id="user" class="form-control form-control-lg" required />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mb-1">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ssn">Social Security Number</label>
                                                                    <input type="text" name="ssn" id="ssn" class="form-control form-control-lg" pattern="[0-9]{3}-[0-9]{2}-[0-9]{4}" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <!-- Row #3 -->
                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="pass">Password</label>
                                                                <input type="password" name="pass" id="pass" class="form-control form-control-lg" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="con_pass">Confirm Password</label>
                                                                <input type="password" name="con_pass" id="con_pass" class="form-control form-control-lg" required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Row #4 -->
                                                    <div class="row">
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="fname">First Name</label>
                                                                <input type="text" name="fname" id="fname" class="form-control form-control-lg" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="lname">Last Name</label>
                                                                <input type="text" name="lname" id="lname" class="form-control form-control-lg" required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Row #5 -->
                                                    <div class="row">
                                                        <div class="col-md-6 mb-1 pb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email">Email</label>
                                                                <input type="email" name="email" id="email" class="form-control form-control-lg" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-1 pb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="phone">Phone Number</label>
                                                                <input type="tel" name="phone" id="phone" class="form-control form-control-lg" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Row #6 -->
                                                    <div class="row">
                                                        <div class="col-md-12 mb-2 pb-2">
                                                            <div class="col-12">
                                                                <label for="stadd" class="form-label">Address</label>
                                                                <input type="text" name="stadd" id="stadd" class="form-control form-control-lg" required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Row #7 -->
                                                    <div class="row">
                                                        <div class="col-md-7 mb-2 pb-2">
                                                            <label for="city" class="form-label">City</label>
                                                            <input type="text" name="city" class="form-control form-control-lg" id="city" required />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="state" class="form-label">State</label>
                                                            <select name="state" type="text" class="form-select form-select-lg" id="state" required>
                                                                <option value="AL">AL</option>
                                                                <option value="AK">AK</option>
                                                                <option value="AZ">AZ</option>
                                                                <option value="AR">AR</option>
                                                                <option value="CA">CA</option>
                                                                <option value="CO">CO</option>
                                                                <option value="CT">CT</option>
                                                                <option value="DE">DE</option>
                                                                <option value="DC">DC</option>
                                                                <option value="FL">FL</option>
                                                                <option value="GA">GA</option>
                                                                <option value="HI">HI</option>
                                                                <option value="ID">ID</option>
                                                                <option value="IL">IL</option>
                                                                <option value="IN">IN</option>
                                                                <option value="IA">IA</option>
                                                                <option value="KS">KS</option>
                                                                <option value="KY">KY</option>
                                                                <option value="LA">LA</option>
                                                                <option value="ME">ME</option>
                                                                <option value="MD">MD</option>
                                                                <option value="MA">MA</option>
                                                                <option value="MI">MI</option>
                                                                <option value="MN">MN</option>
                                                                <option value="MS">MS</option>
                                                                <option value="MO">MO</option>
                                                                <option value="MT">MT</option>
                                                                <option value="NE">NE</option>
                                                                <option value="NV">NV</option>
                                                                <option value="NH">NH</option>
                                                                <option value="NJ">NJ</option>
                                                                <option value="NM">NM</option>
                                                                <option value="NY">NY</option>
                                                                <option value="NC">NC</option>
                                                                <option value="ND">ND</option>
                                                                <option value="OH">OH</option>
                                                                <option value="OK">OK</option>
                                                                <option value="OR">OR</option>
                                                                <option value="PA">PA</option>
                                                                <option value="RI">RI</option>
                                                                <option value="SC">SC</option>
                                                                <option value="SD">SD</option>
                                                                <option value="TN">TN</option>
                                                                <option value="TX">TX</option>
                                                                <option value="UT">UT</option>
                                                                <option value="VT">VT</option>
                                                                <option value="VA">VA</option>
                                                                <option value="WA">WA</option>
                                                                <option value="WV">WV</option>
                                                                <option value="WI">WI</option>
                                                                <option value="WY">WY</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="zip" class="form-label">Zip</label>
                                                            <input type="text" name="zip" class="form-control form-control-lg" id="zip" pattern="[0-9]{5}" required />
                                                        </div>
                                                    </div>

                                                    <center>
                                                        <button type="submit" class="btn btn-primary btn-lg" name="register_submit">
                                                            Update
                                                        </button>
                                                    </center>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <!-- Necessary Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../../js/admin_dashboard.js"></script>
</body>

</html>