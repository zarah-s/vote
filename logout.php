<?php 

    session_start();

    if(!$_SESSION['id']){
        header("Location: login.php");
    }else{
        $_SESSION['id'] = null;

        session_unset();

        session_destroy();

        header('Location: login.php');


    }




?>