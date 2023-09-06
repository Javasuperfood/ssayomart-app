<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Produk</h1>
<p class="mb-4">Halaman ini dapat menampilkan produk dari ssayomart market disini anda sebagai admin dapat mengatur dan menglola produk yang akan tampil pada halaman user berikan produk terbaikmu
</p>

<a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/tambah-produk">Tambah Produk</a>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">List Produk</h6>
    </div>
    <div class="card-body border-0">
        <!-- searchbar -->
        <form class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
            <table class="table text-center" id="example" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <!-- <th>Tanggal EXP</th> -->
                        <!-- <th>Ketegori</th> -->
                        <th>Harga Produk</th>
                        <th>Stock Produk</th>
                        <!-- <th>Deskripsi</th> -->
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
                            <!-- <td>25/26/27</td> -->
                            <td><?= $km['harga']; ?></td>
                            <td><?= $km['stok']; ?></td>
                            <!-- <td><?= $km['deskripsi']; ?></td> -->
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a href="<?= base_url(); ?>dashboard/tambah-produk/update-produk/<?= $km['id_produk']; ?>" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="<?= base_url() ?>dashboard/tambah-produk/delete-produk/<?= $km['id_produk']; ?>" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                </tbody>
            <?php endforeach; ?>
            </table>
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>



<?= $this->endSection(); ?>