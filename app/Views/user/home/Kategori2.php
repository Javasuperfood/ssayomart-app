<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarTop') ?>
<?= $this->include('user/home/component/slider') ?>

<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Font Noto Sans Korean -->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Korean:400,700&display=swap"> -->

<!-- Mobile View  -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <!-- Modal  Homepage-->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <?php foreach ($banner_pop_up as $pop) : ?>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 bg-transparent">
                        <div class="modal-body d-flex justify-content-center align-items-center">
                            <img src="<?= base_url() ?>assets/img/banner/popup/<?= $pop['img'] ?>" class="img-fluid" alt="<?= $pop['title']; ?>">
                            <button type="button" class="btn-close position-absolute btn rounded-circle" data-bs-dismiss="modal" aria-label="Close" style="background-color: white; opacity: 1;"></button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- tampil modal only first time dan update 24 jam  JANGAN DIOTAK ATIK-->
        <script>
            $(document).ready(function() {
                // Fungsi untuk menampilkan modal
                function showModal() {
                    $('#imageModal').modal('show');
                }

                // Cek apakah modal sudah ditampilkan sebelumnya dalam sesi ini
                var modalShownThisSession = sessionStorage.getItem('modalShown');

                if (modalShownThisSession !== 'true') {
                    // Tampilkan modal setelah 1 detik pertama
                    setTimeout(function() {
                        showModal();
                        sessionStorage.setItem('modalShown', 'true');
                    }, 1 * 1000);
                } else {
                    // Setelah 1 detik pertama, tampilkan modal setiap 24 jam
                    setInterval(function() {
                        showModal();
                    }, 86400 * 1000); // 24 jam dalam milidetik
                }

                // Cek apakah modal pernah ditampilkan dengan cookie
                var modalShownBefore = getCookie('modalShown');

                if (modalShownBefore !== 'true') {
                    showModal();
                    setCookie('modalShown', 'true', 365); // Setel cookie untuk menandai modal sudah ditampilkan
                }
            });

            // Fungsi untuk mengatur cookie
            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + value + expires + "; path=/";
            }

            // Fungsi untuk mendapatkan nilai cookie
            function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }
        </script>
        <!-- tampil modal only first time dan update 24 jam  JANGAN DIOTAK ATIK-->


        <div class="class" style="position: relative; top: -15px;">
            <!-- Banner Promosi Item -->
            <section id="rekomendasi" style="background-color: #f3f5df;">
                <div class="card" style="border: none; font-family: 'Poppins'; position: relative;background-color: #f3f5df; ">
                    <div class="container mb-0 mt-3">
                        <img src="<?= base_url() ?>assets/img/text/TEXT-SARAN-MASAK-2.png" alt="Deskripsi Gambar" class="card-img-top responsive-image" style="width: 340px;">
                    </div>
                </div>

                <div class="container">
                    <div class="row px-2">
                        <?php
                        $iteration = 0; // Inisialisasi variabel iterasi
                        foreach ($promo as $p) :
                            if ($iteration < 4) : // Batasan 4 iterasi
                        ?>
                                <div class="col-6 py-1 px-1">
                                    <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                        <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" alt="<?= $p['title']; ?>" class="rounded-3 card-img-top">
                                    </a>
                                </div>
                        <?php
                                $iteration++; // Tingkatkan variabel iterasi
                            endif;
                        endforeach
                        ?>
                    </div>
                </div>
            </section>
            <!-- Akhir Banner Promosi Item -->

            <!-- rekomendasi produk -->
            <div class="mt-3"></div>
            <?php if ($produk) : ?>
                <div class="container">
                    <div class="card border-0 text-center font-family-poppins" style="background-color: #facaaf;">
                        <div class="card-warning">
                            <span class="card-title fw-medium fs-5 text-capitalize" style="font-family: 'Noto Sans KR', sans-serif; color: #9c2525;"><strong><?= lang('Text.produk_rekomendasi') ?></strong></h2>
                            </span>
                        </div>
                    </div>

                    <div class="row mt-2 card-grup">
                        <?php
                        // Kategori2.php

                        // Tentukan variabel global untuk menandai bahwa ini adalah homepage
                        define('IS_HOMEPAGE', true);

                        // Muat tampilan file card2.php
                        echo view('user/produk/component/card2');
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Produk Terbaru -->
            <div class="container">
                <div class="card border-0 text-center font-family-poppins" style="background-color: #dcf7d0;">
                    <div class="card-warning">
                        <span class="card-title  fw-medium fs-5 text-capitalize" style="font-family: 'Noto Sans KR', sans-serif; color: #2e6e01;"><strong><?= lang('Text.produk_terbaru') ?></strong></h2>
                        </span>
                    </div>
                </div>

                <div class="row row-cols-3 me-0 mt-2 agak-kekanan">
                    <?php if ($latest) : ?>
                        <?php foreach ($latest as $p) : ?>
                            <div class="col-4 col-md-2 col-lg-2 mb-3 mx-0 susunan-card">
                                <div class="card card-produk border-0 shadow-sm text-center" style="width: 105px; height: 100%; padding: 5px;">
                                    <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top text-center py-0 px-0 mx-0 my-0 im_produk_<?= $p['id_produk']; ?>_" alt="..." style=" width: 100px; height: 100px; object-fit: contain; object-position: 20% 10%;">
                                        </div>
                                    </a>
                                    <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                        <div class="d-flex align-items-start justify-content-center" style=" height: 65px;">
                                            <p class=" text-center text-secondary fw-bold " style=" font-size: 8px; margin: 0;"><?= substr($p['nama'], 0, 40); ?></p>
                                        </div>
                                        <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                            <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                                        </p>

                                        <h1 class="text-danger fs-bold mt-1 mb-1 fw-bold" style="font-size: 10px; margin: 0;">
                                            <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                                Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                            <?php else : ?>
                                                <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>
                                            <?php endif ?>
                                        </h1>

                                        <!-- button Animasi -->
                                        <div class="button-container" id="button-container-<?= $p['id_produk']; ?>">
                                            <div class="button" onclick="changeToCapsule(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)">
                                                <i class="icon bi bi-plus d-flex justify-content-center align-items-center"></i>
                                            </div>

                                            <div class="button-capsule" style="display: none;">
                                                <i class="icon bi bi-dash" onclick="decreaseValue(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)"></i>
                                                <input type="number" class="input border-0" value="1" id="counter-<?= $p['id_produk']; ?>">
                                                <i class="icon bi bi-plus" onclick="increaseValue(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)"></i>
                                            </div>
                                        </div>
                                        <!-- akhir button animasi -->
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!--button Goto All Kategori -->
            <section class="mt-1">
                <div class="card font-family-poppins border-0" style="background-color: #fecdce; display: grid; grid-template-columns: 1fr auto; align-items: center; padding: 1rem; font-size: 12px;">

                    <a style="color: #7e0204;" href="<?= base_url(); ?>all-category" id="goToCategories" class="fw-bold text-decoration-none">
                        <span class="text-secondary fw-bold" style="font-size: 14px;">모든 카테고리 보기</span>
                        <br>
                        <span class="fw-bold" style="font-size: 16px;">Ketuk untuk melihat semua kategori</span>
                    </a>

                    <i class="bi bi-grid-3x3-gap-fill" style="font-size: 25px; color: #7e0204;"></i>

                </div>
            </section>
            <!-- end button goto all kategori -->
            <!-- scroll up -->
            <button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="bi bi-chevron-up d-flex justify-content-center align-items-center fs-6"></i></button>
            <!-- scroll up -->
        </div>

        <?php if (!$produk) : ?>
            <script>
                // tombol Scroll Up
                var scrollUpButton = document.getElementById("scrollUpButton");

                // Tampilkan tombol Scroll Up ketika pengguna menggulir ke bawah
                window.addEventListener("scroll", function() {
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        scrollUpButton.style.display = "block";
                    } else {
                        scrollUpButton.style.display = "none";
                    }
                });

                // Scroll kembali ke atas saat tombol Scroll Up diklik
                scrollUpButton.addEventListener("click", function() {
                    document.body.scrollTop = 0; // Untuk browser Safari
                    document.documentElement.scrollTop = 0; // Untuk browser lainnya
                });
            </script>
            <script>
                var goToCategoriesBtn = document.getElementById('goToCategories');

                goToCategoriesBtn.addEventListener('click', function() {
                    // Tambahkan kelas animate.css untuk animasi ke kanan
                    goToCategoriesBtn.classList.add('animate__animated', 'animate__slideOutRight');

                    // Hapus kelas animate.css setelah animasi selesai
                    goToCategoriesBtn.addEventListener('animationend', function() {
                        goToCategoriesBtn.classList.remove('animate__animated', 'animate__slideOutRight');
                    });
                });

                function changeToCapsule(c, v) {
                    $(`#button-container-${c} .button`).css('display', 'none');
                    $(`#button-container-${c} .button-capsule`).css('display', 'flex');
                    addToCartProductList(c, v, 1)
                    cartItemShow('plus'); // cart script
                    let im_produk = document.querySelectorAll('.im_produk_' + c + '_');
                    im_produk.forEach(function(e) {
                        e.classList.add('animate__animated', 'animate__tada');
                        e.addEventListener('animationend', () => {
                            e.classList.remove('animate__animated', 'animate__tada');
                        });
                    });

                    let cartcart = document.querySelector('.a_cart_link_0');
                    cartcart.classList.add('animate__animated', 'animate__shakeY');
                    cartcart.addEventListener('animationend', () => {
                        cartcart.classList.remove('animate__animated', 'animate__shakeY');
                    });
                }

                function decreaseValue(c, v) {
                    var counter = document.querySelectorAll(`#counter-${c}`);;
                    let q = 1;
                    let ss = true
                    counter.forEach(function(e) {
                        if (parseInt(e.value) > 0) {
                            e.value = (parseInt(e.value) - 1);
                            if (parseInt(e.value) < 1) {
                                e.value = 1;
                                if (ss) {
                                    ss = changeToCircle(c);
                                }
                            }
                        }
                    });
                    if (ss) {
                        addToCartProductList(c, v, q)
                    }
                }

                function increaseValue(c, v) {
                    var counter = document.querySelectorAll(`#counter-${c}`);
                    let q = 1
                    counter.forEach(function(e) {
                        e.value = (parseInt(e.value) + 1);
                        q = e.value;
                    });
                    addToCartProductList(c, v, q)
                    let cartcart = document.querySelector('.a_cart_link_0');
                    cartcart.classList.add('animate__animated', 'animate__shakeY');
                    cartcart.addEventListener('animationend', () => {
                        cartcart.classList.remove('animate__animated', 'animate__shakeY');
                    });
                }

                function changeToCircle(c) {
                    $(`#button-container-${c} .button`).css('display', 'flex');
                    $(`#button-container-${c} .button-capsule`).css('display', 'none');
                    cartDeleteProdukList(c)
                }


                function addToCartProductList(c, v, q) {
                    var produk = c;
                    var varian = v;
                    var qty = q;
                    // console.log(produk, varian, qty)
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('api/add-to-cart'); ?>",
                        dataType: "json",
                        data: {
                            id_produk: produk,
                            id_varian: varian,
                            qty: qty
                        },
                        success: function(response) {
                            if (response.success) {
                                // console.log(response.message)
                                return true
                            } else {
                                // console.log(response.message)
                                return false
                            }
                        },
                        error: function(error) {
                            console.error("Error:", error);
                            <?php if (!auth()->loggedIn()) : ?>
                                location.href = '<?= base_url(); ?>login'
                            <?php endif ?>
                            return false
                        }
                    });
                }

                function cartDeleteProdukList(produk) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('api/delete-cart-product'); ?>",
                        dataType: "json",
                        data: {
                            produk: produk,
                        },
                        success: function(response) {
                            cartItemShow('minus'); // cart script
                        },
                        error: function(error) {
                            console.error("Error:", error);
                            <?php if (!auth()->loggedIn()) : ?>
                                location.href = '<?= base_url(); ?>login'
                            <?php endif ?>
                        }
                    });
                }
            </script>
        <?php endif ?>

        <!-- STYLE BUTTON ALL KATEGORI -->
        <!-- <style>
            .custom-border {
                /* Adjust the RGBA values and alpha (transparency) as needed */
                border-radius: 10px;


            }

            .custom-button {
                background: linear-gradient(to left, #fb0408, #c90306);
                /* Set your custom linear gradient */
                color: #fff;
                /* Set your custom text color */
                border: 3px solid rgb(170, 29, 37);
                /* Set your custom border color */
                border-radius: 10px;
                /* Set your custom border radius */
                padding: 10px 20px;
                /* Adjust padding as needed */
                text-align: center;
                text-decoration: none;
                display: inline-block;
                transition: background 0.3s ease, border-color 0.3s ease, color 0.3s ease;
            }
        </style> -->

        <!-- style all device css card -->
        <style>
            @media screen and (min-width: 400px) and (max-width: 450px) {
                .card-produk {
                    width: 120px !important;
                    /* Mengisi lebar parent container */
                }
            }

            @media screen and (min-width: 717px) and (max-width: 717px) {
                .susunan-card {
                    justify-content: center;
                    align-items: center;
                    max-width: 25% !important;
                    flex: 0 0 100% !important;
                    /* width: 20% !important; */
                }

                .card-produk {
                    width: 120px !important;
                    /* Mengisi lebar parent container */
                }

                .horizontal-counter {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .horizontal-counter button,
                .horizontal-counter input {
                    width: 40px;
                    /* Adjust as needed */
                    height: 20px;
                    /* Adjust as needed */
                    font-size: 13px;
                    /* Adjust as needed */
                }

                .custom-button {
                    display: flex;
                    justify-content: center;
                }

                /* .row.card-grup {
                    justify-content: center;
                    align-items: center;
                    max-width: 31% !important;
                    flex: 0 0 100% !important;

                } */

            }

            @media screen and (min-width: 512px) and (max-width: 512px) {
                .susunan-card {
                    justify-content: center;
                    align-items: center;
                    max-width: 31% !important;
                    flex: 0 0 100% !important;
                    /* width: 20% !important; */
                }

                .card-produk {
                    width: 120px !important;
                    /* Mengisi lebar parent container */
                }

                .horizontal-counter {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .horizontal-counter button,
                .horizontal-counter input {
                    width: 40px;
                    /* Adjust as needed */
                    height: 20px;
                    /* Adjust as needed */
                    font-size: 13px;
                    /* Adjust as needed */
                }

                .custom-button {
                    display: flex;
                    justify-content: center;
                }

                .agak-kekanan {
                    justify-content: center;
                    margin-right: 0%;
                    margin-left: 0%;
                }

            }

            @media (max-width: 280px) {

                .susunan-card {
                    flex: 0 0 100% !important;
                    max-width: 50%;
                }

                .card-produk {
                    width: 120px !important;
                    /* Mengisi lebar parent container */
                }

            }

            @media (min-width: 320px) and (max-width: 320px) {

                .susunan-card {
                    flex: 0 0 100% !important;
                    max-width: 50%;
                }

                .card-produk {
                    width: 130px !important;
                    /* Mengisi lebar parent container */
                }

            }
        </style>
        <!-- end CSS all device -->

        <!-- button scroll up -->
        <style>
            #scrollUpButton {
                display: none;
                position: fixed;
                bottom: 200px;
                right: 10px;
                width: 30px;
                height: 40px;
                padding: 10px 20px;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                z-index: 99;
            }
        </style>

        <!-- buton close  all device-->
        <style>
            .btn-close {
                background-color: #ffff;
                color: #000;
                font-size: 10px;
                /* margin-right: 4%; */
                margin-top: 123%;
            }

            /* Membuat tombol close berbentuk lingkaran */
            .btn-close {
                border-radius: 50%;
                width: 25px;
                height: 25px;
            }

            /*samsung galaxy fold dual mode*/
            @media screen and (min-width: 717px) and (max-width: 717px) {

                .btn-close {
                    background-color: #ffff;
                    color: #000;
                    font-size: 10px;
                    margin-top: 60%;
                }

                .btn-close {
                    border-radius: 50%;
                    width: 25px;
                    height: 25px;
                }

                .img-fluid {
                    width: 200px;
                    max-width: 100%;
                    height: auto;
                }
            }

            /* Ipad */
            @media screen and (min-width: 768px) and (max-width: 1024px) {

                .btn-close {
                    background-color: #ffff;
                    color: #000;
                    font-size: 10px;
                    margin-left: 7%;
                    margin-top: 87%;

                    /* atau warna lain sesuai kebutuhan */
                }

                /* Membuat tombol close berbentuk lingkaran */
                .btn-close {
                    margin-right: 5%;
                    width: 25px;
                    /* Sesuaikan ukuran sesuai kebutuhan */
                    height: 25px;
                    /* Sesuaikan ukuran sesuai kebutuhan */
                }

            }

            /* samsung galaxy fold lipat */
            @media (max-width: 280px) {

                .btn-close {
                    background-color: #ffff;
                    color: #000;
                    font-size: 10px;
                    margin-top: 125%;

                    /* atau warna lain sesuai kebutuhan */
                }

                /* Membuat tombol close berbentuk lingkaran */
                .btn-close {
                    border-radius: 50%;
                    width: 25px;
                    /* Sesuaikan ukuran sesuai kebutuhan */
                    height: 25px;
                    /* Sesuaikan ukuran sesuai kebutuhan */
                }

            }

            @media (min-width: 512px) and (max-width: 512px) {

                .btn-close {
                    background-color: #ffff;
                    color: #000;
                    font-size: 10px;
                    margin-top: 87%;

                    /* atau warna lain sesuai kebutuhan */
                }

                /* Membuat tombol close berbentuk lingkaran */
                .btn-close {
                    border-radius: 50%;
                    width: 25px;
                    /* Sesuaikan ukuran sesuai kebutuhan */
                    height: 25px;
                    /* Sesuaikan ukuran sesuai kebutuhan */
                }

            }
        </style>

        <style>
            /* Media query for Samsung Galaxy Fold jangan di hapus*/
            @media screen and (max-width: 280px) {
                img.card-img-top {
                    max-width: 100%;
                }
            }
        </style>
    <?php else : ?>
        <!-- Desktop View -->
        <div id="desktopContent" style="margin-top:15px;">
            <!-- Modal  Homepage-->
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <?php foreach ($banner_pop_up as $pop) : ?>
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 bg-transparent">
                            <div class="modal-body d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/banner/popup/<?= $pop['img'] ?>" class="img-fluid" alt="<?= $pop['title']; ?>">
                                <button type="button" class="btn-close position-absolute btn btn-light rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <!-- tampil modal only first time dan update 24 jam  JANGAN DIOTAK ATIK-->
            <script>
                $(document).ready(function() {
                    // Fungsi untuk menampilkan modal
                    function showModal() {
                        $('#imageModal').modal('show');
                    }

                    // Cek apakah modal sudah ditampilkan sebelumnya dalam sesi ini
                    var modalShownThisSession = sessionStorage.getItem('modalShown');

                    if (modalShownThisSession !== 'true') {
                        // Tampilkan modal setelah 1 detik pertama
                        setTimeout(function() {
                            showModal();
                            sessionStorage.setItem('modalShown', 'true');
                        }, 1 * 1000);
                    } else {
                        // Setelah 1 detik pertama, tampilkan modal setiap 24 jam
                        setInterval(function() {
                            showModal();
                        }, 86400 * 1000); // 24 jam dalam milidetik
                    }

                    // Cek apakah modal pernah ditampilkan dengan cookie
                    var modalShownBefore = getCookie('modalShown');

                    if (modalShownBefore !== 'true') {
                        showModal();
                        setCookie('modalShown', 'true', 365); // Setel cookie untuk menandai modal sudah ditampilkan
                    }
                });

                // Fungsi untuk mengatur cookie
                function setCookie(name, value, days) {
                    var expires = "";
                    if (days) {
                        var date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toUTCString();
                    }
                    document.cookie = name + "=" + value + expires + "; path=/";
                }

                // Fungsi untuk mendapatkan nilai cookie
                function getCookie(name) {
                    var nameEQ = name + "=";
                    var ca = document.cookie.split(';');
                    for (var i = 0; i < ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                    }
                    return null;
                }
            </script>

            <section id="unggul">
                <div class="container">
                    <div class="card border-0 text-center text-bold mb-3 font-family-poppins d-flex justify-content-center align-items-center" style="background-color: #d7eff8;">
                        <div class="card-warning">
                            <span class="card-title text-dark fw-bold fs-2"><?= lang('Text.spesial') ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="swiper myBanner">
                                <div class="swiper-wrapper d-flex justify-content-center align-items-center">
                                    <?php foreach ($promo as $p) : ?>
                                        <div class="swiper-slide">
                                            <div class="text-bg-light mb-3 bg-white">
                                                <div class="card-body">
                                                    <a href="<?= base_url('promo/' . $p['slug']) ?>">
                                                        <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" width="60px" alt="<?= $p['title']; ?>" class="card-img-top">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- swipper card tampilan web -->
            <section id="unggul">
                <div class="container py-3">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="card border-0 text-center font-family-poppins" style="background-color: #ccebbc;">
                                <div class="card-danger">
                                    <span class="card-title text-dark fw-bold fs-2"><?= lang('Text.nama_produk') ?></h2>
                                </div>
                            </div>
                            <div class="mt-3 d-flex justify-content-center align-items-center swiper mySwing">
                                <div class="swiper-wrapper d-flex mb-3">
                                    <?php foreach ($randomProducts as $p) : ?>
                                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                                            <div class="card border-0 shadow-sm" style="width: auto; height: 100%;">
                                                <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 200px; height: 200px; object-fit: contain; object-position: 20% 10%;">
                                                    </div>
                                                </a>
                                                <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                                    <div class="d-flex text-center align-items-center justify-content-center" style="height: 65px;">
                                                        <p class=" text-secondary fw-bold " style=" font-size: 13px; margin: 0;"><?= substr($p['nama'], 0, 40); ?></p>
                                                    </div>
                                                    <p class="text-secondary text-center" style="font-size: 12px; margin: 0;">
                                                        <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                                                    </p>

                                                    <h1 class="mb-4 text-danger fw-bold mt-1 text-center" style="font-size: 18px; margin: 0;">
                                                        <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                                            Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                                        <?php else : ?>
                                                            <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>...
                                                        <?php endif ?>
                                                    </h1>

                                                    <!-- button Animasi -->
                                                    <div class="button-container" id="button-container-<?= $p['id_produk']; ?>">
                                                        <div class="button" onClick="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOver="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOut="changeToCircle(<?= $p['id_produk']; ?>)">
                                                            <i class="bi bi-plus text-danger fw-bold" style="font-size: 16px;"></i>
                                                        </div>
                                                        <div class="button-capsule" onMouseOver="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOut="changeToCircle(<?= $p['id_produk']; ?>)">
                                                            <div class="icon" onClick="decreaseValue(<?= $p['id_produk']; ?>)">-</div>
                                                            <input type="text" id="counter-<?= $p['id_produk']; ?>" class="input" value="1" disabled>
                                                            <div class="icon" onClick="increaseValue(<?= $p['id_produk']; ?>)">+</div>
                                                        </div>
                                                    </div>
                                                    <!-- akhir button animasi -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- rekomendasi title -->
                    <!-- <div class="container py-3">
                        <div class="card border-0 text-center font-family-poppins" style="background-color: #fce0e4;">
                            <div class="card-danger">
                                <span class="card-title text-dark fw-bold fs-2"><?= lang('Text.saran_masak') ?></h2>
                            </div>
                        </div>
                    </div> -->
                    <!-- end rekomendasi title-->
                    <!-- card rekomendasi -->
                    <!-- <div class="container mt-3">
                        <div class="row">
                            <div class="swiper mySwung">
                                <div class="mb-5 swiper-wrapper d-flex">
                                    <?php foreach ($blog_detail as $bd) : ?>
                                        <div class="swiper-slide">
                                            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                                                <div class="card-body p-4">
                                                    <div class="d-flex text-black">
                                                        <div class="flex-shrink-0">
                                                            <img src="<?= base_url() ?>assets/img/blog/<?= $bd['img_thumbnail']; ?>" alt="Thumbnail Artikel" class="img-fluid rounded-3" style="height: 180px; width: 180px;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <p class="mb-2 pb-1 fw-bold fs-5 text-dark"><?= substr($bd['judul_blog'], 0, 40); ?>...</p>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-0">
                                                                <p class="text-secondary"><?= lang('Text.selengkapnya') ?></p>
                                                            </div>
                                                            <div class="d-flex pt-0">
                                                                <a href="<?= base_url(); ?>blog/<?= $bd['id_blog']; ?>" class="btn btn-danger fw-medium flex-grow-1">View More <i class="bi bi-arrow-right-circle"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- end card rekomendasi-->
                    <div class="container py-1">
                        <div class="card border-0 text-center text-bold mb-3 font-family-poppins d-flex justify-content-center align-items-center" style="background-color: #ccebbc;">
                            <div class="card-success">
                                <span class="card-title text-dark fw-bold fs-2 text-capitalize"><?= lang('Text.kategori') ?></span>
                            </div>
                        </div>
                        <div class="row text-center row-cols-3 py-3">
                            <?php foreach ($kategori as $k) : ?>
                                <div class="col-4 col-md-4 col-lg-2">
                                    <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                                        <div class="card text-bg-light mb-3 bg-white border-0 shadow-sm">
                                            <div class="card-body">
                                                <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" alt="" class="py-0 px-0 mx-0 my-0 card-img-top">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- script button counter animasi -->
        <script>
            function changeToCapsule(productId) {
                document.querySelector(`#button-container-${productId} .button`).style.display = 'none';
                document.querySelector(`#button-container-${productId} .button-capsule`).style.display = 'flex';
            }

            function decreaseValue(productId) {
                var counter = document.getElementById(`counter-${productId}`);
                if (parseInt(counter.value) > 0) {
                    counter.value = parseInt(counter.value) - 1;
                }
                validateCounter(productId);
            }

            function increaseValue(productId) {
                var counter = document.getElementById(`counter-${productId}`);
                counter.value = parseInt(counter.value) + 1;
                validateCounter(productId);
            }

            function changeToCircle(productId) {
                document.querySelector(`#button-container-${productId} .button`).style.display = 'flex';
                document.querySelector(`#button-container-${productId} .button-capsule`).style.display = 'none';
            }

            function validateCounter(productId) {
                var counter = document.getElementById(`counter-${productId}`);
                if (parseInt(counter.value) <= 1) {
                    counter.value = 1;
                    changeToCircle(productId);
                }
            }
        </script>
        <!-- akhir script button counter animasi -->
    </div>

    <style>
        /* Ganti warna tombol close menjadi putih */
        .btn-close {
            background-color: #ffff;
            color: #000;
            font-size: 10px;
            margin-top: 85%;

            /* atau warna lain sesuai kebutuhan */
        }

        /* Membuat tombol close berbentuk lingkaran */
        .btn-close {
            border-radius: 50%;
            width: 20px;
            /* Sesuaikan ukuran sesuai kebutuhan */
            height: 20px;
            /* Sesuaikan ukuran sesuai kebutuhan */
        }
    </style>
    <!-- tampil modal only first time dan update 24 jam  JANGAN DIOTAK ATIK-->

    <!-- styling button counter animasi  dekstop-->
    <style>
        .button-container {
            position: absolute;
            top: 7px;
            /* Jarak dari atas */
            left: 7px;
            /* Jarak dari kiri */
            display: flex;
            gap: 5px;
            /* Jarak antar tombol */
        }

        .button {
            width: 30px;
            /* Ukuran tombol yang lebih kecil */
            height: 30px;
            /* Ukuran tombol yang lebih kecil */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: 1px solid #e83b2e;
            background-color: #fff;
        }


        .button-capsule {
            width: 60px;
            /* Ukuran capsule yang lebih kecil */
            height: 30px;
            /* Ukuran capsule yang lebih kecil */
            border-radius: 15px;
            display: none;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            padding: 0 5px;
            /* Padding yang lebih kecil */
            transition: all 0.3s ease;
            outline: 1px solid #e83b2e;
            background-color: #fff;
        }

        .icon {
            font-size: 16px;
            color: #e83b2e;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .input {
            width: 20px;
            /* Ukuran input yang lebih kecil */
            height: 15px;
            /* Ukuran input yang lebih kecil */
            text-align: center;
            margin: 0 3px;
            /* Margin yang lebih kecil */
            color: #000;
            font-size: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            outline: none;
        }
    </style>
    <!-- akhir styling button counter animasi -->
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

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">

<?= $this->endSection(); ?>