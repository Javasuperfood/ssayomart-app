<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
        <img class="logo" id="logo-icon" src="<?= base_url() ?>assets/img/logo.png" alt="Logo Ssayomart" width="50px" height="50px">
    </div>
</a>

<hr class="sidebar-divider">
<div class="sidebar-heading">
    Role
    <?= (auth()->user()->inGroup('superadmin')) ? 'Superadmin' : 'Admin' ?>
</div>
<hr class="sidebar-divider">
<?php if (auth()->user()->inGroup('superadmin')) : ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/dashboard-super-admin">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard Super Admin</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Report
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/report">
            <i class="bi bi-file-text-fill"></i>
            <span>Report</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/admin-management">
            <i class="bi bi-person-fill"></i>
            <span>Admin Management</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/user-management">
            <i class="bi bi-people-fill"></i>
            <span>User Management</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/marketplace">
            <i class="bi bi-shop"></i>
            <span>Setting Cabang</span></a>
    </li>
<?php endif; ?>
<?php if (auth()->user()->inGroup('admin')) : ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Report
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>dashboard/report">
            <i class="bi bi-file-text-fill"></i>
            <span>Report</span></a>
    </li>

    <hr class="sidebar-divider">

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
            <div class="bg-white py-2 collapse-inner rounded" style="font-size: 12px;">
                <h6 class="collapse-header text-danger">Menu Pesanan:</h6>
                <a class="collapse-item <?= (isset($pages) && $pages == '') ? 'fw-bold text-danger' : ''; ?>" href="<?= base_url('dashboard/order'); ?>">Semua Pesanan</a>
                <a class="collapse-item <?= (isset($pages) && $pages == 'awaiting-payment') ? 'fw-bold text-danger' : ''; ?>" href="<?= base_url('dashboard/order/awaiting-payment'); ?>">Menunggu Pembayaran</a>
                <a class="collapse-item <?= (isset($pages) && $pages == 'in-proccess') ? 'fw-bold text-danger' : ''; ?>" href="<?= base_url('dashboard/order/in-proccess'); ?>">Dalam Proses</a>
                <a class="collapse-item <?= (isset($pages) && $pages == 'being-delivered') ? 'fw-bold text-danger' : ''; ?>" href="<?= base_url('dashboard/order/being-delivered'); ?>">Dalam Perjalanan</a>
                <a class="collapse-item <?= (isset($pages) && $pages == 'delivered') ? 'fw-bold text-danger' : ''; ?>" href="<?= base_url('dashboard/order/delivered'); ?>">Pesanan Terkirim</a>
                <a class="collapse-item <?= (isset($pages) && $pages == 'refunds') ? 'fw-bold text-danger' : ''; ?>" href="<?= base_url('dashboard/order/refunds'); ?>">Refund</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Produk
    </div>

    <!-- Produk -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url(); ?>" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="bi bi-box2-fill"></i>
            <span>Produk Menu</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded" style="font-size: 11.5px;">
                <h6 class="collapse-header text-danger">Menu Produk:</h6>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/produk">List Produk</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/produk/tambah-produk">Tambah Produk</a>
                <!-- <a class="collapse-item" href="<?= base_url(); ?>dashboard/produk/produk-batch">Produk-Kategori Batch</a> -->
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/produk/tambah-variasi">Tambah Variasi</a>
                <!-- <a class="collapse-item" href="<?= base_url(); ?>dashboard/produk/management-fetching-content">Fetching Produk</a> -->
                <!-- Section Promo -->
                <h6 class="collapse-header text-danger">Menu Promosi:</h6>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/promo">Tambah Promo</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/promo/tambah-promo">Tambah Promo Produk</a>
            </div>
        </div>
    </li>

    <!-- Kategori -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-table"></i>
            <span>Kategori menu</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded" style="font-size: 12px;">
                <h6 class="collapse-header text-danger">Kategori :</h6>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/kategori">List Kategori</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/kategori/tambah-kategori">Tambah Kategori & Sub Kategori</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/kategori/shorting">Ubah Urutan Kategori</a>
            </div>
        </div>
    </li>

    <!-- Banner -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url(); ?>" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fas fa-fw fa-cog"></i>
            <span>Management Konten</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded" style="font-size: 12px;">
                <h6 class="collapse-header text-danger">Menu Banner:</h6>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/banner/list-banner">Banner</a>
                <a class="collapse-item" href="<?= base_url(); ?>dashboard/blog/blog">Artikel</a>
            </div>
        </div>
    </li>

    <!-- Kupon -->
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