<?php

namespace App\Controllers;

use App\Libraries\Tte\Bsrelib;

class Verifiqrcode extends BaseController
{
    private $_db;
    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function index()
    {
        $token = htmlspecialchars($this->request->getGet('token'), true);
        $dokumen = $this->_db->table('_permohonan')->where("id = '$token' OR kode_permohonan = '$token'")->get()->getRowObject();
        $data = [
            'title' => 'Verifi Dokumen PDF Dari QRCode'
        ];
        if ($dokumen) {
            $data['dokumen'] = $dokumen;
            return view('verifiqrcode/index', $data);
        } else {
            $dokumen = $this->_db->table('_permohonan_temp')->where("id = '$token' OR kode_permohonan = '$token'")->get()->getRowObject();
            if ($dokumen) {
                $data['dokumen'] = $dokumen;
                return view('verifiqrcode/index', $data);
            } else {
                if ($dokumen) {
                    $data['dokumen'] = $dokumen;
                    return view('verifiqrcode/index', $data);
                } else {
                    $dokumen = $this->_db->table('_permohonan_tolak')->where("id = '$token' OR kode_permohonan = '$token'")->get()->getRowObject();
                    if ($dokumen) {
                        $data['dokumen'] = $dokumen;
                        return view('verifiqrcode/index', $data);
                    } else {
                        return view('verifiqrcode/404', $data);
                    }
                }
            }
        }
    }

    public function validity()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $dokumen = $this->_db->table('_permohonan a')
                ->select("a.*, b.file_dokumen_tte")
                ->join('_file_tte b', 'a.id = b.id', 'LEFT')
                ->where('a.id', $id)->get()->getRowObject();

            if ($dokumen) {
                if ((int)$dokumen->status_permohonan == 5) {

                    $nameFile = time() . "-sudah-tte.pdf";

                    $pdf = fopen(FCPATH . "uploads/temp_validiti/" . $nameFile, 'w');
                    fwrite($pdf, $dokumen->file_dokumen_tte);
                    fclose($pdf);
                    // var_dump($nameFile);
                    // die;


                    $data = [
                        'signed_file' => new \CURLFile(FCPATH . "uploads/temp_validiti/" . $nameFile, 'application/pdf', $nameFile),
                        // 'linkQR' => "https://web.lampungtengahkab.go.id",
                        // 'imageTTD' => new \CURLFile('/www/wwwroot/tte.lampungtengahkab.go.id/dev/public/upload/imagette/' . $fileName, 'image/png',$fileName),
                        // 'imageTTD' => new \CURLFile('/www/wwwroot/tte.lampungtengahkab.go.id/dev/public/upload/imagette/' . $imageTte, 'image/jpeg', $imageTte),
                        // 'file' => 'file://' . realpath('./upload/dokumen/' . $dokumen->dokumen),
                        // 'imageTTD' => 'file://' . realpath('./upload/imagette/' . $imageTte),
                    ];

                    $bsreLib = new Bsrelib();

                    $data = $bsreLib->verifiPdf($data);
                    // var_dump($data);
                    // die;

                    switch ($http_code = $data->status) {

                        case "SUCCESS":  # OK
                            $response = new \stdClass;
                            $response->code = 200;
                            $response->message = $data->message;
                            $response->filename = $nameFile;
                            $xr['data'] = $data->data;
                            $xr['url'] = base_url('uploads/temp_validiti') . '/' . $nameFile;
                            $response->data = view('verifiqrcode/content_validation', $xr);
                            return json_encode($response);

                            break;
                        case "UNAUTHORIZED":
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = $data->message;
                            return json_encode($response);
                            break;
                        case "NOT_FOUND":
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Url tidak ditemukan.";
                            return json_encode($response);
                            break;
                        default:
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = $data->message;
                            return json_encode($response);
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 201;
                    $response->message = "Data ditemukan";
                    $response->redirrect = base_url() . '/verifiqrcode/detaillayanan?token=' . $id . '&layanan=' . $dokumen->layanan;
                    return json_encode($response);
                }
            } else {
                $dokumenAntrian = $this->_db->table('_permohonan_temp a')
                    ->select("a.*, 
                        b.nik as nik_pemohon, 
                        b.kk as kk, 
                        b.email as email, 
                        b.no_hp as no_hp, 
                        b.tempat_lahir, 
                        b.tgl_lahir, 
                        b.jenis_kelamin, 
                        b.alamat, 
                        c.id as id_kecamatan, 
                        c.kecamatan as nama_kecamatan, 
                        d.id as id_kelurahan, 
                        d.kelurahan as nama_kelurahan")
                    ->join('_profil_users_tb b', 'b.id = a.user_id')
                    ->join('ref_kecamatan c', 'c.id = b.kecamatan')
                    ->join('ref_kelurahan d', 'd.id = b.kelurahan')
                    ->where(['a.id' => $id])->get()->getRowObject();

                if ($dokumenAntrian) {
                    $response = new \stdClass;
                    $response->code = 201;
                    $response->message = "Data ditemukan";
                    $response->redirrect = base_url() . '/verifiqrcode/detaillayanan?token=' . $id . '&layanan=' . $dokumenAntrian->layanan;
                    return json_encode($response);
                } else {
                    $dokumenTolak = $this->_db->table('_permohonan_tolak a')
                        ->select("a.*, 
                            b.nik as nik_pemohon, 
                            b.kk as kk, 
                            b.email as email, 
                            b.no_hp as no_hp, 
                            b.tempat_lahir, 
                            b.tgl_lahir, 
                            b.jenis_kelamin, 
                            b.alamat, 
                            c.id as id_kecamatan, 
                            c.kecamatan as nama_kecamatan, 
                            d.id as id_kelurahan, 
                            d.kelurahan as nama_kelurahan")
                        ->join('_profil_users_tb b', 'b.id = a.user_id')
                        ->join('ref_kecamatan c', 'c.id = b.kecamatan')
                        ->join('ref_kelurahan d', 'd.id = b.kelurahan')
                        ->where(['a.id' => $id])->get()->getRowObject();
                    if ($dokumenTolak) {
                        $response = new \stdClass;
                        $response->code = 201;
                        $response->message = "Data ditemukan";
                        $response->redirrect = base_url() . '/verifiqrcode/detaillayanan?token=' . $id . '&layanan=' . $dokumenTolak->layanan;
                        return json_encode($response);
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Dokumen tidak ditemukan.";
                        return json_encode($response);
                    }
                }
            }
        }
    }

    public function detaillayanan()
    {
        $id = htmlspecialchars($this->request->getGet('token'), true);

        $dokumen = $this->_db->table('_permohonan a')
            ->select("a.*")
            ->where("a.id = '$id' OR a.kode_permohonan = '$id'")->get()->getRowObject();

        if ($dokumen) {
            $data['data'] = $dokumen;
            if ((int)$dokumen->status_permohonan === 1) {
                $data['status_permohonan'] = 'disposisi';
            } else if ((int)$dokumen->status_permohonan === 2) {
                $data['status_permohonan'] = 'proses';
            } else if ((int)$dokumen->status_permohonan === 5) {
                $data['status_permohonan'] = 'pengesahan';
                $fileSelesai = $this->_db->table('_file_tte')->where('id', $dokumen->id)->get()->getRowObject();
                if ($fileSelesai) {
                    $data['file_selesai'] = $fileSelesai;
                }
            } else {
                $data['status_permohonan'] = 'ditolak';
            }
            switch ($dokumen->layanan) {
                case 'LKS':
                    $data['lks'] = $this->_db->table('_permohonan_lksa')->where('id_permohonan', $dokumen->id)->get()->getRowObject();
                    return view('verifiqrcode/detail_layanan_lks', $data);
                    break;

                default:
                    return view('verifiqrcode/detail_layanan', $data);
                    break;
            }
        } else {
            $dokumenAntrian = $this->_db->table('_permohonan_temp a')
                ->select("a.*, 
                        b.nik as nik_pemohon, 
                        b.kk as kk, 
                        b.email as email, 
                        b.no_hp as no_hp, 
                        b.tempat_lahir, 
                        b.tgl_lahir, 
                        b.jenis_kelamin, 
                        b.alamat, 
                        c.id as id_kecamatan, 
                        c.kecamatan as nama_kecamatan, 
                        d.id as id_kelurahan, 
                        d.kelurahan as nama_kelurahan")
                ->join('_profil_users_tb b', 'b.id = a.user_id')
                ->join('ref_kecamatan c', 'c.id = b.kecamatan')
                ->join('ref_kelurahan d', 'd.id = b.kelurahan')
                ->where("a.id = '$id' OR a.kode_permohonan = '$id'")->get()->getRowObject();

            if ($dokumenAntrian) {
                $data['data'] = $dokumenAntrian;
                $data['status_permohonan'] = 'antrian';
                switch ($dokumenAntrian->layanan) {
                    case 'LKS':
                        $data['lks'] = $this->_db->table('_permohonan_lksa')->where('id_permohonan', $dokumenAntrian->id)->get()->getRowObject();
                        return view('verifiqrcode/detail_layanan_lks', $data);
                        break;

                    default:
                        return view('verifiqrcode/detail_layanan', $data);
                        break;
                }
            } else {
                $dokumenTolak = $this->_db->table('_permohonan_tolak a')
                    ->select("a.*, 
                            b.nik as nik_pemohon, 
                            b.kk as kk, 
                            b.email as email, 
                            b.no_hp as no_hp, 
                            b.tempat_lahir, 
                            b.tgl_lahir, 
                            b.jenis_kelamin, 
                            b.alamat, 
                            c.id as id_kecamatan, 
                            c.kecamatan as nama_kecamatan, 
                            d.id as id_kelurahan, 
                            d.kelurahan as nama_kelurahan")
                    ->join('_profil_users_tb b', 'b.id = a.user_id')
                    ->join('ref_kecamatan c', 'c.id = b.kecamatan')
                    ->join('ref_kelurahan d', 'd.id = b.kelurahan')
                    ->where("a.id = '$id' OR a.kode_permohonan = '$id'")->get()->getRowObject();
                if ($dokumenTolak) {
                    $data['data'] = $dokumenAntrian;
                    $data['status_permohonan'] = 'ditolak';
                    switch ($dokumenTolak->layanan) {
                        case 'LKS':
                            $data['lks'] = $this->_db->table('_permohonan_lksa')->where('id_permohonan', $dokumenTolak->id)->get()->getRowObject();
                            return view('verifiqrcode/detail_layanan_lks', $data);
                            break;

                        default:
                            return view('verifiqrcode/detail_layanan', $data);
                            break;
                    }
                } else {
                    return view('404');
                }
            }
        }
    }
}
