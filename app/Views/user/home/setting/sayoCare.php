<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

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

<body>
    <div class="container-fluid p-0 position-relative">
        <div class="img-container">
            <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
            <div class="img-overlay"></div>
        </div>
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white fs-2">
            <h1>ABOUT US</h1>
            <p>PT Ssayomart Indonesia </p>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-md-6">
                <!-- Konten Kolom Pertama -->
                <div class="img-container">
                    <img src="<?= base_url() ?>assets/img/sampel.jpg" width="650px" height="350px" alt="" class="img-fluid">
                    <div class="img-overlay"></div>
                </div>

            </div>
            <div class="col-12 col-md-6 text-end">
                <!-- Konten Kolom Kedua -->
                <h3>Tentang Ssayomart </h3>
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

                <div class="img-container">
                    <!-- Ganti gambar dengan video YouTube -->
                    <iframe src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe>
                    <!-- Ganti "VIDEO_ID" dengan ID video YouTube yang sesuai -->
                    <div class="img-overlay"></div>
                </div>

            </div>

        </div>
    </div>

    <div class="container mt-3 d-none d-md-block">
        <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Potrait <span class="text-danger">Ssayomart</span></h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid">
            </div>
            <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid">
            </div>
            <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid">
            </div>
            <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid">
            </div>
        </div>
        <h2 class="fw-bold text-dark mt-4">Galeri Kami gambar Landscape <span class="text-danger">Ssayomart</span></h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid">
            </div>
            <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid">
            </div>
            <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid">
            </div>
            <div class="col mb-4 zoom-in"> <!-- Tambahkan kelas zoom-in di sini -->
                <img src="<?= base_url() ?>assets/img/sampel.jpg" width="350px" height="200px" alt="" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- galery photos Mobile -->
    <div class="container d-md-none">
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
    </div>
    <!-- akhir galeri photos -->

    <!-- Slider card  -->
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="fw-bold text-dark mt-4">Tips & Trik Cooking <span class="text-danger">Ssayomart</span></h2>
                <div class="swiper card-swiper mt-3">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid" alt="product">
                                <h5 class="menu-title text-dark mt-3 mx-3">Saus gochujang</h5>
                                <p class="text-secondary mt-2 mx-3">
                                    Saus Gochujang khas Korea memiliki aroma dan rasa pedas yang unik.
                                    <span class="full-description mx-3">
                                        Saus Gochujang ini dapat diaplikasikan pada berbagai olahan makanan seperti Bibimbap
                                    </span>
                                    <a href="#" class="rounded-5 btn btn-danger mt-2" style="text-align: center;" onclick="tampilkanSelengkapnya()">Read More</a>
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid" alt="product">
                                <h5 class="menu-title text-dark mt-3 mx-3">Saus gochujang</h5>
                                <p class="text-secondary mt-2 mx-3">
                                    Saus Gochujang khas Korea memiliki aroma dan rasa pedas yang unik.
                                    <span class="full-description mx-3">
                                        Saus Gochujang ini dapat diaplikasikan pada berbagai olahan makanan seperti Bibimbap
                                    </span>
                                    <a href="#" class="rounded-5 btn btn-danger mt-2" style="text-align: center;" onclick="tampilkanSelengkapnya()">Read More</a>
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid" alt="product">
                                <h5 class="menu-title text-dark mt-3 mx-3">Saus gochujang</h5>
                                <p class="text-secondary mt-2 mx-3">
                                    Saus Gochujang khas Korea memiliki aroma dan rasa pedas yang unik.
                                    <span class="full-description mx-3">
                                        Saus Gochujang ini dapat diaplikasikan pada berbagai olahan makanan seperti Bibimbap
                                    </span>
                                    <a href="#" class=" rounded-5 btn btn-danger mt-2" style="text-align: center;" onclick="tampilkanSelengkapnya()">Read More</a>
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide col-md-4 mx-md-2 mb-md-2 mb-3">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url() ?>assets/img/sampel.jpg" class="card-img-top img-fluid" alt="product">
                                <h5 class="menu-title text-dark mt-3 mx-3">Saus gochujang</h5>
                                <p class="text-secondary mt-2 mx-3">
                                    Saus Gochujang khas Korea memiliki aroma dan rasa pedas yang unik.
                                    <span class="full-description mx-3">
                                        Saus Gochujang ini dapat diaplikasikan pada berbagai olahan makanan seperti Bibimbap
                                    </span>
                                    <a href="#" class="rounded-5 btn btn-danger mt-2" style="text-align: center;" onclick="tampilkanSelengkapnya()">Read More</a>
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
    <div class="container d-none d-md-block mt-3">
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-3">
                <div data-aos="fade-right">

                    <div class="mb-4">
                        <span class="font-weight-bold display-4">Tips memasak Ala Korean Food Dirumah Anda dengan <strong>Praktis</strong> dan <strong>Enak</strong></span>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-9">
                <div class="row">
                    <!-- Kolom Atas Kanan -->
                    <div class="col-md-6">
                        <div data-aos="fade-left">
                            <div class="mb-4">
                                <div class="img-container">
                                    <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
                                    <div class="img-overlay"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Kolom Atas Kiri -->
                    <div class="col-md-6">
                        <div data-aos="fade-left">
                            <div class="mb-4">
                                <div class="img-container">
                                    <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
                                    <div class="img-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Bawah Kanan -->
                    <div class="col-md-6">
                        <div data-aos="fade-left">
                            <div class="mb-4">
                                <div class="img-container">
                                    <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
                                    <div class="img-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Bawah Kiri -->
                    <div class="col-md-6">
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
    </div>
    <!-- Akhir sistem grid Destop -->

    <!-- form dan maps -->
    <div class="container">
        <div class="row">
            <!-- Kolom 1: Peta -->
            <div class="col-md-6">
                <iframe width="600" height="450" frameborder="0" style="border:0" src="https://maps.app.goo.gl/EopSSXetcdNkovWJ6" allowfullscreen></iframe>
            </div>

            <!-- Kolom 2: Formulir Inputan -->
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan nama">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat">
                    </div>
                    <button type="submit" class=" mt-3 btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <!-- akhir form dan maps -->

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

</body>

<?= $this->endSection(); ?>