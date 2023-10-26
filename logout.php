<?php
    session_start();
    unset($_SESSION['user_login']);
    session_destroy();
    setcookie('user_login',$row['uid'],time()-3600,'/');
    header("location: index.php");
?>