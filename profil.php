<?php
include("lib/head.php");
?>

<?php
include_once("crud/users.crud.php");

if(isset($_POST["nvt_pseudo"])) {
	if(strlen($_POST['nvt_pseudo']) >= 5) {
		if(! filter_var($_POST['nvt_pseudo'], FILTER_VALIDATE_EMAIL)) {
			if(! nickname_exist($conn, $_POST['nvt_pseudo'])) {
				update_nickname($conn, $_SESSION["id"], $_POST["nvt_pseudo"]) ;
			} else {
				echo "<h3>Ce pseudo est déjà pris.</h3>" ;
			}
		} else {
			echo "<h3>Le pseudo ne doit pas être un email valide.</h3>" ;
		}
	} else {
		echo "<h3>Le pseudo doit faire au moins 5 caractères.</h3>" ;
	}
}

if(isset($_POST["old_passwd"]) and isset($_POST["nvt_passwd_1"]) and isset($_POST["nvt_passwd_2"])) {
	$user = select_user($conn, $_SESSION["id"]) ;
	if(md5($_POST["old_passwd"]) == $user["password"]) {
		if($_POST["nvt_passwd_1"]) == $_POST["nvt_passwd_2"]) {
			if(strlen($_POST['passwd']) >= 8) {
				update_passwd($conn, $_SESSION["id"], $_POST["nvt_passwd_2"]) ;
			} else {
				echo "<h3>Mot de passe doit faire au moins 8 caractères.</h3>" ;
			}
		} else {
			echo "<h3>Le mot de passe et sa confirmation sont différentes !</h3>" ;
		}
	} else {
		echo "<h3>Le mot de passe est incorrect</h3>" ;
	}
}

 if (isset($_SESSION['id'])){
	$user = select_user($conn, $_SESSION['id']) ;
	
	$info = "<div id='cont_profil'><div id='cont_info'><ul id='profil_info'>\n" ;
	$info .= "\t<li>pseudo : ".$user["nickname"]."</li>\n" ;
	$info .= "\t<li>email : ".$user["email"]."</li>\n" ;
	$info .= "</ul></div>\n" ;
	
	echo $info ;
	
	if(isset($user["profile_picture"])) {
		$image = $user["profile_picture"] ;
	} else {
		$image = "default-avatar.jpg" ;
	}

	echo "<div id='cont_pic'><img class='profil_pic' src='images/".$image."' alt='profil picture' ></div></div>" ;
 } else {
	 echo "<p>veuillez vous connectez</p>" ;
 }
?>
<div>
	<form action="#" method="post">
		Nouveau pseudo : <input type="text" name="nvt_pseudo" />
		<input type="submit" value="confirmer" />
	</form>
	
	
	<form action="#" method="post">
		Ancient mot de passe : <input type="password" name="old_passwd" />
		Nouveau mot de passe : <input type="password" name="nvt_passwd_1" />
		Confirmer le nouveau mot de passe : <input type="password" name="nvt_passwd_2" />
		<input type="submit" value="confirmer" />
	</form>
</div>
<?php
include("lib/foot.php");
?>