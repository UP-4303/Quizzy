<?php
include("lib/head.php");
?>

<?php

$user = select_user($conn, 14) ;

foreach($val as $key => $value) {
	echo $key." => ".$value ;
}

?>

<?php
include("lib/foot.php");
?>