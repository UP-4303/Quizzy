<?php
include("lib/head.php");
?>

<div class="list_quizz">
	<?php
	if(isset($_SESSION["id"])) {
		include_once("crud/quizz.crud.php");
		
		$user = select_user($conn, $_SESSION["id"]) ;
		
		$fav = "" ;
		$favoris = explode('.', $user["favoris"]) ;
		
		if (count($favoris) < 2){
			echo("<div id='quizz_name'>Vous n'avez aucun favoris</div>");
		} else {
			foreach($favoris as $fav_id) {
				if($fav_id != '') {
					if($qizz = select_quizz($conn, intval($fav_id))) {
						$fav .= ".".$fav_id ;
						if(isset($qizz["image"])) {
							$background = 'background-image: url("images/'.$qizz["image"].'");' ;
						} else {
							$background = "background-color: ".$qizz["color"].";";
						}
						echo "<a href='quizz.php?id=".$qizz["id"]."'  class='quizz' style='".$background."'><div class='nomQuizz'>".$qizz["name"]."</div></a>" ;
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