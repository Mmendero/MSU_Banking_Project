<?php 
	include "../../config.php";

	function handleRegistration($db) {
		//takes input passed from form and assigns to variables
		$acc_type = trim($_POST['acc_type']);
		$user = strtolower(trim($_POST['user']));
		$ssn = trim($_POST['ssn']);
		$phone = trim($_POST['phone']);
		$pass = trim($_POST['pass']);
		$conpass = trim($_POST['con_pass']);
		$email = trim($_POST['email']);
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$stadd = trim($_POST['stadd']);
		$city = trim($_POST['city']);
		$state = trim($_POST['state']);
		$zip = trim($_POST['zip']);
		
		//checks if all inputs have been passed
		if (!$user || !$pass || !$conpass || !$fname || !$lname || !$email || !$stadd || !$city || !$state || !$zip) {
			$_SESSION['registration_failed'] = 'invalid_input';
			$_SESSION['message'] = 'Registration info was not properly input. Please try again.';
			return;
		}
		
		//checks if password is at least 6 characters
		else if (strlen($pass) < 6) {
			$_SESSION['registration_failed'] = 'invalid_password';
			$_SESSION['message'] = 'Password must be at least 6 characters. Please try again.';
			return;
		}
		
		//checks if password and confirm password inputs match
		else if ($pass != $conpass) {
			$_SESSION['registration_failed'] = 'pwdnotmatch';
			$_SESSION['message'] = 'Passwords do not match. Please try again.';
			return;
		}
		
		//gets id and username from current customers
		$query = 'SELECT * FROM `customer`';
		$results = $db->query($query);
		
		//gets the number of results
		$num_results = $results->num_rows;
		
		//concatenates address
		$address = $stadd.' '.$city.', '.$state.' '.$zip;
		
		//hashes password
		$pass = password_hash($pass, PASSWORD_DEFAULT);
	  
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
			
			if (openssl_encrypt($email, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']) == $row['email']) {
				//exits program is there is a match
				$_SESSION['registration_failed'] = 'emailtaken';
				$_SESSION['message'] = 'Email already in use. Please try again.';
				return;
			}
		}

		// Passed Validation, Encrypt fields before storing.
		$user = openssl_encrypt($user, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $email = openssl_encrypt($email, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $fname = openssl_encrypt($fname, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $lname = openssl_encrypt($lname, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		$ssn = openssl_encrypt($ssn, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		$phone = openssl_encrypt($phone, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $address = openssl_encrypt($address, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		
		//creates insert query for db with user info
		$query = "INSERT INTO `acc_request` VALUES 
		(NULL, '".$acc_type."', '".$user."', '".$pass."', '".$email."', '".$fname."', '".$lname."', '".$ssn."', '".$phone."', '".$address."')";
		
		//checks if insert was successful
		if ($db->query($query)) {
			$_SESSION['regdone'] = true;
			$_SESSION['message'] = 'Account Registration Request has been Submitted! Please wait for an admin to approve your account creation.';
			header('Location: ../cust_pages/customer_signin.php');
			exit();
		}
		
		//checks if some other error has occurred
		else {
			$_SESSION['registration_failed'] = 'randerr';
			$_SESSION['message'] = 'An error has occurred. Please try again.';
			return;
		}
		
		//closes db connection
		$db->close();
	}
    
    
?>