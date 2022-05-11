<?php
include("lib/head.php");
?>

<?php
include_once("crud/users.crud.php");

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

	echo "<div id='cont_pic'><img id='profil_pic' src='images/".$image."' alt='profil picture' ></div></div>" ;
 } else {
	 echo "<p>veuillez vous connectez</p>" ;
 }

?>

<?php
include("lib/foot.php");
?>