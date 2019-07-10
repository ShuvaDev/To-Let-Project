<?php
    if(isset($_GET['logout']))
    {
        session_start();
        unset($_SESSION['login_user']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        header("Location: index.php");
    }else{
        header("Location: 404.php");
    }

?>