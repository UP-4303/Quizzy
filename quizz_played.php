<?php
include("lib/head.php");
?>

<ul class="list_quizz">
	<?php
	if(isset($_SESSION["id"])) {
		include_once("crud/quizz.crud.php");
		
		$user = select_user($conn, $_SESSION["id"]) ;
		
		$played = explode('.', $user["quizz_done"]) ;
		$played = array_reverse($played) ;
		
		if (count($played) < 2){
			echo("<div id='quizz_name'>vous n'avez fait aucun quizz</div>");
		} else {
			foreach($played as $played_id) {
				if($played_id != '') {
					$qizz = select_quizz($conn, intval($played_id)) ;
					if(isset($qizz["image"])) {
						$background = 'background-image: url("images/'.$qizz["image"].'");' ;
					} else {
						$background = "background-color: ".$qizz["color"].";";
					}
					echo "<a href='quizz.php?id=".$qizz["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$qizz["name"]."</div></li></a>" ;
				}
			}
		}
	}  else {
		echo "<h3>Veuillez vous connecter pour accéder aux quizz réalisés</h3>" ;
	}
	?>
</ul>


<?php
include("lib/foot.php");
?>