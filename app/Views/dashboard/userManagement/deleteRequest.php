<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Request Penghapusan Akun User</h1>


<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-danger">List Request Penghapusan Akun</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Alasan Penghapusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($delRequest as $del) : ?>
                                <?php
                                // Find the corresponding user for the current delete request
                                $user = array_filter($users, function ($u) use ($del) {
                                    return $u['id'] == $del['id_user'];
                                });
                                $user = reset($user); // Get the first (and only) element of the filtered array
                                ?>

                                <tr>
                                    <td><?= $user['fullname']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $del['alasan']; ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn position-relative" data-bs-toggle="modal" data-bs-target="#confirmationDelete<?= $del['id_request_delete'] ?>">
                                            <i class="bi bi-trash-fill fs-5 text-danger"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Confirmation Delete -->
                                <div class="modal fade" id="confirmationDelete<?= $del['id_request_delete'] ?>" tabindex="-1" aria-labelledby="confirmationDeleteLabel<?= $del['id_request_delete'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="confirmationDeleteLabel<?= $del['id_request_delete'] ?>">Konfirmasi Penghapusan Akun</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger">
                                                    <div class="col-auto text-center mb-2" style="font-size:50px;">
                                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                                    </div>
                                                    <div class="col text-center">
                                                        <p class="text-uppercase"><strong>Penghapusan akun bersifat permanen.</strong></p>
                                                        <p>Apakah anda yakin untuk melakukan penghapusan akun?</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="<?= base_url('dashboard/user-management/delete-account/delete/' . $del['id_request_delete']) ?>" method="post" enctype="multipart/form-data" onclick="clickSubmitEvent(this)">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="id" value="<?= $del['id_request_delete']; ?>">
                                                        <button type="submit" class="btn btn-danger">Ya, Yakin</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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