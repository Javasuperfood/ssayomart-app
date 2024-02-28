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
            <div class="container-fluid d-md-block d-lg-none">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="border-0 mt-1 mx-auto" role="search" action="<?= base_url('search'); ?>" method="get">
                            <div class="input-group mb-3 w-100">
                                <button type="submit" class="input-group-text btn border-light-subtle border-white rounded-start-5 "><i class="bi bi-search"></i></button>
                                <input type="text" name="produk" class="form-control  rounded-end-5" placeholder="<?= lang('Text.cari_produk') ?>" aria-label="search" aria-describedby="basic-addon1">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- tampilan Desktop -->
    <div id="desktopContent">
        <div class="container-fluid ">
            <div class="mb-2">
                <div class="row">
                    <div class="col-3 kolom-kiri">
                        <div class="card-side card-samping">
                            <div class="card-body body-group">
                                <h3 class="p-1 rounded-top-3 fw-bold text-center" style="color: #9c2525; background-color: #facaaf; margin-top: 5px; margin-bottom: 5px;">Kategori</h3>
                                <hr style="border-color: #e36120; border-width: 3px; margin-top: 0; margin-bottom: 0;">
                                <ul class="list-group-flush list-kategori">
                                    <?php foreach ($kategori as $k) : ?>
                                        <li class="list-group-item list-peritem">
                                            <a href="<?= base_url('produk/kategori/' . $k['slug']); ?>" class="link-offset-2 link-underline link-underline-opacity-0 link-white list-group-item-link fw-bold" data-slug="<?= $k['slug'] ?>">
                                                <?= $k['nama_kategori']; ?>
                                                <i id="icon-<?= $k['slug'] ?>" class="bi bi-caret-right arrow-icon"></i>
                                            </a>
                                            <ul class="list-group-flush mx-1">
                                                <?php foreach ($subKategori as $sub) : ?>
                                                    <?php if ($sub['slugK'] == $k['slug']) : ?>
                                                        <li class="list-group-item">
                                                            <a href="<?= base_url('produk/kategori/' . $k['slug'] . '/' . $sub['slugS']); ?>" class="link-white list-group-item-link">
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
                    <div class="col-9 kolom-kanan-produk ">
                        <?= $this->include('user/produk/component/card') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- style Css Dekstop -->
    <style>
        #desktopContent {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .card-samping {
            position: sticky;
            top: 50px;
            height: fit-content;
        }

        .body-group {
            border: 0;
            padding: 0;

        }

        ul.list-kategori {
            padding: 0;
            margin: 0;

        }

        .list-peritem {
            border: 0;
            padding: 0;
            margin: 0;


        }

        .list-peritem a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 8px;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            border-bottom: 1px solid #e6e6e6;
            border-radius: 0;
            font-size: 13px;

        }

        .list-peritem a:hover {
            background-color: #ce2614;
            color: white;

            /* Add a subtle background color on hover */
        }

        .list-peritem a:hover .arrow-icon {
            transform: rotate(90deg);
        }

        /* Ikon panah di dalam tautan */
        .list-peritem-link .bi-caret-right {
            margin-left: auto;
            /* Menempatkan ikon di sebelah kanan tautan */
        }

        /* Ganti warna ikon panah pada hover */
        .list-peritem-link:hover .bi-caret-right {
            color: #fff;
            /* Warna ikon saat dihover */
        }


        .kolom-kiri {
            flex: 1;

        }

        .kolom-kanan-produk {
            flex: 3;

        }
    </style>
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


<script>
    // Inisialisasi komponen dropdown
    var dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
    var dropdownList = dropdownTriggerList.map(function(dropdownTriggerEl) {
        return new bootstrap.Dropdown(dropdownTriggerEl)
    });
</script>