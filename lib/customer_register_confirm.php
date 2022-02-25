<?php 
	require_once "../config.php";

	function handleRegistration($db) {
		//takes input passed from form and assigns to variables
		$user = strtolower(trim($_POST['user']));
		$pass = trim($_POST['pass']);
		$conpass = trim($_POST['conpass']);
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
			header('Location: ../pages/customer_register.php');
		}
		
		//checks if password is at least 6 characters
		else if (strlen($pass) < 6) {
			$_SESSION['registration_failed'] = 'invalid_password';
			$_SESSION['message'] = 'Password must be at least 6 characters. Please try again.';
			header('Location: ../pages/customer_register.php');
		}
		
		//checks if password and confirm password inputs match
		else if ($pass != $conpass) {
			$_SESSION['registration_failed'] = 'pwdnotmatch';
			$_SESSION['message'] = 'Passwords do not match. Please try again.';
			header('Location: ../pages/customer_register.php');
		}
		
		//gets id and username from current customers
		$query = 'SELECT customerID, cUsername, cEmail FROM CUSTOMER';
		$results = $db->query($query);
		
		//gets the number of results
		$num_results = $results->num_rows;
		
		//generates a 6 digit random number for customer id
		$custid = mt_rand(100000, 999999);
		
		//adds slashes for any quotes in inputs
		if (!get_magic_quotes_gpc()) {
			$user = addslashes($user);
			$pass = addslashes($pass);
			$fname = addslashes($fname);
			$lname = addslashes($lname);
			$email = addslashes($email);
			$city = addslashes($city);
		}
		
		//concatenates address
		$address = $stadd.' '.$city.', '.$state.' '.$zip;
		
		//hashes password
		$pass = password_hash($pass, PASSWORD_DEFAULT);
	  
		//loops through all current customers
		for ($i = 0; $i < $num_results; $i++) {
			$row = $results->fetch_assoc();
			
			//compares current ids with new ids
			if ($custid == $row['customerID'])
				//creates a new random id if there is a match
				$custid = mt_rand(100000, 999999);
			
			//compares current usernames with new username    
			if ($user == $row['username']) {
				//exits program is there is a match
				$_SESSION['registration_failed'] = 'usertaken';
				$_SESSION['message'] = 'Username already taken. Please try again.';
				header('Location: ../pages/customer_register.php');
			}
			
			if ($email == $row['email']) {
				//exits program is there is a match
				$_SESSION['registration_failed'] = 'emailtaken';
				$_SESSION['message'] = 'Email already in use. Please try again.';
				header('Location: ../pages/customer_register.php');
			}
		}
		
		//converts customer id into string
		$custid = strval($custid);
		
		//creates insert query for db with user info
		$query = "INSERT INTO CUSTOMER VALUES 
		('".$custid."', '".$user."', '".$pass."', '".$email."', '".$fname."', '".$lname."', '".$address."')";
		
		//tries to insert user info into db
		$results = $db->query($query);
		
		//checks if insert was successful
		if ($results) {
			$_SESSION['regdone'] = true;
			header('Location: ../pages/cust_pages/customer_homepage.php');
			exit();
		}
		
		//checks if some other error has occurred
		else {
			$_SESSION['registration_failed'] = 'randerr';
			$_SESSION['message'] = 'An error has occurred. Please try again.';
			header('Location: ../pages/customer_register.php');
			exit();
		}
		
		//closes db connection
		$db->close();
	}
    
    
?>