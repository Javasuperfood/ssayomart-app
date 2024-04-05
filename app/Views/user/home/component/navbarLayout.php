<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<?php if ($isMobile) : ?>
    <div id="mobileContent" style="margin-bottom:20px;">
        <nav class="navbar navbar-main rounded-bottom-4 shadow-sm" style="background-color:#ffff;">
            <div class="container-fluid p-2 mx-auto" style="z-index: 2;">
                <div class="row w-100 align-items-center justify-content-between">
                    <div class="col">
                        <div class="border-0 mt-lg-3 d-flex align-items-center justify-content-center">
                            <?php if (isset($back)) : ?>
                                <?php $displayTitle = strlen($title) > 40 ? substr($title, 0, 16) . '...' : $title; ?>
                                <span onclick="location.href='<?= base_url(); ?><?= $back; ?>'" class="position-absolute top-50 start-0 translate-middle-y ms-2"><i class="bi bi-chevron-left navbar-brand"></i></span>
                                <span class="navbar-brand fw-bold" style="font-size: 12px; margin-left:30px;"><?= $displayTitle; ?></span>
                            <?php elseif (!isset($back)) : ?>
                                <?php $displayTitle = strlen($title) > 40 ? substr($title, 0, 16) . '...' : $title; ?>
                                <span onclick="history.back()" class="position-absolute top-50 start-0 translate-middle-y ms-2"><i class="bi bi-chevron-left navbar-brand"></i></span>
                                <span class="navbar-brand fw-bold start-50" style="font-size: 12px;"><?= $displayTitle; ?></span>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-auto mx-2">
                        <a href="<?= base_url(); ?>cart" class="d-flex justify-content-center align-items-center text-decoration-none text-danger py-4">
                            <i class="bi bi-cart-fill fw-bold fs-2 position-absolute text-danger">
                                <div id="cartItem_0">
                                    <i class="bi bi-app-indicator position-absolute top-0 start-100 translate-middle text-danger mx-1 mt-2"></i>
                                    <span id="cartItem_1" class="position-absolute top-0 start-100 translate-middle badge badge-initial rounded-pill text-danger fw-bold mx-1 mt-2" style="font-size: 0.75rem;"><?= session()->get('countCart'); ?></span>
                                </div>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>


<?php else : ?>

    <div id="desktopContent">

    </div>
<?php endif; ?>

<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>

<style>
    @media screen and (max-width: 280px) {
        #buyButton_1 {
            width: 94px !important;
        }


        .input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 83%;
        }

    }

    /* @media screen and (max-width: 375px) {
        #buyButton_1 {
            width: 94px !important;
        }


        .input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 103%;
        }

    } */
</style>