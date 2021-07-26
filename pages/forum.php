<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	<link rel="shortcut icon" href="../img/icon-logo.png" type="image/png">
	<title>Chess</title>
</head>
<body>
	<header>
		<a href="../index.php" class="logo"><img src="../img/logo.png" alt=""></a>
		<div class="menu">
			<a href="../index.php" class="menu_1">Главная</a>
			<a href="news.php" class="menu_2">Новости</a>
			<a href="forum.php" class="menu_3">Форум</a>
			<a href="question.php" class="menu_4">Задать вопрос</a>
			<? if($_COOKIE['user'] == ""): ?>
				<a href="authorization.php" class="menu_5">Вход</a>
			<? else: ?>
				<a href="../storage/exit.php" class="menu_5">Выход</a>
			<? endif; ?>
		</div>
	</header>

	<section class="ground">
		<div class="container">
			<div class="forum">
				<h1>Форум</h1>
				
				<form method="POST">
					<? if($_COOKIE['user'] != ""): ?>
						<textarea name="text" class="message_input" placeholder="Текст" required></textarea><br>
						<input type="submit" value="Отправить" class="button_form">  
						<input type="reset" value="Отменить" class="button_form"> 
					<? else: ?>
						<p style="text-align: center;">Только авторизованные пользователи могут оставлять комментарии. <a href="authorization.php" class="a_red">Авторизация</a></p>
					<? endif; ?>

					<?php 
					if(!empty($_REQUEST)){
						if($_REQUEST['text'] != null)
						{
							$id_user = $_COOKIE['id_user'];
							$text = $_REQUEST['text'];

							try {
								$db = mysqli_connect("localhost", "root", "root", 'web_course');
								if ($db == false){
									print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
								}

								$sql = mysqli_query($db, "INSERT INTO `forum` (`id_user`, `text`, `data`) VALUES ('$id_user', '$text', '".time()."')");

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

				<div class="block_forum">
					<?php
					$db = mysqli_connect("localhost", "root", "root", 'web_course');
					$sql = mysqli_query($db, 'SELECT * FROM `forum` ORDER BY Id DESC');
					while ($result = mysqli_fetch_array($sql)) {
						$id = $result['id_user'];
						echo '<p>' . date('d.m.Y - H:i', $result['data']) . '</p>';
						$name = mysqli_query($db, "SELECT * FROM `users` WHERE `id` = {$id}");
						$result_name = mysqli_fetch_array($name);
						echo '<p>' . $result_name['name'] . '</p>'; 
						echo '<p>' . $result['text'] . '</p>';
						echo '<br>';
					}
					$db -> close();
					?>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="logo_footer">
			<a href="../index.php" class="img_logo"><img src="../img/logo.png" alt=""></a>
			<span class="footer_title">Chess</span>
		</div>
		<div class="follow_us">
			<a href="https://www.instagram.com/wwwchesscom/?hl=ru"><img src="../img/icon-instagram.png" alt=""></a>
		</div>
	</footer>
</body>
</html>