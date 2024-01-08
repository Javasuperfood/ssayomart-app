<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 text-center bg-light mb-4 px-2 py-2">
  <h1 class="h3 mb-2 text-dark fw-bold">Panduan Aplikasi</h1>
</div>

<div class="row">
  <div class="col-lg-4">
    <div class="card border-0 bg-light">
      <h5 class=" mb-2 text-dark fw-bold">Menu</h5>
    </div>
    <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
      <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1" aria-selected="true">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
      </a>
      <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2" aria-selected="false">
        <i class="bi bi-file-text-fill me-2"></i> Report
      </a>
      <a href="#tab3" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab3" aria-selected="false">
        <i class="fas fa-fw fa-receipt me-2"></i> Pesanan
      </a>
      <a href="#tab4" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab4" aria-selected="false">
        <i class="bi bi-box2-fill me-2"></i> Produk Menu
      </a>
      <a href="#tab5" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab5" aria-selected="false">
        <i class="fas fa-fw fa-table me-2"></i> Kategori Menu
      </a>
      <a href="#tab6" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab6" aria-selected="false">
        <i class="fas fa-fw fa-cog me-2"></i> Management Content
      </a>
      <a href="#tab7" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab7" aria-selected="false">
        <i class="fas fa-fw fa-folder me-2"></i> Kupon
      </a>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card border-0 bg-light">
      <h5 class=" mb-2 text-dark fw-bold">Panduan</h5>
    </div>
    <div class="tab-content" id="faq-tab-content">
      <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
        <div class="accordion" id="accordion-tab-1">
          <div class="card">
            <div class="card-header" id="accordion-tab-1-heading-1">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-1" aria-expanded="false" aria-controls="accordion-tab-1-content-1">Apa fungsi menu Dahsboard?</button>
              </h5>
            </div>
            <div class="collapse show" id="accordion-tab-1-content-1" aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
              <div class="card-body">
                <p><strong>Pada bagian tabel, </strong>pengguna dapat melihat detail produk seperti Toko, Nama Produk, Variasi Item dan Stok. Fitur pengurutan memungkinkan pengguna menyusun data berdasarkan bulan dan tahun untuk analisis yang lebih terfokus.</p>
                <p><strong>Pada bagian chart, </strong>grafik memberikan visualisasi distribusi stok untuk pemantauan yang cepat. Dashboard ini terus terupdate secara real-time, memastikan informasi selalu terkini. Fitur pemantauan inventaris dilengkapi dengan peringatan otomatis. Dengan penambahan fitur pengurutan, pengelolaan persediaan ssayomart menjadi lebih efisien.</p>
                <p><strong>Nb: </strong>Silahkan liat pada halaman dashboard</p>
              </div>
            </div>
          </div>
          <!-- <div class="card">
            <div class="card-header" id="accordion-tab-1-heading-2">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-2" aria-expanded="false" aria-controls="accordion-tab-1-content-2">Bender, I didn't know you liked cooking?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-1-content-2" aria-labelledby="accordion-tab-1-heading-2" data-parent="#accordion-tab-1">
              <div class="card-body">
                <p>That's so cute. Can we have Bender Burgers again? Is the Space Pope reptilian!? I wish! It's a nickel. Bender! Ship! Stop bickering or I'm going to come back there and change your opinions manually!</p>
                <p><strong>Example: </strong>Okay, I like a challenge. Is that a cooking show? No argument here.</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-1-heading-3">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-3" aria-expanded="false" aria-controls="accordion-tab-1-content-3">My fellow Earthicans?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-1-content-3" aria-labelledby="accordion-tab-1-heading-3" data-parent="#accordion-tab-1">
              <div class="card-body">
                <p>As I have explained in my book 'Earth in the Balance', and the much more popular 'Harry Potter and the Balance of Earth', we need to defend our planet against pollution. Also dark wizards. Fry, you can't just sit here in the dark listening to classical music.</p>
                <p><strong>Example: </strong>Actually, that's still true. Well, let's just dump it in the sewer and say we delivered it.</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-1-heading-4">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-4" aria-expanded="false" aria-controls="accordion-tab-1-content-4">Who am I making this out to?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-1-content-4" aria-labelledby="accordion-tab-1-heading-4" data-parent="#accordion-tab-1">
              <div class="card-body">
                <p>Morbo can't understand his teleprompter because he forgot how you say that letter that's shaped like a man wearing a hat. Also Zoidberg. Can we have Bender Burgers again? Goodbye, cruel world. Goodbye, cruel lamp. Goodbye, cruel velvet drapes, lined with what would appear to be some sort of cruel muslin and the cute little pom-pom curtain pull cords.</p>
                <p><strong>Example: </strong>Cruel though they may be...</p>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <!-- tab 2 -->
      <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
        <div class="accordion" id="accordion-tab-2">
          <div class="card">
            <div class="card-header" id="accordion-tab-2-heading-1">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-1" aria-expanded="false" aria-controls="accordion-tab-2-content-1">Fungsi Menu Report?</button>
              </h5>
            </div>
            <div class="collapse show" id="accordion-tab-2-content-1" aria-labelledby="accordion-tab-2-heading-1" data-parent="#accordion-tab-2">
              <div class="card-body">
                <ul>
                  <p><strong>Report penjualan ssayomart memberikan gambaran komprehensif kinerja penjualan. </strong></p>
                  <br>
                  <li><strong>Tabel</strong> laporan menampilkan data transaksi, seperti tanggal, jumlah item terjual, dan total pendapatan. Pengguna dapat dengan mudah mengurutkan data berdasarkan bulan atau kategori produk.</li>
                  <li><strong>Grafik</strong> dalam laporan memberikan visualisasi dinamis tentang penjualan, mencakup pertumbuhan bulanan, perbandingan kategori produk, dan tren harian. Laporan selalu terupdate secara otomatis untuk memastikan akurasi data terbaru.</li>
                  <li><strong>Download PDF </strong>Selain itu, untuk kemudahan pengguna, terdapat tombol "Download PDF" yang memungkinkan pengguna untuk mengunduh laporan penjualan dalam format PDF dengan satu klik mudah.</li>
                </ul>
                <p><strong>Nb: </strong>Anda dapat melihat tampilannya pada menu Report</p>
              </div>
            </div>
          </div>
          <!-- <div class="card">
            <div class="card-header" id="accordion-tab-2-heading-2">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-2" aria-expanded="false" aria-controls="accordion-tab-2-content-2">This opera's as lousy as it is brilliant?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-2-content-2" aria-labelledby="accordion-tab-2-heading-2" data-parent="#accordion-tab-2">
              <div class="card-body">
                <p>Your lyrics lack subtlety. You can't just have your characters announce how they feel. That makes me feel angry! It's okay, Bender. I like cooking too. Interesting. No, wait, the other thing: tedious.</p>
                <p><strong>Example: </strong>Of all the friends I've had… you're the first. But I know you in the future. I cleaned your poop. Then we'll go with that data file!</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-2-heading-3">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-3" aria-expanded="false" aria-controls="accordion-tab-2-content-3">Who are you, my warranty?!</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-2-content-3" aria-labelledby="accordion-tab-2-heading-3" data-parent="#accordion-tab-2">
              <div class="card-body">
                <p>Oh, I think we should just stay friends. I'll tell them you went down prying the wedding ring off his cold, dead finger. Aww, it's true. I've been hiding it for so long. Say it in Russian! Then throw her in the laundry room, which will hereafter be referred to as "the brig".</p>
                <p><strong>Example: </strong> We're rescuing ya. Robot 1-X, save my friends! And Zoidberg! <em>Then we'll go with that data file!</em> Okay, I like a challenge.</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-2-heading-4">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-4" aria-expanded="false" aria-controls="accordion-tab-2-content-4">I haven't felt much of anything since my guinea pig died?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-2-content-4" aria-labelledby="accordion-tab-2-heading-4" data-parent="#accordion-tab-2">
              <div class="card-body">
                <p>And I'm his friend Jesus. Oh right. I forgot about the battle. OK, if everyone's finished being stupid. We'll need to have a look inside you with this camera. I'm just glad my fat, ugly mama isn't alive to see this day.</p>
                <p><strong>Example: </strong> Isn't it true that you have been paid for your testimony? Quite possible.</p>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <!-- tab 3 -->
      <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
        <div class="accordion" id="accordion-tab-3">
          <div class="card">
            <div class="card-header" id="accordion-tab-3-heading-1">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-1" aria-expanded="false" aria-controls="accordion-tab-3-content-1">Panduan Menu Pesanan</button>
              </h5>
            </div>
            <div class="collapse show" id="accordion-tab-3-content-1" aria-labelledby="accordion-tab-3-heading-1" data-parent="#accordion-tab-3">
              <div class="card-body">
                <ul>
                  <li>
                    <p><strong>Menu Pesanan</strong> menampilkan daftar pesanan yang telah diterima. Admin dapat melihat detail pesanan, seperti tanggal, nama pelanggan, dan total harga. Selain itu, pengguna dapat mengubah status pesanan menjadi "Dalam Proses", "Dalam Perjalanan", atau "Terkirim".</p>
                  </li>
                  <br>
                  <li>
                    <p>Admin dapat merubah status pesanan melalui menu titik tiga pada bagian tabel "Aksi" disitu terdapat beberapa menu lainnya seperti "Print", "Update Status", "Resfund", "Detail"</p>
                    <ul>
                      <li><strong>Print</strong> digunakan untuk mencetak pesanan</li>
                      <li><strong>Update Status</strong> digunakan untuk merubah status pesanan</li>
                      <li><strong>Refund</strong> digunakan untuk merubah status pengembalian barang</li>
                      <li><strong>Detail</strong> digunakan untuk melihat detail pesanan</li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-3-heading-2">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-2" aria-expanded="false" aria-controls="accordion-tab-3-content-2">Panduan Menunggu Pembayaran</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-3-content-2" aria-labelledby="accordion-tab-3-heading-2" data-parent="#accordion-tab-3">
              <div class="card-body">
                <ul>
                  <li>
                    <p><strong>Menunggu pembayaran</strong></p>
                  <li>Menampilkan semua pesanan yang belum melakukan pembayaran, Admin dapat melihat detail pesanan, seperti tanggal, nama pelanggan, alamat, metode pengiriman, dan nomer pemesanan "INV"". </li>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-3-heading-3">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-3" aria-expanded="false" aria-controls="accordion-tab-3-content-3">Panduan Menu dalam Proses</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-3-content-3" aria-labelledby="accordion-tab-3-heading-3" data-parent="#accordion-tab-3">
              <div class="card-body">
                <ul>
                  <li>
                    <p><strong>Menu Dalam Proses</strong></p>
                  <li>Menampilkan semua pesanan yang sedang dalam proses, Admin dapat melihat detail pesanan, seperti tanggal, nama pelanggan, alamat, metode pengiriman, dan status pesanan saat ini. </li>
                  <li>Admin dapat merubah status pesanan melalui menu titik tiga pada bagian tabel "Aksi" disitu terdapat beberapa menu lainnya seperti "Print", "Update Status", "Refund", "Detail"</li>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-3-heading-4">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-4" aria-expanded="false" aria-controls="accordion-tab-3-content-4">Panduan Menu Dalam Perjalanan</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-3-content-4" aria-labelledby="accordion-tab-3-heading-4" data-parent="#accordion-tab-3">
              <div class="card-body">
                <ul>
                  <li>
                    <p><strong>Menu Dalam Perjalanan</strong></p>
                  <li>Menampilkan semua pesanan yang sedang dalam perjalanan, Admin dapat melihat detail pesanan, seperti tanggal, nama pelanggan, alamat, metode pengiriman, dan status pesanan saat ini. </li>
                  <li>Admin dapat merubah status pesanan melalui menu titik tiga pada bagian tabel "Aksi" disitu terdapat beberapa menu lainnya seperti "Print", "Update Status", "Refund", "Detail"</li>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-3-heading-5">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-5" aria-expanded="false" aria-controls="accordion-tab-3-content-5">Panduan Menu Pesanan Terkirim</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-3-content-5" aria-labelledby="accordion-tab-3-heading-5" data-parent="#accordion-tab-3">
              <div class="card-body">
                <ul>
                  <li>
                    <p><strong>Menu Pesanan Terkirim</strong></p>
                  <li>Menampilkan semua pesanan yang sudah terkirim dan di terima, Admin dapat melihat detail pesanan, seperti tanggal, nama pelanggan, alamat, metode pengiriman, dan status pesanan saat ini.</li>
                  <li>Admin dapat merubah status pesanan melalui menu titik tiga pada bagian tabel "Aksi" disitu terdapat beberapa menu lainnya seperti "Print", "Update Status", "Refund", "Detail"</li>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-3-heading-6">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-6" aria-expanded="false" aria-controls="accordion-tab-3-content-6">Panduan Menu Refund</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-3-content-6" aria-labelledby="accordion-tab-3-heading-6" data-parent="#accordion-tab-3">
              <div class="card-body">
                <ul>
                  <li>
                    <p><strong>Menu Refund</strong></p>\
                  <li>digunakan untuk melihat pesanan mana saja yang akan mendapatkan kompensasi atau user yang minta di tukar barang ataupun dalam bentuk nominal uang pembelian</li>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- tab 4 -->
      <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4">
        <div class="accordion" id="accordion-tab-4">
          <div class="card">
            <div class="card-header" id="accordion-tab-4-heading-1">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-1" aria-expanded="false" aria-controls="accordion-tab-4-content-1">Menu List Produk</button>
              </h5>
            </div>
            <div class="collapse show" id="accordion-tab-4-content-1" aria-labelledby="accordion-tab-4-heading-1" data-parent="#accordion-tab-4">
              <div class="card-body">
                <ul>
                  <li>
                    <p><strong>Menu List Produk</strong></p>
                  <li>Menampilkan semua produk yang ada di ssayomart, Admin dapat melihat detail produk, seperti nama produk, harga, stok, dan Varian Stok. </li>
                  <li>Admin dapat merubah status produk melalui menu titik tiga pada bagian tabel "Aksi" disitu terdapat beberapa menu lainnya seperti "Edit", "Hapus", "Detail"</li>
                  <ul>
                    <li><strong>Lihat Produk</strong> digunakan untuk melihat detail produk</li>
                    <li><strong>Detail Varian</strong> melihat varian detail dari produk</li>
                    <li><strong>Update</strong> digunakan untuk melihat menghapus maupun mengubah informasi produk</li>
                    <li><strong>Stock</strong> digunakan untuk menambahkan jumlah stok yang tersedia</li>
                  </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-4-heading-2">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-2" aria-expanded="false" aria-controls="accordion-tab-4-content-2">Menu Tambah Produk</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-4-content-2" aria-labelledby="accordion-tab-4-heading-2" data-parent="#accordion-tab-4">
              <div class="card-body">
                <ul>
                  <p><strong>Menu Tambah Produk</strong></p>
                  <li>Pada menu ini admin dapat menginputkan produk yang nantinya akan dijual <strong>NAMUN HARUS MEMBACA PANDUAN YANG ADA PADA BAGIAN ATAS FORM TAMBAH PRODUK GAMBAR HARUS BERUKURAN 500 X 500 DAN DALAM BENTUK YANG SUDAH DI CONTOHKAN PADA HALAMAN TAMBAH PRODUK</strong></li>
                  <br>
                  <p><strong>Nb :</strong> Anda dapat melihat ketentuannya pada halaman Produk Menu, "Tambah Produk" <strong>TELITI LAH ANDA SEBAGAI ADMIN DAN BERTANGGUNG JAWAB</strong></p>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-4-heading-3">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-3" aria-expanded="false" aria-controls="accordion-tab-4-content-3">Menu Tambah Produk Kategori Batch</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-4-content-3" aria-labelledby="accordion-tab-4-heading-3" data-parent="#accordion-tab-4">
              <div class="card-body">
                <ul>

                  <p><strong>Menu Tambah Produk Kategori Batch</strong></p>
                  <li>Fungsi ini dalam tahap <strong>Disable</strong> </li>

                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-4-heading-4">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-4" aria-expanded="false" aria-controls="accordion-tab-4-content-4">Menu Tambah Variasi</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-4-content-4" aria-labelledby="accordion-tab-4-heading-4" data-parent="#accordion-tab-4">
              <div class="card-body">
                <ul>

                  <p><strong>Menu Tambah Variasi</strong></p>
                  <li>Fungsi ini berguna untuk menabahkan variasi produk <strong>contoh :</strong> "Rasa", Gramasi dan Lain-lain</li>

                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-4-heading-5">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-5" aria-expanded="false" aria-controls="accordion-tab-4-content-5">Fetching Produk</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-4-content-5" aria-labelledby="accordion-tab-4-heading-5" data-parent="#accordion-tab-4">
              <div class="card-body">
                <ul>
                  <li>
                    <p><strong><i class="bi bi-hand-thumbs-up-fill"></i> Menu Pilih Produk Rekomendasi</strong></p>
                    <p>Digunakan untuk menampilkan produk rekomendasi yang akan ditampilkan pada halaman homepage user</p>
                  </li>
                  <li>
                    <p><strong><i class="bi bi-menu-button-wide-fill"></i> Menu Ubah Urutan Produk</strong></p>
                    <p>Digunakan untuk menampilkan produk terbaru yang akan ditampilkan pada halaman homepage user</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-4-heading-6">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-6" aria-expanded="false" aria-controls="accordion-tab-4-content-6">Buat Promosi</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-4-content-6" aria-labelledby="accordion-tab-4-heading-6" data-parent="#accordion-tab-4">
              <div class="card-body">
                <ul>
                  <p><strong>Menu Buat Promosi</strong></p>
                  <li>Digunakan Admin untuk membuat promosi atau diskon yang sedang berlangsung di Ssayomart terdapat head judul table seperti "Judul Promo", "Waktu mulai promo" dan "Akhir promo berlangsung"</li>
                  <li>di sebelah kanan anda sebagai admin dapat melihat previewnya</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-4-heading-7">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-7" aria-expanded="false" aria-controls="accordion-tab-4-content-7">Tambah Promosi Produk</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-4-content-7" aria-labelledby="accordion-tab-4-heading-7" data-parent="#accordion-tab-4">
              <div class="card-body">
                <ul>
                  <p><strong>Menu Tambah Promosi Produk</strong></p>
                  <li>digunakan sebagai pembuatan promo produk, sehingga anda dapat membuat produk mana saja yang akan di jadikan promo dengan cara:</li>
                  <li>memilih produk mana saja yang akan di jadikan promo dan berikan judul promo</li>
                  <li>masukan diskon dan jangan lupa masukan persyaratan diskon apa saja</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-4-heading-8">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-8" aria-expanded="false" aria-controls="accordion-tab-4-content-8">Tambah Promosi Produk - Batch</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-4-content-8" aria-labelledby="accordion-tab-4-heading-8" data-parent="#accordion-tab-4">
              <div class="card-body">
                <ul>
                  <p><strong>Menu Tambah Promosi Produk - Batch</strong></p>
                  <li>digunakan sebagai pembuatan promo produk semua produk, sehingga anda dapat membuat produk mana saja yang akan di jadikan promo dengan cara:</li>
                  <li>memilih produk mana saja yang akan di jadikan promo dan berikan judul promo</li>
                  <li>masukan diskon dan jangan lupa masukan persyaratan diskon apa saja</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- tab 5 -->
      <div class="tab-pane" id="tab5" role="tabpanel" aria-labelledby="tab5">
        <div class="accordion" id="accordion-tab-5">
          <div class="card">
            <div class="card-header" id="accordion-tab-5-heading-1">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-1" aria-expanded="false" aria-controls="accordion-tab-5-content-1">Menu List Kategori</button>
              </h5>
            </div>
            <div class="collapse show" id="accordion-tab-5-content-1" aria-labelledby="accordion-tab-5-heading-1" data-parent="#accordion-tab-5">
              <div class="card-body">
                <ul>
                  <p><strong>Menu List Kategori</strong></p>
                  <li>Admin dapat menambah kategori pada button <strong>Tambah Kategori & Sub-Kategori</strong></li>
                  <li>Admin juga dapat mengubah urutan kategori yang akan di tampilkan</li>
                  <li>Menampilkan semua kategori yang ada di ssayomart, Admin dapat melihat detail kategori, seperti nama kategori, dan jumlah sub-kategori yang ada di kategori tersebut. </li>
                  <li>Admin dapat merubah status kategori melalui menu titik tiga pada bagian tabel "Aksi" disitu terdapat beberapa menu lainnya seperti "update", "Hapus".</li>
                  <ul>
                    <li><strong>Update</strong> digunakan untuk edit kategori yang dipilih</li>
                    <li><strong>Hapus</strong> digunakan untuk menghapus kategori</li>
                  </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-5-heading-2">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-2" aria-expanded="false" aria-controls="accordion-tab-5-content-2">Tambah Kategori</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-5-content-2" aria-labelledby="accordion-tab-5-heading-2" data-parent="#accordion-tab-5">
              <div class="card-body">
                <ul>
                  <p>Menu Tambah Kategori</p>
                  <li>Admin dapat menambahkan kategori yang akan di tampilkan pada halaman user <strong>dengan ketentuan yang sudah di berikan tolong baca dan terapkan apabila tidak ingin kerja bolak balik</strong></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-5-heading-3">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-3" aria-expanded="false" aria-controls="accordion-tab-5-content-3">Ubah Urutan Kategori</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-5-content-3" aria-labelledby="accordion-tab-5-heading-3" data-parent="#accordion-tab-5">
              <div class="card-body">
                <ul>
                  <p>Menu Ubah Urutan Kategori</p>
                  <li>Admin dapat mengubah urutan kategori yang akan di tampilkan pada halaman user, anda dapat menggunakan fitur <strong>Dropdown</strong> atau <strong>Dropup</strong> untuk mengubah urutan Kategori</li>
                </ul>
              </div>
            </div>
          </div>
          <!-- <div class="card">
            <div class="card-header" id="accordion-tab-5-heading-4">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-4" aria-expanded="false" aria-controls="accordion-tab-5-content-4">And until then, I can never die?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-5-content-4" aria-labelledby="accordion-tab-5-heading-4" data-parent="#accordion-tab-5">
              <div class="card-body">
                <p>I don't know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Well, let's just dump it in the sewer and say we delivered it.</p>
                <p><strong>Example: </strong>Have you ever tried just turning off the TV, sitting down with your children, and hitting them? Hey, tell me something. You've got all this money. How come you always dress like you're doing your laundry?</p>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <!-- tab 6 -->
      <div class="tab-pane" id="tab6" role="tabpanel" aria-labelledby="tab6">
        <div class="accordion" id="accordion-tab-6">
          <div class="card">
            <div class="card-header" id="accordion-tab-6-heading-1">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-1" aria-expanded="false" aria-controls="accordion-tab-6-content-1">Banner</button>
              </h5>
            </div>
            <div class="collapse show" id="accordion-tab-6-content-1" aria-labelledby="accordion-tab-6-heading-1" data-parent="#accordion-tab-6">
              <div class="card-body">
                <p>Menu Artikel</p>
                <li>Banner Homepage</li>
                <p>digunakan sebagai menambahkan Banner informasi pada tampilan homepage user pada banner tersebut juga disediakan banner konten anda dapat menginputkan pada form yang sudah di sediakan dan isikan sesuai ketentuan yang ada</p>
                <li>Banner Artikel/ Blog Konten</li>
                <p><strong>I'm Sorry this Content we have disable</strong></p>
                <li>Pop-up Homepage</li>
                <p>digunakan sebagai pop-up information yang nantinya akan muncul pada aplikasi maupun website pada saat pertama kali masuk kedalam apps</p>
                <li>Banner Promosi</li>
                <p>digunakan sebagai menambahkan Banner informasi promo pada tampilan homepage user pada banner tersebut juga disediakan banner konten anda dapat menginputkan pada form yang sudah di sediakan dan isikan sesuai ketentuan yang ada</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-6-heading-2">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-2" aria-expanded="false" aria-controls="accordion-tab-6-content-2">Artikel</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-6-content-2" aria-labelledby="accordion-tab-6-heading-2" data-parent="#accordion-tab-6">
              <div class="card-body">
                <ul>
                  <p><strong>I'm Sorry this Content we have disable</strong></p>
                </ul>
              </div>
            </div>
          </div>
          <!-- <div class="card">
            <div class="card-header" id="accordion-tab-6-heading-3">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-3" aria-expanded="false" aria-controls="accordion-tab-6-content-3">Tell her you just want to talk?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-6-content-3" aria-labelledby="accordion-tab-6-heading-3" data-parent="#accordion-tab-6">
              <div class="card-body">
                <p>It has nothing to do with mating. Soon enough. There, now he's trapped in a book I wrote: a crummy world of plot holes and spelling errors! Daylight and everything. Hey! I'm a porno-dealing monster, what do I care what you think?</p>
                <p><strong>Example: </strong>Is that a cooking show? It doesn't look so shiny to me. And why did 'I' have to take a cab?</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-6-heading-4">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-4" aria-expanded="false" aria-controls="accordion-tab-6-content-4">Good man. Nixon's pro-war and pro-family?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-6-content-4" aria-labelledby="accordion-tab-6-heading-4" data-parent="#accordion-tab-6">
              <div class="card-body">
                <p>I don't 'need' to drink. I can quit anytime I want! THE BIG BRAIN AM WINNING AGAIN! I AM THE GREETEST! NOW I AM LEAVING EARTH, FOR NO RAISEN! There's one way and only one way to determine if an animal is intelligent. Dissect its brain!</p>
                <p><strong>Example: </strong>Guess again. Yeah, I do that with my stupidness. And when we woke up, we had these bodies.</p>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <!-- tab 7 -->
      <div class="tab-pane" id="tab7" role="tabpanel" aria-labelledby="tab7">
        <div class="accordion" id="accordion-tab-7">
          <div class="card">
            <div class="card-header" id="accordion-tab-7-heading-1">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-7-content-1" aria-expanded="false" aria-controls="accordion-tab-7-content-1">Menu Kupon</button>
              </h5>
            </div>
            <div class="collapse show" id="accordion-tab-7-content-1" aria-labelledby="accordion-tab-7-heading-1" data-parent="#accordion-tab-7">
              <div class="card-body">
                <p><strong>
                    Menu Kupon
                  </strong></p>
                <li>digunakan sebagai pembuatan kupon yang nantinya akan di berikan kepada user</li>
              </div>
            </div>
          </div>
          <!-- <div class="card">
            <div class="card-header" id="accordion-tab-7-heading-2">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-7-content-2" aria-expanded="false" aria-controls="accordion-tab-7-content-2">Artikel</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-7-content-2" aria-labelledby="accordion-tab-7-heading-2" data-parent="#accordion-tab-7">
              <div class="card-body">
                <ul>
                  <p><strong>I'm Sorry this Content we have disable</strong></p>
                </ul>
              </div>
            </div>
          </div> -->
          <!-- <div class="card">
            <div class="card-header" id="accordion-tab-6-heading-3">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-3" aria-expanded="false" aria-controls="accordion-tab-6-content-3">Tell her you just want to talk?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-6-content-3" aria-labelledby="accordion-tab-6-heading-3" data-parent="#accordion-tab-6">
              <div class="card-body">
                <p>It has nothing to do with mating. Soon enough. There, now he's trapped in a book I wrote: a crummy world of plot holes and spelling errors! Daylight and everything. Hey! I'm a porno-dealing monster, what do I care what you think?</p>
                <p><strong>Example: </strong>Is that a cooking show? It doesn't look so shiny to me. And why did 'I' have to take a cab?</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="accordion-tab-6-heading-4">
              <h5>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-4" aria-expanded="false" aria-controls="accordion-tab-6-content-4">Good man. Nixon's pro-war and pro-family?</button>
              </h5>
            </div>
            <div class="collapse" id="accordion-tab-6-content-4" aria-labelledby="accordion-tab-6-heading-4" data-parent="#accordion-tab-6">
              <div class="card-body">
                <p>I don't 'need' to drink. I can quit anytime I want! THE BIG BRAIN AM WINNING AGAIN! I AM THE GREETEST! NOW I AM LEAVING EARTH, FOR NO RAISEN! There's one way and only one way to determine if an animal is intelligent. Dissect its brain!</p>
                <p><strong>Example: </strong>Guess again. Yeah, I do that with my stupidness. And when we woke up, we had these bodies.</p>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>


<style>
  /* FAQ */
  .faq-nav {
    display: flex;
    flex-direction: column;
    margin-bottom: 32px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

    .nav-link {
      position: relative;
      display: block;
      padding: 12px 16px;
      background-color: #fff;
      border-bottom: 1px solid #ddd;
      color: #333;
      transition: background-color 0.2s ease;

      &:hover,
      &.active {
        background-color: #ce2614;
        color: #fff;
        font-weight: 700;
      }

      &:last-of-type {
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-bottom: 0;
      }

      .mdi {
        margin-right: 8px;
        font-size: 18px;
      }
    }
  }

  /* TAB CONTENT */
  .tab-content {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

    .card {
      border-radius: 0;
      border: none;
    }

    .card-header {
      padding: 15px 16px;
      border-radius: 4px 4px 0 0;
      background-color: #ce2614;

      h5 {
        margin: 0;

        button {
          display: block;
          width: 100%;
          padding: 0;
          font-weight: 700;
          color: #fff;
          text-align: left;
          white-space: normal;
          border: none;
          background: none;
          cursor: pointer;
          transition: color 0.2s ease;

          &:hover {
            text-decoration: underline;
          }
        }
      }
    }

    .card-body {
      p {
        color: #333;

        &:last-of-type {
          margin-bottom: 0;
        }
      }
    }
  }

  /* BORDER FIX */
  .accordion>.card:not(:first-child) {
    border-top: 1px solid #ddd;
  }

  .collapse.show .card-body {
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  }
</style>
<?= $this->endSection(); ?>