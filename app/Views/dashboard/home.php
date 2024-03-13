<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<?php if (!empty($getStockWithProduct)) : ?>
	<h1 class="h3 mb-3 text-gray-800">Stok Produk Ssayomart - <?= $getStockWithProduct[0]['lable'] ?></h1>
<?php else : ?>
	<h1 class="h3 mb-3 text-gray-800">Stok Produk Ssayomart</h1>
<?php endif; ?>
<p>Berikut adalah data stok produk-produk Ssayomart.</p>

<div class="d-flex justify-content-between">
	<div class="card shadow-sm p-3 mb-5 bg-white rounded mb-5 col-sm-8">
		<div class="card-header d-flex justify-content-start bg-white align-items-center border-1 py-3">
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
				<div class="col ">
					<div class="table-responsive table-sm">
						<table class="table table-bordered text-center fs-6" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th class="text-start">Nama Produk</th>
									<th class="text-start">Variasi Item</th>
									<th class="text-end">Stok</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($getStockWithProduct as $stock) : ?>
									<tr>
										<td class="align-middle"><?= $iterasi++; ?></td>
										<td class="text-start"><?= $stock['nama']; ?></td>
										<td class="text-start"><?= $stock['value_item']; ?></td>
										<td class="text-end"><?= $stock['stok']; ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						<?= $pager->links('stock', 'pagerS') ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Chart -->
	<div class="border-0 col-sm-4 ms-3">
		<div class="card mb-3 shadow-sm p-3 bg-body rounded">
			<div class="card-body">
				<p class="fw-bold">Stok Produk Ssayomart</p>
				<canvas id="myChart" style="background-color: #f7f7f7;"></canvas>
			</div>
		</div>
		<div class="card shadow-sm p-3 mb-5 bg-body rounded">
			<div class="card-body">
				<p class="fw-bold">Most Loved Products</p>
				<?php foreach ($getFeaturedProducts as $fp) : ?>
					<div class="card mb-3">
						<div class="d-flex align-items-center">
							<div>
								<img src="<?= base_url() ?>assets/img/produk/main/<?= $fp['img']; ?>" width="100" alt="">
							</div>
							<div>
								<p class="align-middle fw-semibold"><?= $fp['nama']; ?></p>
								<i class="bi bi-star-fill" style="color: #ec261f;"></i>
								<i class="bi bi-star-fill" style="color: #ec261f;"></i>
								<i class="bi bi-star-half" style="color: #ec261f;"></i>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	const ctx = document.getElementById('myChart');
	const filterSelect = document.getElementById('filter');

	const quantityData = <?= json_encode(array_column($getStockWithProduct, 'stok')); ?>;
	const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ag', 'Sep', 'Oct'];

	const initialChartData = {
		labels: months,
		datasets: [{
			label: 'Stok',
			data: quantityData,
			borderWidth: 1,
			borderColor: '#ec261f',
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