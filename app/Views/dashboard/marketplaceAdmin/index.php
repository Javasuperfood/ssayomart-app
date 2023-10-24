<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6">
        <div class="card position-relative border-0 shadow-sm">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Masukan Masukan Admin</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('dashboard/admin-market/save'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="banner">Market</label>
                            <select class="form-select shadow-sm <?= (validation_show_error('id_toko')) ? 'is-invalid' : 'border-0'; ?>" aria-label="Default select example" name="market">
                                <option value="" selected>Pilih Market</option>
                                <?php foreach ($market as $m) : ?>
                                    <option value="<?= $m['id_toko']; ?>" <?= (old('market') == $m['id_toko']) ? 'selected' : ''; ?>>Ssayomart <?= $m['city']; ?> - <?= $m['zip_code']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback"><?= validation_show_error('id_toko'); ?></div>
                        </div>
                        <div class="col-md-6">
                            <label for="banner">Admin</label>
                            <select class="form-select shadow-sm <?= (validation_show_error('id_user')) ? 'is-invalid' : 'border-0'; ?>" aria-label="Default select example" name="admin">
                                <option value="" selected>Pilih Admin</option>
                                <?php foreach ($users as $u) : ?>
                                    <option value="<?= $u['id']; ?>" <?= (old('admin') == $u['id']) ? 'selected' : ''; ?>><?= $u['username']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback"><?= validation_show_error('id_user'); ?></div>
                        </div>
                    </div>

                    <div class="pt-3">
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
                <h6 class="m-0 font-weight-medium">List Admin</h6>
            </div>
            <div class="card-body">
                <table class="table text-center" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Market(Cabang)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 0;
                        foreach ($users as $u) : ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td>
                                    <?= $u['username']; ?>
                                </td>
                                <td>
                                    <?= $u['group']; ?>
                                </td>
                                <td>
                                    <?php foreach ($marketAdmin as $m) : ?>
                                        <?php if ($m['id_user'] == $u['id']) : ?>
                                            <?= $m['city'] . ' - ' . $m['zip_code']; ?><br>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </td>
                                <td class="text-center">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/banner/update-banner/">
                                                <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteBanner">
                                                <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                <span class="text-danger">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- ================= START MODAL DELETE SINGLE PRODUK ================== -->
                                    <div class="modal fade" id="deleteBanner" tabindex="-1" role="dialog" aria-labelledby="deleteBanner" aria-hidden="true">
                                        <div class="modal-dialog text-start text-secondary" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteBanner">Delete ?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <br><br>
                                                    Pilih Delete untuk Menghapus Produk
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <form action="<?= base_url() ?>dashboard/banner/tambah-banner/delete/" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="pager" value="<?= (isset($_GET['page_produk']) ? $_GET['page_produk'] : '1'); ?>">
                                                        <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ================= END MODAL DELETE SINGLE PRODUK ================== -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
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