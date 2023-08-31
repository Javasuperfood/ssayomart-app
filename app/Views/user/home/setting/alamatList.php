<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<nav class="navbar pt-3">
    <div class="container-fluid">
        <div class="col text-center position-relative">
            <a href="<?= base_url(); ?>setting" class="
                position-absolute top-50 start-0 translate-middle-y"><i class=" bi bi-chevron-left navbar-brand"></i></a>
            <span class="navbar-brand"><?= $title; ?></span>
        </div>
    </div>
</nav>

<div class="container pt-3">
    <?php
    foreach ($alamat_user_model as $au) :
    ?>
        <div class="row row-cols-1">
            <div class="col">
                <ul class="list-group list-group-flush">
                    <a href="<?= base_url() ?>setting/update-alamat/<?= $au['id_alamat_users']; ?>" class="list-group-item pb-3">
                        <span class="fw-bold"><?= $au['label']; ?></span>
                        <p class="card-text text-secondary"><?= substr($au['alamat_1'], 0, 40); ?>...</p> <i class="bi bi-pencil-fill fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                    </a>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
    <a href="<?= base_url() ?>setting/create-alamat" class="btn btn-danger btn-lg rounded-circle bottom-0 end-0 mx-2 my-3 float-right position-fixed"><i class="bi bi-plus"></i></a>
</div>
<script>
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