<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");
?>


<div id="initform">
	<label id="nametext">Nom : </label><input id="nameinput" type="text" name="nom">
	<input id="qcminput" type="radio" name="is_quizz" checked><label for="qcminput" id="qcmtext">Quizz à points</label>
	<input id="quizzinput" type="radio" name="is_quizz"><label for="quizzinput" id="quizztext">Quizz à résultats multiples</label>
</div>
<div id="qwrapper">
	<div id="qform1">
		<label class="qnumber">Question 1</label><br/>
		<label>Question : </label><input type="text" name="questiontext"><br/>
		<select>
			<option value="2">2 réponses possibles</option>
			<option value="3">3 réponses possibles</option>
			<option value="4">4 réponses possibles</option>
		</select><br/>
		<label>Réponse 1 : </label><input type="text" name="repinput1" ><br/>
		<label>Réponse 2 : </label><input type="text" name="repinput2" ><br/>
		<label>Réponse 3 : </label><input type="text" name="repinput3" ><br/>
		<label>Réponse 4 : </label><input type="text" name="repinput4" ><br/>
		<button onclick="addmore()" id="addmore">Ajouter une question</button>
		<br/>
	</div>
</div>

<button id="continue">Suivant</button>


<script src="js/creation.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>