<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>


<h1 class="h3 mb-3 text-gray-800">Region Report</h1>
<p>Berikut ini adalah data laporan Penjualan per Regional</p>
<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/dashboard-super-admin" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-10 text-center">
                            <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle fw-bold">
                                Penjualan Per-Invoice
                            </span>
                        </div>
                        <div class="col-2 text-center">
                            <i class="bi bi-clipboard-data-fill fs-1 text-danger"></i>
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
                            <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle fw-bold">
                                Penjualan Per-Kategori
                            </span>
                        </div>
                        <div class="col-2 text-center">
                            <i class="bi bi-diagram-3-fill fs-1 text-danger"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <h6 class="m-0 font-weight-bold px-2">Form DataTabel Region</h6>
            </div>
            <div class="card-body">
                <form>
                    <fieldset>
                        <legend>Report Data Produk Per Region</legend>

                        <div class="mb-3">
                            <label for="disabledSelect" class="form-label">Pilih Kecamatan / Kab.</label>
                            <select id="disabledSelect" class="form-select">
                                <option>Tigaraksa</option>
                                <option>Kelapa Dua</option>
                                <option>Cibodas</option>
                                <option>Cikokol</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="disabledSelect" class="form-label">Pilih Bulan / Tahun</label>
                            <select id="disabledSelect" class="form-select">
                                <option>Januari</option>
                                <option>Februari</option>
                                <option>Maret</option>
                                <option>April</option>
                            </select>
                        </div>
                    </fieldset>
                </form>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive table-sm">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Nama User</th>
                                        <th>Terjual</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Makaroni Pedas</td>
                                        <td>Aming</td>
                                        <td>25 Pcs</td>
                                        <td>Rp. 30.000</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Makaroni Manis</td>
                                        <td>Aming</td>
                                        <td>25 Pcs</td>
                                        <td>Rp. 25.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-5">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-pie-chart"></i>
                <h6 class="m-0 fw-bold px-2">Pie Chart Report Region</h6>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <!-- Canvas element for the pie chart -->
                <canvas id="pieChart" width="500"></canvas>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Region A', 'Region B', 'Region C'],
            datasets: [{
                data: [10, 20, 30],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>


<?= $this->endSection(); ?>