<?php
    //includes file with db connection
    include '../../config.php';

    function handleSignIn($db) {
        //takes input passed from form and assigns to variables
        $user = strtolower(trim($_POST['user']));
        $pass = trim($_POST['password']);
        
        //informs user if not all inputs are entered and exits
        if (!$user || !$pass) {
            $_SESSION['login_failed'] = 'bad_input';
            $_SESSION['message'] = 'Log in info was not properly input. Please try again.';
            return;
        }
        
        //queries db for username entered
        $query = "SELECT password, fname FROM CUSTOMER WHERE username = '".$user."'";
        $result = $db->query($query);

        //checks if results were returned
        if ($result->num_rows == 0) {
            $_SESSION['login_failed'] = 'user_DNE';
            $_SESSION['message'] = 'Username does not exist. Please try again.';
            return;
        }
        
        //gets associative array from result
        $row = $result->fetch_assoc();
        
        //compares password hashed saved with password entered; logs in and redirects to homepage if passwords match
        if (password_verify($pass, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['name'] = $row['fname'];
            
            
            header('Location: ../cust_pages/customer_homepage.php');
            return;
        }
        //if password is wrong, returns to login page
        else {
            $_SESSION['login_failed'] = 'wrong_password';
            $_SESSION['message'] = 'Incorrect password. Please try again.';

            return;
        }
    }
    
    

?>