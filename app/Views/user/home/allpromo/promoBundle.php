<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container">
    <?php foreach ($promo as $p) : ?>
        <div class="card mb-4 shadow-sm border-0">
            <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>" class="text-decoration-none">
                <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title fw-bold m-0 text-decoration-none text-dark"><?= $p['title']; ?></h5>
                    <p class="card-text text-dark"><?= $p['deskripsi']; ?></p>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
</div>

<?= $this->endSection(); ?>