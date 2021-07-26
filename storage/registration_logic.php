<?
	$name = $_POST['name'];
	$login = $_POST['login'];
	$pass = $_POST['pass'];

	if(mb_strlen($name) < 3 || mb_strlen($name) > 50){
		echo "Недопустимая длина имени";
		exit();
	}
	else if(mb_strlen($login) < 4 || mb_strlen($login) > 100){
		echo "Недопустимая длина логина";
		exit();
	}
	else if(mb_strlen($pass) < 4 || mb_strlen($pass) > 32){
		echo "Недопустимая длина пароля";
		exit();
	}

	$pass = md5($pass);
	
	$db = mysqli_connect("localhost", "root", "root", 'web_course');
	$sql = mysqli_query($db, "INSERT INTO `users` (`name`, `login`, `password`) VALUES ('$name', '$login', '$pass')");

	$db->close();

	header('Location: /');
?>