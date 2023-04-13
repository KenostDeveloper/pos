var swiper = new Swiper(".TheeSwiper", {
  autoplay: {
    delay: 10000,
  },
  effect: 'fade',
  allowTouchMove: false,
});

var swiper = new Swiper(".mySwiper", {
  autoplay: {
    delay: 10000,
  },
  allowTouchMove: false,
});

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

const rules = document.querySelector('.toggle-checkbox');
const Text = document.querySelector('.toggle-label');

function whyText() {
  if (rules.checked) {
    Text.innerHTML = "Я заказчик";
  } else {
    Text.innerHTML = "Я исполнитель";
  }
}


var swiper = new Swiper('.swiper-two', {
  slidesPerView: 5,
  direction: getDirection(),
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  on: {
    resize: function () {
      swiper.changeDirection(getDirection());
    },
  },
});

function getDirection() {
  var windowWidth = window.innerWidth;
  var direction = window.innerWidth <= 760 ? 'vertical' : 'horizontal';

  return direction;
}

const paswordInput = document.querySelector('.floatingPassword');
const paswordInput1 = document.querySelector('.floatingPassword1');
const paswordInput2 = document.querySelector('.floatingPassword2');

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