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

				<h1>Вопросы</h1>

				<?php
				$db = mysqli_connect("localhost", "root", "root", 'web_course');
				$sql = mysqli_query($db, "SELECT * FROM `question` ORDER BY Id DESC");

				while($result = mysqli_fetch_array($sql)){
					$id = $result['id_user'];
					echo '<div class="question">';
					echo '<p>' . date('d.m.Y - H.i', $result['data']) . '</p>';
					$name = mysqli_query($db, "SELECT * FROM `users` WHERE `id` = {$id}");
					$result_name = mysqli_fetch_array($name);
					echo '<p>' . $result_name['name'] . '</p>'; 
					echo '<p>Email: ' . $result['email'] . '</p><br>';
					echo '<p>' . $result['subject'] . '</p><br>';
					echo '<p>' . $result['message'] . '</p>';
					$id = $result['id'];?>
					<div class="a"><a href="../storage/delete_question.php?ID=<?=$id?>"><?echo '<p>удалить</p></a></div>';
					echo '</div>';
				}

				$db -> close();
				?>
			</div>
		</div>
	</section>
</body>
</html>
<? else: 
	echo "Авторизуйтесь как администратор.";
endif; ?>