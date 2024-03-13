<?php

use CodeIgniter\Filters\CSRF;
?>
<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="d-flex">
    <!-- Left Panel -->
       <div class="col-lg-6 mb-5">
           <div class="card border-1 shadow-sm position-relative">
               <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                   <i class="bi bi-file-earmark-plus-fill"></i>
                   <h6 class="m-0 fw-bold px-2">Buat Promo</h6>
               </div>
               <div class="card-body">
                   <!-- code -->
                   <form action="<?= base_url(); ?>dashboard/promo/tambah-promo/save" method="post" enctype="multipart/form-data">
                       <?= csrf_field(); ?>
                       <div class="mb-4">
                           <label for="title" class="form-label">Judul Promosi <span class=" text-secondary">(Cth : Promo Lebaran, Promo Natal Promo Nyepi, dll)</span></label>
                           <input type="text" class="form-control border-0 shadow-sm  <?= (validation_show_error('title')) ? 'is-invalid' : 'border-1'; ?>" id="title" name="title" placeholder="Judul Promosi Anda..." value="<?= old('title') ?>">
                           <div class="invalid-feedback"><?= validation_show_error('title'); ?></div>
                       </div>
   
                       <div class="mb-4">
                           <label for="slug" class="form-label">Slug</label>
                           <div class="alert alert-danger text-center border-1 shadow-sm mb-4" role="alert">
                               <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Judul Promo.</b>
                           </div>
                           <input type="text" class="form-control border-0 shadow-sm" id="slug" placeholder="Masukkan Slug... (Boleh Kosong)" name="slug" value="<?= old('slug') ?>">
                       </div>
   
                       <div class="mb-4">
                           <label for="started" class="form-label">Waktu Mulai Promo</label>
                           <input type="datetime-local" class="form-control border-0 shadow-sm  <?= (validation_show_error('started')) ? 'is-invalid' : 'border-1'; ?>" name="started" id="started" value="<?= old('started') ?>">
                           <div class="invalid-feedback"><?= validation_show_error('started'); ?></div>
                       </div>
   
                       <div class="mb-4">
                           <label for="ended" class="form-label">Waktu Berakhir Promo</label>
                           <input type="datetime-local" class="form-control border-0 shadow-sm  <?= (validation_show_error('ended')) ? 'is-invalid' : 'border-1'; ?>" name="ended" id="ended" value="<?= old('ended') ?>">
                           <div class="invalid-feedback"><?= validation_show_error('ended'); ?></div>
                       </div>
   
                       <div class="mb-4">
                           <label for="deskripsi" class="form-label">Deskripsi Promo (Optional)</label>
                           <textarea class="form-control border-0 shadow-sm" id="deskripsi" name="deskripsi" placeholder="Deskripsi Promo Anda .." value="<?= old('deskripsi') ?>"></textarea>
                       </div>
   
                       <div class="mb-4">
                           <div class="alert alert-danger text-center border-1 shadow-sm" role="alert">
                               <b>Dimensi foto harus berbentuk persegi! (Cth: 256px x 256px atau 512px x 512px)</b>
                           </div>
                           <label for="img" class="form-label">Masukan Gambar/Foto/Icon Promo</label>
                           <input type="file" class="form-control border-0 shadow-sm  <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img" name="img" placeholder="Masukan Gambar Promosi">
                           <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                       </div>
                       <div class="mb-4">
                           <label for="img" class="form-label">Masukan Gambar/Foto/Icon Promo (Opsional)</label>
                               <input type="file" class="form-control border-0 shadow-sm  <?= (validation_show_error('img_2')) ? 'is-invalid' : 'border-1'; ?>" id="img_2" name="img_2">
                               <div class="invalid-feedback"><?= validation_show_error('img_2'); ?></div>
                           </div>
                       <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                       <div class="d-flex justify-content-end">
                           <button type="submit" class="btn btn-danger">Simpan</button>
                       </div>
                   </form>
               </div>
           </div>
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