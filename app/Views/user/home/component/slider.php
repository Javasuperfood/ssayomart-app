<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Banner Mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-none" style="position :relative; top : -15px;">
            <div class="row">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="margin-top: -60px;">
                    <div class="carousel-inner">
                        <?php $firstLoop = true;
                        foreach ($banner as $b) :
                            $classBanner = "carousel-item";
                            if ($firstLoop) {
                                $classBanner .= " active";
                                $firstLoop = false;
                            } ?>
                            <a href="<?= base_url(); ?>user/home/contenBanner/conten-banner">
                                <div class="<?= $classBanner; ?>">
                                    <img src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="d-block w-100 rounded-3" alt="<?= $b['title']; ?>">
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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