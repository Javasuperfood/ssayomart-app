<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- All Kategori -->
<div class="container">
    <div class="card border-0 text-center font-family-poppins" style="background-color: #dcf7d0;">
        <div class="card-warning">
            <span class="card-title  fw-medium fs-3 text-capitalize" style="font-family: 'Noto Sans KR', sans-serif; color: #2e6e01;"><strong><?= lang('Text.kategori'); ?></strong></h2>
            </span>
        </div>
    </div>
    <div class="row text-center row-cols-3 mt-3">
        <?php foreach ($kategori as $k) : ?>
            <div class="col-4 col-md-4 col-lg-2">
                <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                    <div class="text-bg-light mb-3 bg-white border-0">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col pb-5">
        </div>
    </div>
</div>
<!-- All Kategori -->

<?= $this->endSection(); ?>