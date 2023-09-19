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
            <div class="container d-md-none d-lg-none">
                <div class="row text-center">
                    <div class="col">
                        <div class="swiper btn-sub">
                            <div class="swiper-wrapper">
                                <?php foreach ($kategori as $k) : ?>
                                    <div class="swiper-slide mx-5">
                                        <a href="<?= base_url('produk/kategori/' . $k['slug']); ?>" class="btn border-0 btn-custom-rounded " style="width: 200px;">
                                            <?= $k['nama_kategori']; ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- tampilan mobile & ipad -->

    <!-- tampilan Desktop -->
    <div id="desktopContent" style="margin-top: 100px;">
        <div class="container-fluid d-none d-lg-block">
            <div class="mb-5">
                <div class="row">
                    <div class="col-2">
                        <div class="card-side" style="top: 50px; position: sticky">
                            <div class="card-body border-0">
                                <h3 class="mt-5">Kategori</h3>
                                <hr style="border-color: red; border-width: 3px;">
                                <ul class="list-group-flush">
                                    <?php foreach ($kategori as $k) : ?>
                                        <?php
                                        // Check if the current category has subcategories
                                        $hasSubcategories = count(array_filter($subKategori, function ($sub) use ($k) {
                                            return $sub['slugK'] == $k['slug'];
                                        })) > 0;
                                        ?>
                                        <li class="list-group-item pb-1 list-group-flush border-0">
                                            <?php if ($hasSubcategories) : ?>
                                                <!-- If category has subcategories, display a dropdown -->
                                                <a href="#" class="link-offset-2 link-underline link-underline-opacity-0 link-dark" data-bs-toggle="collapse" data-bs-target="#subcategories<?= $k['slug']; ?>">
                                                    <?= $k['nama_kategori']; ?>
                                                    <i class="bi bi-chevron-down fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                                </a>
                                                <div id="subcategories<?= $k['slug']; ?>" class="collapse">
                                                    <ul class="list-group-flush border-0">
                                                        <?php foreach ($subKategori as $sub) : ?>
                                                            <?php if ($sub['slugK'] == $k['slug']) : ?>
                                                                <a href="<?= base_url('produk/kategori/' . $k['slug'] . '/' . $sub['slugS']); ?>" class="link-dark list-group-item">
                                                                    <?= $sub['nama_kategori']; ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php else : ?>
                                        </li>
                                        <!-- If category doesn't have subcategories, display a regular link -->
                                        <li class="list-group-item pb-1 list-group-flush border-0">
                                            <a href="<?= base_url('produk/kategori/' . $k['slug']); ?>" class="link-offset-2 link-underline link-underline-opacity-0 link-dark list-group-item pb-3 fw-bold">
                                                <?= $k['nama_kategori']; ?>
                                                <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="card-body">
                            <h3 class="mt-5">Promo Special</h3>
                            <hr style="border-color: red; border-width: 3px;">
                        </div> -->
                    </div>
                    <div class="col-10">
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

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript (sesuaikan dengan versi yang Anda gunakan) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Inisialisasi komponen dropdown
    var dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
    var dropdownList = dropdownTriggerList.map(function(dropdownTriggerEl) {
        return new bootstrap.Dropdown(dropdownTriggerEl)
    });
</script>