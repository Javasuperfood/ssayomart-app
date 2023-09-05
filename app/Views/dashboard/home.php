<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Manajement User</h1>
<p class="mb-4">Halaman ini hanya dapat di operasikan oleh Super Admin, disini anda sebagai Super Admin dapat mengelola user sebagai pengelola produk atau menjadi admin</p>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Produk</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<!-- searchbar -->
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-3">
				<form class="form-inline ml-auto">
					<div class="input-group">
						<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn btn-primary" type="button">
								<i class="fas fa-search fa-sm"></i>
							</button>
						</div>
					</div>
				</form>
			</nav>
			<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama</th>
						<th scope="col">Gmail</th>
						<th scope="col">Role</th>
						<th scope="col">Status</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Agus Sudegnder</td>
						<td>Agus@gmail.com</td>
						<td>Admin</td>
						<td>Aktiv</td>
						<td><a href="#" class="btn btn-warning btn-circle btn-sm">
								<i class="fas fa-pen"></i>
							</a>
							<a href="#" class="btn btn-danger btn-circle btn-sm">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-end">
					<li class="page-item">
						<a class="page-link" href="#" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item">
						<a class="page-link" href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>