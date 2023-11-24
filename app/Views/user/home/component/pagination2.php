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
                        <svg class="bd-placeholder-img card-img-top mt-1 text-center py-0 px-0 mx-0 my-0" width="100px" height="100px" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100px" height="100px" fill="#868e96"></rect>
                        </svg>
                    </div>
                    <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                    <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                    <p class=" text-secondary fw-bold" style="font-size: 11px; margin: 0;">
                        <span class="placeholder col-6"></span>
                    </p>
                    </div>
                    <p class=" text-secondary" style="font-size: 8px; margin: 0;">
                        <span class="placeholder col-6"></span>
                    </p>
 
                        <h1 class="text-danger fs-bold mt-1 mb-1" style="font-size: 11px; margin: 0;">
                            <span class="placeholder col-6"></span>
                        </h1>
                        
                        <div class="container mt-1 mb-2">
                            <div class="row justify-items-center">
                                <div class="col">
                                    <div class="horizontal-counter">
                                        <span class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-dash"></i></span>
                                        <input type="text" id="counter" class="form-control form-control-sm border-0 text-center text-secondary" value="0" readonly>
                                        <span class="btn btn-sm btn-outline-secondary rounded-circle" type="button"><i class="bi bi-plus"></i></span>
                                    </div>
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
                        var html = '<div class="col-4 col-md-2 col-lg-2 mb-3 mx-0">' +
                            '<div class="card border-0 shadow-sm text-center" style="width: auto; height: 100%; padding:5px;">' +
                            ` <a href="<?= base_url() ?>produk/${p.slug}" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/${p.img}" class="card-img-top mt-1 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 100px; height: 100px;">
                            </div>
                            </a>
                            <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                            <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                            <p class=" text-secondary fw-bold" style="font-size: 11px; margin: 0;">
                                ${p.nama.length > 40 ? p.nama.slice(0, 40) + '' : p.nama}
                            </p>
                            </div
                            <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                <del>Rp. ${formatRupiah(p.harga_min)}</del>
                            </p>
                                <h1 class="text-danger fs-bold mt-1 mb-1" style="font-size: 11px; margin: 0;">
                                   ${hargaText}
                                </h1>
                                

                                
                            </div>` +
                            '</div>' +
                            '</div>';
                        var html = `<div class="col-4 col-md-2 col-lg-2 mb-3 mx-0">
                    <div class="card border-0 shadow-sm text-center" style="width: auto; height: 100%; padding: 5px;">
                        <a href="<?= base_url() ?>produk/${p.slug}" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/${p.img}" class="card-img-top mt-1 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 100px; height: 100px;">
                            </div>
                        </a>
                        <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                        <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                        
                        <p class=" text-secondary fw-bold" style="font-size: 11px; margin: 0;">
                            ${p.nama.length > 40 ? p.nama.slice(0, 40) + '' : p.nama}
                        </p>
                        </div>
                        <p class="text-secondary" style="font-size: 8px; margin: 0;">
                            <del>Rp. ${formatRupiah(p.harga_min)}</del>
                        </p>
                            <h1 class="text-danger fs-bold mt-1 mb-1" style="font-size: 11px; margin: 0;">
                            ${hargaText}
                            </h1>
                            <div class="container mt-1 mb-2">
                                <div class="row justify-items-center">
                                    <div class="col">
                                        <div class="horizontal-counter">
                                            <button class="btn btn-sm btn-outline-danger rounded-circle" type="button" onclick="decreaseCount(this, ${p.id_produk})"><i class="bi bi-dash"></i></button>
                                            <input type="text" id="counter" class="form-control form-control-sm border-0 text-center bg-white" value="1" readonly>
                                            <button class="btn btn-sm btn-outline-danger rounded-circle" type="button" onclick="increaseCount(this, ${p.id_produk})"><i class="bi bi-plus"></i></button>
                                        </div>
                                    </div>
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

<style>
    .border-darker {
        border-color: red;
        border-width: 2px;
        font-weight: bold;
    }

    .horizontal-counter {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .horizontal-counter .btn {
        padding: 0.10rem 0.2rem;
        font-size: 10px;
    }

    .horizontal-counter input {
        font-size: 10px;
        width: 33px;
        text-align: center;
    }
</style>

<style>
    @media screen and (min-width: 717px) and (max-width: 717px) {

        .col-lg-2,
        .col-md-2,
        .col-4 {
            flex: 0 0 100% !important;
            max-width: 25%;
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

        #product-container.row.row-cols-3 {
            width: 100%;
            height: auto;
            margin-left: 1%;

        }

        #product-unggulan-container.row.row-cols-3 {
            width: 100%;
            height: auto;
            margin-left: 1%;

        }
    }

    @media (max-width: 280px) {

        .col-lg-2,
        .col-md-2,
        .col-6 {
            flex: 0 0 100% !important;
            max-width: 50%;
        }
    }
</style>