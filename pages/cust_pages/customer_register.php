<?php
    include "../../lib/customer_register_confirm.php";

    // Register form is submitted, call registration
    // function in customer_register_confirm.
    if (isset($_POST["register_submit"])) {
        handleRegistration($db);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!-- Bootstrap CSS -->
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
        crossorigin="anonymous"
        />
        <link rel="stylesheet" href="../../styles/styles.css" />

        <title>Online Banking System</title>
    </head>
    
    <body>
        <!-- Status Message -->
        <?php 
            if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='text-align:center'>".$_SESSION['message']."</div>";
                $_SESSION['message'] = '';
            }
        ?>

        <!-- Register Form -->
        <div class="p-4">
            <div class="card login-card">
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <!--passes inputs to register_confirm.php to scripts-->
                    <form action="" method="post">

                        <!-- All Input Fields -->
                        <div class="form-group">
                            <label for="user">Account Type</label>
                            <select class="form-control" aria-label="Default select example" name="acc_type">
                                <option value="Savings">Savings</option>
                                <option value="Checkings">Checkings</option>
                            </select>
                        </div>

                        <!-- TODO: USE COOKIES TO STORE INFO WHEN INVALID FORM SUBMITTED TO STORE PREVIOUS INPUT -->
                        <div class="form-group">
                            <label for="user">Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="user" required />
                        </div>

                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="pass" required />
                        </div>

                        <div class="form-group">
                            <label for="cpass">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="conpass" required />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" required />
                        </div>

                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" name="fname" required />
                        </div>

                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lname" required/>
                        </div>

                        <div class="form-group">
                            <label for="street_address">Street Address</label>
                            <input type="text" class="form-control" placeholder="Street Address" name="stadd" required/>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" placeholder="City" name="city" required/>
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" placeholder="State" name="state" required/>
                        </div>

                        <div class="form-group">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" class="form-control" placeholder="Zip Code" name="zip" required/>
                        </div>

                        <div class="button-container">
                            <button type="submit" class="btn btn-primary" name="register_submit">
                            Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        


    </body>
</html>