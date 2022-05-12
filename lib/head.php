<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Quizzy</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
</head>
<body class="no_margin no_padding">
 
    <?php
    session_start();
    if (isset($_GET['action'])){
        $act=$_GET['action'];
        if ($act == "déconnexion"){
            unset($_SESSION["id"]);
            unset($_SESSION["session"]);
            unset($_SESSION["admin"]);
        }else if ($act == "connexion"){
            header("Location: user_connect.php");
        }else if ($act == "inscription"){
            header("Location: user_signup.php");
        }
        unset($_GET['action']);
    }
    include_once("db/db_connect.php") ;
    ?>
    <header id="header">
    <svg id="top_svg" class="no_margin no_padding" viewBox="0 0 1000 200" preserveAspectRatio="none"><path fill="#fc6600" fill-opacity="1" d="M 0 0 L 1000 0 L 1000 150 L 400 150 C 200 150 300 200 100 200 L 0 200 Z"></path></svg>
        <div id="top_container">
            <div id="logo_wrapper">
                <a href="/l1_info_4/Quizzy" id="logo_link" class="no_margin no_padding"><img src="images/logo.png" alt="logo" id="logo"></a>
                <lord-icon id="menu_icon"
                    src="https://cdn.lordicon.com/jtqpkhoh.json"
                    trigger="click"
                    stroke="90"
                    colors="primary:#000000,secondary:#fc6600">
                </lord-icon>
            </div>
            <div id="searchbox_wrapper">
                <input id="searchbox" class="no_padding, form-input" 
                type="text" placeholder="Chercher un quizz" name="search" title="Rechercher">
                <lord-icon id="searchbox_icon"
                    src="https://cdn.lordicon.com/msoeawqm.json"
                    trigger="morph"
                    stroke="90"
                    colors="primary:#fc6600,secondary:#000000">
                </lord-icon>
            </div>
        </div>

        <div id="menu_pannel" class="no_margin no_padding">
            <div id="menu_top_wrapper">
			
				<form action="#" method="get">
				<?php
					if (isset($_SESSION['id'])){
						include_once("crud/users.crud.php");
						$user=select_user($conn, $_SESSION['id']);
						print("<div id='top_menu_co'><h4>Connecté en tant que : ".$user["nickname"]."</h4>");
						print('<input type="submit" name="action" value="déconnexion">');
						if ($_SESSION['admin']){
							print("<a href='admin/index.php'>Accéder au dark web</a></div>");
						}
					}else{
						print("<div id='top_menu_deco'>\n\t<h4>Déconnecté</h4>\n");
						print("\t<input type='submit' name='action' value='connexion'>\n");
						print("\t<input type='submit' name='action' value='inscription'>\n</div>");
					}
				?>
				</form>
			</div>
		
			<div id="menu_bottom_wrapper">
					<p><a href="https://youtu.be/iik25wqIuFo">contacts</a></p>
			</div>
		
        </div>

    </header>
