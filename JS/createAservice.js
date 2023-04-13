function createAserviceModal() {
    document.querySelector('.modalCreatingAservice').classList.toggle('active');
}

function modalCatigories() {
    document.querySelector('.modalCatigories').classList.toggle('active');
}

function modalTwoActive() {
    createAserviceModal();
    modalCatigories();
}

function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg
} 

function volidateFormCreate() {
    let serviceBriefly = document.creatingAservice.serviceBriefly.value
    let whatTask = document.creatingAservice.whatTask.value
    let budget = document.creatingAservice.budget.value
    let listUnitMeasurement = document.creatingAservice.listUnitMeasurement.value
    let data = document.creatingAservice.date.value;

    let serviceBrieflyErr = whatTaskErr = budgetAndlistUnitMeasurementErr = dateErr = true;

    if (serviceBriefly == "") {
        printError("serviceBrieflyErr", "Пожалуйста, введите ваше имя");
    } else {
        let regex = /[^-А-ЯA-Z\x27а-яa-z]/;
        if (regex.test(serviceBriefly) === false) {
            printError("serviceBrieflyErr", "Пожалуйста, введиете корректную услугу");
        } else {
            printError("serviceBrieflyErr", "");
            serviceBrieflyErr = false;
        }
    }

    if (whatTask == "") {
        printError("whatTaskErr", "Пожалуйста введите описание");
    } else {
        let regex = /^[\w\W.!?",:;()_ ]{0,460}$/g;
        if (regex.test(whatTask) === false) {
            printError("whatTaskErr", "Извените «Описание» не должно превышать 250 символов");
        } else {
            printError("dwhatTaskErr", "");
            whatTaskErr = false;
        }
    }

    if (budget == "" || listUnitMeasurement == "") {
        printError("budgetAndlistUnitMeasurementErr", "Введите бюджет или выберите единицу измерени");
    } else {
        let regex = /^[0-9]+$/g;
        if (regex.test(budget) === false) {
            printError("budgetAndlistUnitMeasurementErr", "Введите число в поле бюджет!");
        } else {
            printError("budgetAndlistUnitMeasurementErr", "");
            budgetAndlistUnitMeasurementErr = false;
        }
    }

    if (data == "") {
        printError("dateErr", "Выберите дату");
    } else {
        printError("dateErr", "");
        dateErr = false;
    }

    if ((serviceBrieflyErr || whatTaskErr || budgetErr || listUnitMeasurementLogErr || dateErr)) {
        return false;
    }
}