<!-- NAVBAR Mobile-->
<div class="container d-md-none">
    <div class="row">
        <nav class="navbar pt-4" style="background-color : #ec2614; padding-bottom : 80px; border-radius:0 0 3% 3%;">
            <div class="container-fluid mx-3">
                <div class="col-10">
                    <form role="search">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Cari produk..." aria-label="search" aria-describedby="basic-addon1">
                        </div>
                    </form>
                </div>
                <div class="col-2">
                    <a href="<?= base_url(); ?>wishlist" class="btn btn-light rounded-circle ms-3"><i class="bi bi-heart-fill" style="color: #ec2614"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- END OF NAVBAR -->
<!-- navbar Website -->
<div class="container mb-5 d-none d-md-block">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <img src="<?= base_url() ?>assets/img/logo.png" width="50" height="50" alt="" class="image-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mx-3" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kategori</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link
                        dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Download APK </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="#" class="dropdown-item">Feature 1</a></li>
                            <li><a href="#" class="dropdown-item">Feature 2</a></li>
                            <li><a href="#" class="dropdown-item">Feature 3</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-danger" type="submit">Search</button>
                </form>
                <ul class="navbar-nav d-flex flex-row mx-3">
                    <!-- Icons -->
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#">
                            <i class="bi bi-cart-fill"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#">
                            <i class="bi bi-bag-heart-fill"></i>
                        </a>
                    </li>
                    <!-- Icon dropdown -->
                    <li class="nav-item me-3 me-lg-0 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">Action</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>





<!-- end Nav Desk -->