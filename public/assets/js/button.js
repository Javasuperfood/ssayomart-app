var swiper = new Swiper(".buttonSwiper", {
    slidesPerView: 4,
    centeredSlides: true,
    spaceBetween: 5,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      // Tampilan iPad (lebar >= 768px)
      1280: {
        slidesPerView: 6, // 3 card per tampilan
      },
      // Tampilan iPad (lebar >= 768px)
      768: {
        slidesPerView: 4, // 3 card per tampilan
      },
      // Tampilan Mobile (lebar < 768px)
      375: {
        slidesPerView: 3, // 2 card per tampilan
      },
    },

});