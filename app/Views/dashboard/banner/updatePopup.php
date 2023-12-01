<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-medium">Edit Pop Up</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/banner/update-pop-up/save-pop-up" method="POST" enctype="multipart/form-data" onsubmit="return validasiUpdateBanner()">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control border-0 shadow-sm" id="id_pop_up_banner" name="id_pop_up_banner" value="<?= $bl['id_pop_up_banner'] ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Pop Up</label>
                <input type="text" class="form-control <?= (validation_show_error('title')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="title" name="title" value="<?= $bl['title'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('title'); ?></div>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar Pop Up</label>
                <input type="file" class="form-control <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" value="<?= $bl['img'] ?>" accept="image/jpeg, image/png, image/jpg">
                <span id="imgError" class="text-danger"></span>
                <input type="hidden" name="imageLama" value="<?= $bl['img']; ?>">
                <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
            </div>
            <div>
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

    //Validasi Form
    function validasiUpdateBanner() {
        var isValid = true;

        var namaBannerField = document.getElementById('title');
        var imgField = document.getElementById('img');

        var namaBannerError = document.getElementById('bannerError');
        var imgError = document.getElementById('imgError');

        namaBannerError.textContent = '';
        imgError.textContent = '';

        if (namaBannerField.value.trim() === '') {
            namaBannerField.classList.add('invalid-field');
            namaBannerError.textContent = 'Judul banner harus diisi';
            isValid = false;
        } else {
            namaBannerField.classList.remove('invalid-field');
        }

        if (imgField.value.trim() === '') {
            imgField.classList.add('invalid-field');
            imgError.textContent = 'Gambar banner harus diisi';
            isValid = false;
        } else {
            imgField.classList.remove('invalid-field');
        }

        return isValid;
    }
</script>
<?= $this->endSection(); ?>