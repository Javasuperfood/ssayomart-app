<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<!-- information -->
<div class="container ml-2">
    <div class="container">
        <h1 class="h3 mb-2 text-gray-800">Manajemen Kupon</h1>
        <p class="mb-4">Kupon kini bisa dikelola dari Pemasaran.
        </p>
    </div>
    <!-- button tambah -->
    <div class="container mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Kupon Anda
        </button>
        <!-- dialog modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tabel -->
    <div class="container mt-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="container text-right">
                    <div class="row row-cols-2">
                        <div class="col"></div>
                        <div class="col">
                            <!-- searchbar -->
                            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Tipe kupon</th>
                                <th>Jumlah Kupon</th>
                                <th>Deskripsi</th>
                                <th>ID Produk</th>
                                <th>Penggunaan/Batas</th>
                                <th>Tanggal Kadaluarsa</th>
                                <th>Kategori</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tbody>
                                <tr>
                                    <td>SS4Y0</td>
                                    <td>Diskon</td>
                                    <td>15</td>
                                    <td>Potongan 15% setiap pembelian minimal Rp.50.000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>24/24/24</td>
                                    <td>-</td>
                                    <td> <a href="#" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </tfoot>
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

    </div>
</div>



<?= $this->endSection(); ?>