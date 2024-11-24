<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- <head>
    Required meta tags
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    Bootstrap CSS
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logo.png" />

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>
    <style>
        .full-description {
            height: 4em;
            overflow: hidden;
        }

        .zoom-in {
            transition: transform 0.2s ease-in-out;
        }

        .zoom-in:hover {
            transform: scale(1.1);
        }

        .img-container {
            position: relative;
            background-repeat: no-repeat;
        }

        .img-container img {
            width: 100%;
            height: 100%;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .img-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .img-container:hover .img-overlay {
            opacity: 1;
            /* Ketika dihover, tampilkan latar belakang gelap */
        }

        .custom-hr {
            height: 10px;
            background-color: #ec2614;
            border: none;
        }

        .img-zoom {
            transition: transform 0.2s;
        }

        .img-zoom:hover {
            transform: scale(1.1);
            /* Sesuaikan faktor skalanya sesuai keinginan Anda */
        }

        /* Efek gelap saat hover */
        .img-container {
            position: relative;
            overflow: hidden;
        }

        .img-container:hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Ubah warna latar belakang gelap sesuai keinginan Anda */
            z-index: 1;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .img-container:hover img {
            z-index: 2;
            transition: transform 0.2s;
            transform: scale(1.1);
            /* Efek zoom saat hover, sesuaikan sesuai keinginan Anda */
        }

        .img-container:hover::before,
        .img-container:hover img {
            opacity: 1;
        }

        @media (max-width: 280px) {
            .img-container iframe {
                width: 100%;
                /* Mengisi lebar container */
                height: 0;
                padding-bottom: 56.25%;
                /* Mengatur rasio aspek video (16:9) */
            }
        }

        /* Untuk layar dengan lebar 768px atau lebih (tampilan desktop) */
        @media (min-width: 769px) {
            .img-container iframe {
                width: 650px;
                /* Lebar video untuk desktop */
                height: 350px;
                /* Tinggi video untuk desktop */
            }
        }
    </style>
</head> -->

<!-- Mobile View  -->
<?php if ($isMobile) : ?>
    <div id="mobileContent" style="margin-top: 15px;">
        <!-- <div class="container-fluid p-0 position-relative">
            <div class="img-container">
                <img src="addbaseurl/assets/img/kfood.jpg" class="img-fluid rounded-bottom-3">
                <div class="img-overlay"></div>
            </div>
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white fs-2">
                <h1>Artikel dan Blog Ssayomart</h1>
            </div>
        </div> -->

        <!-- link video Youtube -->
        <!-- <div class="position-sticky top-0" style="z-index: 100;">
            <div class="ratio ratio-16x9 text-center">
                <?= $videoEmbedCode; ?>
            </div>
        </div> -->
        <!-- Link Video Youtube -->

        <!-- Carousel wrapper -->
        <!-- <div id="carouselVideoExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <video class="img-fluid" autoplay loop muted>
                        <source src="https://mdbcdn.b-cdn.net/img/video/Tropical.mp4" type="video/mp4" />
                    </video>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>
                            Nulla vitae elit libero, a pharetra augue mollis interdum.
                        </p>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Assets Inputan Administrasi -->
        <!-- <div class="container mt-3">
            <div class="row">
                <h1 class="text-center">
                    <?= $blog_detail['judul_blog']; ?>
                </h1>
                <hr class="custom-hr mb-0">
                <hr class="custom-hr mb-0">
                <div class="mt-1 mb-3">
                    <span class="text-secondary">Author : <?= $blog_detail['username']; ?></span>
                    <br><span class="text-secondary">Tanggal Publish : <?= strftime('%d %B %Y %H:%M', strtotime($blog_detail['tanggal_dibuat'])); ?></span>
                </div>
                <div class="text-center mb-3">
                    <div class="img-container">
                        <img src="<?= base_url() ?>assets/img/blog/<?= $blog_detail['img_thumbnail']; ?>" class="rounded-5 img-fluid">
                    </div>
                    <p class="mb-0 text-secondary">- Foto ini memiliki Copyright dari Ssayomart -</p>
                </div>
                <?= str_replace('<img', '<img class="img-fluid rounded-4 img-zoom"', html_entity_decode($blog_detail['isi_blog'])); ?>
            </div>
        </div> -->
        <!-- End Assets Inputan Administrasi -->

        <!-- galery photos Mobile -->
        <!-- <div class="container d-md-none">
            <section class="galeri" id="galeri">
                <h2 class="fw-bold text-dark mt-4">Galeri Produk <span class="text-danger">Ssayomart</span></h2>
                <div class="swiper telkom mt-3">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="<?= base_url() ?>assets/img/sampel.jpg" alt="Gambar Besar" class="gambar img-fluid">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?= base_url() ?>assets/img/sampel.jpg" alt="Gambar Besar" class="gambar img-fluid">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?= base_url() ?>assets/img/sampel.jpg" alt="Gambar Besar" class="gambar img-fluid">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?= base_url() ?>assets/img/sampel.jpg" alt="Gambar Besar" class="gambar img-fluid">
                        </div>
                    </div>
                </div>
            </section>
        </div> -->
        <!-- akhir galeri photos -->

        <!-- Slider card  -->
        <!-- <div class="container mb-0">
            <div class="row mb-0">
                <div class="col">
                    <p class="fw-bold text-dark my-4 fs-4 text-center"><?= lang('Text.saran_masak') ?></p>
                    <div class="swiper card-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($randomBlogs as $randomBlog) : ?>
                                <div class="swiper-slide col-md-6 mb-md-2 mb-3">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url() . 'assets/img/blog/' . $randomBlog['img_thumbnail']; ?>" class="card-img-top img-fluid" alt="Artikel Lainnya" style="max-width: 100%;">
                                        <h5 class="menu-title text-dark mt-3 mx-3"><?= $randomBlog['judul_blog']; ?></h5>
                                        <p class="text-secondary mt-2 mx-3">
                                            Selengkapnya untuk melihat artikel...
                                        </p>
                                        <a href="<?= base_url('blog/' . $randomBlog['id_blog']); ?>" class="btn btn-danger rounded-3 mx-3 mb-3"><?= lang('Text.selengkapnya') ?> <i class="bi bi-arrow-right-circle"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <!-- <style>
        Media query for Samsung Galaxy Fold 280
        @media (max-width: 280px) {
            .text-dark {
                font-size: 13px;
            }

            .text-secondary {
                font-size: 13px;
            }

            .btn-danger {
                font-size: 13px;
            }
    </style> -->

<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top: 75px;">
        <!-- <div class="container-fluid p-0 position-relative">
            <div class="img-container">
                <img src="<?= base_url() ?>assets/img/kfood.jpg" class="img-fluid rounded-bottom-5">
            </div>
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white fs-2">
                <h1>Artikel dan Blog Ssayomart</h1>
            </div>
        </div> -->
        <!-- Link Video Youtube -->
        <div class="ratio ratio-16x9 mt-5">
            <?= $videoEmbedCode; ?>
        </div>
        <!-- Link Video Youtube -->

        <!-- Carousel wrapper -->
        <!-- <div id="carouselVideoExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <video class="img-fluid" autoplay loop muted>
                        <source src="https://mdbcdn.b-cdn.net/img/video/Tropical.mp4" type="video/mp4" />
                    </video>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>
                            Nulla vitae elit libero, a pharetra augue mollis interdum.
                        </p>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="container mt-4">
            <div class="row">
                <!-- Left Panel -->
                <div class="col-8">
                    <h1 class="text-center">
                        <?= $blog_detail['judul_blog']; ?>
                    </h1>
                    <hr class="custom-hr mb-0 fw-bold">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Author : <?= $blog_detail['username']; ?></span>
                        <span class="text-secondary">Tanggal Publish : <?= strftime('%d %B %Y %H:%M', strtotime($blog_detail['tanggal_dibuat'])); ?></span>
                    </div>
                    <div class="text-center mb-3">
                        <img src="<?= base_url() ?>assets/img/blog/<?= $blog_detail['img_thumbnail']; ?>" class="rounded-circle img-fluid">
                        <p class="mb-0 text-secondary">- Foto ini memiliki Copyright dari Ssayomart -</p>
                    </div>
                    <?= str_replace('<img', '<img class="img-fluid rounded-4 img-zoom"', html_entity_decode($blog_detail['isi_blog'])); ?>
                </div>

                <!-- Right Panel -->
                <div class="col-4 px-5 position-sticky top-0">
                    <div id="imageSlider" class="carousel slide rounded-4" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner rounded-4">
                            <?php $first = true; ?>
                            <?php foreach ($banner_list as $key => $bl) : ?>
                                <div class="carousel-item <?= $first ? 'active' : ''; ?>">
                                    <img src="<?= base_url() ?>assets/img/banner/ads/<?= $bl['img']; ?>" class="img-fluid text-center rounded-4" alt="Promotion">
                                </div>
                                <?php $first = false; ?>
                            <?php endforeach ?>
                        </div>
                        <a class="carousel-control-prev" href="#imageSlider" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#imageSlider" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>


                    <div class="row mt-3">
                        <span class="fw-bold fs-3">Produk <span class="text-danger">Ssayomart</span></span>
                        <hr class="mt-2">
                    </div>

                    <?php $count = 0; ?>
                    <?php foreach ($randomProducts as $randomProduct) : ?>
                        <?php if ($count < 5) : ?>
                            <div class="card border-0 mt-2">
                                <div class="d-flex text-black">
                                    <div class="flex-shrink-0">
                                        <a href="<?= base_url() ?>produk/<?= $randomProduct['slug']; ?>">
                                            <img src="<?= base_url() . 'assets/img/produk/main/' . $randomProduct['img']; ?>" alt="Produk Lainnya" height="100px" width="100px" class="img-fluid rounded-3">
                                        </a>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <a href="<?= base_url() ?>produk/<?= $randomProduct['slug']; ?>" class="p-0 m-0 fw-bold fs-5 text-danger link-offset-2 link-underline link-underline-opacity-0"><?= $randomProduct['nama']; ?></a>
                                        <div class="d-flex justify-content-start rounded-3 m-0">
                                            <!-- <p class="text-secondary m-0"></p> -->
                                            <?php if ($randomProduct['harga_min'] == $randomProduct['harga_max']) : ?>
                                                Rp. <?= number_format($randomProduct['harga_min'], 0, ',', '.'); ?>
                                            <?php else : ?>
                                                <?= substr('Rp. ' . number_format($randomProduct['harga_min'], 0, ',', '.') . '-' . number_format($randomProduct['harga_max'], 0, ',', '.'), 0, 13); ?>...
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php $count++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- GALERI RESEP LAINNYA -->

            <!-- <h2 class="fw-bold text-dark mt-4">Galeri Produk <span class="text-danger">Ssayomart</span></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
                <div class="col mb-4 zoom-in">
                    <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
            </div> -->


            <!-- Sistem Grid Desktop -->
            <div class="row justify-content-center my-3">
                <div class="col-md-6">
                    <div data-aos="fade-right">
                        <div class="mb-4">
                            <span class="font-weight-bold display-4">Tips memasak ala Korea dirumah Anda dengan <strong>Praktis</strong> dan <strong>Enak</strong> dari <span class="text-danger"><strong>Ssayomart</strong>.</span></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <?php $count = 0; ?>
                        <?php foreach ($randomBlogs as $randomBlog) : ?>
                            <?php if ($count < 4) : ?>
                                <div class="col-md-6">
                                    <div data-aos="fade-left">
                                        <div class="mb-4">
                                            <a href="<?= base_url('blog/' . $randomBlog['id_blog']); ?>">
                                                <div class="img-container rounded-5">
                                                    <img src="<?= base_url() . 'assets/img/blog/' . $randomBlog['img_thumbnail']; ?>" alt="Artikel Lainny" class="img-fluid" style="height:300px; width:300px;">
                                                    <div class="img-overlay"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php $count++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Slider card  -->
            <div class="row mb-4">
                <div class="col">
                    <h2 class="fw-bold text-dark">Saran Masak Lainnya di <span class="text-danger">Ssayomart</span></h2>
                    <div class="swiper card-swiper mt-3">
                        <div class="swiper-wrapper">
                            <?php foreach ($randomBlogs as $randomBlog) : ?>
                                <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                    <div class="card border-0 shadow-sm mt-2">
                                        <img src="<?= base_url() . 'assets/img/blog/' . $randomBlog['img_thumbnail']; ?>" class="card-img-top img-fluid" alt="Artikel Lainnya" style="height:300px; width:300px;">
                                        <h5 class="menu-title text-dark mt-3 mx-3"><?= $randomBlog['judul_blog']; ?></h5>
                                        <p class="text-secondary mt-2 mx-3">
                                            Selengkapnya untuk melihat artikel...
                                        </p>
                                        <a href="<?= base_url('blog/' . $randomBlog['id_blog']); ?>" class="btn btn-danger rounded-3 mx-3 mb-3">Selengkapnya <i class="bi bi-arrow-right-circle"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Slider Card -->


        </div>
    </div>
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

<script>
    AOS.init();
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10, // Jarak antara slide
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        breakpoints: {
            768: {
                slidesPerView: 2, // Menampilkan dua slide di tampilan tablet
            },

            415: {
                slidesPerView: 1,
            }

        },
    });


    var swiper = new Swiper(".telkom", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });

    var mySwiper = new Swiper('.card-swiper', {
        // Konfigurasi Swiper di sini
        slidesPerView: 4, // Jumlah slide yang ditampilkan sekaligus
        spaceBetween: 30, // Jarak antara slide
        navigation: {
            nextEl: '.swiper-button-next', // Tombol navigasi berikutnya
            prevEl: '.swiper-button-prev' // Tombol navigasi sebelumnya
        },
        breakpoints: {
            // Tampilan iPad (lebar >= 768px)
            1280: {
                slidesPerView: 4, // 3 card per tampilan
            },
            // Tampilan iPad (lebar >= 768px)
            768: {
                slidesPerView: 3, // 3 card per tampilan
            },
            // Tampilan Mobile (lebar < 768px)
            375: {
                slidesPerView: 1, // 2 card per tampilan
            },
            280: {
                slidesPerView: 1, // 2 card per tampilan
            },
        },

        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },

    });
</script>

<?= $this->endSection(); ?>