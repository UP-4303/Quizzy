<?php
include_once("lib/head.php");
include_once("crud/users.crud.php");

if (isset($_SESSION['id'])){ # vérifie si l'utilisateur est connecté
	header("Location: index.php");
}else{
	if (isset($_POST["login"])){  # vérifie si un login a été saisie
		if (connect($conn, $_POST["login"], $_POST["passwd"])){ # connexion
			header("Location: index.php");
		}else{
			print("<h3>Login ou mot de passe incorrect.</h3>"); #message d'erreure
		}
	}
}
?>

<form method="POST" action="user_connect.php">
	<div class="form_wrapper">
		<div class="form_title">Connexion</div>
		<div class="form_label">Pseudo ou email:</div><input class="form_input" type="text" name="login">
		<div class="form_label">Mot de passe :</div><input class="form_input" type="password" name="passwd">
		<input class="form_button" type="submit" value="Connexion">
	</div>
</form>


<?php
include("lib/foot.php");
?>