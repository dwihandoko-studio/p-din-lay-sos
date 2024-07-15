<?php

namespace App\Controllers\Silastri\Su\Masterdata;

use App\Controllers\BaseController;
use App\Models\Silastri\Su\PadandtksModel;
use Config\Services;
use App\Libraries\Profilelib;
use App\Libraries\Apilib;
use App\Libraries\Uuid;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Padandtks extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function getAll()
    {
        $request = Services::request();
        $datamodel = new PadandtksModel($request);


        $lists = $datamodel->get_datatables();
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row[] = $no;

            $action = '<div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="javascript:actionDetail(\'' . $list->nik . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama_input)) . '\');"><i class="bx bxs-show font-size-16 align-middle"></i> &nbsp;Detail</a>
                                <a class="dropdown-item" href="javascript:actionEdit(\'' . $list->nik . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama_input))  . '\');"><i class="bx bx-shuffle font-size-16 align-middle"></i> &nbsp;Edit</a>
                                <a class="dropdown-item" href="javascript:actionHapus(\'' . $list->nik . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama_input))  . '\');"><i class="bx bx-trash font-size-16 align-middle"></i> &nbsp;Hapus</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>';
            $row[] = $action;
            $row[] = $list->nik;
            $row[] = $list->nama_input;
            $row[] = $list->nama_dtks;
            $row[] = $list->status_dtks;
            $row[] = $list->bansos;


            $data[] = $row;
        }
        $output = [
            "draw" => $request->getPost('draw'),
            "recordsTotal" => $datamodel->count_all(),
            "recordsFiltered" => $datamodel->count_filtered(),
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function index()
    {
        return redirect()->to(base_url('silastri/su/masterdata/padandtks/data'));
    }

    public function data()
    {
        $data['title'] = 'PADAN DTKS';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;

        return view('silastri/su/masterdata/padandtks/index', $data);
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

    public function detail()
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

            $current = $this->_db->table('_users_tb')
                ->where('uid', $id)->get()->getRowObject();

            if ($current) {
                $data['data'] = $current;
                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = view('silastri/su/masterdata/pengguna/detail', $data);
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }
        }
    }

    public function add()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'action' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('action');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('action'), true);

            $data['kecamatans'] = $this->_db->table('ref_kecamatan')->orderBy('kecamatan', 'asc')->get()->getResult();
            $response = new \stdClass;
            $response->status = 200;
            $response->message = "Permintaan diizinkan";
            $response->data = view('silastri/su/masterdata/peksos/add', $data);
            return json_encode($response);
        }
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
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong. ',
                ]
            ],
            'nip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIP tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'jabatan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jabatan tidak boleh kosong. ',
                ]
            ],
            'jenis' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jenis tidak boleh kosong. ',
                ]
            ],
            'email' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. ',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong. ',
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kecamatan tidak boleh kosong. ',
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelurahan tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('nip')
                . $this->validator->getError('nik')
                . $this->validator->getError('nama')
                . $this->validator->getError('jabatan')
                . $this->validator->getError('jenis')
                . $this->validator->getError('email')
                . $this->validator->getError('nohp')
                . $this->validator->getError('kecamatan')
                . $this->validator->getError('kelurahan');
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

            $nik = htmlspecialchars($this->request->getVar('nik'), true);
            $nip = htmlspecialchars($this->request->getVar('nip'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $jabatan = htmlspecialchars($this->request->getVar('jabatan'), true);
            $pangkat_golongan = htmlspecialchars($this->request->getVar('pangkat_golongan'), true);
            $jenis = htmlspecialchars($this->request->getVar('jenis'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
            $kecamatan = htmlspecialchars($this->request->getVar('kecamatan'), true);
            $kelurahan = htmlspecialchars($this->request->getVar('kelurahan'), true);

            $oldData =  $this->_db->table('ref_sdm')->where("nik = '$nik' OR nip = '$nip'")->get()->getRowObject();

            if ($oldData) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "NIP / NIK sudah terdaftar.";
                return json_encode($response);
            }

            // $uuidLib = new Uuid();

            $data = [
                'nik' => $nik,
                'nip' => $nip,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'pangkat_golongan' => $pangkat_golongan == "" || $pangkat_golongan == NULL ? NULL : $pangkat_golongan,
                'jenis' => $jenis,
                'kelurahan' => $kelurahan,
                'kecamatan' => $kecamatan,
                'email' => $email,
                'nohp' => $nohp,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->_db->transBegin();

            try {
                $this->_db->table('ref_sdm')->insert($data);
            } catch (\Exception $e) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal menyimpan data baru.";
                return json_encode($response);
            }
            if ($this->_db->affectedRows() > 0) {
                $this->_db->transCommit();
                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Data berhasil disimpan.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal menyimpan data baru";
                return json_encode($response);
            }
        }
    }

    public function edit()
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

            $current = $this->_db->table('v_user')
                ->where('id', $id)->get()->getRowObject();

            if ($current) {
                $data['data'] = $current;
                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = view('silastri/su/masterdata/pengguna/edit', $data);
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }
        }
    }

    public function editSave()
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
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'email' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. ',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong. ',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('nama')
                . $this->validator->getError('id')
                . $this->validator->getError('email')
                . $this->validator->getError('nohp')
                . $this->validator->getError('password');
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

            $id = htmlspecialchars($this->request->getVar('id'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
            $password = htmlspecialchars($this->request->getVar('password'), true);

            $oldData =  $this->_db->table('v_user')->where('id', $id)->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            if (
                $nama === $oldData->fullname
                && $email === $oldData->email
                && $nohp === $oldData->no_hp
            ) {
                $response = new \stdClass;
                $response->status = 201;
                $response->message = "Tidak ada perubahan data yang disimpan.";
                $response->redirect = base_url('silastri/su/masterdata/pengguna');
                return json_encode($response);
            }

            if ($email !== $oldData->email) {
                $cekData = $this->_db->table('v_user')->where(['email' => $email])->get()->getRowObject();
                if ($cekData) {
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->message = "Email sudah terdaftar pengguna lain.";
                    return json_encode($response);
                }
            }

            $dataProfil = [
                'email' => $email,
                'fullname' => $nama,
                'no_hp' => $nohp,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $data = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email_verified' => 0,
                'email_tertaut' => 0,
                'tautan_email' => NULL,
                'update_firs_login' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($nohp !== $oldData->no_hp) {
                $data['wa_verified'] = 0;
            }

            $this->_db->transBegin();
            try {
                $this->_db->table('_users_tb')->where('id', $oldData->id)->update($data);
            } catch (\Exception $e) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal menyimpan data baru.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {
                try {
                    $this->_db->table('_profil_users_tb')->where('id', $oldData->id)->update($dataProfil);
                } catch (\Exception $e) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->message = "Gagal menyimpan data baru.";
                    return json_encode($response);
                }
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    $response = new \stdClass;
                    $response->status = 200;
                    $response->message = "Data berhasil diupdate.";
                    $response->redirect = base_url('silastri/su/masterdata/pengguna');
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->message = "Gagal mengupate data";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengupate data";
                return json_encode($response);
            }
        }
    }

    public function delete()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'nip' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NIP tidak boleh kosong. ',
                ]
            ],
            'nik' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('nip')
                . $this->validator->getError('nik')
                . $this->validator->getError('nama');
            return json_encode($response);
        } else {
            $nip = htmlspecialchars($this->request->getVar('nip'), true);
            $nik = htmlspecialchars($this->request->getVar('nik'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);

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
            $current = $this->_db->table('ref_sdm')
                ->where('nik', $nik)->get()->getRowObject();

            if ($current) {
                $this->_db->transBegin();
                try {
                    $this->_db->table('ref_sdm')->where('nik', $nik)->delete();

                    if ($this->_db->affectedRows() > 0) {

                        $this->_db->transCommit();
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "Data berhasil dihapus.";
                        return json_encode($response);
                    } else {
                        $this->_db->transRollback();
                        $response = new \stdClass;
                        $response->status = 400;
                        $response->message = "Data gagal dihapus.";
                        return json_encode($response);
                    }
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->message = "Data gagal dihapus.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }
        }
    }

    public function upload()
    {
        if ($this->request->isAJAX()) {

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
                $Profilelib = new Profilelib();
                $user = $Profilelib->user();
                if ($user->status != 200) {
                    delete_cookie('jwt');
                    session()->destroy();
                    $response = new \stdClass;
                    $response->status = 401;
                    $response->message = "Session expired";
                    return json_encode($response);
                }
                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = view('su/masterdata/padandtks/import');
                return json_encode($response);
            }
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function saveupload()
    {
        if ($this->request->isAJAX()) {
            $Profilelib = new Profilelib();
            $user = $Profilelib->user();
            if ($user->status != 200) {
                delete_cookie('jwt');
                session()->destroy();
                return redirect()->to(base_url('auth'));
            }

            $jsonData = htmlspecialchars($this->request->getVar('data'), true);

            if ($jsonData === "") {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data yang diupload tidak valid.";
                return json_encode($response);
            }
            $formData = json_decode($jsonData, true);

            $jmlData = count($formData);

            if ($jmlData < 1) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data yang diupload tidak valid.";
                return json_encode($response);
            }

            $dataBerhasil = 0;
            $dataGagal = 0;
            $dataTidakDitemukan = 0;

            $uuidLib = new Uuid();

            $dataInserts = [];

            for ($i = 0; $i < $jmlData; $i++) {

                $nik = $formData[$i][0];
                $nama_input = $formData[$i][1];
                $nama_dtks = $formData[$i][2];
                $status_dtks = $formData[$i][3];
                $bansos = $formData[$i][4];

                if ($bansos === "" || $bansos === NULL) {
                    $bansosExplode = [];
                } else {
                    $bansosExplode = explode(",", $bansos);
                }

                $dataRow = [
                    'nik' => $nik,
                    'nama_input' => $nama_input,
                    'nama_dtks' => $nama_dtks,
                    'status_dtks' => $status_dtks,
                    'bansos' => json_encode($bansosExplode),
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $updated_at = date('Y-m-d H:i:s');

                $this->_db->transBegin();

                try {
                    $this->_db->query(
                        "INSERT INTO ref_padan_dtks (nik, nama_input, nama_dtks, status_dtks, bansos, created_at) VALUES (?,?,?,?,?,?) ON DUPLICATE KEY UPDATE nama_input = VALUES(nama_input), nama_dtks = VALUES(nama_dtks), status_dtks = VALUES(status_dtks), bansos = VALUES(bansos), updated_at = '$updated_at'",
                        [
                            $dataRow['nik'],
                            $dataRow['nama_input'],
                            $dataRow['nama_dtks'],
                            $dataRow['status_dtks'],
                            $dataRow['bansos'],
                            $dataRow['created_at']
                        ]
                    );
                    if ($this->_db->affectedRows() > 0) {

                        $this->_db->transCommit();
                        $dataBerhasil++;
                        continue;
                    } else {
                        $this->_db->transRollback();

                        $dataGagal++;
                        continue;
                    }
                } catch (\Throwable $th) {
                    $this->_db->transRollback();

                    $dataGagal++;
                    continue;
                }
            }

            $response = new \stdClass;
            $response->status = 200;
            $response->message = "Data berhasil diupload.";
            $response->sended_data = $jmlData;
            $response->upload_sukses = $dataBerhasil;
            $response->upload_gagal = $dataGagal;
            $response->upload_tidakditemukan = $dataTidakDitemukan;
            $response->data = "Jumlah data yang disimpan adalah Berhasil: $dataBerhasil, Gagal: $dataGagal, Sudah ada: $dataTidakDitemukan";
            return json_encode($response);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
