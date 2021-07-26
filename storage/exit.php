<?
setcookie('user', $result['name'], time() - 3600, "/");
setcookie('id_user', $result['id'], time() - 3600, "/");
header('Location: /');
?>