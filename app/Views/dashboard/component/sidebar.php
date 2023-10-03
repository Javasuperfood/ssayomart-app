<!-- Sidebar - Brand -->

<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-chart-line"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Ssayomart</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">
<div class="sidebar-heading">
    Role
    <?= (auth()->user()->inGroup('superadmin')) ? 'Superadmin' : 'Admin' ?>

</div>
<hr class="sidebar-divider">
<?php if (auth()->user()->inGroup('superadmin')) : ?>


    <div class="sidebar-heading">
        Admin Super
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
<?php endif; ?>
<?php if (auth()->user()->inGroup('superadmin', 'admin')) : ?>
    <div class="sidebar-heading">
        Pesanan
    </div>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#pesanan" aria-expanded="false" aria-controls="pesanan">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Pesanan</span>
        </a>
        <div id="pesanan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Pesanan:</h6>
                <a class="collapse-item" href="<?= base_url('dashboard/order'); ?>">Semua Pesanan</a>
                <a class="collapse-item" href="<?= base_url('dashboard/order/awaiting-payment'); ?>">Pesanan menunggu pembayaran</a>
                <a class="collapse-item" href="<?= base_url('dashboard/order/in-proccess'); ?>">Pesanan dalam proses</a>
                <a class="collapse-item" href="<?= base_url('dashboard/order/being-delivered'); ?>">Pesanan dalam Perjalanan</a>
                <a class="collapse-item" href="<?= base_url('dashboard/order/delivered'); ?>">Pesanan terkirim</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Produk
    </div>

    <!-- Input Produk Admin Produk -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url(); ?>" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Produk Menu</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Produk:</h6>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/produk/produk">List Produk</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/produk/tambah-produk">Tambah Produk</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/produk/tambah-variasi">Tambah Variasi</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/promo/tambah-promo">Tambah Promo Produk</a>
            </div>
        </div>
    </li>

    <!-- Kategori -->
    <!-- Input Admin Kategori -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-table"></i>
            <span>Kategori menu</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kategori :</h6>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/kategori">List Kategori</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/kategori/tambah-kategori">Tambah Kategori</a>
            </div>
        </div>
    </li>

    <!-- Banner -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url(); ?>" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fas fa-fw fa-cog"></i>
            <span>Banner Menu</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Banner:</h6>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/banner/inputbanner">List Banner</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/banner/tambah-banner">Tambah Banner</a>
            </div>
        </div>
    </li>

    <!-- kupon -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/kupon">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kupon</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/marketplace">
            <i class="bi bi-shop"></i>
            <span>Market</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
<?php endif; ?>
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>