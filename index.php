<?php
include("lib/head.php");
?>

<ul id="list_quizz">
	<?php
	include_once("crud/quizz.crud.php");
	
	
	if (isset($_GET["search"])){
		$search = $_GET["search"];
		$search = str_replace(" ","%",$search);
		$sql = "SELECT * FROM `quizz` WHERE `name` LIKE $search";
		$result=mysqli_query($conn, $sql);

	} else {
		$result = select_all_quizz($conn);
	}

	while ($row = mysqli_fetch_assoc($result)){
		if(isset($row["image"])) {
			$background = 'background-image: url("images/'.$row["image"].'");' ;
		} else {
			$background = "background-color: ".$row["color"].";";
		}
		
		echo "<a href='quizz.php?id=".$row["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$row["name"]."</div></li></a>" ;
	}
	?>
</ul>

<?php
include("lib/foot.php");
?>