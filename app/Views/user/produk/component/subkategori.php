<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>
<!-- tampilan mobile & ipad -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-block d-lg-none">
            <!-- <div class="row text-center flex-nowrap">
                <div class="col-2 col-md-1 my-1 col-samsung-fold">
                    <div class="card mb-2 border-0 shadow-sm rounded-circle">
                        
                        <button type="button" class="btn d-flex align-items-center justify-content-center rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-list-check" style="margin-top: 2px;"></i>
                        </button>
                        
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h1 class="modal-title fs-6 text-secondary" id="exampleModalLabel">Sub Kategori</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php foreach ($subKategori as $s) : ?>
                                            <div class="swiper-slide my-3">
                                                <div class="card border-0 shadow-sm  text-uppercase d-flex justify-content-center" style="height: 25px; width:auto;">
                                                    <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="text-decoration-none" style="font-size:10px; color:#000;">
                                                        <?= $s['nama_kategori']; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="swiper buttonSwiper d-flex flex-wrap">
                        <div class="swiper-wrapper">
                            <?php foreach ($subKategori as $s) : ?>
                                <div class="swiper-slide my-3">
                                    <div class="card border-0 shadow-sm text-uppercase d-flex justify-items-center" style="height: 25px; width:auto;">
                                        <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="mt-1 text-decoration-none" style="font-size:10px; color:#000;">
                                            <?= $s['nama_kategori']; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="row text-center">
                <!-- Tombol Navigasi Kiri dan Kanan -->
                <div class="col position-relative my-3">
                    <div class="my-3 position-absolute start-0 translate-middle-y button-prev rounded-circle d-flex align-items-center" style="z-index: 2; width: 20px; height: 20px;">
                        <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button"><i class="bi bi-arrow-left"></i></button>
                    </div>
                    <div class="my-3 position-absolute end-0 translate-middle-y button-next rounded-circle d-flex align-items-center" style="z-index: 2; width: 20px; height: 20px;">
                        <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>

                    <!-- Button Kategori -->
                    <div class="col">
                        <div class="swiper btn-sub text-center" style="position: relative; z-index: 1;">
                            <div class="swiper-wrapper " style="height:40px">
                                <?php foreach ($subKategori as $s) : ?>
                                    <div class="swiper-slide my-1">
                                        <div class="card border-0 shadow-sm text-uppercase" style="width: auto;">
                                            <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="text-decoration-none custom-button btn" data-slug="<?= $s['slugS']; ?>" style="font-size: 10px; color: black; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" data-toggle="tooltip" data-placement="top" title="<?= $s['nama_kategori']; ?>">
                                                <?= $s['nama_kategori']; ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

    <script>
        const customButtons = document.querySelectorAll('.custom-button');

        customButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const slug = event.currentTarget.dataset.slug;
                // Simpan status tombol aktif di localStorage
                localStorage.setItem('activeButtonSlug', slug);
            });
        });

        // Cek jika ada tombol yang aktif disimpan di localStorage
        const activeButtonSlug = localStorage.getItem('activeButtonSlug');
        if (activeButtonSlug) {
            // Tambahkan kelas 'active' ke tombol yang sesuai dengan localStorage
            const activeButton = document.querySelector(`[data-slug="${activeButtonSlug}"]`);
            activeButton.classList.add('active');
        }
    </script>
<?php else : ?>
    <!-- Akhir tampilan mobile & ipad -->

    <!-- tampilan Destop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container d-md-none d-lg-none">
            <div class="row text-center">
                <div class="col">
                    <div class="swiper buttonSwiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($subKategori as $s) : ?>
                                <div class="swiper-slide mx-3">
                                    <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="btn border-0 btn-custom-rounded text-danger " style="width: 200px;">
                                        <?= $s['nama_kategori']; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>

<!-- tampilan Destop -->

<style>
    .custom-button {
        background-color: white;
        color: black;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .custom-button.active {
        background-color: #dc3545 !important;
        color: white !important;
    }
</style>