<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="shortcut icon" href="img/icon-logo.png" type="image/png">
	<title>Chess</title>
</head>
<body>
	<header>
		<a href="../index.php" class="logo"><img src="img/logo.png" alt=""></a>
		<div class="menu">
			<a href="index.php" class="menu_1">Главная</a>
			<a href="pages/news.php" class="menu_2">Новости</a>
			<a href="pages/forum.php" class="menu_3">Форум</a>
			<a href="pages/question.php" class="menu_4">Задать вопрос</a>
			<? if($_COOKIE['user'] == ""): ?>
				<a href="pages/authorization.php" class="menu_5">Вход</a>
			<? else: ?>
				<a href="storage/exit.php" class="menu_5">Выход</a>
			<? endif; ?>
		</div>
	</header>


	<section class="main">
		<div class="title">
			<p>C</p>
			<p>H</p>
			<p>E</p>
			<p>S</p>
			<p>S</p>
		</div>
		<img src="img/main.png" alt="">
		<div class="block">
			<br>
			<h2>О нас</h2>
			<p>Chess: информационно-аналитический портал о шахматах.<br>Автор идеи и главный редактор: Евгений Суров <br>Редакторы: Алексей Жабин, Евгения Кононова<br>Веб-разработчик: Михаил Кантария<br>Дизайн: Ия Метревели, Михаил Кантария<br></p>
		</div>
	</section>

	<section class="ground">
		<div class="container">
			<div class="index_news">
				<h2>Последние новости</h2>

				<?php
				$db = mysqli_connect("localhost", "root", "root", 'web_course');
				$sql = mysqli_query($db, 'SELECT `id`, `title`, `img`, `data` FROM `news` ORDER BY id DESC');
				$count = 0;?>
				<div class="news_slider">
					<?while (($result = mysqli_fetch_array($sql)) && $count < 3) {
						if($count != 0){
							echo '</div>';
						}
						echo '<div class="item_slider fade">';
						;?>
						<div class="news_item">
							<?php
							$Id = $result['id'];
							$img = $result['img'];?>
                           <a href="pages/news_item.php?ID=<?=$Id?>" class="block_news_item">
                                 <?echo '<img src="' . $img . '"><br>';?>
							      <p class="text"><?=$result['title']?></p>
							      <?echo '<br><p style="color: black;">' . date('d.m.Y - H:i', $result['data']) . '</p>';?>
                           </a>
						</div>
						<?
						$count += 1;
					}
					echo '</div>';
					$db -> close();?>

					<a class="prev" onclick="plusSlides(-1)"><img src="../img/icon-prev.png" alt=""></a>
					<a class="next" onclick="plusSlides(1)"><img src="../img/icon-next.png" alt=""></a>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="logo_footer">
			<a href="index.php" class="img_logo"><img src="img/logo.png" alt=""></a>
			<span class="footer_title">Chess</span>
		</div>
		<div class="follow_us">
			<a href="https://www.instagram.com/wwwchesscom/?hl=ru"><img src="img/icon-instagram.png" alt=""></a>
		</div>
	</footer>


	<script src="../js/script.js"></script>
</body>
</html>