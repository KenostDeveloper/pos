<?php 
session_start();
require_once("../DB/db.php");

$email = $connect->real_escape_string($_POST['email']);
$oldPassword = $connect->real_escape_string($_POST['oldPassword']);
$newPassword = $connect->real_escape_string($_POST['newPassword']);

$SQL = "UPDATE `users` SET `password` = '$newPassword' WHERE `email` = '$email'";
$oldPass = "SELECT * FROM `users` WHERE `password` = '$oldPassword'";
if ($results = $connect->query($SQL) or $сhecOldPass = $connect->query($oldPass)) {
    $_SESSION['message'] = "Ваш пароль успешно изменён";
    header("Location: index.php");
} else {
    $_SESSION['message'] = "Ошибка, в изменение пароля";
    header("Location: index.php");
}
?>