<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Kupon</h1>
<p class="mb-4">Silahkan inputkan kupon masukan apa yang sedang di promosikan maupun di diskon.</p>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Kupon
</button>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kupon</h6>
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
                        <th>Kode</th>
                        <th>Tipe kupon</th>
                        <th>Jumlah Kupon</th>
                        <th>Deskripsi</th>
                        <th>ID Produk</th>
                        <th>Penggunaan/Batas</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
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