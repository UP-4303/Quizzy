<?php
/*---------------------------------------
CRUD: Gestion de l'entité user
---------------------------------------*/


/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function create_user($conn,$login, $passwd, $nickname){
	$password=md5($passwd)
	$sql="INSERT INTO `users`(`login`, `password`, `nickname`) values ('$login', '$password', '$nickname')";
	$ret=mysqli_query($conn, $sql) ;
	return $ret ; 	
}

/*
	U 
*/
function update_passwd($conn, $id, $passwd){
	$password=md5($passwd)
	$sql="UPDATE `users` set `password`='$password' WHERE `id`=$id";
	$ret=mysqli_query($conn, $sql);
	return $ret;
}

function update_nickname($conn, $id, $nickname){
	$sql="UPDATE `users` set `nickname`='$nickname' WHERE `id`=$id";
	$ret=mysqli_query($conn, $sql);
	return $ret;
}

/*
	D 
*/
function delete_user($conn, $id){
	$sql="DELETE FROM `users` WHERE `id`=$id" ;
	$ret=mysqli_query($conn, $sql) ;
	return $ret ; 
}

/*
	S
*/
function select_user($conn, $id){
	$sql="SELECT * FROM `users` WHERE `id`=$id" ;
	if($ret=mysqli_query($conn, $sql)){
		$ret=mysqli_fetch_assoc($ret);
	}
	return $ret ;
}

function select_all_users($conn){
	$sql="SELECT * FROM `users`";
	if ($ret=mysqli_query($conn, $sql)){
		return $ret;
	}
	return $ret;
}

?>