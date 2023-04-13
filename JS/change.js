
const authModal = document.querySelector('.modalScrin')
const registerModal = document.querySelector('.modalScrinRegister')

function authModalActive() {
  authModal.classList.toggle('active');
  registerModal.classList.remove('active');
}

function registerModalActive() {
  registerModal.classList.toggle('active');
  authModal.classList.remove('active');
}

function ProfileModalActive() {
  document.querySelector('.modalUserProfile').classList.toggle('active');
}

const paswordInput = document.querySelector('.floatingPassword');
const paswordInput1 = document.querySelector('.floatingPassword1');
const paswordInput2 = document.querySelector('.floatingPassword2');

const paswordInput4 = document.querySelector('.floatingPassword4');
const paswordInput5 = document.querySelector('.floatingPassword5');

function TogglePasword(){
    if (paswordInput.type === "password") {
      paswordInput.type = "text";
      document.getElementById('img-paswordOne').src = "../IMG/modal/glass.svg"
    }
    else {
      paswordInput.type = "password";
      document.getElementById('img-paswordOne').src = "../IMG/modal/eye-slashpassvord.svg";
    }
  }
  
  function TogglePasword1(){
    if (paswordInput1.type === "password") {
      paswordInput1.type = "text";
      document.getElementById('img-paswordTwo').src = "../IMG/modal/glass.svg"
    }
    else {
      paswordInput1.type = "password";
      document.getElementById('img-paswordTwo').src = "../IMG/modal/eye-slashpassvord.svg";
    }
  }
  
  function TogglePasword2(){
    if (paswordInput2.type === "password") {
      paswordInput2.type = "text";
      document.getElementById('img-paswordThee').src = "../IMG/modal/glass.svg"
    }
    else {
      paswordInput2.type = "password";
      document.getElementById('img-paswordThee').src = "../IMG/modal/eye-slashpassvord.svg"
    }
  }

  function TogglePasword3(){
    if (paswordInput4.type === "password") {
        paswordInput4.type = "text";
      document.getElementById('img-paswordThee').src = "../IMG/modal/glass.svg"
    }
    else {
        paswordInput4.type = "password";
      document.getElementById('img-paswordThee').src = "../IMG/modal/eye-slashpassvord.svg"
    }
  }

  function TogglePasword4(){
    if (paswordInput5.type === "password") {
        paswordInput5.type = "text";
      document.getElementById('img-paswordThee').src = "../IMG/modal/glass.svg"
    }
    else {
        paswordInput5.type = "password";
      document.getElementById('img-paswordThee').src = "../IMG/modal/eye-slashpassvord.svg"
    }
  }