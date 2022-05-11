<?php
session_start();
if(!$_SESSION["admin"]){
	header("Location: ../") ; 
}
?>

<h1>Bienvenue dans le dark web</h1>

<h3>Revenir sur le clear web : <a href="../">Cliquez ici</a></h3>