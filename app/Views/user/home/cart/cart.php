<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>


<!-- ITEM WISHLIST -->
<div class="container pt-1  d-md-none">
    <div class="row text-center">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table>
                            <tr>
                                <td rowspan="2"><i class="bi bi-cash-stack fs-4 fw-bold text-success"></i></td>
                                <td>
                                    <span class="text-secondary ps-2">Total Belanja</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold ps-2">Rp. <?= number_format($total, 0, ',', '.'); ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center row-cols-2">

        <?php foreach ($produk as $p) : ?>
            <div class="col">
                <div class="card my-2 border-0 shadow" style="width: auto;">
                    <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <p class="card-title">Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                        <p class="card-text text-secondary"><?= $p['nama']; ?></p>
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                            <input type="text" class="form-control text-center bg-white border-0" disabled value="<?= $p['qty']; ?>">
                            <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                        </div>
                        <form action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></button>
                        </form>
                        <a href="#" class="btn" style="background-color: #fbdb14;">Beli</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


    </div>
    <div class="row p-3 px-4">
        <div class="col">
            <form action="<?= base_url('checkout'); ?>" method="post" class="<?= (!$produk) ? 'd-none' : ''; ?>">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; width: 100%;">Checkout</button>
            </form>
        </div>
    </div>
    <div class="pb-5"></div>
</div>

<!-- END OF WISHLIST -->
<!-- Desktop -->
<div class="container-fluid mb-5 d-none d-md-block">
    <div class="row">
        <div class="col-md-10 col-11 mx-auto">
            <div class="row mt-5 gx-3">
                <!-- left side div -->
                <div class="col-md-12 col-lg-8 col-11 mx-auto main_cart mb-lg-0 mb-5">
                    <div class="card p-5">
                        <div class="row">
                            <!-- cart images div -->
                            <div class="col-md-5 col-11 mx-auto bg-light d-flex justify-content-center align-items-center product_img">
                                <img src="<?= base_url() ?>assets/img/produk/main/default.png" class="img-fluid" alt="cart img">
                            </div>
                            <!-- cart product details -->
                            <div class="col-md-7 col-11 mx-auto px-4 mt-2">
                                <div class="row">
                                    <!-- product name  -->
                                    <div class="col-6 card-title">
                                        <h1 class="mb-4 product_name">Norigo</h1>
                                        <p class="mb-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam corporis nobis eligendi? Modi, voluptatibus! Quidem quibusdam corrupti ullam dolorem suscipit amet odit repudiandae repellendus modi accusantium, labore doloribus ex dolorum.</p>

                                    </div>
                                    <!-- quantity inc dec -->
                                    <div class="col-6">
                                        <ul class="pagination justify-content-end set_quantity">
                                            <div class="input-group">
                                                <button class="btn btn-outline-danger" type="button" onclick="decreaseNumber('textbox','itemval')">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="text" name="" class="form-control text-center bg-white border-0" value="0" id="textbox">
                                                <button class="btn btn-outline-danger" type="button" onclick="increaseNumber('textbox','itemval')">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>

                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <!-- //remover move and price -->
                                <div class="row">
                                    <div class="col-8 d-flex justify-content-between remove_wish">
                                        <button class="btn btn-danger" onclick="removeItem()">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <button class="btn btn-primary" onclick="moveToWishList()">
                                            <i class="bi bi-heart"></i>
                                        </button>

                                        <div class="col-8 d-flex justify-content-end price_money">
                                            <h3>Harga: Rp <span id="itemval">0.00</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </hr>
                </div>
                <!-- right side div -->
                <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                    <div class="right_side p-3 shadow bg-white">
                        <h2 class="product_name mb-5">Total Pembayaran Produk</h2>
                        <div class="price_indiv d-flex justify-content-between">
                            <p>Harga Barang</p>
                            <p>Rp.<span id="product_total_amt">0.00</span></p>
                        </div>
                        <div class="price_indiv d-flex justify-content-between">
                            <p>Penggunaan Aplikasi</p>
                            <p>Rp.<span id="shipping_charge">50.0</span></p>
                        </div>
                        <hr />
                        <div class="total-amt d-flex justify-content-between font-weight-bold">
                            <p>Jumlah TOTAL</p>
                            <p>RP.<span id="total_cart_amt">0.00</span></p>
                        </div>
                        <form action="<?= base_url('checkout'); ?>" method="post" class="<?= (!$produk); ?>">
                            <?= csrf_field(); ?>
                            <button class="btn btn-danger text-uppercase">Checkout</button>
                        </form>
                    </div>
                    <!-- discount code part -->
                    <div class="discount_code mt-3 shadow">
                        <div class="card">
                            <div class="card-body">
                                <a class="d-flex justify-content-between" style="text-decoration: none;" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <button class="btn btn-danger">
                                        Tambahkan Kupon
                                    </button>
                                    <span><i class="bi bi-chevron-down pt-1"></i></span>

                                </a>

                                <div class="collapse" id="collapseExample">
                                    <div class="mt-3">
                                        <input type="text" name="" id="discount_code1" class="form-control font-weight-bold" placeholder="Enter the discount code">
                                        <small id="error_trw" class="text-dark mt-3"></small>
                                    </div>
                                    <button class="btn btn-danger btn-sm mt-3" onclick="discount_code()">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- discount code ends -->
                    <div class="mt-3 shadow p-3 bg-white">
                        <div class="pt-4">
                            <h5 class="mb-4">Expected delivery date</h5>
                            <p>July 27th 2020 - July 29th 2020</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <script type="text/javascript">
        var product_total_amt = document.getElementById('product_total_amt');
        var shipping_charge = document.getElementById('shipping_charge');
        var total_cart_amt = document.getElementById('total_cart_amt');
        var discountCode = document.getElementById('discount_code1');
        const decreaseNumber = (incdec, itemprice) => {
            var itemval = document.getElementById(incdec);
            var itemprice = document.getElementById(itemprice);
            console.log(itemprice.innerHTML);
            // console.log(itemval.value);
            if (itemval.value <= 0) {
                itemval.value = 0;
                alert('Negative quantity not allowed');
            } else {
                itemval.value = parseInt(itemval.value) - 1;
                itemval.style.background = '#fff';
                itemval.style.color = '#000';
                itemprice.innerHTML = parseInt(itemprice.innerHTML) - 15;
                product_total_amt.innerHTML = parseInt(product_total_amt.innerHTML) - 15;
                total_cart_amt.innerHTML = parseInt(product_total_amt.innerHTML) + parseInt(shipping_charge.innerHTML);
            }
        }
        const increaseNumber = (incdec, itemprice) => {
            var itemval = document.getElementById(incdec);
            var itemprice = document.getElementById(itemprice);
            // console.log(itemval.value);
            if (itemval.value >= 1000) {
                itemval.value = 1000;
                alert('max 1000 allowed');
                itemval.style.background = 'red';
                itemval.style.color = '#fff';
            } else {
                itemval.value = parseInt(itemval.value) + 1;
                itemprice.innerHTML = parseInt(itemprice.innerHTML) + 15;
                product_total_amt.innerHTML = parseInt(product_total_amt.innerHTML) + 15;
                total_cart_amt.innerHTML = parseInt(product_total_amt.innerHTML) + parseInt(shipping_charge.innerHTML);
            }
        }

        const discount_code = () => {
            let totalamtcurr = parseInt(total_cart_amt.innerHTML);
            let error_trw = document.getElementById('error_trw');
            if (discountCode.value === 'Kunyuk') {
                let newtotalamt = totalamtcurr - 15;
                total_cart_amt.innerHTML = newtotalamt;
                error_trw.innerHTML = "Hurray! code is valid";
            } else {
                error_trw.innerHTML = "Try Again! Valid code is thapa";
            }
        }
    </script>

</div>
<!-- end -->
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