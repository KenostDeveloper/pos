function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

function validateFormReg() {
    let name = document.regForm.name.value;
    let number = document.regForm.number.value;
    let email = document.regForm.email.value;
    let description = document.regForm.description.value;
    let password = document.regForm.password.value;
    let repeatPassword = document.regForm.repeatPassword.value;

    let nameErr = numberErr = emailErr = descriptionErr = passwordErr = repeatPasswordErr = true;

    if (name == "") {
        printError("nameErr", "Пожалуйста, введите ваше имя");
    } else {
        let regex = /[^-А-ЯA-Z\x27а-яa-z]/;
        if (regex.test(name) === false) {
            printError("nameErr", "Пожалуйста, введиете правильное ФИО");
        } else {
            printError("nameErr", "");
            nameErr = false;
        }
    }

    if (number == "") {
        printError("numberErr", "Пожалуйста введите коррекен ваш номер телефона");
    } else {
        let regex = /^\d{11}$/;
        if (regex.test(number) === false) {
            printError("numberErr", "Пожалуйста проверьте правильность набранного номера");
        } else {
            printError("numberErr", "");
            numberErr = false;
        }
    }

    if (email == "") {
        printError("emailErr", "Пожалуйста введите корректную почту");
    } else {
        let regex = /^\S+@\S+\.\S+$/;
        if (regex.test(email) === false) {
            printError("emailErr", "Пожалуйста, проверьте корректна ли ваша почта");
        } else {
            printError("emailErr", "");
            emailErr = false;
        }
    }

    if (description == "") {
        printError("descriptionErr", "");
    } else {
        let regex = /^[\w\W.!?",:;()_ ]{0,460}$/g;
        if (regex.test(description) === false) {
            printError("descriptionErr", "Извените «Описание» не должно превышать 250 символов");
        } else {
            printError("descriptionErr", "");
            descriptionErr = false;
        }
    }

    if (password == "") {
        printError("passwordErr", "Введите пароль");
    } else {
        let regex = /^.*(?=.{8,120})(?!.*\s)(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&?_ "]).*$/;
        if (regex.test(password) === false) {
            let indicationForThePassword = "Пароль должен состоять: \n" +
                "Минимум 1 цифра \n" +
                "Не менее 1-го специального символа \n" +
                "Не менне 3-х буквенных символов \n" +
                "Не меньше 8-ми символов \n" +
                "Не должно содержать пробелов";
            alert(indicationForThePassword);
        } else { 
            printError("passwordErr", "");
            passwordErr = false;
        }
    }

    if (repeatPassword == "") {
        printError('repeatPasswordErr', "Пожалуйста, введите подверждение пароля");
    } else {
        if (password !== repeatPassword) {
            printError("repeatPasswordErr", "Пароли должны совпадать");
        } else {
            printError("repeatPasswordErr", "");
            repeatPasswordErr = false;
        }
    }

    if ((nameErr || numberErr || emailErr || descriptionErr || passwordErr || repeatPasswordErr) === true) {
        return false;
    }
}