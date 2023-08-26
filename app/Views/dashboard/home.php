<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<!-- Table -->
<div class="container mt-4">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Tables User</h6>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#exampleModalCenter">
				Tambah Data
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Tambah data</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<!-- form isi data tambah -->
							<form>
								<div class="form-group">
									<label for="formGroupExampleInput">Masukan Nama</label>
									<input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama">
								</div>
								<div class="form-group">
									<label for="formGroupExampleInput">Masukan Role</label>
									<input type="text" class="form-control" id="formGroupExampleInput" placeholder="Role">
								</div>
								<div class="form-group">
									<label for="formGroupExampleInput">Masukan Status</label>
									<input type="text" class="form-control" id="formGroupExampleInput" placeholder="Status">
								</div>
								<div class="form-group">
									<label for="formGroupExampleInput2">Masukan Gmail</label>
									<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Gmail">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
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
								<td>
									<!-- Edit -->
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
										Edit
									</button>

									<!-- Modal -->
									<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">Edit disini</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													...
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary">Save changes</button>
												</div>
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-danger">Hapus</button>
								</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Jacob</td>
								<td>Thornton@gmail.com</td>
								<td>Admin</td>
								<td>Aktiv</td>
								<td>
									<!-- Edit -->
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
										Edit
									</button>

									<!-- Modal -->
									<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">Edit disini</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													...
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary">Save changes</button>
												</div>
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-danger">Hapus</button>
								</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Larry</td>
								<td>the Bird@gmail.com</td>
								<td>Admin</td>
								<td>Suspend</td>
								<td>
									<!-- Edit -->
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
										Edit
									</button>

									<!-- Modal -->
									<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">Edit disini</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													...
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary">Save changes</button>
												</div>
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-danger">Hapus</button>
								</td>
							</tr>
						</tbody>
					</table>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>