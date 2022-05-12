<?php
include("lib/head.php");

session_start();
if(isset($_SESSION['id'])){
	if (isset($_GET["quizz"])){
		$id=$_GET['quizz']
	}else{
		print("Aucun quizz n'a été chargé.");
	}
}else{
	print("Veuillez vous connecter pour accéder aux quizz.");
	include("lib/foot.php");
	return
}
?>

<h1>Question X</h1>
<h2>Blablabla ?</h2>

<button>Oui</button> <button>Non</button>
<button>Peut être</button><button>Juif</button>


<?php
	include("lib/foot.php");
?>