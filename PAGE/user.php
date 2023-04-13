<?php
session_start();
require_once("../DB/db.php");

$userArr = explode(" ", $_SESSION['user']['name']);
$first_character = mb_substr($userArr[1], 0, 1);
$idUser = $_SESSION['user']['id_user'];

$role = mysqli_query($connect, "SELECT name_role FROM `users` INNER JOIN `role` ON users.role = role.id_role WHERE id_user = '$idUser'");
$role = mysqli_fetch_assoc($role);

if (!$_SESSION['user'] ?? '') {
    header('Location: index.php');
}

if ($_SESSION['user']['id_user'] % 2 == 0) {
    $_SESSION['style'] = 'background: linear-gradient(91.94deg, #FFA7A7 3.09%, #9D6FFF 3.1%, #FF014E 139.14%)';
} else if ($_SESSION['user']['id_user'] % 3 == 0) {
    $_SESSION['style'] = 'background: linear-gradient(91.94deg, #FF6F6F 3.09%, #FF7B01 139.14%)';
} else if ($_SESSION['user']['id_user'] % 4 == 0) {
    $_SESSION['style'] = 'background: linear-gradient(71.65deg, #42FFDD -0.18%, #0176FF 100.3%)';
} else{
    $_SESSION['style'] = 'background: linear-gradient(35.49deg, #0066FF -0.15%, #00FF66 76.43%)';
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
    <link rel="icon" href="../IMG/POS-icon.svg">

    <title>POS — Главная</title>
</head>

<body>

    <div class="modalUserProfile" onclick="ProfileModalActive()">
        <div class="container">
            <div class="modalUserProfileWindow" onclick="event.stopPropagation()">
                <div class="modalUserProfileWindowInfo">
                    <div class="modalUserProfileWindowInfoAvatar" style="<?= $_SESSION['style'] ?>"><?= $first_character ?></div>
                    <div class="modalUserProfileWindowInfoList">
                        <p class="modalUserProfileWindowInfoListName"><b><?= $userArr[0] ?> <?= $userArr[1] ?></b></p>   
                        <p class="modalUserProfileWindowInfoListMail"><?= $_SESSION['user']['email'] ?></p>
                        <a href="#" class="modalUserProfileWindowInfoListEditProfile"><img
                                src="../IMG/modal/userEdit.svg" alt="">Редактировать профиль</a>
                    </div>
                </div>
                <p class="roleProfile">Вы вошли как <b><?= $role['name_role'] ?></b></p>
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
                <!-- <a><div class="auth-text">Создать заказ</div></a> -->
                <a href="creatingAservice.php"><div class="auth-text">Мои заказы</div></a>
                <a href="searchForOrders.php"><div class="auth-text">Поиск закзазов</div></a>
                <div class="nav-user-icon" onclick="ProfileModalActive()" style="<?= $_SESSION['style'] ?>"><?= $first_character ?></div>
            </div>
        </div>
    </nav>

    <section class="mainSection">
        <div class="container">
            <div class="mainSectionLeft">
                <img src="../IMG/main-left.png" alt="">
            </div>
            <div class="mainSectionRight">
                <div class="mainSectionRightText">
                    Поможем найти <br><span>клиентов</span> и разместить <br><span>объявление</span>
                </div>
                <!-- <div class="mainSectionRightButtons">
                    <button class="mainSectionRightButtons1">Создать объявление</button>
                    <span>или</span>
                    <button class="mainSectionRightButtons2">Найти клиента</button>
                </div> -->
            </div>
        </div>
    </section>

    <section class="twoSection">
    <div class="container">
            <h6>Предоставляемые виды услуг</h6>
            <div class="swiper swiper-two">
                <div class="swiper-wrapper">
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-1.png)">
                            <div class="twoSection-card-container-button">Сделать ремонт</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-2.png)">
                            <div class="twoSection-card-container-button">Собрать компьютер</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-3.png)">
                            <div class="twoSection-card-container-button">Доставить посылку</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-4.png)">
                            <div class="twoSection-card-container-button">Вывезти мусор</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-5.png)">
                            <div class="twoSection-card-container-button">Выгулять собаку</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-6.png)">
                            <div class="twoSection-card-container-button">Убрать квартиру</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-7.png)">
                            <div class="twoSection-card-container-button">Починить розетку</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-8.png)">
                            <div class="twoSection-card-container-button">Починить телефон</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-9.png)">
                            <div class="twoSection-card-container-button">Установить окно</div>
                        </div>
                    </div>
                    <div class="swiper-slide twoSection-card">
                        <div class="twoSection-card-container" style="background-image: url(../IMG/Card-10.png)">
                            <div class="twoSection-card-container-button">Починить кран</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <section class="helpSection">
        <div class="container">
            <div class="helpSectionBlock">Клиентам поможем с <br> подбором исполнителя </div>
            <div class="helpSectionBlock">Исполнителю поможем <br> с поиском работы</div>
        </div>
    </section>

    <section class="WhySection">
        <div class="container">
            <img class="WhySectionImg" src="../IMG/WhoSection.png" alt="">
            <div class="WhySectionInfo">Если сомневаетесь в качестве выполненной работы - напишите нам! Мы поможем решить спор</div>
            <img class="WhySectionImgPos" src="../IMG/PosTwo.svg" alt="">
        </div>
    </section>

    <section class="carusel">
        <div class="container">
            
            <div class="caruselBox">
                <div class="leftShadow"></div>
                <div class="rightShadow"></div>
                <img src="../IMG/karucel.png" alt="">
            </div>
        <div>
    </section>

    <footer>
        <div class="container">
            <div class="footerBlock">
                <a href="">О сервисе</a>
                <a href="">Журнал</a>
                <a href="">Дополнительные услуги</a>
            </div>
            <div class="footerBlock">
                <a href="">Создать заказ</a>
                <a href="">Написать в поддержку</a>
                <a href="">Дополнительные услуги</a>
            </div>
            <div class="footerBlock">
                <a href="">По юридическим вопросам</a>
                <a href="">Пользовательское соглашение</a>
            </div>
        </div>
    </footer>
</body>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script src="../JS/index.js"></script>

</html>