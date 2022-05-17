<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");

if(isset($_SESSION['id'])){
	if (isset($_POST["questions"])){
		$is_quizz=$_POST['is_quizz'];
		$name=$_POST['name'];
		$id=$_SESSION["id"];
		$q=$_POST["questions"];
		$r=$_POST["results"];
		#unset($_POST['name']);
		#unset($_POST['questions']);
		#unset($_POST['results']);
		$a=create_quizz($conn, $name, $is_quizz, $id, $q, $r);
		print_r($a);
		print("<h1>Quizz créé !</h1>");
		include("db/db_disconnect.php") ;
		return;
	}
}else{
	print("Veuillez vous connecter pour créer un quizz.");
	include("db/db_disconnect.php") ;
	return;
}


?>
<form method="POST" action="creation.php" id="formulaire">
	<div class="form_wrapper">
		<div class="form_title">Création de Quizz</div>
		<div class="form_wrapper" id="initform">
			<label class="form_label">Nom du quizz : </label><input class="form_input" type="text" name="name">
			<div><input id="qcminput" type="radio" name="is_quizz" value="0" checked><label for="qcminput" id="qcmtext">Quizz à points</label></div>
			<div><input id="quizzinput" type="radio" name="is_quizz" value="1"><label for="quizzinput" id="quizztext">Quizz à résultats multiples</label></div>
		</div>
		<div class="form_wrapper" id="qcmform">
			<label class="form_label">Nombre de points minimum pour réussir le test : </label><input class="form_input" type="number" name="minpoints" id="minpoints" value="5">
		</div>
		<div class="form_wrapper" id="quizzform" style="display: none;">
			<label class="form_label">Nom de la jauge A : </label><input type="text" name="A" class="jaugelabel form_input>"><br/>
			<label class="form_label">Nom de la jauge B : </label><input type="text" name="B" class="jaugelabel form_input>"><br/>
			<label class="form_label">Nom de la jauge C : </label><input type="text" name="C" class="jaugelabel form_input>"><br/>
			<label class="form_label">Nom de la jauge D : </label><input type="text" name="D" class="jaugelabel form_input>">
		</div>
		<div class="form_wrapper" id="qwrapper">
			<div class="qform form_wrapper" id="qform1">
				<label class="qnumber form_label">Question 1</label><br/>
				<label>Question : </label><input type="text" name="questiontext" class="questiontext form_input"><br/>
				<select class="ansnumber form_input">
					<option value="2">2 réponses possibles</option>
					<option value="3">3 réponses possibles</option>
					<option value="4">4 réponses possibles</option>
				</select><br/>
				
				<div class="ansinput form_wrapper">
					<label class="form_label">Réponse 1 : </label>
					<input type="text" name="repinput1" class="anslabel form_input">
					<select class="jauges form_input" style="display: none;">
						<option value="A">Jauge A</option>
						<option value="B">Jauge B</option>
						<option value="C">Jauge C</option>
						<option value="D">Jauge D</option>
					</select>
					<input type="number" min="-2" max="2" value="0" name="points" class="points form_input"><br/>
				</div>
				<div class="ansinput form_wrapper">
					<label class="form_label">Réponse 2 : </label>
					<input type="text" name="repinput2" class="anslabel form_input">
					<select class="jauges form_input" style="display: none;">
						<option value="A">Jauge A</option>
						<option value="B">Jauge B</option>
						<option value="C">Jauge C</option>
						<option value="D">Jauge D</option>
					</select>
					<input type="number" min="-2" max="2" value="0" name="points" class="points form_input"><br/>
				</div>
				<div class="ansinput form_wrapper" style="display: none;">
					<label class="form_label">Réponse 3 : </label>
					<input type="text" name="repinput3" class="anslabel form_input">
					<select class="jauges form_input" style="display: none;">
						<option value="A">Jauge A</option>
						<option value="B">Jauge B</option>
						<option value="C">Jauge C</option>
						<option value="D">Jauge D</option>
					</select>
					<input type="number" min="-2" max="2" value="0" name="points" class="points form_input"><br/>
				</div>
				<div class="ansinput form_wrapper" style="display: none;">
					<label class="form_label">Réponse 4 : </label>
					<input type="text" name="repinput4" class="anslabel form_input">
					<select class="jauges form_input" style="display: none;">
						<option value="A">Jauge A</option>
						<option value="B">Jauge B</option>
						<option value="C">Jauge C</option>
						<option value="D">Jauge D</option>
					</select>
					<input type="number" min="-2" max="2" value="0" name="points" class="points form_input"><br/>
				</div>
				<button class="form_button" type="button" onclick="addmore(this)">Ajouter une question</button>
				<button class="form_button" type="button" onclick="remove(this)">Retirer cette question</button>
				<br/>
			</div>
		</div>
	<button class="form_button" type="button" onclick="sendForm()">Valider et créer</button>
	</div>
</form>



<script src="js/creation.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>