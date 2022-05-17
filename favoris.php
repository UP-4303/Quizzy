<?php
include("lib/head.php");
?>

<ul class="list_quizz">
	<?php
	include_once("crud/quizz.crud.php");
	
	$user = select_user($conn, $_SESSION["id"]) ;
	
	$favoris = $user["favoris"] ;
	
	if (count($favoris) == 0){
		echo("<div id='quizz_name'>aucun favoris</div>");
	} else {
		foreach($favoris as $fav_id) {
			$qizz = select_quizz($conn, $fav_id) ;
			if(isset($qizz["image"])) {
				$background = 'background-image: url("images/'.$qizz["image"].'");' ;
			} else {
				$background = "background-color: ".$qizz["color"].";";
			}
			echo "<a href='quizz.php?id=".$qizz["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$qizz["name"]."</div></li></a>" ;
		}
	}
	?>
</ul>

<?php
include("lib/foot.php");
?>