<?php
include_once "databases.php";

session_start();
check_user_is_parent_of_photo();

function delete_photo_from_base_and_folder($photo_id, $photo)
{
	$mydb = "mydb";
	$pdo = connect_to_database($mydb);

	$email_sql_author = $pdo->prepare("DELETE FROM photos WHERE id = ?");
	$email_sql_author->execute(array($photo_id));
	$pdo=null;
	$dir = opendir("../gallery_photos");
	while ($file = readdir($dir))
	{
		if($file != "." && $file != ".." && strcmp($file,$photo ) == 0)
			unlink("../gallery_photos/".$file);
	}
	header("Location: ".$_SERVER["HTTP_REFERER"]);
}

function check_user_is_parent_of_photo()
{
	$mydb = "mydb";
	$user = $_SESSION['user'];

	$pdo = connect_to_database($mydb);
	$photo_arr = explode("/",$_GET['photo']);
	$photo = $photo_arr[count($photo_arr) - 1];
	$smtp = $pdo->prepare("SELECT * FROM Users WHERE user = ?");
	$smtp->execute(array($user));
	$user_id = $smtp->fetch()['id'];

	$smtp = $pdo->prepare("SELECT * FROM photos WHERE photo = ?");
	$smtp->execute(array($photo));
	$result = $smtp->fetch();
	$photo_author_id= $result['author_id'];
	$photo_id = $result['id'];
	$pdo = null;

	if (strcmp($user_id, $photo_author_id) == 0 || strcmp($user, "admin") == 0)
	{
		delete_photo_from_base_and_folder($photo_id, $photo);
	}
	else
		header("Location: ".$_SERVER["HTTP_REFERER"]);
}