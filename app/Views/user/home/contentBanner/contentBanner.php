<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>


<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container pt-2">
            <div class="container">
                <img src="<?= base_url() ?>assets/img/banner/content/<?= $banner_list['img_konten'] ?>" alt="Content Image" class="gambar img-fluid rounded-3">
            </div>
            <div class="container pt-2 text-center">
                <!-- <div class="row">
                    <div class="col">
                        <a href="market://details?id=com.javasuperfood.ssayomart&pcampaignid=web_share" class="btn btn-block" style="width: 112%;">
                            <img src="<?= base_url() ?>assets/img/plays.png" alt="Gambar Besar" class="gambar img-fluid">
                        </a>
                    </div>
                    <div class="col">
                        <a href="https://apps.apple.com/id/app/ssayomart/id6458099585" class="btn btn-block" style="width: 100%">
                            <img src="<?= base_url() ?>assets/img/Apps.png" alt="Gambar Besar" class="gambar img-fluid">
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- end mobile -->

    <!-- desktop konten -->
    <div id="desktopContent" style="margin-top:80px;">
        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-3 sidenav py-4">
                    <div class="col">
                        <h3>Tentang Kami</h3>
                        <p>
                            adalah sebuah supermarket yang mengkhususkan diri dalam menyediakan berbagai produk makanan dan kebutuhan sehari-hari dengan fokus pada makanan Korea dan Jepang. Dalam supermarket ini, pelanggan dapat menemukan berbagai macam produk seperti bahan makanan segar, makanan olahan, minuman, produk kesehatan, kecantikan, dan masih banyak lagi yang terkait dengan kedua budaya kuliner tersebut.
                        </p>
                        <p>
                            memprioritaskan kualitas produk, keberlanjutan, dan kepuasan pelanggan. Mereka menawarkan berbagai produk otentik dari Korea dan Jepang, sehingga pelanggan dapat merasakan dan menghadirkan cita rasa khas Asia dalam rumah mereka. Dengan staf yang ramah dan pengetahuan yang luas tentang produk, Ssayomart berusaha memberikan pengalaman belanja yang menyenangkan dan informatif bagi pelanggan yang ingin menjelajahi kuliner Asia.
                        </p>
                        <p>
                            Ssayomart juga memiliki aplikasi mobile yang dapat diunduh di Google Play Store dan App Store. Aplikasi ini memungkinkan pelanggan untuk berbelanja secara online dan mengirimkan produk ke rumah mereka. Selain itu, pelanggan juga dapat menemukan berbagai resep dan tips memasak di aplikasi ini.
                        </p>
                        <p>
                            Ssayomart memiliki 3 cabang di Indonesia, yaitu di Jakarta, Bandung, dan Surabaya. Selain itu, Ssayomart juga memiliki toko online yang dapat diakses di apps.ssayomart.com. Ssayomart juga memiliki akun media sosial di Facebook, Instagram, dan Youtube.
                        </p>
                    </div>

                    <!-- <div class="row">
                        <div class="col">
                            <a href="https://play.google.com/store/apps/details?id=com.javasuperfood.ssayomart&pcampaignid=web_share" class="btn btn-block" style="width: 112%;">
                                <img src="<?= base_url() ?>assets/img/plays.png" alt="Gambar Besar" class="gambar img-fluid">
                            </a>
                        </div>
                        <div class="col">
                            <a href="https://apps.apple.com/id/app/ssayomart/id6458099585" class="btn btn-block" style="width: 100%">
                                <img src="<?= base_url() ?>assets/img/Apps.png" alt="Gambar Besar" class="gambar img-fluid">
                            </a>
                        </div>
                    </div> -->
                </div>
                <!-- right panel -->
                <div class="col-sm-9">
                    <div class="section">
                        <img src="<?= base_url() ?>assets/img/banner/Playstore-3.jpg" alt="Gambar Besar" class="gambar img-fluid rounded-3">
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
            .row.content {
                height: 843px;
            }

            /* Set gray background color and 100% height */
            .sidenav {
                background-color: #f1f1f1;
                height: 100%;
            }

            /* .card {
                width: 400px;
                border: none;
                background-color: #313131;
                height: 350px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 15px;
            } */

            .app-button {

                width: 280px;
                height: 80px;
                border-radius: 13px;
                padding-left: 28px;
                padding-top: 10px;
                box-shadow: 0 0 40px rgba(51, 51, 51, .1)
            }

            .app-button i {
                font-size: 60px;
                margin-right: 10px;
            }
        </style>
    <?php endif; ?>

    <!-- End Desktop View -->
    <?php
    if ($isMobile) {

        echo '<div id="mobileContent">';

        echo '</div>';
    } else {

        echo '<div id="desktopContent">';

        echo '</div>';
    }
    ?>

    <?= $this->endSection(); ?>