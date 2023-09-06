<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/tambah-kupon">Tambah Produk</a>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Kupon List</h6>
    </div>
    <div class="card-body text-center">
        <table class=" table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Code</th>
                    <th>Deskripsi</th>
                    <th>Masa Berlaku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kupon_Model as $km) : ?>
                    <tr>
                        <td><?= $km['nama']; ?></td>
                        <td><?= $km['nama']; ?></td>
                        <td><?= $km['kode']; ?></td>
                        <td><?= $km['deskripsi']; ?></td>
                        <td><?= $km['is_active']; ?></td>
                        <td> <a class="dropdown-toggle btn-danger btn-circle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">MENU AKSI:</div>
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </td>
                    </tr>
            </tbody>
        <?php endforeach; ?>
        </table>

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