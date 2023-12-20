<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Tambah Kupon</h1>

<div class="card border-1 shadow-sm position-relative mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-file-earmark-plus-fill"></i>
        <h6 class="m-0 fw-bold px-2">Masukan Kupon Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/tambah-kupon/save" method="post">
            <?= csrf_field(); ?>
            <div class="card mb-4 border-0">
                <div class="card-body shadow-sm">
                    <div class="form-check">
                        <input class="form-check-input btn-outline-danger shadow-sm fs-5 mx-1 my-0" type="checkbox" value="1" name="is_active" id="isActive" <?= (old('is_active') == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label mx-5 fw-bold" for="isActive">
                            Cheklist untuk aktifkan kupon
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <label for="nama_kupon" class="form-label">Judul Kupon<span class="text-danger fs-5">*</span></label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-1'; ?>" id="nama_kupon" name="nama_kupon" placeholder="Nama Kupon Anda" value="<?= old('nama_kupon') ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <label for="kode_kupon" class="form-label">Kode Reveral Kupon<span class="text-danger fs-5">*</span></label>
            <div class="input-group mb-2">
                <input type="text" class="form-control <?= (validation_show_error('kode')) ? 'is-invalid' : 'border-1'; ?>" id="kode_kupon" name="kode_kupon" placeholder="Kode Kupon" value="<?= old('kode_kupon') ?>" aria-describedby="generateKode">
                <button class="btn btn-danger" id="generateKode" type="button">Dapatkan Kode</button>
            </div>
            <div class="invalid-feedback"><?= validation_show_error('kode'); ?></div>
            <div class="mb-2">
                <label for="deskripsi_kupon" class="form-label">Deskripsi Kupon<span class="text-danger fs-5">*</span></label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi_kupon" name="deskripsi_kupon" rows="3" placeholder="Deskripsi Kupon ...." value=""><?= old('deskripsi_kupon') ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>

            <div class="mb-2">
                <label for="" class="form-label">Potongan Harga Kupon<span class="text-danger fs-5">*</span></label>
                <select class="form-select <?= (validation_show_error('discount')) ? 'is-invalid' : 'border-1'; ?>" name="discount" id="">
                    <option value="" selected>Pilih discount</option>
                    <?php for ($i = 5; $i <= 100; $i += 5) : ?>
                        <option value="<?= $i / 100; ?>" <?= (old('discount') == $i / 100) ? 'selected' : ''; ?>><?= $i; ?>%</option>
                    <?php endfor; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('discount'); ?></div>
            </div>
            <div class="mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <label for="total_buy" class="form-label">Minimal Pembelian<span class="text-danger fs-5">*</span></label>
                        <input type="text" class="form-control <?= (validation_show_error('total_buy')) ? 'is-invalid' : 'border-1'; ?>" id="total_buy" name="total_buy" placeholder="total pembelian" value="<?= old('total_buy') ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <div class="invalid-feedback"><?= validation_show_error('total_buy'); ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Maksimal Digunakan<span class="text-danger fs-5">*</span></label>
                        <input type="number" class="form-control <?= (validation_show_error('available_kupon')) ? 'is-invalid' : 'border-1'; ?>" name="available_kupon" value="<?= (old('available_kupon')) ? old('available_kupon') : 1; ?>" id="" placeholder="Mkasimal digunakan">
                        <div class="invalid-feedback"><?= validation_show_error('available_kupon'); ?></div>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger">Tambah Kupon</button>
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