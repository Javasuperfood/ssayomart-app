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
            <!-- Accordion Dashboard -->
            <div class="mb-3">
                  <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button bg-danger border-danger text-white fw-bold " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Dashboard</button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Dashboard ssayomart memberikan pandangan cepat mengenai stok produk</p>
               <ul>
                <li> Pada bagian tabel, pengguna dapat melihat detail produk seperti Toko, Nama Produk, Variasi Item dan Stok. Fitur pengurutan memungkinkan pengguna menyusun data berdasarkan bulan dan tahun untuk analisis yang lebih terfokus.</li>
                <li> Pada bagian chart, grafik memberikan visualisasi distribusi stok untuk pemantauan yang cepat. Dashboard ini terus terupdate secara real-time, memastikan informasi selalu terkini. Fitur pemantauan inventaris dilengkapi dengan peringatan otomatis. Dengan penambahan fitur pengurutan, pengelolaan persediaan ssayomart menjadi lebih efisien.</li>
               </ul>
                   <div class="embed-responsive embed-responsive-16by9 mt-3">
         <iframe class="rounded" width="560" height="315" src="https://www.youtube.com/embed/okP1yx39zSM?si=csbbpXi9uEKzaZB2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
                </div>
              </div>
            </div>
            </div>
        

          <!-- Accordion Report #2 -->
          <div class="mb-3"><div class="accordion-item mb-3">
  <h2 class="accordion-header" id="panduanAplikasiHeadingTwo">
    <button class="accordion-button collapsed bg-danger border-danger text-white fw-bold " type="button" data-bs-toggle="collapse" data-bs-target="#panduanAplikasiCollapseTwo" aria-expanded="false" aria-controls="panduanAplikasiCollapseTwo">Report</button>
  </h2>
  <div id="panduanAplikasiCollapseTwo" class="accordion-collapse collapse" aria-labelledby="panduanAplikasiHeadingTwo" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      <ul>
        <p>Report penjualan ssayomart memberikan gambaran komprehensif kinerja penjualan. </p>
        <li>Tabel laporan menampilkan data transaksi, seperti tanggal, jumlah item terjual, dan total pendapatan. Pengguna dapat dengan mudah mengurutkan data berdasarkan bulan atau kategori produk.</li>
        <li>Grafik dalam laporan memberikan visualisasi dinamis tentang penjualan, mencakup pertumbuhan bulanan, perbandingan kategori produk, dan tren harian. Laporan selalu terupdate secara otomatis untuk memastikan akurasi data terbaru.</li>
        <li>Selain itu, untuk kemudahan pengguna, terdapat tombol "Download PDF" yang memungkinkan pengguna untuk mengunduh laporan penjualan dalam format PDF dengan satu klik mudah.</li>
      </ul>
                           <div class="embed-responsive embed-responsive-16by9 mt-3">
         <iframe class="rounded" width="560" height="315" src="https://www.youtube.com/embed/okP1yx39zSM?si=csbbpXi9uEKzaZB2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
  </div>
</div>
</div>


<!-- Accordion Pesanan #3 -->
<div class="mb-3"><div class="accordion-item mb-3">
  <h2 class="accordion-header" id="panduanAplikasiHeadingThree">
    <button class="accordion-button collapsed bg-danger border-danger text-white fw-bold " type="button" data-bs-toggle="collapse" data-bs-target="#panduanAplikasiCollapseThree" aria-expanded="false" aria-controls="panduanAplikasiCollapseThree">Pesanan</button>
  </h2>
  <div id="panduanAplikasiCollapseThree" class="accordion-collapse collapse" aria-labelledby="panduanAplikasiHeadingThree" data-bs-parent="#accordionExample">
    <div class="accordion-body">
    
                 <ul>
                  <p>Pada menu pesanan terdapat enam submenu, yaitu:</p>
                  <li>Semua Pesanan</li>
                   <li>Menunggu Pembayaran</li>
                    <li>Dalam Proses</li>
                     <li>Dalam Perjalanan</li>
                      <li>Pesanan Terkirim</li>
                       <li>Refund</li>
                 </ul>
                           <div class="embed-responsive embed-responsive-16by9 mt-3">
            <iframe class="rounded" width="560" height="315" src="https://www.youtube.com/embed/okP1yx39zSM?si=csbbpXi9uEKzaZB2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
  </div>
</div></div>



            <!-- Accordion Produk Menu #4 -->
            <div class="mb-3">
                <div class="accordion-item mb-3">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed bg-danger border-danger text-white fw-bold " type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Produk Menu</button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
              <ul>
                <p>Menu Produk<p>
                <li>List Produk</li>
                <li>Tambah Produk</li>
                <li>Produk Kategori-Batch</li>
                <li>Tambah Variasi</li>
                <li>Fetching Produk</li>
              </ul>
              <ul>
                <p>Menu Promosi</p>
                <li>Buat Promosi</li>
                <li>Tambah Promosi Produk</li>
                <li>Tambah Promosi Produk Batch</li>
              </ul>
                           <div class="embed-responsive embed-responsive-16by9 mt-3">
          <iframe class="rounded" width="560" height="315" src="https://www.youtube.com/embed/okP1yx39zSM?si=csbbpXi9uEKzaZB2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
                </div>
              </div>
            </div>
            </div>
          

            <!-- Accordion Kategori Menu #5 -->
            <div class="mb-3">
               <div class="accordion-item ">
              <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed bg-danger border-danger text-white fw-bold " type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Kategori Menu</button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                 <ul>
                  <li>List Kategori</li>
                  <li>Tambah Kategori</li>
                  <li> Ubah Urutan Kategori</li>
                 </ul>
                           <div class="embed-responsive embed-responsive-16by9 mt-3">
          <iframe class="rounded" width="560" height="315" src="https://www.youtube.com/embed/okP1yx39zSM?si=csbbpXi9uEKzaZB2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        
                </div>
                
              </div>
              
            </div>
            </div>
           <!-- Accordion Management Kontent #6 -->
<div class="mb-3">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSix">
      <button class="accordion-button collapsed bg-danger border-danger text-white fw-bold " type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">Management Konten</button>
    </h2>
    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <p>dalam menu management konten terdapat dua sub menu yaitu:</p>
      <ul>

      <li>Banner</li>
      <li>Artikel</li>
      </ul>
        <div class="embed-responsive embed-responsive-16by9 mt-3">
          <iframe class="rounded" width="560" height="315" src="https://www.youtube.com/embed/okP1yx39zSM?si=csbbpXi9uEKzaZB2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Accordion Kupon #7 -->
<div class="mb-3">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSeven">
      <button class="accordion-button bg-danger border-danger text-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">Kupon</button>
    </h2>
    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
      <div class="accordion-body">
     <ul>
      <p>Pada menu kupon, terdapat tabel dan tombol "Tambah Kupon"</p>
      <li>Tabel menampilkan data produk yang sebelumnya telah dibuatkan kupon.</li>
      <li>Tombol "Tambah Kupon" digunakan untuk menambahkan kupon baru dengan mengisi judul kupon, kode referal kupon, deskripsi kupon, memilih diskon, total pembelian, dan maksimal penggunaan. Setelah itu, terdapat tombol "Tambah Kupon" untuk menambahkan kupon yang telah dibuat dan ditampilkan ke dalam tabel kupon.</li>
     </ul>
        <div class="embed-responsive embed-responsive-16by9 mt-3">
          <iframe class="rounded" width="560" height="315" src="https://www.youtube.com/embed/okP1yx39zSM?si=csbbpXi9uEKzaZB2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

          </div>
        </div>
      </div>
    </div>
<?= $this->endSection(); ?>

