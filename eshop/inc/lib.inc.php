<?php
function clearInt($data){
	return abs((int)$data);
}
function clearStr($data){
	global $link;
	return mysqli_real_escape_string($link, trim(strip_tags($data)));
}
/* сохранения в корзину */
function saveBasket(){
	global $basket; 
	$basket = base64_encode(serialize($basket));// сериализуем масив в строку
	setcookie('basket', $basket, 0x7fffffff); //создаем куку навсегда
	
}
function basketInit(){
	global $basket, $count;
	if(!isset($_COOKIE['basket'])){
		$basket = array('orderid' => uniqid());
		saveBasket();
	}else{
		$basket = unserialize(base64_decode($_COOKIE['basket']));
		$count = count($basket)-1;
	}
}
function add2Basket($id, $q){
	global $basket;
	$basket[$id] = $q;
	saveBasket();
}
/* Сохраняем новый товар в таблицу catalog */
function addItemToCatalog($title, $author, $pubyear, $price){
	global $link;
	$sql = "INSERT INTO catalog (title, author, pubyear, price)
								VALUES(?, ?, ?, ?)";
	if(!$stmt = mysqli_prepare($link, $sql))
		return false;
	mysqli_stmt_bind_param($stmt, ssii, $title, $author, $pubyear, $price);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	return true;
};
/* Делаем выборку товара с БД */
function selectAllitems(){
	global $link;
	$sql = "SELECT id, title, author, pubyear, price
					FROM catalog";
	if(!$result = mysqli_query($link, $sql))
		return false;
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	return $items;
}

/* Создание функции выборки товаров из корзины которая возвращает всю корзину в виде ассоц. масива*/
function myBasket(){
	global $link, $basket;
	$goods = array_keys($basket); //выбрал все ключи 
	array_shift($goods);//вырезаем ордер айди. Остался один масив
	if(count($goods))
		$ids = implode(",", $goods); // склеиваем айдишники через запятую
	else
		$ids = 0;
	$sql = "SELECT id, author, title, pubyear, price
					FROM catalog
					WHERE id IN ($ids)";
	if(!$result = mysqli_query($link, $sql))
		return false;
	$items = result2Array($result);
	mysqli_free_result($result);
	return $items;
}

function result2Array($data){
	global $basket;
	$arr = array();
	while($row = mysqli_fetch_assoc($data)){
		$row['quantity']=$basket[$row['id']]; //в ров добавляем параметр квантити
		$arr[] = $row;// добавляем в наш промежуточний масив елемент ров
	}
	return $arr;
}

function deleteItemFromBasket($id){
	global $basket;
	unset($basket[$id]);
	saveBasket();
}

/* переносит данные из масива в БД! */
function saveOrder($dt){
	global $link, $basket;
	$goods = myBasket();
	$stmt = mysqli_stmt_init($link);
	$sql = 'INSERT INTO orders(title, author, pubyear, price, quantity, orderid, datetime)
									VALUES (?, ?, ?, ?, ?, ?, ?)';
	if(!mysqli_stmt_prepare($stmt, $sql))
		return false;
	foreach ($goods as $item){
		mysqli_stmt_bind_param($stmt, 'ssiiisi', $item['title'], $item['author'], $item['pubyear'], $item['price'], $item['quantity'], $basket['orderid'], $dt);
		mysqli_stmt_execute($stmt);
	}
	mysqli_stmt_close($stmt);
	setcookie('basket', "", time()-3600);
	return true;
}

/* функция возвращает многомерный масив */
function getOrders(){
	global $link;
	if(!is_file(ORDERS_LOG))
		return false;
	
	/* Получаем в виде масива персональные данные пользователя из файла */
	$orders = file(ORDERS_LOG);
	
	/* Массив, который будет возвращен функцией */
	$allorders = array();
	/* Зачитываем файл в переменные */
	foreach ($orders as $order){
		list($name, $email, $phone, $address, $orderid, $date) = explode("|", $order);
		/* Промежуточный масив для хранения информации о конкретном заказе */
		$orderinfo = array();
		/* Сохранение информации о конкретном пользователе */
		$orderinfo["name"]=$name;
		$orderinfo["email"]=$email;
		$orderinfo["phone"]=$phone;
		$orderinfo["address"]=$address;
		$orderinfo["orderid"]=$orderid;
		$orderinfo["date"]=$date;
		$sql = "SELECT title, author, pubyear, price, quantity
							FROM orders
							WHERE datetime = $date";
		if(!$result = mysqli_query($link, $sql))
			return false;
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		$orderinfo['goods'] = $items;
		$allorders[] = $orderinfo;
	}
	return $allorders;
}


















