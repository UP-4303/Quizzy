<?php
include("lib/head.php");
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
	<span id="quizz_question">Blablabla ?</span>

	<div class="answer_wrapper">
		<button id="choix_un" class="answer">Oui</button>
		<button id="choix_deux" class="answer">Non</button>
	</div>
	<div class="answer_wrapper">
		<button id="choix_trois" class="answer">Peut être</button>
		<button id="choix_quatre" class="answer">Je sais pas mon reuf</button>
	</div>
</div>

<script src="js/quizz.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>