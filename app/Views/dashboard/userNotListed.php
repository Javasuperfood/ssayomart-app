<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="row">
    <div class="col">
        <p class="text-center fw-bold text-danger">
            Anda tidak memiliki akses.
        </p>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        ID User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= user_id(); ?>
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

<?= $this->endSection(); ?>