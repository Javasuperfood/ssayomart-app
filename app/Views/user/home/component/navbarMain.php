<nav class="navbar pt-3">
    <div class="container-fluid">
        <div class="col text-center position-relative">
            <?php if (isset($produkView)) : ?>
                <span onclick="location.href='<?= base_url(); ?>'" class="
                position-absolute top-50 start-0 translate-middle-y"><i class=" bi bi-chevron-left navbar-brand"></i></span>
                <span class="navbar-brand"><?= $title; ?></span>
            <?php elseif (!isset($produkView)) : ?>
                <span onclick="history.back()" class="
                position-absolute top-50 start-0 translate-middle-y"><i class=" bi bi-chevron-left navbar-brand"></i></span>
                <span class="navbar-brand"><?= $title; ?></span>
            <?php endif ?>
        </div>
    </div>
</nav>