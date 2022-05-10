<?php
    //includes file with db connection
    include "../../config.php";
    
    function handleAccountManage($db) {
        $user = $_POST['user'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
		$ssn = $_POST['ssn'];
		$phone = $_POST['phone'];
        
        $query = "SELECT * FROM `customer` WHERE `ID` = \"".$_SESSION['user_id']."\"";
		$result = $db->query($query);
		$row = $result->fetch_assoc();  
		$pass = $row['password'];
		$addr = $row['address'];
		
        if (!$user || !$fname || !$lname || !$email) {
			$_SESSION['registration_failed'] = 'invalid_input';
			$_SESSION['message'] = 'Registration info was not properly input. Please try again.';
			header('Location: ../cust_pages/customer_manage.php');
			return;
        }

		//gets id and username from current customers
		$query = 'SELECT * FROM `customer`';
		$results = $db->query($query);
		
		//gets the number of results
		$num_results = $results->num_rows;
	  
		//loops through all current customers
		for ($i = 0; $i < $num_results; $i++) {
			$row = $results->fetch_assoc();
			
			//compares current usernames with new username    
			if (openssl_encrypt($user, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']) == $row['username']) {
				//exits program is there is a match
				$_SESSION['registration_failed'] = 'usertaken';
				$_SESSION['message'] = 'Username already taken. Please try again.';
				return;
			}
		}
		
        // Encrypt data before storing.
        $new_user = openssl_encrypt((string)$user, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $new_fname = openssl_encrypt((string)$fname, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $new_lname = openssl_encrypt((string)$lname, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $new_email = openssl_encrypt((string)$email, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		$new_ssn = openssl_encrypt((string)$ssn, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		$new_phone = openssl_encrypt((string)$phone, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);



		//creates update query for db with user info
		$query = "UPDATE `customer` SET `username` =\"".$new_user."\", `password` =\"".$pass."\", `email` =\"".$new_email."\", `fname` =\"".$new_fname."\", `lname` =\"".$new_lname."\", `ssn` =\"".$new_ssn."\", `phone` =\"".$new_phone."\" WHERE `ID` = \"".$_SESSION['user_id']."\"";
		$db->query($query);
		
        header('Location: ../cust_pages/customer_manage.php');
    }
    
    function handleModifyAddress($db) {
    
        $stadd = trim($_POST['stadd']);
		$city = trim($_POST['city']);
		$state = trim($_POST['state']);
		$zip = trim($_POST['zip']);
		
			//concatenates address
		$address = $stadd.' '.$city.', '.$state.' '.$zip;
		
		$address = openssl_encrypt($address, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		
		$query = "UPDATE `customer` SET `address` =\"".$address."\" WHERE `ID`= \"".$_SESSION['user_id']."\"";
		$db->query($query);
		header('Location: ../cust_pages/customer_manage.php');
    }
    
?>