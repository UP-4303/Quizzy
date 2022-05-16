<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");
?>


<div id="initform">
	<label id="nametext">Nom : </label><input id="nameinput" type="text" name="nom">
	<input id="qcminput" type="radio" name="is_quizz" checked><label for="qcminput" id="qcmtext">Quizz à points</label>
	<input id="quizzinput" type="radio" name="is_quizz"><label for="quizzinput" id="quizztext">Quizz à résultats multiples</label>
</div>

<div id="qform1">
	<label id="question_number">Question</label><br/>
	<label>Question : </label><input type="text" name="questiontext"><br/>
	<select id="ans_number">
		<option value="2">2 réponses possibles</option>
		<option value="3">3 réponses possibles</option>
		<option value="4">4 réponses possibles</option>
	</select><br/>
	<label id="reptext1">Réponse 1 : </label><input type="text" name="repinput1" id="repinput1"><br/>
	<label id="reptext2">Réponse 2 : </label><input type="text" name="repinput2" id="repinput2"><br/>
	<label id="reptext3" style="display: none;">Réponse 3 : </label><input type="text" name="repinput3" id="repinput3" style="display: none;"><br/>
	<label id="reptext4" style="display: none;">Réponse 4 : </label><input type="text" name="repinput4" id="repinput4" style="display: none;"><br/>
	<button onclick="addmore" class="addmore">Ajouter une question</button>
</div>

<button id="continue">Suivant</button>

<script src="js/creation.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>