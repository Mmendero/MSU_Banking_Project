<?php
    //includes file with db connection
    include "../../config.php";

    function handleWithdraw($db) {
        $amount = 0;
        $amount = trim($_POST['amount']);

        $query = "UPDATE account SET balance = balance - '".$amount."' WHERE account_number = 3";
        mysqli_query($db, $query);
    }

    function handleDeposit($db) {
        $amount = trim($_POST['amount']);

        $query = "UPDATE account SET balance = balance + '".$amount."' WHERE account_number = 3";
        mysqli_query($db, $query);
    }
?>