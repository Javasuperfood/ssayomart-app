<nav class="navbar pt-3">
    <div class="container-fluid">
        <div class="col text-center position-relative">
            <?php if (isset($back)) : ?>
                <span onclick="location.href='<?= base_url(); ?><?= $back; ?>'" class="
                position-absolute top-50 start-0 translate-middle-y"><i class=" bi bi-chevron-left navbar-brand"></i></span>
                <span class="navbar-brand"><?= $title; ?></span>
            <?php elseif (!isset($back)) : ?>
                <span onclick="history.back()" class="
                position-absolute top-50 start-0 translate-middle-y"><i class=" bi bi-chevron-left navbar-brand"></i></span>
                <span class="navbar-brand"><?= $title; ?></span>
            <?php endif ?>
        </div>
    </div>
</nav>

<!-- navbar Website -->
<div class="container mb-5 d-none d-md-block">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <img src="<?= base_url() ?>assets/img/logopanjang.png" width="150" height="50" alt="Logo Ssayomart" class="image-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mx-3" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link
                        dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="#" class="dropdown-item">Feature 1</a></li>
                            <li><a href="#" class="dropdown-item">Feature 2</a></li>
                            <li><a href="#" class="dropdown-item">Feature 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="https://download.ssayomart.com">Download Aplikasi Ssayomart</a>
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
                            <i class="bi bi-cart-fill fs-4 text-danger"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#">
                            <i class="bi bi-heart-fill fs-4 text-danger"></i>
                        </a>
                    </li>
                    <!-- Icon dropdown -->
                    <li class="nav-item me-3 me-lg-0 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4 text-danger"></i>
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

<!-- navbar Website -->