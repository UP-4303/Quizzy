<?php
include("lib/head.php");
include_once("crud/quizz.crud.php");
include_once("crud/users.crud.php");

if (isset($_GET['id'])){ # récupère l'id du quizz à afficher depuis l'url
	$can_like = "0";
	$id=$_GET['id'];
	$quizz=select_quizz($conn, $id);
	if (! $quizz){ # vérifie si le quizz existe
		print("Quizz inconnu/introuvable.");
		include("db/db_disconnect.php") ;
		return;
	}
	$json=json_encode($quizz);
	if (isset($_SESSION["id"])){ # vérifie si l'utisisateur est connecté
		$can_like = "1";
		$user = select_user($conn, $_SESSION['id']) ;
		$done = $user["quizz_done"] ;
		$played = explode('.', $done) ;
		if(!in_array($id, $played)) { # vérifie si le quizz est dans les quizz réalisé pour éventuellement l'y ajouter
			$up_done = '.'.$id.$done ;
			update_quizz_done($conn, $_SESSION['id'], $up_done) ;
		}
		$fav = $user["favoris"] ;
		$favoris = explode('.', $fav) ;
		if(! in_array($id, $favoris) ) { # vérifie si le quizz est dans les favoris
			$can_like = "2" ;
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

<?php
	include("db/db_disconnect.php") ;
?>