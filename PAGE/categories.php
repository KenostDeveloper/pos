<?php
session_start();
require_once('../DB/db.php');

$_SESSION['user']['cat'] = $_GET['item'];
$_SESSION['categories'] = "модал";

header('Location: creatingAservice.php');
?>