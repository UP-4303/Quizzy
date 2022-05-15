<?php
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["session"]);
    unset($_SESSION["admin"]);
    header("Location: index.php");
?>