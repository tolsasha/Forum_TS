<?php
if (!isset($_GET['show']))
{
	$sql="SELECT id, name FROM TOPIC WHERE kodofrazdel=0";
	$data=mysql_query($sql);
	//Список разделов
	echo "<BIG><B>Список разделов</b></BIG><BR><BR>";
	while($line=mysql_fetch_row($data))
	{
		?>
		<table BORDER=1 cellpadding=20 width=100%>
		<tr>
			<td>			
	
			<?php 
			echo '<a href="?show=topic&numrazdel='.$line[0].'">'.$line[1]."</a>";
			?>
			
			<?php
			if ($_SESSION['role']=='admin')
			{
			?>
			<form action="?show=edit_razdel&numtopic=<? echo $line[0]?>"
			method="post"> 
			<input type="submit" value="Изменить название">
			</form>
			<form action="?show=del_razdel&numtopic=<? echo $line[0]?>"
			method="post">
			<input type="submit" value="Удалить раздел"> 
			</form>
			<?php
			}
			?>
			
			
			</td>
			</tr>
			</table>
			<?php
	}	
	?>
<p align='right'>
<form action="?show=add_razdel<?php echo
$_GET['numrazdel'];?>" method="post">
<input type="submit" value="Создать новый раздел">
</form>
</p> 

<?php
	exit;

}

switch ($_GET['show'])
{
	//Если нужно вывести темы для раздела
	case 'topic':
	require_once('SHOW_MODULE/show_topic.php');
	break;
	//Если нужно вывести сообщения для выбраной темы
	case 'message':
	require_once('SHOW_MODULE/show_message.php');
	break;
	//если нужно вывести форму создания темы
	case 'add_topic':
		require_once('SHOW_MODULE/show_addtopic.php');
		break;
	//Если нужно вывести форму редактирования темы
	case 'edit_topic':
		require_once('SHOW_MODULE/show_edittopic.php');
		break;
	//Если нужно удалить тему
	case 'del_topic':
		require_once('SHOW_MODULE/show_deltopic.php');
		break;
	//Если нужно вывести форму редактирования сообщения
	case 'edit_message':
		require_once('SHOW_MODULE/show_editmessage.php');
		break;
	//Если нужно удалить сообщение
	case 'del_message':
		require_once('SHOW_MODULE/show_delmessage.php');
		break;
	//если нужно вывести форму создания раздела
	case 'add_razdel':
		require_once('SHOW_MODULE/show_addraz.php');
		break;
	//Если нужно удалить раздел
	case 'del_razdel':
		require_once('SHOW_MODULE/show_delrazdel.php');
		break;
	case 'edit_razdel':
		require_once('SHOW_MODULE/show_editrazdel.php');
		break;
	
}

?>
			