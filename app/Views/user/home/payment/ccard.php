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
        <div class="col-md-6 offset-md-3">
            <!-- form card cc payment -->
            <div class="card border-0">
                <div class="card-body">
                    <div class="alert alert-info p-2 pb-3">
                        <a class="close font-weight-normal initialism" data-dismiss="alert" href="#"><samp>×</samp></a>
                        CVC code is required.
                    </div>
                    <form class="form" role="form" autocomplete="off">
                        <div class="form-group">
                            <label for="cc_name">Card Holder's Name</label>
                            <input type="text" class="border-0 shadow-sm form-control" id="cc_name" pattern="\w+ \w+.*" title="First and last name" required="required">
                        </div>
                        <div class="form-group">
                            <label>Card Number
                                <div class="icons">
                                    <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                    <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                                    <img src="https://i.imgur.com/35tC99g.png" width="30">
                                    <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                </div>
                            </label>
                            <input type="text" class="border-0 shadow-sm form-control" autocomplete="off" maxlength="20" pattern="\d{16}" title="Credit card number" required="">
                        </div>
                        <div class="form-group row">
                            <label class="col-md-12">Card Exp. Date</label>
                            <div class="col-md-4 mb-2">
                                <select class="border-0 shadow-sm form-control" name="cc_exp_mo" size="0">
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <select class="border-0 shadow-sm form-control" name="cc_exp_yr" size="0">
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                    <option>2021</option>
                                    <option>2022</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" class="border-0 shadow-sm form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="" placeholder="CVC">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-12">Amount</label>
                        </div>
                        <div class="form-inline">
                            <div class="input-group border-0 shadow-sm">
                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                <input type="text" class="form-control text-right" id="exampleInputAmount" placeholder="39">
                                <div class="input-group-append"><span class="input-group-text">.00</span></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="mt-5 col d-flex justify-content-center">
                                <button type="button" class="btn btn-danger mx-2">Cancel</button>
                                <button type="button" class="btn btn-danger mx-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /form card cc payment -->
        </div>


    <?php else : ?>
        <!-- Desktop View -->
        <div id="desktopContent" style="margin-top:300px;">
            <div class="container d-flex justify-content-center mt-5 mb-5">
                <div class="row g-3">
                    <div class="col-md-6">
                        <span>Payment Method</span>
                        <div class="card">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header p-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <div class="d-flex align-items-center justify-content-between">

                                                    <span>Paypal</span>
                                                    <img src="https://i.imgur.com/7kQEsHU.png" width="30">

                                                </div>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <input type="text" class="form-control" placeholder="Paypal email">
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header p-0">
                                        <h2 class="mb-0">
                                            <button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <div class="d-flex align-items-center justify-content-between">

                                                    <span>Credit card</span>
                                                    <div class="icons">
                                                        <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                                        <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                                                        <img src="https://i.imgur.com/35tC99g.png" width="30">
                                                        <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                                    </div>

                                                </div>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body payment-card-body">

                                            <span class="font-weight-normal card-text">Card Number</span>
                                            <div class="input">
                                                <i class="fa fa-credit-card"></i>
                                                <input type="text" class="form-control" placeholder="0000 0000 0000 0000">
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-6">
                                                    <span class="font-weight-normal card-text">Expiry Date</span>
                                                    <div class="input">
                                                        <i class="fa fa-calendar"></i>
                                                        <input type="text" class="form-control" placeholder="MM/YY">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="font-weight-normal card-text">CVC/CVV</span>
                                                    <div class="input">
                                                        <i class="fa fa-lock"></i>
                                                        <input type="text" class="form-control" placeholder="000">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span>Summary</span>
                        <div class="card">
                            <div class="d-flex justify-content-between p-3">
                                <div class="d-flex flex-column">
                                    <span>Pro(Billed Monthly) <i class="fa fa-caret-down"></i></span>
                                    <a href="#" class="billing">Save 20% with annual billing</a>
                                </div>
                                <div class="mt-1">
                                    <sup class="super-price">$9.99</sup>
                                    <span class="super-month">/Month</span>
                                </div>
                            </div>
                            <hr class="mt-0 line">
                            <div class="p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Refferal Bonouses</span>
                                    <span>-$2.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Vat <i class="fa fa-clock-o"></i></span>
                                    <span>-20%</span>
                                </div>
                            </div>
                            <hr class="mt-0 line">
                            <div class="p-3 d-flex justify-content-between">
                                <div class="d-flex flex-column">
                                    <span>Today you pay(US Dollars)</span>
                                    <small>After 30 days $9.59</small>

                                </div>
                                <span>$0</span>
                            </div>
                            <div class="p-3">
                                <button class="btn btn-danger btn-block free-button">Try it free for 30 days</button>
                                <div class="text-center mt-4">
                                    <a href="#">Have a promo code?</a>
                                </div>
                            </div>
                        </div>
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