<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card">
    <div class="card-body d-flex align-items-center">
        <img src="<?= base_url() ?>assets/img/pic/1697074369_78d8729f7a629917714f.jpeg" class="rounded-circle" style="width: 60px; height: 60px; margin-right: 25px;">
        <div>
            <h5 class="card-title me-2">Adib Kurniawan</h5>
            <p class="card-text me-2">@adibkrniawan</p>
        </div>
    </div>
</div>


<div class="row d-flex justify-content-center my-4">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h5 class="mb-0">Isi Konten</h5>
            </div>
            <div class="card w-100" style="height: 635px;">
                <!-- Tidak ada konten di sini -->
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h5 class="mb-0">Gambar Thumbnail</h5>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="<?= base_url() ?>assets/img/pic/1697074369_78d8729f7a629917714f.jpeg" class="img-thumbnail" alt="Thumbnail Image" style="width: 400px;">
                </div>
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="card-text">
                                <h4>Judul</h4>
                            </div>
                            <div class="card-text">
                                <h5>Tanggal</h5>
                            </div>
                            <div class="card-text">
                                <h5>Slug</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>