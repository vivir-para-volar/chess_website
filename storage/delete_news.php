<?
$db = mysqli_connect("localhost", "root", "root", 'web_course');
$sql = mysqli_query($db, "DELETE FROM `news` WHERE `id` = {$_GET['ID']}");
$sql_1 = mysqli_query($db, "DELETE FROM `comments` WHERE `id_new` = {$_GET['ID']}");
if ($sql) {
	header('Location: /pages/admin.php');
} 
else {
	echo '<p>Произошла ошибка: ' . mysqli_error($db) . '</p>';
}
$db -> close();
?>