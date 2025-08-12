<?php

namespace App\Controllers;

class Konfigurasi extends BaseController
{
    public function index()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('/dashboard');
        }
        $list =  $this->konfigurasi->orderBy('konfigurasi_id')->first();
        $logo = $list['logo'];
        $icon = $list['icon'];

        $data = [
            'title'             => 'Konfigurasi Web',
            'konfigurasi'       => $this->konfigurasi->list(),
            'konfigurasi_id'    => $list['konfigurasi_id'],
            'nama_web'          => $list['nama_web'],
            'deskripsi'         => $list['deskripsi'],
            'visi'              => $list['visi'],
            'misi'              => $list['misi'],
            'tujuan'            => $list['tujuan'],
            'keunggulan'        => $list['keunggulan'],
            'instagram'         => $list['instagram'],
            'facebook'          => $list['facebook'],
            'whatsapp'          => $list['whatsapp'],
            'email'             => $list['email'],
            'alamat'            => $list['alamat'],
            'logo'              => $logo,
            'icon'              => $icon,
            'maps'          => $list['maps'],

        ];
        return view('auth/konfigurasi/website', $data);
    }

    public function submit()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $rules = [
                'nama_web' => [
                    'label' => 'Nama website',
                    'rules' => 'required|alpha_numeric_space',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'alpha_numeric_space' => 'Tidak boleh mengandung karakter unik',
                    ]
                ],
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'visi' => [
                    'label' => 'Visi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'misi' => [
                    'label' => 'Misi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tujuan' => [
                    'label' => 'Tujuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'keunggulan' => [
                    'label' => 'Keunggulan Sekolah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'instagram' => [
                    'label' => 'Instagram',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'facebook' => [
                    'label' => 'Facebook',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'whatsapp' => [
                    'label' => 'Whatsapp',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
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
                'maps' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]


            ];

            // Cek apakah ada unggahan file foto baru
            if ($this->request->getFile('logo')->isValid()) {
                $rules['logo'] = [
                    'label' => 'Foto',
                    'rules' => 'uploaded[logo]|max_size[logo,2048]|is_image[logo]',
                    'errors' => [
                        'uploaded' => 'Pilih file {field}',
                        'max_size' => 'Ukuran file {field} tidak boleh lebih dari 2MB',
                        'is_image' => 'File {field} harus berupa foto'
                    ]
                ];
            }
            if ($this->request->getFile('icon')->isValid()) {
                $rules['icon'] = [
                    'label' => 'Foto',
                    'rules' => 'uploaded[icon]|max_size[icon,2048]|is_image[icon]',
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
                        'nama_web'      => $validation->getError('nama_web'),
                        'deskripsi'     => $validation->getError('deskripsi'),
                        'visi'          => $validation->getError('visi'),
                        'misi'          => $validation->getError('misi'),
                        'tujuan'        => $validation->getError('tujuan'),
                        'keunggulan'    => $validation->getError('keunggulan'),
                        'instagram'     => $validation->getError('instagram'),
                        'facebook'      => $validation->getError('facebook'),
                        'whatsapp'      => $validation->getError('whatsapp'),
                        'email'         => $validation->getError('email'),
                        'alamat'        => $validation->getError('alamat'),
                        'logo'          => $validation->getError('logo'),
                        'icon'          => $validation->getError('icon'),
                        'maps'      => $validation->getError('maps'),
                    ]
                ];
            } else {
                $konfigurasi_id = $this->request->getVar('konfigurasi_id');

                $simpandata = [
                    'nama_web'     => $this->request->getVar('nama_web'),
                    'deskripsi'    => $this->request->getVar('deskripsi'),
                    'visi'         => $this->request->getVar('visi'),
                    'misi'         => $this->request->getVar('misi'),
                    'tujuan'   => $this->request->getVar('tujuan'),
                    'keunggulan'   => $this->request->getVar('keunggulan'),
                    'instagram'    => $this->request->getVar('instagram'),
                    'facebook'     => $this->request->getVar('facebook'),
                    'whatsapp'     => $this->request->getVar('whatsapp'),
                    'email'        => $this->request->getVar('email'),
                    'alamat'       => $this->request->getVar('alamat'),
                    'maps' => $this->request->getPost('maps'),

                ];

                // Cek apakah ada unggahan file foto baru
                if ($this->request->getFile('logo')->isValid()) {
                    $logo = $this->request->getFile('logo');
                    $logoName = $logo->getName();
                    \Config\Services::image()
                        ->withFile($logo)
                        ->fit(250, 250, 'center')
                        ->save('img/konfigurasi/logo/thumb/' . 'thumb_' .  $logo->getName());
                    $logo->move('img/konfigurasi/logo', $logoName);
                    $simpandata['logo'] = $logoName;
                }
                // Cek apakah ada unggahan file foto baru
                if ($this->request->getFile('icon')->isValid()) {
                    $icon = $this->request->getFile('icon');
                    $iconName = $icon->getName();
                    \Config\Services::image()
                        ->withFile($icon)
                        ->fit(250, 250, 'center')
                        ->save('img/konfigurasi/logo/thumb/' . 'thumb_' .  $icon->getName());
                    $icon->move('img/konfigurasi/icon', $iconName);
                    $simpandata['icon'] = $iconName;
                }

                $this->konfigurasi->update($konfigurasi_id, $simpandata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function user()
    {
        $data = [
            'title' => 'Konfigurasi User'
        ];
        return view('auth/user/index', $data);
    }

    public function getuser()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Konfigurasi user',
                'list' => $this->user->list()
            ];
            $msg = [
                'data' => view('auth/user/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formuser()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah User',
            ];
            $msg = [
                'data' => view('auth/user/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanuser()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'valid_email' => 'Masukkan {field} dengan benar',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'level' => [
                    'label' => 'Level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak oleh kosong',
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
                        'username'  => $validation->getError('username'),
                        'nama'   => $validation->getError('nama'),
                        'email'           => $validation->getError('email'),
                        'password'        => $validation->getError('password'),
                        'level'        => $validation->getError('level'),
                        'foto'        => $validation->getError('foto'),
                        'active'        => $validation->getError('active'),
                    ]
                ];
            } else {
                $foto = $this->request->getFile('foto');
                $newName = $foto->getName();
                \Config\Services::image()
                    ->withFile($foto)
                    ->fit(250, 250, 'center')
                    ->save('img/user/thumb/' . 'thumb_' .  $foto->getName());
                $foto->move('img/user', $newName);
                $simpandata = [
                    'username'     => $this->request->getVar('username'),
                    'nama'         => $this->request->getVar('nama'),
                    'email'        => $this->request->getVar('email'),
                    'isi'          => $this->request->getVar('isi'),
                    'password'     => (password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)),
                    'level'        => $this->request->getVar('level'),
                    'foto'         => $newName,
                    'active'       => $this->request->getVar('active'),
                ];

                $this->user->insert($simpandata);

                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function toggle()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getVar('user_id');
            $cari =  $this->user->find($user_id);

            if ($cari['active'] == '1') {
                $list =  $this->user->getaktif($user_id);
                $toggle = $list ? 0 : 1;
                $updatedata = [
                    'active'        => $toggle,
                ];
                $this->user->update($user_id, $updatedata);
                $msg = [
                    'sukses' => 'Berhasil nonaktifkan user!'
                ];
            } else {
                $list =  $this->user->getnonaktif($user_id);
                $toggle = $list ? 1 : 0;
                $updatedata = [
                    'active'        => $toggle,
                ];
                $this->user->update($user_id, $updatedata);
                $msg = [
                    'sukses' => 'Berhasil mengaktifkan user!'
                ];
            }


            echo json_encode($msg);
        }
    }

    public function formedituser()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getVar('user_id');
            $list =  $this->user->find($user_id);
            $foto = $list['foto'];
            $data = [
                'title'         => 'Edit User',
                'user_id'       => $list['user_id'],
                'username'      => $list['username'],
                'nama'          => $list['nama'],
                'email'         => $list['email'],
                'level'         => $list['level'],
                'password'      => '',
                'foto'          => $foto,
                'active'        => $list['active'],
            ];
            $msg = [
                'sukses' => view('auth/user/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $rules = [
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'valid_email' => 'Masukkan {field} dengan benar',
                    ]
                ],
                // 'password' => [
                //     'label' => 'Password',
                //     'rules' => 'permit_empty',
                //     'errors' => [
                //         'required' => '{field} tidak boleh kosong',
                //     ]
                // ],
                'level' => [
                    'label' => 'Level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],


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
                        'username'  => $validation->getError('username'),
                        'nama'   => $validation->getError('nama'),
                        'email'           => $validation->getError('email'),
                        // 'password'        => $validation->getError('password'),
                        'level'        => $validation->getError('level'),
                        'foto'        => $validation->getError('foto'),
                    ]
                ];
            } else {
                $user_id = $this->request->getVar('user_id');
                $existingUserData = $this->user->find($user_id);
                $updatedata = [
                    'username'  => $this->request->getVar('username'),
                    'nama'      => $this->request->getVar('nama'),
                    'email'     => $this->request->getVar('email'),
                    'isi'           => $this->request->getVar('isi'),
                    // 'password'     => (password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)),
                    'level'        => $this->request->getVar('level'),
                ];
                $newPassword = $this->request->getVar('password');
                if (!empty($newPassword)) {
                    $updatedata['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                } else {
                    // Retain the old password


                    $updatedata['password'] = $existingUserData['password'];
                }

                // Cek apakah ada unggahan file foto baru
                if ($this->request->getFile('foto')->isValid()) {
                    $foto = $this->request->getFile('foto');
                    $newName = $foto->getName();
                    \Config\Services::image()
                        ->withFile($foto)
                        ->fit(250, 250, 'center')
                        ->save('img/user/thumb/' . 'thumb_' .  $foto->getName());
                    $foto->move('img/user', $newName);
                    $updatedata['foto'] = $newName;
                }


                $this->user->update($user_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapususer()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $cekdata = $this->user->find($user_id);
            $this->user->delete($user_id);
            $msg = [
                'sukses' => 'Data User Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusalluser()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getVar('user_id');
            $jmldata = count($user_id);
            for ($i = 0; $i < $jmldata; $i++) {
                $cekdata = $this->user->find($user_id[$i]);
                $this->user->delete($user_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
}
