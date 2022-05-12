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
		
		echo "<li class='quizz' style='".$background."'><a href='quizz.php?id=".$row["id"]."'><div class='nomQuizz'>".$row["name"]."</div></a></li>" ;
	}
	?>
</ul>

<?php
include("lib/foot.php");
?>