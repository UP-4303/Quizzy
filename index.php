<?php
include("lib/head.php");
?>

<ul id="list_quizz">
	<?php
	include_once("crud/quizz.crud.php");
	
	$all_quizz = select_all_quizz($conn);
	
	
	while ($row = mysqli_fetch_assoc($all_quizz)){
		if(isset($row["image"])) {
			$background = 'background-image: url("images/'.$row["image"].'");' ;
		} else {
			$background = "background-color: ".$row["color"].";";
		}
		
		echo "<li class='quizz' style='".$background."'><div class='nomQuizz'>".$row["name"]."</div></li>" ;
	}
	?>
</ul>

<a href="profil.php">profil</a>

<?php
include("lib/foot.php");
?>