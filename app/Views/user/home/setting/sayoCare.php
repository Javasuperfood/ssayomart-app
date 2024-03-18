<?= $this->extend('user/home/layout2') ?>

<!-- custom head  -->
<?= $this->section('custom_head'); ?>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css">
<script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>
<?= $this->endSection(); ?>

<!-- Main Conten  -->
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Mobile View  -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container-fluid p-0 position-relative">
            <div class="bg-image rounded-bottom-4">
                <img src="<?= base_url() ?>assets/img/about/bg1.jpg" width="650px" height="350px" alt="" class="img-fluid">
                <div class="mask"></div>
            </div>
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white fs-6 " style="font-family:cursive;">

                <h2 class="fw-bold tagline-2">PT Ssayomart Indonesia </h2>
            </div>
        </div>

        <!-- tentang ssayomart -->
        <div class="container mt-3">
            <div class="row">
                <div class="col">
                    <div data-aos="fade-down" data-aos-delay="500">
                        <!-- Konten Kolom Kedua -->
                        <h2 class="fw-bold mb-3 text-center">Tentang <span class="text-danger">Ssayomart</span> </h2>
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
                    <h2 class="fw-bold text-dark mt-4 text-center">Galeri Produk <span class="text-danger">Ssayomart</span></h2>
                    <div class="swiper telkom mt-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide d-flex justify-content-center">
                                <img src="<?= base_url() ?>assets/img/about/menu-1.jpg" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide d-flex justify-content-center">
                                <img src="<?= base_url() ?>assets/img/about/menu-2.png" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide d-flex justify-content-center">
                                <img src="<?= base_url() ?>assets/img/about/menu-3.png" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide d-flex justify-content-center">
                                <img src="<?= base_url() ?>assets/img/about/menu-3.png" alt="Gambar Besar" class="gambar img-fluid">
                            </div>
                            <div class="swiper-slide d-flex justify-content-center">
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
            <h2 class="fw-bold text-dark mt-4">Galeri Produk Recomendasi <span class="text-danger">Ssayomart</span></h2>
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
            <h2 class="fw-bold text-dark mt-4">Galeri Produk Unggulan <span class="text-danger">Ssayomart</span></h2>
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
        <!-- <div class="container">
            <div data-aos="zoom-in-down">
                <div class="row">
                    <div class="col">
                        <h2 class="fw-bold text-dark mt-4 text-center">Our Perfect Team in <span class="text-danger">Ssayomart</span></h2>
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

        </div> -->
        <!-- Slider card  Profil Founder-->

        <!-- form dan maps -->
        <div class="container mb-5">
            <h2 class="fw-bold text-dark mt-4 mb-4 text-center">About Us <span class="text-danger">Ssayomart</span></h2>
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
    </div>
<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top: 110px;">
        <div class="container-fluid p-0 position-relative">
            <div class="bg-image rounded-bottom-5">
                <img src="<?= base_url() ?>assets/img/about/bg1.jpg" width="650px" height="350px" alt="" class="img-fluid">
                <div class="mask"></div>
            </div>
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white fs-2 " style="font-family:cursive;">
                <h1>ABOUT US</h1>
                <h3>PT Ssayomart Indonesia </h3>
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
        <div class="container mt-3 d-none d-md-block">
            <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Potrait <span class="text-danger">Ssayomart</span></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-4">
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-1.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4 ">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-2.png" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-3.png" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-4.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
            </div>
            <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Landscape <span class="text-danger">Ssayomart</span></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-4">
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-5.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-6.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-7.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
                <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                    <img src="<?= base_url() ?>assets/img/about/menu-7.jpg" width="350px" height="200px" alt="" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
        <!-- form dan maps -->
        <div class="container">
            <div class="row">
                <h2 class="fw-bold text-dark mt-4 mb-4 text-center">About Us <span class="text-danger">Ssayomart</span></h2>
                <!-- kolom 1 untuk maps -->
                <div class="col-lg-6 col-md-12">
                    <iframe class="maps rounded-4" src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d588.8346382611838!2d106.6190360362805!3d-6.224009368681214!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fdd1b4844f71%3A0x7a215719bcf3a770!2sSsayo%20Mart%20Indonesia!5e1!3m2!1sen!2sid!4v1700099064396!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- kolom 2 form -->
                <div class="col-lg-6 col-md-12">
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
    </div>
<?php endif; ?>

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