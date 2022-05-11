<?php
    //includes file with db connection
    include "../../config.php";

    function handleTransfer($db) {
        $acc_num = $_POST['acc_num'];
        $recipient_acc = $_POST['recipient_acc'];
        $desc = $_POST['desc'];
        $amount = $_POST['amount'];

        // Retrieve Account Info.
        $query = "SELECT * FROM `account` WHERE `acc_number` = \"".$acc_num."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();

        // Decrypt balance. 
        $balance = (float)(openssl_decrypt($row['balance'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']));



        // Retrieve Customer Info.
        $query = "SELECT * FROM `customer` WHERE `ID` = \"".$_SESSION['user_id']."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $recip_name = $row['fname'];

        // Retrieve Date.
        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d h:i:sa");

        // Encrypt data before storing.
        $new_balance = openssl_encrypt((string)($balance - $amount), $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $acc_amount = openssl_encrypt((string)$amount, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $desc = openssl_encrypt($desc, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

        // Update Account Balance.
        $query = "UPDATE `account` SET `balance` = \"".$new_balance."\" WHERE `acc_number` = \"".$acc_num."\"";
        $db->query($query);

        // Store Transaction Record.
        $query = "INSERT INTO `transaction` VALUES 
        (NULL, '".$acc_num."', 'Withdraw', '".$desc."', '".$recip_name."', '".$acc_num."', '".$acc_amount."', '".$new_balance."', '".$date."')";
        $db->query($query);
        header('Location: ../cust_pages/customer_homepage.php');
    }

    function handleWithdraw($db) {
        $amount = trim($_POST['amount']);
        $acc_num = $_POST['acc_num'];
        $desc = $_POST['desc'];

        // Retrieve Account Info.
        $query = "SELECT * FROM `account` WHERE `acc_number` = \"".$acc_num."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();

        // Decrypt balance. 
        $balance = (float)(openssl_decrypt($row['balance'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']));

        // Validate Amount.
        if(!validWithdrawAmount($amount, $balance)){
            return;
        }

        // Retrieve Customer Info.
        $query = "SELECT * FROM `customer` WHERE `ID` = \"".$_SESSION['user_id']."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $recip_name = $row['fname'];

        // Retrieve Date.
        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d h:i:sa");

        // Encrypt data before storing.
        $new_balance = openssl_encrypt((string)($balance - $amount), $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $acc_amount = openssl_encrypt((string)$amount, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $desc = openssl_encrypt($desc, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);

        // Update Account Balance.
        $query = "UPDATE `account` SET `balance` = \"".$new_balance."\" WHERE `acc_number` = \"".$acc_num."\"";
        $db->query($query);

        // Store Transaction Record.
        $query = "INSERT INTO `transaction` VALUES 
        (NULL, '".$acc_num."', 'Withdraw', '".$desc."', '".$recip_name."', '".$acc_num."', '".$acc_amount."', '".$new_balance."', '".$date."')";
        $db->query($query);
        header('Location: ../cust_pages/customer_homepage.php');
        
    }

    function handleDeposit($db) {
        $amount = trim($_POST['amount']);
        $acc_num = $_POST['acc_num'];
        $desc = $_POST['desc'];

        // Retrieve Account Info.
        $query = "SELECT * FROM `account` WHERE `acc_number` = \"".$acc_num."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        
        // Decrypt balance. 
        $balance = (float)(openssl_decrypt($row['balance'], $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']));

        // Validate Amount.
        if(!validDepositAmount($amount)){
            return;
        }

        // Retrieve Customer Info.
        $query = "SELECT * FROM `customer` WHERE `ID` = \"".$_SESSION['user_id']."\"";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $recip_name = $row['fname'];

        // Retrieve Date.
        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d h:i:sa");

        // Encrypt data before storing.
        $new_balance = openssl_encrypt((string)($balance + $amount), $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $acc_amount = openssl_encrypt((string)$amount, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        $desc = openssl_encrypt($desc, $_SESSION['ciphering'], $_SESSION['key'], $_SESSION['options'], $_SESSION['encryption_iv']);
        
        // Update Account Balance.
        $query = "UPDATE `account` SET `balance`=\"".$new_balance."\" WHERE `acc_number`=\"".$acc_num."\"";
        $db->query($query);

        // Store Transaction Record.
        $query = "INSERT INTO `transaction` VALUES 
        (NULL, '".$acc_num."', 'Deposit', '".$desc."', '".$recip_name."', '".$acc_num."', '".$acc_amount."', '".$new_balance."', '".$date."')";
        $db->query($query);
        header('Location: ../cust_pages/customer_homepage.php');
    }

    function validWithdrawAmount($amount, $balance) {
        if($amount > $balance && $amount < 5){
            $_SESSION['message'] = 'Cannot withdraw from account with balance lower than $5.00';
            return false;
        }
        if($amount < 5){
            $_SESSION['message'] = 'All deposits and withdrawls must be made with more than $5.00';
            return false;
        }
        if($amount > $balance){
            $_SESSION['message'] = 'Withdraw amount exceeds account balance';
            return false;
        }
        if($amount > 1000000){
            $_SESSION['message'] = 'Cannot exceed more than $1,000,000 per Deposit/Withdrawl.';
            return false;
        }

        return true;
    }

    function validDepositAmount($amount) {
        if($amount < 5){
            $_SESSION['message'] = 'All deposits and withdrawls must be made with more than $5';
            return false;
        }
        if($amount > 1000000){
            $_SESSION['message'] = 'Cannot exceed more than $1,000,000 per Deposit/Withdrawl.';
            return false;
        }

        return true;
    }
?>