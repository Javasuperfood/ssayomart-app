<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
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
    var cardLoader = `<div class="col-6 col-md-4 col-lg-3 pt-3" id="cardLoader">
                <div class="card border-0 shadow-sm" style="width: auto; height: 100%;">
                    <div class="d-flex justify-content-center align-items-center pb-4">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                        </svg>
                    </div>
                    <div class="fs-3 mt-3" style="padding: 0 10px 0 10px;">
                        <h1 class="text-secondary" style="font-size: 15px;">
                            <span class="placeholder col-6"></span>
                        </h1>
                        <p class=" text-secondary" style="font-size: 14px;"><span class="placeholder col-7"></span></p>
                        <div class="container pt-3">
                            <div class="row justify-items-center">
                                <div class="col">
                                    <div class="horizontal-counter">
                                        <span class="btn btn-sm btn-outline-secondary"><i class="bi bi-dash"></i></span>
                                        <input type="text" id="counter" class="form-control form-control-sm border-0 text-center text-secondary" value="0" readonly>
                                        <span class="btn btn-sm btn-outline-secondary" type="button"><i class="bi bi-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center custom-button pb-3" style="display: flex; justify-content: center;">
                            <span type="submit" class="btn btn-secondary mx-1 mt-4 fw-bold">
                                <i class="fas fa-shopping-cart text-white fa-lg"></i>
                            </span>
                            <span type="submit" class="btn btn-secondary mx-1 mt-4 fw-bold">
                                Beli
                            </span>
                        </div>
                    </div>
                </div>
            </div>`
    productContainer.append(cardLoader);

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
                        var html = '<div class="col-6 col-md-4 col-lg-2 pt-3">' +
                            '<div class="card border-0 shadow-sm" style="width: auto; height: 100%;">' +
                            ` <a href="<?= base_url() ?>produk/${p.slug}" class="link-underline link-underline-opacity-0">
                                <img src="<?= base_url() ?>assets/img/produk/main/${p.img}" class="card-img-top mt-3" alt="...">
                            </a>
                            <div class="fs-3 mt-3" style="padding: 0 10px 0 10px;">
                                <h1 class="text-secondary" style="font-size: 15px;">
                                   ${hargaText}
                                </h1>
                                <p class=" text-secondary" style="font-size: 14px;"><?= substr('${p.nama}', 0, 15); ?>...</p>
                                <p class=" text-center">
                                    <a href="<?= base_url('produk/'); ?>${p.slug}?add-to-cart=show" class="btn btn-white"> <i class=" fas fa-shopping-cart text-danger fa-lg"></i></a>
                                </p>
                            </div>` +
                            '</div>' +
                            '</div>';
                        var html = `<div class="col-6 col-md-4 col-lg-3 pt-3">
                    <div class="card border-0 shadow-sm" style="width: auto; height: 100%;">
                        <a href="<?= base_url() ?>produk/${p.slug}" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/${p.img}" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 200px; height: 200px;">
                            </div>
                        </a>
                        <div class="fs-3 mt-3" style="padding: 0 10px 0 10px;">
                            <h1 class="text-secondary" style="font-size: 15px;">
                            ${hargaText}
                            </h1>
                            <p class=" text-secondary" style="font-size: 14px;"><?= substr('${p.nama}', 0, 15); ?>...</p>
                            <div class="container pt-3">
                                <div class="row justify-items-center">
                                    <div class="col">
                                        <div class="horizontal-counter">
                                            <button class="btn btn-sm btn-outline-danger" type="button" onclick="decreaseCount(this, ${p.id_produk})"><i class="bi bi-dash"></i></button>
                                            <input type="text" id="counter" class="form-control form-control-sm border-0 text-center" value="1" readonly>
                                            <button class="btn btn-sm btn-outline-danger" type="button" onclick="increaseCount(this, ${p.id_produk})"><i class="bi bi-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center custom-button pb-3" style="display: flex; justify-content: center;">
                                <form action="<?= base_url('produk/'); ?>${p.slug}">
                                    <input type="hidden" name="add-to-cart" value="show">
                                    <input type="hidden" name="qty" id="Cqty${p.id_produk}" value="1" value="show">
                                    <button type="submit" class="btn btn-danger mx-1 mt-4 fw-bold">
                                        <i class="fas fa-shopping-cart text-white fa-lg"></i>
                                    </button>
                                </form>
                                <form action="<?= base_url('produk/'); ?>${p.slug}">
                                    <input type="hidden" name="buy" value="show">
                                    <input type="hidden" name="qty" id="Bqty${p.id_produk}" value="1" value="show">
                                    <button type="submit" class="btn btn-danger mx-1 mt-4 fw-bold">
                                        Beli
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>`
                        $("#cardLoader").remove()
                        productContainer.append(html);
                        productContainer.append(cardLoader);
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