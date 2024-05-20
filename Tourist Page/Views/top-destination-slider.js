var topDestSwiper  = new Swiper(".TopDest-content",{
  slidesPerView: 2,
  spaceBetween: 100,
  loop: true,
  centerSlide:'true',
  fade:'true',
  grabCursor: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
      nextEl: ".top-dest-next",
      prevEl: ".top-dest-prev",
  },

  breakpoints: {

    0: {
      slidesPerView: 1,
    },

    520:{
      slidesPerView: 2,
    },
    
    950:{
      slidesPerView: 3,
    },


    },
});