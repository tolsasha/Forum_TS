<?php
echo "<H2>Удаление сообщения
</H2>";
//Запрос
$sql="SELECT id FROM MESSAGE WHERE id=".$_GET['nummessage'];
$data=mysql_query($sql) or die(mysql_error());
$line=mysql_fetch_row($data);
//Выводим надпись
echo "Вы действительно хотите удалить выбранное сообщение?";
?>
<form action="?act=del_message&nummessage=<?php echo $line[0]?>"
method="post">
<input type="submit" value="Да">
</form>
<form action="index.php" method="post">
<input type="submit" value="Отмена">
</form>