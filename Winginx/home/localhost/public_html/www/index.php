<?php
//запускаем сессию
session_start();
//ѕодключаемс¤ к mysql
require_once('connect.php');
//если пользователь не авторизован то выводим ссылку на авторизацию
if(!isset($_SESSION['autorized']))
{
	?>
	<p align='right'>
	<a href='login.php'>
	<input type="submit" value ="Aвторизация">
	</a>
	</p>
	
	<p align='right'>
	<a href='reg.php'>
	<input type="submit" value ="Регистрация">
	</a>
	</p>
	
	<?php
	$_SESSION['name']='guest';
	$_SESSION['role']='user';
}
else
{
//если пользователь авторизован, то сообщаем ему об этом
echo "<p ilign='right'> Вы авторизированны под ником: ".$_SESSION['name']."<BR>";
echo "<a href='logout.php'>Выход</a></p>";
}

if (isset($_GET['act']))
{
	require_once('action.php');
}
else
	require_once('show.php');

?>
