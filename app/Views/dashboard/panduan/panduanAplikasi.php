<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<div class="d-flex aligns-items-center"></div>
<div class="container-fluid">
  <h1 class="text-center mb-3 heading-mobile">Panduan Aplikasi</h1>
  <style>
@media screen and (max-width: 767px) {
  .heading-mobile {
     font-size: 1.5rem;
  }
}

 
</style>
      <div class="row">
        <div class="col mx-auto">
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Accordion Item #1</button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as
                  well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
              </div>
            </div>

          <!-- Accordion Item #2 -->
<div class="accordion-item">
  <h2 class="accordion-header" id="panduanAplikasiHeadingTwo">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panduanAplikasiCollapseTwo" aria-expanded="false" aria-controls="panduanAplikasiCollapseTwo">Accordion Item #2</button>
  </h2>
  <div id="panduanAplikasiCollapseTwo" class="accordion-collapse collapse" aria-labelledby="panduanAplikasiHeadingTwo" data-bs-parent="#accordionExample">
    <div class="accordion-body">
       <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as
                  well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit overflow.
    </div>
  </div>
</div>

<!-- Accordion Item #3 -->
<div class="accordion-item">
  <h2 class="accordion-header" id="panduanAplikasiHeadingThree">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panduanAplikasiCollapseThree" aria-expanded="false" aria-controls="panduanAplikasiCollapseThree">Accordion Item #3</button>
  </h2>
  <div id="panduanAplikasiCollapseThree" class="accordion-collapse collapse" aria-labelledby="panduanAplikasiHeadingThree" data-bs-parent="#accordionExample">
    <div class="accordion-body">
     <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as
                  well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit overflow.
    </div>
  </div>
</div>


            <!-- Accordion Item #4 -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Accordion Item #4</button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong>This is the fourth item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as
                  well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
              </div>
            </div>

            <!-- Accordion Item #5 -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Accordion Item #5</button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong>This is the fifth item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as
                  well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?= $this->endSection(); ?>

