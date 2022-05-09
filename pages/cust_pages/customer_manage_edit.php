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
$address = openssl_decrypt($row['address'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/styles.css" />


    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />

    <title>Online Banking System</title>
</head>

<body>
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
                                                    <input type="text" name="ssn" id="ssn" class="form-control form-control-lg" pattern="[0-9]{3}-[0-9]{2}-[0-9]{4}" placeholder="123-45-6789" value="<?php echo $ssn; ?>" required />
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

</html>