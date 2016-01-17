<?php
$sql="SELECT id, kodofrazdel, name, name_creator, name_last_answer, date_last_answer FROM TOPIC WHERE
kodofrazdel=".$_GET['numrazdel']." ORDER BY date_last_answer";
$data=mysql_query($sql);

$sql2="SELECT name FROM TOPIC WHERE id=".$_GET['numrazdel'];
$data2=mysql_query($sql2);

$line2=mysql_fetch_row($data2);

//Надпись
echo "<BIG><B>Список тем для ";
echo "раздела: ".$line2[0]."</B><BIG><BR><BR>";
//Кнопка для создания новой темы
?>
<p align='right'>
<form action="?show=add_topic&numrazdel=<?php echo
$_GET['numrazdel'];?>" method="post">
<input type="submit" value="Создать Новую тему">
</form>
</p> 

<?php
//Вывод заголовка для таблицы
?>
<table BORDER=1 cellpadding=3 width=100%>
<tr>
 <td width=60%>
Название темы
  </td>
 <td width=10%>
 <font size=2>Автор</font>
 </td>
 <td width=30%>
 <font size=2>Последнее сообщение (Кто|Дата)</font>
 </td>
</tr>
</table>
<?php
//Выводим список всех тем для выбраного раздела
while($line=mysql_fetch_row($data))
{ 
?>
 <table BORDER=1 cellpadding=20 width=100%>
 <tr>
 <td width=60%>
 <?php 
 echo '<a
href="?show=message&numtopic='.$line[0].'">'.$line[2].'</a>' ; 
//Если это админ, то он может редактироватьназвание темы и удалять ее
if ($_SESSION['role']=='admin')
 {
 ?>
 <form action="?show=edit_topic&numtopic=<? echo $line[0]?>"
method="post"> 
 <input type="submit" value="Изменить название">
 </form>
 <form action="?show=del_topic&numtopic=<? echo $line[0]?>"
method="post">
 <input type="submit" value="Удалить тему"> 
 </form>
 <?php
 }
 ?>
 </td>
 <td width=10%>
 <?php
 //Имя создавшего тему
echo $line[3];
 ?>
 </td>
 <td width=10%>
 <?php
 //Имя последнего ответившего
 echo $line[4];
 ?>
 </td>
 <td width=20%>
 <?php
 //Дата последнего ответа
 echo $line[5];
 ?>
 </td>
 </tr>
 </table>
 <?php
}
?> 

