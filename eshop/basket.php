<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
?>
<html>
<head>
	<title>Корзина пользователя</title>
</head>
<body>
	<h1>Ваша корзина</h1>
<?php
	$goods = myBasket();
	if(!is_array($goods)){
		echo"Произошла ошибка при выводе товаров";
	}
	if($goods){
		echo'<p>Вернутся в <a href="catalog.php">каталог</a></p>';
	}else{
		echo'<p>Корзина пуста. Вернитесь в <a href="catalog.php">каталог</a></p> ';
	}
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
	$i = 1; $sum = 0;
	foreach($goods as $items){
?>
<tr>
	<td><?= $i?></td>
	<td><?= $items['title']?></td>
	<td><?= $items['author']?></td>
	<td><?= $items['pubyear']?></td>
	<td><?= $items['price']?></td>
	<td><?= $items['quantity']?></td>
	<td><a href="delete_from_basket.php?id=<?=$items['id'] ?>">Удалить</a></td>
</tr>

<?php
	$i++;
	$sum += $items['price'] * $items['quantity'];
	}
?>
</table>

<p>Всего товаров в корзине на сумму:<?=$sum?> руб.</p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>







