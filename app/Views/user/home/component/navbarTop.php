<!-- NAVBAR -->
<div class="row">
    <nav class="navbar pt-4" style="background-color : #ec2614; padding-bottom : 80px; border-radius:0 0 3% 3%;">
        <div class="container-fluid mx-3">
            <div class="col-10">
                <form role="search">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari produk..." aria-label="search" aria-describedby="basic-addon1">
                    </div>
                </form>
            </div>
            <div class="col-2">
                <a href="<?= base_url(); ?>wishlist" class="btn btn-light rounded-circle ms-3"><i class="bi bi-heart-fill" style="color: #ec2614"></i></a>
            </div>
        </div>
    </nav>
</div>
<!-- END OF NAVBAR -->