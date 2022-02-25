<?php
    require_once "config.php";
    
    //notifies user if not everything was input
    if ($_SESSION['registration_failed'] == 'invalid_input') {
        $notice = 'Registration info was not properly input. Please try again.';
        
        $_SESSION['registration_failed'] = '';
    }
    
    //notifies user if password is not long enough
    else if ($_SESSION['registration_failed'] == 'invalid_password') {
        $notice = 'Password must be at least 6 characters. Please try again.';
        
        $_SESSION['registration_failed'] = '';
    }
    
    //notifies user if passwords do not match
    else if ($_SESSION['registration_failed'] == 'pwdnotmatch') {
        $notice = 'Passwords do not match. Please try again.';
        
        $_SESSION['registration_failed'] = '';
    }
    
    //notifies user if username is already taken
    else if ($_SESSION['registration_failed'] == 'usertaken') {
        $notice = 'Username already taken. Please try again.';
        
        $_SESSION['registration_failed'] = '';
    }
    
    else if ($_SESSION['registration_failed'] == 'emailtaken') {
        $notice = 'Email already in use. Please try again.';
        
        $_SESSION['registration_failed'] = '';
    }
    
    //notifies user if some other error occurs
    else if ($_SESSION['registration_failed'] == 'randerr') {
        $notice = 'An error has occurred. Please try again.';
        
        $_SESSION['registration_failed'] = '';
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login.css">
        <title>Online Banking System</title>
    </head>
    
    <!--register.php takes a new user's username, password, first name, middle name, last name, street address,
        city, state, and zip code-->
    <body>
        <!--outputs notice for user-->
        <div style='color: red;'><?php echo $notice; ?></div>
        
            <div id="log-in">
            
            <!--passes inputs to register_confirm.php to scripts-->
            <form action='scripts/customer_register_confirm.html' method='post'>
                <div class="log-in">
                    <center>
                        <h1>REGISTER</h1>
                        <p>Please fill in the information below:</p>
                        <div>
                            <!--input for username-->
                            <input type="text" placeholder="Username" name="user" required />
                        </div>
                        <div>
                            <!--input for password-->
                            <input type="password" placeholder="Password" name="pass" required />
                        </div>
                        <center>
                        <div>
                            <!--input for confirm password-->
                            <input type="password" placeholder="Confirm Password" name="conpass" required />
                        </div>
                        <div>
                            <!--input for email-->
                            <input type="email" placeholder="Email" name="email" required />
                        </div>
                        <div>
                            <!--input for first name-->
                            <input type="text" placeholder="First Name" name="fname" rquired />
                        </div>
                        <div>
                            <!--input for last name-->
                            <input type="text" placeholder="Last Name" name="lname" required/>
                        </div>
                        <div>
                            <!--input for street address-->
                            <input type="text" placeholder="Street Address" name="stadd" required/>
                        </div>
                        <div>
                            <!--input for city-->
                            <input type="text" placeholder="City" name="city" required/>
                        </div>
                        <div>
                            <!--input for state-->
                            <input type="text" placeholder="State" name="state" required/>
                        </div>
                        <div>
                            <!--input for zip code-->
                            <input type="text" placeholder="Zip Code" name="zip" required/>
                        </div>
                            <!--submit inputs-->
                        <div>
                            <input type="submit" value="CREATE MY ACCOUNT" name="submit" id="button_submit" /> <input type="reset" value="CLEAR" />
                        </div>
                    </center>
                </div>
            </form>
            
            <!--other access links-->
            <div>
                <center>
                    Already have an account? <a class="link" href="customer_login.html">Log In</a> <br>
                </center>
            </div>
        </div>
    </body>
</html>