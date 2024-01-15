// Слайдер "Наше производство" (библиотека swiper js)

const swiper = new Swiper(".swiper", {
  direction: "horizontal",
  spaceBetween: "2%",
  loop: false,
});

const prevBtn = document.querySelector(".slider-control__left");
const nextBtn = document.querySelector(".slider-control__right");
const activeSlide = document.querySelector(".slider-control_active");
const mobIndicators = document.querySelectorAll(".slider-indicators li");

window.addEventListener("DOMContentLoaded", function () {
  mobIndicators[0].classList.add("active");
});

function slideChange() {
  const activeNum = swiper.activeIndex + 1;

  if (window.screen.width > 700) activeSlide.innerHTML = activeNum;
  else {
    for (let i of mobIndicators) {
      i.classList.remove("active");
    }
    mobIndicators[activeNum - 1].classList.add("active");
  }
}

function nextSlide() {
  swiper.slideNext(1000, false);
  slideChange();
}

function prevSlide() {
  swiper.slidePrev(1000, false);
  slideChange();
}

swiper.on("slideChange", function () {
  slideChange();
});
nextBtn.addEventListener("click", nextSlide);
prevBtn.addEventListener("click", prevSlide);
for (let i = 0; i < mobIndicators.length; i++) {
  mobIndicators[i].addEventListener("click", () => {
    swiper.slideTo(i, 1000, false);
    slideChange();
  });
}

//////////////////////////////////////////////////////
// Прокрутка при нажатии на кнопку "Узнать подробнее"

$('a[href^="#"]').on("click", function (event) {
  event.preventDefault();
  var sc = $(this).attr("href"),
    dn = $(sc).offset().top;
  $("html, body").animate({ scrollTop: dn }, 1000);
});
