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
	<label id="nametext">Nom : </label><input id="nameinput" type="text" name="nom">
	<input id="qcminput" type="radio" name="is_quizz" checked><label id="qcmtext">Quizz à points</label>
	<input id="quizzinput" type="radio" name="is_quizz"><label id="quizztext">Quizz à résultats multiples</label>
</form>

<button id="continue"></button>

<script src="js/creation.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>