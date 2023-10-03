<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1">Promosi Ssayomart</h1>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Tambah Promo Produk</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/promo/tambah-promo/save" onsubmit="return validasiPromoItem()" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="promo" class="form-label text-secondary">Pilih Promo Tersedia</label>
                        <select name="promo" id="promo" class="form-control shadow-sm border-0">
                            <option value="">Promo 1</option>
                            <option value="">Promo 2</option>
                            <option value="">Promo 3</option>
                        </select>
                        <span id="promoError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="produk" class="form-label text-secondary">Pilih Produk Yang Akan Diberikan Promo</label>
                        <select name="produk" id="produk" class="form-control shadow-sm border-0">
                            <option value="">Produk 1</option>
                            <option value="">Produk 2</option>
                            <option value="">Produk 3</option>
                        </select>
                        <span id="produkError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label text-secondary">Minimal Pembelian (Qty)</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="min" name="min" placeholder="Minimal Pembelian..." value="<?= old('min') ?>">
                        <span id="minError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label text-secondary">Diskon (%)</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="discount" name="discount" placeholder="Jumlah Diskon..." value="<?= old('discount') ?>">
                        <span id="discountError" class="text-danger"></span>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
    function validasiPromoItem() {
        var isValid = true;

        var promoField = document.getElementById('promo');
        var produkField = document.getElementById('produk');
        var minField = document.getElementById('min');
        var discountField = document.getElementById('discount');

        var promoError = document.getElementById('promoError');
        var produkError = document.getElementById('produkError');
        var minError = document.getElementById('minError');
        var discountError = document.getElementById('discountError');

        promoError.textContent = '';
        produkError.textContent = '';
        minError.textContent = '';
        discountError.textContent = '';

        if (promoField.value.trim() === '') {
            promoField.classList.add('invalid-field');
            promoError.textContent = 'Pilihan Promo harus diisi';
            isValid = false;
        } else {
            promoField.classList.remove('invalid-field');
        }

        if (produkField.value.trim() === '') {
            produkField.classList.add('invalid-field');
            produkError.textContent = 'Produk yang akan diberikan promo harus diisi';
            isValid = false;
        } else {
            produkField.classList.remove('invalid-field');
        }

        if (minField.value.trim() === '') {
            minField.classList.add('invalid-field');
            minError.textContent = 'Minimal pembelian harus diisi';
            isValid = false;
        } else {
            minField.classList.remove('invalid-field');
        }

        if (discountField.value.trim() === '') {
            discountField.classList.add('invalid-field');
            discountError.textContent = 'Diskon promo harus diisi';
            isValid = false;
        } else {
            discountField.classList.remove('invalid-field');
        }

        return isValid;
    }
</script>

<?= $this->endSection(); ?>