<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tautan ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <title>Ssayomart Blog Page</title>
    </head>

    <!-- Mobile View  -->
    <?php if ($isMobile) : ?>
        <div id="mobileContent">


            <div class="container mt-3">
                <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-3" id="myTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-1" data-toggle="tab" href="#tab-content-1" aria-controls="tab-content-1" aria-selected="true">Privacy policy</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2" role="tab" aria-controls="tab-content-2" aria-selected="false">Refund Policy</a>
                    </li>

                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="myTabsContent">
                    <div class="tab-pane fade show active" id="tab-content-1" role="tabpanel" aria-labelledby="tab-1">
                        <!-- Privacy Policy-->
                        <div class="container">
                            <h4>Privacy policy <span class="text-danger">SsayoMart</span></h4>
                            <div class="card border-0 shadow-sm p-3 m-2 mt-3">
                                <p><strong>Efektif sejak: 01/11/2023</strong></p>

                                <p><strong>Data yang Kami Kumpulkan:</strong> Kami dapat mengumpulkan informasi pribadi seperti nama, alamat, alamat email, dan informasi kontak lainnya. Kami juga dapat mengumpulkan informasi non-pribadi seperti preferensi produk.</p>

                                <p><strong>Kami di SsayoMart menghargai privasi pengguna kami dan berkomitmen untuk melindungi informasi pribadi Anda.</strong> Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda ketika Anda menggunakan aplikasi kami.</p>

                                <p><strong>Penggunaan Data:</strong> Informasi yang kami kumpulkan digunakan untuk memproses pesanan, memberikan layanan pelanggan, mengirim pembaruan, dan menganalisis penggunaan aplikasi.</p>

                                <p><strong>Kemanan Data:</strong> Kami menjaga keamanan data Anda dengan tindakan teknis dan keamanan fisik yang sesuai.</p>

                                <p><strong>Pemberian kepada Pihak Ketiga:</strong> Kami tidak menjual, memperjualbelikan, atau mentransfer informasi pribadi Anda kepada pihak ketiga tanpa izin Anda.</p>

                                <p><strong>Kebijakan Perubahan:</strong> Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Setiap perubahan akan diumumkan di aplikasi kami.</p>
                            </div>
                        </div>
                        <!-- Delivery Policy -->
                        <div class="container mt-3">
                            <h4>Delivery policy <span class="text-danger">SsayoMart</span></h4>
                            <div class="card border-0 shadow-sm p-3 m-2 mt-3">
                                <p><strong>Efektif sejak: 01/11/2023</strong></p>

                                <p><strong>Komitmen Kami pada Pengiriman yang Aman:</strong> Keamanan pengiriman adalah prioritas kami. Kami berkomitmen untuk memastikan setiap produk atau pesanan Anda dikirim dengan aman dan dalam kondisi terbaik.</p>

                                <p><strong>Pengiriman yang Tepat Waktu: </strong> Kami menghargai waktu Anda, dan kami berusaha keras untuk memberikan pengiriman yang tepat waktu. Kami memahami pentingnya menerima pesanan Anda sesuai jadwal.</p>

                                <p><strong>Transparansi dalam Biaya Pengiriman:</strong> Kami memberikan transparansi dalam biaya pengiriman. Anda akan selalu tahu berapa biaya pengiriman sebelum Anda menyelesaikan pesanan Anda.</p>

                                <p><strong>Pilihan Pengiriman yang Fleksibel:</strong> Kami menawarkan berbagai pilihan pengiriman yang sesuai dengan kebutuhan Anda. Anda dapat memilih opsi pengiriman yang paling cocok untuk Anda.</p>

                                <p><strong>Layanan Pelanggan yang Responsif:</strong> Tim dukungan pelanggan kami selalu siap membantu Anda dengan pertanyaan atau masalah yang mungkin Anda miliki terkait pengiriman.</p>

                                <p><strong>Pelacakan Pesanan yang Mudah:</strong> Kami menyediakan layanan pelacakan pesanan sehingga Anda dapat melacak status pengiriman Anda dengan mudah dan dapat memantau pesanan Anda hingga tiba di pintu Anda.</p>
                                <p><strong>Kebijakan Pengiriman yang Jelas:</strong> Ketentuan kebijakan pengiriman kami jelas dan mudah dimengerti. Ini memastikan bahwa Anda memiliki pemahaman yang baik tentang proses pengiriman.</p>
                                <p><strong>Kami Menjaga Lingkungan:</strong> Kami juga berkomitmen untuk menjaga lingkungan. Kami berusaha untuk menggunakan metode pengiriman yang ramah lingkungan sesuai dengan kebijakan kami.</p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-content-2" role="tabpanel" aria-labelledby="tab-2">
                        <!-- Refund Policy-->
                        <div class="container">
                            <h4>Refund policy <span class="text-danger">SsayoMart</span></h4>
                            <div class="card border-0 shadow-sm p-3 m-2 mt-3">
                                <p><strong>Efektif sejak: 01/11/2023</strong></p>

                                <p><strong>Kami Menghormati Keinginan Anda:</strong> Kami memahami bahwa keadaan dapat berubah, dan kami selalu siap untuk membantu Anda. Kebijakan pengembalian kami dirancang untuk memberi Anda kepercayaan bahwa pembelian Anda dengan kami aman.</p>

                                <p><strong>Fleksibilitas dalam Pengembalian:</strong> Kami memberikan fleksibilitas dalam kebijakan pengembalian kami. Jika Anda memiliki alasan yang sah, kami siap untuk memproses pengembalian Anda sesuai dengan ketentuan yang berlaku.</p>

                                <p><strong>Proses Pengembalian yang Mudah: </strong> Kami telah menyederhanakan proses pengembalian agar sesederhana mungkin. Kami ingin Anda merasa nyaman dan percaya bahwa kebijakan pengembalian kami ada untuk melindungi kepentingan Anda.</p>

                                <p><strong>Dukungan Pelanggan yang Profesional: </strong> Tim dukungan pelanggan kami selalu siap membantu Anda dengan pengembalian. Kami berkomitmen untuk memberikan layanan pelanggan yang berkualitas dan ramah.</p>

                                <p><strong>Ketentuan yang Jelas: </strong> Ketentuan kebijakan pengembalian kami jelas dan transparan. Kami ingin Anda tahu apa yang diharapkan dan bagaimana kami dapat membantu Anda dalam proses pengembalian.</p>

                                <p><strong>Kami Mendengarkan Anda:</strong> Kami menghargai masukan dan umpan balik dari pelanggan kami. Jika ada cara untuk meningkatkan kebijakan pengembalian kami, kami ingin tahu.</p>

                                <p><strong>Kami Peduli tentang Pengalaman Anda</strong> Kami peduli tentang pengalaman belanja Anda dengan kami. Kami ingin memastikan Anda puas dengan produk atau layanan yang Anda beli, dan jika tidak, kami siap untuk membantu Anda menyelesaikannya.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Tabs content -->
            </div>
            <!-- Tautan ke Bootstrap JavaScript -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <style>
                /* Garis bawah pada tautan tab saat dihover */
                .nav-link:hover {
                    border-bottom: 2px solid red !important;
                    /* Ubah warna dan ketebalan garis sesuai kebutuhan */
                }

                /* Menghapus border dari tab kedua */
                .nav-item:not(:first-child) .nav-link {
                    border: none;
                }

                .nav-link {
                    color: black;
                    /* Mengubah warna teks menjadi hitam */
                }
            </style>
        </div>
    <?php else : ?>
        <!-- Desktop View -->
        <div id="desktopContent" style="margin-top:50px;">
            <div class="container-fluid p-0 position-relative">
                <div class="img-container">
                    <img src="<?= base_url() ?>assets/img/kfood.jpg" width="650px" height="350px" alt="" class="img-fluid">
                    <div class="img-overlay"></div>
                </div>
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white fs-2 " style="font-family:cursive;">
                    <h1>ABOUT US</h1>
                    <p>PT Ssayomart Indonesia </p>
                </div>
            </div>

            <div class="container mt-3">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Konten Kolom Pertama -->
                        <div class="img-container">
                            <img src="<?= base_url() ?>assets/img/sampel.jpg" width="650px" height="350px" alt="" class="img-fluid">
                            <div class="img-overlay"></div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <!-- Konten Kolom Kedua -->
                        <h3>Tentang Ssayomart </h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, nulla! Est nobis deleniti quisquam! Ipsam vitae molestiae voluptatibus rem, itaque laboriosam eum ratione molestias. Eveniet inventore recusandae optio ullam voluptatem, in, a aut accusamus autem beatae doloremque perspiciatis quam quasi necessitatibus consectetur quae odit libero velit accusantium nihil adipisci eos.</p>

                    </div>
                </div>
            </div>

        </div>
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