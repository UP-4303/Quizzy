<?php
//include("lib/head.php");
include_once("db/db_connect.php") ;
session_start();
if(!isset($_SESSION['id'])){
	if (isset($_GET["quizz"])){
		$id=$_GET['quizz'];
	}else{
		print("Aucun quizz n'a été chargé.");
	}
}else{
	print("Veuillez vous connecter pour accéder aux quizz.");
	include("db/db_disconnect.php") ;
	return;
}
?>

<h1 id="title">Titre</h1>
<h2 id="question">Blablabla ?</h2>
<h3 id="nombre">Question X</h3>

<button id="choix_un">Oui</button> <button id="choix_deux">Non</button><br/>
<button id="choix_trois">Peut être</button> <button id="choix_quatre">Juif</button>


<script src="js/quizz.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>