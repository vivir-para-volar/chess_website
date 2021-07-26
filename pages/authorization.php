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
			<div class="authorization">
				<h1>Авторизация</h1>
				<form action="../storage/authorization_logic.php" method="POST">
					<input type="text" class="input" name="login" placeholder="Введите логин" required><br>
					<input type="password" class="input" name="pass" placeholder="Введите пароль" required><br>

					<input type=submit value="Войти" class="button_form">  
					<input type=reset value="Отменить" class="button_form"> 
				</form>
				<br>
				<p>Нет аккаунта? <a href="registration.php" class="a_red">Регистрация</a></p>
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