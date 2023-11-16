<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Management Tambah Banner Homepage</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard/banner/list-banner" class="text-dark">Management Banner</a></li>
    <li class="breadcrumb-item active text-danger">Tambah Banner Homepage</li>
</ul>
<p class="mb-4">Anda dapat mengatur banner homepage yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
    <b>Note : perhatikan ukuran dan resolusi banner sebelum upload ke Aplikasi Ssayomart Supermarket</b>
</div>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6">
        <div class="card position-relative border-0 shadow-sm">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Masukan Banner Anda</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Masukan Banner</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted" style="font-size: 9px; margin-bottom: 20px;">perhatikan ukuran dan resolusi banner sebelum upload ke Aplikasi Ssayomart Supermarket.</small>

                        <label for="inputState mt-3">Pilih untuk menjadikan Banner pada urutan Ke-</label>
                        <select id="inputState" class="form-control">
                            <option selected>Klik untuk memilih...</option>
                            <option>...</option>
                        </select>
                    </div>

                </form>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
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
                        <tr>
                            <td>
                                Banner 1
                            </td>
                            <td>
                                <img src="<?= base_url() ?>assets/img/about/bg1.png" width="500px" height="300px" alt="" class="img-fluid">
                            </td>
                            <td class="text-center">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Update
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#">
                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                            <span class="text-danger">Delete</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- ================= START MODAL DELETE SINGLE GAMBAR ================== -->
                                <div class="modal fade" id="deleteBanner" tabindex="-1" role="dialog" aria-labelledby="deleteBanner" aria-hidden="true">
                                    <div class="modal-dialog text-start text-secondary" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteBanner">Delete</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="<?= base_url('assets/img/banner/'); ?>" class="img-fluid" alt="" width="300" height="500">
                                                <br><br>
                                                Pilih Delete untuk Menghapus Gambar?>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <form action="#">
                                                    <input type="hidden" name="pager" value="">
                                                    <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ================= END MODAL DELETE SINGLE PRODUK ================== -->
                            </td>
                        </tr>

                        <!-- Banner 2 -->

                        <tr>
                            <td>
                                Banner 2
                            </td>
                            <td>
                                <img src="<?= base_url() ?>assets/img/about/bg1.png" width="500px" height="300px" alt="" class="img-fluid">
                            </td>
                            <td class="text-center">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Update
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#">
                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                            <span class="text-danger">Delete</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- ================= START MODAL DELETE SINGLE GAMBAR ================== -->
                                <div class="modal fade" id="deleteBanner" tabindex="-1" role="dialog" aria-labelledby="deleteBanner" aria-hidden="true">
                                    <div class="modal-dialog text-start text-secondary" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteBanner">Delete</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="<?= base_url('assets/img/banner/'); ?>" class="img-fluid" alt="" width="300" height="500">
                                                <br><br>
                                                Pilih Delete untuk Menghapus Gambar?>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <form action="#">
                                                    <input type="hidden" name="pager" value="">
                                                    <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ================= END MODAL DELETE SINGLE PRODUK ================== -->
                            </td>
                        </tr>

                        <!-- banner 3 -->

                        <tr>
                            <td>
                                Banner 2
                            </td>
                            <td>
                                <img src="<?= base_url() ?>assets/img/about/bg1.png" width="500px" height="300px" alt="" class="img-fluid">
                            </td>
                            <td class="text-center">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Update
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#">
                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                            <span class="text-danger">Delete</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- ================= START MODAL DELETE SINGLE GAMBAR ================== -->
                                <div class="modal fade" id="deleteBanner" tabindex="-1" role="dialog" aria-labelledby="deleteBanner" aria-hidden="true">
                                    <div class="modal-dialog text-start text-secondary" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteBanner">Delete</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="<?= base_url('assets/img/banner/'); ?>" class="img-fluid" alt="" width="300" height="500">
                                                <br><br>
                                                Pilih Delete untuk Menghapus Gambar?>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <form action="#">
                                                    <input type="hidden" name="pager" value="">
                                                    <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ================= END MODAL DELETE SINGLE PRODUK ================== -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        new DataTable('#example');
    </script>
</div>



<?= $this->endSection(); ?>