<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");

if (isset($_POST)){
	print_r($_POST);
	$is_quizz=boolval($_POST["is_quizz"]);
	$name=$_POST['name'];
}
?>

<div class="form_wrapper">
	<form method="POST" action="creation.php" id="formulaire">
		<div id="initform">
			<label>Nom du quizz : </label><input type="text" name="name">
			<input id="qcminput" type="radio" name="is_quizz" value="0" checked><label for="qcminput" id="qcmtext">Quizz à points</label>
			<input id="quizzinput" type="radio" name="is_quizz" value="1"><label for="quizzinput" id="quizztext">Quizz à résultats multiples</label>
		</div>
		<div id="qcmform">
			<label>Nombre de points minimum pour réussir le test : </label><input type="number" name="minpoints" id="minpoints">
		</div>
		<div id="quizzform" style="display: none;">
			<label>Nom de la jauge A : </label><input type="text" name="A" class="jaugelabel"><br/>
			<label>Nom de la jauge B : </label><input type="text" name="B" class="jaugelabel"><br/>
			<label>Nom de la jauge C : </label><input type="text" name="C" class="jaugelabel"><br/>
			<label>Nom de la jauge D : </label><input type="text" name="D" class="jaugelabel">
		</div>
		<div id="qwrapper">
			<div class="qform" id="qform1">
				<label class="qnumber">Question 1</label><br/>
				<label>Question : </label><input type="text" name="questiontext"><br/>
				<select class="ansnumber">
					<option value="2">2 réponses possibles</option>
					<option value="3">3 réponses possibles</option>
					<option value="4">4 réponses possibles</option>
				</select><br/>
				
				<div class="ansinput">
					<label>Réponse 1 : </label>
					<input type="text" name="repinput1" >
					<select class="jauges" style="display: none;">
						<option value="A">Jauge A</option>
						<option value="B">Jauge B</option>
						<option value="C">Jauge C</option>
						<option value="D">Jauge D</option>
					</select>
					<input type="number" min="-2" max="2" value="0" name="points" class="points"><br/>
				</div>
				<div class="ansinput">
					<label>Réponse 2 : </label>
					<input type="text" name="repinput2" >
					<select class="jauges" style="display: none;">
						<option value="A">Jauge A</option>
						<option value="B">Jauge B</option>
						<option value="C">Jauge C</option>
						<option value="D">Jauge D</option>
					</select>
					<input type="number" min="-2" max="2" value="0" name="points" class="points"><br/>
				</div>
				<div class="ansinput" style="display: none;">
					<label>Réponse 3 : </label>
					<input type="text" name="repinput3" >
					<select class="jauges" style="display: none;">
						<option value="A">Jauge A</option>
						<option value="B">Jauge B</option>
						<option value="C">Jauge C</option>
						<option value="D">Jauge D</option>
					</select>
					<input type="number" min="-2" max="2" value="0" name="points" class="points"><br/>
				</div>
				<div class="ansinput" style="display: none;">
					<label>Réponse 4 : </label>
					<input type="text" name="repinput4" >
					<select class="jauges" style="display: none;">
						<option value="A">Jauge A</option>
						<option value="B">Jauge B</option>
						<option value="C">Jauge C</option>
						<option value="D">Jauge D</option>
					</select>
					<input type="number" min="-2" max="2" value="0" name="points" class="points"><br/>
				</div>
				<button type="button" onclick="addmore(this)">Ajouter une question</button>
				<button type="button" onclick="remove(this)">Retirer cette question</button>
				<br/>
			</div>
		</div>
	<button type="button" onclick="sendForm()">Valider et créer</button>
	</form>
</div>


<script src="js/creation.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>