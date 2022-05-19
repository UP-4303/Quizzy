<?php
session_start();
if(!$_SESSION["admin"]){
	header("Location: ../") ; 
}

include_once("../crud/users.crud.php") ;
include_once("../crud/quizz.crud.php") ;
?>

<link rel="stylesheet" href="../css/style.css">

<form action="#" method="post">
	<div class="form_wrapper">
		<div class="form_title">Gestion des utilisateurs</div>
		<div class="form_row_wrapper">
			<div class="form_wrapper">
				<div class="form_title">Suprimmer un utilisateur</div>
				<div class="form_label">Pseudo ou mail</div>
				<input class="form_input" type="text" name="del_user">
			</div>
			<div class="form_wrapper">
				<div class="form_title">Bloquer un utilisateur</div>
				<div class="form_label">Pseudo ou mail</div>
				<input class="form_input" type="text" name="bloque_user">
			</div>
			<div class="form_wrapper">
				<div class="form_title">Déblocker un utilisateur</div>
				<div class="form_label">Pseudo ou mail</div>
				<input class="form_input" type="text" name="debloque_user">
			</div>
		</div>
		<div class="form_title">Gestion des quizz</div>
		<div class="form_row_wrapper">
			<div class="form_wrapper">
				<div class="form_title">Suprimmer un quizz</div>
				<div class="form_label">ID du quizz</div>
				<input class="form_input" type="text" name="del_quizz">
			</div>
			
		</div>
		<input class="form_button" type="submit" value="Valider">
	</div>
</form>