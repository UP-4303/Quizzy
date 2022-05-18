<?php
include('lib/head.php');
?>

<?php
include_once('crud/users.crud.php');

if (! isset($_SESSION['id'])){
	header('location: index.php');
}

if(isset($_POST['nvt_pseudo'])) {
	if(strlen($_POST['nvt_pseudo']) >= 5) {
		if(! filter_var($_POST['nvt_pseudo'], FILTER_VALIDATE_EMAIL)) {
			if(! nickname_exist($conn, $_POST['nvt_pseudo'])) {
				update_nickname($conn, $_SESSION['id'], $_POST['nvt_pseudo']) ;
				echo '<h3>Votre pseudo à été changé</h3>' ;
			} else {
				echo '<h3>Ce pseudo est déjà pris.</h3>' ;
			}
		} else {
			echo '<h3>Le pseudo ne doit pas être un email valide.</h3>' ;
		}
	} else {
		echo '<h3>Le pseudo doit faire au moins 5 caractères.</h3>' ;
	}
}

if(isset($_POST['old_passwd']) and isset($_POST['nvt_passwd_1']) and isset($_POST['nvt_passwd_2'])) {
	$user = select_user($conn, $_SESSION['id']) ;
	if(md5($_POST['old_passwd']) == $user['password']) {
		if($_POST['nvt_passwd_1'] == $_POST['nvt_passwd_2']) {
			if(strlen($_POST['passwd']) >= 8) {
				update_passwd($conn, $_SESSION['id'], $_POST['nvt_passwd_2']) ;
				echo '<h3>Votre mot de passe à été changé.</h3>' ;
			} else {
				echo '<h3>Mot de passe doit faire au moins 8 caractères.</h3>' ;
			}
		} else {
			echo '<h3>Le mot de passe et sa confirmation sont différents !</h3>' ;
		}
	} else {
		echo '<h3>Le mot de passe est incorrect.</h3>' ;
	}
}

if(isset($_FILES["photo_profil"])) {
	$tmpName = $_FILES['photo_profil']['tmp_name'];
    $name = $_FILES['photo_profil']['name'];
    $size = $_FILES['photo_profil']['size'];
    $error = $_FILES['photo_profil']['error'];
	
	$tabExtension = explode('.', $name);
	$extension = strtolower(end($tabExtension));
	$maxSize = 80000000 ;
	$extentions = ['jpg', 'png'] ;
	
	if(in_array($extension, $extentions)) {
		if($size <= $maxSize) {
			if($error == 0) {
				$uniqueName = md5($_SESSION['id']) ;
				$file = $uniqueName.'.'.$extension;

				if (move_uploaded_file($tmpName, 'images/'.$file)) {
					update_profile_picture($conn, $_SESSION['id'], $file) ;
					echo '<h3>le changement d\'image de profil a réussi</h3>';
				}
				
			} else {
				echo '<h3>une erreur est suvenue</h3>';
			}
		} else {
			echo '<h3>l\'image ne dois pas faire plus de 8mo</h3>';
		}
	} else {
		echo '<h3>il ne s\'agit pas d\'une image jpg</h3>';
	}
}

$user = select_user($conn, $_SESSION['id']) ;

if(isset($user["profile_picture"])) {
	$image = $user["profile_picture"] ;
} else {
	$image = "default-avatar.jpg" ;
}

$info = "<div id='cont_profil'><div id='cont_info'><ul id='profil_info'>\n" ;
$info .= "\t<li>pseudo : ".$user["nickname"]."</li>\n" ;
$info .= "\t<li>email : ".$user["email"]."</li>\n" ;
$info .= "</ul></div>\n" ;

?>
<form action="#" method="post">
	<div class="form_wrapper">
		<div class="form_title">Profil</div>
		<div class="form_row_wrapper">
			<div class="form_wrapper">
				<?php
				echo '<div class="form_label">Pseudonyme : '.$user['nickname'].'</div>';
				echo '<div class="form_label">Adresse e-mail : '.$user['email'].'</div>';
				?>
			</div>
			<?php
			echo '<div class="cont_pic" style="background-image: url(\'/l1_info_4/Quizzy/images/'.$image.'\');"></div>'
			?>
		</div>
		<div class="form_title">Modifier vos informations</div>
		<div class="form_row_wrapper">
			<div class="form_wrapper">
				<div class="form_title">Changer de pseudonyme</div>
				<div class="form_label">Nouveau pseudonyme :</div>
				<input class="form_input" type="text" name="nvt_pseudo">
			</div>
			<div class="form_wrapper">
				<div class="form_title">Changer de mot de passe</div>
				<div class="form_label">Ancien mot de passe :</div>
				<input class="form_input" type="password" name="old_passwd">
				<div class="form_label">Nouveau mot de passe :</div>
				<input class="form_input" type="password" name="nvt_passwd_1">
				<div class="form_label">Confirmer le nouveau mot de passe :</div>
				<input class="form_input" type="password" name="nvt_passwd_2">
			</div>
			<div class="form_wrapper">
				<div class="form_title">Changer la photo de profil</div>
				<input class="form_input" type="file" name="photo_profil">
			</div>
		</div>
		<input class="form_button" type="submit" value="Valider">
	</div>
</form>

<?php
include("lib/foot.php");
?>