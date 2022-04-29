<?php
//include("identification.php");
if(isset($_POST["login"])){
	if(md5($_POST["login"])=='admin'
		&& md5($_POST["passwd"])=='admin'){
		/* session admin */
		$_SESSION["admin"]=time() ; 
		/* redirection */
		header("Location: admin.php") ; 
	}else{
		header("Location: user.php");
	}
}
include("lib/head.php");
include("lib/top_bar.php");
?>

<h2 class="titre">Authentification</h2>

<div id="auth">
<form method="POST" action="connexion.php">
	<table>
		<tr>
			<td>Login:	</td>
			<td><input type="text" name="login"></td>
		</tr>
		<tr>
			<td>Password:	</td>
			<td><input type="text" name="passwd"></td>
		<tr>
			<td><input id="conf" type="submit" value="confirmer"></td>
			<td></td>
		</tr>
	</table>
</form>
</div>

<?php
include("lib/foot.php");
?>