<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-medium">Masukan Kupon Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/tambah-kupon/save" method="post" class="was-validated">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="validationCustom01" class="form-label">Nama Kupon</label>
                <input type="text" class="form-control" id="validationCustom01" name="nama_kupon" placeholder="Nama Kupon Anda" required>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom02" class="form-label">Kode</label>
                <input type="text" class="form-control" id="validationCustom02" name="kode_kupon" placeholder="Kode Kupon" required>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom03">Deskripsi</label>
                <textarea class="form-control" id="validationCustom03" name="deskripsi_kupon" rows="3" placeholder="Deskripsi Kupon ...." required></textarea>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom04" class="form-label">Diskon</label>
                <input type="text" class="form-control" id="validationCustom04" name="discount" required placeholder="Diskon" required>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom05" class="form-label">total Pembelian</label>
                <input type="text" class="form-control" id="validationCustom05" name="total_buy" required placeholder="total pembelian" required>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom06" class="form-label mr-3">Masa Berlaku</label>
                <input type="date" id="validationCustom06" name="masa_berlaku" required placeholder="Masukan Masa Berlaku Kupon" required>
                <div class="invalid-feedback">Isi semua form input!</div>
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