<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");
print_r($_GET);
/*if(!isset($_SESSION['id'])){
	if (isset($_GET["quizz"])){
		$id=$_GET['quizz'];
		$quizz=select_quizz($conn, $id);
		$json=json_encode($quizz);
	}else{
		print("Aucun quizz n'a été chargé.");
		return;
	}
}else{
	print("Veuillez vous connecter pour accéder aux quizz.");
	include("db/db_disconnect.php") ;
	return;
}*/
?>


<div id="quizz_wrapper">
	<span id="quizz_name">Nom du quizz</span>
	<span id="quizz_question_number">Question n°X/Y</span>
	<span id="quizz_question">Blablabla ?</span>

	<div class="answer_wrapper">
		<button id="choix_un" class="answer"><div class="answer_name">Oui</div></button>
		<button id="choix_deux" class="answer"><div class="answer_name">Non</div></button>
	</div>
	<div class="answer_wrapper">
		<button id="choix_trois" class="answer"><div class="answer_name">Peut être</div></button>
		<button id="choix_quatre" class="answer"><div class="answer_name">Je sais pas mon reuf</div></button>
	</div>
</div>

<script>
<?php
	//echo "var quizz_data =".$json.";\n";
?>
</script>
<script src="js/quizz.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>