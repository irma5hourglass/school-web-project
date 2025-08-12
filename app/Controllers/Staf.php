<?php

namespace App\Controllers;

class Staf extends BaseController
{
    public function password()
    {
        echo (password_hash('123', PASSWORD_BCRYPT));
    }

    public function index()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('dashboard');
        }
        $data = [
            'title' => 'Tenaga Kependidikan',
        ];
        return view('auth/staf/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Tenaga Kependidikan',
                'list' => $this->staf->orderBy('staf_id', 'ASC')->findAll()

            ];
            $msg = [
                'data' => view('auth/staf/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title' => 'Tambah Tenaga Kependidikan',

            ];
            $msg = [
                'data' => view('auth/staf/tambah', $data)
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
                    'rules' => 'required|is_unique[staf.nip]|min_length[10]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'min_length' => '{field} minimal 10',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Tenaga Kependidikan',
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
                'alamat' => [
                    'label' => 'Alamat',
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
                'jabatan' => [
                    'label' => 'Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'foto' => [
                    'label' => 'Foto',
                    'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
                    'errors' => [
                        'uploaded' => 'Pilih file {field}',
                        'max_size' => 'Ukuran file {field} tidak boleh lebih dari 2MB',
                        'is_image' => 'File {field} harus berupa foto'
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
                        'alamat' => $validation->getError('alamat'),
                        'pendidikan' => $validation->getError('pendidikan'),
                        'jabatan' => $validation->getError('jabatan'),
                        'foto' => $validation->getError('foto'),
                    ]
                ];
            } else {
                $foto = $this->request->getFile('foto');
                $newName = $foto->getName();
                \Config\Services::image()
                    ->withFile($foto)
                    ->fit(800, 800, 'center')
                    ->save('img/staf/thumb/' . 'thumb_' .  $foto->getName());
                $foto->move('img/staf', $newName);
                $simpandata = [
                    'nip' => $this->request->getVar('nip'),
                    'nama' => $this->request->getVar('nama'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'alamat' => $this->request->getVar('alamat'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'jabatan' => $this->request->getVar('jabatan'),
                    'foto'         => $newName,

                ];

                $this->staf->insert($simpandata);
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
            $staf_id = $this->request->getVar('staf_id');
            $list =  $this->staf->find($staf_id);
            $foto = $list['foto'];
            $data = [
                'title'         => 'Edit Tenaga Kependidikan',
                'staf_id'       => $list['staf_id'],
                'nip'           => $list['nip'],
                'nama'          => $list['nama'],
                'tmp_lahir'     => $list['tmp_lahir'],
                'tgl_lahir'     => $list['tgl_lahir'],
                'alamat'        => $list['alamat'],
                'pendidikan'    => $list['pendidikan'],
                'jabatan'       => $list['jabatan'],
                'foto'          => $foto,
            ];
            $msg = [
                'sukses' => view('auth/staf/edit', $data)
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
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 10',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Tenaga Kependidikan',
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
                'alamat' => [
                    'label' => 'Alamat',
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
                'jabatan' => [
                    'label' => 'Jabatan',
                    'rules' => 'required|alpha_numeric_punct',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ];
            // Cek apakah ada unggahan file foto baru
            if ($this->request->getFile('foto')->isValid()) {
                $rules['foto'] = [
                    'label' => 'Foto',
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
                        'alamat' => $validation->getError('alamat'),
                        'pendidikan' => $validation->getError('pendidikan'),
                        'jabatan' => $validation->getError('jabatan'),
                        'foto'        => $validation->getError('foto'),
                    ]
                ];
            } else {

                $staf_id = $this->request->getVar('staf_id');
                $updatedata = [
                    'nip' => $this->request->getVar('nip'),
                    'nama' => $this->request->getVar('nama'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'alamat' => $this->request->getVar('alamat'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'jabatan' => $this->request->getVar('jabatan'),
                ];
                // Cek apakah ada unggahan file foto baru
                if ($this->request->getFile('foto')->isValid()) {
                    $foto = $this->request->getFile('foto');
                    $newName = $foto->getName();
                    \Config\Services::image()
                        ->withFile($foto)
                        ->fit(800, 800, 'center')
                        ->save('img/staf/thumb/' . 'thumb_' .  $foto->getName());
                    $foto->move('img/staf', $newName);
                    $updatedata['foto'] = $newName;
                }

                $this->staf->update($staf_id, $updatedata);
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

            $staf_id = $this->request->getVar('staf_id');
            //check
            $cekdata = $this->staf->find($staf_id);
            $fotolama = $cekdata['foto'];
            if ($fotolama != 'default.png') {
                unlink('img/staf/' . $fotolama);
                unlink('img/staf/thumb/' . 'thumb_' . $fotolama);
            }
            $this->staf->delete($staf_id);
            $msg = [
                'sukses' => 'Data Tenaga Kependidikan Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $staf_id = $this->request->getVar('staf_id');
            $jmldata = count($staf_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->staf->find($staf_id[$i]);
                $fotolama = $cekdata['foto'];
                if ($fotolama != 'default.png') {
                    unlink('img/staf/' . $fotolama);
                    unlink('img/staf/thumb/' . 'thumb_' . $fotolama);
                }
                $this->staf->delete($staf_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
}
