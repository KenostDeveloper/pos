<?php
session_start();
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
    <title>POS — Главная</title>
    <link rel="icon" href="../IMG/POS-icon.svg">
</head>

<div class="modalScrin" onclick="authModalActive()">
    <div class="modalWindow" onclick="event.stopPropagation()">
        <img src="../IMG/icons8-умножение-48.png" class="close-form" onclick="authModalActive()" alt="">
        <h6 class="modalWindowHead">Войти</h6>
        <form method="post" onsubmit="return volidateFormLog()" name="LogForm" class="auth-form" action="login.php">
            <div class="form-floating mb">
                <label for="floatingInput">Email</label>
                <input type="email" class="form-control" name="emailLog" id="floatingInput"
                    placeholder="Введите ваш email"></input>
                <img class="form-floating-img" src="../IMG/modal/smsemail.svg" alt="">
                <div class="error" id="emailLogErr"></div>
            </div>
            <div class="form-floating mb">
                <label for="floatingPassword">Пароль</label>
                <input type="password" class="form-control floatingPassword" name="passLog" id="floatingPassword"
                    placeholder="Введите пароль">
                <img class="form-floating-img" src="../IMG/modal/lock.svg" alt="">
                <img class="form-floating-img-pasword" id="img-paswordOne" src="../IMG/modal/eye-slashpassvord.svg"
                    alt="" onclick="TogglePasword()">
                <div class="error" id="passLogErr"></div>
            </div>

            <div href="#" class="forgot-pasword mb"><a href="changePassword.php">Забыли пароль?</a></div>

            <div class="form-button-a-cont">
                <button class="form-button" type="submit">Войти</button>
            </div>

            <div class="correctReg">
                <?php
                if ($_SESSION['correctReg'] ?? '') {
                    echo $_SESSION['correctReg'];
                }
                unset($_SESSION['correctReg']);
                ?>
            </div>

            <div class="notCorrectLogAndPass">
                <?php
                if ($_SESSION['notCorrectLogAndPass'] ?? '') {
                    echo $_SESSION['notCorrectLogAndPass'];
                }
                unset($_SESSION['notCorrectLogAndPass']);
                ?>
            </div>

            <p class="form-text-who">Ещё не зерегистрированы? <a onclick="registerModalActive()">Зарегистрироваться</a>
            </p>
        </form>
    </div>
</div>

<div class="modalScrinRegister" onclick="registerModalActive()">
    <div class="modalWindow" onclick="event.stopPropagation()">
        <img src="../IMG/icons8-умножение-48.png" class="close-form" onclick="registerModalActive()" alt="">
        <h6 class="modalWindowHead">Регистрация</h6>
        <form name="regForm" onsubmit="return validateFormReg()" method="post" class="auth-form" action="register.php">
            <div class="form-floating mb">
                <label for="floatingInput">Фамилия Имя Отчество</label>
                <input type="" class="form-control" name="name" id="floatingInput" placeholder="Введите ФИО"></input>
                <img class="form-floating-img" src="../IMG/modal/Group 9214.svg" alt="">
                <div class="error" id="nameErr"></div>
            </div>
            <div class="form-floating mb">
                <label for="floatingInput">Номер телефона</label>
                <input type="" class="form-control" name="number" id="floatingInput"
                    placeholder="Введите номер телефона"></input>
                <img class="form-floating-img" src="../IMG/modal/icons8-телефон-48 1.svg" alt="">
                <div class="error" id="numberErr"></div>
            </div>
            <div class="form-floating mb">
                <label for="floatingInput">Email</label>
                <input type="email" class="form-control" name="email" id="floatingInput"
                    placeholder="Введите ваш email"></input>
                <img class="form-floating-img" src="../IMG/modal/smsemail.svg" alt="">
                <div class="error" id="emailErr"></div>
            </div>
            <div class="form-floating mb">
                <label for="floatingInput">Описание</label>
                <textarea class="form-control" maxlength='250' rows="4" placeholder="Добавьте описание"
                    name="description" id="floatingTextarea"></textarea>
                <img class="form-floating-img" src="../IMG/modal/icons8-комментарии-48 1.svg" alt="">
                <div class="error" id="descriptionErr"></div>
            </div>
            <div class="form-floating mb">
                <label for="floatingPassword">Пароль</label>
                <input type="password" class="form-control floatingPassword1" name="password" id="floatingPassword"
                    placeholder="Введите пароль">
                <img class="form-floating-img" src="../IMG/modal/lock.svg" alt="">
                <img class="form-floating-img-pasword" src="../IMG/modal/eye-slashpassvord.svg" alt=""
                    id="img-paswordTwo" onclick="TogglePasword1()">
                <div class="error" id="passwordErr"></div>
            </div>
            <div class="form-floating mb">
                <label for="floatingPassword">Повторите пароль</label>
                <input type="password" class="form-control floatingPassword2" name="repeatPassword"
                    id="floatingPassword" name="repeatPassword" placeholder="Введите пароль ещё раз">
                <img class="form-floating-img" src="../IMG/modal/lock.svg" alt="">
                <img class="form-floating-img-pasword" src="../IMG/modal/eye-slashpassvord.svg" alt=""
                    id="img-paswordThee" onclick="TogglePasword2()">
                <div class="error" id="repeatPasswordErr"></div>
            </div>

            <div class="form-floating-label">Выберите роль</div>
            <label class="toggle" onclick="whyText()">
                <div class="toggleCeneter">
                    <input class="toggle-checkbox" id="userRole" type="checkbox" value=1 name="userRole">
                    <div class="toggle-switch"></div>
                    <span class="toggle-label">Я исполнитель</span>
                </div>
            </label>

            <div class="form-button-a-cont">
                <button class="form-button" type="submit">Зарегистрироваться</button>
            </div>

            <p class="form-text-who">Уже зарегистрированы? <a onclick="authModalActive()">Войти</a></p>
        </form>
    </div>
</div>

<body>
    <nav>
        <div class="container">
            <a href="/" class="logo"></a>
            <div class="nav-text">
                <div class="country"><img src="../IMG/metka.svg" alt="">Пермь</div>
                <div class="auth-text" onclick="authModalActive()">Авторизация</div>
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
                <div class="mainSectionRightButtons">
                    <button class="mainSectionRightButtons1" onclick="registerModalActive()">Зарегистрироваться</button>
                    <span>или</span>
                    <button class="mainSectionRightButtons2" onclick="authModalActive()">Войти</button>
                </div>
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
            <div class="WhySectionInfo">Если сомневаетесь в качестве выполненной работы - напишите нам! Мы поможем
                решить спор</div>
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

    <div class="changePass">
        <?php
        if ($_SESSION['message'] ?? '') {
            echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
        ?>
    </div>
    <div class="authModal">
        <?php
        if ($_SESSION['authModal'] ?? '') {
            echo "<script>
            window.onload = () => {
                authModalActive();
            }
            </script>";
        }
        unset($_SESSION['authModal']);
        ?>
    </div>
</body>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script src="../JS/index.js"></script>

<!-- Volidate Register -->
<script src="../JS/register.js"></script>

<script src="../JS/login.js"></script>

</html>