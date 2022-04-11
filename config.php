<?php
    //gets session info
    session_start();

    // Creates new database object
    // --Update with your own local DB creds--
    $db = new mysqli('localhost', 'menderm1_G6_Admin', 'CSIT415OBS', 'menderm1_MSU_Banking_App');
    
    // Checks connection to database
    if (mysqli_connect_errno()) {
        echo 'Error: could not connect to database. Please try again later.';
        exit();
    }

?>