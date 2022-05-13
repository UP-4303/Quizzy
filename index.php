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
	if ($result){
		echo("Aucun résultat")
	} else {
		while ($row = mysqli_fetch_assoc($result)){
			if(isset($row["image"])) {
				$background = 'background-image: url("images/'.$row["image"].'");' ;
			} else {
				$background = "background-color: ".$row["color"].";";
			}
			
			echo "<li class='quizz' style='".$background."'><a href='quizz.php?id=".$row["id"]."'><div class='nomQuizz'>".$row["name"]."</div></a></li>" ;
		}
	}
	?>
</ul>

<?php
include("lib/foot.php");
?>