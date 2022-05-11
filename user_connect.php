<?php
include_once("lib/head.php");
include_once("crud/users.crud.php");

if (isset($_SESSION['id'])){
	header("Location: index.php");
}else{
	if (isset($_POST["login"])){
		if (connect($conn, $_POST["login"], $_POST["passwd"])){
			header("Location: index.php");
		}else{
			print("<h3>Login ou mot de passe incorrect.</h3>");
		}
	}
}
?>

<h2 class="titre">Connexion</h2>

<div id="auth">
<form method="POST" action="user_connect.php">
	Pseudo ou email: <input type="text" name="login">
	Password: <input type="text" name="passwd">
	<input type="submit" value="Créer">
</form>

</div>

<?php
include("lib/foot.php");
?>