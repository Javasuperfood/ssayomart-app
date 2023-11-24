<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Dashboard</h1>

<div class="card border-1 shadow-sm mb-5">
	<div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
		<i class="bi bi-file-text-fill"></i>
		<h6 class="m-0 fw-bold px-2">List Stok Produk</h6>
	</div>

	<div class="card-body">
		<div class="mb-4 row">
			<label for="filter" class="form-label col-sm-2 d-flex align-items-center">Urutkan berdasarkan:</label>
			<select id="filter" class="form-select mb-3 col-sm-10" aria-label="Select">
				<option selected value="monthly">Bulan</option>
				<option value="yearly">Tahun</option>
			</select>
		</div>
		<div class="row">
			<div class="col col-sm-6">
				<div class="table-responsive">
					<table class="table table-bordered text-center fs-6" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No.</th>
								<th>Toko</th>
								<th>Nama Produk</th>
								<th>Variasi Item</th>
								<th>Stok</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($getStockWithToko as $checkout) : ?>
								<tr>
									<td class="align-middle"><?= $iterasi++; ?></td>
									<td class="align-middle"><?= $checkout->lable; ?></td>
									<td class="align-middle"><?= $checkout->nama; ?></td>
									<td class="align-middle"><?= $checkout->value_item; ?></td>
									<td class="align-middle"><?= $checkout->stok; ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<?= $pager->links('dashboard', 'pagerS') ?>
				</div>
			</div>

			<!-- Chart -->
			<div class="card-body col-sm-6">
				<canvas id="myChart"></canvas>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	const ctx = document.getElementById('myChart');
	const filterSelect = document.getElementById('filter');

	const quantityData = <?= json_encode(array_column($getStockWithToko, 'stok')); ?>;
	const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ag', 'Sep', 'Oct', 'Nov', 'Des'];

	const initialChartData = {
		labels: months,
		datasets: [{
			label: 'Stok',
			data: quantityData,
			borderWidth: 1
		}]
	};

	const myChart = new Chart(ctx, {
		type: 'line',
		data: initialChartData,
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});

	const initialSelectedFilter = filterSelect.value;
	filterSelect.value = '';
	filterSelect.value = initialSelectedFilter;

	// filter
	filterSelect.addEventListener('change', function() {
		const selectedFilter = filterSelect.value;

		if (selectedFilter === 'monthly') {
			myChart.data.labels = months;
			myChart.data.datasets[0].data = quantityData;
		} else if (selectedFilter === 'yearly') {
			// dummy yearly data
			const yearlyQuantityData = [120, 130, 400, 200, 40];
			myChart.data.labels = ['2021', '2022', '2023', '2024'];
			myChart.data.datasets[0].data = yearlyQuantityData;
		}

		myChart.update();
	});
</script>

<?= $this->endSection(); ?>