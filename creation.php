<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");
if(! isset($_SESSION['id'])){
	print("Veuillez vous connecter pour accéder aux quizz.");
	include("db/db_disconnect.php") ;
	return;
}
?>


<form method="POST" action="creation.php">
	<div id="initform">
		<label id="nametext">Nom : </label><input id="nameinput" type="text" name="nom">
		<input id="qcminput" type="radio" name="is_quizz" checked><label for="qcminput" id="qcmtext">Quizz à points</label>
		<input id="quizzinput" type="radio" name="is_quizz"><label for="quizzinput" id="quizztext">Quizz à résultats multiples</label>
	</div>

	<div id="questionform" style="display: none;">
		<label id="question_number">Question</label><br/>
		<label>Question : </label><input type="text" name="questiontext"><br/>
		<select id="ans_number" value="2">
			<option value="2">2 réponses possibles</option>
			<option value="3">3 réponses possibles</option>
			<option value="4">4 réponses possibles</option>
		</select><br/>
		<label id="reptext1">Réponse 1 : </label><input type="text" name="repinput1" id="repinput1"><br/>
		<label id="reptext2">Réponse 2 : </label><input type="text" name="repinput2" id="repinput2"><br/>
		<label id="reptext3">Réponse 3 : </label><input type="text" name="repinput3" id="repinput3"><br/>
		<label id="reptext4">Réponse 4 : </label><input type="text" name="repinput4" id="repinput4"><br/>
	</div>
</form>

<button id="continue"></button>

<script src="js/creation.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>