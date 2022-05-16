<?php
#include("lib/head.php");
#include_once("crud/quizz.crud.php");
?>


<div id="initform">
	<input id="qcminput" type="radio" name="is_quizz" checked><label for="qcminput" id="qcmtext">Quizz à points</label>
	<input id="quizzinput" type="radio" name="is_quizz"><label for="quizzinput" id="quizztext">Quizz à résultats multiples</label>
</div>
<div id="qwrapper"><div class="qform" id="qform1">
		<label class="qnumber">Question 1</label><br/>
		<label>Question : </label><input type="text" name="questiontext"><br/>
		<select class="ansnumber">
			<option value="2">2 réponses possibles</option>
			<option value="3">3 réponses possibles</option>
			<option value="4">4 réponses possibles</option>
		</select><br/>
		
		<div class="ansinput"><label>Réponse 1 : </label><input type="text" name="repinput1" ><br/></div>
		<div class="ansinput"><label>Réponse 2 : </label><input type="text" name="repinput2" ><br/></div>
		<div class="ansinput"><label>Réponse 3 : </label><input type="text" name="repinput3" ><br/></div>
		<div class="ansinput"><label>Réponse 4 : </label><input type="text" name="repinput4" ><br/></div>
		<button onclick="addmore(this)">Ajouter une question</button>
		<button onclick="remove(this)">Retirer cette question</button>
		<select class="jauges" style="display: none;">
			<option value="A">Jauge A</option>
			<option value="B">Jauge B</option>
			<option value="C">Jauge C</option>
			<option value="D">Jauge D</option>
		</select>
		<input type="number" min="-2" max="2" name="points" class="points">
		<br/>
</div></div>

<button id="continue">Suivant</button>


<script src="js/creation.js"></script>

<?php
	#include("db/db_disconnect.php") ;
?>