<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container">
            <h3 class="text-center mb-4 pb-2 text-dark fw-bold">FAQ</h3>
            <p class="text-center mb-4">
                Temukan jawaban atas pertanyaan yang paling sering diajukan di bawah ini
            </p>

            <div class="row" style="font-size: 14px;">
                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger d-flex align-items-center"><i class="bi bi-question-circle text-danger me-3"></i><strong> Bagaimana Cara Memesan Produk di Sayomart?</strong></h6>
                    <ul class="me-2">
                        <p>
                            <strong><u>Untuk memesan produk di Sayomart, cukup ikuti langkah-langkah berikut:</u></strong>
                        </p>
                    </ul>
                    <ul>
                        <li> Telusuri katalog produk kami.</li>
                        <li> Pilih produk yang diinginkan dan tambahkan ke keranjang belanja.</li>
                        <li> Lanjutkan ke pembayaran dan pilih metode pengiriman yang diinginkan.</li>
                        <li> Isi informasi pengiriman dan pembayaran Anda.</li>
                        <li> Setelah selesai, konfirmasi pesanan Anda.</li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger d-flex align-items-center"><i class="bi bi-question-circle text-danger me-3"></i><strong> Berapa Lama Waktu Pengiriman Pesanan? </strong></h6>
                    <ul>
                        <li> Waktu pengiriman bervariasi tergantung lokasi pengiriman dan ketersediaan produk. Umumnya, proses pengiriman memakan waktu 3-7 hari kerja setelah konfirmasi pesanan.
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger d-flex align-items-center"><i class="bi bi-question-circle text-danger me-3"></i><strong> Apakah Ada Kompensasi Pengembalian? </strong></h6>
                    <ul>
                        <li> Ya, kami menerima pengembalian barang dengan uang namun beberapa syarat tertentu. Silakan kunjungi kebijakan pengembalian kami untuk informasi lebih lanjut.
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger d-flex align-items-center"><i class="bi bi-question-circle text-danger me-3"></i><strong> Bagaimana Cara Melacak Pesanan Saya? </strong></h6>
                    <ul>
                        <li> Setelah pesanan Anda dikirim, Anda akan menerima nomor pelacakan melalui email. anda juga dapat melihat pada tampilan aplikasi kami pada menu history dan pesanan anda di situs kami.
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger d-flex align-items-center"><i class="bi bi-question-circle text-danger me-3"></i><strong> Apakah Ada Opsi Pembayaran Cicilan? </strong></h6>
                    <ul>
                        <li> Tidak, kami tidak menyediakan opsi pembayaran cicilan saat ini.
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger d-flex align-items-center"><i class="bi bi-question-circle text-danger me-3"></i><strong> Bagaimana Jika Produk Yang Diterima Rusak atau Tidak Sesuai? </strong></h6>
                    <ul class="mb-0">
                        <li>Jika produk yang Anda terima rusak atau tidak sesuai, silakan hubungi layanan pelanggan kami dalam waktu 7 hari setelah penerimaan produk untuk mendapatkan bantuan lebih lanjut.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div id="desktopContent" style="margin-top:150px;">
        <div class="container">
            <h3 class="text-center mb-4 pb-2 text-dark fw-bold">FAQ</h3>
            <p class="text-center mb-5">
                Temukan jawaban atas pertanyaan yang paling sering diajukan di bawah ini
            </p>

            <div class="row" style="font-size: 15px;">
                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger d-flex align-items-center"><i class="bi bi-question-circle text-danger pe-2"></i><strong> Bagaimana Cara Memesan Produk di Sayomart? </strong></h6>
                    <ul class="me-2">
                        <p>
                            <strong><u>Untuk memesan produk di Sayomart, cukup ikuti langkah-langkah berikut:</u></strong>
                        </p>
                    </ul>
                    <ul>
                        <li> Telusuri katalog produk kami.</li>
                        <li> Pilih produk yang diinginkan dan tambahkan ke keranjang belanja.</li>
                        <li> Lanjutkan ke pembayaran dan pilih metode pengiriman yang diinginkan.</li>
                        <li> Isi informasi pengiriman dan pembayaran Anda.</li>
                        <li> Setelah selesai, konfirmasi pesanan Anda.</li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger"><i class="bi bi-question-circle text-danger pe-2"></i><strong> Berapa Lama Waktu Pengiriman Pesanan? </strong></h6>
                    <ul>
                        <li> Waktu pengiriman bervariasi tergantung lokasi pengiriman dan ketersediaan produk. Umumnya, proses pengiriman memakan waktu 3-7 hari kerja setelah konfirmasi pesanan.
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger"><i class="bi bi-question-circle text-danger pe-2"></i><strong> Apakah Ada Kompensasi Pengembalian? </strong></h6>
                    <ul>
                        <li> Ya, kami menerima pengembalian barang dengan uang namun beberapa syarat tertentu. Silakan kunjungi kebijakan pengembalian kami untuk informasi lebih lanjut.
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger"><i class="bi bi-question-circle text-danger pe-2"></i><strong> Bagaimana Cara Melacak Pesanan Saya? </strong></h6>
                    <ul>
                        <li> Setelah pesanan Anda dikirim, Anda akan menerima nomor pelacakan melalui email. anda juga dapat melihat pada tampilan aplikasi kami pada menu history dan pesanan anda di situs kami.
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger"><i class="bi bi-question-circle text-danger pe-2"></i><strong> Apakah Ada Opsi Pembayaran Cicilan? </strong></h6>
                    <ul>
                        <li> Tidak, kami tidak menyediakan opsi pembayaran cicilan saat ini.
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h6 class="mb-3 text-danger d-flex align-items-center"><i class="bi bi-question-circle text-danger me-3"></i><strong> Bagaimana Jika Produk Yang Diterima Rusak atau Tidak Sesuai? </strong></h6>
                    <ul class="mb-0">
                        <li>Jika produk yang Anda terima rusak atau tidak sesuai, silakan hubungi layanan pelanggan kami dalam waktu 7 hari setelah penerimaan produk untuk mendapatkan bantuan lebih lanjut.</li>
                    </ul>
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