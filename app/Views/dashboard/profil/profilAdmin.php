<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Profile Admin</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a class="text-secondary" href="<?= base_url() ?>dashboard/profil/profile-admin/<?= auth()->user()->id; ?>">Profile Admin</a></li>
    <li class="breadcrumb-item text-danger"><a href="#"></a>Sunting Profile</li>
</ul>

<section class="profil mb-4 mb-md-4">
    <div class="row">
        <!-- left -->
        <div class="col-md-12 col-lg-4 col-xl-4 mb-3">
            <div class="card text-center border-0 shadow-sm bg-white rounded-4">
                <div class="card-body profile-card d-flex flex-column align-items-center">
                    <img src="<?= base_url() ?>assets/img/pic/<?= $um['img']; ?>" alt="Profile" class="rounded-circle" style="width: 150px; height: 150px;">
                    <h6 class="mt-3"><b><?= $um['fullname']; ?></b></h6>
                    <h6 class="mb-4"><?= $results[0]->secret; ?></h6>
                    <h6 class="mb-4"><?= $id; ?></h6>
                </div>
            </div>
        </div>
        <!-- right -->
        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-border" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-danger active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-overview" role="tab" aria-controls="profile-overview" aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-secondary" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit-overview" role="tab" aria-controls="edit-overview" aria-selected="false">Setting</button>
                        </li>
                    </ul>

                    <div class="tab-content pt-4">
                        <div class="tab-pane fade show active" id="profile-overview" role="tabpanel" aria-labelledby="profile-tab">
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

                        <div class="tab-pane fade" id="edit-overview" role="tabpanel" aria-labelledby="edit-tab">
                            <div class="mb-4 mb-md-4">
                                <form action="<?= base_url() ?>dashboard/profil/edit-admin/<?= user_id() ?>" method="post" enctype="multipart/form-data" onsubmit="return validasiProfilAdmin()">
                                    <?= csrf_field() ?>
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                        <div class="col-md-1 col-lg-1">
                                            <div class="card text-center border-0 bg-white">
                                                <img src="<?= base_url() ?>assets/img/pic/<?= $um['img']; ?>" alt="Foto Profil Admin" class="rounded-circle" style="max-width: 150px; max-height: 150px;">
                                                <div class="pt-2">
                                                    <label for="img" class="btn btn-danger btn-sm border-0">
                                                        <i class="bi bi-upload">
                                                        </i>
                                                    </label>
                                                    <input type="file" id="img" style="display: none;" name="img" accept="image/*" value="<?= $um['img']; ?>" />
                                                    <input type="hidden" name="imageLama" value="<?= $um['img']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="role" class="col-md-4 col-lg-3 col-form-label">Role Akun</label>
                                        <div class="col-md-8 col-lg-8">
                                            <input name="role" type="text" class="form-control border-0 shadow-sm bg-light" id="role" name="role" value="Admin" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullname" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-md-8 col-lg-8">
                                            <input name="fullname" type="text" class="form-control border-0 shadow-sm" id="fullname" nama="fullname" value="<?= $um['fullname']; ?>" placeholder="Nama Lengkap Anda...">
                                            <span id="fullnameError" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-8">
                                            <input name="username" type="text" class="form-control border-0 shadow-sm" id="username" name="username" value="<?= $um['username']; ?>" placeholder="Username Anda...">
                                            <span id="usernameError" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-8">
                                            <input name="Email" type="text" class="form-control border-0 shadow-sm bg-light" disabled id="email" name="email" value="<?= $results[0]->secret; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-8">
                                            <input type="text" class="form-control shadow-sm border-0" id="telp" name="telp" value="<?= $um['telp']; ?>" placeholder="Nomor Telpon Anda...">
                                            <span id="telpError" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="text-center mt-5">
                                        <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
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

    $(document).ready(function() {
        $('#edit-tab').on('click', function() {
            $('#profile-tab').removeClass('text-danger').addClass('text-secondary');
            $(this).removeClass('text-secondary').addClass('text-danger');
        });

        $('#profile-tab').on('click', function() {
            $('#edit-tab').removeClass('text-danger').addClass('text-secondary');
            $(this).removeClass('text-secondary').addClass('text-danger');
        });
    });

    // validasi form
    function validasiProfilAdmin() {
        var isValid = true;

        var usernameField = document.getElementById('username');
        var fullnameField = document.getElementById('fullname');
        var telpField = document.getElementById('telp');

        var usernameError = document.getElementById('usernameError');
        var fullnameError = document.getElementById('fullnameError');
        var telpError = document.getElementById('telpError');

        usernameError.textContent = '';
        fullnameError.textContent = '';
        telpError.textContent = '';

        if (usernameField.value.trim() === '') {
            usernameField.classList.add('invalid-field');
            usernameError.textContent = '<?= lang('Text.username') ?> <?= lang('Text.validasi') ?>';
            isValid = false;
        } else {
            usernameField.classList.remove('invalid-field');
        }

        if (fullnameField.value.trim() === '') {
            fullnameField.classList.add('invalid-field');
            fullnameError.textContent = '<?= lang('Text.nama_lengkap') ?> <?= lang('Text.validasi') ?>';
            isValid = false;
        } else {
            fullnameField.classList.remove('invalid-field');
        }

        if (telpField.value.trim() === '') {
            telpField.classList.add('invalid-field');
            telpError.textContent = '<?= lang('Text.telp') ?> <?= lang('Text.validasi') ?>';
            isValid = false;
        } else {
            telpField
                .classList.remove('invalid-field');
        }
        return isValid;
    }
</script>

<?= $this->endSection(); ?>