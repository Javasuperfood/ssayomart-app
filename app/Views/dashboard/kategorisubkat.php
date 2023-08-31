<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Kategori Produk</h1>
<p class="mb-4">Kategori produk untuk toko Anda dapat diatur di sini. Untuk mengganti urutan kategori di ujung depan, Anda dapat seret-lepas untuk mengurutkannya. Untuk melihat kategori lainnya klik tautan "Opsi Layar" pada bagian atas halaman.</p>

<div class="row">

    <!-- Left Panel -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form submit</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="/kategori/create">

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="kategori" placeholder="Nama Lengkap" name="kategori">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" placeholder="slug" name="slug">
                    </div>
                    <div class="mb-1">
                        <label for="kategori" class="form-label">Induk Kategori</label>
                    </div>
                    <div>
                        <select class="form-select mb-2" aria-label="Default select example">
                            <option selected>Pilihan</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <p class="mb-0 small">Note: Tetapkan sebuah istilah induk untuk membuat sebuah hirarki. Istilah Jazz, contohnya, akan menjadi induk dari Bebop dan Big Band.</p>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="small mb-1">Navbar Dropdown Example:</div>
                    <p class="mb-0 small">Note: Umumnya deskripsi tidak tampil. Namun, beberapa tema dapat menampilkannya.</p>
                    <div>
                        <button type="submit" class="btn btn-primary mt-3" id="ka">Simpan</button>
                    </div>
            </div>
        </div>
        </form>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Produk Kategori</h6>
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
                            <th>No</th>
                            <th>gambar</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>kategori</th>
                            <th>Subkategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="<?= base_url() ?>assets/img/produk/p7.png" class="img-fluid" alt="" width="50" height="50"></td>
                            <td>Nori</td>
                            <td>-</td>
                            <td>Makananan Ringan</td>
                            <td>Makanan Korea</td>
                            <td>Lezat Begizi</td>
                            <td> <a href="#" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-exclamation-triangle"></i>
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