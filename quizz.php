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

<div id="quizz_wrapper">
	<span id="quizz_name">Nom du quizz</span>
	<span id="quizz_question_number">Question n°X/Y</span>
	<span id="quizz_quesiton">Blablabla ?</span>

	<div id="answer_wrapper">
		<button id="choix_un">Oui</button>
		<button id="choix_deux">Non</button>
		<button id="choix_trois">Peut être</button>
		<button id="choix_quatre">Je sais pas mon reuf</button>
	</div>
</div>

<script src="js/quizz.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>