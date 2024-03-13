<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Report Penjualan</h1>
<p>Berikut ini adalah data penjualan Ssayomart. Anda bisa melihat report penjualan percabang, perkategori->subkategori->produk, dan perdaerah terlaris</p>

<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/dashboard-super-admin" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-10 text-center">
                            <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle">
                                Penjualan Per-Invoice
                            </span>
                        </div>
                        <div class="col-2 text-center">
                            <i class="bi bi-clipboard-data-fill fs-1 text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/category-report" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-10 text-center">
                            <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle">
                                Penjualan Per-Kategori
                            </span>
                        </div>
                        <div class="col-2 text-center">
                            <i class="bi bi-diagram-3-fill fs-1 text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between">
    <div class="card shadow-sm p-3 mb-5 rounded mb-5 col-sm-12">
        <div class="card-header d-flex justify-content-start align-items-center border-1 py-3 bg-white">
            <i class="bi bi-file-text-fill"></i>
            <h6 class="m-0 fw-bold px-2">Data Penjualan Setiap Cabang Ssayomart</h6>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-body mb-4">
                    <!-- Filter -->
                    <div class="mb-1 row">
                        <label for="branchFilter" class="form-label col-sm-2 d-flex align-items-center">Pilih Kategori :</label>
                        <select id="branchFilter" class="form-select mb-3 col-sm-10" aria-label="Select">
                            <option value="">Makanan Instan</option>
                            <option value="">Makanan Kaleng</option>
                            <option value="">Makanan Kemasan</option>
                        </select>
                    </div>

                    <div class="mb-1 row">
                        <label for="branchFilter" class="form-label col-sm-2 d-flex align-items-center">Pilih Sub Kategori :</label>
                        <select id="branchFilter" class="form-select mb-3 col-sm-10" aria-label="Select">
                            <option value="">Kimchi</option>
                            <option value="">Kimchi Goreng</option>
                            <option value="">Kimchi Nori</option>
                            <option value="">Nori Rebus</option>
                            <option value="">Ramyun Kimchi</option>
                        </select>
                    </div>

                    <div class=" mb-1 row">
                        <h4 id="market-text" class="text-center fw-bold"></h4>
                    </div>
                    <!-- Tabel Penjualan -->
                    <div class="row">
                        <div class="col ">
                            <div class="table-responsive table-sm">
                                <table class="table table-bordered text-center fs-6" width="100%" cellspacing="0">
                                    <tbody>
                                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th class="text-center" colspan="3" scope="colgroup">Data Produk</th>
                                                    <th rowspan="2">Total</th>
                                                    <th rowspan="2">Grand Total</th>
                                                    <th rowspan="2">Tanggal</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th scope="colgroup">Kategori</th>
                                                    <th scope="colgroup">Sub Kategori</th>
                                                    <th scope="colgroup">Nama Produk</th>
                                                    <th scope="colgroup">SKU</th>
                                                    <th scope="colgroup">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td scope="colgroup">
                                                        Makanan Instan
                                                    </td>
                                                    <td scope="colgroup">
                                                        Nugget Goreng Rebus
                                                    </td>
                                                    <td scope="colgroup">
                                                        So Good So Nice Kimochi Nugget Tinggal Brewek
                                                    </td>
                                                    <td scope="colgroup">
                                                        91247283691
                                                    </td>
                                                    <td scope="colgroup">
                                                        20
                                                    </td>
                                                    <td>Rp. 200.000</td>
                                                    <td>Rp. 250.000</td>
                                                    <td>12 Desember 2012</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <!-- disini bakal ada code pager -->
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                            <!-- JIKA TABLE KOSONG/TIDAK ADA DATA -->
                            <div class="alert alert-danger text-center mt-2" role="alert">
                                Data penjualan belum tersedia.
                            </div>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <!-- <div class="border-0 col-sm-4 ms-3">
            <div class="card mb-3 shadow-sm p-3 bg-body rounded">
                <div class="card-body">
                    <p class="fw-bold">Data Penjualan Ssayomart</p>
                    <canvas id="myChart" style="background-color: #f7f7f7;"></canvas>
                </div>
            </div>
        </div> -->
</div>

<?= $this->endSection(); ?>
</div>