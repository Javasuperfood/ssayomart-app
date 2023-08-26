<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>


<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Input Banner</h1>
    <p class="mb-4">Halaman ini merupakan, halaman untuk anda dapat mengganti tampilan pada user tentang promo dan juga informasi slider banner silahkan inputan ketika ada perubahan semangat admin ❤</p>
</div>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Input</h1>
    <p class="mb-4">Silahkan inputkan gambar pada button (unggah) dan hapus pada "button" Hapus
        For more information about SSayomart, please visit the <a target="_blank" href="https://datatables.net">official SSayomart</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Banner</h6>
        </div>
        <div class="container mt-5">
            <!-- Tombol untuk memicu modal -->
            <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#myModal">
                Add +
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Contoh Modal Bootstrap</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form di dalam modal -->
                            <form>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Gambar</label>
                                    <input type="File" class="form-control" id="gambar" placeholder="Masukkan Gambar">
                                </div>
                                <div class="mb-3">
                                    <label for="posisi" class="form-label">Posisi</label>
                                    <input type="text" class="form-control" id="posisi" placeholder="Masukkan posisi">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">tanggal</label>
                                    <input type="date" class="form-control" id="posisi" placeholder="Masukkan tanggal">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Posisi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                        </tfoot>
                        <tr>
                            <td><img src="<?= base_url() ?>assets/img/produk/p7.png" class="img-fluid" alt="" width="200" height="200"></td>
                            <td>Banner </td>
                            <td>24/24/24</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Edit
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="file" class="form-label">Gambar</label>
                                                        <input type="File" class="form-control" id="gambar" placeholder="Masukkan Gambar">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="posisi" class="form-label">Posisi</label>
                                                        <input type="text" class="form-control" id="posisi" placeholder="Masukkan posisi">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tanggal" class="form-label">tanggal</label>
                                                        <input type="date" class="form-control" id="posisi" placeholder="Masukkan tanggal">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-danger" type="button">Hapus</button>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>

</div>



<?= $this->endSection(); ?>