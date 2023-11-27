<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);

$countProduk = count($produk);
?>
<script>
    var page = 1; // Halaman awal
    var isLoading = false;
    var keyword = '';
    const urlParams = new URLSearchParams(location.search);
    if (urlParams.has('produk')) {
        keyword = urlParams.get('produk');
    }
    var productContainer = $("#product-container");
    var cardLoader = `<div class="col-4 col-md-2 col-lg-2 mb-3 mx-0" id="cardLoader">
                <div class="card border-0 shadow-sm text-center" style="width: auto; height: 100%; padding:5px;">
                    <div class="d-flex justify-content-center align-items-center">
                        <svg class="bd-placeholder-img card-img-top text-center py-0 px-0 mx-0 my-0" width="100px" height="100px" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100px" height="100px" fill="#868e96"></rect>
                        </svg>
                    </div>
                    <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                    <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                    <p class=" text-secondary fw-bold" style="font-size: 10px; margin: 0;">
                        <span class="placeholder col-6"></span>
                    </p>
                    </div>
                    <p class=" text-secondary" style="font-size: 8px; margin: 0;">
                        <span class="placeholder col-6"></span>
                    </p>
 
                        <h1 class="text-danger fs-bold mt-1 mb-1" style="font-size: 11px; margin: 0;">
                            <span class="placeholder col-6"></span>
                        </h1>
                        
                        <div class="button-container">
                            <div class="button">
                                <i class="icon fas fa-plus d-flex justify-content-center align-items-center"></i>
                            </div>
 
                            <div class="button-capsule" style="display: none;">
                                <i class="icon fas fa-minus"></i>
                                <input type="number" class="input border-0" value="1">
                                <i class="icon fas fa-plus"></i>
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
                        var html = '<div class="col-4 col-md-2 col-lg-2 mb-3 mx-0">' +
                            '<div class="card border-0 shadow-sm text-center" style="width: auto; height: 100%; padding:5px;">' +
                            ` <a href="<?= base_url() ?>produk/${p.slug}" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/${p.img}" class="card-img-top text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 100px; height: 100px;">
                            </div>
                            </a>
                            <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                            <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                            <p class=" text-secondary fw-bold" style="font-size: 10px; margin: 0;">
                                ${p.nama.length > 25 ? p.nama.slice(0, 25) + '' : p.nama}
                            </p>
                            </div
                            <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                <del>Rp. ${formatRupiah(p.harga_min)}</del>
                            </p>
                                <h1 class="text-danger fs-bold mt-1 mb-1" style="font-size: 11px; margin: 0;">
                                   ${hargaText}
                                </h1>
                                
                                <div class="button-container" id="button-container-${p.id_produk}">
                                    <div class="button" onclick="changeToCapsule(${p.id_produk})">
                                        <i class="icon fas fa-plus d-flex justify-content-center align-items-center"></i>
                                    </div>

                                    <div class="button-capsule" style="display: none;">
                                        <i class="icon fas fa-minus" onclick="decreaseValue(${p.id_produk})"></i>
                                        <input type="number" class="input border-0" value="1" id="counter-${p.id_produk}">
                                        <i class="icon fas fa-plus" onclick="increaseValue(${p.id_produk})"></i>
                        </div>
                                </div>
                                

                                
                            </div>` +
                            '</div>' +
                            '</div>';
                        var html = `<div class="col-4 col-md-2 col-lg-2 mb-3 mx-0">
                    <div class="card border-0 shadow-sm text-center" style="width: auto; height: 100%; padding: 5px;">
                        <a href="<?= base_url() ?>produk/${p.slug}" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/${p.img}" class="card-img-top text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 100px; height: 100px;">
                            </div>
                        </a>
                        <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                        <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                        
                        <p class=" text-secondary fw-bold" style="font-size: 10px; margin: 0;">
                            ${p.nama.length > 25 ? p.nama.slice(0, 25) + '' : p.nama}
                        </p>
                        </div>
                        <p class="text-secondary" style="font-size: 8px; margin: 0;">
                            <del>Rp. ${formatRupiah(p.harga_min)}</del>
                        </p>
                            <h1 class="text-danger fs-bold mt-1 mb-1" style="font-size: 11px; margin: 0;">
                            ${hargaText}
                            </h1>

                            <div class="button-container" id="button-container-${p.id_produk}">
                                    <div class="button" onclick="changeToCapsule(${p.id_produk})">
                                        <i class="icon fas fa-plus d-flex justify-content-center align-items-center"></i>
                                    </div>

                                    <div class="button-capsule" style="display: none;">
                                        <i class="icon fas fa-minus" onclick="decreaseValue(${p.id_produk})"></i>
                                        <input type="number" class="input border-0" value="1" id="counter-${p.id_produk}">
                                        <i class="icon fas fa-plus" onclick="increaseValue(${p.id_produk})"></i>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>`
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
        width: 20px;
        /* Ukuran tombol yang lebih kecil */
        height: 20px;
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
        height: 20px;
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
        font-size: 8px;
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

<!-- Pagination counter -->
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