<?php
include("lib/head.php");

if(isset($_SESSION["id"])) {
	$user = select_user($conn, $_SESSION["id"]) ;
	$fav = $user["favoris"] ;
	print_r($_POST) ;
	if(isset($_post["not_added"])) {
		print($_post["not_added"]) ;
		$fav = ".".$_post["not_added"].$fav ;
		update_quizz_favoris($conn, $_SESSION["id"], $fav) ;
		unset($_post["not_added"]) ;
	}
	if(isset($_post["remove"])) {
		$liste_fav = explode('.', $user["favoris"]) ;
		$liste_fav = array_diff($liste_fav, [$_post["remove"]]);
		$fav = implode('.', $user["favoris"]) ;
		update_quizz_favoris($conn, $_SESSION["id"], $fav) ;
		unset($_post["remove"]) ;
	}
}
?>

<div class="list_quizz">
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
			echo "<a href='quizz.php?id=".$quizz["id"]."'  class='quizz' style='".$background."'><div class='nomQuizz'>".$quizz["name"]."</div></a>" ;
		}
	}
	?>
</div>

<?php
include("lib/foot.php");
?>