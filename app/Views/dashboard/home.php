<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

<div class="card border-0 shadow-sm mb-4">
	<div class="card-header border-0 py-3">
		<h6 class="m-0 font-weight-bold text-danger">List Penjualan</h6>
	</div>

	<div class="card-body">
		<div class="mb-3 row">
			<label for="filter" class="form-label col-sm-2">Filter by:</label>
			<select id="filter" class="form-select mb-3 col-sm-10" aria-label="Select">
				<option selected value="monthly">Monthly</option>
				<option value="yearly">Yearly</option>
			</select>
		</div>
		<div class="row">
			<div class="col">
				<div class="table-responsive">
					<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID Checkout</th>
								<th>ID Toko</th>
								<th>ID User</th>
								<th>ID Produk</th>
								<th>Harga Total</th>
								<th>Status Pesan</th>
								<th>Created At</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($checkoutWithProduk as $checkout) : ?>
								<tr>
									<td><?= $checkout->id_checkout; ?></td>
									<td><?= $checkout->id_toko; ?></td>
									<td><?= $checkout->id_user; ?></td>
									<td><?= $checkout->id_produk; ?></td>
									<td><?= $checkout->total_2; ?></td>
									<td><?= $checkout->id_status_pesan; ?></td>
									<td><?= $checkout->created_at; ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- Chart -->
		<div class="card-body col-sm-6">
			<canvas id="myChart"></canvas>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	const ctx = document.getElementById('myChart');
	const filterSelect = document.getElementById('filter');

	// Get total_2 values from PHP and convert to JSON
	const total2Values = <?= json_encode(array_column($checkoutWithProduk, 'total_2')); ?>;
	const months = ['Jan', 'Feb', 'Mar', 'April', 'May', 'June', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
	const year = ['']

	const chartData = {
		labels: months,
		datasets: [{
			label: 'Total',
			data: total2Values,
			borderWidth: 1
		}]
	};

	const myChart = new Chart(ctx, {
		type: 'line',
		data: chartData,
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});

	// filter 
	filterSelect.addEventListener('change', function() {
		const selectedFilter = filterSelect.value;

		if (selectedFilter === 'monthly') {
			myChart.data.labels = months;
			myChart.data.datasets[0].data = total2Values;
		} else if (selectedFilter === 'yearly') {
			//  yearly data
			const yearlyData = [120, 130, 400, 200, 40];
			myChart.data.labels = ['2021', '2022', '2023', '2024'];
			myChart.data.datasets[0].data = yearlyData;
		}

		myChart.update();
	});
</script>

<?= $this->endSection(); ?>