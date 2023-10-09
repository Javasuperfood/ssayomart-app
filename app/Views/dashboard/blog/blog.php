<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Manajemen Blog Ssayomart</h1>
<p class="mb-4">Anda dapat mengatur informasi, produk, resep, dan media yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.</p>

<div class="alert alert-danger text-center border-0 shadow-sm mb-4" role="alert">
    <b>MOHON CEK KEMBALI KONTEN YANG ANDA MASUKAN!</b>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">Konten Blog Site</h6>
    </div>
    <div class="card-body ">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Judul Blog</th>
                        <th>Tanggal di buat</th>
                        <th>Gambar Thumbnail</th>
                        <th>Gambar Blog 1</th>
                        <th>Deskripsi Blog 1</th>
                        <th>Gambar blog 2</th>
                        <th>Deskripsi Blog 2</th>
                        <th>Gambar Blog 3</th>
                        <th>Deskripsi Blog 2</th>
                        <th>Slug</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>contoh judul blog</td>
                        <td>24/24/2024</td>
                        <td><img src="<?= base_url() ?>assets/img/promo/promo-2.png" alt="Generic placeholder image" class="img-fluid" style="width: 150px; border-radius: 10px;"></td>
                        <td><img src="<?= base_url() ?>assets/img/produk\main/default.png" alt="Generic placeholder image" class="img-fluid" style="width: 150px; border-radius: 10px;"></td>
                        <td width="200">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae unde, sequi vel repellendus labore officia est aperiam non mollitia explicabo.</td>
                        <td><img src="<?= base_url() ?>assets/img/produk\main/default.png" alt="Generic placeholder image" class="img-fluid" style="width: 150px; border-radius: 10px;"></td>
                        <td width="200">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae unde, sequi vel repellendus labore officia est aperiam non mollitia explicabo.</td>
                        <td><img src="<?= base_url() ?>assets/img/produk\main/default.png" alt="Generic placeholder image" class="img-fluid" style="width: 150px; border-radius: 10px;"></td>
                        <td width="200">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae unde, sequi vel repellendus labore officia est aperiam non mollitia explicabo.</td>
                        <td>contoh-judul-blog</td>
                        <td class="text-center">
                            <div class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="">
                                        <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Lihat Konten
                                    </a>
                                    <a class="dropdown-item" href="">
                                        <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Detail Konten
                                    </a>
                                    <a class="dropdown-item" href="">
                                        <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Update
                                    </a>
                                    <div class="dropdown-divider"></div>
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
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>