<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1">Promosi Ssayomart</h1>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Buat Promo</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/promo/tambah-promo/save" onsubmit="return validasiPromo()" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="value" class="form-label text-secondary">Judul Promosi <span class="text-danger">(Cth : Promo Lebaran, Promo Natal Promo Nyepi, dll)</span></label>
                        <input type="text" class="form-control border-0 shadow-sm" id="title" name="title" placeholder="Judul Promosi Anda..." value="<?= old('value') ?>">
                        <span id="titleError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label text-secondary">Slug</label>
                        <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                            <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Judul Promo.</b>
                        </div>
                        <input type="text" class="form-control border-0 shadow-sm" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= old('slug') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="started" class="form-label text-secondary">Waktu Mulai Promo</label>
                        <input type="datetime-local" class="form-control border-0 shadow-sm" name="started" id="started" value="<?= old('started') ?>">
                        <span id="startedError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="ended" class="form-label text-secondary">Waktu Berakhir Promo</label>
                        <input type="datetime-local" class="form-control border-0 shadow-sm" name="ended" id="ended" value="<?= old('ended') ?>">
                        <span id="endedError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label text-secondary">Deskripsi Promo (Optional)</label>
                        <input type="textarea" class="form-control border-0 shadow-sm" name="deskripsi" id="deskripsi" style="height: 100px;" value="<?= old('deskripsi') ?>">
                    </div>

                    <div class="mb-3">
                        <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                            <b>Dimensi foto harus berbentuk persegi! (Cth: 256px x 256px atau 512px x 512px)</b>
                        </div>
                        <label for="img" class="form-label text-secondary">Masukan Gambar/Foto/Icon Promo</label>
                        <input type="file" class="form-control border-0 shadow-sm" id="img" name="img" placeholder="Masukan Gambar Promosi">
                        <span id="imgError" class="text-danger"></span>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-3">
        <div class="card position-relative border-0 shadow-sm">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">List Promosi Ssayomart</h6>
            </div>
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col">Judul Promosi</th>
                            <th class="col" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($promo as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $p['title']; ?></td>
                                <td class="text-center">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/promo/update-promo/<?= $p['id_promo']; ?>">
                                                <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="<?= base_url() ?>dashboard/promo/tambah-promo/delete-promo/<?= $p['id_promo']; ?>" method="post">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                    <span class="text-danger">Hapus Promo</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <script>
        new DataTable('#example');
    </script> -->
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