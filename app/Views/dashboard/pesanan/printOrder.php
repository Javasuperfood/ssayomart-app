<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<script src="https://cdn.tiny.cloud/1/grb00a88uywpwh1b18cwhz3s4hja33mu2z3d1q3o3zmt7t9p/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<style>
    /* For other boilerplate styles, see: /docs/general-configuration-guide/boilerplate-content-css/ */
    /*
* For rendering images inserted using the image plugin.
* Includes image captions using the HTML5 figure element.
*/

    figure.image {
        display: inline-block;
        border: 1px solid gray;
        margin: 0 2px 0 1px;
        background: #f5f2f0;
    }

    figure.align-left {
        float: left;
    }

    figure.align-right {
        float: right;
    }

    figure.image img {
        margin: 8px 8px 0 8px;
    }

    figure.image figcaption {
        margin: 6px 8px 6px 8px;
        text-align: center;
    }


    /*
 Alignment using classes rather than inline styles
 check out the "formats" option
*/

    img.align-left {
        float: left;
    }

    img.align-right {
        float: right;
    }

    /* Basic styles for Table of Contents plugin (toc) */
    .mce-toc {
        border: 1px solid gray;
    }

    .mce-toc h2 {
        margin: 4px;
    }

    .mce-toc li {
        list-style-type: none;
    }

    .tox-notifications-container {
        display: none;
    }
</style>
<script>
    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

    tinymce.init({
        selector: 'textarea#open-source-plugins',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert tools table help', //format
        toolbar: 'print | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor | pagebreak | charmap emoticons | fullscreen  preview save | image  | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        image_list: [{
            title: 'Logo',
            value: '<?= base_url(); ?>assets/img/logopanjang.png'
        }],
        importcss_append: true,
        file_picker_callback: function(callback, value, meta) {
            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('<?= base_url(); ?>assets/img/logopanjang.png', {
                    alt: 'My alt text'
                });
            }
        },
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>

</head>
<textarea name="print" id="open-source-plugins">
    <div class="container">
<div class="row">
<div class="col-12 text-center"><img style="display: block; margin-left: auto; margin-right: auto;" src="<?= base_url(); ?>assets/img/logopanjang.png" alt="ssayo" width="211" height="62" /></div>
<div class="col">
<h6 class="text-center" style="text-align: center;"><span style="font-size: 12pt;">Pesanan</span></h6>
<table style="border-collapse: collapse; width: 100%; border-color: #000000; height: 117.563px;" border="1">
<tbody>
<tr style="height: 19.5938px;">
<td style="width: 48.6578%; height: 19.5938px;">Penerima :</td>
<td style="width: 48.6578%; height: 19.5938px;">Pengirim :</td>
</tr>
<tr style="height: 97.9688px;">
<td style="width: 48.6578%; height: 97.9688px;"><?= $checkout['kirim']; ?></td>
<td style="width: 48.6578%; height: 97.9688px;"><strong>Nama</strong> : Ssayomart <?= $toko['lable'] ?><br /><strong>Alamat</strong> :<br /><?= $toko['alamat_1']; ?><br /><strong>Telp</strong> : <?= $toko['telp']; ?></td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="row pt-4">
<div class="col-6">
<p>&nbsp;</p>
</div>
</div>
<div class="row mt-3">
<div class="col">
<table class="table table-borderless" style="border-collapse: collapse; width: 100%; height: 58.7813px; background-color: #ffffff; border-color: #000000; border-style: solid;" border="1">
<thead>
<tr style="height: 19.5938px;">
<th style="height: 19.5938px;" scope="col">No Pesanan</th>
<th style="height: 19.5938px;" scope="col">Waktu Pembayaran</th>
<th style="height: 19.5938px;" scope="col">Metode Pembayaran</th>
<th style="height: 19.5938px;" scope="col">Jasa Kirim</th>
</tr>
</thead>
<tbody>
<tr style="height: 39.1875px; text-align: center;">
<th style="height: 39.1875px;"><?= $checkout['invoice']; ?></th>
<td style="height: 39.1875px;"><?= (isset($paymentStatus->settlement_time)) ? $paymentStatus->settlement_time : 'error'; ?></td>
<td style="height: 39.1875px;"><?= ucwords(str_replace("_", " ", (isset($paymentStatus->payment_type)) ? $paymentStatus->payment_type : 'error')); ?><br><?php if (isset($paymentStatus->va_numbers[0])) : ?><?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?><?php endif ?></td>
<td style="height: 39.1875px;"><?= $checkout['kurir']; ?><br><?= $checkout['service']; ?></td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="row">
<div class="col">
<h3>Rincian Pesanan</h3>
<table class="table text-center" style="border-collapse: collapse; width: 100%; border-color: #000000; height: 137.157px;" border="1">
<thead>
<tr style="height: 19.5938px;">
<th style="height: 19.5938px;" scope="col">No</th>
<th style="height: 19.5938px;" scope="col">Produk</th>
<th style="height: 19.5938px;" scope="col">Variasi</th>
<th style="height: 19.5938px;" scope="col">Harga Produk</th>
<th style="height: 19.5938px;" scope="col">Qty</th>
<th class="text-end" style="height: 19.5938px;" scope="col">Subtotal</th>
</tr>
</thead>
<tbody>
<?php $i = 1;
foreach ($produk as $p) : ?>    
<tr style="height: 19.5938px;">
<th style="height: 19.5938px;" scope="row"><?= $i++; ?></th>
<td style="height: 19.5938px;"><?= $p['nama']; ?></td>
<td style="height: 19.5938px;"><?= $p['value_item']; ?> (<?= $p['berat']; ?>garm)</td>
<td style="height: 19.5938px; text-align: right;">Rp. <?= number_format($p['harga_item'], 0, ',', '.'); ?></td>
<td style="height: 19.5938px; text-align: right;"><?= $p['qty']; ?></td>
<td class="text-end" style="height: 19.5938px; text-align: right;">Rp. <?= number_format(($p['harga_item'] * $p['qty']), 0, ',', '.'); ?></td>
</tr>
<?php endforeach ?>
<tr style="height: 19.5938px;">
<td class="text-end fw-bold" style="text-align: right; height: 19.5938px;" colspan="5"><strong>Total Harga</strong></td>
<td class="text-end" style="height: 19.5938px; text-align: right;"> Rp. <?= number_format($checkout['total_1'], 0, ',', '.'); ?></td>
</tr>
<tr style="height: 19.5938px; text-align: right;">
<td class="text-end fw-bold" style="height: 19.5938px;" colspan="5"><strong>Total Ongkos Kirim</strong></td>
<td class="text-end" style="height: 19.5938px;">Rp. <?= number_format($checkout['harga_service'], 0, ',', '.'); ?></td>
</tr>
<tr style="height: 19.5938px; text-align: right;">
<td class="text-end fw-bold" style="height: 19.5938px;" colspan="5"><strong>Subtotal</strong></td>
<td class="text-end" style="height: 19.5938px;">Rp. <?= number_format($checkout['total_2'], 0, ',', '.'); ?></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</textarea>
<?php if ((int)$checkout['id_status_pesan'] > 2) : ?>
    <script>
        Swal.fire({
            title: 'Are you sure?',
            text: "<?= $status['deskripsi']; ?> anda yakin ingin mencetak ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Oke!',
                    '¯\\_(ツ)_/¯',
                    'success'
                )
            } else(
                history.back()
            )
        })
    </script>
<?php endif ?>
<?= $this->endSection(); ?>
<!-- <p>&nbsp;</p> -->
<p><!-- pagebreak --></p>
<!-- <p>lorm</p> -->