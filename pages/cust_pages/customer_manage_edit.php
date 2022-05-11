<?php
include "../../lib/account_modify_confirm.php";

// Register form is submitted, call registration
// function in customer_register_confirm.
if (isset($_POST["update_submit"])) {
    handleAccountManage($db);
}

//creates query to get user info from CUSTOMER view
$query = "SELECT * FROM `customer` WHERE `ID` = \"" . $_SESSION['user_id'] . "\"";

//gets info from db
$results = $db->query($query);
$row = $results->fetch_assoc();

//creates variables from queried values
$user = openssl_decrypt($row['username'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
$email = openssl_decrypt($row['email'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
$Fname = openssl_decrypt($row['fname'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
$Lname = openssl_decrypt($row['lname'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
$ssn = openssl_decrypt($row['ssn'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
$phone = openssl_decrypt($row['phone'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
$address = openssl_decrypt($row['address'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

?>

<!DOCTYPE html>
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

        <title>Edit Account</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                <a class="nav-link active" href="customer_manage.php">Manage Account</a>
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
    <div class="manage-page">
        <section class="vh-200">
            <!-- Status Message -->
            <?php
            if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
                echo "<div class='alert alert-danger alert-dismissible show' role='alert' style='text-align:center'>" . $_SESSION['message'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                $_SESSION['message'] = '';
            }
            ?>
            <!-- Register Form -->
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Account Edit</h3>
                                <form action="" method="post">
                                    <!-- Row #2 -->
                                    <fieldset disabled>
                                        <div class="row">
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group">
                                                    <label class="form-label" for="user">Username</label>
                                                    <input type="text" name="user" id="user" class="form-control form-control-lg" value="<?php echo $user; ?>" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-1">
                                                <div class="form-group">
                                                    <label class="form-label" for="ssn">Social Security Number</label>
                                                    <input type="password" name="ssn" id="ssn" class="form-control form-control-lg" value="<?php echo $ssn; ?>" pattern="[0-9]{3}-[0-9]{2}-[0-9]{4}" placeholder="123-45-6789" required />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Row #3 -->
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="fname">First Name</label>
                                                <input type="text" name="fname" id="fname" value="<?php echo $Fname; ?>" class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="lname">Last Name</label>
                                                <input type="text" name="lname" id="lname" value="<?php echo $Lname; ?>" class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row #4 -->
                                    <div class="row">
                                        <div class="col-md-6 mb-1 pb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control form-control-lg" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-1 pb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="email">Phone</label>
                                                <input type="text" name="phone" id="text" value="<?php echo $phone; ?>" class="form-control form-control-lg" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex. 123-456-7890" required />
                                            </div>
                                        </div>

                                        <!-- Hidden Input -->
                                        <input type="hidden" name="user" value="<?php echo $user; ?>"/>
                                        <input type="hidden" name="ssn" value="<?php echo $ssn; ?>"/>

                                        <center>
                                            <button type="submit" class="btn btn-primary btn-lg" name="update_submit">
                                                Update
                                            </button>
                                        </center>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>