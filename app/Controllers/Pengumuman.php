<?php

namespace App\Controllers;

use Config\Services;

class Pengumuman extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Pengumuman',
        ];
        return view('auth/pengumuman/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Pengumuman',
                'list' => $this->pengumuman->orderBy('pengumuman_id', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/pengumuman/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Pengumuman'
            ];
            $msg = [
                'data' => view('auth/pengumuman/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul_pengumuman' => [
                    'label' => 'Judul Pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'isi_pengumuman' => [
                    'label' => 'Isi Pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul_pengumuman' => $validation->getError('judul_pengumuman'),
                        'isi_pengumuman' => $validation->getError('isi_pengumuman'),
                    ]
                ];
            } else {
                $simpandata = [
                    'judul_pengumuman' => $this->request->getVar('judul_pengumuman'),
                    'isi_pengumuman' => $this->request->getVar('isi_pengumuman'),
                    'tanggal'        => $this->request->getVar('tanggal'),
                ];

                $this->pengumuman->insert($simpandata);
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
            $pengumuman_id = $this->request->getVar('pengumuman_id');
            $list =  $this->pengumuman->find($pengumuman_id);
            $data = [
                'title'           => 'Edit Pengumuman',
                'pengumuman_id'     => $list['pengumuman_id'],
                'judul_pengumuman'   => $list['judul_pengumuman'],
                'isi_pengumuman'   => $list['isi_pengumuman'],
            ];
            $msg = [
                'sukses' => view('auth/pengumuman/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul_pengumuman' => [
                    'label' => 'Judul Pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'isi_pengumuman' => [
                    'label' => 'Isi Pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul_pengumuman' => $validation->getError('isi_pengumuman'),
                        'isi_pengumuman' => $validation->getError('judul_pengumuman'),
                    ]
                ];
            } else {
                $updatedata = [
                    'judul_pengumuman' => $this->request->getVar('judul_pengumuman'),
                    'isi_pengumuman' => $this->request->getVar('isi_pengumuman'),
                    'tanggal'        => $this->request->getVar('tanggal'),
                ];

                $pengumuman_id = $this->request->getVar('pengumuman_id');
                $this->pengumuman->update($pengumuman_id, $updatedata);
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

            $pengumuman_id = $this->request->getVar('pengumuman_id');

            $this->pengumuman->delete($pengumuman_id);
            $msg = [
                'sukses' => 'Pengumuman Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }
}
