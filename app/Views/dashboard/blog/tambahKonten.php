<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<style>
    .tox-notifications-container {
        display: none;
    }
</style>
<h1 class="h3 mb-3 text-gray-800">Tambah Konten Artikel/Blog</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item text-danger"><a class="text-secondary" href="<?= base_url(); ?>dashboard/blog/blog">List Artikel/Blog</a></li>
    <li class="breadcrumb-item text-danger text-decoration-underline active"><a class="text-danger" href="#">Tambah Artikel/Blog</a></li>
</ul>
<div class="alert alert-danger text-center border-1 shadow-sm mb-4" role="alert">
    <b>MOHON TELITI KETIKA MENGISI KONTEN UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN!!</b>
</div>
<div class="row mb-5">
    <div class="col">
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <h6 class="m-0 fw-bold px-2">Masukan Konten</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/blog/tambah-konten/save-konten" method="post" enctype="multipart/form-data" onsubmit="return validasiKonten()">
                    <?= csrf_field(); ?>
                    <div class="mb-4">
                        <label for="judul_blog">Judul Blog/Konten<span class="text-danger fs-5">*</span></label>
                        <input type="text" class="form-control border-1" id="judul_blog" placeholder="Masukan Judul Blog/Artikel..." name="judul_blog" value="<?= old('judul_blog') ?>">
                        <span id="judulError" class="text-danger"></span>
                    </div>

                    <div class="mb-4">
                        <label for="link_video">Masukkan Link Video<span class="text-danger fs-5">*</span></label>
                        <input type="url" class="form-control border-1" id="link_video" placeholder="Masukkan Link Video..." name="link_video" value="<?= old('link_video') ?>">
                        <span id="linkError" class="text-danger"></span>
                    </div>

                    <div class="mb-4">
                        <label for="link_video">Video Preview</label>
                        <div id="videoPreview" class="rounded-3"></div>
                    </div>

                    <div class="mb-4">
                        <label for="img_thumbnail" class="form-label">Gambar Thumbnail<span class="text-danger fs-5">*</span></label>
                        <input type="file" class="form-control border-1" id="img_thumbnail" name="img_thumbnail" accept="image/*" value="<?= old('img_thumbnail') ?>">
                        <span id="imgError" class="text-danger"></span>
                    </div>

                    <div class="mb-4">
                        <label for="isi_blog" class="form-label">Isi Blog/Artikel <span class="text-danger fs-5">*</span></label>
                        <textarea class="tinymce border-1" id="isi_blog" rows="3" placeholder="Masukan Isi Konten Artikel/Blog Anda Disini..." name="isi_blog" value="<?= old('isi_blog') ?>"></textarea>
                        <!-- <span id="kontenError" class="text-danger"></span> -->
                    </div>

                    <!-- <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="blog1" class="form-label">Gambar Blo/Artikel 1 <span class="text-danger fs-5">*</span></label>
                                <input type="file" class="form-control shadow-sm border-0" id="img_1" name="img_1">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="blog2" class="form-label">Gambar Blog 2 <span class="text-danger fs-5">*</span></label>
                                <input type="file" class="form-control shadow-sm border-0" id="img_2" name="img_2">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="blog3" class="form-label">Gambar Blog 3 <span class="text-danger">(Optional)</span></label>
                                <input type="file" class="form-control shadow-sm border-0" id="img_3" name="img_3">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="blog3" class="form-label">Gambar Blog 4 <span class="text-danger">(Optional)</span></label>
                                <input type="file" class="form-control shadow-sm border-0" id="img_4" name="img_4">
                            </div>
                        </div>
                    </div> -->
                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger text-center">Tambah Artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- VIDEO YOUTUBE -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const linkVideoInput = document.getElementById('link_video');
        const videoPreview = document.getElementById('videoPreview');

        linkVideoInput.addEventListener('input', function() {
            const videoUrl = linkVideoInput.value;
            const videoId = extractVideoId(videoUrl);
            const iframeCode = generateIframeCode(videoId);

            videoPreview.innerHTML = iframeCode;
        });

        function extractVideoId(url) {
            // Lakukan ekstraksi ID video dari URL YouTube
            // Misalnya, dari "https://www.youtube.com/watch?v=VIDEO_ID" menjadi "VIDEO_ID"
            // Anda dapat menggunakan ekspresi reguler atau manipulasi string untuk ini
            // Contoh sederhana (asumsi URL selalu dalam format yang sama):
            const match = url.match(/(\?|&)v=([^&#]+)/);
            if (match) {
                return match[2];
            } else {
                // Return default ID jika tidak ditemukan
                return 'DEFAULT_VIDEO_ID';
            }
        }

        function generateIframeCode(videoId) {
            // Menghasilkan kode iframe untuk menyisipkan video YouTube
            return `<iframe width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
        }
    });
</script>

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
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'fullscreen', 'insertdatetime',
            'media', 'table', 'emoticons', 'template', 'help'
        ],
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
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
        var linkField = document.getElementById('link_video');
        var imgField = document.getElementById('img_thumbnail');
        var kontenField = document.getElementById('isi_blog');

        var judulError = document.getElementById('judulError');
        var linkError = document.getElementById('linkError');
        var imgError = document.getElementById('imgError');
        // var kontenError = document.getElementById('kontenError');

        judulError.textContent = '';
        linkError.textContent = '';
        imgError.textContent = '';
        // kontenError.textContent = '';

        if (judulField.value.trim() === '') {
            judulField.classList.add('invalid-field');
            judulError.textContent = 'Judul Artikel/Blog tidak boleh kosong';
            isValid = false;
        } else {
            judulField.classList.remove('invalid-field');
        }

        if (linkField.value.trim() === '') {
            linkField.classList.add('invalid-field');
            linkError.textContent = 'Link Video tidak boleh kosong';
            isValid = false;
        } else {
            linkField.classList.remove('invalid-field');
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