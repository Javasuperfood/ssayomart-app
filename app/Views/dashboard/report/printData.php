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
<h1 style="text-align: center;"><span style="text-decoration: underline;">Report Penjualan Aplikasi Ssayomart</span></h1>
<!-- End of Content -->
<table class="table table-border-bottom-0 table-striped" style="border-collapse: collapse; width: 100.022%; height: 58.75px;" border="1">
<tbody>
<tr style="height: 19.5833px;">
<td style="width: 2.79796%; height: 19.5833px; text-align: center;">No</td>
<td style="width: 10.2592%; height: 19.5833px; text-align: center;">Toko</td>
<td style="width: 8.39389%; height: 19.5833px; text-align: center;">INV</td>
<td style="width: 23.2446%; height: 19.5833px; text-align: center;">Produk</td>
<td style="width: 23.2446%; text-align: center;">Nama</td>
<td style="width: 6.02638%; height: 19.5833px; text-align: center;">Total 1&nbsp;</td>
<td style="width: 6.31335%; height: 19.5833px; text-align: center;">Total 2</td>
<td style="width: 19.7292%; height: 19.5833px; text-align: center;">Tanggal</td>
</tr>
 <?php foreach ($getCheckoutWithProduct as $p) : ?>
<tr style="height: 39.1667px;">
<td style="width: 2.76367%; height: 39.1667px;"><?= $iterasi++; ?></td>
<td style="width: 10.2547%; height: 39.1667px;"><?= $p['lable']; ?></td>
<td style="width: 16.1457%; height: 39.1667px;"><?= $p['invoice']; ?></td>
<td style="width: 23.2003%; height: 39.1667px;">
<?php foreach ($p['produk'] as $pr) : ?>
<table style="border-collapse: collapse; width: 100.333%;" border="1">
<tbody>
<tr>
<td style="width: 45.4813%;"><?= $pr['nama']; ?> (<?= $pr['value_item']; ?>)</td>
<td style="width: 54.5131%;" rowspan="2">Jumlah: <?= $pr['qty']; ?></td>
</tr>
<tr>
<td style="width: 45.4813%;">SKU: <?= $pr['sku']; ?></td>
</tr>
</tbody>
</table>
<?php endforeach; ?>
</td>
<td style="width: 23.2446%; text-align: center;"><?= $p['fullname']; ?></td>
<td style="width: 6.02638%; height: 39.1667px;"><?= number_format($p['total_1'], 0, ',', '.'); ?></td>
<td style="width: 6.31335%; height: 39.1667px;"><?= number_format($p['total_2'], 0, ',', '.'); ?></td>
<td style="width: 19.7292%; height: 39.1667px;"><?= date("d-m-Y", strtotime($p['created_at'])); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</textarea>
<!-- </div> -->
<?= $pager->links('checkout', 'pagerS') ?>

<?= $this->endSection(); ?>
<!-- <p>&nbsp;</p> -->

<!-- <p>lorm</p> -->