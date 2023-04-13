<?php 
session_start();
require_once('../DB/db.php');

$emailLogin = $_POST['emailLog'];
$passwordLogin = $_POST['passLog'];

$checkUserLogin = mysqli_query($connect, "SELECT * FROM `users`
    WHERE `email` = '$emailLogin' AND `password` = '$passwordLogin'");
if (mysqli_num_rows($checkUserLogin) > 0) {

    $user = mysqli_fetch_assoc($checkUserLogin);

    $_SESSION['user'] = [
        "id_user" => $user['id_user'],
        "name" => $user['name'],
        "number" => $user['number'],
        "email" => $user['email'],
        "roleUser" => $user['roleUser']
    ];

    header('Location: user.php');

} else {
    $_SESSION['authModal'] = "Модалка";
    $_SESSION['notCorrectLogAndPass'] = "Не верный логин или пароль";
    header('Location: index.php');
}
?>
