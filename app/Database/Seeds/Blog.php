<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Blog extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_blog'           => 1,
                'judul_blog'        => 'Bulgogi',
                'tanggal_dibuat'    => '2023-10-14 03:08:51',
                'img_thumbnail'     => 'blog-1.png',
                'slug'              => 'bulgogi',
                'created_by'        => 1,
                'link_video'        => 'https://www.youtube.com/watch?v=Oq1LZhiaYYk',
                'isi_blog'          => '<p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;"><strong>Bulgogi</strong>&nbsp;(<a style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Bahasa Korea" href="https://id.wikipedia.org/wiki/Bahasa_Korea">bahasa Korea</a>:&nbsp;<span lang="ko" style="">불</span>&nbsp;api, dan&nbsp;<span lang="ko" style="">고기</span>&nbsp;daging) adalah&nbsp;<a class="mw-redirect" style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Masakan" href="https://id.wikipedia.org/wiki/Masakan">olahan</a>&nbsp;<a style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Daging" href="https://id.wikipedia.org/wiki/Daging">daging</a>&nbsp;asal&nbsp;<a style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Korea" href="https://id.wikipedia.org/wiki/Korea">Korea</a>. Daging yang digunakan antara lain daging&nbsp;<a class="mw-redirect" style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Sirloin" href="https://id.wikipedia.org/wiki/Sirloin">sirloin</a>&nbsp;atau bagian daging sapi pilihan.</span></p>
                    <p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Bumbu bulgogi adalah campuran&nbsp;<a style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Kecap asin" href="https://id.wikipedia.org/wiki/Kecap_asin">kecap asin</a>&nbsp;dan&nbsp;<a style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Gula" href="https://id.wikipedia.org/wiki/Gula">gula</a>&nbsp;ditambah rempah lain bergantung pada resep dan daerah di Korea. Sebelum dimakan, daun selada digunakan untuk membungkus bulgogi bersama&nbsp;<a class="mw-redirect" style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Kimchi" href="https://id.wikipedia.org/wiki/Kimchi">kimchi</a>,&nbsp;<a style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Bawang putih" href="https://id.wikipedia.org/wiki/Bawang_putih">bawang putih</a>, atau bumbu penyedap lain.</span></p>
                    <p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Di Jepang, makanan yang sejenis disebut&nbsp;<a style="text-decoration-line: none; color: #3366cc; background: none; overflow-wrap: break-word;" title="Yakiniku" href="https://id.wikipedia.org/wiki/Yakiniku">Yakiniku</a>. Dibandingkan dengan Yakiniku, bumbu daging untuk bulgogi dibuat lebih manis. Air pada bumbu cukup banyak sehingga daging tidak dipanggang di atas plat besi (<em>teppan</em>), melainkan di atas panci datar.</span></p>
                    <p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;">&nbsp;</p>
                    <p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff; text-align: center;"><span style="font-size: 14pt;"><strong>Cara Memasak Bulgogi</strong></span></p>
                    <p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Bahan-bahan yang diperlukan untuk memasak bulgogi</span></p>
                    <ul>
                    <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">500gr sliced beef</span></li>
                    <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">100gr wortel</span></li>
                    <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">1 bawang bombay</span></li>
                    </ul>
                    <p><span style="font-size: 12pt;"><strong>Bumbu marinasi :</strong></span></p>
                    <ul>
                    <li><span style="font-size: 12pt;">8sdm kecap asin</span></li>
                    <li><span style="font-size: 12pt;">2 sdm gula</span></li>
                    <li><span style="font-size: 12pt;">2 sdm madu</span></li>
                    <li><span style="font-size: 12pt;">2 sdm minyak wijen javasuperfood</span></li>
                    <li><span style="font-size: 12pt;">1 sdt lada hitam bubuk</span></li>
                    <li><span style="font-size: 12pt;">4 siung bawang p utih</span></li>
                    <li><span style="font-size: 12pt;">1/2 bawang bombang</span></li>
                    </ul>
                    <p><span style="font-size: 12pt;"><strong>Taburan :</strong></span></p>
                    <ul>
                    <li><span style="font-size: 12pt;">Wijen</span></li>
                    <li><span style="font-size: 12pt;">Daun Bawang</span></li>
                    </ul>
                    <p><span style="font-size: 12pt;"><strong>Cara Membuat :</strong></span></p>
                    <ul>
                    <li><span style="font-size: 12pt;">Cuci bersih daging.</span></li>
                    <li><span style="font-size: 12pt;">Untuk membuat bumbu marinasi, blender bawang putih, &frac12; bawang bombay, dan 4 sdm kecap asin.</span></li>
                    <li><span style="font-size: 12pt;">Campur daging dengan semua bumbu marinasi.</span></li>
                    <li><span style="font-size: 12pt;">Simpan di dalam kulkas selama 2 jam.</span></li>
                    <li><span style="font-size: 12pt;">Potong-potong wortel, bawang bombay dan daun bawang.</span></li>
                    <li><span style="font-size: 12pt;">Setelah 2 jam, masak daging menggunakan grill pan. (Tidak usah dioles minyak ya Moms, maka harus pakai pan yang anti lengket.)</span></li>
                    <li><span style="font-size: 12pt;">Pakai api sedang, sambil dibolak-balik sesekali.</span></li>
                    <li><span style="font-size: 12pt;">Setelah daging berubah warna, masukkan bawang bombay dan wortel. </span></li>
                    <li><span style="font-size: 12pt;">Masak hingga matang.</span></li>
                    <li><span style="font-size: 12pt;">Angkat, taruh di piring saji.Taburi resep bulgogi dengan daun bawang dan wijen.</span></li>
                    </ul>'
            ],
            [
                'id_blog'           => 2,
                'judul_blog'        => 'Ramen',
                'tanggal_dibuat'    => '2023-10-14 03:24:07',
                'img_thumbnail'     => 'blog-2.png',
                'slug'              => 'ramen',
                'created_by'        => 1,
                'link_video'        => 'https://www.youtube.com/watch?v=DynZrC5VikU',
                'isi_blog'          => '<p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;"><strong>Ramen</strong>&nbsp;(<span title="Jepang-language text"><span lang="ja">拉麺, ラーメン</span></span>) adalah masakan mi kuah Jepang yang berasal dari Jepang&nbsp;dan&nbsp;Tiongkok.&nbsp;Orang Jepang&nbsp;juga menyebut ramen sebagai&nbsp;<em>chuka soba</em>&nbsp;(<span title="Jepang-language text"><span lang="ja">中華そば</span></span>,&nbsp;<span title="Hepburn transliteration"><em lang="ja-Latn">soba dari Tiongkok</em></span><span style="margin-left: 0.09em;">)</span>&nbsp;atau&nbsp;<em>shina soba</em>&nbsp;(<span title="Jepang-language text"><span lang="ja">支那そば</span></span>)&nbsp;karena&nbsp;<em>soba</em>&nbsp;atau&nbsp;<em>o-soba</em>&nbsp;dalam&nbsp;bahasa Jepang&nbsp;sering juga berarti mi.</span></p>
                <p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;">&nbsp;</p>
                <p style="margin: 0.5em 0px; color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><strong><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Bahan untuk Mie/Ramen :</span></strong></p>
                <ul>
                <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Mie telur</span></li>
                <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">2 buah wortel iris korek api</span></li>
                <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Daun bawang (iris)</span></li>
                <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Rumput laut javasuperfood</span></li>
                <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Suwiran daging sapi</span></li>
                <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Bakso ikan</span></li>
                <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Telur rebus</span></li>
                <li style="color: #202122; font-family: sans-serif; font-size: 14px; background-color: #ffffff;"><span style="font-size: 12pt;">Pokcoy</span></li>
                </ul>
                <p><strong><span style="font-size: 12pt;">Bahan untuk kuah :</span></strong></p>
                <ul>
                <li><span style="font-size: 12pt;">2 siung bawang putih</span></li>
                <li><span style="font-size: 12pt;">1/2 buah bawang bombay</span></li>
                <li><span style="font-size: 12pt;">2 sdm kecap asin</span></li>
                <li><span style="font-size: 12pt; color: #323232; font-family: Montserrat, sans-serif;">1 sdm saus tiram</span></li>
                <li><span style="font-size: 12pt; color: #323232; font-family: Montserrat, sans-serif;">1 sdm Kecap ikan</span></li>
                <li><span style="font-size: 12pt; color: #323232; font-family: Montserrat, sans-serif;">Merica secukupnya</span></li>
                <li><span style="font-size: 12pt; color: #323232; font-family: Montserrat, sans-serif;">Garam secukupnya</span></li>
                </ul>
                <p><strong><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Cara membuat :</span></strong></p>
                <ul>
                <li><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Untuk kuah, tumis bawang putih dan bombai. </span></li>
                <li><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Tuang air rebusan daging sapi. </span></li>
                <li><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Beri bumbu pelengkap, </span></li>
                <li><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Angkat jika sudah mendidih.</span></li>
                <li><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Rebus mie dan pokcoy.</span></li>
                <li><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Taruh mie dan pokcoy di mangkuk. </span></li>
                <li><span style="color: #323232; font-family: Montserrat, sans-serif; font-size: 12pt;">Siram kuah, beri topping daging suwir, wortel iris, rumput laut, telur rebus, dan bakso ikan.</span></li>
                </ul>'
            ],

            [
                'id_blog'           => 3,
                'judul_blog'        => 'Toppoki',
                'tanggal_dibuat'    => '2023-10-14 03:36:52',
                'img_thumbnail'     => 'blog-3.png',
                'slug'              => 'toppoki',
                'created_by'        => 1,
                'link_video'        => 'https://www.youtube.com/watch?v=I5mioCFF6oA',
                'isi_blog'          => '<p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Camilan ini dikembangkan pada tahun 1953 dimana perang korea berakhir, oleh seorang wanita yang bernama Ma Bok-rim di lingkungan Sindang-dong di Seoul.</p>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Pada awalnya, camilan ini merupakan makanan kerajaan yang sangat istimewa. Yaitu dimana pada saat dinasti Joseon, makanan ini dimasak dengan kecap asin dan bertahan selama bertahun-tahun.</p>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Sehingga suatu hal tak terduga terjadi, yang mana Ma dengan tidak sengaja menjatuhkan kue Tteok ke dalam saus kacang hitam. Lalu, ketika ia mencobanya ternyata rasanya enak, ia pun menambahkan saus kacang hitam dan lada merah.</p>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Akhirnya, Ma membuka restoran dengan inspirasi barunya tersebut, dan dikenal kalangan siswa SMA, dan diikuti banyak restoran-restoran lainnya pada tahun 1980-an.</p>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Bagi masyarakat Korea sendiri, camilan ini adalah camilan klasik. Misalnya bagi orang-orang paruh baya, mereka menyebut bahwa camilan ini membuat dirinya bernostalgia.</p>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Adapun mengenai perbedaan antara toppoki dan tteokbokki, sebenarnya tidak ada perbedaan antara keduanya. Karena, orang Korea menyebut tteokbokki, juga dengan sebutan ddukbokki, ddeokbokki, ataupun topokki.</p>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Dengan melihat sejarah, tidak ada perbedaan antara tteokbokki dan toppoki. Hanya saja, orang Korea menyebut tteokbokki dengan sebutan ddukbokki, ddeokbokki, dan toppoki juga. Sedangkan kita orang Indonesia, sering menyebut tteokbokki dengan sebutan toppoki.</p>
                <h2 id="Resep_dan_Bahan_Toppoki_atau_Tteokbokki" style="box-sizing: border-box; font-family: var(--fontTitle); color: var(--tx-100); line-height: 1.5em; transition: color 0.3s ease 0s; background-color: #fdfdfd;">Resep dan Bahan Toppoki atau Tteokbokki</h2>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Resep pertama adalah menyiapkan bahan ttok (kue berasnya) yang merupakan bahan dasar dari tteokbokki atau toppoki.</p>
                <h3 id="Bahan_Tteok__Kue_Beras" style="box-sizing: border-box; font-family: var(--fontTitle); color: var(--tx-100); line-height: 1.5em; transition: color 0.3s ease 0s; font-size: 1.33em; margin-top: 0px; background-color: #fdfdfd;">Bahan Tteok (Kue Beras)</h3>
                <ul style="box-sizing: border-box; list-style: revert; margin: 0px 0px 1.25em; padding: 0px; padding-inline-start: 2.5em; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">25 sdm tepung beras</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">3 sdm tepung tapioka/tepung kanji</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">17 sdm air panas</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">1 sdt garam</li>
                </ul>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Resep kedua, adalah bahan untuk membuat sausnya yang menjadi tteokbokki atau toppoki terkenal pedas.</p>
                <h3 id="Bahan_Saus_Gochujang" style="box-sizing: border-box; font-family: var(--fontTitle); color: var(--tx-100); line-height: 1.5em; transition: color 0.3s ease 0s; font-size: 1.33em; background-color: #fdfdfd;">Bahan Saus Gochujang</h3>
                <ul style="box-sizing: border-box; list-style: revert; margin: 1.25em 0px; padding: 0px; padding-inline-start: 2.5em; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">&frac12; sdm tepung beras</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">1 sdm air panas</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">2 sdm cabe bubuk</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">1 sdt boncabe</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">1 &frac12; sdt gula pasir</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">&frac14; sdt garam</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">1 &frac12; sdt minyak wijen</li>
                </ul>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Resep ketiga, adalah bahan tambahan untuk memperkaya cita rasa camilan ini.</p>
                <h3 id="Bahan_Tambahan" style="box-sizing: border-box; font-family: var(--fontTitle); color: var(--tx-100); line-height: 1.5em; transition: color 0.3s ease 0s; font-size: 1.33em; background-color: #fdfdfd;">Bahan Tambahan</h3>
                <ul style="box-sizing: border-box; list-style: revert; margin: 1.25em 0px; padding: 0px; padding-inline-start: 2.5em; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">3 butir telur rebus</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Beberapa potong baso sefood</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Beberapa potong sosis</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Daun bawang sesuai selera</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">1 dan 1/2 sdm kecap asin (soy sauce)</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;"><a style="box-sizing: border-box; outline: none; color: var(--postlink); transition: color 0.3s ease 0s;">&frac12;</a>&nbsp;sdm saori saos tiram</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">&frac12; sdt kaldu bubuk</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Bubuk bawah putih</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Wijen sesuai selera</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Lada bubuk sesuai selera</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Gula pasir sesuai selera</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Garam sesuai selera</li>
                </ul>
                <h2 id="Cara_Membuat_Tteokbokki_atau_Toppoki" style="box-sizing: border-box; font-family: var(--fontTitle); color: var(--tx-100); line-height: 1.5em; transition: color 0.3s ease 0s; background-color: #fdfdfd;">Cara Membuat Tteokbokki atau Toppoki</h2>
                <h3 id="Pertama__Membuat_Tteok__kue_Beras__Tteokbokki_atau_Toppoki" style="box-sizing: border-box; font-family: var(--fontTitle); color: var(--tx-100); line-height: 1.5em; transition: color 0.3s ease 0s; font-size: 1.33em; background-color: #fdfdfd;">Pertama, Membuat Tteok (kue Beras) Tteokbokki atau Toppoki</h3>
                <ol style="box-sizing: border-box; list-style: revert; margin: 0px 0px 1.25em; padding: 0px; padding-inline-start: 2.5em; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Masukkan tepung beras, tepung tapioca, dan 1 sendok teh ke dalam wadah, lalu aduk dahulu agar bahan mulai menyampur</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Tuangkan air panas sedikit demi sedikit ke dalam adonan sambil diaduk, sampai adonan tercampur rata dan kalis.</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Selanjutnya, adonan dibagi menjadi 8 dan digulung sampai memanjang. Atau gulungan bisa menyesuaikan selera anda.</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Rebus adonan sampai matang, sehingga adonan terapung di atas permukaan air, lalu angkat dan tiriskan adonan.</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Lalu rendam adonan ke dalam air dingin selama 30 menit, agar adonan tetap kenyal dan tidak rusak.</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Selanjutnya, potong adonan menjadi 3 bagian atau sesuai selera kamu.</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Siapkan Saus Gochujang dari Javasuperfood</li>
                </ol>
                <h3 id="Ketiga__Membuat_Tteokbokki" style="box-sizing: border-box; font-family: var(--fontTitle); color: var(--tx-100); line-height: 1.5em; transition: color 0.3s ease 0s; font-size: 1.33em; background-color: #fdfdfd;">Ketiga, Membuat Tteokbokki</h3>
                <p style="box-sizing: border-box; margin: 1.25em 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">Berikut adalah langkah ketiga untuk membuat tteokbokki atau toppoki, yaitu proses penggorengan akhir.</p>
                <ol style="box-sizing: border-box; list-style: revert; margin: 1.25em 0px; padding: 0px; padding-inline-start: 2.5em; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Siapkan Teflon atau wajan juga bisa, masukkan air sebanyak 1 gelas, masukan saus gochujang tadi.</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Masukkan juga garam, gula, dan bubuk lada sesuai selera. Lalu 1 buah bawang putih, 1 &frac12; sdm Kecap asin (Soy sauce), &frac12; sdm saori saos tiram, dan &frac12; sdt kaldu bubuk</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Ketika mulai mendidih, masukkan tteokbokki selama beberapa menit. Jangan lupa sambil diaduk.</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Selanjutnya, jika mulai mengental, masukkan telur, baso seafood, dan sosis. Aduk dan biarkan beberapa 1 sampai 2 menit.</li>
                <li style="box-sizing: border-box; list-style: revert; margin: 0px; padding: 0px;">Selanjutnya, tuangkan daun bawang dan mijen.</li>
                </ol>
                <div class="related-middle igniplexTengah" style="box-sizing: border-box; margin: 1.5rem 0px; color: #3a4a68; font-family: Montserrat, Arial, sans-serif; font-size: 15.001px; background-color: #fdfdfd;">
                <div class="related-middle-inner fade" style="box-sizing: border-box; font-size: 1rem; animation: 0.1s ease-out 0s 1 normal none running ignielFade; transition: opacity 0.1s linear 0s;">
                <ul class="g" style="box-sizing: border-box; list-style: none; margin: 0px; display: grid; padding-inline-start: 2.5em; padding: 0px; gap: 2rem 3rem; grid-template-columns: repeat(2, 1fr);">
                <li class="hover-zoom f" style="box-sizing: border-box; list-style: none; margin: 0px; padding: 0px; display: flex; gap: 1rem;">&nbsp;</li>
                </ul>
                </div>
                </div>'
            ]
        ];
        $this->db->table('jsf_blog')->insertBatch($data);
    }
}
