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
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3 bg-white">
                <i class="bi bi-file-earmark-plus-fill text-danger"></i>
                <h6 class="m-0 px-2 text-secondary fw-bold">Form Data Tabel Region</h6>
            </div>
            <div class="card-body">
                <form>
                    <fieldset>
                        <legend>Report Data Produk Per Region</legend>

                        <div class="mb-3">
                            <div class="form-group mb-3">
                                <label for="province" class="form-label">Pilih Provinsi</label>
                                <select class="form-select" id="provinsi" name="id_provinsi">
                                    <option selected>Pilih Provinsi</option>
                                    <?php foreach ($provinsi as $p) : ?>
                                        <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group mb-3">
                                <label for="kabupaten" class="form-label">Pilih Kabupaten/Kota</label>
                                <select class="form-select" id="kabupaten" name="id_kabupaten">
                                    <option selected>Pilih Kabupaten/Kota</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Pilih Tanggal</label>
                            <input type="date" id="date" class="form-select">
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
                                    <?php if (!empty($salesData)) : ?>
                                        <?php foreach ($salesData as $index => $checkout) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $checkout['product_name'] ?></td>
                                                <td><?= $checkout['buyer_name'] ?></td>
                                                <td><?= $checkout['quantity'] ?></td>
                                                <td>Rp. <?= number_format($checkout['price'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5">
                                                <div class="alert alert-danger text-center" role="alert">
                                                    <span class="fw-bold">
                                                        Tidak ada data penjualan yang ditemukan
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
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
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3 bg-white">
                <i class="bi bi-pie-chart-fill text-danger"></i>
                <h6 class="m-0 fw-bold px-2 text-secondary">Pie Chart Report Region</h6>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <!-- Canvas element for the pie chart -->
                <canvas id="reportRegionChart" width="500"></canvas>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var salesData = <?= json_encode($salesData) ?>;

    var labels = [];
    var data = [];

    salesData.forEach(function(item) {
        labels.push(item.city);
        data.push(item.total);
    });

    var ctx = document.getElementById('reportRegionChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
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

<script>
    $('document').ready(function() {
        var jumlah = 1;
        $("#provinsi").on('change', function() {
            const provinsiDropdown = document.getElementById('provinsi');
            const kabupatenDropdown = document.getElementById('kabupaten');

            kabupatenDropdown.innerHTML = '<option selected></option>';
            $("#kabupaten").empty();
            var id_province = $(this).val();
            $.ajax({
                url: "<?= base_url('api/getcity') ?>",
                type: 'GET',
                data: {
                    'id_province': id_province,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var results = data["rajaongkir"]["results"];
                    for (var i = 0; i < results.length; i++) {
                        $("#kabupaten").append($('<option>', {
                            value: results[i]["city_id"],
                            text: results[i]["type"] + ' ' + results[i]["city_name"]
                        }));
                    }
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>