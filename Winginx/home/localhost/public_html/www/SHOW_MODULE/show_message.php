<?php
//Запрос
$sql="SELECT id, text_message, name_man, date_answer".
" FROM MESSAGE WHERE kodoftopic=".$_GET['numtopic'].
" ORDER BY date_answer";
$data=mysql_query($sql);

$sql2="SELECT name FROM TOPIC WHERE id=".$_GET['numtopic'];
$data2=mysql_query($sql2);
$line2=mysql_fetch_row($data2);
//Выводим надпись
echo "<BIG><B>Список сообщений для ";
echo "темы: ".$line2[0]."</B></BIG><BR><BR>";

//Выводим заголовок для таблицы
?>
<table BORDER=1 cellpadding=3 width=100%>
<tr>
<td width=70%>
Сообщение
</td>
<td width=10%>
<font size=2>Автор</font>
</td>
<td width=20%>
<font size=2>Дата</font>
</td>
</tr>
</table>
<?php
//Выводим список всех сообщений для выбранной темы
while($line=mysql_fetch_row($data))
{
?>
<table BORDER=1 cellpadding=20 width=100%>
<tr>
<td width=70%>
<?php
echo $line[1];
//Если это админ, то он может редактировать сообщение и удалить его
if ($_SESSION['role']=='admin')
{
?>
<form action="?show=edit_message&nummessage=<?=$line[0]?>"
method="post">
<input type="submit" value="Редактировать сообщение">
</form>
<form action="?show=del_message&nummessage=<?=$line[0]?>"
method="post">
<input type="submit" value="Удалить сообщение">
</form>
<?php
}//end - if
?>
</td>
<td width=10%>
<?php
//Имя пользователя, создавшего сообщение
echo $line[2];
?>
</td>
<td width=20%>
<?php
//Дата размещения сообщения
echo $line[3];
?>
</td>
</tr>
</table>
<?php
}//end - while
?>
<form action="?act=add_message&numtopic=<?php echo
$_GET['numtopic']?>" method="post">
Текст сообщения:<BR>
<textarea name="message" cols=40 rows=5></textarea>
<BR>
<input type="submit" value="Ответить">
</form>