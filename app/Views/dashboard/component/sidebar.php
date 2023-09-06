<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Ssayomart Administrator</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Admin Super
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
    Admin Produk
</div>

<!-- Input Produk Admin Produk -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url(); ?>" data-toggle="collapse" data-target="#collapseTree" aria-expanded="true" aria-controls="collapseTree">
        <i class="fas fa-fw fa-cog"></i>
        <span>Produk Menu</span>
    </a>
    <div id="collapseTree" class="collapse" aria-labelledby="headingTree" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Produk:</h6>
            <a class="collapse-item" href="<?= base_url(); ?>dashboard/input">Produk</a>
            <a class="collapse-item" href="<?= base_url(); ?>dashboard/tambahProduk">Tambah Produk</a>
        </div>
    </div>
</li>

<!-- Input Admin Kategori -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-table"></i>
        <span>Kategori menu</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="<?= base_url(); ?>dashboard/kategori">List Kategori</a>
            <a class="collapse-item" href="<?= base_url(); ?>dashboard/tambah-kategori">Tambah Kategori</a>
        </div>
    </div>
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