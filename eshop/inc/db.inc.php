<?php
header('Content-Type: text/html;charset=utf-8');
define('DB_HOST','localhost');
define('DB_LOGIN','root');
define('DB_PASSWORD','');
define('DB_NAME','eshop');
define('ORDERS_LOG','orders.log');
/* Корзина покупателя */
$basket = array();
/* Количество товаров в корзине покупателя */
$count = 0;
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die(mysqli_connect_error());
basketInit();