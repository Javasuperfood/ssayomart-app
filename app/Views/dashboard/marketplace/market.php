<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<!-- DataTales Example -->
<?php if ($toko) : ?>
    <div class="card border-0 mb-4">
        <div class="card-header border-0 py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-danger">Detail Profil Marketplace</h5>
            <a class="btn btn-outline-danger" href="<?= base_url() ?>dashboard/marketplace/edit/<?= $toko['id_toko'] ?>"><i class="bi bi-pencil-square"></i> Edit Profil Marketplace</a>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        ID Market</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= $toko['id_toko']; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-postcard-fill fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Latitude & Longitude</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a class="link-secondary" href="http://maps.google.com/?q=<?= $toko['latitude'] . ', ' . $toko['longitude']; ?>" target="_blank"><?= $toko['latitude'] . ', ' . $toko['longitude']; ?></a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-geo-alt-fill fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card border-0 mb-4 bg-light ">
                        <!-- Card Header - Accordion -->
                        <a href="#alamat" class="d-block card-header shadow-sm bg-white border-0 py-3 rounded-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="alamat">
                            <h6 class="m-0 font-weight-bold text-danger">Detail Alamat Marketplace</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="alamat">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Deskripsi Marketplace</div>
                                                        <span class="fs-5 mb-0 pb-0 font-weight-bold text-gray-800">
                                                            <?= $toko['deskripsi']; ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="bi bi-card-text fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Nomor Telpon Market</div>
                                                        <span class="fs-5 mb-0 pb-0 font-weight-bold text-gray-800">
                                                            <?= $toko['telp']; ?> (Utama)
                                                        </span>
                                                        <span class="fs-6 mt-0 pt-0 font-weight-bold text-gray-800">
                                                            <?= ($toko['telp2']) ? $toko['telp2'] : ''; ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="bi bi-telephone-fill fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Provinsi Market</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?= $toko['province']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="bi bi-buildings-fill fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Kabupaten Market</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?= $toko['city']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="bi bi-building fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Kode Pos Market</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?= $toko['zip_code']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="bi bi-mailbox2 fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Detail Alamat Market</div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                            <?= substr($toko['alamat_1'], 0, 40); ?>...
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="bi bi-map-fill fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Patokan Alamat Market</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php if ($toko['alamat_2']) : ?>
                                                                <p><?= substr($toko['alamat_2'], 0, 15); ?>...</p>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="bi bi-geo-alt-fill fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php
    header('Location:' . base_url('dashboard/marketplace/create'));
    exit; ?>
<?php endif ?>

<script>
    // SWAL
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('alert')) : ?>
            var alertData = <?= json_encode(session('alert')) ?>;
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                text: alertData.message
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection(); ?>