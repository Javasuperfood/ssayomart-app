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
<table style="border-collapse: collapse; width: 99.9995%;" border="1">
<thead>
<tr>
<th style="width: 3.28862%; text-align: center;">No</th>
<th style="width: 30.0915%; text-align: center;">Toko</th>
<th style="width: 16.6901%; text-align: center;">INV</th>
<th style="width: 16.6901%; text-align: center;">Produk</th>
<th style="width: 16.6901%; text-align: center;">Total</th>
<th style="width: 16.566%; text-align: center;">Tanggal Pembelian</th>
</tr>
</thead>
<tbody>
<?php foreach ($getCheckoutWithProduct as $p) : ?>
<tr>
<td style="width: 3.28862%; text-align: center;"><?= $iterasi++; ?></td>
<td style="width: 30.0915%; text-align: center;"><?= $p['lable']; ?></td>
<td style="width: 16.6901%; text-align: center;"><?= $p['invoice']; ?></td>
<td style="width: 16.6901%; text-align: center;">
<table style="border-collapse: collapse; width: 100.674%;" border="1">
<tbody>
<tr>
<td style="width: 44.3103%;"><?= $p['nama']; ?></td>
<td style="width: 55.682%;" rowspan="2">Qty : <?= $p['qty']; ?></td>
</tr>
<tr>
<td style="width: 44.3103%;">SKU : <?= $p['sku']; ?></td>
</tr>
</tbody>
</table>
</td>
<td style="width: 16.6901%; text-align: center;">90.000</td>
<td style="width: 16.566%; text-align: center;"><?= date("d-m-Y", strtotime($p['created_at']));  ?></td>
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