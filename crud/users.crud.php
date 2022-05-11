<?php
/*---------------------------------------
CRUD: Gestion de l'entité user
---------------------------------------*/


/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function create_user($conn,$email, $passwd, $nickname){
	$password=md5($passwd);
	$email=strtolower($email);
	$sql="INSERT INTO `users`(`email`, `password`, `nickname`) values ('$email', '$password', '$nickname')";
	$ret=mysqli_query($conn, $sql) ;
	return $ret ; 	
}

/*
	U 
*/
function update_passwd($conn, $id, $passwd){
	$password=md5($passwd);
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

function get_user($conn, $email, $password){
	$passwd=md5($password);
	$sql="SELECT * FROM `users` WHERE `email`='".$email."' AND `password`='".$passwd."'";
	if ($ret=mysqli_query($conn, $sql)){
		return mysqli_fetch_assoc($ret);
	}
	return $ret;
}

function connect($conn, $email, $password){
	if ($user=get_user($conn, $email, $password)){
		$_SESSION['session']=time();
		$_SESSION['id']=$user["id"];
		$_SESSION['admin']=$user["is_admin"];
		print_r($_SESSION);
	}
	print_r($user);
}

function email_exist($conn, $email){
	$sql="SELECT * FROM `users` WHERE `email`='".$email."'";
	if ($ret=mysqli_query($conn, $sql)){
		return $ret;
	}
	return false;
}

function nickname_exist($conn, $nickname){
	$sql="SELECT * FROM `users` WHERE `nickname`='".$nickname."'";
	if ($ret=mysqli_query($conn, $sql)){
		return is_null(mysqli_fetch_array($ret));
	}
	return false;
}

function select_all_users($conn){
	$sql="SELECT * FROM `users`";
	if ($ret=mysqli_query($conn, $sql)){
		return $ret;
	}
	return $ret;
}

?>