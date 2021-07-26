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

				<form method="POST">
					<h2>Добавить новость</h2>

					<p>Заголовок</p><br>
					<input type="text" name="title" class="text_input" required><br>
					<br><p>Текст</p><br>
					<textarea name="text" class="message_input message_input_big" required></textarea><br>

					<br><p>Изображение</p><br>
					<input type="text" name="img" class="text_input" required><br>

					<input type=submit value="Добавить" class="button_form">  
					<input type=reset value="Отменить" class="button_form"> 

					<?php 
					if(!empty($_REQUEST)){
						if($_REQUEST['title'] != null)
						{
							$title = $_REQUEST['title'];
							$text = $_REQUEST['text'];
							$img = $_REQUEST['img'];

							try {
								$db = mysqli_connect("localhost", "root", "root", 'web_course');
								if ($db == false){
									print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
								}

								$sql = mysqli_query($db, "INSERT INTO `news` (`title`, `text`, `img`, `data`) VALUES ('$title', '$text', '$img', '".time()."')");

								if (!$sql) {
									echo '<p>Произошла ошибка: ' . mysqli_error($db) . '</p>';
								}

								$db -> close();
							} 
							catch (PDOException $e) {
								print "Ошибка!: " . $e->getMessage() . "<br/>";
							}
						}
					}
					?>

				</form>


				<br><br><br>
				<div class="table_news">
					<h2>Удалить новость</h2>
					<?php
					$db = mysqli_connect("localhost", "root", "root", 'web_course');
					$sql = mysqli_query($db, 'SELECT `id`, `title`, `data` FROM `news` ORDER BY Id DESC');
					echo '<table>';
					echo '<tr><td><p>Заголовок</p></td><td><p>Дата</p></td><td><p>Удалить</p></td></tr>';
					while ($result = mysqli_fetch_array($sql)) {
						$id = $result['id'];
						echo '<tr><td>';?><a href="change_news.php?ID=<?=$id?>"><?echo '<p>' . $result['title'] . '</p></a></td><td><p>' . date('d.m.Y - H:i', $result['data']) . '</p></td><td>';?><a href="../storage/delete_news.php?ID=<?=$id?>"><?echo '<p>удалить</p></a></td></tr>';
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