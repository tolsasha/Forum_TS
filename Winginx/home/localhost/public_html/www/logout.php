<?php
//���������� ������
session_start();
session_unset();
session_destroy();
//�������������� ������������ �� index.php
header('location:index.php');
?>