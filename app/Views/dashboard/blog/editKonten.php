<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<style>
    .tox-notifications-container {
        display: none;
    }
</style>

<h1 class="h3 mb-1 text-gray-800">Edit Artikel/Blog</h1>
<div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
    <b>MOHON TELITI KETIKA MENGISI KONTEN UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN!!</b>
</div>
<div class="row mb-4">
    <div class="col">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-bold text-danger">Edit Artikel/Blog Anda</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/blog/tambah-konten/edit-konten/<?= $bm['id_blog'] ?>" method="post" enctype="multipart/form-data" onsubmit="return validasiKonten()">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="judul_blog">Judul Blog/Konten <span class="text-danger fs-5">*</span></label>
                        <input type="text" class="form-control shadow-sm border-0" id="judul_blog" placeholder="Masukan Judul Blog/Artikel..." name="judul_blog" value="<?= $bm['judul_blog']; ?>">
                        <span id="judulError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="img_thumbnail" class="form-label">Gambar Thumbnail <span class="text-danger fs-5">*</span></label>
                        <input type="file" class="form-control shadow-sm border-0" id="img_thumbnail" name="img_thumbnail" accept="image/*" value="<?= $bm['img_thumbnail']; ?>">
                        <input type="hidden" name="imageLama" value="<?= $bm['img_thumbnail']; ?>">
                        <span id="imgError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="isi_blog" class="form-label">Isi Blog/Artikel <span class="text-danger fs-5">*</span></label>
                        <textarea class="tinymce border-0 shadow-sm" id="isi_blog" rows="3" placeholder="Masukan Isi Konten Artikel/Blog Anda Disini..." name="isi_blog" value="<?= $bm['isi_blog']; ?>"></textarea>
                        <!-- <span id="kontenError" class="text-danger"></span> -->
                    </div>
                    <button type="submit" class="btn btn-danger mt-3 text-center">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- TINY MCE -->
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
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
            'media', 'table', 'emoticons', 'template', 'help'
        ],
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: (cb, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.addEventListener('change', (e) => {
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    const id = 'blobid' + (new Date()).getTime();
                    const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    const base64 = reader.result.split(',')[1];
                    const blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                });
                reader.readAsDataURL(file);
            });
            input.click();
        },
        height: 700,
        mode: 'exact',
        language: 'en'
    });

    //Validasi Form
    function validasiKonten() {
        var isValid = true;

        var judulField = document.getElementById('judul_blog');
        var imgField = document.getElementById('img_thumbnail');
        var kontenField = document.getElementById('isi_blog');

        var judulError = document.getElementById('judulError');
        var imgError = document.getElementById('imgError');
        // var kontenError = document.getElementById('kontenError');

        judulError.textContent = '';
        imgError.textContent = '';
        // kontenError.textContent = '';

        if (judulField.value.trim() === '') {
            judulField.classList.add('invalid-field');
            judulError.textContent = 'Judul Artikel/Blog tidak boleh kosong';
            isValid = false;
        } else {
            judulField.classList.remove('invalid-field');
        }

        if (imgField.value.trim() === '') {
            imgField.classList.add('invalid-field');
            imgError.textContent = 'Gambar thumbnail tidak boleh kosong';
            isValid = false;
        } else {
            imgField.classList.remove('invalid-field');
        }

        // if (kontenField.value.trim() === '') {
        //     kontenField.classList.add('invalid-field');
        //     kontenError.textContent = 'Konten artikel/blog tidak boleh kosong';
        //     isValid = false;
        // } else {
        //     kontenField.classList.remove('invalid-field');
        // }

        return isValid;
    }
</script>
<?= $this->endSection(); ?>