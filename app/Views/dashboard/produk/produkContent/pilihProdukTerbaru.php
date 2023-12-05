<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<style>
    #sortable-list {
        list-style-type: none;
        padding: 0;
    }

    #sortable-list li {
        padding: 10px;
        border: 1px solid #ccc;
        margin-bottom: 5px;
        cursor: pointer;
    }
</style>
<h1 class="h3 mb-2 text-gray-800">Pilih Produk Terbaru</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard/produk/management-fetching-content" class="text-dark">Management Fetching Produk</a></li>
    <li class="breadcrumb-item active text-danger text-decoration-underline">Pilih Produk Terbaru</li>
</ul>

<div class="row">
    <div class="col mb-5">
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-pencil-square"></i>
                <h6 class="m-0 fw-bold px-2">Edit Urutan Produk</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php $s = 1; ?>
                        <form action="<?= base_url('dashboard/produk/pilih-produk-terbaru/save'); ?>" method="post">
                            <div class="fw-bold fs-3 text-secondary mb-3">
                                <div class="row">
                                    <div class="col-md-6">Shorting Produk Terbaru</div>
                                    <div class="col-md-6 text-end"><button type="submit" class="btn btn-danger text rounded-0">Update</button></div>
                                </div>
                            </div>
                            <?= csrf_field(); ?>
                            <ul id="sortable-list">
                                <?php foreach (array_slice($produkTerbaru, 0, 6) as $produk) : ?>
                                    <li draggable="true" ondragstart="dragStart(event, <?= $produk['id_produk']; ?>)" ondrop="dragDrop(event, <?= $produk['id_produk']; ?>)">
                                        <img src="<?= base_url('assets/img/produk/main/' . $produk['img']); ?>" class="img-fluid rounded-2" width="80" height="80">
                                        <strong><?= $produk['nama']; ?></strong>
                                        <input type="hidden" name="id_produk[]" value="<?= $produk['id_produk']; ?>">
                                        <input type="hidden" name="original_order[]" value="<?= $produk['short']; ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ul>


                        </form>
                    </div>
                    <div class="col-md-6">
                        <p class="fw-bold fs-3 text-secondary text-center">Preview</p>
                        <div class="row text-center mt-3 border">
                            <?php foreach (array_slice($produkTerbaru, 0, 6) as $produk) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="mb-3 border">
                                        <!-- Frame smartphone -->
                                        <div class="phone-frame">
                                            <a href="<?= base_url() ?>produk/<?= $produk['slug']; ?>">
                                                <div class="text-bg-light bg-white border-0">
                                                    <div class="px-0 py-0 mx-0 my-0">
                                                        <img src="<?= base_url('assets/img/produk/main/' . $produk['img']); ?>" alt="<?= $produk['nama']; ?>" class="card-img-top">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Informasi produk -->
                                        <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                            <div class="d-flex align-items-start justify-content-center" style=" height: 65px;">
                                                <p class="text-center text-secondary fw-bold " style="font-size: 10px; margin: 0;"><?= substr($produk['nama'], 0, 25); ?></p>
                                            </div>
                                            <?php if (isset($produk['harga_min'])) : ?>
                                                <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                                    <del>Rp. <?= number_format($produk['harga_min'], 0, ',', '.'); ?></del>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
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
    const list = document.getElementById("sortable-list");
    let dragItem = null;

    function dragStart(e, id) {
        dragItem = e.target;
        console.log('startID : ' + id)
        e.dataTransfer.setData("text/plain", e.target.innerHTML);
    };

    list.addEventListener("dragover", function(e) {
        e.preventDefault();
    });

    function dragDrop(e, id) {
        if (e.target.tagName === "LI") {
            e.preventDefault();
            const text = e.dataTransfer.getData("text/plain");
            console.log('dropedID : ' + id)

            dragItem.innerHTML = e.target.innerHTML;
            e.target.innerHTML = text;
        }
    };

    list.addEventListener("dragend", function() {
        dragItem = null;
    });
</script>

<?= $this->endSection(); ?>