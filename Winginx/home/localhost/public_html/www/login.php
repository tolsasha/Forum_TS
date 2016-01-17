<?php

session_start();
if (!isset($_POST['enter']))
{
//Форма авторизации
?>
<form method='post' action=''>
Авторизация на форуме:<BR>
Имя пользователя: <input type='text'  name='name' value=''><BR>
Пароль: <input type='password' name='pass'><BR>
<input name='enter' type='submit' value='ВОЙТИ'>
<?php
}
else
{
//Проверяем ввел ли пользователь имя и пароль
if($_POST['name']!='' and $_POST['pass']!='')
 {
	//Защита от взлома
		$safe_name=mysql_escape_string($_POST['name']);
		$safe_pass=mysql_escape_string($_POST['pass']);
	//Преобразуем пароль в хэш
		$safe_pass=md5($safe_pass);
		require_once('connect.php'); 
	//формируем запрос
		$sql="SELECT name, pass, role FROM USERS WHERE name='".$safe_name."' and pass='".$safe_pass."'";
		$result=mysql_query($sql);
	//Проверяем, есть ли такой пользователь
		if (!mysql_num_rows($result))
		//Если нет такого пользователя, то отказываем ему в доступе
		
			die("Неверный логин или пароль! <a href='index.php'> Вернуться назад!</a>");
		
		//Иначе записывает факт авторизации в сессию
		else
		{
			//Получаем результат запроса
			$line=mysql_fetch_row($result);
			//Записываем факт авторизации в сессию
			$_SESSION['autorized']=true;
			//Созраняем имя пользователя и роль
			$_SESSION['name']=$_POST['name'];
			$_SESSION['role']=$line[2];
			//Выводим пользователю информацию, что он был авторизован
			echo "Авторизация прошла успешно!";
			echo '<meta http-equiv="refresh" content="3; url=index.php">';
		}	
 
 }
//Если пользователь не ввел данные
else
{

			//отказываем ему в доступе
			die("Неправильный логин или пароль! <a href='index.php'> Вернуться назад!</a>");
}	
}
?>