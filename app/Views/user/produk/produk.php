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
            <h1>Rp. 25.000</h1>
            <p><i class="fa-regular fa-heart"></i> Add to Wishlist</p>
            <div class="container">
                <div class="row">
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                        <input type="text" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center">
                <a href="#" class="btn btn-white text-danger border-danger mt-4"><i class="bi bi-basket2"></i></a>
                <a href="<?= base_url() ?>checkout" class="btn btn-white text-danger border-danger mt-4">Beli Sekarang</a>
            </div>
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
<script type="text/javascript">
    function increaseCount(a, b) {
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
    }

    function decreaseCount(a, b) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
        }
    }
</script>
<?= $this->endSection(); ?>