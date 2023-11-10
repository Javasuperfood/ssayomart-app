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

        <div class="container pt-1">
            <img src="<?= base_url() ?>assets/img/banner/content-1.jpeg" alt="Gambar Besar" class="gambar img-fluid">
            <!-- <section class="desc" id="desc">
                <h2 class="fw-bold text-dark mt-4 mb-3 text-center fs-4">Ulasan Aplikasi <span class="text-danger">Ssayomart</span></h2>
                <p>
                    저희 싸요마트를 이용해 주셔서 진심으로 감사합니다.
                    플레이스토어에 싸요마트 어플에 대한 평가 및 리뷰를 작성해주시면, 100명에게 배추김치 500g 교환권을 드리겠습니다.
                    앞으로도 항상 노력하는 싸요마트가 되겠습니다. 감사합니다.
                </p>
                <p>
                    Terima kasih banyak telah menggunakan Ssayomart kami.
                    Jika Anda menulis rating dan review untuk aplikasi Ssayomart di Google PlayStore, kami akan memberikan voucher penukaran kimchi sawi 500g kepada 100 orang.
                    Kami akan terus menjadi Ssayomart yang selalu bekerja keras. Terimakasih.
                </p>
            </section> -->
        </div>

        <!-- <div class="position-relative">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/vlDzYIIOYmM?autoplay=1&mute=1&loop=1&controls=1&showinfo=1&rel=1" title="YouTube video" allowfullscreen></iframe>
            </div>
            <div class="overlay"></div>
            <div class="container py-5 text-white bg-danger">
                <h1 class="fw-bold">
                    Produk Terbaik & <br />
                    Terlengkap pada toko kami
                </h1>
                <p>
                    Produk Terbaru, Produk Termurah, Pelayanan terbaik
                </p>
                <button type="button" class="btn btn-outline-light">
                    Selengkapnya
                </button>
                <button type="button" class="btn btn-light text-danger pt-2">
                    <span class="pt-1">Belanja Sekarang</span>
                </button>
            </div>
        </div> -->

        <!-- Products -->
        <section>
            <!-- galery photos Mobile -->
            <!-- <div class="container text-center">
                <section class="galeri" id="galeri">
                    <h2 class="fw-bold text-dark mt-4 mb-3 fs-4">Galeri Produk <span class="text-danger">Ssayomart</span></h2>
                    <div class="swiper mySwiper mt-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-1.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-2.png" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-3.png" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-4.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-5.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-6.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-7.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-8.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-9.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url() ?>assets/img/about/menu-10.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                        </div>

                    </div>
                </section>
            </div> -->
            <!-- akhir galeri photos -->
        </section>
        <!-- Products -->

        <!-- Feature -->
        <!-- <section class="mt-3" style="background-color: #ffff;">
            <div class="container text-dark pt-1 text-center">
                <header class="pt-4 pb-3 text-center">
                    <h3>Kenapa Pilih Kami ?</h3>
                </header>

                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <figcaption class="info">
                                <h6 class="title fw-bold">Harga yang murah</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure> -->
                        <!-- itemside // -->
                    </div>
                    <!-- col // -->
                    <!-- <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <figcaption class="info">
                                <h6 class="title fw-bold">Produk berkualitas tinggi</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure>
                         itemside 
                    </div> -->
                    <!-- col // -->
                    <!-- <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <figcaption class="info">
                                <h6 class="title fw-bold">Kami Tersebar di seluruh kota</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure>
                         itemside 
                    </div>
                </div> -->
            </div>
           <!-- container end.// -->
        </section>
        <!-- Feature -->

        <!-- Blog -->
        <!-- <section class="mt-3 mb-2 text-center">
            <div class="container text-dark">
                <header class="mb-4">
                    <h3>Blog posts</h3>
                </header>

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <article>
                            <a href="#" class="img-fluid">
                                <img src="<?= base_url() ?>assets/img/banner/banner-1.jpg" class="rounded w-100" style="object-fit: cover;" height="160" />
                            </a>
                            <div class="mt-2 text-muted small d-block mb-1">
                                <span>
                                    <i class="fa fa-calendar-alt fa-sm"></i>
                                    08.11.2023
                                </span>
                                <a href="#">
                                    <h6 class="text-dark">Lorem ipsum dolor sit amet.</h6>
                                </a>
                                <p>When you enter into any new area of science, you almost reach</p>
                            </div>
                        </article>
                    </div> -->
                    <!-- col.// -->
                    <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <article>
                            <a href="#" class="img-fluid">
                                <img src="<?= base_url() ?>assets/img/banner/banner-2.png" class="rounded w-100" style="object-fit: cover;" height="160" />
                            </a>
                            <div class="mt-2 text-muted small d-block mb-1">
                                <span>
                                    <i class="fa fa-calendar-alt fa-sm"></i>
                                    08.11.2023
                                </span>
                                <a href="#">
                                    <h6 class="text-dark">Lorem ipsum dolor sit amet.</h6>
                                </a>
                                <p>When you enter into any new area of science, you almost reach</p>
                            </div>
                        </article>
                    </div> -->
                    <!-- col.// -->
                    <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <article>
                            <a href="#" class="img-fluid">
                                <img src="<?= base_url() ?>assets/img/banner/banner-3.png" class="rounded w-100" style="object-fit: cover;" height="160" />
                            </a>
                            <div class="mt-2 text-muted small d-block mb-1">
                                <span>
                                    <i class="fa fa-calendar-alt fa-sm"></i>
                                    08.11.2023
                                </span>
                                <a href="#">
                                    <h6 class="text-dark">Lorem ipsum dolor sit amet.</h6>
                                </a>
                                <p>When you enter into any new area of science, you almost reach</p>
                            </div>
                        </article>
                    </div> -->
                    <!-- col.// -->
                    <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <article>
                            <a href="#" class="img-fluid">
                                <img src="<?= base_url() ?>assets/img/banner/banner-4.png" class="rounded w-100" style="object-fit: cover;" height="160" />
                            </a>
                            <div class="mt-2 text-muted small d-block mb-1">
                                <span>
                                    <i class="fa fa-calendar-alt fa-sm"></i>
                                    08.11.2023
                                </span>
                                <a href="#">
                                    <h6 class="text-dark">Lorem ipsum dolor sit amet.</h6>
                                </a>
                                <p>When you enter into any new area of science, you almost reach</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div> -->
        </section>
        <!-- Blog -->

        <!-- Footer -->
        <!-- <footer class="text-center text-lg-start text-muted mt-5" style="background-color: #f5f5f5;"> -->
            <!-- Section: Links  -->
            <!-- <section class="">
                <div class="container text-center text-md-start pt-4 pb-4"> -->
                    <!-- Grid row -->
                    <!-- <div class="row mt-3"> -->
                        <!-- Grid column -->
                        <!-- <div class="col-12 col-lg-3 col-sm-12 mb-2"> -->
                            <!-- Content -->
                            <!-- <p class="mt-2 text-dark">
                                © 2023 Copyright: SSayomart Indonesia
                            </p>
                        </div> -->
                        <!-- Grid column -->
                        <!-- Grid column -->
                        <!-- <div class="col-12 col-sm-12 col-lg-3"> -->
                            <!-- Links -->
                            <!-- <h6 class="text-uppercase text-dark fw-bold mb-2">Informasi</h6>
                            <p class="text-muted">Tetap berada di dekat kami agar kamu tau promo terbaru dari kami</p>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control border" placeholder="Email" aria-label="Email" aria-describedby="button-addon2" />
                                <button class="btn btn-light border shadow-0" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                                    Join
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </footer>
    </div> -->
<?php else : ?>
    <!-- end mobile -->

    <!-- desktop konten -->
    <div id="desktopContent" style="margin-top:80px;">
        <div class="container-fluid p-0 position-relative mt-3">
            <div class="ratio ratio-16x9" style="position: sticky; top: 60px;"> <!-- Ganti 60px dengan ketinggian navbar Anda -->
                <iframe src="https://www.youtube.com/embed/vlDzYIIOYmM" title="YouTube video" allowfullscreen></iframe>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row">
                <div class="col">
                    <!-- Konten Kolom Kedua -->
                    <h3 class="text-center mt-2">Tentang Ssayomart </h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nulla! Est nobis deleniti quisquam! Ipsam vitae molestiae voluptatibus rem, itaque laboriosam eum ratione molestias. Eveniet inventore recusandae optio ullam voluptatem, in, a aut accusamus autem beatae doloremque perspiciatis quam quasi necessitatibus consectetur quae odit libero velit accusantium nihil adipisci eos.</p>

                </div>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row">
                <div class="col-12 col-md-6 ">
                    <!-- Konten Kolom Kedua -->

                    <h3>Dokumentasi SSayomart Live</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nulla! Est nobis deleniti quisquam! Ipsam vitae molestiae voluptatibus rem, itaque laboriosam eum ratione molestias. Eveniet inventore recusandae optio ullam voluptatem, in, a aut accusamus autem beatae doloremque perspiciatis quam quasi necessitatibus consectetur quae odit libero velit accusantium nihil adipisci eos.</p>

                </div>
                <div class="col-12 col-md-6">
                    <!-- Konten Kolom Pertama -->

                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/vlDzYIIOYmM" title="YouTube video" allowfullscreen></iframe>
                    </div>

                </div>

            </div>
        </div>

        <div class="container mt-3 d-none d-md-block">
            <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Potrait <span class="text-danger">Ssayomart</span></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-1.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-2.png" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-3.png" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-4.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
            </div>
            <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Landscape <span class="text-danger">Ssayomart</span></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-5.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-6.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-7.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-7.jpg" width="350px" height="200px" alt="" class="img-fluid">
                </div>
            </div>
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

<?= $this->endSection(); ?>