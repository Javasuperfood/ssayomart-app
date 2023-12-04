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
                <img src="<?= base_url() ?>assets/img/banner/promotion/content/<?= $banner_list['img_promo'] ?>" alt="Content Image" class="gambar img-fluid">
            </div>
            <div class="container pt-2 text-center">
                <div class="row">
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
                </div>
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
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus eaque dolorum ab consequatur molestias aspernatur mollitia, quod eius atque quos inventore, harum quaerat tenetur. Consectetur ipsum fugiat illum nisi, modi nemo saepe tenetur, repellat, hic neque eligendi quos harum eaque commodi voluptatibus velit ullam iure?
                        </p>
                        <p>
                            Porro suscipit voluptatem rerum sunt non molestiae inventore iusto ad, provident ratione magnam nisi? Modi veniam iste animi eaque doloribus, odio vel! Atque ratione totam debitis. Facere corporis doloribus repellat distinctio.
                        </p>
                        <p>
                            Facilis natus assumenda et, itaque inventore repellat officia culpa iste eaque, veniam laborum mollitia blanditiis dolorum ex provident sint consequuntur, ut dolorem? Sunt consequatur assumenda quod exercitationem quas amet quidem inventore soluta quibusdam velit?
                        </p>
                        <p>
                            Fugit cum in alias fugiat, quis eos sapiente voluptatum autem omnis possimus explicabo delectus natus aspernatur totam perspiciatis dolorem quaerat, dolor aliquam enim obcaecati at cupiditate quasi. Maiores eum perferendis nesciunt fugiat hic, saepe iste voluptates eaque quidem esse molestias?
                        </p>
                    </div>

                    <div class="row">
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
                    </div>
                </div>
                <!-- right panel -->
                <div class="col-sm-9">
                    <div class="class py-4">
                        <img src="<?= base_url() ?>assets/img/banner/Playstore-3.jpg" alt="Gambar Besar" class="gambar img-fluid">
                    </div>
                </div>
            </div>


            <!-- <div class="container mt-3">
            <div class="row">
                <div class="col">
                  
                    <h3 class="text-center mt-2">Tentang Ssayomart </h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nulla! Est nobis deleniti quisquam! Ipsam vitae molestiae voluptatibus rem, itaque laboriosam eum ratione molestias. Eveniet inventore recusandae optio ullam voluptatem, in, a aut accusamus autem beatae doloremque perspiciatis quam quasi necessitatibus consectetur quae odit libero velit accusantium nihil adipisci eos.</p>

                </div>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row">
                <div class="col-12 col-md-6 ">
                  

                    <h3>Dokumentasi SSayomart Live</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nulla! Est nobis deleniti quisquam! Ipsam vitae molestiae voluptatibus rem, itaque laboriosam eum ratione molestias. Eveniet inventore recusandae optio ullam voluptatem, in, a aut accusamus autem beatae doloremque perspiciatis quam quasi necessitatibus consectetur quae odit libero velit accusantium nihil adipisci eos.</p>

                </div>
                <div class="col-12 col-md-6">
                    

                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/vlDzYIIOYmM" title="YouTube video" allowfullscreen></iframe>
                    </div>

                </div>

            </div>
        </div> -->

            <!-- <div class="container mt-3 d-none d-md-block">
            <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Potrait <span class="text-danger">Ssayomart</span></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/about/menu-1.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/about/menu-2.png" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/about/menu-3.png" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/about/menu-4.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
            </div>
            <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Landscape <span class="text-danger">Ssayomart</span></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/about/menu-5.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/about/menu-6.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/about/menu-7.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/about/menu-7.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
            </div>
        </div> -->
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

            .card {
                width: 400px;
                border: none;
                background-color: #313131;
                height: 350px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 15px;
            }

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