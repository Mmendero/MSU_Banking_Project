<?php
    //includes file with db connection
    include "config.php";

    function submitSuggestion($db) {
        $name = openssl_encrypt($_POST['name'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $email = openssl_encrypt($_POST['email'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $phone = openssl_encrypt(strval($_POST['phone']), $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $message = openssl_encrypt($_POST['message'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

        $query = "INSERT INTO `suggestion` VALUES (NULL, '".$name."', '".$email."', '".$phone."', '".$message."')";
        
        //checks if insert was successful
		if ($db->query($query)) {
			$_SESSION['sub_done'] = true;
			$_SESSION['message'] = 'Suggestion Submitted Successfully!';
		}
		
		//checks if some other error has occurred
		else {
			$_SESSION['sub_done'] = false;
			$_SESSION['message'] = 'An error has occurred. Please try again.';
		}
    }

?>