<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);

$countProduk = count($produk);
?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<script>
    var page = 1; // Halaman awal
    var isLoading = false;
    var keyword = '';
    var productContainer = $("#product-container");
    var cardLoader = `<div class="col-4 col-md-2 col-lg-2 mb-3 susunan-card" id="cardLoader">
    <div class="">
                <div class="card card-produk border-0 shadow-sm text-center" style="width: 105px; height: 100%; padding: 5px;">
                    <div class="d-flex justify-content-center align-items-center">
                        <svg class="bd-placeholder-img card-img-top mt-1 text-center py-0 px-0 mx-0 my-0" width="100px" height="100px object-fit: contain; object-position: 20% 10%;" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100px" height="100px" fill="#868e96"></rect>
                        </svg>
                    </div>
                    <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                    <div class="d-flex align-items-start panjang-card justify-content-center" style="height: 90px;">
                    <p class=" text-secondary fw-bold" style="font-size: 9px; margin: 0;">
                        <span class="placeholder col-6"></span>
                    </p>
                    </div>
                    <p class=" text-secondary" style="font-size: 8px; margin: 0;">
                        <span class="placeholder col-6"></span>
                    </p>
 
                        <h1 class="text-dark fs-bold mt-1 mb-1 fw-bold" style="font-size: 10px; margin: 0;">
                            <span class="placeholder col-6"></span>
                        </h1>
                        
                        <div class="button-container">
                            <div class="button">
                                <i class="icon bi bi-plus d-flex justify-content-center align-items-center"></i>
                            </div>
 
                            <div class="button-capsule" style="display: none;">
                                <i class="icon bi bi-dash"></i>
                                <input type="number" class="input border-0" value="1">
                                <i class="icon bi bi-plus"></i>
                            </div>
                         </div>
    
                    </div>
                </div>
                </div>
            </div>`

    function loadMoreData() {
        if (!isLoading) {
            isLoading = true;
            page++;
            $.ajax({
                url: window.location,
                type: 'GET',
                data: {
                    produk: keyword,
                    page: page
                },
                success: function(data) {
                    data.forEach(function(p) {
                        var hargaText;
                        if (p.harga_min == p.harga_max) {
                            hargaText = "Rp. " + formatRupiah(p.harga_min);
                        } else {
                            hargaText = ("Rp. " + formatRupiah(p.harga_min) + "-" + formatRupiah(p.harga_max)).substring(0, 13) + "...";
                        }
                        var html = `<div class="col-4 col-md-2 col-lg-2 mb-3 susunan-card">
                        <div class="">
                    <div class="card card-produk border-0 shadow-sm text-center" style="width: 105px; height: 100%; padding: 5px;">
                        <a href="<?= base_url() ?>produk/${p.slug}" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/${p.img}" class="card-img-top text-center py-0 px-0 mx-0 my-0 im_produk_${p.id_produk}_" alt="..." style="width: 100px; height: 100px; object-fit: contain;">
                            </div>
                        </a>
                        <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                        <div class="d-flex align-items-start panjang-card justify-content-center" style="height: 90px;">
                            <p class="text-secondary fw-bold" style="font-size: 9px; margin: 0;">
                                ${p.nama.length > 70 ? p.nama.slice(0, 70) + '' : p.nama}
                            </p>
                        </div>
                            <h1 class="text-dark fw-bold mt-1 mb-1 fw-bold" style="font-size: 10px; margin: 0;">
                            ${hargaText}
                            </h1>

                            <div class="button-container" id="button-container-${p.id_produk}">
                                    <div class="button" onclick="changeToCapsule(${p.id_produk}, ${p.id_variasi_item})">
                                        <i class="icon bi bi-plus d-flex justify-content-center align-items-center"></i>
                                    </div>

                                    <div class="button-capsule" style="display: none;">
                                        <i class="icon bi bi-dash" onclick="decreaseValue(${p.id_produk}, ${p.id_variasi_item})"></i>
                                        <input type="number" class="input border-0" value="1" id="counter-${p.id_produk}">
                                        <i class="icon bi bi-plus" onclick="increaseValue(${p.id_produk}, ${p.id_variasi_item})"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                        // $("#cardLoader").remove()
                        productContainer.append(html);
                        // productContainer.append(cardLoader);
                    });
                    isLoading = false;
                },
                error: function(error) {
                    console.log(error);
                    isLoading = false;
                }
            });

        }
        if (isLoading == true) {
            $("#cardLoader").remove()
        }
    }

    // HIDUPKAN FUNCTION DI BAWAH INI UNTUK MENGAKTIFKAN FITUR MULTI BAHASA DAN HAPUS FUNCTION loadMoreData() DIATAS!!!
    // function loadMoreData() {
    //     if (!isLoading) {
    //         isLoading = true;
    //         page++;
    //         $.ajax({
    //             url: window.location,
    //             type: 'GET',
    //             data: {
    //                 produk: keyword,
    //                 page: page
    //             },
    //             success: function(data) {
    //                 data.forEach(function(p) {
    //                     var bahasa = <?php echo json_encode(session()->get('lang')); ?>;
    //                     var kolomNama, kolomNamaKat;
    //                     if (bahasa === 'id') {
    //                         kolomNama = 'nama';
    //                         kolomNamaKat = 'nama_kategori';
    //                     } else {
    //                         kolomNama = 'nama_' + bahasa;
    //                         kolomNamaKat = 'nama_kategori_' + bahasa;
    //                     }
    //                     var hargaText;
    //                     if (p.harga_min == p.harga_max) {
    //                         hargaText = "Rp. " + formatRupiah(p.harga_min);
    //                     } else {
    //                         hargaText = ("Rp. " + formatRupiah(p.harga_min) + "-" + formatRupiah(p.harga_max)).substring(0, 13) + "...";
    //                     }
    //                     var html = `<div class="col-4 col-md-2 col-lg-2 mb-3 susunan-card">
    //                     <div class="">
    //                 <div class="card card-produk border-0 shadow-sm text-center" style="width: 105px; height: 100%; padding: 5px;">
    //                     <a href="<?= base_url() ?>produk/${p.slug}" class="link-underline link-underline-opacity-0">
    //                         <div class="d-flex justify-content-center align-items-center">
    //                             <img src="<?= base_url() ?>assets/img/produk/main/${p.img}" class="card-img-top text-center py-0 px-0 mx-0 my-0 im_produk_${p.id_produk}_" alt="..." style="width: 100px; height: 100px; object-fit: contain;">
    //                         </div>
    //                     </a>
    //                     <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
    //                         <div class="d-flex align-items-start panjang-card justify-content-center" style="height: 90px;">

    //                             <p class=" text-secondary fw-bold" style="font-size: 9px; margin: 0;">
    //                                 ${p[kolomNama].length > 70 ? p[kolomNama].slice(0, 70) + '' : p[kolomNama]}
    //                             </p>

    //                         </div>

    //                         <h1 class="text-dark fw-bold mt-1 mb-1 fw-bold" style="font-size: 10px; margin: 0;">
    //                         ${hargaText}
    //                         </h1>

    //                         <div class="button-container" id="button-container-${p.id_produk}">
    //                                 <div class="button" onclick="changeToCapsule(${p.id_produk}, ${p.id_variasi_item})">
    //                                     <i class="icon bi bi-plus d-flex justify-content-center align-items-center"></i>
    //                                 </div>

    //                                 <div class="button-capsule" style="display: none;">
    //                                     <i class="icon bi bi-dash" onclick="decreaseValue(${p.id_produk}, ${p.id_variasi_item})"></i>
    //                                     <input type="number" class="input border-0" value="1" id="counter-${p.id_produk}">
    //                                     <i class="icon bi bi-plus" onclick="increaseValue(${p.id_produk}, ${p.id_variasi_item})"></i>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>`;
    //                     // $("#cardLoader").remove()
    //                     productContainer.append(html);
    //                     // productContainer.append(cardLoader);
    //                 });
    //                 isLoading = false;
    //             },
    //             error: function(error) {
    //                 console.log(error);
    //                 isLoading = false;
    //             }
    //         });

    //     }
    //     if (isLoading == true) {
    //         $("#cardLoader").remove()
    //     }
    // }

    // Tambahkan deteksi scroll untuk memanggil loadMoreData() saat mencapai akhir konten
    var canLoadMore = true;
    <?php if ($isMobile) : ?>
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && canLoadMore) {
                // Disable further loading temporarily
                canLoadMore = false;

                // Delay execution of loadMoreData by 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    loadMoreData();
                    // Re-enable loading after 5 seconds
                    canLoadMore = true;
                }, 1000);
            }
        });
    <?php else : ?>
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                loadMoreData();
            }
        });
    <?php endif; ?>

    function formatRupiah(angka) {
        var formatter = new Intl.NumberFormat('id-ID');
        return formatter.format(angka);
    }
</script>


<!-- style button counter -->
<style>
    .button-container {
        position: absolute;
        top: 5px;
        /* Jarak dari atas */
        left: 5px;
        /* Jarak dari kiri */
        display: flex;
        gap: 5px;
        /* Jarak antar tombol */
    }

    .button {
        width: 25px;
        /* Ukuran tombol yang lebih kecil */
        height: 25px;
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
        height: 25px;
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
        font-size: 14px;
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

    @media screen and (min-width: 400px) and (max-width: 450px) {
        .card-produk {
            width: 120px !important;
            /* Mengisi lebar parent container */
        }
    }

    @media screen and (min-width: 717px) and (max-width: 717px) {

        .susunan-card {
            flex: 0 0 100% !important;
            max-width: 30%;
        }

        .card-produk {
            width: 130px !important;
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

        #product-container {
            width: 100%;
            height: auto;
            margin-left: 4.5%;

        }

        #product-unggulan-container {
            width: 100%;
            height: auto;
            margin-left: 4.5%;

        }
    }

    @media screen and (min-width: 690px) and (max-width: 690px) {

        .susunan-card {
            flex: 0 0 100% !important;
            max-width: 30%;
        }

        .card-produk {
            width: 130px !important;
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

        #product-container {
            width: 100%;
            height: auto;
            margin-left: 4.5%;

        }

        #product-unggulan-container {
            width: 100%;
            height: auto;
            margin-left: 4.5%;

        }
    }

    /* samsung galfold dual mode screen 512 */
    @media screen and (min-width: 512px) and (max-width: 512px) {

        .susunan-card {
            flex: 0 0 100% !important;
            max-width: 30%;
        }

        .card-produk {
            width: 130px !important;
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


    }

    @media (max-width: 280px) {

        .susunan-card {
            flex: 0 0 100% !important;
            max-width: 50%;
        }

        .card-produk {
            width: 110px !important;
            /* Mengisi lebar parent container */
        }
    }

    @media (max-width: 344px) {

        .susunan-card {
            flex: 0 0 100% !important;
            max-width: 50%;
            left: 20px;
        }

        .card-produk {
            width: 144px !important;
            /* Mengisi lebar parent container */
        }
    }

    @media (min-width: 360px) and (max-width: 360px) {

        .card-produk {
            width: 100px !important;
            /* Mengisi lebar parent container */
        }

        .panjang-card {
            height: 75px !important;

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