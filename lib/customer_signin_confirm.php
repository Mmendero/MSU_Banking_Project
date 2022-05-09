<?php
    //includes file with db connection
    include '../../config.php';

    class SignIn {
        private $db;
        private $user;
        private $pass;

        function __construct($u=null, $p=null) {
            $this->db = new mysqli('localhost', 'menderm1_G6_Admin', 'CSIT415OBS', 'menderm1_MSU_Banking_App');
            if ($u == null && $p == null){
                $this->user = strtolower(trim($_POST['user']));;
                $this->pass = trim($_POST['password']);
                
            }
            else{
                $this->user = $u;
                $this->pass = $p;
            }
            
        }

        public function handleSignIn($db) {


            //informs user if not all inputs are entered and exits
            if (!$this->user || !$this->pass) {
                $_SESSION['login_failed'] = 'bad_input';
                $_SESSION['message'] = 'Login info was not properly input. Please try again.';
                return;
            }
            
            //queries db for username entered
            $query = "SELECT * FROM `customer` WHERE `username` = \"".openssl_encrypt($this->user, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv'])."\"";
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
            if (password_verify($this->pass, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $row['username'];
                $_SESSION['user_id'] = $row['ID'];
                
                header('Location: ../cust_pages/customer_homepage.php');
                return;
            }
            //if password is wrong, returns to login page
            else {
                $_SESSION['login_failed'] = 'wrong_password';
                $_SESSION['message'] = 'Incorrect password. Please try again.';
    
                return "wrong pass";
            }
        }
    }
    
?>