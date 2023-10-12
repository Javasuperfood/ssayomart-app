<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<section class="edit mb-4 mb-md-4">
    <form>
        <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
            <div class="col-md-8 col-lg-9">
                <img src="<?= base_url() ?>assets/img/pic/1697074369_78d8729f7a629917714f.jpeg" alt="Profile" style="max-width: 100px; max-height: 100px;">
                <div class="pt-2">
                    <a href="#" class="btn btn-warning btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Status</label>
            <div class="col-md-8 col-lg-8">
                <input name="fullName" type="text" class="form-control" id="fullName" value="Admin" disabled>
            </div>
        </div>


        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
            <div class="col-md-8 col-lg-8">
                <input name="fullName" type="text" class="form-control" id="fullName" value="Adib Sugender">
            </div>
        </div>

        <div class="row mb-3">
            <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
            <div class="col-md-8 col-lg-8">
                <input name="username" type="text" class="form-control" id="username" value="@adib6969">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-8">
                <input name="Email" type="text" class="form-control" id="Email" value="Adibimoet@gmail.com">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
            <div class="col-md-8 col-lg-8">
                <input name="country" type="text" class="form-control" id="Country" value="Kota Tangeramng, banten indonesia">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
            <div class="col-md-8 col-lg-8">
                <input name="phone" type="text" class="form-control" id="Phone" value="(436) 486-3538 x29071">
            </div>
        </div>

        <div class="row mb-3">
            <label for="about" class="col-md-4 col-lg-3 col-form-label">Tentang</label>
            <div class="col-md-8 col-lg-8">
                <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
            </div>
        </div>

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
        </div>
    </form>
</section>

<?= $this->endSection(); ?>