<?php
include "../../lib/account_modify_confirm.php";

// Register form is submitted, call registration
// function in customer_register_confirm.
if (isset($_POST["register_submit"])) {
    handleModifyAddress($db);
}
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

        <title>Edit Address</title>
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
        
        <div class="register-page">
            <section class="vh-200">
                <!-- Status Message -->
                <?php 
                    if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
                        echo "<div class='alert alert-danger alert-dismissible show' role='alert' style='text-align:center'>".$_SESSION['message']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                        $_SESSION['message'] = '';
                    }
                ?>
                <!-- Register Form -->
                <div class="container py-5 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-7">
                            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                <div class="card-body p-4 p-md-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Update Address</h3>
                                    <form action="" method="post">

                                        <!-- Row #1 -->

                                        <div class="row">
                                            <div class="col-md-12 mb-2 pb-2">
                                                <div class="col-12">
                                                    <label for="stadd" class="form-label">Address</label>
                                                    <input type="text" name="stadd" id="stadd" class="form-control form-control-lg" required/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row #2 -->
                                        <div class="row">
                                            <div class="col-md-12 mb-2 pb-2">
                                                <div class="col-md-7">
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
                                                    <input type="text" name="zip" class="form-control form-control-lg" id="zip" pattern="[0-9]{5}" placeholder="01234" required />
                                                </div>
                                            </div>
                                        </div>

                                        <center>
                                        <button type="submit" class="btn btn-primary btn-lg" name="register_submit">
                                        Register
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