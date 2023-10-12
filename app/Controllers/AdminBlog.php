<?php

namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\UsersModel;

class AdminBlog extends BaseController
{
    // ===================================================================
    // ------------------------ KONTEN LIST ------------------------------
    // ===================================================================
    public function blog()
    {
        $blogModel = new BlogModel();
        $blog_list = $blogModel->getAllBlog();
        $data = [
            'title' => 'Artikel/Blog',
            'blog_model' => $blog_list
        ];
        // dd($data);
        return view('dashboard/blog/blog', $data);
    }

    // ===================================================================
    // ------------------------ CREATE KONTEN ----------------------------
    // ===================================================================
    public function tambahKonten()
    {
        return view('dashboard/blog/tambahKonten');
    }

    public function saveKonten()
    {
        // ambil gambar
        $blogModel = new BlogModel();
        $fotoBlog = $this->request->getFile('img_thumbnail');
        if ($fotoBlog->getError() == 4) {
            $namaBlog = 'default.jpg';
        } else {
            $namaBlog = $fotoBlog->getRandomName();
            $fotoBlog->move('assets/img/blog/', $namaBlog);
        }

        $slug = url_title($this->request->getVar('judul_blog'), '-', true);
        $data = [
            'judul_blog' => $this->request->getVar('judul_blog'),
            'isi_blog' => $this->request->getVar('isi_blog'),
            'tanggal_dibuat' => date('Y-m-d H:i:s'),
            'slug' => $slug,
            'img_thumbnail' => $namaBlog,
            'created_by' => user_id()
        ];
        // dd($data);

        // swet alert
        if ($blogModel->save($data)) {
            session()->setFlashdata('success', 'Blog/Artikel berhasil di publish.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Blog/Artikel berhasil di publish.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/blog/blog')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/blog/tambah-konten')->withInput();
        }
    }

    // ===================================================================
    // ------------------------ UPDATE KONTEN ----------------------------
    // ===================================================================
    public function updateKonten($id)
    {
        $blogModel = new BlogModel();
        $blogData = $blogModel->find($id);
        $data = [
            'title' => 'Edit Kupon',
            'bm' => $blogData,
            'back' => 'dashboard/blog'
        ];
        return view('dashboard/blog/editKonten', $data);
    }
    // save update
    public function editKonten($id)
    {
        $blogModel = new BlogModel();
        $image = $this->request->getFile('img_thumbnail');

        if ($image->getError() == 4) {
            $namaKontenImage = $this->request->getVar('imageLama');
        } else {
            $konten = $blogModel->find($id);

            if ($konten['img_thumbnail'] == 'default.jpg') {
                $namaKontenImage = $image->getRandomName();
                $image->move('assets/img/blog', $namaKontenImage);
            } else {
                $namaKontenImage = $image->getRandomName();
                $image->move('assets/img/blog', $namaKontenImage);
                $gambarLamaPath = 'assets/img/blog/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $slug = url_title($this->request->getVar('judul_blog'), '-', true);

        $data = [
            'id_blog' => $id,
            'judul_blog' => $this->request->getVar('judul_blog'),
            'isi_blog' => $this->request->getVar('isi_blog'),
            'tanggal_dibuat' => date('Y-m-d H:i:s'),
            'img_thumbnail' => $namaKontenImage,
            'updated_by' => user_id(),
            'slug' => $slug
        ];

        if ($blogModel->save($data)) {
            session()->setFlashdata('success', 'Data konten berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data konten berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/blog/blog/');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/blog/update-konten/' . $id)->withInput();
        }
    }

    // ===================================================================
    // ------------------------ DELETE KONTEN ----------------------------
    // ===================================================================
    public function deleteKonten($id)
    {
        $blogModel = new BlogModel();
        $konten = $blogModel->find($id);

        if ($konten['img_thumbnail'] != 'default.jpg') {
            $gambarLamaPath = 'assets/img/blog/' . $konten['img_thumbnail'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }
        $deleted = $blogModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Artikel/blog berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/blog/blog');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan gambar banner'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/blog/blog')->withInput();
        }
    }

    // ===================================================================
    // ------------------------ VIEW DETAIL KONTEN -----------------------
    // ===================================================================
    public function detailKonten($id)
    {
        $blogModel = new BlogModel();
        $userModel = new UsersModel(); // Tambahkan ini
        $blog_detail = $blogModel->getBlogDetail($id); // Buat method getBlogDetail di BlogModel
        $user_info = $userModel->getUserInfo($blog_detail['created_by']); // Buat method getUserInfo di UsersModel
        $data = [
            'title' => 'Detail Konten',
            'blog_detail' => $blog_detail,
            'user_info' => $user_info // Tambahkan data user_info
        ];

        return view('dashboard/blog/detailKonten', $data);
    }
}
