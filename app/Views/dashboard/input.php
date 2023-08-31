<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Produk</h1>
<p class="mb-4">Halaman ini dapat menampilkan produk dari ssayomart market disini anda sebagai admin dapat mengatur dan menglola produk yang akan tampil pada halaman user berikan produk terbaikmu
    <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
</p>

<a class="btn btn-primary mb-3" href="<?= base_url(); ?>dashboard/tambah-produk">Tambah Produk</a>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- searchbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-3">
                <form class="form-inline ml-auto">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </nav>
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Tanggal EXP</th>
                        <th>Kategori</th>
                        <th>Subkategori</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>SKU</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="<?= base_url() ?>assets/img/produk/p7.png" class="img-fluid" alt="" width="50" height="50"></td>
                        <td>Norikin</td>
                        <td>25/26/27</td>
                        <td>Makanan Ringan</td>
                        <td>Makanan Korea</td>
                        <td>ini adalah makanan yang enak ges asin</td>
                        <td>Rp.12.0000,-</td>
                        <td>MRKNRI12KMRH</td>
                    </tr>
                </tbody>
            </table>
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
</div>



<?= $this->endSection(); ?>