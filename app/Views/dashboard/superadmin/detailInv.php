<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <i class="bi bi-ticket-detailed text-danger fs-1 fw-bold mx-2"></i>
                <h3 class="d-inline-block fw-bold align-middle">Detail Invoice</h3>
            </div>
            <hr class="mb-3 border-danger" style="border-width: 3px;">
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body text-center mt-5">
                    <img src="<?= base_url() ?>assets/img/pic/default.png" alt="profile" class="rounded-circle img-fluid mb-5" style="width: 150px; height: 150px;">
                    <h3 class="fw-bold  fs-5">AMING Anto Gamming</h3>
                    <div class="row row-cols-1">
                        <div class="col">
                            <a href="#" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0">JL.Ngalor-Ngidul</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <h3 class="text-center mb-5">KETERANGAN INVOICE</h3>
                    <!-- Input groups -->
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="nama produk" disabled>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="formGroupExampleInput2" class="form-label">SKU</label>
                            <input type="text" class="form-control" placeholder="SKU" aria-label="sku" disabled>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput3" class="form-label">QTY</label>
                            <input type="text" class="form-control" placeholder="QTY" aria-label="qty" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formGroupExampleInput4" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="formGroupExampleInput4" placeholder="harga" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button Back -->
<div class="row mt-4 mb-4">
    <div class="col text-center">
        <button type="button" class="btn btn-danger mt-4"><i class="bi bi-arrow-left-square"></i> Back</button>
    </div>
</div>



<?= $this->endSection(); ?>