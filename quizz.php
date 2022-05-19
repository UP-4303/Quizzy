<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");
include_once("crud/users.crud.php");

if (isset($_GET['id'])){
	$can_like = "true";
	$id=$_GET['id'];
	$quizz=select_quizz($conn, $id);
	if (! $quizz){
		print("Quizz inconnu/introuvable.");
		include("db/db_disconnect.php") ;
		return;
	}
	$json=json_encode($quizz);
	if (isset($_SESSION["id"])){
		$user = select_user($conn, $_SESSION['id']) ;
		$done = $user["quizz_done"] ;
		$played = explode('.', $done) ;
		if(!in_array($id, $played)) {
			$up_done = $done.'.'.$id ;
			update_quizz_done($conn, $_SESSION['id'], $up_done) ;
		}
		$fav = $user["favoris"] ;
		$favoris = explode('.', $fav) ;
		if(! in_array($id, $favoris) ) {
			$can_like = "false" ;
		}
	}
}else{
	print("Aucun quizz n'a été chargé.");
	include("db/db_disconnect.php") ;
	return;
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
	<form method="post" action="index.php" style="display:none;" id="like">
		<?php
		echo('<a href="index.php?fav='.$id.'" class="icone_fav" ></a>');
		?>
	</form>
</div>

<script>
<?php
	echo "var quizz_data =".$json.";\n";
	echo "var can_like =".$can_like.";\n";
?>
</script>
<script src="js/quizz.js"></script>
<script src="js/favoris.js"></script>

<?php
	include("db/db_disconnect.php") ;
?>