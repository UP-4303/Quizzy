<?php
include("lib/head.php");
?>

<?php
include_once("crud/users.crud.php");

if(isset($_POST["nvt_pseudo"])) {
	update_nickname($conn, $_SESSION["id"], $_POST["nvt_pseudo"]) ;
	print_r($_POST);
}

 if (isset($_SESSION['id'])){
	$user = select_user($conn, $_SESSION['id']) ;
	
	$info = "<div id='cont_profil'><div id='cont_info'><ul id='profil_info'>\n" ;
	$info .= "\t<li>pseudo : ".$user["nickname"]."</li>\n" ;
	$info .= "\t<li>email : ".$user["email"]."</li>\n" ;
	$info .= "</ul></div>\n" ;
	
	echo $info ;
	
	if(isset($user["profile_picture"])) {
		$image = $user["profile_picture"] ;
	} else {
		$image = "default-avatar.jpg" ;
	}

	echo "<div id='cont_pic'><img class='profil_pic' src='images/".$image."' alt='profil picture' ></div></div>" ;
 } else {
	 echo "<p>veuillez vous connectez</p>" ;
 }
?>

<form action="#" method="post">
	<input type="text" name="nvt_pseudo" />
	<input type="submit" value="confirmer" />
</form>

<?php
include("lib/foot.php");
?>