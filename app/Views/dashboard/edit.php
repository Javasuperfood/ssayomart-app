<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>


<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Input Produk</h1>
    <p class="mb-4">Silahkan masukan produk anda</p>

    <!-- Content Row -->
    <div class="row">

        <!-- Left Panel -->
        <div class="col-lg-4 mb-5">

            <div class="card position-relative">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Masukan Produk di panel ini</h6>
                </div>
                <div class="card-body">
                    <!-- form -->
                    <form action="<?= route_to('produk.create') ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama" placeholder="Nama Produk" autofocus>
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
                            <input type="price" class="form-control" id="stock_produk" name="stok" placeholder="Stock">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
                            <textarea class="form-control" id="deskripsi_produk" name="dekripsi" placeholder="Deskripsi" rows="3"></textarea>
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

        <!-- Right panel -->
        <div class="col-lg-8">

            <div class="card position-relative">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produk list</h6>
                </div>
                <div class="card-body">
                    <!-- secarhbar -->
                    <div class="container text-right">
                        <div class="row row-cols-2">
                            <div class="col"></div>
                            <div class="col">
                                <!-- searchbar -->
                                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-3 text-center">
                        <table class="table">
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
                            <tfoot>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><img src="<?= base_url() ?>assets/img/produk/" class="img-fluid" alt="" width="50" height="50"></td>
                                        <td>Nori</td>
                                        <!-- <td>25/26/27</td> -->
                                        <td>Makanan Ringan</td>
                                        <td>ini adalah makanan yang enak ges asin</td>
                                        <td>Rp.12.0000,-</td>
                                        <td>18</td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-circle btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                </tbody>
                            </tfoot>
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

    </div>

</div>

<?= $this->endSection(); ?>