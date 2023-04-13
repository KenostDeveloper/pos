<?php
session_start();
require_once("../DB/db.php");

$userArr = explode(" ", $_SESSION['user']['name']);
$first_character = mb_substr($userArr[1], 0, 1);

$idUser = $_SESSION['user']['id_user'];

$numberArrConvert = (string) $_SESSION['user']['number'];
$delFirstCharacter = substr($numberArrConvert, 1, 10);

$role = mysqli_query($connect, "SELECT name_role FROM `users` INNER JOIN `role` ON users.role = role.id_role WHERE id_user = '$idUser'");
$role = mysqli_fetch_assoc($role);

$listOfOrders = mysqli_query($connect, "SELECT * FROM `creatingAservice` INNER JOIN `users` 
ON creatingAservice.user = users.id_user INNER JOIN `unitMeasurement` ON creatingAservice.id_unit = unitMeasurement.id_unit where user not in ('$idUser')");

if (!$_SESSION['user'] ?? '') {
    header('Location: index.php');
}

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
    <link rel="stylesheet" href="../STYLE/creatingAservice.css">
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
                    <div class="auth-text">Мои заказы</div>
                </a>
                <a href="searchForOrders.php">
                    <div class="auth-text"><b>Поиск закзазов</b></div>
                </a>
                <div class="nav-user-icon" onclick="ProfileModalActive()" style="<?= $_SESSION['style'] ?>"><?= $first_character ?></div>
            </div>
        </div>
    </nav>

    <section class="OrdersAllUsers">
        <div class="container">
            <div class="response">
                <?php
                if ($_SESSION['response'] ?? '') {
                    echo $_SESSION['response'];
                }
                unset($_SESSION['response']);
                ?>
            </div>
            <h6>Заказы</h6>
            <form method="post">
                <?php foreach ($listOfOrders as $key => $listOfOrder): ?>
                    <div class="MyOrder">
                        <div class="MyOrderHeader">
                            <div class="MyOrderHeaderLeft">
                                <p class="MyOrderHeaderTitle">
                                    <?= $listOfOrder['serviceBriefly'] ?>
                                </p>
                                <p class="MyOrderHeaderinfo"> <span>
                                        <?= $listOfOrder['city'] ?>
                                    </span> <span>·</span> <span>
                                        <?= $listOfOrder['date'] ?>
                                    </span> <span>·</span> <span>
                                        <?= $listOfOrder['categories'] ?> ->
                                        <?= $listOfOrder['categoryFromTheSheet'] ?>
                                    </p>
                            </div>
                            <div class="MyOrderHeaderSale">
                                <p class="MyOrderHeaderSaleCell">до<span>
                                        <?= $listOfOrder['summa'] ?>
                                    </span>₽</p>
                                <p class="MyOrderHeaderSaleEdinit">
                                    <?= $listOfOrder['unit_of_measurement'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="MyOrderDescription">
                            <div class="MyOrderDescriptionPadding">
                                <p>
                                    <?= $listOfOrder['task_description'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="MyOrderBottom">
                            <div class="MyOrderBottomLeft">
                                <div class="MyOrderBottomLeftAvatar" style="<?= addNumbers($listOfOrder['user']) ?>">
                                    <?= mb_substr(explode(" ", $listOfOrder['name'])[1], 0, 1) ?>
                                </div>
                                <div class="MyOrderBottomLeftUserInfo">
                                    <p class="MyOrderBottomLeftAvatarName">
                                        <?= explode(" ", $listOfOrder['name'])[1] ?>
                                    </p>
                                    <p class="MyOrderBottomLeftTelephone"> ID:
                                        #
                                        <?= $listOfOrder['id_services'] ?>
                                    </p>
                                    <p class="MyOrderBottomLeftTelephone">
                                        <?= $listOfOrder['email'] ?>
                                    </p>
                                    <p class="MyOrderBottomLeftTelephone">
                                        +7<?= substr($listOfOrder['number'], 1, 10) ?>
                                    </p>
                                </div>
                            </div>
                            <input class="MyOrderBottomOtclick"
                                formaction="response.php?id=<?= $listOfOrder['id_services'] ?>" value="Откликнуться"
                                type="submit">
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>
        </div>
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