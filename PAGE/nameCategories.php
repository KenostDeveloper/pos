<?php
session_start();

switch ($_SESSION['user']['cat']) {
    case "Arenda":
        $_SESSION['categories']['cat_rus'] = "Аренда";
        break;
    case "Artist":
        $_SESSION['categories']['cat_rus'] = "Артисты";
        break;
    case "Design":
        $_SESSION['categories']['cat_rus'] = "Дизайнеры";
        break;
    case "FotoVideoAudio":
        $_SESSION['categories']['cat_rus'] = "Фото, видео, аудио";
        break;
    case "Jivotnie":
        $_SESSION['categories']['cat_rus'] = "Животные";
        break;
    case "Krasota":
        $_SESSION['categories']['cat_rus'] = "Красота";
        break;
    case "Meropriiatie":
        $_SESSION['categories']['cat_rus'] = "Мероприятия";
        break;
    case "OhranaAndDetective":
        $_SESSION['categories']['cat_rus'] = "Охрана и детективы";
        break;
    case "PCandIT":
        $_SESSION['categories']['cat_rus'] = "Компьютеры и IT";
        break;
    case "Perevozki":
        $_SESSION['categories']['cat_rus'] = "Перевозки и курьеры";
        break;
    case "RemontAndBuild":
        $_SESSION['categories']['cat_rus'] = "Ремонт и строительство";
        break;
    case "RemontAndUstanovka":
        $_SESSION['categories']['cat_rus'] = "Ремонт и установка техники";
        break;
    case "RemontAvto":
        $_SESSION['categories']['cat_rus'] = "Ремонт авто";
        break;
    case "Tvorchestvo":
        $_SESSION['categories']['cat_rus'] = "Творчество, рукоделие и хобби";
        break;
    case "Yborka":
        $_SESSION['categories']['cat_rus'] = "Хозяйство и уборка";
        break;
    case "YurDela":
        $_SESSION['categories']['cat_rus'] = "Юристы";
        break;
    case "Raznoe":
        $_SESSION['categories']['cat_rus'] = "Разное";
        break;

}

$_SESSION['categories']['cat_description'] = $_GET['description'];
$_SESSION['categoriesChoice'] = "модал";

header('Location: creatingAservice.php');
?>