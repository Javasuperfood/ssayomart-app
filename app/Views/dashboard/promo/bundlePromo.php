<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<h1 class="h3 mb-3 text-gray-800">Tambah Promosi Bundle</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item"><a class="text-danger" href="<?= base_url(); ?>dashboard/promo">List Promo</a></li>
    <li class="breadcrumb-item text-danger active text-decoration-underline">Tambah Promosi Bundle</li>
</ul>
<div class="col-lg-12 mb-4">
    <div class="card position-relative border-1 shadow-sm">
        <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
            <i class="bi bi-tags-fill text-danger fs-5"></i>
            <h6 class="m-0 fw-bold px-2 text-dark">List Produk Bundle</h6>
            <a href="<?= base_url() ?>dashboard/promo/tambah-promo" class="btn btn-outline-danger ms-2"><i class="bi bi-plus-circle text-danger"></i>&nbsp;Tambah Promo Produk</a>
        </div>

        <div class="card-body">
            <?php foreach ($promoProduk as $pp) : ?>
                <form action="<?= base_url('dashboard/promo/tambah-promo/save-produk-bundle') ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_promo" value="<?= $pp['id_promo']; ?>">
                    <input type="hidden" name="id_promo_produk" value="<?= $pp['id']; ?>">
                    <input type="hidden" name="id_produk" value="<?= $pp['id_produk']; ?>">
                    <input type="hidden" name="produk_id" value="">
                    <div class="mt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">SKU</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <?php $counter = 1; ?>
                            <tbody>
                                <tr>
                                    <td><?= $counter++; ?></td>
                                    <td class="text-center">
                                        <img src="<?= base_url('assets/img/produk/main/' . ($pp['img'])); ?>" class="img-fluid" alt="" width="50" height="50">
                                    </td>
                                    <td class="text-center"><?= $pp['nama']; ?></td>
                                    <td class="text-center"><?= $pp['sku']; ?></td>
                                    <td>
                                        <div class="d-flex flex-column align-items-end">

                                            <button type="button" class="btn btn-outline-danger mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $pp['id_produk']; ?>" id="btnChooseProducts"><i class="bi bi-plus-circle text-danger"></i>&nbsp;Produk Bundling</button>
                                            <!-- Modal Box Produk -->
                                            <div class="modal fade" id="exampleModal<?= $pp['id_produk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">List Produk Tersedia</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <!-- Input pencarian -->
                                                            <div class="mb-3">
                                                                <input type="text" id="searchProduct" oninput="searchProduk(this)" class="form-control" placeholder="Cari produk berdasarkan nama...">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div id="inputproduk"></div>
                                                                    <div id="selectedProds2" style="font-size: 13px;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="productList">
                                                                <!-- Daftar produk akan ditampilkan di sini -->
                                                                <?php foreach ($produk as $item) : ?>
                                                                    <div class="col-6 mb-3 px-3">
                                                                        <div class="card border-0">
                                                                            <div class="row g-0">
                                                                                <div class="card-body border-0 shadow-sm">
                                                                                    <div class="row">
                                                                                        <div class="col-1 d-flex justify-content-center">
                                                                                            <input onchange="selectCheck(this, '<?= $item['nama']; ?>')" type="checkbox" id="produkCheckbox<?= $item['id_produk']; ?>" value="<?= $item['id_produk']; ?>" data-nama="<?= $item['nama']; ?>" class="border-0" style="width: 30px;">
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <img src="<?= base_url('assets/img/produk/main/' . $item['img']); ?>" alt="<?= $item['nama']; ?>" class="img-fluid" style="width:100px; height:100px; object-fit: contain; object-position: 20% 10%;">
                                                                                        </div>
                                                                                        <div class="col-8">
                                                                                            <p class="nama-produk" style="font-size: 12px;"><?= $item['nama']; ?></p>
                                                                                            <?php foreach ($variasi as $v) : ?>
                                                                                                <?php if ($v['id_variasi_item'] == $item['id_produk']) : ?>
                                                                                                    <p class="harga" style="font-size: 14px;">Harga: Rp. <?= number_format($v['harga_item'], 0, ',', '.'); ?></p>
                                                                                                <?php endif; ?>
                                                                                            <?php endforeach; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>

                                                            <!-- Pesan "Produk tidak tersedia" -->
                                                            <div id="noProductAlert" class="alert alert-danger rounded border-0" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-1">
                                                                        <i class="bi bi-exclamation-triangle-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i>
                                                                    </div>
                                                                    <div class="col-10 text-center">
                                                                        <span class="fs-6">Produk tidak tersedia!</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger text-center" data-bs-dismiss="modal">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="fw-bold text-uppercase text-center">Bundling Promo
                                        <!-- Span Badge Produk Terpilih -->
                                        <div class="mb-4">
                                            <!-- <label for="produk" class="form-label">Produk-Produk Terpilih</label> -->
                                            <div id="selectedProds1<?= $pp['id_produk']; ?>" style="font-size: 13px;"></div>
                                            <span id="produkError" data-toggle="tooltip" data-placement="bottom" title="produk yang di pilih" class="text-danger"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <table class="table mb-0 table-light">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Image</th>
                                                    <th>Nama</th>
                                                    <th>SKU</th>
                                                </tr>
                                            </thead>
                                            <?php $i = 1; ?>
                                            <?php foreach ($produkBundle as $pb) : ?>
                                                <?php if ($pb['id_main_produk'] == $pp['id_produk']) : ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td>
                                                            <img src="<?= base_url('assets/img/produk/main/' . ($pb['img'])); ?>" class="img-fluid" alt="" width="50" height="50">
                                                        </td>
                                                        <td><?= $pb['nama_produk']; ?></td>
                                                        <td><?= $pb['sku']; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                <form action="<?= base_url() ?>dashboard/promo/tambah-promo/delete-promo-produk/<?= $pp['id']; ?>" method="post" class="d-block my-3">
                    <?= csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash-fill text-danger"></i>&nbsp;Delete</button>
                </form>
            <?php endforeach; ?>
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
</script>

<script>
    var arrayProduk = [];

    function selectCheck(e, nameProduk) {
        const produkChecked = e.value;
        // console.log(produkChecked)
        // console.log(arrayProduk)
        const isAlreadyChecked = arrayProduk.some(ap => ap[0] === produkChecked);
        if (!e.checked || isAlreadyChecked) {
            arrayProduk = arrayProduk.filter(ap => ap[0] !== produkChecked);
        } else {
            addValue(produkChecked, nameProduk);
        }

        const $inputProduk = $('#inputproduk');
        const $selectedProds1 = $('#selectedProds1');
        const $selectedProds2 = $('#selectedProds2');
        $inputProduk.empty();
        $selectedProds1.empty();
        $selectedProds2.empty();
        arrayProduk.forEach(function([value, nama]) {
            $inputProduk.append(`<input type="hidden" name="produk_id[]" value="${value}">`);
            $selectedProds1.append(`<span class="badge rounded-pill text-bg-danger mb-2 px-2 py-2 mx-1">${nama}</span>`);
            $selectedProds2.append(`<span class="badge rounded-pill text-bg-danger mb-2 px-2 py-2 mx-1">${nama}</span>`);
        });

    }

    function addValue(value, nama) {
        arrayProduk.push([value, nama]);
    }

    function removeValue(value, nama) {
        const index = arrayProduk.findIndex(ap => ap[0] === value && ap[1] === nama);
        if (index !== -1) {
            arrayProduk.splice(index, 1);
        }
    }

    function searchProduk(e) {
        // console.log(this.value);
        const keyword = e.value;

        if (keyword.length > 2) {
            request(keyword);
        } else if (keyword.length == 0) {
            request()
        }
    }

    function request(keyword = null) {
        $.ajax({
            type: "GET",
            url: "<?= base_url(); ?>api/getproduct",
            contentType: "application/json",
            data: {
                search: keyword
            },
            success: function(responseData) {
                $(`#productList`).empty();
                responseData.response.forEach(function(p) {
                    let checked = arrayProduk.find(ap => p.id_produk === ap[0]) !== undefined;
                    $('#productList').append(`
                         <div class="col-6 mb-3 px-3 p${p.id_produk}">
                            <div class="card border-0">
                                <div class="row g-0">
                                    <div class="card-body border-0 shadow-sm">
                                        <div class="row">
                                            <div class="col-1 d-flex justify-content-center">
                                                <input ${(checked) ? 'checked' : ''} onchange="selectCheck(this, '${p.nama}')" type="checkbox" id="produkCheckbox${p.id_produk}" value="${p.id_produk}" data-nama="${p.nama}" class="border-0" style="width: 30px;">
                                            </div>
                                            <div class="col-3">
                                                <img src="<?= base_url('assets/img/produk/main/'); ?>${p.img}" alt="${p.nama}" class="img-fluid" style="width:100px; height:100px; object-fit: contain; object-position: 20% 10%;">
                                            </div>
                                            <div class="col-8">
                                                <p class="fs-4 nama-produk" style="font-size: 18px;">${p.nama}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                        `)
                })
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    }
</script>

<?= $this->endSection(); ?>