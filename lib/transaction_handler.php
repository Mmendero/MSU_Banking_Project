<?php
    //includes file with db connection
    include "../../config.php";

    function handleWithdraw($db) {
        $amount = trim($_POST['amount']);

        $query = "UPDATE account SET balance = balance - '".$amount."' WHERE cust_id = '".$_SESSION['user_id']."'";
        mysqli_query($db, $query);

        $query = "SELECT * FROM CUSTOMER WHERE ID = '".$_SESSION['user_id']."'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $recip_name = $row['fname'];


        $query = "SELECT * FROM account WHERE cust_id = '".$_SESSION['user_id']."'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $acc_number = $row['acc_number'];
        $recip_acc = $row['acc_number'];
        $balance = $row['balance'];

        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d");

        $query = "INSERT INTO transaction VALUES 
        (NULL, '".$acc_number."', 'Debit', 'Withdraw', '".$recip_name."', '".$recip_acc."', '".$amount."', '".$balance."', '".$date."')";
        mysqli_query($db, $query);

    }

    function handleDeposit($db) {
        $amount = trim($_POST['amount']);

        $query = "UPDATE account SET balance = balance + '".$amount."' WHERE cust_id = '".$_SESSION['user_id']."'";
        mysqli_query($db, $query);


        $query = "SELECT * FROM CUSTOMER WHERE ID = '".$_SESSION['user_id']."'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $recip_name = $row['fname'];


        $query = "SELECT * FROM account WHERE cust_id = '".$_SESSION['user_id']."'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $acc_number = $row['acc_number'];
        $recip_acc = $row['acc_number'];
        $balance = $row['balance'];

        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d");

        $query = "INSERT INTO transaction VALUES 
        (NULL, '".$acc_number."', 'Debit', 'Deposit', '".$recip_name."', '".$recip_acc."', '".$amount."', '".$balance."', '".$date."')";
        mysqli_query($db, $query);
    }
?>