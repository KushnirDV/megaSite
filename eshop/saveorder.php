<?php
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	
	$n = clearStr($_POST['name']);
	$e = clearStr($_POST['email']);
	$p = clearStr($_POST['phone']);
	$a = clearStr($_POST['address']);
	$oid = $dasket['orderid'];
	$dt = time(); //выбираем текущее время
	$order = "$n|$e|$p|$a|$oid|$dt\n";//создаем строчку
	file_put_contents('admin/'.ORDERS_LOG, $order, FILE_APPEND);// быстрый способ записать файл
	saveOrder($dt);
?>
<html>
<head>
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>