<?php
include("lib/head.php");
include("crud/users.crud.php");
include("lib/auth.php");
if (isset($_SESSION['time'])){
	header("Location: index.php");
}else{
	if (isset($_POST['email'])){
		if ($_POST["passwd"] == $_POST["passwd_confirm"]){
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				if (strlen($_POST['passwd']) >= 8){
					//ON DOIT AUSSI VERIFIER SI LE PSEUDO N EXISTE PAS DEJA
					create_user($conn, $_POST['email'], $_POST['passwd'], $_POST['nickname']);
					connect($conn, $_POST["email"], $_POST['passwd']);
					print("<h3>Compte créé !</h3>");
				}else{
					print("<h3>Mot de passe doit faire au moins 8 caractères.</h3>");
				}
			}else{
				print("<h3>Email incorrecte</h3>");
			}
		}else{
			print("<h3>Le mot de passe et sa confirmation sont différentes !</h3>");
		}
	}
}
?>

<h2 class="titre">Inscription</h2>

<div id="auth">
<form method="POST" action="user_signup.php">
	Pseudo: <input type="text" name="nickname">
	Mail: <input type="text" name="email">
	Password: <input type="text" name="passwd">
	Confirm Password: <input type="text" name="passwd_confirm">
</form>

</div>

<?php
include("lib/foot.php");
?>