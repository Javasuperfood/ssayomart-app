<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<section class="profil mb-4 mb-md-4">
    <!-- left -->
    <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-4 mb-3">
            <div class="card text-center border-0 shadow-sm bg-white">
                <div class="card-body profile-card d-flex flex-column align-items-center">
                    <img src="<?= base_url() ?>assets/img/pic/<?= $um['img']; ?>" alt="Profile" class="rounded-circle" style="width: 150px; height: 150px;">
                    <h6 class="mt-3"><?= $um['fullname']; ?></h6>
                    <h6 class="mb-4"><?= $results[0]->secret; ?></h6>
                    <a href="<?= base_url(); ?>dashboard/profil/edit-admin/<?= auth()->user()->id; ?>" class="btn btn-danger"><i class="bi bi-pencil-square"></i>&nbsp;Sunting Profile</a>
                </div>
            </div>
        </div>

        <!-- right -->
        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-borderless">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-4">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Tentang Admin</h5>
                            <p class="small fst-italic" style="color: red;">Akun Anda merupakan admin dari Ssayomart Supermarket.</p>
                            <hr class="my-3 border-top border-3">
                            <h5 class="card-title">Detail Profil Admin</h5>
                            <hr class="my-3 border-top border-3">
                            <div class="row mb-3">
                                <div class="col-md-4 label"><i class="bi bi-person-fill"></i> Nama Lengkap</div>
                                <div class="col-md-8"><?= $um['fullname']; ?></div>
                            </div>
                            <hr class="my-3 border-top border-3">
                            <div class="row mb-3">
                                <div class="col-md-4 label"><i class="bi bi-person-badge-fill"></i> Username</div>
                                <div class="col-md-8">@<?= $um['username']; ?></div>
                            </div>
                            <hr class="my-3 border-top border-3">
                            <div class="row mb-3">
                                <div class="col-md-4 label"><i class="bi bi-envelope-fill"></i> Email</div>
                                <div class="col-md-8"><?= $results[0]->secret; ?></div>
                            </div>
                            <!-- <hr class="my-3 border-top border-3">
                            <div class="row mb-3">
                                <div class="col-md-4 label"><i class="bi bi-house"></i> Alamat</div>
                                <div class="col-md-8">Ruko Cyber Park, Jalan Gajah Mada, Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139</div>
                            </div> -->
                            <hr class="my-3 border-top border-3">
                            <div class="row">
                                <div class="col-md-4 label"><i class="bi bi-telephone-fill"></i> Nomor Telpon</div>
                                <div class="col-md-8"><?= $um['telp']; ?></div>
                            </div>
                            <hr class="mt-3 border-top border-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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