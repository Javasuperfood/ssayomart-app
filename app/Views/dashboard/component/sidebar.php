<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Ssayomart</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Administrator
</div>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>dashboard/component/home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Admin Produk Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Admin Produk
</div>

<!-- Input Produk Admin Produk -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>dashboard/input">
        <i class="fas fa-fw fa-table"></i>
        <span>Produk</span></a>
</li>

<!-- Kategori -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>dashboard/kategorisubkat">
        <i class="fas fa-fw fa-table"></i>
        <span>Kategori dan Sub Kategori</span></a>
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

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>