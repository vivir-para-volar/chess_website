<?php 
if(!empty($_REQUEST)){
	if($_REQUEST['title'] != null)
	{
		$ID = $_REQUEST['id'];
		$title = $_REQUEST['title'];
		$text = $_REQUEST['text'];
		$img = $_REQUEST['img'];

		$db = mysqli_connect("localhost", "root", "root", 'web_course');
		$sql = mysqli_query($db, "UPDATE `news` SET `title` = '$title',`text` = '$text',`img` = '$img' WHERE `id` = '$ID'");
		if (!$sql) {
			echo "<p>Произошла ошибка: " . mysqli_error($db) . '</p>';
		}
		$db -> close();
	}
	header('Location: /pages/admin.php');
}
?>