<?php
session_start();
if(!$_SESSION["admin"]){
	header("Location: ../") ; 
}

include_once("../db/db_connect.php") ;
include_once("../crud/users.crud.php") ;
include_once("../crud/quizz.crud.php") ;

if(isset($_POST["ban_user"]) and $_POST["ban_user"] !== "") {
	if(filter_var($_POST["ban_user"], FILTER_VALIDATE_EMAIL)){
		$sql = "DELETE FROM `users` WHERE `email`='".$_POST['ban_user']."'" ;
		$req = "SELECT * FROM `users` WHERE `email`='".$_POST['ban_user']."'" ;
		if($ban_user = mysqli_query($conn, $req)) {
			$ban_user = mysqli_fetch_assoc($ban_user) ;
		}
		mysqli_query($conn, $sql) ;
		echo "<h3>L'utilisateur qui a pour email ".$_POST["ban_user"]." a été suprimmé</h3>" ;
	} else {
		$sql = "DELETE FROM `users` WHERE `nickname`='".$_POST['ban_user']."'" ;
		$req = "SELECT * FROM `users` WHERE `nickname`='".$_POST['ban_user']."'" ;
		if($ban_user = mysqli_query($conn, $req)) {
			$ban_user = mysqli_fetch_assoc($ban_user) ;
		}
		mysqli_query($conn, $sql) ;
		echo "<h3>L'utilisateur nomé ".$_POST["ban_user"]." a été suprimmé</h3>" ;
	}
	
	$sql2 = "DELETE FROM `quizz` WHERE `owner`=".$ban_user["id"] ;
	if($ret = mysqli_query($conn, $sql2)) {
		
	}
}

if(isset($_POST["del_user"]) and $_POST["del_user"] !== "") {
	if(filter_var($_POST["del_user"], FILTER_VALIDATE_EMAIL)){
		$sql = "DELETE FROM `users` WHERE `email`='".$_POST['del_user']."'" ;
		if($ret = mysqli_query($conn, $sql)) {
			echo "<h3>L'utilisateur qui a pour email ".$_POST["del_user"]." a été supprimé</h3>" ;
		}
	} else {
		$sql = "DELETE FROM `users` WHERE `nickname`='".$_POST['del_user']."'" ;
		if($ret = mysqli_query($conn, $sql)) {
			echo "<h3>L'utilisateur nomé ".$_POST["del_user"]." a été supprimé</h3>" ;
		}
	}
}

if(isset($_POST["del_quizz"]) and $_POST["del_quizz"] !== "") {
	if(delete_quizz($conn, $_POST["del_quizz"])) {
		echo "<h3>Le quizz a été supprimée</h3>" ;
	}
}

var_dump($_POST) ;
unset($_POST["ban_user"]) ;
unset($_POST["del_user"]) ;
unset($_POST["del_quizz"]) ;
var_dump($_POST) ;
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Quizzy</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="no_margin no_padding">

<p><a href="../" >retour</a></p>

<form action="#" method="post">
	<div class="form_wrapper">
		<div class="form_title">Gestion des utilisateurs</div>
		<div class="form_row_wrapper">
			<div class="form_wrapper">
				<div class="form_title">Suprimer un utilisateur</div>
				<div class="form_label">Pseudo ou mail</div>
				<input class="form_input" type="text" name="del_user">
			</div>
			<div class="form_wrapper">
				<div class="form_title">Bannir un utilisateur</div>
				<div class="form_label">Pseudo ou mail</div>
				<input class="form_input" type="text" name="ban_user">
			</div>
		</div>
		<div class="form_title">Gestion des quizz</div>
		<div class="form_row_wrapper">
			<div class="form_wrapper">
				<div class="form_title">Suprimmer un quizz</div>
				<div class="form_label">ID du quizz</div>
				<input class="form_input" type="number" name="del_quizz">
			</div>
		</div>
		<input class="form_button" type="submit" value="Valider">
	</div>
</form>

<?php
include("../db/db_disconnect.php") ;
?>

 </body>
</html>