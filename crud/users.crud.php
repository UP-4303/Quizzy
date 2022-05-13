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

function update_profile_picture($conn, $id, $profile_picture){
	$sql="UPDATE `users` set `profile_picture`='$profile_picture' WHERE `id`=$id";
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

function get_user($conn, $login, $password){
	$passwd=md5($password);
	if (filter_var($login, FILTER_VALIDATE_EMAIL)){
		$sql="SELECT * FROM `users` WHERE `email`='".$login."' AND `password`='".$passwd."'";
		if ($ret=mysqli_query($conn, $sql)){
			return mysqli_fetch_assoc($ret);
		}
	}else{
		$sql="SELECT * FROM `users` WHERE `nickname`='".$login."' AND `password`='".$passwd."'";
		if ($ret=mysqli_query($conn, $sql)){
			return mysqli_fetch_assoc($ret);
		}
	}
	
	return $ret;
}

function connect($conn, $login, $password){
	if ($user=get_user($conn, $login, $password)){
		$_SESSION['session']=time();
		$_SESSION['id']=$user["id"];
		$_SESSION['admin']=$user["is_admin"];
		return true;
	}
	return false;
}

function email_exist($conn, $email){
	$sql="SELECT * FROM `users` WHERE `email`='".$email."'";
	if ($ret=mysqli_query($conn, $sql)){
		return $ret->num_rows == 1;
	}
	return false;
}

function nickname_exist($conn, $nickname){
	$sql="SELECT * FROM `users` WHERE `nickname`='".$nickname."'";
	if ($ret=mysqli_query($conn, $sql)){
		return $ret->num_rows == 1;
	}
	return false;
}

function select_all_users($conn){
	$sql="SELECT * FROM `users`";
	if ($ret=mysqli_query($conn, $sql)){
		return mysqli_fetch_assoc($ret);
	}
	return $ret;
}

?>