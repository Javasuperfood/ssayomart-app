<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Banner Mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container">
            <div class="swiper mySwiper" style="position: relative; margin-bottom:27px; margin-top:105px;">
                <div class="swiper-wrapper d-flex">
                    <?php foreach ($banner as $b) : ?>
                        <div class="swiper-slide">
                            <a href="<?= base_url(); ?>content-banner/<?= $b['id_banner']; ?>">
                                <img src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="d-block w-100 h-100 rounded-4" alt="<?= $b['title']; ?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Previous button centered within the image -->
                <!-- <div class="position-absolute start-0 top-50 translate-middle-y button-prev rounded-circle d-flex align-items-center" style="z-index: 2; width: 30px; height: 30px;">
                    <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                </div> -->

                <!-- Next button centered within the image -->
                <!-- <div class="position-absolute end-0 top-50 translate-middle-y button-next rounded-circle d-flex align-items-center" style="z-index: 2; width: 30px; height: 30px;">
                    <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div> -->
            </div>
        </div>
    </div>
    <style>
        .swiper-container {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <script>
        var mySwiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // autoplay: {
            //     delay: 5000, // Ganti dengan interval otomatis yang diinginkan (dalam milidetik)
            // },

            simulateTouch: true, // Mengaktifkan kemampuan swipe manual
            breakpoints: {
                // Breakpoint untuk mode mobile
                768: {
                    slidesPerView: 1,
                },
            },
        });
    </script>
<?php else : ?>
    <!-- End Banner Mobile -->

    <!-- Banner Desktop -->
    <div id="desktopContent" style="margin-top: 120px;">

        <!-- Swiper Js -->
        <!-- <div class="container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper d-flex justify-content-center align-items-center">
                    <?php foreach ($banner as $b) : ?>
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="text-bg-light bg-white">
                                <div class="card-body">
                                    <a href="<?= base_url(); ?>content-banner/<?= $b['id_banner']; ?>">
                                        <img src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="d-block w-100 rounded-3" alt="<?= $b['title']; ?>">
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <style>
            .swiper-container {
                width: 100%;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
        <script>
            var mySwiper = new Swiper('.mySwiper', {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000, // Ganti dengan interval otomatis yang diinginkan (dalam milidetik)
                },

                simulateTouch: true, // Mengaktifkan kemampuan swipe manual
                breakpoints: {
                    // Breakpoint untuk mode mobile
                    768: {
                        slidesPerView: 1,
                    },
                },
            });
        </script> -->
        <!--end Swiper Js -->

        <!-- Carousel -->
        <style>
            .carousel-slider {
                display: flex;
                justify-content: space-between;
                transition: transform 0.5s ease-in-out !important;
                /* Efek transisi smooth */

            }


            .carousel-promo {
                width: 100%;
            }

            .carousel-promo img {
                object-fit: cover;

                /* Membuat gambar mengisi area dengan mempertahankan rasio aspek */
            }

            .custom-prev,
            .custom-next {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                z-index: 1;
                background-color: transparent;
                border: none;
                cursor: pointer;
            }

            .custom-prev {
                left: 64px;
            }

            .custom-next {
                right: 64px;
            }
        </style>

        <div class="container text-center">
            <div id="myCarousel1" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-inner carousel-slider">
                    <?php $count = 0; ?>
                    <?php foreach ($banner as $b) : ?>
                        <?php if ($count % 2 == 0) : ?>
                            <div class="carousel-item carousel-promo<?= $count == 0 ? ' active' : ''; ?>">
                                <div class="text-bg-light bg-white">
                                    <div class="card-body">
                                        <div class="row">
                                        <?php endif; ?>

                                        <div class="col-md-6">
                                            <a href="<?= base_url(); ?>content-banner/<?= $b['id_banner']; ?>">
                                                <img style="width: 645px; height: 265px;" src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="rounded-4" alt="<?= $b['title']; ?>">
                                            </a>
                                        </div>

                                        <?php if ($count % 2 != 0 || ($count == count($banner) - 1)) : ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php $count++; ?>
                    <?php endforeach ?>
                </div>
                <button class="custom-prev" type="button" data-bs-target="#myCarousel1" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="custom-next" type="button" data-bs-target="#myCarousel1" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- End Carousel -->
    </div>

    <!-- End Footer Desktop -->
<?php endif; ?>

<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>
<!-- End Banner Desktop -->