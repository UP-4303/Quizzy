<?php
include("lib/head.php");
?>

<ul class="list_quizz">
	<?php
	if(isset($_SESSION["id"])) {
		include_once("crud/quizz.crud.php");
		
		$sql = "SELECT * FROM `quizz` WHERE `owner`=".$_SESSION['id'] ;
		$result=mysqli_query($conn, $sql) ;
		
		if (mysqli_num_rows($result) == 0){
			echo("<div id='quizz_name'>vous n'avez créé aucun quizz</div>");
		} else {
			$result = array_reverse(mysqli_fetch_assoc($result)) ;
			while ($row = $result){
				if(isset($row["image"])) {
					$background = 'background-image: url("images/'.$row["image"].'");' ;
				} else {
					$background = "background-color: ".$row["color"].";";
				}		
				echo "<a href='quizz.php?id=".$row["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$row["name"]."</div></li></a>" ;
			}
		}
	}  else {
		echo "<h3>Veuillez vous connecter pour accéder à vos créations</h3>" ;
	}
	?>
</ul>

<script src="js/script.js"></script>

<?php
include("lib/foot.php");
?>