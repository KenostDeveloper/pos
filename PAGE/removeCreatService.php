<?php 
session_start();
require_once("../DB/db.php");

$idUser = $_SESSION['user']['id_user'];

$id_services = $connect->real_escape_string($_GET['delete']);
$id_user = $connect->real_escape_string($idUser);
$SQL = "DELETE FROM `creatingAservice` WHERE user = '$idUser' and id_services = '$id_services'";
$DELETE = "DELETE FROM `response` WHERE services = $id_services";
$response = $connect->query($DELETE);
$result = $connect->query($SQL);

if($result) {
    header("Location: creatingAservice.php");
} else {
    $_SESSION['message'] = "Ошибка при удалении";
    header("Location: creatingAservice.php");
}

if ($response or $result) {
    header("Location: creatingAservice.php");
} else {
    $_SESSION['message'] = "Ошибка при удалении";
    header("Location: creatingAservice.php");
}
?>