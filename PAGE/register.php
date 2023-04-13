<?php
session_start();
require_once('../DB/db.php');

$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];

$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$description = $_POST['description'];
$password = $_POST['password'];
$userRole = $_POST['userRole'];

if ($userRole == "") {
    $userRole = 2;
}

// Заказчик = 1
// Исполнитель = 2


$check_LE = mysqli_query($connect, "SELECT * FROM `users`
    WHERE `email` = '$email' OR `number` = '$number'");
if (mysqli_num_rows($check_LE) > 0) {
    $_SESSION['message'] = "Ошибка";
    header('Location: index.php');
} else {
    mysqli_query($connect, "INSERT INTO `users` (`id_user`, `name`, `number`, `email`, `description`, `password`, `role`) 
    VALUES (NULL, '$name', '$number', '$email', '$description', '$password', '$userRole')");
    $_SESSION['authModal'] = "Модалка";
    $_SESSION['correctReg'] = "Вы успешно прошли регистрацию";
    header('Location: index.php');
}
?>