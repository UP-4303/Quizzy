<?php
include("lib/head.php");
?>

<ul id="list_quizz">
	<?php
	include_once("crud/quizz.crud.php");
	
	$all_quizz = select_all_quizz($conn);
	
	foreach($all_quizz as $quizz){
		echo "<li class='quizz'><div class='nomQuizz'>".$quizz[1]."</div></li>" ;
	}
	?>
	<li class="quizz"><div class="nomQuizz">yz </div></li>
</ul>

<a href="profil.php">profil</a>

<?php
include("lib/foot.php");
?>