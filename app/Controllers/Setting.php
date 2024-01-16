<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AlamatUserModel;
use App\Controllers\BaseController;
use App\Models\AuthIdentitesModel;
use App\Models\KategoriModel;
use App\Models\TokoModel;
use App\Models\DeleteRequestUsersModel;


class Setting extends BaseController
{
    private $url;
    private $apiKey;
    private $key;

    public function __construct()
    {
        $this->url = getenv('API_URL_RO');
        $this->apiKey = getenv('API_KEY_RO');
        $this->key = "15139";
    }
    public function setting()
    {
        $userModel = new UsersModel();
        $kategori = new KategoriModel();
        $alamatUserModel = new AlamatUserModel();
        $marketModel = new TokoModel();
        $user = $userModel->where('id', user_id())->first();

        $marketSelected = null;
        if ($user['market_selected']) {
            $getCity = isset($marketModel->find($user['market_selected'])['city']);
            $marketSelected =  ($getCity) ? $marketModel->find($user['market_selected'])['lable'] : 'Pilih Lokasi Market';
        } else {
            $marketSelected = 'Pilih Lokasi Market';
        }
        $addressSelected = null;
        if ($user['address_selected']) {
            $getLabel = isset($alamatUserModel->find($user['address_selected'])['city']);
            $addressSelected =  ($getLabel) ?  $alamatUserModel->find($user['address_selected'])['label'] : 'Pilih Lokasi Pengataran';
        } else {
            $addressSelected = 'Pilih Lokasi Pengataran';
        }
        $data = [
            'title' => lang('Text.setting'),
            'user' => $user,
            'kategori' => $kategori->findAll(),
            'alamat' => $addressSelected,
            'market' => $marketModel->findAll(),
            'marketSelected' => $marketSelected,
            'back'  => '/'
        ];
        // dd($data);
        return view('user/home/setting/setting', $data);
    }
    // USER DETAIL
    public function detailUser()
    {
        $kategori = new KategoriModel();
        $usersModel = new UsersModel();
        $deleteReq = new DeleteRequestUsersModel();
        $id = user_id();
        $existingRequest = $deleteReq->where('id_user', $id)->first();
        $query = $usersModel->select('users.username, users.fullname, users.telp, users.img, auth_identities.secret')
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
            ->where('users.id', $id)
            ->get();

        $du = $usersModel->find([$id]);
        $data = [
            'title' => lang('Text.title'),
            'du' => $du[0],
            'kategori' => $kategori->findAll(),
            'results' => $query->getResult(),
            'deleteRequestExists' => $existingRequest !== null
        ];
        return view('user/home/setting/detailUser', $data);
    }
    // REQUEST DELETE ACCOUNT
    public function submitDeleteRequest()
    {
        $deleteReq = new DeleteRequestUsersModel();
        $existingRequest = $deleteReq->where('id_user', user_id())->first();

        if ($existingRequest) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Anda sudah mengajukan. Tunggu informasi lebih lanjut.'
            ];
            session()->setFlashdata('alert', $alert);

            // Bersihkan flash data yang sudah ada untuk 'alert'
            session()->setFlashdata('alert', null);

            return redirect()->to('setting');
        }

        $data = [
            'id_user' => user_id(),
            'alasan' => $this->request->getVar('alasan'),
        ];

        //validation
        if (!$this->validateData($data, [
            'alasan' => [
                'rules' => 'required|regex_match[/^[A-Za-z0-9\s,.\&!]+$/]',
                'errors' => [
                    'required' => 'Alasan hapus akun harus diisi.',
                    'regex_match' => 'Alasan hapus akun hanya boleh mengandung huruf, angka, spasi, koma, titik, tanda seru, atau ampersand.',
                ],
            ],
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $this->validator->listErrors()
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting')->withInput();
        }
        if ($deleteReq->save($data)) {
            session()->setFlashdata('success', 'Permintaan penghapusan akun berhasil diajukan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Permintaan penghapusan akun berhasil diajukan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting')->withInput();
        }
    }

    public function updateDetailUser()
    {
        $id = user_id();
        $usersModel = new UsersModel();
        $image = $this->request->getFile('img');
        //data yang di ambil dari form
        $data = [
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'telp' => $this->request->getVar('telp'),
            'img' => $image
        ];

        if (!$this->validateData($data, [
            'username' => [
                'rules' => 'required|is_unique[users.username,users.id, ' . $id . ']|regex_match[/^[A-Za-z0-9\s]+$/]|regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'is_unique' => 'Username sudah digunakan.',
                    'regex_match' => 'Username hanya boleh mengandung huruf, angka, atau spasi.',
                    'regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]' => 'Username tidak boleh mengandung karakter spesial seperti ; , . : " \' < > { } [ ] ( ) _ - & $ * @ # ^ ! |'
                ]
            ],
            'fullname' => [
                'label' => 'Nama lengkap',
                'rules' => 'required|regex_match[/^[A-Za-z0-9\s]+$/]|regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi.',
                    'regex_match' => 'Nama lengkap hanya boleh mengandung huruf, angka, atau spasi.',
                    'regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]' => 'Nama lengkap tidak boleh mengandung karakter spesial seperti ; , . : " \' < > { } [ ] ( ) _ - & $ * @ # ^ ! |'
                ]
            ],
            'telp' => [
                'rules' => 'required|numeric|min_length[11]|max_length[15]|regex_match[/^[08]/]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'numeric' => 'Nomor telepon harus berupa angka.',
                    'min_length' => 'Nomor telepon harus minimal 11 digit.',
                    'max_length' => 'Nomor telepon tidak boleh lebih dari 15 digit.',
                    'regex_match' => 'Nomor telepon harus dimulai dengan 0 dan 8.'
                ]
            ],
            'img' => [
                'rules' => 'mime_in[img,image/jpg,image/jpeg,image/png]|max_size[img,2048]',
                'errors' => [
                    'mime_in' => 'Format gambar tidak sesuai.',
                    'max_size' => 'Ukuran gambar terlalu besar.'
                ]
            ]
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $this->validator->listErrors()
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting/detail-user/' . $id)->withInput();
        }

        // Jika validasi berhasil atau tidak ada gambar yang diunggah, lanjutkan pembaruan data
        $namaUserImage = $this->request->getVar('imageLama'); // Tetapkan nama gambar lama sebagai nilai awal

        if ($image->getError() != 4) { // Jika ada file gambar yang diunggah, proses unggahan gambar
            $produk = $usersModel->find($id);

            if ($produk['img'] == 'default.png') {
                $namaUserImage = $image->getRandomName();
                $image->move('assets/img/pic', $namaUserImage);
            } else {
                $namaUserImage = $image->getRandomName();
                $image->move('assets/img/pic', $namaUserImage);
                $gambarLamaPath = 'assets/img/pic/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }

        //repalce data
        $data = [
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'telp' => $this->request->getVar('telp'),
            'img' => $namaUserImage
        ];

        if ($usersModel->save($data)) {
            session()->setFlashdata('success', 'Data pengguna berhasil diperbarui.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data pengguna berhasil diperbarui.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting/detail-user/' . $id)->withInput();
        }
    }

    // PEMBAYARAN
    public function pembayaran(): string
    {
        $data = [
            'title' => 'Pembayaran',
        ];
        return view('user/home/setting/pembayaran', $data);
    }

    // CONTROLLER ALAMAT
    public function alamatList(): string
    {
        $alamat_user_model = new AlamatUserModel();
        $kategori = new KategoriModel();
        $userModel = new UsersModel();
        $alamat_list = $alamat_user_model->where('id_user', user_id())->findAll();
        $user = $userModel->where('id', user_id())->first();
        $data = [
            'title' => lang('Text.title_alamat'),
            'alamat_user_model' => $alamat_list,
            'kategori' => $kategori->findAll(),
            'user' => $user,
            'back'  => 'setting'
        ];
        // dd($data);
        return view('user/home/setting/alamatList', $data);
    }
    public function createAlamat(): string
    {
        session();
        $kategori = new KategoriModel();

        $data = [
            'title'     => lang('Text.btn_tambah'),
            'provinsi' => [],
            'kategori' => $kategori->findAll(),
            'preloader' => false
        ];
        $provinsi = $this->rajaongkir('province');
        // dd($provinsi);
        if (json_decode($provinsi)->rajaongkir->status->code == 200) {
            $data['provinsi'] = json_decode($provinsi)->rajaongkir->results;
        }
        return view('user/home/setting/createAlamat', $data);
    }
    public function saveAlamat()
    {
        $alamatModel = new AlamatUserModel();

        $data = [
            'id_user' => user_id(),
            'label' => $this->request->getVar('label'),
            'penerima' => $this->request->getVar('nama_penerima'),
            'alamat_1' => $this->request->getVar('alamat_1'),
            'alamat_2' => $this->request->getVar('alamat_2'),
            'alamat_3' => $this->request->getVar('alamat_3'),
            'id_province' => $this->request->getVar('id_provinsi'),
            'province' => $this->request->getVar('provinsi'),
            'id_city' => $this->request->getVar('id_kabupaten'),
            'city' => $this->request->getVar('kabupaten'),
            'zip_code' => $this->request->getVar('zip_code'),
            'telp' => $this->request->getVar('no_telp1'),
            'telp2' => $this->request->getVar('no_telp2'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
        ];
        // dd($data);
        // SWAL
        if ($data['telp2'] == null) {
            $ruleTelp2 = [];
        } else {
            $ruleTelp2 = [
                'rules' => 'required|numeric|min_length[11]|max_length[15]|regex_match[/^[08]/]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'numeric' => 'Nomor telepon harus berupa angka.',
                    'min_length' => 'Nomor telepon harus minimal 11 digit.',
                    'max_length' => 'Nomor telepon tidak boleh lebih dari 15 digit.',
                    'regex_match' => 'Nomor telepon harus dimulai dengan 0 dan 8.'
                ]
            ];
        }
        //validation
        if (!$this->validateData($data, [
            'label' => [
                'rules' => 'required|regex_match[/^[A-Za-z0-9\s]+$/]|regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]',
                'errors' => [
                    'required' => 'Label harus diisi.',
                    'regex_match' => 'Label hanya boleh mengandung huruf, angka, atau spasi.',
                    'regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]' => 'Label tidak boleh mengandung karakter spesial seperti ; , . : " \' < > { } [ ] ( ) _ - & $ * @ # ^ ! |'

                ]
            ],
            'penerima' => [
                'rules' => 'required|regex_match[/^[A-Za-z0-9\s]+$/]|regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]',
                'errors' => [
                    'required' => 'Nama penerima harus diisi.',
                    'regex_match' => 'Penerima hanya boleh mengandung huruf, angka, atau spasi.',
                    'regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]' => 'Penerima tidak boleh mengandung karakter spesial seperti ; , . : " \' < > { } [ ] ( ) _ - & $ * @ # ^ ! |'
                ]
            ],

            'alamat_1' => [
                'rules' => 'required|min_length[11]|regex_match[/^[A-Za-z0-9\s.,\/&#!@-]+$/]',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                    'min_length' => 'Alamat harus memiliki minimal 11 karakter.',
                    'regex_match' => 'Alamat hanya boleh mengandung huruf, angka, spasi, titik, koma, garis miring, & (dan), # (pagar), @ (at), atau - (strip).'
                ]
            ],
            'alamat_3' => [
                'rules' => 'required|min_length[3]|regex_match[/^[A-Za-z0-9\s.,\/&#!@-]+$/]',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                    'min_length' => 'Alamat harus memiliki minimal 3 karakter.',
                    'regex_match' => 'Alamat hanya boleh mengandung huruf, angka, spasi, titik, koma, garis miring, & (dan), # (pagar), @ (at), atau - (strip).'
                ]
            ],

            'id_province' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Provinsi harus dipilih.'
                ]
            ],
            'id_city' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kabupaten harus dipilih.'
                ]
            ],
            'zip_code' => [
                'rules' => 'required|numeric|exact_length[5]',
                'errors' => [
                    'required' => 'Kode Pos harus diisi.',
                    'numeric' => 'Kode Pos harus berupa angka.',
                    'exact_length' => 'Kode Pos harus terdiri dari 5 digit.'
                ]
            ],
            'telp' => [
                'rules' => 'required|numeric|min_length[11]|max_length[15]|regex_match[/^[08]/]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'numeric' => 'Nomor telepon harus berupa angka.',
                    'min_length' => 'Nomor telepon harus minimal 11 digit.',
                    'max_length' => 'Nomor telepon tidak boleh lebih dari 15 digit.',
                    'regex_match' => 'Nomor telepon harus dimulai dengan 0 dan 8.'
                ]
            ],

            'telp2' => $ruleTelp2
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $this->validator->listErrors()
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting/create-alamat')->withInput();
        }
        if ($alamatModel->save($data)) {
            session()->setFlashdata('success', 'Alamat berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Alamat berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting/alamat-list');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting/create-alamat')->withInput();
        }
    }

    public function updateAlamat($id): string
    {
        session();
        $provinsi = $this->rajaongkir('province');
        $alamatModel = new AlamatUserModel();
        $kategori = new KategoriModel();

        $au = $alamatModel->find($id);

        $data = [
            'title' => 'Edit Alamat',
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
            'au' => $au,
            'back'  => 'setting/alamat-list',
            'kategori' => $kategori->findAll(),
            'preloader' => false
        ];
        // dd($data);
        return view('user/home/setting/updateAlamat', $data);
    }
    public function editAlamat($id)
    {
        $alamatModel = new AlamatUserModel();

        $data = [
            'id_alamat_users' => $id,
            'id_user' => $this->request->getVar('id_user'),
            'label' => $this->request->getVar('label'),
            'penerima' => $this->request->getVar('penerima'),
            'alamat_1' => $this->request->getVar('alamat_1'),
            'alamat_2' => $this->request->getVar('alamat_2'),
            'alamat_3' => $this->request->getVar('alamat_3'),
            'id_province' => $this->request->getVar('id_provinsi'),
            'province' => $this->request->getVar('provinsi'),
            'id_city' => $this->request->getVar('id_kabupaten'),
            'city' => $this->request->getVar('kabupaten'),
            'zip_code' => $this->request->getVar('zip_code'),
            'telp' => $this->request->getVar('no_telp1'),
            'telp2' => $this->request->getVar('no_telp2'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
        ];
        if ($data['telp2'] == null) {
            $ruleTelp2 = [];
        } else {
            $ruleTelp2 = [
                'rules' => 'required|numeric|min_length[11]|max_length[15]|regex_match[/^[08]/]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'numeric' => 'Nomor telepon harus berupa angka.',
                    'min_length' => 'Nomor telepon harus minimal 11 digit.',
                    'max_length' => 'Nomor telepon tidak boleh lebih dari 15 digit.',
                    'regex_match' => 'Nomor telepon harus dimulai dengan 0 dan 8.'
                ]
            ];
        }
        //validation data
        if (!$this->validateData($data, [
            'label' => [
                'rules' => 'required|regex_match[/^[A-Za-z0-9\s]+$/]|regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]',
                'errors' => [
                    'required' => 'Label harus diisi.',
                    'regex_match' => 'Label hanya boleh mengandung huruf, angka, atau spasi.',
                    'regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]' => 'Label tidak boleh mengandung karakter spesial seperti ; , . : " \' < > { } [ ] ( ) _ - & $ * @ # ^ ! |'

                ]
            ],
            'penerima' => [
                'rules' => 'required|regex_match[/^[A-Za-z0-9\s]+$/]|regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]',
                'errors' => [
                    'required' => 'Nama penerima harus diisi.',
                    'regex_match' => 'Penerima hanya boleh mengandung huruf, angka, atau spasi.',
                    'regex_match[^;,:"\'<>\{\}\[\]_\-\&\$\*\@#^!|]' => 'Penerima tidak boleh mengandung karakter spesial seperti ; , . : " \' < > { } [ ] ( ) _ - & $ * @ # ^ ! |'
                ]
            ],

            'alamat_1' => [
                'rules' => 'required|min_length[11]|regex_match[/^[A-Za-z0-9\s.,\/&#!@-]+$/]',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                    'min_length' => 'Alamat harus memiliki minimal 11 karakter.',
                    'regex_match' => 'Alamat hanya boleh mengandung huruf, angka, spasi, titik, koma, garis miring, & (dan), # (pagar), @ (at), atau - (strip).'
                ]
            ],
            'alamat_3' => [
                'rules' => 'required|min_length[3]|regex_match[/^[A-Za-z0-9\s.,\/&#!@-]+$/]',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                    'min_length' => 'Alamat harus memiliki minimal 3 karakter.',
                    'regex_match' => 'Alamat hanya boleh mengandung huruf, angka, spasi, titik, koma, garis miring, & (dan), # (pagar), @ (at), atau - (strip).'
                ]
            ],

            'id_province' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Provinsi harus dipilih.'
                ]
            ],
            'id_city' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kabupaten harus dipilih.'
                ]
            ],
            'zip_code' => [
                'rules' => 'required|numeric|exact_length[5]',
                'errors' => [
                    'required' => 'Kode Pos harus diisi.',
                    'numeric' => 'Kode Pos harus berupa angka.',
                    'exact_length' => 'Kode Pos harus terdiri dari 5 digit.'
                ]
            ],
            'telp' => [
                'rules' => 'required|numeric|min_length[11]|max_length[15]|regex_match[/^[08]/]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'numeric' => 'Nomor telepon harus berupa angka.',
                    'min_length' => 'Nomor telepon harus minimal 11 digit.',
                    'max_length' => 'Nomor telepon tidak boleh lebih dari 15 digit.',
                    'regex_match' => 'Nomor telepon harus dimulai dengan 0 dan 8.'
                ]
            ],
            'telp2' => $ruleTelp2
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $this->validator->listErrors()
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting/update-alamat/' . $id)->withInput();
        }

        // dd($data);
        // SWAL
        if ($alamatModel->save($data)) {
            session()->setFlashdata('success', 'Alamat berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Alamat berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting/alamat-list');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting/update-alamat')->withInput();
        }
    }

    public function deleteAlamat($id)
    {
        $alamatModel = new AlamatUserModel();

        $deleted = $alamatModel->delete($id);

        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data alamat berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting/alamat-list');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan data'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting/create-alamat')->withInput();
        }
    }

    public function storeDataAlamat()
    {
        $userModel = new UsersModel();
        $alamatId = $this->request->getVar('alamat');

        if ($userModel->save([
            'id' => user_id(),
            'address_selected' => $alamatId
        ])) {
            $alert = [
                'type' => 'success',
                'title' => 'berhasil',
                'message' => 'Berhasi memilih alamat'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting');
        }
        $alert = [
            'type' => 'error',
            'title' => 'Error',
            'message' => 'Terdapat kesalahan pada pemilihan alamat'
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to('setting');
    }

    public function storeDataMarket()
    {
        $userModel = new UsersModel();
        $market = $this->request->getPost('market');

        if ($userModel->save([
            'id' => user_id(),
            'market_selected' => $market
        ])) {
            $alert = [
                'type' => 'success',
                'title' => 'berhasil',
                'message' => 'Berhasi memilih lokasi cabang market'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting');
        }

        // GAGAl
        $alert = [
            'type' => 'error',
            'title' => 'Error',
            'message' => 'Terdapat kesalahan pada penghapusan data'
        ];
        session()->setFlashdata('alert', $alert);
    }

    // FETCHING DATA API PROVINSI & KOTA
    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    // GET DATA API RAJAONGKIR
    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rejaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }
    private function rejaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        foreach ($response['rajaongkir']['results'][0]['costs'] as $key => $value) {
            $response['rajaongkir']['results'][0]['costs'][$key]['cost'][0]['encodeCost'] = $this->encryptValue($value['cost'][0]['value'], $this->key);
        }
        return $response;
    }

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;
        if ($id_province != null) {
            # code...
            $endPoint = $endPoint . "?province=" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
    function encryptValue($value, $key)
    {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encrypted = openssl_encrypt($value, $cipher, $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }
    // sayocare
    public function sayoCare()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Sayomart Care',
            'kategori' => $kategori->findAll()
        ];
        return view('user/home/setting/sayoCare', $data);
    }

    // Kebijakan Privasi 
    public function kebijakanPrivasi()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Kebijakan Privasi',
            'kategori' => $kategori->findAll()
        ];
        if ($this->request->getUserAgent()->isMobile()) {
            $data['preloader'] = false;
        }
        return view('user/home/setting/kebijakanPrivasi', $data);
    }

    // Cropper Image
    public function cropper()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Sayomart Care',
            'kategori' => $kategori->findAll()
        ];
        return view('user/home/setting/cropper', $data);
    }
}
