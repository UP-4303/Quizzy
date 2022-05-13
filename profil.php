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
				echo "<h3>Votre pseudo à été changé</h3>" ;
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
		if($_POST["nvt_passwd_1"] == $_POST["nvt_passwd_2"]) {
			if(strlen($_POST['passwd']) >= 8) {
				update_passwd($conn, $_SESSION["id"], $_POST["nvt_passwd_2"]) ;
				echo "<h3>Votre mot de passe à été changé.</h3>" ;
			} else {
				echo "<h3>Mot de passe doit faire au moins 8 caractères.</h3>" ;
			}
		} else {
			echo "<h3>Le mot de passe et sa confirmation sont différentes !</h3>" ;
		}
	} else {
		echo "<h3>Le mot de passe est incorrect.</h3>" ;
	}
}

if(isset($_FILES["photo_profil"])) {
	$tmpName = $_FILES['photo_profil']['tmp_name'];
    $name = $_FILES['photo_profil']['name'];
    $size = $_FILES['photo_profil']['size'];
    $error = $_FILES['photo_profil']['error'];
	
	$tabExtension = explode('.', $name);
	$extension = strtolower(end($tabExtension));
	$maxSize = 20000000 ;
	
	if($extension == "jpg") {
		if($size <= $maxSize) {
			if($error == 0) {
				$uniqueName = uniqid('', true);
				$file = $uniqueName.".".$extension;
				
				move_uploaded_file($tmpName, 'http://os-vps418.infomaniak.ch:1180/l1_info_4/Quizzy/images/'.$file);
				update_profile_picture($conn, $_SESSION["id"], $file) ;
			} else {
				echo "<h3>une erreur est suvenue</h3>";
			}
		} else {
			echo "<h3>l'image ne dois pas faire plus de 8mo</h3>";
		}
	} else {
		echo "<h3>il ne s'agit pas d'une image jpg</h3>";
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
<div id="cont_change">
	<form action="#" method="post" id="cont_psd">
		<ul id="chg_psd">
			<li>Nouveau pseudo :</li>
			<li><input type="text" name="nvt_pseudo" /></li>
			<li><input type="submit" value="confirmer" /></li>
		</ul>
	</form>
	
	
	<form action="#" method="post" id="cont_mdp">
		<ul id="chg_mdp">
			<li>Ancient mot de passe : <input type="password" name="old_passwd" /></li>
			<li>Nouveau mot de passe : <input type="password" name="nvt_passwd_1" /></li>
			<li>Confirmer le nouveau mot de passe : <input type="password" name="nvt_passwd_2" /></li>
			<li><input type="submit" value="confirmer" /></li>
		</ul>
	</form>
	
	<form action="#" method="post" enctype="multipart/form-data" id="cont_photo">
        <ul id="chg_photo">
			<li>Photo de profil</li>
			<li><input type="file" name="photo_profil" /></li>
			<li><input type="submit" value="enrgistrer" /></li>
		</ul>
    </form>
</div>
<?php
include("lib/foot.php");
?>