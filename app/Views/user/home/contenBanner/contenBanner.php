<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container">
    <div class="container-fluid p-0 position-relative mt-3">
        <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/vlDzYIIOYmM" title="YouTube video" allowfullscreen></iframe>
        </div>
    </div>

    <div class="col-12 col-md-6 mt-2">
        <!-- Konten Kolom Kedua -->
        <h3 class="text-center mt-3" style="font-size: 1.5rem; margin-bottom: 1rem;">Content Banner</h3>
        <p style="font-size: 12px; line-height: 1.4; text-align: justify;">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, nulla! Est nobis deleniti quisquam! Ipsam vitae molestiae voluptatibus rem, itaque laboriosam eum ratione molestias. Eveniet inventore recusandae optio ullam voluptatem, in, a aut accusamus autem beatae doloremque perspiciatis quam quasi necessitatibus consectetur quae odit libero velit accusantium nihil adipisci eos.
        </p>
    </div>

    <div class="col-12 col-md-6 mt-2">
        <h3 class=" mt-3" style="font-size: 1.5rem; margin-bottom: 1rem;">Gallery</h3>
        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper">
            <div class="parallax-bg" style="
          background-image: url(https://swiperjs.com/demos/images/nature-1.jpg);
        " data-swiper-parallax="-23%"></div>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="title" data-swiper-parallax="-300">Slide 1</div>
                    <div class="subtitle" data-swiper-parallax="-200">Subtitle</div>
                    <div class="text" data-swiper-parallax="-100">
                        <p style="font-size: 9px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                            dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla
                            laoreet justo vitae porttitor porttitor. Suspendisse in sem justo.
                            Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod.
                            Aliquam hendrerit lorem at elit facilisis rutrum. Ut at
                            ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec,
                            tincidunt ut libero. Aenean feugiat non eros quis feugiat.
                        </p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="title" data-swiper-parallax="-300">Slide 2</div>
                    <div class="subtitle" data-swiper-parallax="-200">Subtitle</div>
                    <div class="text" data-swiper-parallax="-100">
                        <p style="font-size: 9px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                            dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla
                            laoreet justo vitae porttitor porttitor. Suspendisse in sem justo.
                            Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod.
                            Aliquam hendrerit lorem at elit facilisis rutrum. Ut at
                            ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec,
                            tincidunt ut libero. Aenean feugiat non eros quis feugiat.
                        </p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="title" data-swiper-parallax="-300">Slide 3</div>
                    <div class="subtitle" data-swiper-parallax="-200">Subtitle</div>
                    <div class="text" data-swiper-parallax="-100">
                        <p style="font-size: 9px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                            dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla
                            laoreet justo vitae porttitor porttitor. Suspendisse in sem justo.
                            Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod.
                            Aliquam hendrerit lorem at elit facilisis rutrum. Ut at
                            ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec,
                            tincidunt ut libero. Aenean feugiat non eros quis feugiat.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>

<script>
    var swiper = new Swiper(".mySwiper", {
        speed: 600,
        parallax: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>







<?= $this->endSection(); ?>