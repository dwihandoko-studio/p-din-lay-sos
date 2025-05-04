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

class Rppbkks extends BaseController
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

    // public function getAllPtk()
    // {
    //     $request = Services::request();
    //     $datamodel = new PtkModel($request);

    //     $jwt = get_cookie('jwt');
    //     $token_jwt = getenv('token_jwt.default.key');
    //     if ($jwt) {
    //         try {
    //             $decoded = JWT::decode($jwt, new Key($token_jwt, 'HS256'));
    //             if ($decoded) {
    //                 $userId = $decoded->id;
    //                 $level = $decoded->level;
    //             } else {
    //                 $output = [
    //                     "draw" => $request->getPost('draw'),
    //                     "recordsTotal" => 0,
    //                     "recordsFiltered" => 0,
    //                     "data" => []
    //                 ];
    //                 echo json_encode($output);
    //                 return;
    //             }
    //         } catch (\Exception $e) {
    //             $output = [
    //                 "draw" => $request->getPost('draw'),
    //                 "recordsTotal" => 0,
    //                 "recordsFiltered" => 0,
    //                 "data" => []
    //             ];
    //             echo json_encode($output);
    //             return;
    //         }
    //     }

    //     $lists = $datamodel->get_datatables();
    //     $data = [];
    //     $no = $request->getPost("start");
    //     foreach ($lists as $list) {
    //         $no++;
    //         $row = [];

    //         $row[] = $no;
    //         $action = '<div class="btn-group">
    //                     <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>
    //                     <div class="dropdown-menu" style="">
    //                         <a class="dropdown-item" href="javascript:actionDetail(\'' . $list->id . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama)) . '\');"><i class="bx bxs-show font-size-16 align-middle"></i> &nbsp;Detail</a>
    //                         <a class="dropdown-item" href="javascript:actionSync(\'' . $list->id . '\', \'' . $list->id_ptk . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama))  . '\', \'' . $list->nuptk  . '\', \'' . $list->npsn . '\');"><i class="bx bx-transfer-alt font-size-16 align-middle"></i> &nbsp;Tarik Data</a>
    //                         <a class="dropdown-item" href="javascript:actionHapus(\'' . $list->id . '\', \'' . $list->id_ptk . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama))  . '\', \'' . $list->nuptk  . '\', \'' . $list->npsn . '\');"><i class="bx bx-trash font-size-16 align-middle"></i> &nbsp;Ajukan Hapus Data</a>
    //                     </div>
    //                 </div>';
    //         // $action = '<a href="javascript:actionDetail(\'' . $list->id . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama)) . '\');"><button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1">
    //         //     <i class="bx bxs-show font-size-16 align-middle"></i></button>
    //         //     </a>
    //         //     <a href="javascript:actionSync(\'' . $list->id . '\', \'' . $list->id_ptk . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama))  . '\', \'' . $list->nuptk  . '\', \'' . $list->npsn . '\');"><button type="button" class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1">
    //         //     <i class="bx bx-transfer-alt font-size-16 align-middle"></i></button>
    //         //     </a>
    //         //     <a href="javascript:actionHapus(\'' . $list->id . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama))  . '\', \'' . $list->nuptk . '\');" class="delete" id="delete"><button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light mr-2 mb-1">
    //         //     <i class="bx bx-trash font-size-16 align-middle"></i></button>
    //         //     </a>';
    //         $row[] = $action;
    //         $row[] = $list->nama;
    //         $row[] = $list->nik;
    //         $row[] = $list->nip;
    //         $row[] = $list->nuptk;
    //         $row[] = $list->jenis_ptk;
    //         $row[] = $list->last_sync;

    //         $data[] = $row;
    //     }
    //     $output = [
    //         "draw" => $request->getPost('draw'),
    //         "recordsTotal" => $datamodel->count_all(),
    //         "recordsFiltered" => $datamodel->count_filtered(),
    //         "data" => $data
    //     ];
    //     echo json_encode($output);
    // }

    // public function getAll()
    // {
    //     $request = Services::request();
    //     $datamodel = new SekolahModel($request);

    //     $jwt = get_cookie('jwt');
    //     $token_jwt = getenv('token_jwt.default.key');
    //     if ($jwt) {
    //         try {
    //             $decoded = JWT::decode($jwt, new Key($token_jwt, 'HS256'));
    //             if ($decoded) {
    //                 $userId = $decoded->id;
    //                 $level = $decoded->level;
    //             } else {
    //                 $output = [
    //                     "draw" => $request->getPost('draw'),
    //                     "recordsTotal" => 0,
    //                     "recordsFiltered" => 0,
    //                     "data" => []
    //                 ];
    //                 echo json_encode($output);
    //                 return;
    //             }
    //         } catch (\Exception $e) {
    //             $output = [
    //                 "draw" => $request->getPost('draw'),
    //                 "recordsTotal" => 0,
    //                 "recordsFiltered" => 0,
    //                 "data" => []
    //             ];
    //             echo json_encode($output);
    //             return;
    //         }
    //     }

    //     $npsns = $this->_helpLib->getSekolahNaungan($userId);

    //     $lists = $datamodel->get_datatables($npsns);
    //     $data = [];
    //     $no = $request->getPost("start");
    //     foreach ($lists as $list) {
    //         $no++;
    //         $row = [];

    //         $row[] = $no;

    //         $action = '<a href="./sekolah?n=' . $list->id . '"><button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1">
    //             <i class="bx bxs-show font-size-16 align-middle"> Detail</i></button>
    //             </a>';
    //         $row[] = $action;
    //         $row[] = $list->nama;
    //         $row[] = $list->npsn;
    //         $row[] = $list->bentuk_pendidikan;
    //         $row[] = $list->status_sekolah;
    //         $row[] = $list->kecamatan;

    //         $data[] = $row;
    //     }
    //     $output = [
    //         "draw" => $request->getPost('draw'),
    //         "recordsTotal" => $datamodel->count_all($npsns),
    //         "recordsFiltered" => $datamodel->count_filtered($npsns),
    //         "data" => $data
    //     ];
    //     echo json_encode($output);
    // }

    public function index()
    {
        return redirect()->to(base_url('silastri/peng/layanan/rppbkks/add'));
    }

    public function add()
    {
        $data['title'] = 'Rekomendasi PPBKKS';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;
        $data['data'] = $user->data;

        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->orderBy('kecamatan', 'asc')->get()->getResult();

        $data['jeniss'] = ['Meninggal', 'Merantau'];

        return view('silastri/peng/layanan/rppbkks/add', $data);
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
                    'required' => 'Nama pemohon tidak boleh kosong. ',
                ]
            ],
            'nik' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nik pemohon tidak boleh kosong. ',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nohp pemohon tidak boleh kosong. ',
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Alamat pemohon tidak boleh kosong. ',
                ]
            ],
            'kecamatan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan pemohon tidak boleh kosong. ',
                ]
            ],
            'kelurahan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kelurahan pemohon tidak boleh kosong. ',
                ]
            ],
            'nama_ahli_waris' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama yang diadukan tidak boleh kosong. ',
                ]
            ],
            'nik_ahli_waris' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nik yang diadukan tidak boleh kosong. ',
                ]
            ],
            'nohp_ahli_waris' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nohp yang diadukan tidak boleh kosong. ',
                ]
            ],
            'alamat_ahli_waris' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Alamat yang diadukan tidak boleh kosong. ',
                ]
            ],
            'kecamatan_ahli_waris' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan yang diadukan tidak boleh kosong. ',
                ]
            ],
            'kelurahan_ahli_waris' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kelurahan yang diadukan tidak boleh kosong. ',
                ]
            ],
            'identitas_ahli_waris' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Identitas ahli waris tidak boleh kosong. ',
                ]
            ],
            '_file_screenshoot' => [
                'rules' => 'uploaded[_file_screenshoot]|max_size[_file_screenshoot,5120]|mime_in[_file_screenshoot,image/jpeg,image/jpg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => 'Pilih dokumen Screenshoot terlebih dahulu. ',
                    'max_size' => 'Ukuran dokumen Screenshoot terlalu besar. ',
                    'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar atau pdf. '
                ]
            ],
            '_file_ktp' => [
                'rules' => 'uploaded[_file_ktp]|max_size[_file_ktp,5120]|mime_in[_file_ktp,image/jpeg,image/jpg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => 'Pilih dokumen KTP terlebih dahulu. ',
                    'max_size' => 'Ukuran dokumen KTP terlalu besar. ',
                    'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar atau pdf. '
                ]
            ],
            '_file_kk' => [
                'rules' => 'uploaded[_file_kk]|max_size[_file_kk,5120]|mime_in[_file_kk,image/jpeg,image/jpg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => 'Pilih dokumen KK terlebih dahulu. ',
                    'max_size' => 'Ukuran dokumen KK terlalu besar. ',
                    'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar atau pdf. '
                ]
            ],
        ];

        $filenamelampiranSurat = dot_array_search('_file_surat.name', $_FILES);
        if ($filenamelampiranSurat != '') {
            $lampiranValSurat = [
                '_file_surat' => [
                    'rules' => 'uploaded[_file_surat]|max_size[_file_surat,5120]|mime_in[_file_surat,image/jpeg,image/jpg,image/png,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Pilih dokumen Surat Keterangan terlebih dahulu. ',
                        'max_size' => 'Ukuran dokumen Surat Keterangan terlalu besar. ',
                        'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar atau pdf. '
                    ]
                ],
            ];
            $rules = array_merge($rules, $lampiranValSurat);
        }

        $identitas_ahli_waris = htmlspecialchars($this->request->getVar('identitas_ahli_waris'), true);

        if ($identitas_ahli_waris == "beda") {
            $tambahanFieldAhliWaris = [
                'hubungan_ahli_waris' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Hubungan ahli waris tidak boleh kosong. ',
                    ]
                ],
                'tempat_lahir_ahli_waris' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Tempat lahir ahli waris tidak boleh kosong. ',
                    ]
                ],
                'tanggal_lahir_ahli_waris' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Tanggal lahir ahli waris tidak boleh kosong. ',
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Keterangan tidak boleh kosong. ',
                    ]
                ],
            ];
            $rules = array_merge($rules, $tambahanFieldAhliWaris);
        }


        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('nama')
                . $this->validator->getError('nik')
                . $this->validator->getError('nohp')
                . $this->validator->getError('alamat')
                . $this->validator->getError('kecamatan')
                . $this->validator->getError('kelurahan')
                . $this->validator->getError('nama_ahli_waris')
                . $this->validator->getError('nik_ahli_waris')
                . $this->validator->getError('nohp_ahli_waris')
                . $this->validator->getError('alamat_ahli_waris')
                . $this->validator->getError('kecamatan_ahli_waris')
                . $this->validator->getError('kelurahan_ahli_waris')
                . $this->validator->getError('hubungan_ahli_waris')
                . $this->validator->getError('tempat_lahir_ahli_waris')
                . $this->validator->getError('tanggal_lahir_ahli_waris')
                . $this->validator->getError('keterangan')
                . $this->validator->getError('identitas_ahli_waris')
                . $this->validator->getError('_file_ktp')
                . $this->validator->getError('_file_kk')
                . $this->validator->getError('_file_screenshoot');
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

            if ($identitas_ahli_waris === "beda") {
                $keterangan = htmlspecialchars($this->request->getVar('keterangan'), true);
                $nama_ahli_waris = htmlspecialchars($this->request->getVar('nama_ahli_waris'), true);
                $nik_ahli_waris = htmlspecialchars($this->request->getVar('nik_ahli_waris'), true);
                $tempat_lahir_ahli_waris = htmlspecialchars($this->request->getVar('tempat_lahir_ahli_waris'), true);
                $tanggal_lahir_ahli_waris = htmlspecialchars($this->request->getVar('tanggal_lahir_ahli_waris'), true);
                $hubungan_ahli_waris = htmlspecialchars($this->request->getVar('hubungan_ahli_waris'), true);
                $alamat_ahli_waris = htmlspecialchars($this->request->getVar('alamat_ahli_waris'), true);
                $kecamatan_ahli_waris = htmlspecialchars($this->request->getVar('kecamatan_ahli_waris'), true);
                $kelurahan_ahli_waris = htmlspecialchars($this->request->getVar('kelurahan_ahli_waris'), true);
                $nohp_ahli_waris = htmlspecialchars($this->request->getVar('nohp_ahli_waris'), true);

                $field_tambahan = [
                    'nama_pemohon' => $user->data->fullname,
                    'nik_pemohon' => $user->data->nik,
                    'kk_pemohon' => $user->data->kk,
                    'tempat_lahir_pemohon' => $user->data->tempat_lahir,
                    'tgl_lahir_pemohon' => $user->data->tgl_lahir,
                    'kelurahan_pemohon' => $user->data->kelurahan,
                    'kecamatan_pemohon' => $user->data->kecamatan,
                    'alamat_pemohon' => $user->data->alamat,
                    'nama_ahli_waris' => $nama_ahli_waris,
                    'nik_ahli_waris' => $nik_ahli_waris,
                    'kk_ahli_waris' => $user->data->kk,
                    'tempat_lahir_ahli_waris' => $tempat_lahir_ahli_waris,
                    'tgl_lahir_ahli_waris' => $tanggal_lahir_ahli_waris,
                    'hubungan_ahli_waris' => $hubungan_ahli_waris,
                    'kelurahan_ahli_waris' => $kelurahan_ahli_waris,
                    'kecamatan_ahli_waris' => $kecamatan_ahli_waris,
                    'alamat_ahli_waris' => $alamat_ahli_waris,
                    'identitas_ahli_waris' => $identitas_ahli_waris,
                    'keterangan' => $keterangan,
                ];
            } else {
                $field_tambahan = [
                    'nama_pemohon' => $user->data->fullname,
                    'nik_pemohon' => $user->data->nik,
                    'kk_pemohon' => $user->data->kk,
                    'tempat_lahir_pemohon' => $user->data->tempat_lahir,
                    'tgl_lahir_pemohon' => $user->data->tgl_lahir,
                    'kelurahan_pemohon' => $user->data->kelurahan,
                    'kecamatan_pemohon' => $user->data->kecamatan,
                    'alamat_pemohon' => $user->data->alamat,
                    'identitas_ahli_waris' => $identitas_ahli_waris,
                ];
            }


            // $skor = (($indikator1 + $indikator2 + $indikator3 + $indikator4 + $indikator5 + $indikator6) / 16) * 100;
            $uuidLib = new Uuid();

            $kodeUsulan = "RPPBKKS-" . $user->data->nik . '-' . time();

            $data = [
                'id' => $uuidLib->v4(),
                'kode_permohonan' => $kodeUsulan,
                'kelurahan' => $user->data->kelurahan,
                'ttd' => 'kadis',
                'nik' => $user->data->nik,
                'nama' => $user->data->fullname,
                'user_id' => $user->data->id,
                'jenis' => "Rekomendasi Permohonan Penerbitan Buku Rekening dan Kartu Keluarga Sejahtera",
                'layanan' => "RPPBKKS",
                'status_permohonan' => 0,
                'field_tambahan' => json_encode($field_tambahan),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $dir = FCPATH . "uploads/rppbkks";

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

            $lampiranScreenshoot = $this->request->getFile('_file_screenshoot');
            $filesNamelampiranScreenshoot = $lampiranScreenshoot->getName();
            $newNamelampiranScreenshoot = _create_name_foto($filesNamelampiranScreenshoot);

            if ($lampiranScreenshoot->isValid() && !$lampiranScreenshoot->hasMoved()) {
                $lampiranScreenshoot->move($dir, $newNamelampiranScreenshoot);
                $data['lampiran_pernyataan'] = $newNamelampiranScreenshoot;
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengupload lampiran Screenshoot.";
                return json_encode($response);
            }

            if ($filenamelampiranSurat != '') {
                $lampiranSurat = $this->request->getFile('_file_surat');
                $filesNamelampiranSurat = $lampiranSurat->getName();
                $newNamelampiranSurat = _create_name_foto($filesNamelampiranSurat);

                if ($lampiranSurat->isValid() && !$lampiranSurat->hasMoved()) {
                    $lampiranSurat->move($dir, $newNamelampiranSurat);
                    $data['lampiran_foto_rumah'] = $newNamelampiranSurat;
                } else {
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->message = "Gagal mengupload lampiran Surat Keterangan.";
                    return json_encode($response);
                }
            }

            $this->_db->transBegin();
            try {
                $this->_db->table('_permohonan_temp')->insert($data);
            } catch (\Exception $e) {
                unlink($dir . '/' . $newNamelampiranKtp);
                unlink($dir . '/' . $newNamelampiranKk);
                unlink($dir . '/' . $newNamelampiranScreenshoot);
                if ($filenamelampiranSurat != '') {
                    unlink($dir . '/' . $newNamelampiranSurat);
                }
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
                unlink($dir . '/' . $newNamelampiranScreenshoot);
                if ($filenamelampiranSurat != '') {
                    unlink($dir . '/' . $newNamelampiranSurat);
                }
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
}
