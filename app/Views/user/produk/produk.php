<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= base_url() ?>assets/img/produk/p7.png" class="img-fluid" alt="Gambar 1">
        </div>
        <div class="col-md-6 mt-4">
            <h2> Nori rasa Keju</h2>
            <p>Nori Rasa Keji 100g enak dan lezat </p>
            <p><del>Rp.100.000</del>
                <button type="button" class="btn btn-secondary btn-sm">10%</button>
            <h1>Rp. 25.000</h1>
            <p><i class="fa-regular fa-heart"></i> Add to Wishlist</p>

            <button>+</button> <input type="text" style="width: 25px;"> <button>-</button>
            <br>
            <button type="button" class="btn btn-danger mt-4" style="background-color: #ec2614; color: #fff;"><i class="bi bi-basket2"></i></button>
            <button type="button" class="btn btn-danger mt-4" style="background-color: #ec2614; color: #fff;">Beli Sekarang</button>
        </div>

        <div class="row mt-4">
            <div class="col">
                <h2> Deskripsi</h2>
                <p class="text-potong
                
                ">Nori Crispy Seaweed Snack Rumput Laut Halal
                    Nori Crispy Java Super Food adalah Nori Crispy yang terbuat dari bahan - bahan yang berkualitas serta memiliki rasa yang enak dan lezat.

                    Nori Crispy Java Super Food Merupakan cemilan rumput laut dengan kulit lumpia. Nori Crispy cocok untuk dijadikan teman ngemil untuk beraktivitas, Seperti menonton TV, Belajar dan Bersantai


                    NO BPOM
                    6192283328423

                    Tersedia Berbagai Rasa Nori Snack
                    - Nori Snack Rasa Original
                    - Nori Snack Rasa Keju
                    - Nori Snack Rasa Balado

                    Lebih Lengkap Cek Etalase Toko kami

                    Detail Produk
                    - Rumput laut
                    - Diproduksi dengan teknologi modern dan proses kemasan sangat mewah
                    - Gurih dan renyah
                    - Ideal dinikmati saat santai Anda bersama dengan teman dan keluarga</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>