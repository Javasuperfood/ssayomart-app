<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h2>Tambah Kupon</h2>
<hr />
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard/kupon">Kupon</a></li>
    <li class="breadcrumb-item active">Tambah Kupon</li>
</ul>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-medium">Masukan Kupon Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/save" method="post" class="was-validated">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="validationCustom01" class="form-label">Nama Kupon</label>
                <input type="text" class="form-control" id="validationCustom01" name="nama_kupon" placeholder="Nama Kupon Anda" required>
                <div class="invalid-feedback">Jangan lupa diisi Bang Messi WAJIB</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom02" class="form-label">Kode<span class="required">*</span></label>
                <input type="text" class="form-control" id="validationCustom02" name="kode_kupon" placeholder="Kode Kupon" required>
                <div class="invalid-feedback">Jangan lupa diisi Bang Messi WAJIB</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom03">Deskripsi<span class="required">*</span></label>
                <textarea class="form-control" id="validationCustom03" name="deskripsi_kupon" rows="3" placeholder="Deskripsi Kupon ...." required></textarea>
                <div class="invalid-feedback">Jangan lupa diisi Bang Messi WAJIB</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom04" class="form-label mr-2">Masa Berlaku<span class="required">*</span></label>
                <input type="date" id="validationCustom04" name="masa_berlaku" placeholder="Masukan Masa Berlaku Kupon" required>
                <div class="invalid-feedback">Jangan lupa diisi Bang Messi WAJIB</div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>


<?= $this->endSection(); ?>