<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- NAVBAR Mobile-->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container-fluid position-absolute top-0 start-50 translate-middle-x rounded-bottom-4" style="z-index: 2; background-color:aquamarine; height:23%;">

            <!-- alamat toko -->
            <div class="row row-cols-2 d-md-flex d-flex bg-white opacity-75 p-0 d-sm-flex justify-content-center align-items-center text-center mb-3">
                <?php if (auth()->loggedIn()) : ?>
                    <div class="col-6 d-flex justify-content-start align-items-start">
                        <a href="<?= base_url(); ?>setting/alamat-list" class="text-dark pt-2 link-underline link-underline-opacity-0 alamatt-list" style="font-size: 12px;"><?= $alamat ?? 'Pilih Alamat'; ?> <i class="bi bi-chevron-down"></i></a>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-end">
                        <a role="button" data-bs-toggle="modal" data-bs-target="#selectMarket" class="text-dark pt-2 link-underline link-underline-opacity-0 market-list" style="font-size: 12px;"><?= $marketSelected ?? 'Pilih Cabang'; ?> <i class="bi bi-chevron-down"></i></a>
                    </div>
                <?php else : ?>
                    <div class="col-12 text-center">
                        <a href="<?= base_url(); ?>login" class="text-dark pt-2 link-underline link-underline-opacity-0" style="font-size: 12px;">Login</a>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Modal Select Market -->
            <?php if (auth()->loggedIn()) : ?>
                <div class="modal fade" id="selectMarket" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-md-down">
                        <form class="modal-content" action="<?= base_url(); ?>setting/update-market" method="post">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <p class="fw-bold fs-5">Pilih Lokasi Market</p>
                                    </div>
                                </div>
                                <div class="row row-cols-1">
                                    <?php foreach ($market as $m) : ?>
                                        <div class="col py-2" onclick="selectMarket(<?= $m['id_toko']; ?>)">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="radio" role="switch" id="market<?= $m['id_toko']; ?>" name="market" value="<?= $m['id_toko']; ?>" <?= ($user['market_selected'] == $m['id_toko']) ? 'checked' : ''; ?>>
                                                    </div>
                                                    <p class="fw-bold">Ssayomart <?= $m['lable']; ?> <i class="fw-bold text-danger" id="marketSelected<?= $m['id_toko']; ?>"> <?= ($user['market_selected'] == $m['id_toko']) ? 'Selected' : ''; ?></i></p>
                                                    <p><?= $m['alamat_1']; ?></p>
                                                    <p><?= $m['telp']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-modal-marker" <?= (!$user['market_selected']) ? '' : 'data-bs-dismiss="modal"' ?>>Close</button>
                                <button type="submit" class="btn btn-danger"><?= (!$user['market_selected']) ? 'Simpan' : 'Update'; ?> Lokasi Market</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function selectMarket(i) {
                        $('#market' + i).prop('checked', true);
                    }

                    <?php if ($user && $user['market_selected']) : ?>
                        $(".close-modal-marker").click(function() {
                            $('#market<?= $user['market_selected']; ?>').prop('checked', true);
                        });
                    <?php endif; ?>
                </script>

                <script>
                    function selectMarket(i) {
                        $('#market' + i).prop('checked', true);
                    }
                    <?php if ($user['market_selected']) :  ?>
                        $(".close-modal-marker").click(function() {
                            $('#market' + <?= $user['market_selected']; ?>).prop('checked', true);
                        });
                    <?php endif ?>
                </script>
            <?php endif; ?>


            <!-- searchbar -->
            <div class="row align-items-center justify-content-center w-100">
                <div class="col-lg-8">
                    <form class="border-0 mt-lg-3" role="search" action="input" method="get">
                        <div class="input-group mb-3 d-flex align-items-center justify-content-center mx-4">
                            <button class="btn border-0 rounded-start-5 bg-white" type="button" id="basic-addon1"><i class="bi bi-search"></i></i></button>
                            <input type="text" class="form-control bg-white rounded-end-5" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
                            <div class="col-3 col-md-2" style="flex: 0 0 0 !important;">
                                <!-- bahasa -->
                                <?php
                                $lang = session()->get('lang');
                                $flag = ($lang == 'en') ? 'inggris.png' : (($lang == 'kr') ? 'korea.png' : 'indonesia.png');
                                ?>
                                <div class="dropdown">
                                    <button class="btn btn-transparent text-danger dropdown-toggle fs-6 border-0" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?= base_url() ?>assets/img/bahasa/<?= $flag; ?>" width="40px" alt="" class="flag-icon">
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-white border-0" style="background-color: transparent;" aria-labelledby="languageDropdown">
                                        <a href="<?= site_url('lang/id'); ?>" class="dropdown-item d-flex justify-content-end align-items-end <?= ($lang == 'id') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/indonesia.png" width="30px" alt="" class="flag-icon"></a>
                                        <a href="<?= site_url('lang/kr'); ?>" class="dropdown-item d-flex justify-content-end align-items-end <?= ($lang == 'kr') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/korea.png" width="30px" alt="" class="flag-icon"></a>
                                        <a href="<?= site_url('lang/en'); ?>" class="dropdown-item d-flex justify-content-end align-items-end<?= ($lang == 'en') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/inggris.png" width="30px" alt="" class="flag-icon"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>
    <!-- END OF NAVBAR -->

<?php endif; ?>