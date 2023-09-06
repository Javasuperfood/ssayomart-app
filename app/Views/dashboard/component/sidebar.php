<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center border-0 shadow-sm" href="<?= base_url() ?>dashboard">
    <div class="sidebar-brand-text mx-3">Ssayomart Admin Page</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Super Admin
</div>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>dashboard/home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Admin Produk Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Admin
</div>

<!-- Input Produk Admin Produk -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url(); ?>" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-cog"></i>
        <span>Produk Menu</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-light py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url(); ?>dashboard/input">Produk</a>
            <a class="collapse-item" href="<?= base_url(); ?>dashboard/tambahProduk">Tambah Produk</a>
        </div>
    </div>
</li>

<!-- Kategori -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>dashboard/kategori">
        <i class="fas fa-cog"></i>
        <span>Kategori & SubKategori</span></a>
</li>

<!-- Kategori -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>dashboard/inputbaner">
        <i class="fas fa-cog"></i>
        <span>Setting Banner Promotion</span></a>
</li>

<!-- kupon -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>dashboard/kupon">
        <i class="fas fa-cog"></i>
        <span>Setting Kupon</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>