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
                    <form action="<?= site_url('produk') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Gambar">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Nama Produk">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Tanggal EXP</label>
                            <input type="date" class="form-control" id="exampleFormControlInput3" placeholder="EXP">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput4" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="exampleFormControlInput4" placeholder="Kategori">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput5" class="form-label">Sub-Kategori</label>
                            <input type="text" class="form-control" id="exampleFormControlInput5" placeholder="Sub-kategori">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput6" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput6" class="form-label">Harga</label>
                            <input type="price" class="form-control" id="exampleFormControlInput6" placeholder="Harga">
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
                                    <th scope="col">#</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Tanggal EXP</th>
                                    <th scope="col">Ketegori</th>
                                    <th scope="col">Sub-kategori</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">SKU</th>
                                    <th style="width: 100px;">Aksi</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?= $item['id_produk'] ?></th>
                                        <td><img src="<?= base_url() ?>assets/img/produk/<?= $item['gambar_produk'] ?>" class="img-fluid" alt="" width="50" height="50"></td>
                                        <td><?= $item['nama_produk'] ?></td>
                                        <td>25/26/27</td>
                                        <td>Makanan Ringan</td>
                                        <td>Makanan Korea</td>
                                        <td>ini adalah makanan yang enak ges asin</td>
                                        <td>Rp.12.0000,-</td>
                                        <td>MRKNRI12KMRH</td>
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