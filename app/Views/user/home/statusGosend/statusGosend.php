<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Mobile View  -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="map-container">
                        <iframe class="text-center maps responsive-iframe" src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d588.8346382611838!2d106.6190360362805!3d-6.224009368681214!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fdd1b4844f71%3A0x7a215719bcf3a770!2sSsayo%20Mart%20Indonesia!5e1!3m2!1sen!2sid!4v1700099064396!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <!-- Konten kartu -->
                    <div class="card p-4 rounded-top-4 rounded-bottom-0 border-0 shadow-sm">
                        <div class="card-body">
                            <p class="mb-2 text-center"><span class="fs-5 fw-bold text-dark font-italic me-1">Data Status Pengiriman</p>
                            <hr class="border-darker mt-0 mb-3">
                            </p>
                            <p class="mt-4 mb-1" style="font-size: 16px;">driver_name</p>
                            <span class="fw-bold">Gilang Aditya</span>
                            <p class="mt-4 mb-1" style="font-size: 16px;">driver_phone</p>
                            <span class="fw-bold">0874545131</span> <button type="button" class="ms-4 btn-sm btn btn-success"><i class="bi bi-whatsapp"></i></button>
                            <p class="mt-4 mb-1" style="font-size: 16px;">booking_id</p>
                            <span class="fw-bold">123245</span>
                            <p class="mt-4 mb-1" style="font-size: 16px;">status</p>
                            <span class="fw-bold">sudah sampai</span>
                            <p class="mt-4 mb-1" style="font-size: 16px;">cancellation_reason</p>
                            <span class="fw-bold">Barang harganya kemurahan</span>
                            <p class="mt-4 mb-1" style="font-size: 16px;">receiver_name</p>
                            <span class="fw-bold">Gilang Aditya</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <p class="mb-2 text-center"><span class="fs-5 fw-bold text-dark font-italic me-1">Status Pengiriman</p>
                    <hr class="border-darker mt-0 mb-2">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="bi bi-check2-circle"></i> </span> <span class="text" style="font-size: smaller;">Order confirmed</span> </div>
                        <div class="step active"> <span class="icon"> <i class="bi bi-truck-flatbed"></i> </span> <span class="text" style="font-size: smaller;"> Picked by courier</span> </div>
                        <div class="step"> <span class="icon"> <i class="bi bi-truck"></i> </span> <span class="text" style="font-size: smaller;"> On the way </span> </div>
                        <div class="step"> <span class="icon"> <i class="bi bi-box2-heart"></i> </span> <span class="text" style="font-size: smaller;">Ready for pickup</span> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mt-5 card mb-4 mb-md-0 border-0 shadow-sm">
                        <div class="card-body">
                            <p class="mb-2 text-center"><span class="fs-5 fw-bold text-dark font-italic me-1">Rincian Alamat</p>
                            <hr class="border-darker mt-0 mb-2">

                            <div class="col">
                                <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-send fw-bold"></i> Pengirim</p>
                                <span class="fw-bold ms-4">Gilang Adtya</span>
                                <p class="ms-4 text-secondary">Jl. in aja dulu kalo cocok pasti lanjut</p>
                                <hr>
                            </div>
                            <div class="col">
                                <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-house"></i> Penerima</p>
                                <span class="fw-bold ms-4">Mr Gils</span>
                                <p class="ms-4 text-secondary">Jl. ni saja hidup ini sambil ngopi</p>
                                <hr>
                            </div>
                            <div class="col">
                                <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-stopwatch"></i> Estimasi diterima</p>
                                <span class="ms-4">32 Jan 2024</span>
                                <span class="ms-4 text-secondary">08.00 - 12.00 am</span>
                                <hr>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .map-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .map-container iframe {
            width: 100%;
            height: 50vh;
            border: 0;
        }

        @media (max-width: 767px) {
            .map-container iframe {
                height: calc(50vh - 80px);
                /* Adjust the height for mobile view */
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .map-container iframe {
                height: calc(50vh - 60px);
                /* Adjust the height for iPad view */
            }
        }

        .card {
            border-radius: 20px;
            /* Sudut bulat pada seluruh kartu */
            overflow: hidden;
            /* Mengatasi gambar yang keluar dari kartu */
            margin-top: -30px;
        }

        .card img {
            width: 100%;
            /* Agar gambar mengisi seluruh lebar kartu */
            height: auto;
            /* Mengatur ketinggian gambar sesuai aspek ratio */
        }

        .border-darker {
            border-color: red;
            /* Ubah warna garis menjadi merah */
            border-width: 2px;
            /* Sesuaikan ketebalan garis sesuai kebutuhan Anda */
            font-weight: bold;
            /* Tambahkan ketebalan teks sesuai kebutuhan Anda */
        }

        /* Style Tracking  */
        .track {
            position: relative;
            background-color: #ddd;
            height: 5px;
            /* Mengurangi tinggi tracking */
            display: flex;
            margin-bottom: 40px;
            /* Mengurangi margin bottom */
            margin-top: 30px;
            /* Mengurangi margin top */
        }

        .track .step {
            flex-grow: 1;
            width: 20%;
            /* Mengurangi lebar setiap langkah */
            margin-top: -14px;
            /* Mengurangi margin top */
            text-align: center;
            position: relative;
        }

        .track .step.active:before {
            background: #cf240a;
        }

        .track .step::before {
            height: 5px;
            /* Mengurangi tinggi garis tracking */
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 14px;
            /* Mengurangi top position */
        }

        .track .step.active .icon {
            background: #cf240a;
            color: #fff;
        }

        .track .icon {
            display: inline-block;
            width: 30px;
            /* Mengurangi lebar ikon */
            height: 30px;
            /* Mengurangi tinggi ikon */
            line-height: 30px;
            /* Mengurangi line-height ikon */
            position: relative;
            border-radius: 100%;
            background: #ddd;
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000;
        }

        .track .text {
            display: block;
            margin-top: 5px;
            /* Mengurangi margin top */
            font-size: smaller;
            /* Mengubah ukuran font ke smaller */
        }
    </style>

<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:100px;">
        <section>
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                        <h2>Status Pengiriman</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="track">
                            <div class="step active"> <span class="icon"> <i class="bi bi-check2-circle"></i> </span> <span class="text">Order confirmed</span> </div>
                            <div class="step active"> <span class="icon"> <i class="bi bi-truck-flatbed"></i> </span> <span class="text"> Picked by courier</span> </div>
                            <div class="step"> <span class="icon"> <i class="bi bi-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="bi bi-box2-heart"></i> </span> <span class="text">Ready for pickup</span> </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="mb-4"><span class="text-dark font-italic me-1">Data Status Pesanan</h3>
                                <hr class="border-darker mt-0 mb-3">
                                <p class="mt-4 mb-1" style="font-size: 16px;">booking_id</p>
                                <span class="fw-bold">123245</span>
                                <p class="mt-4 mb-1" style="font-size: 16px;">status</p>
                                <span class="fw-bold">sudah sampai</span>
                                <p class="mt-4 mb-1" style="font-size: 16px;">driver_name</p>
                                <span class="fw-bold">Gilang Aditya</span>
                                <p class="mt-4 mb-1" style="font-size: 16px;">driver_phone</p>
                                <span class="fw-bold">0874545131</span>
                                <p class="mt-4 mb-1" style="font-size: 16px;">cancellation_reason</p>
                                <span class="fw-bold">Barang harganya kemurahan</span>
                                <p class="mt-4 mb-1" style="font-size: 16px;">receiver_name</p>
                                <span class="fw-bold">Gilang Aditya</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="mb-4"><span class="text-dark font-italic me-1">Tracking Maps</h3>
                                <hr class="border-darker mt-0 mb-3">
                                <div class="col-md-6 col-lg-6">
                                    <iframe class="text-center maps rounded-4" src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d588.8346382611838!2d106.6190360362805!3d-6.224009368681214!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fdd1b4844f71%3A0x7a215719bcf3a770!2sSsayo%20Mart%20Indonesia!5e1!3m2!1sen!2sid!4v1700099064396!5m2!1sen!2sid" width="600" height="435" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        /* Style Tracking  */
        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px;
        }

        .track .step {
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative;
        }

        .track .step.active:before {
            background: #cf240a;
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px;
        }

        .track .step.active .icon {
            background: #cf240a;
            color: #fff;
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd;
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000;
        }

        .track .text {
            display: block;
            margin-top: 7px;
        }

        .border-darker {
            border-color: red;
            /* Ubah warna garis menjadi merah */
            border-width: 2px;
            /* Sesuaikan ketebalan garis sesuai kebutuhan Anda */
            font-weight: bold;
            /* Tambahkan ketebalan teks sesuai kebutuhan Anda */
        }
    </style>
<?php endif; ?>
<!-- End Desktop View -->
<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>

<?= $this->endSection(); ?>