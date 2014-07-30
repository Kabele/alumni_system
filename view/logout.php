<?php
session_start();
require 'db_connect.php';

unset($_SESSION['first']);
unset($_SESSION['last']);
unset($_SESSION['username']);
unset($_SESSION['alumni_id']);

$_SESSION['first'] = '';
$_SESSION['last'] = '';
$_SESSION['username'] = '';
$_SESSION['alumni_id'] = '';

session_destroy();

header("Location: login.php");


?>