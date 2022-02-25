<?php
    include "../lib/customer_register_confirm.php";

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
        <link rel="stylesheet" href="../styles/styles.css" />

        <title>Online Banking System</title>
    </head>
    
    <!--register.php takes a new user's username, password, first name, middle name, last name, street address,
        city, state, and zip code-->
    <body>
        <!--outputs notice for user-->
        <?php 
            if (isset($_SESSION['message'])){
            echo "<p class='message'>".$_SESSION['message']."</p>";
            $_SESSION['message'] = '';
            }
        ?>

        <!--passes inputs to register_confirm.php to scripts-->
        <form action='' method='post'>
            <div class="log-in">
                <center>
                    <h1>REGISTER</h1>
                    <p>Please fill in the information below:</p>

                    <!--input for username-->
                    <input type="text" placeholder="Username" name="user" required />

                    <!--input for password-->
                    <input type="password" placeholder="Password" name="pass" required />

                    <!--input for confirm password-->
                    <input type="password" placeholder="Confirm Password" name="conpass" required />

                    <!--input for email-->
                    <input type="email" placeholder="Email" name="email" required />

                    <!--input for first name-->
                    <input type="text" placeholder="First Name" name="fname" rquired />

                    <!--input for last name-->
                    <input type="text" placeholder="Last Name" name="lname" required/>

                    <!--input for street address-->
                    <input type="text" placeholder="Street Address" name="stadd" required/>

                    <!--input for city-->
                    <input type="text" placeholder="City" name="city" required/>

                    <!--input for state-->
                    <input type="text" placeholder="State" name="state" required/>

                    <!--input for zip code-->
                    <input type="text" placeholder="Zip Code" name="zip" required/>


                    <!--submit inputs-->
                    <input type="submit" value="CREATE MY ACCOUNT" name="register_submit" id="button_submit" /> <input type="reset" value="CLEAR" />
                </center>
            </div>
        </form>
            
        <!--other access links-->
        <center>
            Already have an account? <a class="link" href="customer_signin.php">Log In</a> <br>
        </center>
    </body>
</html>