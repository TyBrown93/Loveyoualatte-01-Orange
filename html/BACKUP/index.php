<?php
// Start initial session
session_start();

// Include functions and connect to database
include 'functions.php';
$pdo = pdo_connect_mysql();

// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Include and show the requested page
include $page . '.php';
?>