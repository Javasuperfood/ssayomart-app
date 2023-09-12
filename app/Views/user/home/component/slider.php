<!-- SLIDER HERO -->
<div class="container d-md-none">
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
<div class="container d-none d-md-block">
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner ">
            <div class="carousel-item active  mt-5">
                <img src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="d-block w-100 rounded-4 gmb" alt="...">
            </div>
            <div class="carousel-item  mt-5">
                <img src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="d-block w-100 rounded-4 gmb" alt="...">
            </div>
            <div class="carousel-item  mt-5">
                <img src="<?= base_url() ?>assets/img/banner/<?= $b['img']; ?>" class="d-block w-100 rounded-4 gmb" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>