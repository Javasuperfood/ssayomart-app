<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Promosi Ssayomart</h1>
<a href="<?= base_url() ?>dashboard/promo/tambah-promo" class="btn btn-danger mb-4">Tambah Promo</a>
<!-- <a href="<?= base_url() ?>dashboard/promo/tambah-promo-bundling" class="btn btn-danger mb-4">Tambah Promo Produk</a> -->
<div class="row">


    <!-- Right Panel -->
    <div class="col-lg-6 mb-5">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-text-fill"></i>
                <h6 class="m-0 fw-bold px-2">List Promosi Ssayomart</h6>
            </div>
            <div class="card-body mt-2">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-4">Judul Promosi</th>
                            <th class="col-3">Waktu Mulai</th>
                            <th class="col-3">Waktu Berakhir</th>
                            <th class="col-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($promo as $p) : ?>
                            <tr>
                                <td class="align-middle"><?= $i++; ?></td>
                                <td class="align-middle"><?= $p['title']; ?></td>
                                <td class="align-middle"><?= strftime('%d %B %Y %H:%M', strtotime($p['start_at'])); ?></td>
                                <td class="align-middle"><?= strftime('%d %B %Y %H:%M', strtotime($p['end_at'])); ?></td>
                                <td class="text-center align-middle">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <!-- <a class="dropdown-item" href="<?= base_url(); ?>dashboard/promo/detail-promo/<?= $p['id_promo']; ?>">
                                                <i class="bi bi-eye fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Detail Promo
                                            </a> -->
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/promo/update-promo/<?= $p['id_promo']; ?>">
                                                <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update Promo
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="<?= base_url() ?>dashboard/promo/tambah-promo/delete-promo/<?= $p['id_promo']; ?>" id="" method="post">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="dropdown-item" onclick="clickSubmitEvent(this)">
                                                    <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                    <span class="text-danger">Hapus Promo</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <script>
        new DataTable('#example');
    </script> -->
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