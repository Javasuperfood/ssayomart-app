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
                <form action="<?= base_url(); ?>dashboard/kategori/create-kategori" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="kategori" placeholder="Nama Lengkap" name="kategori">
                    </div>

                    <div class="mb-1">
                        <label for="kategori" class="form-label">Induk Kategori</label>
                    </div>
                    <div>
                        <select class="form-select mb-2" aria-label="Default select example" name="induk">
                            <option selected>Pilihan</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <p class="mb-0 small">Note: Tetapkan sebuah istilah induk untuk membuat sebuah hirarki. Istilah Jazz, contohnya, akan menjadi induk dari Bebop dan Big Band.</p>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi"></textarea>
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
    <div class="col-lg-6 mb-3">

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
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>kategori</th>
                            <th>Subkategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategori_model as $km) : ?>
                            <tr>
                                <td>1</td>

                                <td><?= $km['nama_kategori']; ?></td>
                                <td>-</td>
                                <td></td>
                                <td>Makanan jepang</td>
                                <td><?= $km['deskripsi']; ?></td>
                                <td> <a href="#" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>
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