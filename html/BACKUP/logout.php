<?php
// Logout session and destroy session
session_start();
session_destroy();
// Redirect to the login page:
header('Location: index.php');
?>