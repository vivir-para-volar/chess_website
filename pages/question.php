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
			<div class="question">
				<h1>Напишите нам</h1>
				<p class="info_question">Вы можете задать любой вопрос или сделать предложение редакции сайта, используя форму, расположенную ниже.</p>
				<form method="POST" class="form_question">
					<h2>Форма для заполнения</h2>

					<? if($_COOKIE['user'] != ""): ?>
						<br><p>Электронная почта</p><br> 
						<input type="email" name="email" class="text_input" required>

						<br><p>Тема</p><br> <input type="text" name="subject" class="text_input" required>
						<br><p>Сообщение</p><br><textarea name="message" class="message_input" required></textarea><br>

						<input type=submit value="Отправить" class="button_form">  
						<input type=reset value="Отменить" class="button_form"> 
					<? else: ?>
						<p style="text-align: center;">Только авторизованные пользователи могут написать нам. <a href="authorization.php" class="a_red">Авторизация</a></p>
					<? endif; ?>
				</form>
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



<?php 
if(!empty($_REQUEST)){
	if($_REQUEST['message'] != null)
	{
		$id_user = $_COOKIE['id_user'];
		$email = $_REQUEST['email'];
		$subject = $_REQUEST['subject'];
		$message = $_REQUEST['message'];

		try {
			$db = mysqli_connect("localhost", "root", "root", 'web_course');
			if ($db == false){
				print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
			}

			$sql = mysqli_query($db, "INSERT INTO `question` (`id_user`, `email`, `subject`, `message`, `data`) VALUES ('$id_user', '$email', '$subject', '$message', '".time()."')");
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
