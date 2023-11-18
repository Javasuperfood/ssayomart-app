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
            <div class="swiper mySwiper" style="position: relative; margin-bottom:32px;">
                <div class="swiper-wrapper d-flex">
                    <?php foreach ($banner as $b) : ?>
                        <div class="swiper-slide">
                            <a href="<?= base_url(); ?>user/home/contenBanner/conten-banner">
                                <img src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="d-block w-100 rounded-3" alt="<?= $b['title']; ?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Previous button centered within the image -->
                <div class="position-absolute start-0 top-50 translate-middle-y button-prev rounded-circle d-flex align-items-center" style="z-index: 2; width: 30px; height: 30px;">
                    <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                </div>

                <!-- Next button centered within the image -->
                <div class="position-absolute end-0 top-50 translate-middle-y button-next rounded-circle d-flex align-items-center" style="z-index: 2; width: 30px; height: 30px;">
                    <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
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
    </script>
<?php else : ?>
    <!-- End Banner Mobile -->

    <!-- Banner Desktop -->
    <div id="desktopContent" style="margin-top: 90px;">
        <div class="container">
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $totalBanners = count($banner);
                    for ($i = 0; $i < $totalBanners; $i += 2) :
                        $classBanner = "carousel-item";
                        if ($i === 0) {
                            $classBanner .= " active";
                        }
                    ?>
                        <a href="<?= base_url(); ?>user/home/contenBanner/conten-banner">
                            <div class="<?= $classBanner; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="<?= base_url() ?>assets/img/banner/<?= $banner[$i]['img']; ?>" class="d-block w-100 rounded-3" alt="<?= $banner[$i]['title']; ?>">
                                    </div>
                                    <?php if ($i + 1 < $totalBanners) : ?>
                                        <div class="col-md-6">
                                            <img src="<?= base_url() ?>assets/img/banner/<?= $banner[$i + 1]['img']; ?>" class="d-block w-100 rounded-3" alt="<?= $banner[$i + 1]['title']; ?>">
                                        </div>
                                    <?php else : ?>
                                        <!-- Jika tidak ada gambar berikutnya, tambahkan gambar default atau pesan placeholder -->
                                        <div class="col-md-6">
                                            <img src="<?= base_url() ?>assets/img/banner/default.jpg" class="d-block w-100 rounded-3" alt="Placeholder">
                                            <!-- Atau pesan placeholder -->
                                            <!-- <p>Placeholder</p> -->
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php endfor; ?>
                </div>
                <!-- Tombol Previous -->
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <!-- Tombol Next -->
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
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