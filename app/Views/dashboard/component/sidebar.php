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
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Pesanan</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Pesanan:</h6>
                <a class="collapse-item" href="<?= base_url('dashboard/pesanan'); ?>">Pesanan</a>
                <a class="collapse-item" href="<?= base_url('dashboard/pesanan'); ?>">Pesanan Diproses</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Lainya:</h6>
                <a class="collapse-item" href="<?= base_url('dashboard/pesanan'); ?>">Pesanan dibatalkan</a>
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
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/input">Produk</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/tambahProduk">Tambah Produk</a>
            </div>
        </div>
    </li>

    <!-- Kategori -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/kategori">
            <i class="fas fa-fw fa-table"></i>
            <span>Kategori & SubKategori</span></a>
    </li>

    <!-- Kategori -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/inputbaner">
            <i class="fas fa-fw fa-table"></i>
            <span>Banner</span></a>
    </li>

    <!-- kupon -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/kupon">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kupon</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
<?php endif; ?>
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>