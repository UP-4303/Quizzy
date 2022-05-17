<?php
include("lib/head.php");
?>

<ul class="list_quizz">
	<?php
	include_once("crud/quizz.crud.php");
	
	$sql = "SELECT * FROM `quizz` WHERE `owner`=".$_SESSION['id'] ;
	if($result=mysqli_query($conn, $sql)){
		$result=mysqli_fetch_assoc($result);
	}

	if (mysqli_num_rows($result) == 0){
		echo("<div id='quizz_name'>vous n'avez créé aucun quizz</div>");
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