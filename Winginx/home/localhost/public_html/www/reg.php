<?php
session_start();
if (!isset($_POST['enter']))

	
	//Форма регистрации	
{
?>
<form method='post' action=''>
Регистрациия на форуме:<BR>
Имя пользователя: <input type='text'  name='name' value=''><BR>
Пароль: <input type='password' name='pass'><BR>
Подтвердите пароль: <input type='password' name='pass1'><BR>
<input name='enter' type='submit' value='Зарегистрироваться'>
<?php
}

else
{
//Проверяем совпадают ли пароли
if($_POST['pass']!=$_POST['pass1'])
{
	die("Пароли не совпадают! <a href='reg.php'> Вернуться назад!</a>");
}

//Если пароли совпадают
else
	{
		//Проверяем ввел ли пользователь имя и пароль
	if($_POST['name']!='' and $_POST['pass']!=''and $_POST['pass1']!='')
		{
		//Защита от взлома
		$safe_name=mysql_escape_string($_POST['name']);
		$safe_pass=mysql_escape_string($_POST['pass']);
		$safe_role=mysql_escape_string(user);
		
		//Проверяем есть ли такой полльзователь
		require_once('connect.php');
		$sql1="SELECT name, pass, role FROM USERS WHERE name='".$safe_name."'";
		$result1=mysql_query($sql1);
		//if (mysql_num_rows($result)>0)
			if (!mysql_num_rows($result1))
			//Если такого пользователя нет то добавляем его в базу
			{
			$safe_pass=md5($safe_pass);
			$sSQL="INSERT INTO USERS SET name='".$safe_name."', pass='".$safe_pass."', role='".$safe_role."'";
			mysql_query($sSQL)or die(mysql_error());
			//Выводим пользователю информацию, что он был авторизован
			echo "Регистрация прошла успешно!";
			echo '<meta http-equiv="refresh" content="3; url=login.php">';
			
			}
		else
			{
			die("Пользователь с таким именем уже существует! Попробуйте другое имя! <a href='reg.php'> Вернуться назад!</a>");
			}
		}
	//Если пользователь не ввел данные
	else
		{

			//отказываем ему в доступе
			die("Неправильный логин или пароль! <a href='index.php'> Вернуться назад!</a>");
		}	
}
}
?>