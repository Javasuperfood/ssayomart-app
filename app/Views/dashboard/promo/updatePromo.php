<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-medium">Edit Promo</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/promo/tambah-promo/edit-promo/<?= $promo['id_promo']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validasiPromo()">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control border-0 shadow-sm" id="id_promo" name="id_promo" value="<?= $promo['id_promo'] ?>">
            <div class="mb-3">
                <label for="value" class="form-label text-secondary">Judul Promosi <span class="text-danger">(Cth : Promo Lebaran, Promo Natal Promo Nyepi, dll)</span></label>
                <input type="text" class="form-control border-0 shadow-sm" id="title" name="title" placeholder="Judul Promosi Anda..." value="<?= $promo['title']; ?>">
                <span id="titleError" class="text-danger"></span>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label text-secondary">Slug</label>
                <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                    <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Judul Promo.</b>
                </div>
                <input type="text" class="form-control border-0 shadow-sm" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= $promo['slug']; ?>">
            </div>

            <div class="mb-3">
                <label for="started" class="form-label">Waktu Mulai Promo</label>
                <input type="datetime-local" class="form-control border-0 shadow-sm" name="started" id="started" value="<?= $promo['start_at']; ?>">
                <span id="startedError" class="text-danger"></span>
            </div>

            <div class="mb-3">
                <label for="ended" class="form-label text-secondary">Waktu Berakhir Promo</label>
                <input type="datetime-local" class="form-control border-0 shadow-sm" name="ended" id="ended" value="<?= $promo['end_at']; ?>">
                <span id="endedError" class="text-danger"></span>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label text-secondary">Deskripsi Promo (Optional)</label>
                <input type="textarea" class="form-control border-0 shadow-sm" name="deskripsi" id="deskripsi" style="height: 100px;" value="<?= $promo['deskripsi']; ?>">
            </div>

            <div class="mb-3">
                <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                    <b>Dimensi foto harus berbentuk persegi! (Cth: 256px x 256px atau 512px x 512px)</b>
                </div>
                <label for="img" class="form-label">Gambar Promo</label>
                <input type="file" class="form-control border-0 shadow-sm" id="img" name="img" value="<?= $promo['img'] ?>">
                <input type="hidden" name="imageLama" value="<?= $promo['img']; ?>">
                <!-- <span id="imgError" class="text-danger"></span> -->
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
    function validasiPromo() {
        var isValid = true;

        var titleField = document.getElementById('title');
        var startedField = document.getElementById('started');
        var endedField = document.getElementById('ended');
        var imgField = document.getElementById('img');

        var titleError = document.getElementById('titleError');
        var startedError = document.getElementById('startedError');
        var endedError = document.getElementById('endedError');
        var imgError = document.getElementById('imgError');

        titleError.textContent = '';
        startedError.textContent = '';
        endedError.textContent = '';
        imgError.textContent = '';

        if (titleField.value.trim() === '') {
            titleField.classList.add('invalid-field');
            titleError.textContent = 'Judul promosi harus diisi';
            isValid = false;
        } else {
            titleField.classList.remove('invalid-field');
        }

        if (startedField.value.trim() === '') {
            startedField.classList.add('invalid-field');
            startedError.textContent = 'Waktu mulai promosi harus diisi';
            isValid = false;
        } else {
            startedField.classList.remove('invalid-field');
        }

        if (endedField.value.trim() === '') {
            endedField.classList.add('invalid-field');
            endedError.textContent = 'Waktu berakhir promosi harus diisi';
            isValid = false;
        } else {
            endedField.classList.remove('invalid-field');
        }

        if (imgField.value.trim() === '') {
            imgField.classList.add('invalid-field');
            imgError.textContent = 'Gambar atau Foto promosi harus diisi';
            isValid = false;
        } else {
            imgField.classList.remove('invalid-field');
        }

        return isValid;
    }
</script>
<?= $this->endSection(); ?>