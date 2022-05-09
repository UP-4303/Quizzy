<?php
include("crud/users.crud.php");
function connect($conn, $email, $password){
	if ($user=get_user($conn, $email, $password)){
		$_SESSION['session']=time();
		$_SESSION['id']=$user["id"];
		$_SESSION['admin']=$user["is_admin"];
	}
}
?>