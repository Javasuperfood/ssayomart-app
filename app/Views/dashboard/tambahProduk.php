<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Manajement Produk</h1>
<p class="mb-4">Anda dapt mengatur produk apa yang akan ditampilkan pada halaman user</p>

<div class="row">

    <!-- Left Panel -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form input & submit</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/tambah-produk/save" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="produk" placeholder="Nama Produk" autofocus>
                    </div>
                    <!-- <div class="mb-3">
                            <label for="tanggal_exp" class="form-label">Tanggal EXP</label>
                            <input type="date" class="form-control" id="tanggal_exp" name="tanggal_exp" placeholder="EXP">
                        </div> -->
                    <div class="mb-3">
                        <label for="harga_produk" class="form-label">Harga Produk</label>
                        <input type="price" class="form-control" id="harga_produk" name="harga" placeholder="Harga">
                    </div>
                    <!-- <div class="mb-3">
                            <label for="kategori_produk" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori_produk" name="kategori_produk" placeholder="Kategori">
                        </div> -->
                    <div class="mb-3">
                        <label for="stock_produk" class="form-label">Stock Produk</label>
                        <input type="price" class="form-control" id="stock_produk" name="stock" placeholder="Stock">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control" id="deskripsi_produk" name="deskripsi" placeholder="Deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar_produk" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar_produk" name="gambar" placeholder="Masukan Gambar">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mt-3">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Produk List</h6>
            </div>
            <div class="card-body">
                <!-- code -->
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
                <table class="table table-bordered text-center table-responsive" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Produk</th>
                            <!-- <th scope="col">Tanggal EXP</th> -->
                            <!-- <th scope="col">Ketegori</th> -->
                            <th scope="col">Harga Produk</th>
                            <th scope="col">Stock Produk</th>
                            <th scope="col">Deskripsi</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><img src="<?= base_url() ?>assets/img/produk/" class="img-fluid" alt="" width="50" height="50"></td>
                            <td>Nori</td>
                            <!-- <td>25/26/27</td> -->
                            <td>Rp.12.0000,-</td>
                            <td>16</td>
                            <td> Makanan Enak Bergizi</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
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

</div>

<?= $this->endSection(); ?>