<?php

namespace App\Controllers;

use App\Libraries\tte\Bsrelib;

class Verifiqrcodev extends BaseController
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
        $dokumen = $this->_db->table('_permohonan')->where('id', $token)->get()->getRowObject();
        $data = [
            'title' => 'Verifi Dokumen PDF Dari QRCode'
        ];
        if ($dokumen) {
            $data['dokumen'] = $dokumen;
            return view('page/verifiqrcode/index', $data);
        } else {
            // $dokumen = $this->_db->table('_pengaduan')->where('id', $token)->get()->getRowObject();
            return view('page/verifiqrcode/404', $data);
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
                ->join('_file_tte b', 'a.id = b.id')
                ->where('a.id', $id)->get()->getRowObject();

            if (!$dokumen) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Dokumen tidak ditemukan.";
                return json_encode($response);
            }

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
                    $response->data = view('page/verifiqrcode/content_validation', $xr);
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
        }
    }
}
