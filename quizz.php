<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");
include_once("crud/users.crud.php");
if(isset($_SESSION['id'])){
	if (isset($_GET['id'])){
		$id=$_GET['id'];
		$quizz=select_quizz($conn, $id);
		if (! $quizz){
			print("Quizz inconnu/introuvable.");
			include("db/db_disconnect.php") ;
			return;
		}
		$json=json_encode($quizz);
		
		$user = select_user($conn, $_SESSION['id']) ;
		$done = $user["quizz_done"] ;
		$played = explode('.', $done) ;
		if(!in_array($id, $played)) {
			$up_done = $done.'.'.$id ;
			update_quizz_done($conn, $_SESSION['id'], $up_done) ;
		}
		$fav = $user["favoris"] ;
		$favoris = explode('.', $fav) ;
		if(in_array($id, $favoris) and $id != "") {
			$is_favoris = true ;
		} else {
			$is_favoris = false ;
		}
	}else{
		print("Aucun quizz n'a été chargé.");
		include("db/db_disconnect.php") ;
		return;
	}
}else{
	print("Veuillez vous connecter pour accéder aux quizz.");
	include("db/db_disconnect.php") ;
	return;
}

if ($is_favoris) {
	echo('<div class="icone_fav added"></div>');
} else {
	echo('<div class="icone_fav"></div>');
}

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

<script src="js/favoris.js"></script>
<script>
<?php
	echo "var quizz_data =".$json.";\n";
?>
</script>
<script src="js/quizz.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>