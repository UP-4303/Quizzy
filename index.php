<?php
include("lib/head.php");

# ajout / suppression de favoris
if(isset($_SESSION["id"]) and isset($_GET["fav"]) and $_GET["fav"] != '') {
	$user = select_user($conn, $_SESSION["id"]) ;
	$fav = $user["favoris"] ; # dans la base de donnée favopris stocké sous la forme .id_favoris_1.id_favoris_2.ect
	$liste_fav = explode('.', $user["favoris"]) ; 
	if(in_array($_GET["fav"], $liste_fav)) { # vérifie si le quizz est déjà dans les favoris pour l'ajouter ou l'enlever
		$liste_fav = array_diff($liste_fav, [$_GET["fav"]]);
		$fav = implode('.', $liste_fav) ;
	} else {
		$fav = ".".$_GET["fav"].$fav ;
	}
	update_quizz_favoris($conn, $_SESSION["id"], $fav) ;
}

?>

<div class="list_quizz">
	<?php
	include_once("crud/quizz.crud.php");
	
	# système de recherche
	if (isset($_GET["q"])){ # vérifie si une recherche a été faite
		$rSearch = $_GET["q"];
		$search = str_replace(" ","%",$rSearch);	# ajout des jokers
		$search = '%'.$search.'%';					#
		$sql = "SELECT * FROM `quizz` WHERE `name` LIKE '$search'";
		$result=mysqli_query($conn, $sql);
	} else { # si pas de recherche, on prend tous les quiz de la base de données
		$result = select_all_quizz($conn);
	}
	# système d'affichege
	if (mysqli_num_rows($result) == 0){ # vérifie si on a des quizz à afficher
		echo("<div id='quizz_name'>Aucun rÃ©sultat pour \"$rSearch\"</div>");
	} else {
		while ($row = mysqli_fetch_assoc($result)){
			$quizzs[] = $row ;
		}
		$quizzs = array_reverse($quizzs ,true); # inversion de l'ordre des quizz pour que les plus récents soient en premier
		foreach($quizzs as $quizz) {		
			echo "<a href='quizz.php?id=".$quizz["id"]."'  class='quizz' ><div class='nomQuizz'>".$quizz["name"]."</div></a>" ; # affichage
		}
	}
	?>
</div>

<?php
include("lib/foot.php");
?>