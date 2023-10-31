<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- tampilan mobile & ipad -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="mt-2">
            <div class="container d-md-block d-lg-none">
                <!-- <div class="row text-center">
                    
                    <div class="col position-relative my-3">
                        <div class="my-3 position-absolute start-0 translate-middle-y button-prev rounded-circle d-flex align-items-center" style="z-index: 2; width: 20px; height: 20px;">
                            <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button"><i class="bi bi-arrow-left"></i></button>
                        </div>
                        <div class="my-3 position-absolute end-0 translate-middle-y button-next rounded-circle d-flex align-items-center" style="z-index: 2; width: 20px; height: 20px;">
                            <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>

                        
                        <div class="col">
                            <div class="swiper btn-sub text-center" style="position: relative; z-index: 1;">
                                <div class="swiper-wrapper">
                                    <?php foreach ($kategori as $k) : ?>
                                        <div class="swiper-slide mb-2">
                                            <div class="card border-0 shadow-sm text-uppercase mx-auto d-flex justify-content-center" style="height: 30px;">
                                                <a href="<?= base_url('produk/kategori/' . $k['slug']); ?>" class="my-1 text-decoration-none" style="font-size:8px; color:#000;">
                                                    <?= $k['nama_kategori']; ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>





                    </div>
                </div> -->
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- tampilan Desktop -->
    <div id="desktopContent">
        <div class="container-fluid d-none d-lg-block">
            <div class="mb-2">
                <div class="row">
                    <div class="col-3">
                        <div class="card-side">
                            <div class="card-body">
                                <h3>Kategori</h3>
                                <hr>
                                <ul class="list-group-flush">
                                    <?php foreach ($kategori as $k) : ?>
                                        <li class="list-group-item">
                                            <a href="<?= base_url('produk/kategori/' . $k['slug']); ?>" class="link-offset-2 link-underline link-underline-opacity-0 link-white list-group-item-link fw-bold" data-slug="<?= $k['slug'] ?>">
                                                <?= $k['nama_kategori']; ?>
                                                <i id="icon-<?= $k['slug'] ?>" class="bi bi-caret-right arrow-icon"></i>
                                            </a>
                                            <ul class="list-group-flush">
                                                <?php foreach ($subKategori as $sub) : ?>
                                                    <?php if ($sub['slugK'] == $k['slug']) : ?>
                                                        <li class="list-group-item">
                                                            <a href="<?= base_url('produk/kategori/' . $k['slug'] . '/' . $sub['slugS']); ?>" class="link-dark list-group-item-link">
                                                                <?= $sub['nama_kategori']; ?>
                                                            </a>
                                                        </li>
                                                <?php endif;
                                                endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <?= $this->include('user/produk/component/card') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endif; ?>
<!-- tampilan Desktop -->


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
    #desktopContent {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }

    .card-side {
        position: sticky;
        top: 50px;
        height: fit-content;
    }

    .card-body {
        border: 0;
        padding: 0;

    }

    h3 {
        margin-top: 5px;
        margin-bottom: 5px;

    }

    hr {
        border-color: red;
        border-width: 3px;
        margin-top: 0;
        margin-bottom: 0;

    }

    ul.list-group-flush {
        padding: 0;
        margin: 0;

    }

    .list-group-item {
        border: 0;
        padding: 0;
        margin: 0;


    }

    .list-group-item a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        text-decoration: none;
        color: #333;
        background-color: #fff;
        border-bottom: 1px solid #e6e6e6;
        border-radius: 0;
        transition: all 0.3s ease;

        /* Customize the color */
    }

    .list-group-item a:hover {
        background-color: #ce2614;
        color: white;

        /* Add a subtle background color on hover */
    }

    .list-group-item a:hover .arrow-icon {
        transform: rotate(180deg);
    }

    /* Ikon panah di dalam tautan */
    .list-group-item-link .bi-caret-right {
        margin-left: auto;
        /* Menempatkan ikon di sebelah kanan tautan */
    }

    /* Ganti warna ikon panah pada hover */
    .list-group-item-link:hover .bi-caret-right {
        color: #fff;
        /* Warna ikon saat dihover */
    }


    .col-3 {
        flex: 1;

    }

    .col-9 {
        flex: 3;

    }
</style>


<script>
    // Inisialisasi komponen dropdown
    var dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
    var dropdownList = dropdownTriggerList.map(function(dropdownTriggerEl) {
        return new bootstrap.Dropdown(dropdownTriggerEl)
    });
</script>