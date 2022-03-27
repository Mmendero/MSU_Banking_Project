<?php
    //includes file with db connection
    include '../../config.php';

    function handleRequestApproval($db) {
        //takes input passed from form and assigns to variables
        $acc_id = $_POST['acc_id'];
        $acc_type = $_POST['acc_type'];
        $user = $_POST['user'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];

        // Generates a 6 digit random number for customer ID.
		$custid = mt_rand(100000, 999999);

        // Status Message.
        $message = "";
		
		// Insert into Customer Database.
        $query = "INSERT INTO customer VALUES ('".$acc_id."', '".$acc_type."', '".$user."', '".$pass."', '".$email."', '".$fname."', '".$lname."', '".$address."')";
		if ($db->query($query) === FALSE) {
            $message = "Something Went Wrong :(" . $db->error;
            $_SESSION['request_error'] = TRUE;
        }

        // Insert into Account Database.
        $query = "INSERT INTO account VALUES ('".$acc_id."', '".$acc_type."', '')";
		if ($db->query($query) === TRUE) {
            $message = "Account Request Approved";
        } else {
            $message = "Something Went Wrong :(" . $db->error;
            $_SESSION['request_error'] = TRUE;
        }

        // Remove existing request.
        removeRequest($db, $message);
    }

    function removeRequest($db, $message) {
        //takes input passed from form and assigns to variables
        $acc_id = $_POST['acc_id'];

        $query = "DELETE FROM acc_request WHERE ID='". $acc_id."'";
        if ($db->query($query) === TRUE) {
            $_SESSION['message'] = $message;
        } else {
            $_SESSION['message'] = "Something Went Wrong :(" . $db->error;
            $_SESSION['request_error'] = TRUE;
        }
    }
    
    

?>