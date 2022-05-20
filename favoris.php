<?php
include("lib/head.php");
?>

<div class="list_quizz">
	<?php
	if(isset($_SESSION["id"])) { # vérifie si l'utilisateur est connecté
		include_once("crud/quizz.crud.php");
		
		$user = select_user($conn, $_SESSION["id"]) ;
		
		$fav = "" ;
		$favoris = explode('.', $user["favoris"]) ;
		
		if (count($favoris) < 2){ # vérifie que l'utilisateur a des favoris (la valeur par défault est '' ce qui
			echo("<div id='quizz_name'>Vous n'avez aucun favoris</div>");
		} else {
			foreach($favoris as $fav_id) {
				if($fav_id != '') {
					if($qizz = select_quizz($conn, intval($fav_id))) {
						$fav .= ".".$fav_id ;
						echo "<a href='quizz.php?id=".$qizz["id"]."'  class='quizz' ><div class='nomQuizz'>".$qizz["name"]."</div></a>" ;
					}
				}
			}
			update_quizz_favoris($conn, $_SESSION["id"], $fav) ;
		}
	} else {
		echo "<h3>Veuillez vous connecter pour accéder aux favoris</h3>" ;
	}
	?>
</div>


<?php
include("lib/foot.php");
?>