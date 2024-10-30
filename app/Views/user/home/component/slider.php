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
            <div class="swiper mySwiperBanner" style="position: relative; margin-bottom:27px; margin-top:105px;">
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

<?php else : ?>
    <!-- End Banner Mobile -->

    <!-- Banner Desktop -->
    <div id="desktopContent" style="margin-top: 120px;">

        <div class="container">
            <div class="swiper mySwiperBanner" style="position: relative; margin-bottom:27px; margin-top:105px;">
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

    <!-- Carousel -->

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