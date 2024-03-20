<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Edit Promo</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item"><a class="text-danger" href="<?= base_url(); ?>dashboard/promo">List Promo</a></li>
    <li class="breadcrumb-item text-danger active text-decoration-underline">Edit Promo</li>
</ul>

<div class="card border-1 shadow-sm position-relative mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-pencil-square fs-5 text-danger"></i>
        <h6 class="m-0 fw-bold px-2 text-dark">Edit Promo</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url(); ?>dashboard/promo/update-promo/edit-promo/<?= $promo['id_promo']; ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_promo" value="<?= $promo['id_promo'] ?>">
            <div class="mb-4">
                <label for="title" class="form-label">Judul Promosi <span class="text-secondary">(Cth : Promo Lebaran, Promo Natal Promo Nyepi, dll)</span></label>
                <input type="text" class="form-control border-0 shadow-sm  <?= (validation_show_error('title')) ? 'is-invalid' : 'border-1'; ?>" id="title" name="title" placeholder="Judul Promosi Anda..." value="<?= $promo['title']; ?>">
                <div class="invalid-feedback"><?= validation_show_error('title'); ?></div>
            </div>

            <div class="mb-4">
                <label for="slug" class="form-label">Slug</label>
                <div class="alert alert-danger text-center border-1 shadow-sm mb-4" role="alert">
                    <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Judul Promo.</b>
                </div>
                <input type="text" class="form-control border-0 shadow-sm" placeholder="Masukan nama slug" name="slug">
            </div>

            <div class="mb-4">
                <label for="started" class="form-label">Waktu Mulai Promo</label>
                <input type="datetime-local" class="form-control border-0 shadow-sm  <?= (validation_show_error('started')) ? 'is-invalid' : 'border-1'; ?>" name="started" value="<?= $promo['start_at']; ?>">
                <div class="invalid-feedback"><?= validation_show_error('started'); ?></div>
            </div>

            <div class="mb-4">
                <label for="ended" class="form-label">Waktu Berakhir Promo</label>
                <input type="datetime-local" class="form-control border-0 shadow-sm <?= (validation_show_error('ended')) ? 'is-invalid' : 'border-1'; ?>" name="ended" value="<?= $promo['end_at']; ?>">
                <div class="invalid-feedback"><?= validation_show_error('ended'); ?></div>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi Promo (Optional)</label>
                <input type="textarea" class="form-control border-0 shadow-sm" name="deskripsi" style="height: 100px;" value="<?= $promo['deskripsi']; ?>">
            </div>

            <div class="mb-4">
                <div class="alert alert-danger text-center border-1 shadow-sm" role="alert">
                    <b>Dimensi foto harus berbentuk persegi! (Cth: 256px x 256px atau 512px x 512px)</b>
                </div>
                <label for="img" class="form-label">Gambar Promo</label>
                <input type="file" class="form-control border-0 shadow-sm <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" name="img" value="<?= $promo['img'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                <input type="hidden" name="imageLama" value="<?= $promo['img']; ?>">
            </div>

            <div class="mb-4">
                <label for="img_2" class="form-label">Gambar Promo (Opsional)</label>
                <input type="file" class="form-control border-0 shadow-sm <?= (validation_show_error('img_2')) ? 'is-invalid' : 'border-1'; ?>" name="img_2" value="<?= $promo['img_2'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('img_2'); ?></div>
                <input type="hidden" name="imageLama2" value="<?= $promo['img_2']; ?>">
            </div>

            <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
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