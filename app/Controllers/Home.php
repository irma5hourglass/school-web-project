<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $staf = $this->staf->selectCount('staf_id')->first();
        $guru = $this->guru->selectCount('guru_id')->first();
        $siswa = $this->siswa->selectCount('siswa_id')->first();
        $kelas = $this->kelas->selectCount('kelas_id')->first();
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $berita = $this->berita->published();
        $list_staf = $this->staf->orderBy('staf_id')->get()->getResultArray();
        $gallery = $this->gallery->list();
        $list_guru = $this->guru->list();
        $pengumuman = $this->pengumuman->list();
        $ekstrakurikuler = $this->ekstrakurikuler->list();
        $kategori = $this->kategori->list();
        $data = [
            'title' => 'Selamat Datang!',
            'staf' => $staf,
            'guru' => $guru,
            'list_guru' => $list_guru,
            'siswa' => $siswa,
            'kelas' => $kelas,
            'konfigurasi' => $konfigurasi,
            'berita' => $berita,
            'list_staf' => $list_staf,
            'gallery' => $gallery,
            'kategori' => $kategori,
            'pengumuman' => $pengumuman,
            'ekstrakurikuler' => $ekstrakurikuler

        ];
        return view('front/layout/menu', $data);
    }

    public function profil()
    {
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $kategori = $this->kategori->list();
        $data = [
            'title' => 'Profil',
            'kategori' => $kategori,
            'konfigurasi' => $konfigurasi,

        ];
        return view('front/profil/profil', $data);
    }
    public function ekstrakurikuler()
    {
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $ekstrakurikuler = $this->ekstrakurikuler->list();
        $kategori = $this->kategori->list();
        $data = [
            'title' => 'Profil',
            'ekstrakurikuler' => $ekstrakurikuler,
            'kategori' => $kategori,
            'konfigurasi' => $konfigurasi,

        ];
        return view('front/ekstrakurikuler/ekstrakurikuler', $data);
    }



    public function detail_berita($slug_berita = null)
    {
        if (!isset($slug_berita)) return redirect()->to('/home#berita');
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $berita = $this->berita->detail_berita($slug_berita);
        $kategori = $this->kategori->list();
        if ($berita) {
            $data = [
                'title'  => 'Berita - ' . $berita->judul_berita,
                'konfigurasi' => $konfigurasi,
                'berita' => $berita,
                'kategori' => $kategori,
            ];
            return view('front/berita/detail', $data);
        } else {
            return redirect()->to('/home#berita');
        }
    }




    public function detail_pengumuman($id = null)
    {
        if (!isset($id)) return redirect()->to('/home#pengumuman');
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();

        // Retrieve the pengumuman details by ID
        $pengumuman = $this->pengumuman->detail_pengumuman($id);
        $kategori = $this->kategori->list();
        if ($pengumuman) {
            $data = [
                'title' => 'Detail Pengumuman',
                'pengumuman' => $pengumuman,
                'konfigurasi' => $konfigurasi,
                'kategori' => $kategori,
            ];
            return view('front/pengumuman/detail', $data);
        } else {
            return redirect()->to('/home#pengumuman');
        }
    }

    public function detail_gallery($id = null)
    {
        if (!isset($id)) return redirect()->to('/home#gallery');
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $gallery = $this->gallery->detail_gallery($id);
        $list_foto = $this->foto->detail_foto($id);
        $kategori = $this->kategori->list();
        if ($gallery) {
            $data = [
                'title'  => 'Gallery - ' . $gallery->nama_gallery,
                'konfigurasi' => $konfigurasi,
                'gallery' => $gallery,
                'list_foto' => $list_foto,
                'kategori' => $kategori,
            ];
            return view('front/gallery/detail', $data);
        } else {
            return redirect()->to('/home#gallery');
        }
    }

    public function kumpulanberita()
    {
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $berita = $this->berita->list();
        $kategori = $this->kategori->list();
        $data = [
            'title' => 'Semua Berita',
            'berita' => $berita,
            'kategori' => $kategori,
            'konfigurasi' => $konfigurasi,

        ];
        return view('front/berita/list', $data);
    }

    public function kumpulangallery()
    {
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $gallery = $this->gallery->list();
        $kategori = $this->kategori->list();
        $data = [
            'title' => 'Semua Gallery',
            'gallery' => $gallery,
            'kategori' => $kategori,
            'konfigurasi' => $konfigurasi,

        ];
        return view('front/gallery/list', $data);
    }

    public function kumpulanpengumuman()
    {
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $pengumuman = $this->pengumuman->list();
        $kategori = $this->kategori->list();
        $data = [
            'title' => 'Semua Pengumuman',
            'pengumuman' => $pengumuman,
            'kategori' => $kategori,
            'konfigurasi' => $konfigurasi,

        ];
        return view('front/pengumuman/list', $data);
    }
    public function kumpulanstaf()
    {
        $konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $list_staf = $this->staf->orderBy('staf_id')->get()->getResultArray();
        $list_guru = $this->guru->list();
        $kategori = $this->kategori->list();
        $data = [
            'title' => 'Semua Tenaga Kependidikan',
            'list_staf' => $list_staf,
            'list_guru' => $list_guru,
            'kategori' => $kategori,
            'konfigurasi' => $konfigurasi,

        ];
        return view('front/staf/staf', $data);
    }
}
