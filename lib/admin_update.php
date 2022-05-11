<?php
    //includes file with db connection
    include "../../config.php";
    
    function handleAdminAccountManage($db) {
		$id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
		$ssn = $_POST['ssn'];
		$phone = $_POST['phone'];
		
		$query = "SELECT * FROM `customer` WHERE `ID` = '".$ID."'";
		$result = $db->query($query);
		$row = $result->fetch_assoc();  

        // Encrypt data before storing.
        $new_fname = openssl_encrypt((string)$fname, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $new_lname = openssl_encrypt((string)$lname, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $new_email = openssl_encrypt((string)$email, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		$new_ssn = openssl_encrypt((string)$ssn, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
		$new_phone = openssl_encrypt((string)$phone, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

		// Creates update query for db with user info
		$query = "UPDATE `customer` SET `email` ='".$new_email."', `fname` ='".$new_fname."', `lname` ='".$new_lname."', `ssn` ='".$new_ssn."', `phone` ='".$new_phone."' WHERE `ID` = '".$id."'";
		if ($db->query($query)) {
			$_SESSION['message'] = 'Account Successfully Editted!';
			header('Location: ../admin_pages/admin_manage.php');
			return;
		}
		else {
			$_SESSION['message'] = 'An error has occurred. Please try again.';
			return;
		}
        
    }
?>