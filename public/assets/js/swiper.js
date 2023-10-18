var swiper = new Swiper(".mySwiper", {
  slidesPerView: 0,
  centeredSlides: false,
  spaceBetween: 10,
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
      slidesPerView: 2, // 2 card per tampilan
    },
    280: {
      slidesPerView: 2, // 2 card per tampilan
    },
  },
  navigation: {
    nextEl: '.button-next',
    prevEl: '.button-prev',
},

  });

  var swiper = new Swiper(".mySwung", {
    slidesPerView: 2,
    centeredSlides: false,
    spaceBetween: 10,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  
    breakpoints: {
      // Tampilan iPad (lebar >= 768px)
      1280: {
        slidesPerView: 2, // 3 card per tampilan
  
      },
      // Tampilan iPad (lebar >= 768px)
      768: {
        slidesPerView: 3, // 3 card per tampilan
      },
      
    },
  
    });

  var swiper = new Swiper(".mySweety", {
    slidesPerView: 1,
    centeredSlides: false,
    spaceBetween: 10,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  
    breakpoints: {

      375: {
        slidesPerView: 2, // 2 card per tampilan
      },

      768: {
        slidesPerView: 4, // 3 card per tampilan
      },
      280: {
        slidesPerView: 2, // tampilan galaxo fold
      },
    },
  navigation: {
    nextEl: '.button-next',
    prevEl: '.button-prev',
},
  
    });


  var swiper = new Swiper(".btn-sub", {
    slidesPerView: 'auto',
    spaceBetween: 10,
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
        slidesPerView: 2, // 2 card per tampilan
      },
      280: {
        slidesPerView: 2, // tampilan galaxo fold
      },
    },
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
  },
  });


 






 

  