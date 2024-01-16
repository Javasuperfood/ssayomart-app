<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Crop Image Sebelum Diupload di Laravel 10 - Leravio</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
</head>
<style type="text/css">
    body {
        background: #f6d352;
    }

    h1 {
        font-weight: bold;
        font-size: 23px;
    }

    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        justify-content: space-between;
        text-align: center;
        overflow: hidden;
        width: 500%;
        height: 500%;
        border: 1px solid red;
    }

    input {
        margin-top: 40px;
    }

    .section {
        margin-top: 150px;
        background: #fff;
        padding: 50px 30px;
    }

    .modal-lg {
        max-width: 50% !important;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 section text-center">
                <input type="file" name="image" class="image">
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">How to crop image before upload image in laravel 10 - Leravio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                                <div class="btn-group my-3">
                                    <button class="btn btn-secondary btn-sm" id="zoomIn">Zoom In</button>
                                    <button class="btn btn-secondary btn-sm" id="zoomOut">Zoom Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <!-- HTML dan CSS tetap sama seperti sebelumnya -->

    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                preview: '.preview',
                zoomable: true, // Aktifkan zoom
                zoomOnWheel: true, // Aktifkan zoom ketika menggunakan mouse wheel
                minZoom: 0 // Tanpa batas zoom out
            });

            $("#zoomIn").click(function() {
                cropper.zoom(0.1);
            });

            $("#zoomOut").click(function() {
                cropper.zoom(-0.1);
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500,
            });

            // Mengubah canvas ke data URL
            var croppedImageDataURL = canvas.toDataURL("image/png");

            // Simpan gambar atau lakukan tindakan lain sesuai kebutuhan
            saveCroppedImage(croppedImageDataURL);

            // Menutup modal setelah simpan
            $modal.modal('hide');
        });

        // Fungsi untuk menyimpan gambar (ganti sesuai kebutuhan)
        function saveCroppedImage(dataURL) {
            // Simpan atau kirim dataURL ke server sesuai kebutuhan Anda
            // Misalnya, dapat menggunakan AJAX untuk mengunggah gambar ke server
            console.log("Simpan gambar:", dataURL);
            // Implementasikan kode penyimpanan atau kirim dataURL ke server di sini
        }
    </script>

</body>

</html>