<?php

namespace App\Controllers;

class Guru extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Guru'
        ];
        return view('auth/guru/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Guru',
                'list' => $this->guru->list()


            ];
            $msg = [
                'data' => view('auth/guru/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Guru',
                'mapel' => $this->mapel->orderBy('nama_mapel', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/guru/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nip' => [
                    'label' => 'Nip',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama guru',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tmp_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'mapel_id' => [
                    'label' => 'Nama Mapel',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pendidikan' => [
                    'label' => 'Pendidikan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'foto' => [
                    'label' => 'foto',
                    'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
                    'errors' => [
                        'uploaded' => 'foto harus diunggah.',
                        'max_size' => 'Ukuran foto maksimal 2MB.',
                        'is_image' => 'File yang diunggah harus berupa foto.'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nip' => $validation->getError('nip'),
                        'nama' => $validation->getError('nama'),
                        'tmp_lahir' => $validation->getError('tmp_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'mapel_id' => $validation->getError('mapel_id'),
                        'pendidikan' => $validation->getError('pendidikan'),
                        'alamat' => $validation->getError('alamat'),
                        'foto'    => $validation->getError('foto')

                    ]
                ];
            } else {
                // Process the uploaded image file
                $foto = $this->request->getFile('foto');
                $newName = $foto->getName();

                \Config\Services::image()
                    ->withFile($foto)
                    ->fit(800, 800, 'center')
                    ->save('img/guru/thumb/' . 'thumb_' .  $foto->getName());

                $foto->move('img/guru', $newName);
                $simpandata = [
                    'nip' => $this->request->getVar('nip'),
                    'nama' => $this->request->getVar('nama'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'mapel_id' => $this->request->getVar('mapel_id'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'alamat' => $this->request->getVar('alamat'),
                    'foto' => $newName,
                ];

                $this->guru->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $guru_id = $this->request->getVar('guru_id');
            $list =  $this->guru->find($guru_id);
            $mapel =  $this->mapel->list();
            $foto = $list['foto'];
            $data = [
                'title'         => 'Edit Guru',
                'mapel'         => $mapel,
                'guru_id'       => $list['guru_id'],
                'nip'           => $list['nip'],
                'nama'          => $list['nama'],
                'tmp_lahir'     => $list['tmp_lahir'],
                'tgl_lahir'     => $list['tgl_lahir'],
                'mapel_id'      => $list['mapel_id'],
                'pendidikan'    => $list['pendidikan'],
                'alamat'        => $list['alamat'],
                'foto'        => $foto,
            ];
            $msg = [
                'sukses' => view('auth/guru/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $rules = [
                'nip' => [
                    'label' => 'Nip',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 10',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Guru',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tmp_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'mapel_id' => [
                    'label' => 'Nama Mapel',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pendidikan' => [
                    'label' => 'Pendidikan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ];

            // Cek apakah ada unggahan file foto baru
            if ($this->request->getFile('foto')->isValid()) {
                $rules['foto'] = [
                    'label' => 'foto',
                    'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
                    'errors' => [
                        'uploaded' => 'Pilih file {field}',
                        'max_size' => 'Ukuran file {field} tidak boleh lebih dari 2MB',
                        'is_image' => 'File {field} harus berupa foto'
                    ]
                ];
            }

            $valid = $this->validate($rules);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nip' => $validation->getError('nip'),
                        'nama' => $validation->getError('nama'),
                        'tmp_lahir' => $validation->getError('tmp_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'mapel_id' => $validation->getError('mapel_id'),
                        'pendidikan' => $validation->getError('pendidikan'),
                        'alamat' => $validation->getError('alamat'),
                        'foto'        => $validation->getError('foto')
                    ]
                ];
            } else {
                $guru_id = $this->request->getVar('guru_id');
                $updatedata = [
                    'nip' => $this->request->getVar('nip'),
                    'nama' => $this->request->getVar('nama'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'mapel_id' => $this->request->getVar('mapel_id'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'alamat' => $this->request->getVar('alamat'),
                ];

                // Cek apakah ada unggahan file foto baru
                if ($this->request->getFile('foto')->isValid()) {
                    $foto = $this->request->getFile('foto');
                    $newName = $foto->getName();
                    \Config\Services::image()
                        ->withFile($foto)
                        ->fit(800, 800, 'center')
                        ->save('img/guru/thumb/' . 'thumb_' . $foto->getName());
                    $foto->move('img/guru', $newName);
                    $updatedata['foto'] = $newName;
                }


                $this->guru->update($guru_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $guru_id = $this->request->getVar('guru_id');

            // Check if there are any classes associated with this guru
            $kelas_id = $this->kelas->where('guru_id', $guru_id)->countAllResults();

            if ($kelas_id > 0) {
                $msg = [
                    'error' => 'Tidak dapat menghapus guru karena masih ada kelas yang terkait.'
                ];
            } else {
                // If no classes are associated, proceed with deleting the guru
                $cekdata = $this->guru->find($guru_id);
                $fotolama = $cekdata['foto'];
                if ($fotolama != 'default.png') {
                    unlink('img/guru/' . $fotolama);
                    unlink('img/guru/thumb/' . 'thumb_' . $fotolama);
                }
                $this->guru->delete($guru_id);
                $msg = [
                    'sukses' => 'Data Guru Berhasil Dihapus'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $guru_ids = $this->request->getVar('guru_id');
            $deletedCount = 0;

            foreach ($guru_ids as $guru_id) {
                // Check if there are any classes associated with this guru
                $kelas_id = $this->kelas->where('guru_id', $guru_id)->countAllResults();

                if ($kelas_id > 0) {
                    continue; // Skip deletion for this guru
                }

                // If no classes are associated, proceed with deleting the guru
                $cekdata = $this->guru->find($guru_id);
                $fotolama = $cekdata['foto'];
                if ($fotolama != 'default.png') {
                    unlink('img/guru/' . $fotolama);
                    unlink('img/guru/thumb/' . 'thumb_' . $fotolama);
                }
                $this->guru->delete($guru_id);
                $deletedCount++;
            }

            if ($deletedCount > 0) {
                $msg = [
                    'sukses' => "$deletedCount Data berhasil dihapus"
                ];
            } else {
                $msg = [
                    'error' => 'Tidak dapat menghapus guru karena masih ada kelas yang terkait.'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function formupload()
    {
        if ($this->request->isAJAX()) {
            $guru_id = $this->request->getVar('guru_id');
            $list =  $this->guru->find($guru_id);
            $data = [
                'title' => 'Upload Foto Guru',
                'list'  => $list,
                'guru_id' => $guru_id
            ];
            $msg = [
                'sukses' => view('auth/guru/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    //Start mapel (backend)
    public function mapel()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('/dashboard');
        }
        $data = [
            'title' => 'Mapel'
        ];
        return view('auth/mapel/index', $data);
    }

    public function getmapel()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Guru - Mapel',
                'list' => $this->mapel->orderBy('mapel_id', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/mapel/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formmapel()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Mapel'
            ];
            $msg = [
                'data' => view('auth/mapel/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanmapel()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_mapel' => [
                    'label' => 'Mapel',
                    'rules' => 'required|is_unique[mapel.nama_mapel]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_mapel' => $validation->getError('nama_mapel'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_mapel' => $this->request->getVar('nama_mapel'),
                ];

                $this->mapel->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditmapel()
    {
        if ($this->request->isAJAX()) {
            $mapel_id = $this->request->getVar('mapel_id');
            $list =  $this->mapel->find($mapel_id);
            $data = [
                'title'           => 'Edit Mapel',
                'mapel_id'        => $list['mapel_id'],
                'nama_mapel'      => $list['nama_mapel'],
            ];
            $msg = [
                'sukses' => view('auth/mapel/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatemapel()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_mapel' => [
                    'label' => 'Mapel',
                    'rules' => 'required|is_unique[mapel.nama_mapel]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_mapel' => $validation->getError('nama_mapel'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama_mapel' => $this->request->getVar('nama_mapel'),
                ];

                $mapel_id = $this->request->getVar('mapel_id');
                $this->mapel->update($mapel_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusmapel()
    {
        if ($this->request->isAJAX()) {
            $mapel_id = $this->request->getVar('mapel_id');

            // Check if there are any guru records associated with this mapel
            $guruWithMapel = $this->guru->where('mapel_id', $mapel_id)->countAllResults();

            if ($guruWithMapel > 0) {
                $msg = [
                    'error' => 'Tidak dapat menghapus mapel karena masih ada guru yang terkait.'
                ];
            } else {
                // If no guru records are associated, delete the mapel
                $this->mapel->delete($mapel_id);
                $msg = [
                    'sukses' => 'Mapel berhasil dihapus.'
                ];
            }

            echo json_encode($msg);
        }
    }
    //end mapel
}
