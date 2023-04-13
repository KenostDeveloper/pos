<?php
session_start();
require_once("../DB/db.php");

$_SESSION['city'] = 'Пермь';

$idUser = $_SESSION['user']['id_user'];

$_SESSION['categoryFromTheSheet'] = (!empty($_SESSION['categories']['cat_rus']) ? $_SESSION['categories']['cat_rus'] : "");
$_SESSION['subcategory'] = (!empty($_SESSION['categories']['cat_description']) ? $_SESSION['categories']['cat_description'] : "");

$userArr = explode(" ", $_SESSION['user']['name']);
$first_character = mb_substr($userArr[1], 0, 1);

$numberArrConvert = (string) $_SESSION['user']['number'];
$delFirstCharacter = substr($numberArrConvert, 1, 10);

$_SESSION['date'] = $date = date('d.m.Y');

$unitMeasurements = mysqli_query($connect, 'SELECT * FROM unitMeasurement');

$role = mysqli_query($connect, "SELECT name_role FROM `users` INNER JOIN `role` ON users.role = role.id_role WHERE id_user = '$idUser'");
$role = mysqli_fetch_assoc($role);

$bdMyServices = mysqli_query($connect, "SELECT * FROM `creatingAservice` INNER JOIN `users` 
ON creatingAservice.user = users.id_user INNER JOIN `unitMeasurement` ON creatingAservice.id_unit = unitMeasurement.id_unit 
WHERE user = '$idUser'");
$conBdMyServices = mysqli_fetch_assoc($bdMyServices);

if (!empty($conBdMyServices['name'])) {
    $test = $conBdMyServices['name'];
    $implodeName = explode(" ", $test);
    $fullNameConName = mb_substr($implodeName[1], 0);
}


$notServices = "";

if (!mysqli_num_rows($bdMyServices) > 0) {
    $notServices = '
    <div class="NotZakaz">
    <h6>Вы ещё не создавали заказы — время пришло сделать это!</h6>
    <div class="NotZakazCard">
        <div class="NotZakazCard-card">
            <img src="../IMG/zakaz-1.png" alt="">
            <p>Опишите задачу.При необходимости укажите продолжительность и бюджет.</p>
        </div>
        <div class="NotZakazCard-card">
            <img src="../IMG/zakaz-2.png" alt="">
            <p>Исполнители будут видеть ваш заказ и смогут откликнуться на него. Обсудить детали заказа можно в чате или по телефону.</p>
        </div>
        <div class="NotZakazCard-card">
            <img src="../IMG/zakaz-3.png" alt="">
            <p>Выберите подходящего исполнителя на основе рейтингов, отзывов и цены.</p>
        </div>
    </div>

    <button onclick="modalTwoActive()" class="modalreateAserviceActiveButton">Создать заказ</button>
    ';

    $notServicesButton = '';

} else {
    $notServices = '
    <h6>Мои заказы</h6>
    ';
    $notServicesButton = '
        <button onclick="modalTwoActive()" class="modalreateAserviceActiveButton">Создать ещё</button>
    ';
}



if (!$_SESSION['user'] ?? '') {
    header('Location: index.php');
}

if (isset($_SESSION['user']['cat']))
    $categories = mysqli_query($connect, "SELECT Opisanie FROM " . $_SESSION['user']['cat']);
else
    $categories = array();

function addNumbers($num)
{
    if ($num % 2 == 0) {
        return 'background: linear-gradient(91.94deg, #FFA7A7 3.09%, #9D6FFF 3.1%, #FF014E 139.14%)';
    } else if ($num % 3 == 0) {
        return 'background: linear-gradient(91.94deg, #FF6F6F 3.09%, #FF7B01 139.14%)';
    } else if ($num % 4 == 0) {
        return 'background: linear-gradient(71.65deg, #42FFDD -0.18%, #0176FF 100.3%)';
    } else {
        return 'background: linear-gradient(35.49deg, #0066FF -0.15%, #00FF66 76.43%)';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLE/index.css">
    <link rel="stylesheet" href="../STYLE/global.css">
    <link rel="stylesheet" href="../STYLE/modal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../STYLE/creatingAservice.css">
    <script src="../JS/createAservice.js"></script>

    <title>POS — Мои заказы</title>
    <link rel="icon" href="../IMG/POS-icon.svg">
</head>

<body>

    <div class="modalUserProfile" onclick="ProfileModalActive()">
        <div class="container">
            <div class="modalUserProfileWindow" onclick="event.stopPropagation()">
                <div class="modalUserProfileWindowInfo">
                    <div class="modalUserProfileWindowInfoAvatar" style="<?= $_SESSION['style'] ?>">
                        <?= $first_character ?>
                    </div>
                    <div class="modalUserProfileWindowInfoList">
                        <p class="modalUserProfileWindowInfoListName"><b>
                                <?= $userArr[0] ?>
                                <?= $userArr[1] ?>
                            </b></p>
                        <p class="modalUserProfileWindowInfoListMail">
                            <?= $_SESSION['user']['email'] ?>
                        </p>
                        <a href="#" class="modalUserProfileWindowInfoListEditProfile"><img
                                src="../IMG/modal/userEdit.svg" alt="">Редактировать профиль</a>
                    </div>
                </div>
                <p class="roleProfile">Вы вошли как <b>
                        <?= $role['name_role'] ?>
                    </b></p>
                <a href="#" class="modalUserProfileWindowButton"><button>Избранные исполнители</button></a>
                <a href="#" class="modalUserProfileWindowButton"><button>Услуги</button></a>
                <a href="../PAGE/LOGOUT/logOut.php" class="modalUserProfileWindowButton"
                    style="background: linear-gradient(91.94deg, #ff6f6f19 3.09%, #FF7B0119 139.14%);"><button
                        style="color: #000;">Выйти</button></a>
            </div>
        </div>
    </div>

    <nav>
        <div class="container">
            <a href="../PAGE/user.php" class="logo"></a>
            <div class="nav-text">
                <!-- <a>
                    <div class="auth-text">Создать заказ</div>
                </a> -->
                <a href="creatingAservice.php">
                    <div class="auth-text"><b>Мои заказы</b></div>
                </a>
                <a href="searchForOrders.php">
                    <div class="auth-text">Поиск закзазов</div>
                </a>
                <div class="nav-user-icon" onclick="ProfileModalActive()" style="<?= $_SESSION['style'] ?>"><?= $first_character ?></div>
            </div>
        </div>
    </nav>

    <div class="modalCreatingAservice" onclick="createAserviceModal()">
        <div onclick="event.stopPropagation()">
            <form onsubmit="return volidateFormCreate()" class="modalCreatingAserviceWindow" name="creatingAservice" action="bdСreatingAservice.php" method="post" enctype="multipart/form-data">
                <img src="../IMG/icons8-умножение-48.png" class="close-form" onclick="createAserviceModal()" alt="">
                <div class="form-floating mb">
                    <label for="floatingInput">Услуга</label>
                    <input type="text" class="form-control p0" name="serviceBriefly" id="floatingInput"
                        placeholder="Короткое название услуги"></input>
                    <div class="error" id="serviceBrieflyErr"></div>
                </div>

                <div class="form-floating mb">
                    <label for="floatingInput">Краткое описание</label>
                    <textarea class="form-control p0" maxlength='250' rows="4" placeholder="Расскажите коротко о задаче"
                        name="whatTask" id="floatingTextarea"></textarea>
                    <div class="error" id="whatTaskErr"></div>
                </div>

                <div class="form-container-two">
                    <div class="form-floating butjetOne mb">
                        <label for="floatingInput">Бюджет</label>
                        <input type="text" class="form-control butjet p0" name="budget" id="floatingInput"
                            placeholder="Бюджет до..."></input>
                    </div>

                    <div class="form-floating butjet">
                        <label for="floatingInput">Единица измерения</label>
                        <select id="standard-select" name="listUnitMeasurement">
                            <option value="" class="lng-choosAcat" hidden disabled selected>Выбирите из списка</option>
                            <?php foreach ($unitMeasurements as $key => $unitMeasurement): ?>
                                <option value=<?= $unitMeasurement['id_unit'] ?>><?= $unitMeasurement['unit_of_measurement'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="error" id="budgetAndlistUnitMeasurementErr"></div>

                <div class="modalCreatingAserviceWindowInfo">
                    <div class="modalCreatingAserviceWindowInfoItem">
                        <?= $_SESSION['city'] ?>
                    </div>
                    <div class="modalCreatingAserviceWindowInfoItem">
                        <input class="inputData" name="date" type="date">
                    </div>

                    <label class="input-file">
                        <input type="file" name="file_path">
                        <span>Выберите файл</span>
                    </label>
                </div>
                <div class="error" id="dateErr"></div>

                <div class="userInfoModal">
                    <div class="userInfoModalLeft">
                        <div class="userInfoModalLeftAvatar">
                            <?= $first_character ?>
                        </div>
                    </div>
                    <div class="userInfoModalRight">
                        <b>
                            <?= $userArr[0] ?>
                            <?= $userArr[1] ?>
                        </b>
                        <p class="modalUserProfileWindowInfoListMail">+7<?= $delFirstCharacter ?></p>
                        <p class="InfoBlockModalCreate">Исполнители видят ваш номер телефона и могут звонить вам сами
                        </p>
                    </div>

                </div>

                <div class="modalCreatingAserviceWindowBottom">
                    <div class="modalCreatingAserviceWindowBottomCatigoryModal" onclick="modalCatigories()">Выбрать
                        категорию </div>
                    <p id="fullCategories">
                        <?= $_SESSION['categoryFromTheSheet'] ?>
                        <?= $_SESSION['subcategory'] ?>
                    </p>
                    <button type="submit">Опубликовать</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modalCatigories" onclick="modalCatigories()">
        <div class="modalCatigoriesWindow" onclick="event.stopPropagation()">
            <h6>Выберите категорию</h6>
            <div class="modalCatigoriesWindowContainer">
                <div class="modalCatigoriesWindowLeft" alink=green>
                    <a href="categories.php?item=Arenda"><b>Аренда</b></a>
                    <a href="categories.php?item=Artist"><b>Артисты</b></a>
                    <a href="categories.php?item=Design"><b>Дизайнеры</b></a>
                    <a href="categories.php?item=FotoVideoAudio"><b>Фото, видео, аудио</b></a>
                    <a href="categories.php?item=Jivotnie"><b>Животные</b></a>
                    <a href="categories.php?item=Krasota"><b>Красота</b></a>
                    <a href="categories.php?item=Meropriiatie"><b>Мероприятия</b></a>
                    <a href="categories.php?item=OhranaAndDetective"><b>Охрана и детективы</b></a>
                    <a href="categories.php?item=PCandIT"><b>Компьютеры и IT</b></a>
                    <a href="categories.php?item=Perevozki"><b>Перевозки и курьеры</b></a>
                    <a href="categories.php?item=RemontAndBuild"><b>Ремонт и строительство</b></a>
                    <a href="categories.php?item=RemontAndUstanovka"><b>Ремонт и установка техники</b></a>
                    <a href="categories.php?item=RemontAvto"><b>Ремонт авто</b></a>
                    <a href="categories.php?item=Tvorchestvo"><b>Творчество, рукоделие и хобби</b></a>
                    <a href="categories.php?item=Yborka"><b>Хозяйство и уборка</b></a>
                    <a href="categories.php?item=YurDela"><b>Юристы</b></a>
                    <a href="categories.php?item=Raznoe"><b>Разное</b></a>
                </div>
                <div class="modalCatigoriesWindowRight">
                    <?php foreach ($categories as $categorie): ?>
                        <a href="nameCategories.php?description=<?= $categorie['Opisanie'] ?>">
                            <?= $categorie['Opisanie'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <img src="../IMG/icons8-умножение-48.png" class="close-form" onclick="modalCatigories()" alt="">
        </div>
    </div>

    <section class="sectionCreatingAservice">
        <div class="container">
            <div class="modalUserProfileWindowInfoOne">
                <?php
                if ($_SESSION['message'] ?? '') {
                    echo $_SESSION['message'];
                }
                unset($_SESSION['message']);
                ?>
            </div>
            <?= $notServices ?>
            <form method="post">
                <?php foreach ($bdMyServices as $key => $myServices): ?>
                    <div class="MyOrder">
                        <div class="MyOrderHeader">
                            <div class="MyOrderHeaderLeft">
                                <p class="MyOrderHeaderTitle">
                                    <?= $myServices['serviceBriefly'] ?>
                                </p>
                                <p class="MyOrderHeaderinfo"> <span>
                                        <?= $myServices['city'] ?>
                                    </span> <span>·</span> <span>
                                        <?= $myServices['date'] ?>
                                    </span> <span>·</span> <span>
                                        <?= $myServices['categories'] ?> ->
                                        <?= $myServices['categoryFromTheSheet'] ?>
                                </p>
                            </div>
                            <div class="MyOrderHeaderSale">
                                <p class="MyOrderHeaderSaleCell">до<span>
                                        <?= $myServices['summa'] ?>
                                    </span>₽</p>
                                <p class="MyOrderHeaderSaleEdinit">
                                    <?= $myServices['unit_of_measurement'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="MyOrderDescription">
                            <div class="MyOrderDescriptionPadding">
                                <p>
                                    <?= $myServices['task_description'] ?>
                                </p>
                            </div>
                        </div>
                        <?php $response = mysqli_query($connect, "SELECT * FROM `response` 
                            INNER JOIN `creatingAservice` ON response.services = creatingAservice.id_services INNER JOIN `users` 
                            ON response.user_responded = users.id_user where user = " . $idUser . " and services = " . $myServices['id_services']);

                        $count = 0; foreach ($response as $key => $value) {
                            $count++;
                        }
                        ?>

                        <p class="countOtclick">
                            <?= ($count != 0) ? "На ваш заказ откликнулось $count пользователя" : "На ваш заказ никто не откликнулся" ?>
                        </p>


                        <div class="userVidContainer">
                            <?php foreach ($response as $key => $value): ?>
                                <div class="userVid">
                                    <div class="userVidAvatar" style="<?= addNumbers($value['id_user']) ?>">
                                        <?= mb_substr(explode(" ", $value['name'])[1], 0, 1) ?>
                                    </div>
                                    <div class="userVidInfo">
                                        <p>
                                            <?= explode(" ", $value['name'])[1] ?>
                                        </p>
                                        <p>
                                            +7
                                            <?= substr($value['number'], 1, 10) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="submit"
                            formaction="removeCreatService.php?delete=<?= $myServices['id_services'] ?>">Удалить</button>
                    </div>
                <?php endforeach; ?>
            </form>

            <?= $notServicesButton ?>

            <div class="categoriesChoice">
                <?php
                if ($_SESSION['categoriesChoice'] ?? '' && $_SESSION['categoriesChoice'] == "модал") {
                    echo "<script>
                            window.onload = () => {
                                createAserviceModal();
                            }
                            </script>";
                    unset($_SESSION['categories']);
                }
                unset($_SESSION['categoriesChoice']);
                $_SESSION['categoriesChoice'] = "";
                ?>
            </div>

            <div class="categories">
                <?php
                if ($_SESSION['categories'] ?? '') {
                    echo "<script>
                            window.onload = () => {
                                modalCatigories();
                                createAserviceModal();
                            }
                            </script>";
                }
                unset($_SESSION['categories']);
                ?>
            </div>


        </div>
    </section>
</body>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script src="../JS/index.js"></script>

</html>