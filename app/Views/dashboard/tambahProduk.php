<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Manajement Produk</h1>
<p class="mb-4">Anda dapt mengatur produk apa yang akan ditampilkan pada halaman user</p>

<div class="row">

    <!-- Left Panel -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-medium">Form input & submit</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/tambah-produk/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" autofocus>
                    </div>
                    <!-- <div class="mb-3">
                            <label for="tanggal_exp" class="form-label">Tanggal EXP</label>
                            <input type="date" class="form-control" id="tanggal_exp" name="tanggal_exp" placeholder="EXP">
                        </div> -->
                    <div class="mb-3">
                        <label for="harga_produk" class="form-label">Harga Produk</label>
                        <input type="price" class="form-control" id="harga_produk" name="harga_produk" placeholder="Harga">
                    </div>
                    <!-- <div class="mb-3">
                            <label for="kategori_produk" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori_produk" name="kategori_produk" placeholder="Kategori">
                        </div> -->
                    <div class="mb-3">
                        <label for="stock_produk" class="form-label">Stock Produk</label>
                        <input type="number" class="form-control" id="stock_produk" name="stock_produk" placeholder="Stock">
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="3" placeholder="Deskripsi Produk Anda .."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar_produk" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" placeholder="Masukan Gambar">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-3">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-medium">Produk List</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <!-- <nav class="navbar navbar-expand navbar-light bg-white topbar mb-3">
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
                </nav> -->
                <table class="table table-bordered text-center table-responsive" id="example" width="100%" cellspacing="0">
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
                    <?= $no = 1; ?>
                    <tbody>
                        <?php foreach ($produk_Model as $km) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <img src="<?= base_url('assets/img/produk/main/' . $km['img']); ?>" class="img-fluid" alt="" width="50" height="50">
                                </td>
                                <td><?= $km['nama']; ?></td>
                                <!-- <td>25/26/27</td> -->
                                <td><?= $km['harga']; ?></td>
                                <td><?= $km['stok']; ?></td>
                                <td><?= $km['deskripsi']; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>dashboard/tambah-produk/update-produk/<?= $km['id_produk']; ?>" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="<?= base_url() ?>dashboard/tambah-produk/delete-produk/<?= $km['id_produk']; ?>" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>

                </table>

            </div>
        </div>

    </div>

    <script>
        new DataTable('#example');
    </script>
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