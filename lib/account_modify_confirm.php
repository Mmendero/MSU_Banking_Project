<?php
    //includes file with db connection
    include "../../config.php";
    
    function handleAccountManage($db) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
		$ssn = $_POST['ssn'];
		$phone = $_POST['phone'];
        
        $query = "SELECT * FROM `customer` WHERE `ID` = \"".$_SESSION['user_id']."\"";
		$result = $db->query($query);
		$row = $result->fetch_assoc();  
		
        // Encrypt data before storing.
        $new_fname = openssl_encrypt((string)$fname, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $new_lname = openssl_encrypt((string)$lname, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $new_email = openssl_encrypt((string)$email, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		$new_ssn = openssl_encrypt((string)$ssn, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		$new_phone = openssl_encrypt((string)$phone, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

		// Creates update query for db with user info
		$query = "UPDATE `customer` SET `email` ='".$new_email."', `fname` ='".$new_fname."', `lname` ='".$new_lname."', `ssn` ='".$new_ssn."', `phone` ='".$new_phone."' WHERE `ID` = '".$_SESSION['user_id']."'";
		if ($db->query($query)) {
			$_SESSION['message'] = 'Account Successfully Editted!';
			header('Location: ../cust_pages/customer_manage.php');
			return;
		}
		else {
			$_SESSION['message'] = 'An error has occurred. Please try again.';
			return;
		}
        
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