<?php
    //gets session info
    session_start();

    // Creates new database object
    // --Update with your own local DB creds--
    @ $db = new mysqli('localhost', 'sarmieb1_obs_admin', 'CSIT415OBS', 'sarmieb1_OnlineBankingSystem');
    
    //checks connection to database
    if (mysqli_connect_errno()) {
        echo 'Error: could not connect to database. Please try again later.';
        exit();
    }
?>