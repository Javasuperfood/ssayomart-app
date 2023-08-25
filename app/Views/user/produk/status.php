<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 ">
        <div class="col ">
            <div class="card text-center">

                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h3>Status Pengiriman</h3>
                            <div class="timeline ">
                                <div class="timeline-item">
                                    <div class="timeline-icon">1</div>
                                    <div class="timeline-content">
                                        <p>Pemesanan Diterima</p>
                                        <span class="badge text-bg-success">25 Agustus 2023</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon">2</div>
                                    <div class="timeline-content">
                                        <p>Persiapan Pengiriman</p>
                                        <span class="badge text-bg-warning">25 Agustus 2023</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon">3</div>
                                    <div class="timeline-content">
                                        <p>paket dikrim</p>
                                        <span class="badge text-bg-warning">25 Agustus 2023</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon">4</div>
                                    <div class="timeline-content">
                                        <p>Paket Diterima</p>
                                        <span class="badge text-bg-primary">25 Agustus 2023</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-3">
            <div class="card px-3 py-2">
                <h2>Lokasi Tujuan</h2>
                <h4>kantor</h4>
                <p>Jl.in aja dulu kedepannya mikir entar Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat obcaecati omnis laudantium officiis provident. Error saepe amet repellat ex dignissimos!</p>
                <h4>Detail Penerima</h4>
                <p>Gilang +6200000000000</p>
            </div>
        </div>
        <div class="col mt-3">
            <div class="card px-3 py-2">
                <h2>Pesanan kamu</h2>
                <p>INA15165465465416546541654651453155 <i class="bi bi-clipboard"></i></p>
                <table class="table table-sm ">
                    <thead>
                        <tr>
                            <td scope="col">Metode Pembayaran</td>
                            <td scope="col"> BCA Virtual Acount </td>
                        </tr>
                    </thead>
                </table>
                <h3>Pengiriman langsung</h3>

                <table class="table table-sm ">
                    <thead>
                        <tr>
                            <td scope="col">1 x</td>
                            <td scope="col">Nori keju</td>
                            <td scope="col"> Rp. 100.000 </td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm ">
                    <thead>
                        <tr>
                            <td scope="col">Sub total</td>

                            <td scope="col"> Rp. 100.000 </td>
                        </tr>
                    </thead>
                </table>
                <table class=" table table-sm table-borderless">
                    <thead>
                        <tr>
                            <td scope="col" class="fw-bold">Grand Total</td>
                            <td scope="col" class="fw-bold"> Rp. 100.000 </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>



<style>
    /* Gaya tambahan kustom bisa ditambahkan di sini */
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline:before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        width: 3px;
        background-color: #ccc;
        left: 50%;
        transform: translateX(-50%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 50px;
    }

    .timeline-icon {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #3498db;
        color: #fff;
        text-align: center;
        line-height: 30px;
        font-size: 18px;
    }

    .timeline-content {

        padding: 15px;
        background-color: #f4f4f4;
        border-radius: 5px;

    }
</style>


<?= $this->endSection(); ?>