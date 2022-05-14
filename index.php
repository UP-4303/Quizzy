<?php
include("lib/head.php");
?>

<ul id="list_quizz">
	<?php
	include_once("crud/quizz.crud.php");
	
	if (isset($_GET["q"])){
		$rSearch = $_GET["q"];
		$search = str_replace(" ","%",$rSearch);
		$search = '%'.$search.'%';
		$sql = "SELECT * FROM `quizz` WHERE `name` LIKE '$search'";
		$result=mysqli_query($conn, $sql);

	} else {
		$result = select_all_quizz($conn);
	}
	if (mysqli_num_rows($result) == 0){
		echo("<div id='quizz_name'>Aucun résultat pour \"$rSearch\"</div>");
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