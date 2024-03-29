<?php
include_once("lib/head.php");
include_once("crud/users.crud.php");

# inscription
function check_and_create($conn){
	if (isset($_POST['email'])){
		if ($_POST["passwd"] != $_POST["passwd_confirm"]){print("<h3>Le mot de passe et sa confirmation sont différentes !</h3>");return;} # varifie que le mot de passe et sa confirmation sont identiques 
		if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){print("<h3>Email incorrect.</h3>");return;} # varifie que l'email est valide
		if (strlen($_POST['passwd']) < 8){print("<h3>Mot de passe doit faire au moins 8 caractères.</h3>");return;} # varifie que le mot de passe fait plus de 8 caractère
		if (strlen($_POST['nickname']) < 5){print("<h3>Le pseudo doit faire au moins 5 caractères.</h3>");return;} # le pseudo dois faire au moins 5 caractères
		if (filter_var($_POST['nickname'], FILTER_VALIDATE_EMAIL)){print("<h3>Le pseudo ne doit pas être un email valide.</h3>");return;} #le pseudo ne dois pas être un email
		if (email_exist($conn, $_POST['email'])){print("<h3>Cet email est déjà utilisé.</h3>");return;} # l'email ne dois pas déjà être pris
		if (nickname_exist($conn, $_POST['nickname'])){print("<h3>Ce pseudo est déjà pris.</h3>");return;} # le pseudo ne dois pas déjà être pris
		create_user($conn, $_POST['email'], $_POST['passwd'], $_POST['nickname']); # met à jours la base de données
		connect($conn, $_POST["email"], $_POST['passwd']);
		print("<h3>Compte créé !</h3>");
	}
}

if (isset($_SESSION['id'])){ # vérifie si l'utilisateur est connecté
	header("Location: index.php");
}else{
	check_and_create($conn);
}
?>

<form method="POST" action="user_signup.php">
	<div class="form_wrapper">
		<div class="form_title">Inscription</div>
		<div class="form_label">Pseudo:</div><input class="form_input" type="text" name="nickname">
		<div class="form_label">Mail:</div><input class="form_input" type="email" name="email">
		<div class="form_label">Password:</div><input class="form_input" type="password" name="passwd">
		<div class="form_label">Confirm Password:</div><input class="form_input" type="password" name="passwd_confirm">
		<input class="form_button" type="submit" value="Créer">
	</div>
</form>

<?php
include("lib/foot.php");
?>