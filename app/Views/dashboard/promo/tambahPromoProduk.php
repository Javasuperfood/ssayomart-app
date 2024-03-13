<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Produk Promosi Ssayomart</h1>
<p class="mb-3">Halaman ini menampilkan promosi produk-produk dari Ssayomart.
</p>

 <!-- Right Panel -->
 <div class="col-lg-6 mb-5">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-text-fill"></i>
                <h6 class="m-0 fw-bold px-2">List Promo Produk Ssayomart <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Select a product
                    </button>
                
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">List Promo Produk Ssayomart</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Nama</th>
                                    <th>SKU</th>
                                    </tr>
                                </thead>
                                <?php $counter = 1; ?>
                                <tbody>
                                    <?php foreach($produkSearch as $p): ?>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td>
                                            <img src="<?= base_url('assets/img/produk/main/' . $p['img']); ?>" class="img-fluid" alt="" width="50" height="50">
                                        </td>
                                        <td><?= $p['nama']; ?></td>
                                        <td><?= $p['sku']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger">Save</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </h6>
            </div>
            <div class="card-body mt-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">Img</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">SKU</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td >1</td>
                            <td class="text-center">Samyang</td>
                            <td class="text-center">44556789</td>
                            <td class="text-center">12.000</td>
                            <td class="d-flex">
                                <div class="ms-auto">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btnChooseProducts">Create Bundle</button>
                                <!-- Modal Box Produk -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <button type="button" class="btn btn-outline-danger">Delete</button>
                                </form>
                                </div>
                               
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" >Bundling Promo
                                <!-- Span Badge Produk Terpilih -->
                                <div class="mb-4">
                                    <!-- <label for="produk" class="form-label">Produk-Produk Terpilih</label> -->
                                    <div id="selectedProds1" style="font-size: 13px;"></div>
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
                                            <th>Img</th>
                                            <th>Nama</th>
                                            <th>SKU</th>
                                        </tr>
                                    </thead>
                                        <tr>
                                            <td>1</td>
                                            <td >Kimchi</td>
                                            <td >7789316</td>
                                            <!-- <td class="text-end">
                                                <div class="nav-item dropdown no-arrow">
                                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a>
                                                </div>
                                            </td> -->
                                            <td>12.000</td>
                                        </tr>

                                </table>
                            </td>
                        </tr>

                    </tbody>
                </table>
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


    var checkAll = document.getElementById('checkAll');
    var checkboxes = document.getElementsByName('check_id[]');
    checkAll.addEventListener('change', function() {
        var isChecked = checkAll.checked;
        if (isChecked) {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = isChecked;
                createInputField(true, 'fieldDelete', checkboxes[i].value)
            }
            btnDelete(true);
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = isChecked;
                createInputField(false, 'fieldDelete', checkboxes[i].value)
            }
            btnDelete(false);
        }
    });

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var atLeastOneChecked = false;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    atLeastOneChecked = true;
                }
            });
            if (atLeastOneChecked) {
                btnDelete(true);
            } else {
                btnDelete(false);
            }
        });
    });

    function checkPromo(id) {
        var checkbox = document.getElementById('checkPromo_' + id);
        if (checkbox.checked) {
            createInputField(true, 'fieldDelete', id)
        } else {
            createInputField(false, 'fieldDelete', id)
        }
    }


    function btnDelete(a) {
        if (a) {
            $("#btnDelete").show()
        } else {
            $("#btnDelete").hide()
        }
    }

    function createInputField(create, appendLocId, id) {
        if (create) {
            var inputField = document.getElementById('promo_id_' + id);
            if (!inputField) {
                var inputElement = document.createElement('input');
                inputElement.setAttribute('type', 'hidden');
                inputElement.setAttribute('name', 'promo_id[]');
                inputElement.setAttribute('id', 'promo_id_' + id);
                inputElement.setAttribute('value', id);
                var fieldDelete = document.getElementById(appendLocId);
                fieldDelete.appendChild(inputElement);
            }
        } else {
            var inputField = document.getElementById('promo_id_' + id);
            if (inputField) {
                inputField.remove();
            }
        }
    }
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