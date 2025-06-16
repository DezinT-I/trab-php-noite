<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?> session_start();
    unset($_SESSION);
    session_destroy();
    header('location:index.php');
?>