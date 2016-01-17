<?php

//Изменение название раздела
if ($_GET['act']=='edit_razdel')
{
	//Обработка названия темы в целях безопасности
	$safe_razdel=mysql_escape_string($_POST['name_razdel']);
	//Запрос
	$sSQL="UPDATE TOPIC SET name='".$safe_razdel."'
WHERE id=".$_GET['numtopic'];
	mysql_query($sSQL)or die(mysql_error());
	$sSQL="SELECT kodofrazdel FROM TOPIC
WHERE id=".$_GET['numtopic'];
	$data=mysql_query($sSQL);
	$line=mysql_fetch_row($data);
	//Выводим надпись
	echo "Название раздела изменено<BR>";

echo '<meta http-equiv="refresh" content="3; url=index.php">';

}



//Удаление раздела
if ($_GET['act']=='del_razdel')
{
	$sSQL="SELECT kodofrazdel FROM TOPIC
WHERE id=".$_GET['numtopic'];
	$data=mysql_query($sSQL);
	$line=mysql_fetch_row($data);
	$sSQL="DELETE FROM MESSAGE WHERE kodoftopic=".$_GET['numtopic'];
	mysql_query($sSQL)or die(mysql_error());
	$sSQL="DELETE FROM TOPIC WHERE id=".$_GET['numtopic'];
	mysql_query($sSQL)or die(mysql_error());
	//Выводим надпись
	echo "Раздел удален успешно<BR>";
	//echo "<a href='index.php?show=topic&numrazdel=$line[0]'>Назад к списку тем</a>";
	echo '<meta http-equiv="refresh" content="3; url=index.php">';
}


//Добавление раздела
if ($_GET['act']=='add_razdel')
{
	//Обработка названия темы в целях безопасности
	$safe_razdel=mysql_escape_string($_POST['name_razdel']);
	//Запрос
	$sSQL="INSERT INTO TOPIC(name) VALUES ('".$safe_razdel."')";
	mysql_query($sSQL)or die(mysql_error());
	//Обработка текста сообщения в целях безопасности
	
	
	echo "Раздел создан успешно<BR>";
	//echo "<a href='index.php?show=topic&numrazdel=".$_GET['numrazdel']."'>";
echo '<meta http-equiv="refresh" content="3; url=index.php">';
}

//Добавление темы
if ($_GET['act']=='add_topic')
{
	//Обработка названия темы в целях безопасности
	$safe_topic=mysql_escape_string($_POST['name_topic']);
	//Запрос
	$sSQL="INSERT INTO TOPIC SET
	kodofrazdel=".$_GET['numrazdel'].", name='".$safe_topic."',
	name_creator='".$_SESSION['name']."',
	date_last_answer='".date('Y-m-d')."'";
	mysql_query($sSQL)or die(mysql_error());
	//Обработка текста сообщения в целях безопасности
	$safe_message=mysql_escape_string($_POST['message']);
	//Определяем номер созданной темы
	$id=mysql_insert_id();
	//Запрос 
	$sSQL="INSERT INTO MESSAGE SET kodoftopic=".$id.",
	text_message='".$safe_message."', name_man='".$_SESSION['name']."',
	date_answer='".date('Y-m-d')."'";
	mysql_query($sSQL)or die(mysql_error());
	//Выводим надпись
	echo "Тема создана успешно<BR>";
	//echo "<a href='index.php?show=topic&numrazdel=".$_GET['numrazdel']."'>";

echo '<meta http-equiv="refresh" content="3; url=index.php?show=topic&numrazdel='.$_GET['numrazdel'].'">';
}

//Изменение название темы
if ($_GET['act']=='edit_topic')
{
	//Обработка названия темы в целях безопасности
	$safe_topic=mysql_escape_string($_POST['name_topic']);
	//Запрос
	$sSQL="UPDATE TOPIC SET name='".$safe_topic."'
WHERE id=".$_GET['numtopic'];
	mysql_query($sSQL)or die(mysql_error());
	$sSQL="SELECT kodofrazdel FROM TOPIC
WHERE id=".$_GET['numtopic'];
	$data=mysql_query($sSQL);
	$line=mysql_fetch_row($data);
	//Выводим надпись
	echo "Название темы изменено<BR>";
//echo "<a href='index.php?show=topic&numrazdel=$line[0]'>";

echo '<meta http-equiv="refresh" content="3; url=index.php?show=topic&numrazdel='.$line[0].'">';

}
//Удаление темы и всех ее сообщений
if ($_GET['act']=='del_topic')
{
	$sSQL="SELECT kodofrazdel FROM TOPIC
WHERE id=".$_GET['numtopic'];
	$data=mysql_query($sSQL);
	$line=mysql_fetch_row($data);
	$sSQL="DELETE FROM MESSAGE WHERE kodoftopic=".$_GET['numtopic'];
	mysql_query($sSQL)or die(mysql_error());
	$sSQL="DELETE FROM TOPIC WHERE id=".$_GET['numtopic'];
	mysql_query($sSQL)or die(mysql_error());
	//Выводим надпись
	echo "Тема удалена<BR>";
	//echo "<a href='index.php?show=topic&numrazdel=$line[0]'>Назад к списку тем</a>";
	echo '<meta http-equiv="refresh" content="3; url=index.php?show=topic&numrazdel='.$line[0].'">';
	
}
//Добавление нового сообщения
if ($_GET['act']=='add_message')
{
	//Обработка текста в целях безопасности
	$safe_message=mysql_escape_string($_POST['message']);
	//Запрос
	$sSQL="INSERT INTO MESSAGE SET kodoftopic=".$_GET['numtopic'].",
text_message='".$safe_message."', name_man='".$_SESSION['name']."',
date_answer='".date('Y-m-d')."'";
	mysql_query($sSQL)or die(mysql_error());
	//Информация об имено посетителя и дате сообщения
	$sSQL="UPDATE TOPIC SET name_last_answer='".$_SESSION['name']."',
date_last_answer='".date('Y-m-d')."' WHERE id=".$_GET['numtopic'];
	mysql_query($sSQL)or die(mysql_error());
	//Выводим надпись
	echo "Ответ принят<BR>";
//echo "<a href='index.php?show=message&numtopic=".$_GET['numtopic']."'>";
//echo "Назад к обсуждению темы</a>";
echo '<meta http-equiv="refresh" content="3; url=index.php?show=message&numtopic='.$_GET['numtopic'].'">';
}
//Изменения сообщения
if ($_GET['act']=='edit_message')
{
	//Обработка текста в целях безопасности
	$safe_message=mysql_escape_string($_POST['message']);
	//Меняем текст сообщения
	$sSQL="UPDATE MESSAGE SET text_message='".$safe_message."'
WHERE id=".$_GET['nummessage'];
	mysql_query($sSQL)or die(mysql_error());
	$sSQL="SELECT kodoftopic FROM MESSAGE
WHERE id=".$_GET['nummessage'];
	$data=mysql_query($sSQL);
	$line=mysql_fetch_row($data);
	//Выводим надпись
	echo "Название сообщения изменено<BR>";
echo '<meta http-equiv="refresh" content="3; url=index.php?show=message&numtopic='.$line[0].'">';
//echo "<a href='index.php?show=message&numtopic=".$line[0]."'>";
//echo "Назад к обсуждению темы </a>";
}
//Удаления сообщения
if ($_GET['act']=='del_message')
{
	$sSQL="SELECT kodoftopic FROM MESSAGE".
" WHERE id=".$_GET['nummessage'];
	$data=mysql_query($sSQL);
	$line=mysql_fetch_row($data);
	$sSQL="DELETE FROM MESSAGE WHERE id=".$_GET['nummessage'];
	mysql_query($sSQL)or die(mysql_error());
	//Выводим надпись
	echo "Тема удалена<BR>";
	echo '<meta http-equiv="refresh" content="3; url=index.php?show=message&numtopic='.$line[0].'">';
	//echo "<a href='index.php?show=message&numtopic=".$line[0]."'>";
	//echo "Назад к обсуждению темы </a>";
}

?>