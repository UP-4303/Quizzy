<?php
include("lib/head.php");
?>

<?php
include_once("crud/users.crud.php");

$user = select_user($conn, 14) ;

$info = "<div id='cont_profil'><ul id='profil_info'>\n" ;
$info .= "\t<li>pseudo : ".$user["nickname"]."</li>\n" ;
$info .= "\t<li>email : ".$user["email"]."</li>\n" ;
$info .= "</ul>\n" ;

echo $info ;

if(isset($user["profile_picture"])) {
	$image = $user["profile_picture"] ;
} else {
	$image = "default-avatar.jpg" ;
}

echo "<img id='profil_pic' src='images/".$image."' alt='profil picture' ></div>" ;

?>

<?php
include("lib/foot.php");
?>