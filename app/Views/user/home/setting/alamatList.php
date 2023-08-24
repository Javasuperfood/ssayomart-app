<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container pt-3">
    <div class="row row-cols-1">
        <div class="col">
            <ul class="list-group list-group-flush">
                <a href="#" class="list-group-item pb-3">
                    <span class="fw-bold"><?= $nama; ?></span>
                    <p class="card-text text-secondary"><?= substr($alamat, 0, 40); ?>...</p> <i class="bi bi-pencil-fill fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>