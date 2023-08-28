<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<!-- koding here -->
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tabel Produk</h1>
<p class="mb-4">Halaman ini dapat menampilkan produk dari ssayomart market disini anda sebagai admin dapat mengatur dan menglola produk yang akan tampil pada halaman user berikan produk terbaikmu
    <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
</p>
<div class="container mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tables Produk</h6>
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
                                    <label for="formGroupExampleInput">Masukan Gambar Produk</label>
                                    <input type="file" class="form-control" id="formGroupExampleInput" placeholder="Masukan Gambar">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Masukan Nama Produk</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukan Nama Produk">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Masukan Kategori</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukan Kategori">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Masukan Sub Kategori</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukan Sub Kategori">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Masukan Harga</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukan Harga">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Masukan Tanggal EXP</label>
                                    <input type="date" class="form-control" id="formGroupExampleInput2" placeholder="Masukan Sub Kategori">
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
                                <th scope="col">Gambar Produk</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Sub Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Tanggal Kadaluarsa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td><img src="<?= base_url() ?>assets/img/bg3.jpg" alt="" width="50" height="50"></td>
                                <td>Contoh1</td>
                                <td>Kat.Contoh</td>
                                <td>Kat.SubContoh</td>
                                <td>Rp.1000</td>
                                <td>12/12/2012</td>
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
                                <th scope="row">1</th>
                                <td><img src="<?= base_url() ?>assets/img/bg3.jpg" alt="" width="50" height="50"></td>
                                <td>Contoh1</td>
                                <td>Kat.Contoh</td>
                                <td>Kat.SubContoh</td>
                                <td>Rp.1000</td>
                                <td>12/12/2012</td>
                                <td>
                                    <!-- Edit -->
                                    <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#exampleModalCenter">
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