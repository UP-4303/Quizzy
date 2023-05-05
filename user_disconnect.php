<?php
    session_start(); # supprime la session
    unset($_SESSION["id"]);
    unset($_SESSION["session"]);
    unset($_SESSION["admin"]);
    header("Location: index.php");
	# tu dum !
?> 