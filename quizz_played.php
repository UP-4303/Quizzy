<?php
include("lib/head.php");
?>

<div class="list_quizz">
	<?php
	if(isset($_SESSION["id"])) {
		include_once("crud/quizz.crud.php");
		
		$user = select_user($conn, $_SESSION["id"]) ;
		
		$done = "" ;
		$played = explode('.', $user["quizz_done"]) ;
		
		if (count($played) < 2){
			echo("<div id='quizz_name'>vous n'avez fait aucun quizz</div>");
		} else {
			foreach($played as $played_id) {
				if($played_id != '') {
					if($qizz = select_quizz($conn, intval($played_id))) {
						$done .= ".".$played_id ;
						echo "<a href='quizz.php?id=".$qizz["id"]."'  class='quizz' ><div class='nomQuizz'>".$qizz["name"]."</div></a>" ;
					}
				}
			}
			update_quizz_done($conn, $_SESSION["id"], $done) ;
		}
	}  else {
		echo "<h3>Veuillez vous connecter pour accéder aux quizz réalisés</h3>" ;
	}
	?>
</div>


<?php
include("lib/foot.php");
?>