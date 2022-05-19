<?php
include("lib/head.php");
?>

<ul class="list_quizz">
	<?php
	if(isset($_SESSION["id"])) {
		include_once("crud/quizz.crud.php");
		
		$user = select_user($conn, $_SESSION["id"]) ;
		
		$fav = "" ;
		$favoris = explode('.', $user["favoris"]) ;
		$favoris = array_reverse($favoris) ;
		
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
						echo "<a href='quizz.php?id=".$qizz["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$qizz["name"]."</div></li></a>" ;
					}
				}
			}
			update_quizz_favoris($conn, $_SESSION["id"], $fav)
		}
	} else {
		echo "<h3>Veuillez vous connecter pour accéder aux favoris</h3>" ;
	}
	?>
</ul>


<?php
include("lib/foot.php");
?>