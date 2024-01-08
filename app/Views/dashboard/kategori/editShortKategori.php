<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<style>
    #sortable-list {
        list-style-type: none;
        padding: 0;
    }

    #sortable-list li {
        padding: 10px;
        border: 0px solid #ccc;
        margin-bottom: 5px;
        cursor: pointer;
    }
</style>
<h1 class="h3 mb-2 text-gray-800">Update Sorting</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item text-secondary">Dashboard</li>
    <li class="breadcrumb-item text-danger"><a class="text-secondary" href="<?= base_url(); ?>dashboard/kategori">Kategori</a></li>
    <li class="breadcrumb-item text-danger active text-decoration-underline"><a class="text-danger" href="<?= base_url(); ?>dashboard/kategori/shorting">Update Sorting</a></li>
</ul>
<div class="row">
    <div class="col mb-5">
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-pencil-square"></i>
                <h6 class="m-0 fw-bold px-2">Edit urutan katgori</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php $s = 1; ?>
                        <form action="<?= base_url('dashboard/kategori/shorting/save'); ?>" method="post">
                            <div class="fw-bold fs-3 text-secondary mb-3">
                                <div class="row">
                                    <div class="col-md-6">Sorting Kategori</div>
                                    <div class="col-md-6 text-end"><button type="submit" class="btn btn-danger text rounded-0" onclick="clickSubmitEvent(this)">Update</button></div>
                                </div>
                            </div>
                            <?= csrf_field(); ?>
                            <ul id="sortable-list">
                                <?php foreach ($kategori as $k) : ?>
                                    <li class="shadow-sm" draggable="true" ondragstart="dragStart(event, <?= $k['id_kategori']; ?>)" ondrop="dragDrop(event, <?= $k['id_kategori']; ?>)">
                                        <i class="bi bi-arrow-up"></i><i class="bi bi-arrow-down"></i>
                                        <img src="<?= base_url('assets/img/kategori/' . $k['img']); ?>" class="img-fluid" alt="" width="50" height="50">
                                        <strong><?= $k['nama_kategori'] ?></strong>
                                        <input type="hidden" name="id_kategori[]" value="<?= $k['id_kategori']; ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <p class="fw-bold fs-3 text-secondary text-center">Preview</p>
                        <div class="row text-center row-cols-3 mt-3 border-0 shadow-sm">
                            <?php foreach ($kategori as $k) : ?>
                                <div class="col-4 col-md-4 col-lg-2">
                                    <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                                        <div class="text-bg-light mb-3 bg-white border-0">
                                            <div class="px-0 py-0 mx-0 my-0">
                                                <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" alt="Kategori" class="card-img-top">
                                            </div>
                                        </div>
                                    </a>
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