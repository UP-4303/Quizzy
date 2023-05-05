<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Quizzy</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="no_margin no_padding">
    <?php
        include_once('db/db_connect.php');
        session_start()
    ?>
    <header id="header">
    <form action="/l1_info_4/Quizzy/index.php" method="get">
        <svg id="top_svg" class="no_margin no_padding" viewBox="0 0 1000 200" preserveAspectRatio="none"><path fill="#fc6600" fill-opacity="1" d="M 0 0 L 1000 0 L 1000 150 L 400 150 C 200 150 300 200 100 200 L 0 200 Z"></path><path fill="#000000" fill-opacity="1" d="M 0 200 L 100 200 C 300 200 200 150 400 150 L 1000 150 L 1000 145 L 400 145 C 200 145 300 195 100 195 L 0 195 Z"></path></svg>
        <div id="top_container">
            <div id="logo_wrapper">
                <a href="/l1_info_4/Quizzy" id="logo_link" class="no_margin no_padding"><img src="images/logo.png" alt="logo" id="logo"></a>
                <nav class="iconeMenu"></nav>
            </div>
            <div id="searchbox_wrapper">
                <input id="searchbox" class="no_padding form-input" 
                type="search" placeholder="Chercher un quizz" name="q" title="Rechercher">
                <input type="submit" id="searchbox_icon" value="">
            </div>
        </div>
    </form>

    <div id="menu_pannel" class="no_margin">
        <div id="menu_top_wrapper">				
			<?php
			# menu
				if(isset($_SESSION['id'])){ # vérifie si l'utisisateur est connecté
					include_once('crud/users.crud.php');
					$user=select_user($conn, $_SESSION['id']);
					if(isset($user['profile_picture'])) { # affiche l'image de profile sinon la photo de base
						$image = $user['profile_picture'];
					} else {
						$image = 'default-avatar.jpg';
					}
					# affiche les liens utilisateur
					echo '<div class="compte_pic" style="background-image: url(\'/l1_info_4/Quizzy/images/'.$image.'\');"></div><h4>Connecté en tant que : '.$user['nickname'].'</h4>';
					echo '<a href="profil.php">Profil</a>';
					echo '<a href="favoris.php">Favoris</a>';
					echo '<a href="mes_creations.php">Mes créations</a>';
					echo '<a href="quizz_played.php">Mes derniers Quizz</a>';
					echo '<a href="creation.php">Créer un quizz</a>';
					if ($_SESSION['admin']){ # vérifie si l'utisisateur est connecté en tant qu'administrateur
						echo '<a href="admin/index.php">Accéder à l\'interface administrateur</a>';
					}
				}else{ # affiche les liens de connexion / inscription
					echo '<h4>Déconnecté</h4>';
					echo '<a href="user_connect.php">Connexion</a>';
					echo '<a href="user_signup.php">Inscription</a>';
				}
			?>
		</div>
	
		<div id="menu_bottom_wrapper">
			<?php
			if(isset($_SESSION['id'])){
				echo '<a href="user_disconnect.php">Déconnexion</a>' ;
			}
			?>
			<p>
			<a href="https://youtu.be/iik25wqIuFo">Contacts</a>
			</p>
		</div>
	
    </div>

    </header>
    <div id="content">
    <script src="js/script.js"></script>