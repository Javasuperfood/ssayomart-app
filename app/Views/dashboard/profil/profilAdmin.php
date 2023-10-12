<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<section class="profil mb-4 mb-md-4">
    <!-- left -->
    <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-4 mb-3">
            <div class="card text-center shadow-sm" style="background-color: #f2f2f2;">
                <div class="card-body profile-card d-flex flex-column align-items-center">
                    <img src="<?= base_url() ?>assets/img/pic/1697074369_78d8729f7a629917714f.jpeg" alt="Profile" class="rounded-circle" style="width: 150px; height: 150px;">
                    <h6 class="mt-3">Adib Sugender</h6>
                    <h6 class="mb-4">Admin PT. Ssayomart Indonesia</h6>
                    <a href="<?= base_url(); ?>dashboard/profil/editProfil" class="btn btn-danger"><i class="bi bi-pencil-square"></i>&nbsp;Edit Profile</a>
                </div>
            </div>
        </div>

        <!-- right -->
        <div class="col-md-12 col-lg-8 col-xl-8"> <!-- Tambahkan kelas mb-md-0 di sini -->
            <div class="card shadow-sm">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ringkasan</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-4">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Tentang</h5>
                            <p class="small fst-italic" style="color: red;">Anda merupakan admin dari Ssayomart. Gunakan jabatan Anda sebaik mungkin.</p>

                            <hr class="my-3 border-top border-3">

                            <h5 class="card-title">Profile Details</h5>
                            <hr class="my-3 border-top border-3">
                            <div class="row mb-3">
                                <div class="col-md-4 label"><i class="bi bi-person-vcard-fill"></i> Nama Lengkap</div>
                                <div class="col-md-8">Adib Sugender</div>
                            </div>
                            <hr class="my-3 border-top border-3">
                            <div class="row mb-3">
                                <div class="col-md-4 label"><i class="bi bi-person-vcard-fill"></i> Username</div>
                                <div class="col-md-8">@Adib6969</div>
                            </div>
                            <hr class="my-3 border-top border-3">
                            <div class="row mb-3">
                                <div class="col-md-4 label"><i class="bi bi-envelope"></i> Email</div>
                                <div class="col-md-8">Adibimoet@gmail.com</div>
                            </div>
                            <hr class="my-3 border-top border-3">
                            <div class="row mb-3">
                                <div class="col-md-4 label"><i class="bi bi-house"></i> Alamat</div>
                                <div class="col-md-8">Ruko Cyber Park, Jalan Gajah Mada, Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139</div>
                            </div>
                            <hr class="my-3 border-top border-3">
                            <div class="row">
                                <div class="col-md-4 label"><i class="bi bi-telephone"></i> Telepon</div>
                                <div class="col-md-8">(436) 486-3538 x29071</div>
                            </div>
                            <hr class="mt-3 border-top border-3">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</section>


<?= $this->endSection(); ?>