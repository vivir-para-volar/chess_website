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
			<div class="article">
				<?php
				$db = mysqli_connect("localhost", "root", "root", 'web_course');
				$sql = mysqli_query($db, "SELECT * FROM `news` WHERE `id` = {$_GET['ID']}");

				$result = mysqli_fetch_array($sql);
				$img = $result['img'];
				echo '<p>' . date('d.m.Y - H:i', $result['data']) . '</p><br>';
				echo '<h2>' . $result['title'] . '</h2><br>';
				echo '<img class="photo" src="' . $result['img'] . '">';
				echo '<p>' . $result['text'] . '</p><br><br>';

				$db -> close();
				?>

				<form method="POST" class="form_review_user">
					<h2>Оставить комментарий</h2>

					<? if($_COOKIE['user'] != ""): ?>
						<textarea name="comment" class="message_input" placeholder="Ваш комментарий" required></textarea><br>
						<input type="submit" value="Отправить" class="button_form">  
						<input type="reset" value="Отменить" class="button_form"> 
					<? else: ?>
						<p style="text-align: center;">Только авторизованные пользователи могут оставлять комментарии. <a href="authorization.php" class="a_red">Авторизация</a></p>
					<? endif; ?>

					<?php 
					if(!empty($_REQUEST)){
						if($_REQUEST['comment'] != null)
						{
							$id_user = $_COOKIE['id_user'];
							$comment = $_REQUEST['comment'];

							try 
							{
								$db = mysqli_connect("localhost", "root", "root", 'web_course');
								if ($db == false){
									print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
								}

								$sql = mysqli_query($db, "INSERT INTO `comments` (`id_new`, `id_user`, `comment`, `data`) VALUES ('{$_GET['ID']}', '$id_user', '$comment', '".time()."')");

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

				<div class="block_comments">
					<?php
					$db = mysqli_connect("localhost", "root", "root", 'web_course');
					$sql = mysqli_query($db, "SELECT * FROM `comments` WHERE `id_new` = {$_GET['ID']} ORDER BY id DESC");
					while ($result = mysqli_fetch_array($sql)) {
						$id = $result['id_user'];
						echo '<p>' . date('d.m.Y - H:i', $result['data']) . '</p>';
						$name = mysqli_query($db, "SELECT * FROM `users` WHERE `id` = {$id}");
						$result_name = mysqli_fetch_array($name);
						echo '<p>' . $result_name['name'] . '</p>'; 
						echo '<p>' . $result['comment'] . '</p>';
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