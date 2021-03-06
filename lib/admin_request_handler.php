<?php
    //includes file with db connection
    include '../../config.php';

    function handleRequestApproval($db) {
        //takes input passed from form and assigns to variables.
        $acc_type = $_POST['acc_type'];
        $user = $_POST['user'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
        $ssn = $_POST['ssn'];
        $phone = $_POST['phone'];
		$address = $_POST['address'];

        // Initialize message and unique ID's variables.
        $message = "";
        $cust_id = 0;
        $acc_num = 0;

        // Determine if this User already exists.
        $query = "SELECT * FROM `customer` WHERE `username`=\"".$user."\"";
        $results = $db->query($query);

        // If this is a new user, create a new
        // record in Customer table.
        if ($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $cust_id = $row['ID'];
        }
        else{
            // Validate that CustomerID is unique.
            $cust_id = mt_rand();
            $query = "SELECT * FROM `customer` WHERE `ID`=\"".$cust_id."\"";
            while ($db->query($query)->num_rows > 0){
                $cust_id = mt_rand();
            }

            // Insert into Customer Database.
            $query = "INSERT INTO `customer` VALUES ('".$cust_id."','".$user."', '".$pass."', '".$email."', '".$fname."', '".$lname."', '".$ssn."', '".$phone."', '".$address."')";
            if ($db->query($query) === FALSE) {
                $message = "Something Went Wrong :(" . $db->error;
                $_SESSION['request_error'] = TRUE;
            }
        }

        // Validate that Account number is unique.
        $acc_num = mt_rand(10000000,99999999);
        $query = "SELECT * FROM `account` WHERE `acc_number`='".$acc_num."'";
        while ($db->query($query)->num_rows > 0){
            $acc_num = mt_rand(10000000,99999999);
        }

        // Encrypt Account Values.
        $balance= openssl_encrypt("0", $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $pending = openssl_encrypt("0", $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

        // Insert into Account Database.
        $query = "INSERT INTO `account` VALUES ('".$acc_num."','".$cust_id."','".$acc_type."', '".$balance."', '".$pending."')";
		if ($db->query($query) === TRUE) {
            $message = "Account Request Approved";
        } else {
            $message = "Something Went Wrong :( " . $db->error;
            $_SESSION['request_error'] = TRUE;
        }
        
        // Remove existing request.
        removeRequest($db, $message);
    }

    function removeRequest($db, $message) {
        //takes input passed from form and assigns to variables
        $acc_id = $_POST['acc_id'];

        $query = "DELETE FROM `acc_request` WHERE `ID`='". $acc_id."'";
        if ($db->query($query) === TRUE) {
            $_SESSION['message'] = $message;
        } else {
            $_SESSION['message'] = "Something Went Wrong :(" . $db->error;
            $_SESSION['request_error'] = TRUE;
        }
    }

    function addAccount($db){
        $acc_type = $_POST['acc_type'];
        $user = $_POST['username'];
        $ssn = $_POST['ssn'];
        $phone = $_POST['phone'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];

        //queries db for username entered
        $query = "SELECT * FROM `customer` WHERE username = '".$user."'";
        $result = $db->query($query)->fetch_assoc();

        // Validate SSN/Password.
        if(openssl_encrypt($ssn, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']) == $result['ssn'] || !password_verify($pass, $result['password'])) {
            $_SESSION['message'] = 'Invalid Credentials. Please try again.';
            return;
        }

        // Hash Password.
		$pass = password_hash($pass, PASSWORD_DEFAULT);

        // creates insert query for db with user info
		$query = "INSERT INTO `acc_request` VALUES 
		(NULL, '".$acc_type."', '".$user."', '".$pass."', '".$email."', '".$fname."', '".$lname."', '".$ssn."', '".$phone."', '".$address."')";
		
		// checks if insert was successful
		if ($db->query($query)) {
			$_SESSION['message'] = 'Account Request Submitted!';
            $_SESSION['newAcc'] = true;
			return;
		}
		// checks if some other error has occurred
		else {
			$_SESSION['message'] = 'An error has occurred. Please try again later.';
			return;
		}

    }

    function removeSuggestion($db, $message) {
        //takes input passed from form and assigns to variables
        $suggestion_id = $_POST['suggestion_id'];

        $query = "DELETE FROM `suggestion` WHERE `ID`='". $suggestion_id."'";
        if ($db->query($query) === TRUE) {
            $_SESSION['message'] = $message;
            $_SESSION['request_error'] = FALSE;
        } else {
            $_SESSION['message'] = "Something Went Wrong :(" . $db->error;
            $_SESSION['request_error'] = TRUE;
        }
    }

    function removeCustomer($db, $message) {
        //takes input passed from form and assigns to variables
        $user_id = $_POST['user_id'];

        $query = "DELETE FROM `customer` WHERE `ID` = '". $user_id."'";
        if ($db->query($query) === TRUE) {
            $_SESSION['message'] = $message;
            $_SESSION['request_error'] = FALSE;
        } else {
            $_SESSION['message'] = "Something Went Wrong :(" . $db->error;
            $_SESSION['request_error'] = TRUE;
        }
    }
?>