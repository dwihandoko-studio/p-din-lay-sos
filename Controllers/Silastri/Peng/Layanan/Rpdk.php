<?php

namespace App\Controllers\Silastri\Peng\Layanan;

use App\Controllers\BaseController;
// use App\Models\Silastri\Peng\PtkModel;
// use App\Models\Silastri\Peng\SekolahModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Libraries\Profilelib;
use App\Libraries\Apilib;
use App\Libraries\Helplib;
use App\Libraries\Uuid;
use App\Libraries\Silastri\Riwayatpermohonanlib;

class Rpdk extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;
    private $_helpLib;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->_helpLib = new Helplib();
    }

    public function index()
    {
        return redirect()->to(base_url('silastri/peng/layanan/rpdk/add'));
    }

    public function add()
    {
        $data['title'] = 'Layanan Rekomendasi Penerbitan Dokumen Kependudukan';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;
        $data['data'] = $user->data;
        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->orderBy('kecamatan', 'ASC')->get()->getResult();
        $data['kelurahans'] = $this->_db->table('ref_kelurahan')->orderBy('kelurahan', 'ASC')->get()->getResult();
        $data['group_ppks'] = $this->_db->table('ref_kategori_ppks')->select("group_id, group_name")->groupBy('group_id')->orderBy('group_id', 'ASC')->get()->getResult();
        return view('silastri/peng/layanan/rpdk/add', $data);
    }

    public function addSave()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'nik' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nik boleh kosong. ',
                ]
            ],
            'nama_ppks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama ppks tidak boleh kosong. ',
                ]
            ],
            'tempat_lahir_ppks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tempat lahir ppks tidak boleh kosong. ',
                ]
            ],
            'tanggal_lahir_ppks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tanggal lahir ppks tidak boleh kosong. ',
                ]
            ],
            'nama_lembaga' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama lembaga tidak boleh kosong. ',
                ]
            ],
            'nama_pimpinan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama pimpinan tidak boleh kosong. ',
                ]
            ],
            'no_izin_lks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No Izin LKS tidak boleh kosong. ',
                ]
            ],
            'kecamatan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan tidak boleh kosong. ',
                ]
            ],
            'kelurahan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kelurahan tidak boleh kosong. ',
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong. ',
                ]
            ],
            'kategori_ppks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kategori ppks tidak boleh kosong. ',
                ]
            ],
        ];

        $filenamelampiranKtp = dot_array_search('_file_ktp.name', $_FILES);
        if ($filenamelampiranKtp != '') {
            $lampiranValKtp = [
                '_file_ktp' => [
                    'rules' => 'uploaded[_file_ktp]|max_size[_file_ktp,5120]|mime_in[_file_ktp,image/jpeg,image/jpg,image/png,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Pilih dokumen KTP terlebih dahulu. ',
                        'max_size' => 'Ukuran dokumen KTP terlalu besar. ',
                        'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar atau pdf. '
                    ]
                ],
            ];
            $rules = array_merge($rules, $lampiranValKtp);
        }

        $filenamelampiranKk = dot_array_search('_file_kk.name', $_FILES);
        if ($filenamelampiranKk != '') {
            $lampiranValKk = [
                '_file_kk' => [
                    'rules' => 'uploaded[_file_kk]|max_size[_file_kk,5120]|mime_in[_file_kk,image/jpeg,image/jpg,image/png,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Pilih dokumen KK terlebih dahulu. ',
                        'max_size' => 'Ukuran dokumen KK terlalu besar. ',
                        'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar atau pdf. '
                    ]
                ],
            ];
            $rules = array_merge($rules, $lampiranValKk);
        }

        $filenamelampiranPernyataan = dot_array_search('_file_sktm.name', $_FILES);
        if ($filenamelampiranPernyataan != '') {
            $lampiranValPernyataan = [
                '_file_sktm' => [
                    'rules' => 'uploaded[_file_sktm]|max_size[_file_sktm,5120]|mime_in[_file_sktm,image/jpeg,image/jpg,image/png,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Pilih dokumen SKTM terlebih dahulu. ',
                        'max_size' => 'Ukuran dokumen SKTM terlalu besar. ',
                        'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar atau pdf. '
                    ]
                ],
            ];
            $rules = array_merge($rules, $lampiranValPernyataan);
        }

        // $filenamelampiranFotoRumah = dot_array_search('_file_foto_rumah.name', $_FILES);
        // if ($filenamelampiranFotoRumah != '') {
        //     $lampiranValFotoRumah = [
        //         '_file_foto_rumah' => [
        //             'rules' => 'uploaded[_file_foto_rumah]|max_size[_file_foto_rumah,2048]|mime_in[_file_foto_rumah,image/jpeg,image/jpg,image/png,application/pdf]',
        //             'errors' => [
        //                 'uploaded' => 'Pilih dokumen foto rumah terlebih dahulu. ',
        //                 'max_size' => 'Ukuran dokumen foto rumah terlalu besar. ',
        //                 'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar atau pdf. '
        //             ]
        //         ],
        //     ];
        //     $rules = array_merge($rules, $lampiranValFotoRumah);
        // }

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('nama')
                . $this->validator->getError('nik')
                . $this->validator->getError('nama_ppks')
                . $this->validator->getError('tempat_lahir_ppks')
                . $this->validator->getError('tanggal_lahir_ppks')
                . $this->validator->getError('nama_lembaga')
                . $this->validator->getError('nama_pimpinan')
                . $this->validator->getError('no_izin_lks')
                . $this->validator->getError('kecamatan')
                . $this->validator->getError('kelurahan')
                . $this->validator->getError('alamat')
                . $this->validator->getError('kategori_ppks')
                . $this->validator->getError('_file_ktp')
                . $this->validator->getError('_file_kk')
                . $this->validator->getError('_file_sktm');
            // . $this->validator->getError('_file_foto_rumah');
            return json_encode($response);
        } else {
            $Profilelib = new Profilelib();
            $user = $Profilelib->user();
            if ($user->status != 200) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->status = 401;
                $response->message = "Permintaan diizinkan";
                return json_encode($response);
            }

            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $nik = htmlspecialchars($this->request->getVar('nik'), true);
            $nama_ppks = htmlspecialchars($this->request->getVar('nama_ppks'), true);
            $tempat_lahir_ppks = (int)htmlspecialchars($this->request->getVar('tempat_lahir_ppks'), true);
            $tanggal_lahir_ppks = (int)htmlspecialchars($this->request->getVar('tanggal_lahir_ppks'), true);
            $nama_lembaga = (int)htmlspecialchars($this->request->getVar('nama_lembaga'), true);
            $nama_pimpinan = (int)htmlspecialchars($this->request->getVar('nama_pimpinan'), true);
            $no_izin_lks = (int)htmlspecialchars($this->request->getVar('no_izin_lks'), true);
            $kecamatan = (int)htmlspecialchars($this->request->getVar('kecamatan'), true);
            $kelurahan = (int)htmlspecialchars($this->request->getVar('kelurahan'), true);
            $alamat = (int)htmlspecialchars($this->request->getVar('alamat'), true);
            $kategori_ppks = (int)htmlspecialchars($this->request->getVar('kategori_ppks'), true);

            $field_tambahan = [
                'nama_ppks' => $nama_ppks,
                'tempat_lahir_ppks' => $tempat_lahir_ppks,
                'tanggal_lahir_ppks' => $tanggal_lahir_ppks,
                'nama_lembaga' => $nama_lembaga,
                'nama_pimpinan' => $nama_pimpinan,
                'no_izin_lks' => $no_izin_lks,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'alamat' => $alamat,
                'kategori_ppks' => $kategori_ppks,
            ];

            // $skor = (($indikator1 + $indikator2 + $indikator3 + $indikator4 + $indikator5 + $indikator6) / 16) * 100;
            $uuidLib = new Uuid();

            $kodeUsulan = "RPDK-" . $user->data->nik . '-' . time();

            $data = [
                'id' => $uuidLib->v4(),
                'kode_permohonan' => $kodeUsulan,
                'kelurahan' => $user->data->kelurahan,
                'ttd' => 'kadis',
                'nik' => $user->data->nik,
                'nama' => $user->data->fullname,
                'user_id' => $user->data->id,
                'jenis' => 'Rekomendasi Penerbitan Dokumen Kependudukan',
                'layanan' => "RPDK",
                'field_tambahan' => json_encode($field_tambahan),
                // 'indikator2' => $indikator2,
                // 'indikator3' => $indikator3,
                // 'indikator4' => $indikator4,
                // 'indikator5' => $indikator5,
                // 'indikator6' => $indikator6,
                // 'skor' => $skor,
                'status_permohonan' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $dir = FCPATH . "uploads/rpdk";

            $lampiranKtp = $this->request->getFile('_file_ktp');
            $filesNamelampiranKtp = $lampiranKtp->getName();
            $newNamelampiranKtp = _create_name_foto($filesNamelampiranKtp);

            if ($lampiranKtp->isValid() && !$lampiranKtp->hasMoved()) {
                $lampiranKtp->move($dir, $newNamelampiranKtp);
                $data['lampiran_ktp'] = $newNamelampiranKtp;
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengupload lampiran KTP.";
                return json_encode($response);
            }

            $lampiranKk = $this->request->getFile('_file_kk');
            $filesNamelampiranKk = $lampiranKk->getName();
            $newNamelampiranKk = _create_name_foto($filesNamelampiranKk);

            if ($lampiranKk->isValid() && !$lampiranKk->hasMoved()) {
                $lampiranKk->move($dir, $newNamelampiranKk);
                $data['lampiran_kk'] = $newNamelampiranKk;
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengupload lampiran KK.";
                return json_encode($response);
            }

            $lampiranPernyataan = $this->request->getFile('_file_sktm');
            $filesNamelampiranPernyataan = $lampiranPernyataan->getName();
            $newNamelampiranPernyataan = _create_name_foto($filesNamelampiranPernyataan);

            if ($lampiranPernyataan->isValid() && !$lampiranPernyataan->hasMoved()) {
                $lampiranPernyataan->move($dir, $newNamelampiranPernyataan);
                $data['lampiran_pernyataan'] = $newNamelampiranPernyataan;
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengupload lampiran Pernyataan.";
                return json_encode($response);
            }

            $lampiranFotoRumah = $this->request->getFile('_file_foto_rumah');
            $filesNamelampiranFotoRumah = $lampiranFotoRumah->getName();
            $newNamelampiranFotoRumah = _create_name_foto($filesNamelampiranFotoRumah);

            if ($lampiranFotoRumah->isValid() && !$lampiranFotoRumah->hasMoved()) {
                $lampiranFotoRumah->move($dir, $newNamelampiranFotoRumah);
                $data['lampiran_foto_rumah'] = $newNamelampiranFotoRumah;
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengupload lampiran Foto Rumah.";
                return json_encode($response);
            }

            $this->_db->transBegin();
            try {
                $this->_db->table('_permohonan_temp')->insert($data);
            } catch (\Exception $e) {
                unlink($dir . '/' . $newNamelampiranKtp);
                unlink($dir . '/' . $newNamelampiranKk);
                unlink($dir . '/' . $newNamelampiranPernyataan);
                unlink($dir . '/' . $newNamelampiranFotoRumah);
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal menyimpan permohonan baru.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {
                $this->_db->transCommit();
                $riwayatLib = new Riwayatpermohonanlib();
                try {
                    $riwayatLib->create($user->data->id, "Mengirim permohonan dengan kode antrian: " . $data['kode_permohonan'], "submit", "bx bx-send", "riwayat/detailpermohonan?token=" . $data['id'], $data['id']);
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permohonan Berhasil di Ajukan.";
                $response->redirect = base_url('silastri/peng/riwayat');
                return json_encode($response);
            } else {
                unlink($dir . '/' . $newNamelampiranKtp);
                unlink($dir . '/' . $newNamelampiranKk);
                unlink($dir . '/' . $newNamelampiranPernyataan);
                unlink($dir . '/' . $newNamelampiranFotoRumah);
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengajukan permohonan.";
                return json_encode($response);
            }
        }
    }


    public function getKelurahan()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('id');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);

            $kels = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $id)->orderBy('kelurahan', 'ASC')->get()->getResult();

            if (count($kels) > 0) {
                $x['kels'] = $kels;
                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = view('portal/ref_kelurahan', $x);
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }
        }
    }

    public function getKategoriPpks()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'group_id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Group Id tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('group_id');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('group_id'), true);

            $kategoris = $this->_db->table('ref_kategori_ppks')->where('group_id', $id)->orderBy('sub_jenis', 'ASC')->get()->getResult();

            if (count($kategoris) > 0) {
                $x['kategoris'] = $kategoris;
                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = $kategoris;
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }
        }
    }
}
