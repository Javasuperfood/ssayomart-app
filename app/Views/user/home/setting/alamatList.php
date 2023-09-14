<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- view Mobile -->
<div class="container pt-3 d-md-none">
    <?php
    foreach ($alamat_user_model as $au) :
    ?>
        <div class="row row-cols-1">
            <div class="col">
                <ul class="list-group list-group-flush">
                    <div class="position-relative">
                        <a href="<?= base_url() ?>setting/update-alamat/<?= $au['id_alamat_users']; ?>" class="list-group-item pb-3 border-0">
                            <span class="fw-bold"><?= $au['label']; ?></span>
                            <p class="card-text text-secondary"><?= substr($au['alamat_1'], 0, 40); ?>...</p>
                        </a>
                        <form action="<?= base_url() ?>setting/delete-alamat/<?= $au['id_alamat_users']; ?>" method="post">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-danger"><i class="bi bi-trash-fill fs-4"></i></button>
                        </form>
                    </div>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
    <a href=" <?= base_url() ?>setting/create-alamat" class="btn btn-danger btn-lg rounded-circle bottom-0 end-0 mx-2 my-3 float-right position-fixed"><i class="bi bi-plus"></i></a>
</div>
<!-- End View Mobile -->
<!-- View Desktop -->
<div class="container pt-3 d-none d-md-block">
    <?php if (empty($alamat_user_model)) : ?>
        <!-- Tampilkan pesan jika pengguna tidak memiliki alamat -->
        <div class="alert alert-warning" role="alert">
            Anda belum memiliki alamat.
        </div>

        <!-- Tambahkan tombol "Tambah Alamat" di bawah pesan -->
    <?php else : ?>
        <?php foreach ($alamat_user_model as $au) : ?>
            <div class="row row-cols-1">
                <div class="col">
                    <ul class="list-group list-group-flush">
                        <div class="position-relative">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header border-0">
                                    <span class="fw-bold"><?= $au['label']; ?></span>
                                </div>
                                <div class="card-body">
                                    <a href="<?= base_url() ?>setting/update-alamat/<?= $au['id_alamat_users']; ?>" class="list-group-item pb-3 border-0">

                                        <p class="card-text text-secondary"><?= substr($au['alamat_1'], 0, 40); ?>...</p>
                                    </a>
                                    <form action="<?= base_url() ?>setting/delete-alamat/<?= $au['id_alamat_users']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-danger"><i class="bi bi-trash-fill fs-4"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
                    </ul>
                </div>
            </div>
</div>
<div class="text-center ">
    <a href="<?= base_url() ?>setting/create-alamat" class="btn btn-danger btn-lg">
        <i class="bi bi-plus">Tambahkan Alamat</i>
    </a>
</div>

</div>

<!-- End View Desktop -->

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