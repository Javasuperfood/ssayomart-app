<?= $this->extend('dashboard/dashboard') ?>
<?= $no = 1; ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Kategori Produk</h1>
<p class="mb-4">Kategori produk untuk toko Anda dapat diatur di sini. Untuk mengganti urutan kategori di ujung depan, Anda dapat seret-lepas untuk mengurutkannya. Untuk melihat kategori lainnya klik tautan "Opsi Layar" pada bagian atas halaman.</p>

<div class="row">


    <!-- Right Panel -->
    <div class="col mb-3">
        <a class="btn btn-primary mb-3" href="<?= base_url(); ?>dashboard/tambah-kategori">Tambah Kategori


        </a>

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Produk Kategori</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($kategori_model as $km) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><img src="#" alt=""></td>
                                <td><?= $km['nama_kategori']; ?></td>
                                <td><?= $km['slug']; ?></td>

                                <td><?= $km['deskripsi']; ?></td>
                                <td style="width: 100px;">
                                    <a href="<?= base_url("dashboard/kategori/edit-kategori/{$km['id_kategori']}"); ?>" class="btn btn-warning btn-circle btn-sm btn-inline">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="<?= base_url() ?>dashboard/kategori/delete-kategori/<?= $km['id_kategori']; ?>" class="btn btn-danger btn-circle btn-sm">
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



<script>
    new DataTable('#example');
</script>


<?= $this->endSection(); ?>