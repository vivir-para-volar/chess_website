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

				<h1>Форум</h1>

				<h2>Удалить сообщение</h2>

				<div class="table_change_other">
				<?php
				$db = mysqli_connect("localhost", "root", "root", 'web_course');
				$sql = mysqli_query($db, 'SELECT * FROM `forum` ORDER BY Id DESC');
				echo '<table>';
				echo '<tr><td><p>Дата/Имя</p></td><td class="com"><p>Сообщение</p></td><td><p>Удалить</p></td></tr>';
				while ($result = mysqli_fetch_array($sql)) {
					$id = $result['id'];
					$ID = $result['id_user'];
					$name = mysqli_query($db, "SELECT * FROM `users` WHERE `id` = {$ID}");
					$result_name = mysqli_fetch_array($name);
					echo '<tr><td><p>' . date('d.m.Y - H:i', $result['data']) . ' / '. $result_name['name'] . '</p></td><td class="com"><p>' . $result['text'] . '</p></td><td>';?><a href="../storage/delete_forum.php?ID=<?=$id?>"><?echo '<p>удалить</p></a></td></tr>';
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