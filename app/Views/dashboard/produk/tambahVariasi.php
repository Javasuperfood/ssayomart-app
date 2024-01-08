<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Variasi Produk</h1>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6">
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <h6 class="m-0 fw-bold px-2">Tambah Variasi Produk</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/produk/tambah-variasi/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="value" class="form-label">Nama Variasi <span class="text-secondary">(contoh : Rasa, dan lain-lain)</span></label>
                        <input type="text" class="form-control <?= (validation_show_error('nama_varian')) ? 'is-invalid' : 'border-1'; ?>" id="value" name="nama_varian" placeholder="Nama Variasi Produk Anda..." value="<?= old('value') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('nama_varian'); ?></div>
                    </div>
                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-3">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-text-fill"></i>
                <h6 class="m-0 fw-bold px-2">List Variasi Produk</h6>
            </div>
            <div class="card-body mt-2">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col">Variasi Produk</th>
                            <th class="col" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($variasi as $v) : ?>
                            <tr>
                                <td class="align-middle"><?= $i++; ?></td>
                                <td class="align-middle"><?= $v['nama_varian']; ?></td>
                                <td class="text-center align-middle">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/produk/tambah-variasi/update-variasi/<?= $v['id_variasi']; ?>">
                                                <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="<?= base_url() ?>dashboard/produk/tambah-variasi/delete-variasi/<?= $v['id_variasi']; ?>" method="post">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="dropdown-item" onclick="clickSubmitEvent(this)">
                                                    <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                    <span class="text-danger">Hapus Variasi</span>
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