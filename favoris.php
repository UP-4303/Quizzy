<?php
include("lib/head.php");
?>

<ul class="list_quizz">
	<?php
	if(isset($_SESSION["id"])) {
		include_once("crud/quizz.crud.php");
		
		$user = select_user($conn, $_SESSION["id"]) ;
		
		$favoris = explode('.', $user["favoris"]) ;
		
		if (count($favoris) < 2){
			echo("<div id='quizz_name'>Vous n'avez aucun favoris</div>");
		} else {
			foreach($favoris as $fav_id) {
				if($fav_id != '') {
					$qizz = select_quizz($conn, intval($fav_id)) ;
					if(isset($qizz["image"])) {
						$background = 'background-image: url("images/'.$qizz["image"].'");' ;
					} else {
						$background = "background-color: ".$qizz["color"].";";
					}
					echo "<a href='quizz.php?id=".$qizz["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$qizz["name"]."</div></li></a>" ;
				}
			}
		}
	} else {
		echo "<h3>Veuillez vous connecter pour accéder aux favoris</h3>" ;
	}
	?>
</ul>

<script src="js/script.js"></script>

<?php
include("lib/foot.php");
?>