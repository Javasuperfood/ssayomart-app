<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>

</head>
<!-- <div class="d-blok"> -->

<textarea id="open-source-plugins">
<!-- Content -->
<h1 style="text-align: center;"><span style="text-decoration: underline;">Data Penjualan Aplikasi Ssayomart - <?= $getCheckoutWithProduct[0]['lable'] ?></span></h1>
<!-- End of Content -->
<table class="table table-border-bottom-0 table-striped" style="border-collapse: collapse; width: 100.015%; height: 100.18px;" border="1">
<tbody>
<tr style="height: 34.3229px;">
<td style="height: 51.9097px; text-align: center; width: 2.54568%;" rowspan="2">No</td>
<td style="height: 51.9097px; text-align: center; width: 9.52811%;" rowspan="2">INV</td>
<td style="height: 32.3264px; text-align: center; width: 40.7309%;" colspan="3">Produk</td>
<td style="text-align: center; width: 20.4479%; height: 44.3229px;" rowspan="2">Nama</td>
<td style="height: 51.9097px; text-align: center; width: 6.76417%;" rowspan="2">Total 1&nbsp;</td>
<td style="height: 51.9097px; text-align: center; width: 6.76429%;" rowspan="2">Total 2</td>
<td style="height: 51.9097px; text-align: center; width: 8.21891%;" rowspan="2">Tanggal</td>
</tr>
<tr style="height: 10px;">
<td style="width: 29.8935%; text-align: center; height: 19.5833px;">Nama Produk</td>
<td style="width: 7.1279%; text-align: center; height: 19.5833px;">SKU</td>
<td style="width: 3.70942%; text-align: center; height: 19.5833px;">Qty</td>
</tr>
<?php foreach ($getCheckoutWithProduct as $p) : ?>
<tr style="height: 106.319px;">
<td style="width: 2.54568%; height: 48.2708px;"><?= $iterasi++; ?></td>
<td style="width: 9.52811%; height: 48.2708px;"><?= $p['invoice']; ?></td>
<td style="width: 29.8935%; height: 48.2708px;">
<p style="text-align: center;">
    <?php
    $namaProduk = '';
    $varianProduk = '';
    foreach ($p['produk'] as $pr) {
        $namaProduk .= $pr['nama'] . ' - ' . $pr['value_item'] . '<br>';
    }
    echo $namaProduk;
    ?>
</p>
</td>
<td style="width: 7.1749%; height: 48.2708px;">
<p style="text-align: center;">
    <?php
    $skuProduk = '';
    foreach ($p['produk'] as $pr) {
        $skuProduk .= $pr['sku'] . '<br>';
    }
    echo $skuProduk;
    ?>
</p>
</td>
<td style="width: 3.73066%; height: 48.2708px;">
<p style="text-align: center;">
    <?php
    $jumlahProduk = '';
    foreach ($p['produk'] as $pr) {
        $jumlahProduk .= $pr['qty'] . '<br>';
    }
    echo $jumlahProduk;
    ?>
</p>
</td>
<td style="width: 20.4479%; text-align: center; height: 48.2708px;"><?= $p['fullname']; ?></td>
<td style="width: 6.02676%; height: 48.2708px;"><?= number_format($p['total_1'], 0, ',', '.'); ?></td>
<td style="width: 6.0985%; height: 48.2708px;"><?= number_format($p['total_2'], 0, ',', '.'); ?></td>
<td style="width: 6.31374%; text-align: center; height: 48.2708px;"><?= date("d-m-Y", strtotime($p['created_at'])); ?></td>
</tr>
<?php endforeach ?>
</tbody>
</table>
</textarea>
<!-- </div> -->
<?= $pager->links('checkout', 'pagerS') ?>

<?= $this->endSection(); ?>