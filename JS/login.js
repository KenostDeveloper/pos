function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
} 

function volidateFormLog() {
    let emailLog = document.LogForm.emailLog.value;
    let passLog = document.LogForm.passLog.value;

    let emailLogErr = passLogErr = true;

    if (emailLog == "") {
        printError('emailLogErr', 'Пожалуйста введите свою почту');
    } else {
        printError('emailLogErr', '');
        emailLogErr = false;
    }

    if (passLog == "") {
        printError('passLogErr', 'Пожалуйста введите свой пароль');
    } else {
        printError('passLogErr', '');
        passLogErr = false;
    }

    if ((emailLogErr || passLogErr) === true) {
        return false;
    }
}