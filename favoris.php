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
		
		if (count($favoris) < 2){ # vérifie que l'utilisateur a au moins un favori (la valeur par défault est '' et la fonction explode renvois une liste contennant uniquement '' )
			echo("<div id='quizz_name'>Vous n'avez aucun favoris</div>");
		} else {
			foreach($favoris as $fav_id) {
				if($fav_id != '') { # le '' est toujours présent dans la liste il faut donc l'ignorer
					if($qizz = select_quizz($conn, intval($fav_id))) {
						$fav .= ".".$fav_id ;
						echo "<a href='quizz.php?id=".$qizz["id"]."'  class='quizz' ><div class='nomQuizz'>".$qizz["name"]."</div></a>" ; #affiche les quizzs
					}
				}
			}
			update_quizz_favoris($conn, $_SESSION["id"], $fav) ; # met les favoris à jours (si un des quizz favoris avais été supprimé il sera retiré
		}
	} else {
		echo "<h3>Veuillez vous connecter pour accéder aux favoris</h3>" ;
	}
	?>
</div>


<?php
include("lib/foot.php");
?>