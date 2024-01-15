// слайдер

const slidesPerView = 4;
const speed = 1200;

const swiper_thumbnail = new Swiper(".swiper_thumbnail", {
  slidesPerView: slidesPerView,
  speed: 1000,
  //   autoScrollOffset: 1,
});

const swiper_item = new Swiper(".item__slider", {
  direction: "horizontal",
  spaceBetween: "2%",
  speed: speed,
  loop: false,

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  thumbs: {
    swiper: swiper_thumbnail,
  },
});

swiper_thumbnail.on("click", function () {
  if (
    swiper_thumbnail.clickedIndex ==
    swiper_thumbnail.visibleSlidesIndexes[slidesPerView - 1]
  ) {
    swiper_thumbnail.slideTo(
      swiper_thumbnail.clickedIndex - slidesPerView + 2,
      speed,
      false
    );
  }

  if (
    swiper_thumbnail.clickedIndex == swiper_thumbnail.visibleSlidesIndexes[0]
  ) {
    swiper_thumbnail.slideTo(swiper_thumbnail.clickedIndex - 1, speed, false);
  }
});

// Fancybox
Fancybox.bind('[data-fancybox="gallery"]', {
  hideScrollbar: true,
});

// Редактирование цены (добавление точки)
const cost = document.querySelector(".item__cost");

cost.innerHTML = cost.textContent
  .toString()
  .replace(/\B(?=(\d{3})+(?!\d))/g, ".");

// работа с навигацией под слайдером
const navBtns = document.querySelectorAll(".info__nav-btn");
let navBtnActive = document.querySelector(".info__nav-btn.active");
const infos = document.querySelectorAll(".info__paragraph");
let infoActive = document.querySelector(".info__paragraph.active");

const setActive = (el, index) => {
  navBtnActive.classList.remove("active");
  el.classList.add("active");
  navBtnActive = el;
  infoActive.classList.remove("active");
  infos[index].classList.add("active");
  infoActive = infos[index];
};

navBtns.forEach((el, index) => {
  el.addEventListener("click", () => {
    setActive(el, index);
  });
  el.addEventListener("keydown", (e) => {
    if (e.code === "Enter") setActive(el, index);
  });
});
