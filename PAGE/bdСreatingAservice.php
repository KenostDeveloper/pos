<?php
session_start();
require_once('../DB/db.php');

$serviceBriefly = $_POST['serviceBriefly'];
$whatTask = $_POST['whatTask'];
$city = $_SESSION['city'];
$budget = $_POST['budget'];
$listUnitMeasurement = $_POST['listUnitMeasurement'];
$date = $_POST['date'];
$idUser = $_SESSION['user']['id_user'];
$subcategory = $_SESSION['subcategory'];
$categoryFromTheSheet = $_SESSION['categoryFromTheSheet'];

if ($_FILES['file_path']['size'] > 10818752) {
    $_SESSION['message'] = "Размер файла не должен превышать 10-ти МегаБайт";
    header('Location: creatingAservice.php');   
} else {
    $path = 'UPLOADS/' . time() . $_FILES['file_path']['name'];
    if (!move_uploaded_file($_FILES['file_path']['tmp_name'], '../' . $path)) {
        $_SESSION['message'] = "Ошибка при загрузки фото";
        header('Location: creatinAservice.php');
    }    

    mysqli_query($connect,"INSERT INTO `creatingAservice` (`id_services`, `serviceBriefly`, `task_description`, `city`, `summa`, `id_unit`, `date`, 
    `file_path`, `categories`, `categoryFromTheSheet`, `user`) VALUES (NULL, '$serviceBriefly', '$whatTask', '$city', '$budget', 
    '$listUnitMeasurement', '$date', '$path', '$categoryFromTheSheet', '$subcategory', '$idUser')");

    $_SESSION['message'] = "Вы успешно отправили услугу";
    header('Location: creatingAservice.php');
}
?>