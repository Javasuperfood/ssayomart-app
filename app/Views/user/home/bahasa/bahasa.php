<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<section class="bahasa">
    <div class="container d-md-block d-lg-none">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-group list-group-flush">
                    <a href="<?= base_url(); ?>setting/sayo-care" class="list-group-item py-3 fw-bold mb-2 d-flex align-items-center justify-content-between shadow-sm rounded-3">
                        <div class="d-flex align-items-center">
                            <img src="<?= base_url() ?>assets/img/bahasa/indonesia.png" class="rounded-circle me-3" width="50px" alt="Indonesia Flag">
                            <span class="text-secondary"> Bahasa</span>
                        </div>
                        <i class="bi bi-chevron-right fs-4"></i>
                    </a>
                    <a href="<?= base_url(); ?>setting/sayo-care" class="list-group-item py-3 fw-bold mb-2 d-flex align-items-center justify-content-between shadow-sm rounded-3">
                        <div class="d-flex align-items-center">
                            <img src="<?= base_url() ?>assets/img/bahasa/inggris.png" class="rounded-circle me-3" width="50px" alt="inggris Flag">
                            <span class="text-secondary"> English</span>
                        </div>
                        <i class="bi bi-chevron-right fs-4"></i>
                    </a>
                    <a href="<?= base_url(); ?>setting/sayo-care" class="list-group-item py-3 fw-bold mb-2 d-flex align-items-center justify-content-between shadow-sm rounded-3">
                        <div class="d-flex align-items-center">
                            <img src="<?= base_url() ?>assets/img/bahasa/korea.png" class="rounded-circle me-3" width="50px" alt="korea Flag">
                            <span class="text-secondary"> 한국어</span>
                        </div>
                        <i class="bi bi-chevron-right fs-4"></i>
                    </a>
                </ul>

            </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>