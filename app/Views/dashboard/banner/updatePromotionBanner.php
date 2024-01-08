<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Edit Banner Promotion</h1>
<ul class="breadcrumb bg-light ps-0">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard/banner/list-banner" class="text-dark">Management Banner</a></li>
    <li class="breadcrumb-item active"><a href="<?= base_url() ?>dashboard/banner/promotion-banner" class="text-dark">Banner Promotion</a></li>
    <li class="breadcrumb-item active text-danger text-decoration-underline">Edit Banner Promotion</li>
</ul>
<p>Anda dapat mengatur banner promotion yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.</p>
<div class="alert alert-danger text-center border-1 my-4 shadow-sm" role="alert">
    <b>Note : Perhatikan ukuran dan resolusi banner sebelum upload ke Aplikasi Ssayomart Supermarket. Disarankan agar menghubungi tim Design untuk penambahan Banner.</b>
</div>

<div class="card border-0 shadow-sm border-left-danger mb-4">
    <div class="card-header border-0 py-3 bg-white">
        <h5 class=" mb-0">Detail Promotion Banner</h5>
    </div>
    <div class="row">
        <div class="card-body d-flex">
            <div class="col text-center">
                <img src="<?= base_url() ?>assets/img/banner/promotion/<?= $bl['img'] ?>" class="mx-auto d-block rounded-3" width="800" height="300">
            </div>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center my-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 py-3">
                <h5 class="mb-0">Edit Promotion Banner</h5>
            </div>
            <div class="card-body border-0 w-100">
                <form action="<?= base_url(); ?>dashboard/banner/update-promotion-banner/update/<?= $bl['id_banner_promotion'] ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control border-0 shadow-sm" id="id_banner_promotion" name="id_banner_promotion" value="<?= $bl['id_banner_promotion'] ?>">
                    <div class="mb-3">
                        <label for="banner">Judul Banner</label>
                        <input type="text" class="form-control border-1 <?= (validation_show_error('title')) ? 'is-invalid' : 'border-1'; ?>" id="title" name="title" rows="3" placeholder="Judul untuk banner Anda..." value="<?= $bl['title'] ?>"></input>
                        <div class="invalid-feedback"><?= validation_show_error('title'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar Promotion Banner</label>
                        <input type="file" class="form-control border-1 <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img" name="img" value="<?= $bl['img'] ?>" accept="image/*">
                        <input type="hidden" name="imageLama" value="<?= $bl['img']; ?>">
                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="img_promo" class="form-label">Gambar Content Promotion Banner</label>
                        <input type="file" class="form-control border-1 <?= (validation_show_error('img_promo')) ? 'is-invalid' : 'border-1'; ?>" id="img_promo" name="img_promo" value="<?= $bl['img_promo'] ?>" accept="image/*">
                        <input type="hidden" name="imagePromoLama" value="<?= $bl['img_promo']; ?>">
                        <div class="invalid-feedback"><?= validation_show_error('img_promo'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control border-1 <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi banner promosi Anda..." value="<?= $bl['deskripsi'] ?>"></input>
                        <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
                    </div>
                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class=" col-md-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 py-3">
                <h5 class="mb-0 text-center">Content</h5>
            </div>
            <div class="card-body border-0 rounded-5 text-center">
                <img src="<?= base_url() ?>assets/img/banner/promotion/content/<?= $bl['img_promo'] ?>" class="img-thumbnail rounded-5" alt="Thumbnail Image" style="width: 400px;">
            </div>
            <div class="card border-0">
                <div class="card border-0">
                    <div class="card-body border-0">
                        <div class="row">
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= $bl['title'] ?>" disabled>
                                    <label for="judul_blog">Judul</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <?php
                                    // Memformat waktu dari $bl['created_at'] menjadi format tanggal-bulan-tahun dengan nama bulan
                                    $formattedDate = date('d F Y', strtotime($bl['created_at']));
                                    ?>
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= $formattedDate ?>" disabled>
                                    <label for="tanggal_dibuat">Dipublikasikan</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= $bl['deskripsi'] ?>" disabled>
                                    <label for="slug">Deskripsi</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 my-3 text-center">
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteBanner<?= $bl['id_banner_promotion']; ?>">
                                    <i class="bi bi-trash-fill"> Hapus Banner & Konten </i>
                                </a>
                            </div>
                            <!-- ================= START MODAL DELETE SINGLE GAMBAR ================== -->
                            <div class="modal fade" id="deleteBanner<?= $bl['id_banner_promotion']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBanner<?= $bl['id_banner_promotion']; ?>" aria-hidden="true">
                                <div class="modal-dialog text-start text-secondary" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteBanner<?= $bl['id_banner_promotion']; ?>">Delete <?= $bl['title']; ?> ?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Gambar Promosi</th>
                                                        <th>Gambar Promosi Content</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= base_url('assets/img/banner/promotion/' . $bl['img']); ?>" class="img-fluid" alt="" width="300" height="500">
                                                        </td>
                                                        <td>
                                                            <img src="<?= base_url('assets/img/banner/promotion/content/' . $bl['img_promo']); ?>" class="img-fluid" alt="" width="120" height="10">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br><br>
                                            Pilih Delete untuk Menghapus Gambar <?= $bl['title']; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <form action="<?= base_url() ?>dashboard/banner/promotion-banner/delete/<?= $bl['id_banner_promotion']; ?>" method="post">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="pager" value="<?= (isset($_GET['page_produk']) ? $_GET['page_produk'] : '1'); ?>">
                                                <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ================= END MODAL DELETE SINGLE PRODUK ================== -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('alert')) : ?>
            var alertData = <?= json_encode(session('alert')) ?>;
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                text: alertData.message
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection(); ?>