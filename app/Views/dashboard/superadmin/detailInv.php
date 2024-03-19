<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-2">
                <i class="bi bi-ticket-detailed text-danger fs-1 fw-bold mx-2"></i>
                <h3 class="d-inline-block fw-bold align-middle">Detail Invoice</h3>
            </div>
            <hr class="mb-3 border-danger" style="border-width: 3px;">
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body text-center mt-5">
                    <img src="<?= base_url() ?>assets/img/pic/default.png" alt="profile" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h6 class="text-secondary fw-bold">Nama Customer</h6>
                    <?php $namaCustomer = empty($user_id['fullname']) ? "[Nama Lengkap Belum Diisi]" : $user_id['fullname']; ?>
                    <h5 class="fw-bold text-dark"><?= $namaCustomer ?></h5>
                    <h6 class="text-secondary fw-bold">Email Customer</h6>
                    <h5 class="fw-bold text-dark">
                        <?php foreach ($auth_user as $auth) : ?>
                            <?php if ($auth['user_id'] == $user_id['id']) : ?>
                                <?= $auth['secret'] ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <h5 class="text-center text-secondary fw-bold mb-5">Data History Pembelian User</h5>
                    <!-- Input groups -->

                    <table class="table table-sm table-borderless text-center">
                        <thead>
                            <tr>
                                <th scope="col">Invoice</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Tanggal Beli</th>
                                <th scope="col">Cabang Market</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getSuperAdminReport as $transaction) : ?>

                                <?php foreach ($transaction['produk'] as $produk) : ?>
                                    <tr>
                                        <td><?= $transaction['invoice']; ?></td>
                                        <td><?= $produk['nama']; ?></td>
                                        <td><?= $transaction['qty']; ?></td>
                                        <td><?= $transaction['total_2']; ?></td>
                                        <td><?= $transaction['created_at']; ?></td>
                                        <td><?= $transaction['lable']; ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>