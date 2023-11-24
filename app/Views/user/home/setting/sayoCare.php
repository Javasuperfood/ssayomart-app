<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logo.png" />

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>

    <title>Ssayomart Blog Page</title>
</head>
<!-- Mobile View  -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container-fluid p-0 position-relative">
            <div class="bg-image">
                <img src="<?= base_url() ?>assets/img/about/bg1.png" width="650px" height="350px" alt="" class="img-fluid">
                <div class="mask"></div>
            </div>
            <!-- <div class="img-container">
                <img src="<?= base_url() ?>assets/img/about/bg1.png" width="650px" height="350px" alt="" class="img-fluid">
                <div class="img-overlay"></div>
            </div> -->
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white fs-6 " style="font-family:cursive;">
                <h3 class="tagline-1">ABOUT US</h3>
                <span class="fw-bold tagline-2">PT Ssayomart Indonesia </span>
            </div>
        </div>

        <!-- tentang ssayomart -->
        <div class="container mt-3">
            <div class="row">
                <!-- Konten Kolom Pertama -->
                <!-- <div class="col-12 col-md-6">
                    <div class="img-container">
                        <img src="<?= base_url() ?>assets/img/about/bg1.png" width="650px" height="350px" alt="" class="img-fluid rounded-4">
                        <div class="img-overlay"></div>
                    </div>
                </div> -->
                <div class="col">
                    <div data-aos="fade-down" data-aos-delay="500">
                        <!-- Konten Kolom Kedua -->
                        <h2 class="fw-bold mb-3">Tentang <span class="text-danger">Ssayomart</span> </h2>
                        <p><span class="fw-bold text-danger fs-5 me-1">Ssayomart</span> adalah sebuah supermarket yang mengkhususkan diri dalam menyediakan berbagai produk makanan dan kebutuhan sehari-hari dengan fokus pada makanan Korea dan Jepang. Dalam supermarket ini, pelanggan dapat menemukan berbagai macam produk seperti bahan makanan segar, makanan olahan, minuman, produk kesehatan, kecantikan, dan masih banyak lagi yang terkait dengan kedua budaya kuliner tersebut.</p>
                        <p><span class="fw-bold text-danger fs-5 me-1">Ssayomart</span> memprioritaskan kualitas produk, keberlanjutan, dan kepuasan pelanggan. Mereka menawarkan berbagai produk otentik dari Korea dan Jepang, sehingga pelanggan dapat merasakan dan menghadirkan cita rasa khas Asia dalam rumah mereka. Dengan staf yang ramah dan pengetahuan yang luas tentang produk, Ssayomart berusaha memberikan pengalaman belanja yang menyenangkan dan informatif bagi pelanggan yang ingin menjelajahi kuliner Asia.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- galery photos Mobile -->
        <div class="container d-md-none">
            <div data-aos="fade-right" data-aos-delay="300">
                <section class="galeri" id="galeri">
                    <h2 class="fw-bold text-dark mt-4">Galeri Produk <span class="text-danger">Ssayomart</span></h2>
                    <div class="swiper telkom mt-3">
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
            </div>
        </div>
        <!-- akhir galeri photos -->
        <!-- Galery Photos View Ipad -->
        <div class="container mt-3 d-none d-md-block">
            <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Potrait <span class="text-danger">Ssayomart</span></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-4">
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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-4">
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
        <!-- Galery Photos View Ipad -->
        <!-- Slider card  Profil Founder-->
        <div class="container">
            <div data-aos="zoom-in-down">
                <div class="row">
                    <div class="col">
                        <h2 class="fw-bold text-dark mt-4">Our Perfect Team in <span class="text-danger">Ssayomart</span></h2>
                        <div class="swiper card-swiper mt-3">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="product" style="width: 100px; height: 100px;">

                                        <h5 class="menu-title text-dark text-center mt-2">John Due</h5>
                                        <h5 class="menu-title text-muted small text-center">CEO</h5>

                                        <p class="text-secondary text-center mt-2 mx-3">
                                            "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus quos veniam repudiandae numquam deleniti saepe".
                                        </p>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="product" style="width: 100px; height: 100px;">

                                        <h5 class="menu-title text-dark text-center mt-2">John Due</h5>
                                        <h5 class="menu-title text-muted small text-center">CEO</h5>

                                        <p class="text-secondary text-center mt-2 mx-3">
                                            "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus quos veniam repudiandae numquam deleniti saepe".
                                        </p>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="product" style="width: 100px; height: 100px;">

                                        <h5 class="menu-title text-dark text-center mt-2">John Due</h5>
                                        <h5 class="menu-title text-muted small text-center">CEO</h5>

                                        <p class="text-secondary text-center mt-2 mx-3">
                                            "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus quos veniam repudiandae numquam deleniti saepe".
                                        </p>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="product" style="width: 100px; height: 100px;">

                                        <h5 class="menu-title text-dark text-center mt-2">John Due</h5>
                                        <h5 class="menu-title text-muted small text-center">CEO</h5>

                                        <p class="text-secondary text-center mt-2 mx-3">
                                            "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus quos veniam repudiandae numquam deleniti saepe".
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Slider card  Profil Founder-->

        <!-- form dan maps -->
        <div class="container mb-5">
            <h2 class="fw-bold text-dark mt-4 mb-4 text-center">About As <span class="text-danger">Ssayomart</span></h2>
            <div class="row">
                <!-- Kolom 1: Peta -->
                <div class="col-md-6 col-lg-6" style="display:flex; text-align:center !important; flex-wrap:wrap; justify-content:center;">
                    <iframe class="text-center maps rounded-4 border-0" src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d588.8346382611838!2d106.6190360362805!3d-6.224009368681214!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fdd1b4844f71%3A0x7a215719bcf3a770!2sSsayo%20Mart%20Indonesia!5e1!3m2!1sen!2sid!4v1700099064396!5m2!1sen!2sid" width="320" height="350" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>

                <!-- Kolom 2: Formulir Inputan -->
                <div class="col-md-6 col-lg-6 mt-2">
                    <form>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group my-2">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit" class="mt-3 btn btn-danger">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- akhir form dan maps -->

        <!-- button Animasi -->
        <div class="button-container">
            <div class="button" onclick="changeShape()">
                <i class="icon icon-left fas fa-plus"></i>
                <input type="number" class="input" value="1">
                <i class="icon icon-right fas fa-minus"></i>
            </div>
        </div>
        <!-- akhir button animasi -->

        <style>
            .button-container {
                display: flex;
                align-items: center;
            }

            .button {
                position: relative;
                width: 35px;
                height: 35px;
                border-radius: 50%;
                background-color: #3498db;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-weight: bold;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .button.clicked {
                width: 100px;
                border-radius: 30px;
            }

            .icon {
                position: absolute;
                font-size: 20px;
            }

            .icon-left {
                left: 5px;
            }

            .icon-right {
                right: 5px;
            }

            .input {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 30px;
                text-align: center;
            }

            .button.clicked .icon {
                display: inline;
            }
        </style>

        <script>
            function changeShape() {
                var button = document.querySelector('.button');
                button.classList.toggle('clicked');
            }
        </script>










        <style>
            .bg-image {
                position: relative;
                overflow: hidden;
            }

            .bg-image img {
                width: 100%;
                height: auto;
                display: block;
            }

            .mask {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(45deg, hsla(168, 85%, 52%, 0.5), hsla(263, 88%, 45%, 0.5) 100%);
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
            }

            .bg-image:hover .mask {
                opacity: 1;
            }


            @media screen and (min-width: 768px) and (max-width: 1024px) {
                .tagline-1 {
                    font-size: 78px;
                }

                .tagline-2 {
                    font-size: 50px;
                }
            }
        </style>
    </div>
<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:50px;">
        <div class="container-fluid p-0 position-relative">
            <!-- <div class="img-container">
                <img src="<?= base_url() ?>assets/img/about/bg1.png" width="650px" height="350px" alt="" class="img-fluid">
                <div class="img-overlay"></div>
            </div> -->
            <div class="bg-image">
                <img src="<?= base_url() ?>assets/img/about/bg1.png" width="650px" height="350px" alt="" class="img-fluid">
                <div class="mask"></div>
            </div>
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white fs-2 " style="font-family:cursive;">
                <h1>ABOUT US</h1>
                <p>PT Ssayomart Indonesia </p>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row">

                <div class="col">
                    <!-- Konten Kolom Kedua -->
                    <h3 class="text-center mt-2">Tentang <span class="fw-bold text-danger fs-2 me-1">Ssayomart</span> </h3>
                    <p><span class="fw-bold text-danger fs-5 me-1">Ssayomart</span> adalah sebuah supermarket yang mengkhususkan diri dalam menyediakan berbagai produk makanan dan kebutuhan sehari-hari dengan fokus pada makanan Korea dan Jepang. Dalam supermarket ini, pelanggan dapat menemukan berbagai macam produk seperti bahan makanan segar, makanan olahan, minuman, produk kesehatan, kecantikan, dan masih banyak lagi yang terkait dengan kedua budaya kuliner tersebut.</p>
                    <p><span class="fw-bold text-danger fs-5 me-1">Ssayomart</span> memprioritaskan kualitas produk, keberlanjutan, dan kepuasan pelanggan. Mereka menawarkan berbagai produk otentik dari Korea dan Jepang, sehingga pelanggan dapat merasakan dan menghadirkan cita rasa khas Asia dalam rumah mereka. Dengan staf yang ramah dan pengetahuan yang luas tentang produk, Ssayomart berusaha memberikan pengalaman belanja yang menyenangkan dan informatif bagi pelanggan yang ingin menjelajahi kuliner Asia.</p>

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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-4">
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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-4">
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

        <!-- Slider card  -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="fw-bold text-dark mt-4">Our Perfect Team in <span class="text-danger">Ssayomart</span></h2>
                    <div class="swiper card-swiper mt-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="product" style="width: 100px; height: 100px;">

                                    <h5 class="menu-title text-dark text-center mt-2">John Due</h5>
                                    <h5 class="menu-title text-muted small text-center">CEO</h5>

                                    <p class="text-secondary text-center mt-2 mx-3">
                                        "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus quos veniam repudiandae numquam deleniti saepe".
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="product" style="width: 100px; height: 100px;">

                                    <h5 class="menu-title text-dark text-center mt-2">John Due</h5>
                                    <h5 class="menu-title text-muted small text-center">CEO</h5>

                                    <p class="text-secondary text-center mt-2 mx-3">
                                        "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus quos veniam repudiandae numquam deleniti saepe".
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="product" style="width: 100px; height: 100px;">

                                    <h5 class="menu-title text-dark text-center mt-2">John Due</h5>
                                    <h5 class="menu-title text-muted small text-center">CEO</h5>

                                    <p class="text-secondary text-center mt-2 mx-3">
                                        "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus quos veniam repudiandae numquam deleniti saepe".
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="product" style="width: 100px; height: 100px;">

                                    <h5 class="menu-title text-dark text-center mt-2">John Due</h5>
                                    <h5 class="menu-title text-muted small text-center">CEO</h5>

                                    <p class="text-secondary text-center mt-2 mx-3">
                                        "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus quos veniam repudiandae numquam deleniti saepe".
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Slider Card -->

        <!-- Sistem Grid Desktop -->
        <!-- <div class="container d-none d-md-block mt-3">
            <div class="row"> -->
        <!-- Kolom Kiri -->
        <!-- <div class="col-md-3">
                    <div data-aos="fade-right">

                        <div class="mb-4">
                            <span class="font-weight-bold display-4">Berbagai <strong>Penghargaan</strong> dan <strong>Pencapaian</strong> yang diperoleh dari tahun 2015 smapai saat ini</span>
                        </div>
                    </div>
                </div> -->

        <!-- Kolom Kanan -->
        <!-- <div class="col-md-9">
                    <div class="row"> -->
        <!-- Kolom Atas Kanan -->
        <!-- <div class="col-md-6">
                            <div data-aos="fade-left">
                                <div class="mb-4">
                                    <div class="img-container">
                                        <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
                                        <div class="img-overlay"></div>
                                    </div>
                                </div>
                            </div>

                        </div> -->

        <!-- Kolom Atas Kiri -->
        <!-- <div class="col-md-6">
                            <div data-aos="fade-left">
                                <div class="mb-4">
                                    <div class="img-container">
                                        <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
                                        <div class="img-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

        <!-- Kolom Bawah Kanan -->
        <!-- <div class="col-md-6">
                            <div data-aos="fade-left">
                                <div class="mb-4">
                                    <div class="img-container">
                                        <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
                                        <div class="img-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

        <!-- Kolom Bawah Kiri -->
        <!-- <div class="col-md-6">
                            <div class="mb-4">
                                <div class="img-container">
                                    <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
                                    <div class="img-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Akhir sistem grid Destop -->

        <!-- form dan maps -->
        <div class="container mb-5">
            <div class="row">
                <h2 class="fw-bold text-dark mt-4 mb-4 text-center">About As <span class="text-danger">Ssayomart</span></h2>
                <!-- Kolom 1: Peta -->
                <div class="col-md-6">
                    <iframe class="maps rounded-4" src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d588.8346382611838!2d106.6190360362805!3d-6.224009368681214!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fdd1b4844f71%3A0x7a215719bcf3a770!2sSsayo%20Mart%20Indonesia!5e1!3m2!1sen!2sid!4v1700099064396!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <!-- Kolom 2: Formulir Inputan -->
                <div class="col-md-6 mt-2">
                    <form>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit" class="mt-3 btn btn-danger">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- akhir form dan maps -->




        <style>
            .bg-image {
                position: relative;
                overflow: hidden;
            }

            .bg-image img {
                width: 100%;
                height: auto;
                display: block;
            }

            .mask {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(45deg, hsla(168, 85%, 52%, 0.5), hsla(263, 88%, 45%, 0.5) 100%);
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
            }

            .bg-image:hover .mask {
                opacity: 1;
            }
        </style>
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





















<style>
    .full-description {
        height: 4em;
        /* Atur tinggi elemen "full-description" sesuai keinginan Anda (setara dengan sekitar 4 baris) */
        overflow: hidden;
    }

    /* Gaya untuk efek zoom in */
    .zoom-in {
        transition: transform 0.2s ease-in-out;
        /* Efek transisi */
    }

    .zoom-in:hover {
        transform: scale(1.1);
        /* Mengganti skala elemen saat hover (1.1 kali lebih besar) */
    }

    .img-container {
        position: relative;
    }

    .img-container img {
        width: 100%;
        height: auto;
    }

    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Warna latar belakang gelap */
        opacity: 0;
        /* Awalnya gambar tidak terlihat */
        transition: opacity 0.3s ease;
        /* Animasi perubahan opasitas */
    }

    .img-container:hover .img-overlay {
        opacity: 1;
        /* Ketika dihover, tampilkan latar belakang gelap */
    }

    @media (min-width: 375px) and (max-width: 415px) {
        .maps {
            width: 340px;
        }
    }

    @media (max-width: 280px) {

        .maps {
            width: 250px;
        }

        .img-container iframe {
            width: 100%;
            /* Mengisi lebar container */
            height: 0;
            padding-bottom: 56.25%;
            /* Mengatur rasio aspek video (16:9) */
        }

        .img-container {
            position: relative;
        }

        .img-container img {
            width: 100%;
            height: auto;
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

        // autoplay: {
        //   delay: 1500,
        //   disableOnInteraction: false,
        // },


    });

    function tampilkanSelengkapnya(button) {
        var fullDescription = button.parentElement.querySelector('.full-description');
        var readMoreButton = button;

        if (fullDescription.style.display === 'none' || fullDescription.style.display === '') {
            fullDescription.style.display = 'inline';
            readMoreButton.textContent = 'Read Less';
        } else {
            fullDescription.style.display = 'none';
            readMoreButton.textContent = 'Read More';
        }
    }

    // Mencari semua tombol "Read More" pada halaman
    var readMoreButtons = document.querySelectorAll('.btn.btn-danger');

    // Menambahkan event listener untuk setiap tombol
    for (var i = 0; i < readMoreButtons.length; i++) {
        readMoreButtons[i].addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pergeseran ke atas
            tampilkanSelengkapnya(this);
        });
    }
</script>



<?= $this->endSection(); ?>