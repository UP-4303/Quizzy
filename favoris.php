<?php
include("lib/head.php");
?>

<ul class="list_quizz">
	<?php
	include_once("crud/quizz.crud.php");
	
	$user = select_user($conn, $_SESSION["id"])
	
	$favoris = $user["favoris"]
	
	if (mysqli_num_rows($favoris) == 0){
		echo("<div id='quizz_name'>aucun favoris</div>");
	} else {
		while ($row = mysqli_fetch_assoc($result)){
			if(isset($row["image"])) {
				$background = 'background-image: url("images/'.$row["image"].'");' ;
			} else {
				$background = "background-color: ".$row["color"].";";
			}		
			echo "<a href='quizz.php?id=".$row["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$row["name"]."</div></li></a>" ;
		}
	}
	?>
</ul>

<?php
include("lib/foot.php");
?>