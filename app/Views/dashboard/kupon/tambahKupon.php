<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-medium">Masukan Kupon Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/tambah-kupon/save" method="post" onsubmit="return validasiTambahKupon()">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="nama_kupon" class="form-label">Nama Kupon</label>
                <input type="text" class="form-control" id="nama_kupon" name="nama_kupon" placeholder="Nama Kupon Anda" value="<?= old('nama_kupon') ?>">
                <span id="kuponError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="kode_kupon" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode_kupon" name="kode_kupon" placeholder="Kode Kupon" value="<?= old('kode_kupon') ?>">
                <span id="kodeError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="deskripsi_kupon">Deskripsi</label>
                <textarea class="form-control" id="deskripsi_kupon" name="deskripsi_kupon" rows="3" placeholder="Deskripsi Kupon ...." value="<?= old('deskripsi_kupon') ?>"></textarea>
                <span id="deskripsiError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Diskon</label>
                <input type="text" class="form-control" id="discount" name="discount" placeholder="Diskon" value="<?= old('discount') ?>">
                <span id="discountError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="total_buy" class="form-label">Total Pembelian</label>
                <input type="text" class="form-control" id="total_buy" name="total_buy" placeholder="total pembelian" value="<?= old('total_buy') ?>">
                <span id="totalError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="masa_berlaku" class="form-label mr-3">Masa Berlaku</label>
                <input type="date" id="masa_berlaku" name="masa_berlaku" placeholder="Masukan Masa Berlaku Kupon" value="<?= old('masa_berlaku') ?>">
                <span id="masaBerlakuError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
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

    //Validasi Form
    function validasiTambahKupon() {
        var isValid = true;

        var kuponField = document.getElementById('nama_kupon');
        var kodeField = document.getElementById('kode_kupon');
        var deskripsiField = document.getElementById('deskripsi_kupon');
        var discountField = document.getElementById('discount');
        var totalField = document.getElementById('total_buy');
        var masaBerlakuField = document.getElementById('masa_berlaku');

        var kuponError = document.getElementById('kuponError');
        var kodeError = document.getElementById('kodeError');
        var deskripsiError = document.getElementById('deskripsiError');
        var discountError = document.getElementById('discountError');
        var totalError = document.getElementById('totalError');
        var masaBerlakuError = document.getElementById('masaBerlakuError');

        kuponError.textContent = '';
        kodeError.textContent = '';
        deskripsiError.textContent = '';
        discountError.textContent = '';
        totalError.textContent = '';
        masaBerlakuError.textContent = '';

        if (kuponField.value.trim() === '') {
            kuponField.classList.add('invalid-field');
            kuponError.textContent = 'Kupon harus diisi';
            isValid = false;
        } else {
            kuponField.classList.remove('invalid-field');
        }

        if (kodeField.value.trim() === '') {
            kodeField.classList.add('invalid-field');
            kodeError.textContent = 'Kode kupon harus diisi';
            isValid = false;
        } else {
            kodeField.classList.remove('invalid-field');
        }

        if (deskripsiField.value.trim() === '') {
            deskripsiField.classList.add('invalid-field');
            deskripsiError.textContent = 'Deskripsi kupon harus diisi';
            isValid = false;
        } else {
            deskripsiField.classList.remove('invalid-field');
        }

        if (discountField.value.trim() === '') {
            discountField.classList.add('invalid-field');
            discountError.textContent = 'Kolom diskon harus diisi';
            isValid = false;
        } else {
            discountField.classList.remove('invalid-field');
        }

        if (totalField.value.trim() === '') {
            totalField.classList.add('invalid-field');
            totalError.textContent = 'Total harus diisi';
            isValid = false;
        } else {
            totalField.classList.remove('invalid-field');
        }

        if (masaBerlakuField.value.trim() === '') {
            masaBerlakuField.classList.add('invalid-field');
            masaBerlakuError.textContent = 'Masa belaku kupon harus diisi';
            isValid = false;
        } else {
            masaBerlakuField.classList.remove('invalid-field');
        }
        return isValid;
    }
</script>

<?= $this->endSection(); ?>