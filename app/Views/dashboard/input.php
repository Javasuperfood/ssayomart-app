<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h2>Produk</h2>
<hr />
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">List Produk</li>
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard/tambah-produk">Tambah Produk</a></li>
</ul>
<p class="mb-3">Halaman ini dapat menampilkan produk dari ssayomart market disini anda sebagai admin dapat mengatur dan menglola produk yang akan tampil pada halaman user berikan produk terbaikmu
</p>

<a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/tambah-produk">Tambah Produk</a>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">List Produk</h6>
    </div>
    <div class="card-body ">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>SKU</th>
                        <th>Harga Produk</th>
                        <!-- <th>Stock Produk</th> -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <div class="d-none"><?= $no = 1; ?></div>
                <tbody>
                    <?php foreach ($produk_Model as $km) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/produk/main/' . $km['img']); ?>" class="img-fluid" alt="" width="80" height="80">
                            </td>
                            <td><?= $km['nama']; ?></td>
                            <td><?= $km['sku']; ?></td>
                            <!-- <td>25/26/27</td> -->
                            <td><?= $km['harga']; ?></td>
                            <!-- <td>1</td> -->
                            <td class="text-center">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="<?= base_url() ?>produk/<?= $km['slug']; ?>">
                                            <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Lihat Produk
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>dashboard/tambah-produk/update-produk/<?= $km['id_produk']; ?>">
                                            <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Update
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url() ?>dashboard/tambah-produk/delete-produk/<?= $km['id_produk']; ?>">
                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                            <span class="text-danger">Delete</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>





    <?= $this->endSection(); ?>