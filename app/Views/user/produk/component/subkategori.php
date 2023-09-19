<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>
<!-- tampilan mobile & ipad -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-none d-lg-none">
            <div class="row text-center">
                <div class="col">
                    <div class="swiper buttonSwiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($subKategori as $s) : ?>
                                <div class="swiper-slide mx-3">
                                    <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="btn border-0 btn-custom-rounded text-danger " style="width: 200px;">
                                        <?= $s['nama_kategori']; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- tampilan mobile & ipad -->

    <!-- tampilan Destop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container d-md-none d-lg-none">
            <div class="row text-center">
                <div class="col">
                    <div class="swiper buttonSwiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($subKategori as $s) : ?>
                                <div class="swiper-slide mx-3">
                                    <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="btn border-0 btn-custom-rounded text-danger " style="width: 200px;">
                                        <?= $s['nama_kategori']; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<!-- tampilan Destop -->