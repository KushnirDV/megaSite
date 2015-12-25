<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/db.inc.php";
?>
<html>
<head>
	<title>Поступившие заказы</title>
</head>
<body>
<h1>Поступившие заказы:</h1>
<?php
$orders = getOrders();
print_r($orders);
foreach ($orders as $order){
?>
<hr>
<h2>Заказ номер: <?= $order['orderid']?></h2>
<p><b>Заказчик</b>: <?= $order['name']?></p>
<p><b>Email</b>: <?= $order['email']?></p>
<p><b>Телефон</b>: <?= $order['phone']?></p>
<p><b>Адрес доставки</b>: <?= $order['address']?></p>
<p><b>Дата размещения заказа</b>: <?= date('d-m-Y H:m:s', $order['date'])?></p>

<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
</tr>
<?
	$i = 1; $sum = 0;
	foreach($order['goods'] as $items){
?>
<tr>
	<td><?= $i?></td>
	<td><?= $items['title']?></td>
	<td><?= $items['author']?></td>
	<td><?= $items['pubyear']?></td>
	<td><?= $items['price']?></td>
	<td><?= $items['quantity']?></td>
</tr>

<?
	$i++;
	$sum += $items['price'] * $items['quantity'];
	}
?>
</table>
<p>Всего товаров в заказе на сумму: <?= $sum?>руб.</p>
<?
} //and of big foreach;
?>
</body>
</html>