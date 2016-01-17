<?php
echo "<H2>Редактирование рвздела</H2>";
//Запрос
$sql="SELECT id, name FROM TOPIC WHERE `id`=".$_GET['numtopic'];
$data=mysql_query($sql) or die(mysql_error());

$line=mysql_fetch_row($data);
?>
<!--Создаем форму для редактирования темы-->
<form action="?act=edit_razdel&numtopic=<?php echo $line[0];?>"
method="post">
Название раздела: <BR>
<input name="name_razdel" type="text" value="<?=$line[1]?>" size=40>
<BR>
<input type="submit" value="Изменить">
</form> 