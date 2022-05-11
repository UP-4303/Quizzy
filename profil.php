<?php
include("lib/head.php");
?>

<?php
include_once("crud/users.crud.php");

$user = select_user($conn, 14) ;

$info = "<ul>\n" ;
$info .= "\t<li>pseudo : ".$user["nickname"]."</li>\n" ;
$info .= "\t<li>email : ".$user["email"]."</li>\n" ;
$info .= "</ul>\n" ;

echo $info ;

if(isset($user["profile_picture"])) {
	$image = $user["profile_picture"] ;
} else {
	$image = "default-avatar.jpg" ;
}

echo "<img src='images/".$image."' alt='profil picture' >" ;

?>

<?php
include("lib/foot.php");
?>