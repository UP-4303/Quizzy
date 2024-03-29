<?php
session_start();
if(!$_SESSION["admin"]){ # vérifie si l'utisisateur est connecté en tant qu'administrateur
	header("Location: ../") ; 
}

include_once("../db/db_connect.php") ;
include_once("../crud/users.crud.php") ;
include_once("../crud/quizz.crud.php") ;

# bannir un utilisateur
if(isset($_POST["ban_user"]) and $_POST["ban_user"] !== "") {
	if(filter_var($_POST["ban_user"], FILTER_VALIDATE_EMAIL)){ # vérifie si on a utilisé un mot de passe ou un pseudo
		$sql = "DELETE FROM `users` WHERE `email`='".$_POST['ban_user']."'" ;
		$req = "SELECT * FROM `users` WHERE `email`='".$_POST['ban_user']."'" ;
		if($ban_user = mysqli_query($conn, $req)) {
			$ban_user = mysqli_fetch_assoc($ban_user) ;
		}
		mysqli_query($conn, $sql) ; # supprime l'utilisateur avec l'email
		echo "<h3>L'utilisateur qui a pour email ".$_POST["ban_user"]." a été suprimmé</h3>" ;
	} else {
		$sql = "DELETE FROM `users` WHERE `nickname`='".$_POST['ban_user']."'" ;
		$req = "SELECT * FROM `users` WHERE `nickname`='".$_POST['ban_user']."'" ;
		if($ban_user = mysqli_query($conn, $req)) {
			$ban_user = mysqli_fetch_assoc($ban_user) ;
		}
		mysqli_query($conn, $sql) ; # supprime l'utilisateur avec le pseudo
		echo "<h3>L'utilisateur nomé ".$_POST["ban_user"]." a été suprimmé</h3>" ;
	}
	
	$sql2 = "DELETE FROM `quizz` WHERE `owner`=".$ban_user["id"] ;
	if($ret = mysqli_query($conn, $sql2)) {  # supprime tous les quizzs créés par l'utilisateur suprimé
		echo "<h3>Les quizz de l'utilisateur on été supprimé</h3>" ;
	}
}

# supprimer un utilisateur
if(isset($_POST["del_user"]) and $_POST["del_user"] !== "") {
	if(filter_var($_POST["del_user"], FILTER_VALIDATE_EMAIL)){
		$sql = "DELETE FROM `users` WHERE `email`='".$_POST['del_user']."'" ;
		if($ret = mysqli_query($conn, $sql)) { # supprime l'utilisateur avec l'email
			echo "<h3>L'utilisateur qui a pour email ".$_POST["del_user"]." a été supprimé</h3>" ;
		}
	} else {
		$sql = "DELETE FROM `users` WHERE `nickname`='".$_POST['del_user']."'" ;
		if($ret = mysqli_query($conn, $sql)) { # supprime l'utilisateur avec le pseudo
			echo "<h3>L'utilisateur nomé ".$_POST["del_user"]." a été supprimé</h3>" ;
		}
	}
}

# supprimer un quizz
if(isset($_POST["del_quizz"]) and $_POST["del_quizz"] !== "") {
	if(delete_quizz($conn, $_POST["del_quizz"])) { #supprime le quizz
		echo "<h3>Le quizz a été supprimée</h3>" ;
	}
}

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