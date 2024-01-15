// открытие-закрытие планшетного и мобильного меню с подменю

const header__burger = document.querySelector(".header__burger");
const headerMenu = document.querySelector(".header__mob-menu-list");
const overlay = document.querySelector(".header__overlay");
const button1025 = document.getElementById("button_1025");
const productsList = document.querySelector(".header__products-list");
const button650 = document.getElementById("button_650");
const productsList650 = document.querySelector(".products-list_650");

// бургер
function switchMobMenu() {
  header__burger.classList.toggle("active");
  timeGap(headerMenu);
  headerMenu.classList.toggle("active");
  timeGap(overlay);
  overlay.classList.toggle("active");
  document.body.classList.toggle("lock");
}

// меню продуктов в планшетной версии
function switchProdMenu() {
  timeGap(productsList);
  productsList.classList.toggle("active");
}

// меню продуктов в мобильной версии
function switchMobProdMenu() {
  timeGap(productsList650);
  productsList650.classList.toggle("active");
}

function timeGap(selector) {
  if (!selector.classList.contains("active")) {
    selector.classList.toggle("visually-hidden");
  } else {
    setTimeout(() => {
      selector.classList.toggle("visually-hidden");
    }, 500);
  }
}

header__burger.addEventListener("click", switchMobMenu);
button1025.addEventListener("click", switchProdMenu);
button650.addEventListener("click", switchMobProdMenu);
