<?php
/*---------------------------------------
CRUD: Gestion de l'entité quizz
---------------------------------------*/


/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function create_quizz($conn, $name, $is_quizz, $ownerID, $questions, $results){
	$sql="INSERT INTO `quizz`(`name`, `is_quizz`, `owner`, `questions`, `results`) values ('$name', '$is_quizz', '$ownerID', '$questions', '$results')";
	$ret=mysqli_query($conn, $sql) ;
	return $ret ;
}

/*
	U 
*/
function update_name($conn, $id, $name){
	$sql="UPDATE `quizz` set `name`='$name' WHERE `id`=$id";
	$ret=mysqli_query($conn, $sql);
	return $ret;
}

function update_color($conn, $id, $color){
	$sql="UPDATE `quizz` set `color`='$color' WHERE `id`=$id";
	$ret=mysqli_query($conn, $sql);
	return $ret;
}

function update_image($conn, $id, $image){
	$sql="UPDATE `quizz` set `image`='$image' WHERE `id`=$id";
	$ret=mysqli_query($conn, $sql);
	return $ret;
}

function update_questions($conn, $id, $questions){
	$sql="UPDATE `quizz` set `questions`='$questions' WHERE `id`=$id";
	$ret=mysqli_query($conn, $sql);
	return $ret;
}

function update_results($conn, $id, $results){
	$sql="UPDATE `quizz` set `results`='$results' WHERE `id`=$id";
	$ret=mysqli_query($conn, $sql);
	return $ret;
}
/*
	D 
*/
function delete_quizz($conn, $id){
	$sql="DELETE FROM `quizz` WHERE `id`=$id" ;
	$ret=mysqli_query($conn, $sql) ;
	return $ret ; 
}

/*
	S
*/
function select_quizz($conn, $id){
	$sql="SELECT * FROM `quizz` WHERE `id`=$id" ;
	if($ret=mysqli_query($conn, $sql)){
		$ret=mysqli_fetch_assoc($ret);
	}
	return $ret ;
}

function select_all_quizz($conn){
	$sql="SELECT * FROM `quizz`";
	if ($ret=mysqli_query($conn, $sql)){
		return $ret;
	}
	return $ret;
}

?>