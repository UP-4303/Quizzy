<?php
include_once("lib/head.php");
include_once("crud/users.crud.php");

function check_and_create(){
	if (isset($_POST['email'])){
		if ($_POST["passwd"] != $_POST["passwd_confirm"]){print("<h3>Le mot de passe et sa confirmation sont différentes !</h3>");return;}
		if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){print("<h3>Email incorrect.</h3>");return;}
		if (strlen($_POST['passwd']) < 8){print("<h3>Mot de passe doit faire au moins 8 caractères.</h3>");return;}
		if (email_exist($conn, $_POST['email'])){print("<h3>Cet email est déjà utilisé.</h3>");return;}
		if (nickname_exist($conn, $_POST['nickname'])){print("<h3>Ce pseudo est déjà pris.</h3>");return;}
		create_user($conn, $_POST['email'], $_POST['passwd'], $_POST['nickname']);
		connect($conn, $_POST["email"], $_POST['passwd']);
		print("<h3>Compte créé !</h3>");
	}
}

if (isset($_SESSION['id'])){
	header("Location: index.php");
}else{
	check_and_create();
}
?>

<h2 class="titre">Inscription</h2>

<div id="auth">
<form method="POST" action="user_signup.php">
	Pseudo: <input type="text" name="nickname">
	Mail: <input type="text" name="email">
	Password: <input type="text" name="passwd">
	Confirm Password: <input type="text" name="passwd_confirm">
	<input type="submit" value="Créer">
</form>

</div>

<?php
include("lib/foot.php");
?>