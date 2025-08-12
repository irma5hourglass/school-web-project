<?php

namespace App\Controllers;

class Ekstrakurikuler extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Ekstrakurikuler'
        ];
        return view('auth/ekstrakurikuler/index', $data);
    }

    public function getekstra()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Ekstrakurikuler',
                'list' => $this->ekstrakurikuler->orderBy('ekstra_id', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/ekstrakurikuler/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Ekstrakurikuler'
            ];
            $msg = [
                'data' => view('auth/ekstrakurikuler/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_ekstra' => [
                    'label' => 'Nama Ekstrakurikuler',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'gbr' => [
                    'label' => 'Gambar',
                    'rules' => 'uploaded[gbr]|max_size[gbr,2048]|is_image[gbr]',
                    'errors' => [
                        'uploaded' => 'Gambar harus diunggah.',
                        'max_size' => 'Ukuran gambar maksimal 2MB.',
                        'is_image' => 'File yang diunggah harus berupa gambar.'
                    ]
                ]

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_ekstra' => $validation->getError('nama_ekstra'),
                        'gbr'        => $validation->getError('gbr'),

                    ]
                ];
            } else {
                // Process the uploaded image file
                $gbr = $this->request->getFile('gbr');
                $newName = $gbr->getName();

                \Config\Services::image()
                    ->withFile($gbr)
                    ->fit(800, 533, 'center')
                    ->save('img/ekstrakurikuler/thumb/' . 'thumb_' .  $gbr->getName());

                $gbr->move('img/ekstrakurikuler', $newName);

                $simpandata = [
                    'nama_ekstra' => $this->request->getVar('nama_ekstra'),
                    'gbr'        => $newName,

                ];

                $this->ekstrakurikuler->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }

            return $this->response->setJSON($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $ekstra_id = $this->request->getVar('ekstra_id');
            $list =  $this->ekstrakurikuler->find($ekstra_id);
            $gbr = $list['gbr'];
            $data = [
                'title'           => 'Edit Ekstrakurikuler',
                'ekstra_id'     => $list['ekstra_id'],
                'nama_ekstra'   => $list['nama_ekstra'],
                'gbr'        => $gbr,
            ];
            $msg = [
                'sukses' => view('auth/ekstrakurikuler/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $rules = [
                'nama_ekstra' => [
                    'label' => 'Nama Ekstrakurikuler',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],


            ];
            // Cek apakah ada unggahan file gambar baru
            if ($this->request->getFile('gbr')->isValid()) {
                $rules['gbr'] = [
                    'label' => 'Gambar',
                    'rules' => 'uploaded[gbr]|max_size[gbr,2048]|is_image[gbr]',
                    'errors' => [
                        'uploaded' => 'Gambar harus diunggah.',
                        'max_size' => 'Ukuran gambar maksimal 2MB.',
                        'is_image' => 'File yang diunggah harus berupa gambar.'
                    ]
                ];
            }

            $valid = $this->validate($rules);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_ekstra' => $validation->getError('nama_ekstra'),
                        'gbr'        => $validation->getError('gbr'),
                    ]
                ];
            } else {

                $ekstra_id = $this->request->getVar('ekstra_id');
                $updatedata = [
                    'nama_ekstra' => $this->request->getVar('nama_ekstra'),

                ];

                // Cek apakah ada unggahan file gambar baru
                if ($this->request->getFile('gbr')->isValid()) {
                    $gbr = $this->request->getFile('gbr');
                    $newName = $gbr->getName();
                    \Config\Services::image()
                        ->withFile($gbr)
                        ->fit(800, 533, 'center')
                        ->save('img/ekstrakurikuler/thumb/' . 'thumb_' . $gbr->getName());
                    $gbr->move('img/ekstrakurikuler', $newName);
                    $updatedata['gbr'] = $newName;
                }


                $this->ekstrakurikuler->update($ekstra_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }

            return json_encode($msg);
        }
    }





    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $ekstra_id = $this->request->getVar('ekstra_id');

            $this->ekstrakurikuler->delete($ekstra_id);
            $msg = [
                'sukses' => 'Ekstrakurikuler Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }
}
