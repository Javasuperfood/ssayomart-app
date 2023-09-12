<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container pt-3">
    <?php foreach ($kupon_model as $km) : ?>
        <div class="row row-cols-1">
            <div class="col pb-3">
                <ul class="list-group list-group-flush">
                    <div class="position-relative">
                        <div class="card mb-5 border-0 shadow-sm">
                            <div class="card-body border-0">
                                <span class="list-group-item border-0 fs-6">
                                    <p class="fs-5"><?= $km['nama']; ?></p>
                                    <p class="text-secondary fs-6"><?= $km['kode']; ?></p>
                                    <p class="text-secondary fs-6">Kupon Tersedia : <?= $km['available_kupon']; ?></p>
                                </span>
                            </div>
                            <div class="card-footer bg-light border-0 shadow-sm text-body-secondary d-flex justify-content-center">
                                <a href="<?= base_url() ?>promo/diskon-mingguan" class="btn btn-white btn-outline-danger">Belanja Sekarang</a>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    <?php endforeach ?>
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