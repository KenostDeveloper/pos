<?php
session_start();
require_once("../DB/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLE/ChangePassword.css">
    <link rel="stylesheet" href="../STYLE/index.css">
    <link rel="stylesheet" href="../STYLE/modal.css">
    <link rel="stylesheet" href="../STYLE/global.css">
    <title>POS — Сменить пароль</title>
    <link rel="icon" href="../../PAS/IMG/POS.svg">
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
            <a href="../PAGE/index.php" class="logo"></a>
            <div class="nav-text">
                <div class="country"><img src="../IMG/metka.svg" alt="">Пермь</div>
                <div class="auth-text" onclick="authModalActive()">Авторизация</div>
            </div>
        </div>
    </nav>

    <section class="ChangeSection">
        <div class="container">
            <form action="changePass.php" method="post">
            <h6 class="modalWindowHead">Смена пароля</h6>
            <div class="form-floating mb">
                <label for="floatingInput">Email</label>
                <input type="email" name="email" class="form-control"id="floatingInput"
                    placeholder="Введите ваш email"></input>
                <img class="form-floating-img" src="../IMG/modal/smsemail.svg" alt="">
                <div class="error" id="emailErr"></div>
            </div>
            <div class="form-floating mb">
                <label for="floatingPassword">Пароль</label>
                <input type="password" name="oldPassword" class="form-control floatingPassword4" id="floatingPassword"
                    placeholder="Введите пароль">
                <img class="form-floating-img" src="../IMG/modal/lock.svg" alt="">
                <img class="form-floating-img-pasword" src="../IMG/modal/eye-slashpassvord.svg" alt=""
                    id="img-paswordTwo" onclick="TogglePasword3()">
                <div class="error" id="passwordErr"></div>
            </div>
            <div class="form-floating mb">
                <label for="floatingPassword">Повторите пароль</label>
                <input type="password" name="newPassword" class="form-control floatingPassword5" id="floatingPassword" placeholder="Введите пароль ещё раз">
                <img class="form-floating-img" src="../IMG/modal/lock.svg" alt="">
                <img class="form-floating-img-pasword" src="../IMG/modal/eye-slashpassvord.svg" alt=""
                    id="img-paswordThee" onclick="TogglePasword4()">
                <div class="error" id="repeatPasswordErr"></div>
            </div>
            <div class="form-button-a-cont">
                <button class="form-button" type="submit">Сменить пароль</button>
            </div>
                <div>
                    <?php
                    if ($_SESSION['message'] ?? '') {
                        echo $_SESSION['message'];
                    }
                    unset($_SESSION['message']);
                    ?>
                </div>
            </form>
        </div>
    </section>


    <script src="../JS/change.js"></script>
</body>

</html>