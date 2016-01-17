<?php
echo "<H2>Создание раздела</H2>";
?>
<form action="?act=add_razdel<?php echo
$_GET['numrazdel']?>" method="post">
Название раздела: <BR>
<input name="name_razdel" type="text" value="">
<BR>
<input type="submit" value="Создать раздел">
</form> 