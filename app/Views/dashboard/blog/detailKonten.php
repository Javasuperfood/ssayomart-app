<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<style>
    .tox-notifications-container {
        display: none;
    }

    .mce-container {
        border: 0px !important;
    }
</style>

<h1 class="h3 mb-2 text-gray-800">Detail Artikel/Blog</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item text-danger"><a class="text-secondary" href="<?= base_url(); ?>dashboard/blog/blog">List Artikel/Blog</a></li>
    <li class="breadcrumb-item text-danger active"><a class="text-danger" href="#">Detail Artikel/Blog</a></li>
</ul>

<div class="card border-0 shadow-sm border-left-danger mb-4">
    <div class="card-header border-0 py-3 bg-white">
        <h5 class=" mb-0">Pembuat Konten</h5>
    </div>
    <div class="row">
        <div class="card-body d-flex">
            <div class="col-2 text-center top-50 start-0 translate-middle-y">
                <img src="<?= base_url() ?>assets/img/pic/<?= $blog_detail['img']; ?>" class="rounded-circle" style="width: 120px; height: 120px; margin-right: 25px;">
            </div>
            <div class="col-6">
                <div class="mx-0 my-0 mb-0">
                    <div class="form-floating">
                        <input class="form-control border-0 floatingInput text-dark bg-white fw-bold" value="<?= $blog_detail['fullname']; ?>" disabled>
                        <label for="fullname">Nama Lengkap Author</label>
                    </div>
                </div>
                <div class="mx-0 my-0 mb-0">
                    <div class="form-floating">
                        <input class="form-control border-0 floatingInput text-dark bg-white fw-bold" value="@<?= $blog_detail['username']; ?>" disabled>
                        <label for="username">Username Author</label>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center position-absolute top-50 end-0 translate-middle-y mt-4">
                <form action="<?= base_url() ?>dashboard/blog/delete-konten/<?= $blog_detail['id_blog'] ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"> </i> Hapus Konten</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm border-left-danger">
    <div class="card-header border-0 py-3 bg-white">
        <h5 class="mb-0">Video</h5>
    </div>
    <div class="row">
        <div class="card-body d-flex justify-content-center">
            <?= $videoEmbedCode; ?>
        </div>
    </div>
</div>


<div class="row d-flex justify-content-center my-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 py-3">
                <h5 class="mb-0">Isi Konten Artikel/Blog</h5>
            </div>
            <div class="card border-0 w-100">
                <textarea class="tinymce border-0 shadow-sm" id="isi_blog" rows="3" name="isi_blog" readonly>
                <?= html_entity_decode($blog_detail['isi_blog']); ?>
            </textarea>
            </div>
        </div>
    </div>

    <div class=" col-md-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 py-3">
                <h5 class="mb-0 text-center">Thumbnail</h5>
            </div>
            <div class="card border-0">
                <div class="card-body border-0 rounded-5 text-center">
                    <img src="<?= base_url('assets/img/blog/' . $blog_detail['img_thumbnail']); ?>" class="img-thumbnail rounded-5" alt="Thumbnail Image" style="width: 400px;">
                </div>
                <div class="card border-0">
                    <div class="card-body border-0">
                        <div class="row">
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= $blog_detail['judul_blog']; ?>" disabled>
                                    <label for="judul_blog">Judul Artikel/Blog</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= strftime('%d %B %Y %H:%M', strtotime($blog_detail['tanggal_dibuat'])); ?>" disabled>
                                    <label for="tanggal_dibuat">Dipublikasikan</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= $blog_detail['slug']; ?>" disabled>
                                    <label for="slug">Slug</label>
                                </div>
                            </div>
                            <a class="btn btn-warning" href="<?= base_url() ?>dashboard/blog/update-konten/<?= $blog_detail['id_blog'] ?>"><i class="bi bi-gear-fill"> </i> Edit Konten</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // SWAL
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

    // Tiny MCE
    tinymce.init({
        selector: 'textarea.tinymce',
        menubar: false,
        statusbar: false,
        height: 1000,
        language: 'en',
        readonly: 1,
        inline_boundaries: false
    });
</script>

<?= $this->endSection(); ?>