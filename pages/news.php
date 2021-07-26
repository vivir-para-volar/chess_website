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
			<div class="news">

				<h1>Новости</h1>

				<?php
				$db = mysqli_connect("localhost", "root", "root", 'web_course');
				$sql = mysqli_query($db, 'SELECT `id`, `title`, `img`, `data` FROM `news` ORDER BY id DESC');
				$count = 0;?>
				<div class="news_slider">
					<?while ($result = mysqli_fetch_array($sql)) {
						if($count % 4 == 0 && $count != 0){
							echo '</div>';
							echo '</div>';
						}
						if($count % 4 == 0){
							echo '<div class="item_slider fade">';
							echo '<div class="slider_item_plus">';
						}?>
						<div class="news_item">
							<?php
							$Id = $result['id'];
							$img = $result['img'];?>
                     <a href="../pages/news_item.php?ID=<?=$Id?>" class="block_news_item">
							   <?echo '<img src="' . $img . '">';?>
							   <p class="text"><?=$result['title']?></p>
							   <?echo '<p style="color: black;">' . date('d.m.Y - H:i', $result['data']) . '</p>';?>
                     </a>
						</div>
						<?
						$count += 1;
					}
					echo '</div>';
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
			<a href="../index.php" class="img_logo"><img src="../img/logo.png" alt=""></a>
			<span class="footer_title">Chess</span>
		</div>
		<div class="follow_us">
			<a href="https://www.instagram.com/wwwchesscom/?hl=ru"><img src="../img/icon-instagram.png" alt=""></a>
		</div>
	</footer>


	<script src="../js/news_script.js"></script>
</body>
</html>