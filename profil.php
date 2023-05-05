<?php
include('lib/head.php');
?>

<?php
include_once('crud/users.crud.php');

if (! isset($_SESSION['id'])){ # vérifie si l'utilisateur est connecté
	header('location: index.php');
}

# changement de pseudo
if(isset($_POST['nvt_pseudo']) and $_POST['nvt_pseudo'] !== '') { # vérifie qu'un pseudo a été saisi
	if(strlen($_POST['nvt_pseudo']) >= 5) { # le pseudo dois faire au moins 5 caractères
		if(! filter_var($_POST['nvt_pseudo'], FILTER_VALIDATE_EMAIL)) { #le pseudo ne dois pas être un email
			if(! nickname_exist($conn, $_POST['nvt_pseudo'])) { # le pseudo ne dois pas déjà être pris
				update_nickname($conn, $_SESSION['id'], $_POST['nvt_pseudo']) ; # change le pseudo
				echo '<h3>Votre pseudo à été changé</h3>' ;
			} else {
				echo '<h3>Ce pseudo est déjà pris.</h3>' ;					#
			}																# messages d'erreures
		} else {															#
			echo '<h3>Le pseudo ne doit pas être un email valide.</h3>' ;	#
		}																	#
	} else {																#
		echo '<h3>Le pseudo doit faire au moins 5 caractères.</h3>' ;		#
	}
}

# changement de mot de passe
# vérifie que les mots de passes ont été saisi
if(isset($_POST['old_passwd']) and isset($_POST['nvt_passwd_1']) and isset($_POST['nvt_passwd_2']) and $_POST['old_passwd'] !== '' and $_POST['nvt_passwd_1'] !== '' and $_POST['nvt_passwd_2'] !== '') {
	$user = select_user($conn, $_SESSION['id']) ;
	if(md5($_POST['old_passwd']) == $user['password']) { # varifie que l'ancient mot de passe saisi ets correct
		if($_POST['nvt_passwd_1'] == $_POST['nvt_passwd_2']) { # varifie que le nouveau mot de passe et sa confirmation sont identiques 
			if(strlen($_POST['nvt_passwd_1']) >= 8) { # varifie que le mot de passe fait plus de 8 caractère
				update_passwd($conn, $_SESSION['id'], $_POST['nvt_passwd_2']) ; # change le mot de passe
				echo '<h3>Votre mot de passe à été changé.</h3>' ;
			} else {
				echo '<h3>Mot de passe doit faire au moins 8 caractères.</h3>' ;	#
			}																		#
		} else {																	# messages d'erreures
			echo '<h3>Le mot de passe et sa confirmation sont différents !</h3>' ;	#
		}																			#
	} else {																		#
		echo '<h3>Le mot de passe est incorrect.</h3>' ;							#
	}
}

# changement d'image de profil
if(isset($_FILES['photo_profil']) and $_FILES['photo_profil']['size'] != 0) {  # varifie qu'une image a été saisie
	$tmpName = $_FILES['photo_profil']['tmp_name'];
    $name = $_FILES['photo_profil']['name'];
    $size = $_FILES['photo_profil']['size'];
    $error = $_FILES['photo_profil']['error'];
	
	$tabExtension = explode('.', $name);
	$extension = strtolower(end($tabExtension));
	$maxSize = 80000000 ;
	$extentions = ['jpg', 'png'] ;
	
	if(in_array($extension, $extentions)) {  # varifie que l'extention de l'image est un jpg ou un png
		if($size <= $maxSize) { # varifie que la taille de l'image est inférieur à 8mo
			if($error == 0) { # varifie qu'il n'y a pas eut d'erreurs lor de l'envoie
				$uniqueName = md5($_SESSION['id']) ; # donne comme nom à l'image le md5 de l'id de l'utilisateur pour éviter les répétition

				if (move_uploaded_file($tmpName, 'images/'.$uniqueName)) {
					update_profile_picture($conn, $_SESSION['id'], $uniqueName) ;  # met l'image à jour si le transfert a réussi
					echo '<h3>Le changement d\'image de profil a réussi</h3>';
				}
				
			} else {
				echo '<h3>Une erreur est suvenue</h3>';				#
			}														#
		} else {													# messages d'erreures
			echo '<h3>L\'image ne dois pas faire plus de 8mo</h3>';	#
		}															#
	} else {														#
		echo '<h3>Il ne s\'agit pas d\'une image jpg ou png</h3>';	#
	}
}

$user = select_user($conn, $_SESSION['id']) ;

if(isset($user["profile_picture"])) { # varifie si l'utilisateur a une photo de profil sinon prend la photo pat défault
	$image = $user["profile_picture"] ;
} else {
	$image = "default-avatar.jpg" ;
}
?>
<form action="#" method="post" enctype="multipart/form-data">
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
			echo '<div class="compte_pic" style="background-image: url(\'/l1_info_4/Quizzy/images/'.$image.'\');"></div>'
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
				<input id="file" type="file" name="photo_profil" accept="image/png, image/jpeg">
				<label for="file" class="form_file">Parcourir...</label>
			</div>
		</div>
		<input class="form_button" type="submit" value="Valider">
	</div>
</form>

<script src="js/profil.js"></script>

<?php
include("lib/foot.php");
?>