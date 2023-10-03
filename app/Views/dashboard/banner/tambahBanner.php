<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Management Banner</h1>
<hr />
<p class="mb-4">Anda dapat mengatur banner yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
    <b>Note : perhatikan ukuran dan resolusi banner sebelum upload ke Aplikasi Ssayomart Supermarket</b>
</div>

<div class="row">
    <!-- Left Panel -->
    <?= validation_list_errors() ?>
    <div class="col-lg-6">
        <div class="card position-relative border-0 shadow-sm">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Masukan Foto Banner Baru</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/banner/tambah-banner/save" method="post" enctype="multipart/form-data" onsubmit="return validasiTambahBanner()">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="banner">Judul Banner</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="title" name="title" rows="3" placeholder="Judul untuk banner Anda..." value="<?= old('title') ?>"></input>
                        <span id="bannerError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar Banner</label>
                        <input type="file" class="form-control border-0 shadow-sm" id="img" name="img" placeholder="Masukan Gambar" value="<?= old('img') ?>">
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
                <h6 class="m-0 font-weight-medium">List Banner</h6>
            </div>
            <div class="card-body">
                <table class="table text-center" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <tr>
                            <th>Judul Banner</th>
                            <th>Gambar Banner</th>
                            <th>Aksi</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banner_list as $bl) : ?>
                            <tr>
                                <td>
                                    <?= $bl['title']; ?>
                                </td>
                                <td>
                                    <img src="<?= base_url('assets/img/banner/' . $bl['img']); ?>" class="img-fluid" alt="" width="300" height="500">
                                </td>
                                <td class="text-center">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/banner/tambah-banner/update/<?= $bl['id_banner']; ?>">
                                                <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="<?= base_url() ?>dashboard/banner/tambah-banner/delete/<?= $bl['id_banner']; ?>" method="post">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                    <span class="text-danger">Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        new DataTable('#example');
    </script>
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
    function validasiTambahBanner() {
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