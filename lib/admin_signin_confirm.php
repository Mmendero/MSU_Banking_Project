<?php
    //includes file with db connection
    include '../../config.php';

    function handleAdminSignIn($db) {
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
        $query = "SELECT * FROM admin WHERE username = '".$user."'";
        $result = $db->query($query);

        //checks if results were returned
        if ($result->num_rows == 0) {
            $_SESSION['login_failed'] = 'user_DNE';
            $_SESSION['message'] = 'User does not exist. Please try again.';
            return;
        }
        
        //gets associative array from result
        $row = $result->fetch_assoc();
        
        //compares password hashed saved with password entered; logs in and redirects to homepage if passwords match
        if ($pass == $row['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['admin'] = true;
            $_SESSION['user'] = $user;
            
            header('Location: ../admin_pages/admin_homepage.php');
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