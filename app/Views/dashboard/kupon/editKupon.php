<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>


<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Edit Keterangan Kupon</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/edit-kupon/<?= $kp['id_kupon'] ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_kupon" name="id_kupon" value="<?= $kp['id_kupon'] ?>">
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input bg-danger" type="checkbox" value="1" name="is_active" id="isActive" <?= (old('is_active')) ? 'checked' : (($kp['is_active']) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="isActive">
                        Tekan untuk Aktifkan Kupon
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="nama_kupon" class="form-label">Judul Kupon <span class="text-danger fs-5">*</span></label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="nama_kupon" name="nama_kupon" placeholder="Nama Kupon Anda" value="<?= (old('nama_kupon')) ? old('nama_kupon') : $kp['nama'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <label for="kode_kupon" class="form-label">Kode Reveral Kupon <span class="text-danger fs-5">*</span></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control <?= (validation_show_error('kode')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="kode_kupon" name="kode_kupon" placeholder="Kode Kupon" value="<?= (old('kode_kupon')) ? old('kode_kupon') : $kp['kode'] ?>" aria-describedby="generateKode">
                <button class="btn btn-outline-danger shadow-sm" id="generateKode" type="button">Dapatkan Kode</button>
            </div>
            <div class="invalid-feedback"><?= validation_show_error('kode'); ?></div>
            <div class="mb-3">
                <label for="deskripsi_kupon" class="form-label">Deskripsi Kupon <span class="text-danger fs-5">*</span></label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="deskripsi_kupon" name="deskripsi_kupon" rows="3" placeholder="Deskripsi Kupon ...." value=""><?= (old('deskripsi_kupon')) ? old('deskripsi_kupon') : $kp['deskripsi'] ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Potongan Harga Kupon <span class="text-danger fs-5">*</span></label>
                <select class="form-select <?= (validation_show_error('discount')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" name="discount" id="">
                    <?php for ($i = 5; $i <= 100; $i += 5) : ?>
                        <option value="<?= $i / 100; ?>" <?= (old('discount') == $i / 100) ? 'selected' : (($kp['discount'] == $i / 100) ? 'selected' : ''); ?>><?= $i; ?>%</option>
                    <?php endfor; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('discount'); ?></div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="total_buy" class="form-label">Minimal Pembelian <span class="text-danger fs-5">*</span></label>
                        <input type="text" class="form-control <?= (validation_show_error('total_buy')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="total_buy" name="total_buy" placeholder="total pembelian" value="<?= (old('total_buy')) ? old('total_buy') : $kp['total_buy'] ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <div class="invalid-feedback"><?= validation_show_error('total_buy'); ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Maksimal Digunakan <span class="text-danger fs-5">*</span></label>
                        <input type="number" class="form-control <?= (validation_show_error('available_kupon')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" name="available_kupon" value="<?= (old('available_kupon')) ? old('available_kupon') : $kp['available_kupon']; ?>" id="" placeholder="Maksimal digunakan">
                        <div class="invalid-feedback"><?= validation_show_error('available_kupon'); ?></div>
                    </div>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-danger mt-3">Simpan Perubahan</button>
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
    function validasiUpdateKupon() {
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