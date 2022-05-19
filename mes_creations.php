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
			while ($row = mysqli_fetch_assoc($result)){
				$quizzs[] = $row ;
			}
			$quizzs = array_reverse($quizzs ,true);
			foreach($quizzs as $quizz) {
				if(isset($row["image"])) {
					$background = 'background-image: url("images/'.$quizz["image"].'");' ;
				} else {
					$background = "background-color: ".$quizz["color"].";";
				}		
				echo "<a href='quizz.php?id=".$quizz["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$quizz["name"]."</div></li></a>" ;
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