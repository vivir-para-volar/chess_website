<? if($_COOKIE['user'] == "admin"): ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/admin_style.css" type="text/css">
	<link rel="shortcut icon" href="../img/icon-logo.png" type="image/png">
	<title>Chess - Admin</title>
</head>
<body>
	<? $ID = $_GET['ID'];?>

	<header>
		<a href="../index.php" class="logo"><img src="../img/logo.png" alt=""></a>
		<div class="menu">
			<a href="admin.php">Новости</a>
			<a href="admin_forum.php">Форум</a>
			<a href="admin_question.php">Вопросы</a>
		</div>
	</header>

	<section class="admin">
		<div class="container">
			<div class="block_admin">

				<h1>Новости</h1>

				<form method="POST" action="../storage/change.php">
					<h2>Изменить новость</h2>

					<?
					$db = mysqli_connect("localhost", "root", "root", 'web_course');
					$sql = mysqli_query($db, "SELECT * FROM `news` WHERE `Id` = {$ID}");

					$result = mysqli_fetch_array($sql);
					$title = $result['title'];
					$text = $result['text'];
					$img = $result['img'];

					$db -> close();
					?>
					<p>Заголовок</p><br>
					<input type="text" name="title" class="text_input" value="<?=$title?>" required><br>
					<br><p>Текст</p><br>
					<textarea name="text" class="message_input message_input_big" required><?=$text?> </textarea><br>

					<br><p>Изображение</p><br>
					<input type="text" name="img" class="text_input" value="<?=$img?>" required><br>

					<input type="text" name="id" class="text_input" value="<?=$ID?>" style="display: none"><br>

					<input type=submit value="Изменить" class="button_form">  
					<input type=reset value="Отменить" class="button_form"> 
				</form>


				<br><br><br>
				<div class="table_change_news">
					<h2>Удалить комментарий</h2>
					<?php
					$db = mysqli_connect("localhost", "root", "root", 'web_course');
					$sql = mysqli_query($db, "SELECT * FROM `comments` WHERE `id_new` = {$_GET['ID']} ORDER BY id DESC");
					echo '<table>';
					echo '<tr><td><p>Дата/Имя</p></td><td class="com"><p>Комментарий</p></td><td><p>Удалить</p></td></tr>';
					while ($result = mysqli_fetch_array($sql)) {
						$id = $result['id'];
						echo '<tr><td><p>' . date('d.m.Y - H:i', $result['data']) . ' / '. $result['name'] . '</p></td><td class="com"><p>' . $result['comment'] . '</p></td><td>';?><a href="../storage/delete_comment.php?ID=<?=$id?>"><?echo '<p>удалить</p></a></td></tr>';
					}
					echo '</table>';
					$db -> close();
					?>
				</div>

			</div>
		</div>
	</section>
</body>
</html>
<? else: 
	echo "Авторизуйтесь как администратор.";
endif; ?>