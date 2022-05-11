<?php
include("lib/head.php");
?>

<?php
include_once("crud/users.crud.php");

$user = select_user($conn, 14) ;

foreach($user as $key => $value) {
	echo $key." => ".$value."\n" ;
}

?>

<?php
include("lib/foot.php");
?>