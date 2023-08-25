<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container pt-3">
    <div class="row row-cols-1">
        <div class="col">
            <ul class="list-group list-group-flush">
                <a href="<?= base_url() ?>setting/update-alamat" class="list-group-item pb-3">
                    <span class="fw-bold"><?= $label; ?></span>
                    <p class="card-text text-secondary"><?= substr($alamat, 0, 40); ?>...</p> <i class="bi bi-pencil-fill fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
            </ul>
        </div>
    </div>
    <a href="<?= base_url() ?>setting/create-alamat" class="btn btn-danger btn-lg rounded-circle bottom-0 end-0 mx-2 my-3 float-right position-fixed"><i class="bi bi-plus"></i></a>

</div>

<?= $this->endSection(); ?>