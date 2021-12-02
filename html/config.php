<?php
// Connect to employee database
// function pdo_connect_mysql_employee() {
//	$DATABASE_HOST = '3.234.155.244';
//	$DATABASE_USER = 'root';
//	$DATABASE_PASS = '';
//	$DATABASE_NAME = 'shoppingcart';
//	try {
//		return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
//	} catch (PDOException $exception) {
//  	exit('Failed to connect to database!');
//  }
// }
$conn = mysqli_connect("3.234.155.244", "root", "", "shoppingcart");
?>