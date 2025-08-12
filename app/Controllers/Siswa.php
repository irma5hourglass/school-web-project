<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Modelsiswa;

class Siswa extends BaseController
{

    public function index()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('/dashboard');
        }
        $data = [
            'title' => 'Siswa',
        ];
        return view('auth/siswa/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Siswa',
                'list' => $this->siswa->list()

            ];
            $msg = [
                'data' => view('auth/siswa/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function getdatasiswa()
    {
        $request = Services::request();
        $datamodel = $this->siswa;
        if ($request->getMethod()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;

                $row = [];
                $edit = "<button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"edit('" . $list->siswa_id . "')\">
                <i class=\"fa fa-edit\"></i>
            </button>";
                $hapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->siswa_id . "')\">
                <i class=\"fa fa-trash\"></i>
            </button>";

                $row[] = "<input type=\"checkbox\" name=\"siswa_id[]\" class=\"centangSiswaid\" value=\"$list->siswa_id\">";
                $row[] = $no;
                $row[] = $list->nis;
                $row[] = $list->nama;
                $row[] = $list->nama_kelas;
                $row[] = $list->alamat;
                $row[] = $list->tmp_lahir . ", " . date_indo($list->tgl_lahir);
                $row[] = $list->jenkel;

                $row[] = $edit . " " . $hapus;
                $data[] = $row;
            }
            $output = [
                "recordTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];

            echo json_encode($output);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Siswa',
                'kelas' => $this->kelas->orderBy('nama_kelas', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/siswa/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nis' => [
                    'label' => 'Nis',
                    'rules' => 'required|is_unique[siswa.nis]|min_length[5]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'min_length' => '{field} minimal 5',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Siswa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kelas_id' => [
                    'label' => 'Kelas',
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
                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nis' => $validation->getError('nis'),
                        'nama' => $validation->getError('nama'),
                        'kelas_id' => $validation->getError('kelas_id'),
                        'alamat' => $validation->getError('alamat'),
                        'tmp_lahir' => $validation->getError('tmp_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jenkel' => $validation->getError('jenkel')
                    ]
                ];
            } else {
                $simpandata = [
                    'nis' => $this->request->getVar('nis'),
                    'nama' => $this->request->getVar('nama'),
                    'kelas_id' => $this->request->getVar('kelas_id'),
                    'alamat' => $this->request->getVar('alamat'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'jenkel' => $this->request->getVar('jenkel'),
                ];

                $this->siswa->insert($simpandata);
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
            $siswa_id = $this->request->getVar('siswa_id');
            $list =  $this->siswa->find($siswa_id);
            $kelas =  $this->kelas->list();
            $data = [
                'title'         => 'Edit Siswa',
                'kelas'         => $kelas,
                'siswa_id'      => $list['siswa_id'],
                'nis'           => $list['nis'],
                'nama'          => $list['nama'],
                'kelas_id'      => $list['kelas_id'],
                'alamat'        => $list['alamat'],
                'tmp_lahir'     => $list['tmp_lahir'],
                'tgl_lahir'     => $list['tgl_lahir'],
                'jenkel'        => $list['jenkel'],
            ];
            $msg = [
                'sukses' => view('auth/siswa/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nis' => [
                    'label' => 'Nis',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Siswa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kelas_id' => [
                    'label' => 'Kelas',
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
                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nis' => $validation->getError('nis'),
                        'nama' => $validation->getError('nama'),
                        'kelas_id' => $validation->getError('kelas_id'),
                        'alamat' => $validation->getError('alamat'),
                        'tmp_lahir' => $validation->getError('tmp_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jenkel' => $validation->getError('jenkel')
                    ]
                ];
            } else {
                $updatedata = [
                    'nis' => $this->request->getVar('nis'),
                    'nama' => $this->request->getVar('nama'),
                    'kelas_id' => $this->request->getVar('kelas_id'),
                    'alamat' => $this->request->getVar('alamat'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'jenkel' => $this->request->getVar('jenkel'),
                ];

                $siswa_id = $this->request->getVar('siswa_id');
                $this->siswa->update($siswa_id, $updatedata);
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

            $siswa_id = $this->request->getVar('siswa_id');
            $this->siswa->delete($siswa_id);
            $msg = [
                'sukses' => 'Data siswa Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $siswa_id = $this->request->getVar('siswa_id');
            $jmldata = count($siswa_id);
            for ($i = 0; $i < $jmldata; $i++) {
                $this->siswa->delete($siswa_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }


    //Start kelas (backend)
    public function kelas()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('dashboard');
        }
        $data = [
            'title' => 'Kelas'
        ];
        return view('auth/kelas/index', $data);
    }

    public function getkelas()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Siswa - Kelas',
                'list' => $this->kelas->listjoin()
            ];
            $msg = [
                'data' => view('auth/kelas/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formkelas()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Kelas',
                'guru' => $this->guru->orderBy('nama', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/kelas/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpankelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kelas' => [
                    'label' => 'Nama Kelas',
                    'rules' => 'required|is_unique[kelas.nama_kelas]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ],
                'guru_id' => [
                    'label' => 'Wali kelas',
                    'rules' => 'required|is_unique[kelas.guru_id]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas'),
                        'guru_id' => $validation->getError('guru_id'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_kelas' => $this->request->getVar('nama_kelas'),
                    'guru_id'    => $this->request->getVar('guru_id'),
                ];

                $this->kelas->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditkelas()
    {
        if ($this->request->isAJAX()) {
            $kelas_id = $this->request->getVar('kelas_id');
            $list =  $this->kelas->find($kelas_id);
            $guru =  $this->guru->list();
            $data = [
                'title'           => 'Edit Kelas',
                'guru'            => $guru,
                'kelas_id'        => $list['kelas_id'],
                'nama_kelas'      => $list['nama_kelas'],
                'guru_id'         => $list['guru_id'],
            ];
            $msg = [
                'sukses' => view('auth/kelas/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatekelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kelas' => [
                    'label' => 'Nama Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'guru_id' => [
                    'label' => 'Wali kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas'),
                        'guru_id' => $validation->getError('guru_id'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama_kelas' => $this->request->getVar('nama_kelas'),
                    'guru_id' => $this->request->getVar('guru_id'),
                ];

                $kelas_id = $this->request->getVar('kelas_id');
                $this->kelas->update($kelas_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapuskelas()
    {
        if ($this->request->isAJAX()) {
            $kelas_id = $this->request->getVar('kelas_id');

            // Check if there are any students assigned to this class
            $siswaWithKelas = $this->siswa->where('kelas_id', $kelas_id)->countAllResults();

            if ($siswaWithKelas > 0) {
                $msg = [
                    'error' => 'Tidak dapat menghapus kelas karena masih ada siswa yang terdaftar dalam kelas ini.'
                ];
            } else {
                // No students associated, proceed with deletion
                $this->kelas->delete($kelas_id);
                $msg = [
                    'sukses' => 'Kelas Berhasil Dihapus'
                ];
            }

            echo json_encode($msg);
        }
    }

    //end kelas


}
