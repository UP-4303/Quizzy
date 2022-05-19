<?php
include("lib/head.php");
?>

<ul class="list_quizz">
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
			$quizzs[] = $row ;
		}
		$quizzs = array_reverse($quizzs ,true);
		foreach($quizzs as $quizz) {
			if(isset($quizz["image"])) {
				$background = 'background-image: url("images/'.$quizz["image"].'");' ;
			} else {
				$background = "background-color: ".$quizz["color"].";";
			}		
			echo "<a href='quizz.php?id=".$quizz["id"]."'  class='quizz' style='".$background."'><li><div class='nomQuizz'>".$quizz["name"]."</div></li><img src='images/fav_empty.png' class='icone_fav'></a>" ;
		}
	}
	?>
</ul>

<script src="js/script.js"></script>

<?php
include("lib/foot.php");
?>