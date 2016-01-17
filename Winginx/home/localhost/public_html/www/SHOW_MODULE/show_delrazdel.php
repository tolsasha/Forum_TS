<?php
echo "<H2>Удаление раздела</H2>";
//Запрос
$sql="SELECT id, name FROM TOPIC WHERE id=".$_GET['numtopic'];
$data=mysql_query($sql) or die(mysql_error());

$line=mysql_fetch_row($data);
//Выводим надпись
echo "Вы действительно хотите удалить раздел: <B>".$line[1]."</B>
?";
?>

<form action="?act=del_razdel&numtopic=<?php echo $line[0]?>"
method="post">
<input type="submit" value="Да ">
</form>
<form action="index.php" method="post">
<input type="submit" value="Отмена">
</form>