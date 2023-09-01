<!-- SLIDER HERO -->
<div class="container">
    <div class="row">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="margin-top: -60px;">
            <div class="carousel-inner">
                <?php $firstLoop = true;
                foreach ($banner as $b) :
                    $classBanner = "carousel-item";
                    if ($firstLoop) {
                        $classBanner .= " active";
                        $firstLoop = false;
                    } ?>
                    <div class="<?= $classBanner; ?>" style="border-radius: 50%;">
                        <img src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="d-block w-100" alt="<?= $b['title']; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- END -->