<?php
    //Check login session & userlevel
    session_start();
    $account = (object) $_SESSION['SESSION-userAccount'] ?? null;
    if($account == null){
        header("Location: ../login.php");
        exit();
    }else if($account->level != 'Admin' && $account->level != 'Officer'){
        header("Location: ../login.php");
        exit();
    }

	//Include database connection
	require_once("../data/connect.php");
?>