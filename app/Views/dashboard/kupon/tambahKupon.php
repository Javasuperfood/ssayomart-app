<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-medium">Masukan Kupon Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/tambah-kupon/save" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input bg-danger fs-5" type="checkbox" value="1" name="is_active" id="isActive" <?= (old('is_active') == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="isActive">
                        Tekan untuk Aktifkan Kupon
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="nama_kupon" class="form-label">Judul Kupon <span class="text-danger fs-5">*</span></label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="nama_kupon" name="nama_kupon" placeholder="Nama Kupon Anda" value="<?= old('nama_kupon') ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <label for="kode_kupon" class="form-label">Kode Reveral Kupon <span class="text-danger fs-5">*</span></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control <?= (validation_show_error('kode')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="kode_kupon" name="kode_kupon" placeholder="Kode Kupon" value="<?= old('kode_kupon') ?>" aria-describedby="generateKode">
                <button class="btn btn-outline-danger shadow-sm" id="generateKode" type="button">Dapatkan Kode</button>
            </div>
            <div class="invalid-feedback"><?= validation_show_error('kode'); ?></div>
            <div class="mb-3">
                <label for="deskripsi_kupon" class="form-label">Deskripsi Kupon <span class="text-danger fs-5">*</span></label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="deskripsi_kupon" name="deskripsi_kupon" rows="3" placeholder="Deskripsi Kupon ...." value=""><?= old('deskripsi_kupon') ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Potongan Harga Kupon <span class="text-danger fs-5">*</span></label>
                <select class="form-select <?= (validation_show_error('discount')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" name="discount" id="">
                    <option value="" selected>Pilih discount</option>
                    <?php for ($i = 5; $i <= 100; $i += 5) : ?>
                        <option value="<?= $i / 100; ?>" <?= (old('discount') == $i / 100) ? 'selected' : ''; ?>><?= $i; ?>%</option>
                    <?php endfor; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('discount'); ?></div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="total_buy" class="form-label">Minimal Pembelian <span class="text-danger fs-5">*</span></label>
                        <input type="text" class="form-control <?= (validation_show_error('total_buy')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="total_buy" name="total_buy" placeholder="total pembelian" value="<?= old('total_buy') ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <div class="invalid-feedback"><?= validation_show_error('total_buy'); ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Maksimal Digunakan <span class="text-danger fs-5">*</span></label>
                        <input type="number" class="form-control <?= (validation_show_error('available_kupon')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" name="available_kupon" value="<?= (old('available_kupon')) ? old('available_kupon') : 1; ?>" id="" placeholder="Mkasimal digunakan">
                        <div class="invalid-feedback"><?= validation_show_error('available_kupon'); ?></div>
                    </div>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-danger mt-3">Tambah Kupon</button>
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

    $("#generateKode").click(function() {
        let randomString = Math.random().toString(36).substring(2, 8);
        $("#kode_kupon").val(randomString);
    })
</script>

<?= $this->endSection(); ?>