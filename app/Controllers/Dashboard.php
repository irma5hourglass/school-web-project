<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }
        $staf = $this->staf->selectCount('staf_id')->first();
        $guru = $this->guru->selectCount('guru_id')->first();
        $siswa = $this->siswa->selectCount('siswa_id')->first();
        $kelas = $this->kelas->selectCount('kelas_id')->first();
        $gallery = $this->gallery->selectCount('gallery_id')->first();
        $berita = $this->berita->selectCount('berita_id')->first();
        $pengumuman = $this->pengumuman->selectCount('pengumuman_id')->first();
        $ekstrakurikuler = $this->ekstrakurikuler->selectCount('ekstra_id')->first();
        $data = [
            'title' => 'Admin - Dashboard',
            'staf' => $staf,
            'guru' => $guru,
            'siswa' => $siswa,
            'kelas' => $kelas,
            'gallery' => $gallery,
            'berita' => $berita,
            'pengumuman' => $pengumuman,
            'ekstrakurikuler' => $ekstrakurikuler,
        ];
        return view('auth/dashboard', $data);
    }
}
