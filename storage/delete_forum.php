<?
$db = mysqli_connect("localhost", "root", "root", 'web_course');
$sql = mysqli_query($db, "DELETE FROM `forum` WHERE `id` = {$_GET['ID']}");
if ($sql) {
	header('Location: /pages/admin_forum.php');
} 
else {
	echo '<p>Произошла ошибка: ' . mysqli_error($db) . '</p>';
}
$db -> close();
?>