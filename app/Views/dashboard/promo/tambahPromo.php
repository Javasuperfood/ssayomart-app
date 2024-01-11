<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Promosi Ssayomart</h1>
<a href="<?= base_url() ?>dashboard/promo/tambah-promo-item-batch" class="btn btn-danger mb-4">Tambah Promo Produk</a>
<div class="row">
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
                        <input type="text" class="form-control border-0 shadow-sm  <?= (validation_show_error('title')) ? 'is-invalid' : 'border-1'; ?>" id="title" name="title" placeholder="Judul Promosi Anda..." value="<?= old('value') ?>">
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
                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-5">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-text-fill"></i>
                <h6 class="m-0 fw-bold px-2">List Promosi Ssayomart</h6>
            </div>
            <div class="card-body mt-2">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-4">Judul Promosi</th>
                            <th class="col-3">Waktu Mulai</th>
                            <th class="col-3">Waktu Berakhir</th>
                            <th class="col-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($promo as $p) : ?>
                            <tr>
                                <td class="align-middle"><?= $i++; ?></td>
                                <td class="align-middle"><?= $p['title']; ?></td>
                                <td class="align-middle"><?= strftime('%d %B %Y %H:%M', strtotime($p['start_at'])); ?></td>
                                <td class="align-middle"><?= strftime('%d %B %Y %H:%M', strtotime($p['end_at'])); ?></td>
                                <td class="text-center align-middle">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/promo/tambah-promo/show-promo/<?= $p['id_promo']; ?>">
                                                <i class="bi bi-eye fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Detail Promo
                                            </a>
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/promo/update-promo/<?= $p['id_promo']; ?>">
                                                <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update Promo
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="<?= base_url() ?>dashboard/promo/tambah-promo/delete-promo/<?= $p['id_promo']; ?>" id="" method="post">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="dropdown-item" onclick="clickSubmitEvent(this)">
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
</script>

<?= $this->endSection(); ?>