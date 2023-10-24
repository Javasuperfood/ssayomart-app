<!-- Modal Logout  -->
<div class="container">
    <div class="modal fade p-4 py-md-5" tabindex="-1" role="dialog" id="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Anda yakin ingin logout ?</h5>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <a href="<?= base_url(); ?>logout" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"><strong>Yes</strong></a>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal">No thanks</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="selectMarket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down">
            <div class="modal-content">
                <form action="<?= base_url(); ?>setting/update-market" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <p class="fw-bold fs-5">Pilih Lokasi Market</p>
                            </div>
                        </div>
                        <div class="row row-cols-1">
                            <?php foreach ($market as $m) : ?>
                                <div class="col py-2" onclick="selectMarket(<?= $m['id_toko']; ?>)">
                                    <div class="card">
                                        <div class="card-body">
                                            <input id="market<?= $m['id_toko'];; ?>" class="form-check-input" type="radio" name="market" value="<?= $m['id_toko']; ?>" <?= ($user['market_selected'] == $m['id_toko']) ? 'checked' : ''; ?>>
                                            <p class="fw-bold">Ssayomart <?= $m['zip_code']; ?> <i class="fw-bold text-danger" id="marketSelected<?= $m['id_toko']; ?>"> <?= ($user['market_selected'] == $m['id_toko']) ? 'Selected' : ''; ?></i></p>
                                            <p><?= $m['alamat_1']; ?></p>
                                            <p><?= $m['telp']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="modal-footer fixed-bottom">
                            <button type="button" class="btn btn-secondary" <?= (!$user['market_selected']) ? '' : 'data-bs-dismiss="modal"' ?>>Close</button>
                            <button type="submit" class="btn btn-danger"><?= (!$user['market_selected']) ? 'Simpan' : 'Update'; ?> Lokasi Market</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function selectMarket(i) {
        $('#market' + i).prop('checked', true);
    }
</script>