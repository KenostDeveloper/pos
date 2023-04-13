<?php
session_start();
require_once("../DB/db.php");

$idServices = $_GET['id'];
$idUser = $_SESSION['user']['id_user'];

$сheckingForAresponse = mysqli_query($connect, "SELECT * FROM `response` WHERE services = '$idServices'");

$inUser = false;

foreach ($сheckingForAresponse as $key => $value) {
    if($value['user_responded'] == $idUser) 
        $inUser = true;
}

if ($inUser) {
    $_SESSION['response'] = "Вы уже откликнулись!";
    header('Location: searchForOrders.php');
} else {
    mysqli_query($connect, "INSERT INTO `response` (`id_response`, `services`, `user_responded`) VALUES (NULL, '$idServices', '$idUser')");
    header('Location: searchForOrders.php');
}

?>