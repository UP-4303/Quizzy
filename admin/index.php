<?php
session_start();
if(!$_SESSION["admin"]){
	header("Location: ../") ; 
}

include_once("../db/db_connect.php") ;
include_once("../crud/users.crud.php") ;
include_once("../crud/quizz.crud.php") ;

if(isset($_POST["ban_user"])) {
	if(filter_var($_POST["ban_user"], FILTER_VALIDATE_EMAIL)){
		$sql = "DELETE FROM `users` WHERE `email`=".$_POST['ban_user'] ;
		$req = "SELECT * FROM `users` WHERE `email`=".$_POST['ban_user'] ;
		$ban_user = mysqli_query($conn, $req) ;
		mysqli_query($conn, $sql) ;
	} else {
		$sql = "DELETE FROM `users` WHERE `nickname`=".$_POST['ban_user'] ;
		$req = "SELECT * FROM `users` WHERE `nickname`=".$_POST['ban_user'];
		$ban_user = mysqli_query($conn, $req) ;
		mysqli_query($conn, $sql) ;
	}
	$sql = "DELETE FROM `quizz` WHERE `owner`=".$_POST['ban_user'] ;
	$ret = mysqli_query($conn, $sql) ;
	echo "<h3>L'utilisateur et tous ses quizzs on été suprimmé</h3>" ;
}

if(isset($_POST["del_user"])) {
	if(filter_var($_POST["del_user"], FILTER_VALIDATE_EMAIL)){
		$sql = "DELETE FROM `users` WHERE `email`=".$_POST['del_user'] ;
		mysqli_query($conn, $sql) ;
	} else {
		$sql = "DELETE FROM `users` WHERE `nickname`=".$_POST['del_user'] ;
		mysqli_query($conn, $sql) ;
	}
	echo "<h3>L'utilisateur a été supprimé</h3>" ;
}

if(isset($_POST["del_quizz"])) {
	delete_quizz($conn, $_POST["del_quizz"]) ;
	echo "<h3>Le quizz a été supprimée</h3>" ;
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