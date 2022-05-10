<?php
    //includes db connection
    include "../../config.php";
    
    //assigns value passed to variable
    $ID = $_POST['user_id'];
    
    // //deletes entry of employee with passed id
    $query = "DELETE * FROM `customer` WHERE username = '".$user."'";
    $result = $db->query($query)->fetch_assoc();
    
    if ($db->query($query)) {
        $_SESSION['regdone'] = true;
        $_SESSION['message'] = 'Deleted customer.';
        header('Location: ../admin_pages/account_requests.php');
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
// ?>