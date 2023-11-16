<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Mobile View  -->
<?php if ($isMobile) : ?>

    CODE

<?php else : ?>
    <!-- END MOBILE VIEW -->

    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:50px;">

        CODE

    <?php endif; ?>
    <!-- End Desktop View -->
    <?php
    if ($isMobile) {

        echo '<div id="mobileContent">';

        echo '</div>';
    } else {

        echo '<div id="desktopContent">';

        echo '</div>';
    }
    ?>

    <?= $this->endSection(); ?>