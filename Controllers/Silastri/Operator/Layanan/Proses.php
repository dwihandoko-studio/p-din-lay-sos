<?php

namespace App\Controllers\Silastri\Operator\Layanan;

use App\Controllers\BaseController;
use App\Models\Silastri\Operator\Layanan\ProsesModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Libraries\Profilelib;
use App\Libraries\Apilib;
use App\Libraries\Helplib;
use App\Libraries\Silastri\Ttelib;
use App\Libraries\Uuid;

class Proses extends BaseController
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

    public function getAll()
    {
        $request = Services::request();
        $datamodel = new ProsesModel($request);

        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $layanans = getGrantedAccessLayanan($user->data->id);
        $lists = $datamodel->get_datatables($layanans);
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row[] = $no;
            $action = '<a href="./detail?token=' . $list->id_permohonan . '"><button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1">
                <i class="bx bxs-show font-size-16 align-middle"></i> DETAIL</button>
                </a>';
            $row[] = $action;
            $row[] = $list->layanan;
            $row[] = $list->kode_permohonan;
            $row[] = $list->nik;
            $row[] = str_replace('&#039;', "`", str_replace("'", "`", $list->nama));
            $row[] = $list->kk;
            $row[] = $list->jenis;

            $data[] = $row;
        }
        $output = [
            "draw" => $request->getPost('draw'),
            "recordsTotal" => $datamodel->count_all($layanans),
            "recordsFiltered" => $datamodel->count_filtered($layanans),
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function index()
    {
        return redirect()->to(base_url('silastri/operator/layanan/proses/data'));
    }

    public function data()
    {
        $data['title'] = 'Proses Permohonan Layanan';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;

        // $data['jeniss'] = ['Surat Keterangan DTKS untuk Pengajuan PIP', 'Surat Keterangan DTKS untuk Pendaftaran PPDB', 'Surat Keterangan DTKS untuk Pengajuan PLN', 'Lainnya'];

        return view('silastri/operator/layanan/proses/index', $data);
    }

    public function detail()
    {
        if ($this->request->getMethod() != 'get') {
            return view('404', ['error' => "Akses tidak diizinkan."]);
        }

        $data['title'] = 'Detail Proses Permohonan Layanan';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;

        $id = htmlspecialchars($this->request->getGet('token') ?? "", true);

        $current = $this->_db->table('_permohonan a')
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
            ->where("a.id = '$id' AND (a.status_permohonan = 1 OR a.status_permohonan = 2)")->get()->getRowObject();

        if ($current) {
            $data['data'] = $current;
            return view('silastri/operator/layanan/proses/detail-page', $data);
        } else {
            return view('404', ['error' => "Data tidak ditemukan."]);
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


    public function downloadtemp()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

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

        $currents = $this->_db->table('_permohonan a')
            ->select("b.*, a.id as id_permohonan, a.kode_permohonan, a.layanan, a.jenis, c.template, c.no_surat, c.nomor_sktm, c.tgl_sktm, d.kecamatan as nama_kecamatan_sktm, e.kelurahan as nama_kelurahan_sktm, f.kecamatan as nama_kecamatan, g.kelurahan as nama_kelurahan")
            ->join('_permohonan_doc c', 'a.id = c.id')
            ->join('_profil_users_tb b', 'a.user_id = b.id')
            ->join('ref_kecamatan d', 'c.kecamatan = d.id', 'LEFT')
            ->join('ref_kelurahan e', 'c.kelurahan = e.id', 'LEFT')
            ->join('ref_kecamatan f', 'b.kecamatan = d.id', 'LEFT')
            ->join('ref_kelurahan g', 'b.kelurahan = e.id', 'LEFT')
            ->where('a.id', $id)
            ->get()->getRowObject();
        if (!$currents) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Data tidak ditemukan.";
            return json_encode($response);
        }

        return $this->_download($currents);
        // }
    }

    private function _download($id)
    {
        $data = $this->_db->table('_permohonan a')
            ->select("b.*, a.id as id_permohonan, a.kode_permohonan, a.layanan, a.jenis, c.template, c.no_surat, c.nomor_sktm, c.tgl_sktm, d.kecamatan as nama_kecamatan_sktm, e.kelurahan as nama_kelurahan_sktm, f.kecamatan as nama_kecamatan, g.kelurahan as nama_kelurahan")
            ->join('_permohonan_doc c', 'a.id = c.id')
            ->join('_profil_users_tb b', 'a.user_id = b.id')
            ->join('ref_kecamatan d', 'c.kecamatan = d.id', 'LEFT')
            ->join('ref_kelurahan e', 'c.kelurahan = e.id', 'LEFT')
            ->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT')
            ->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT')
            ->where('a.id', $id)
            ->get()->getRowObject();

        if ($data) {
            $file = FCPATH . "upload/template/$data->template";
            $template_processor = new TemplateProcessor($file);
            $template_processor->setValue('NOMOR_SURAT', "008/E-LS.$data->no_surat/D.a.VII/2023");
            $template_processor->setValue('KELURAHAN_SKTM', $data->nama_kelurahan_sktm);
            $template_processor->setValue('KECAMATAN_SKTM', $data->nama_kecamatan_sktm);
            $template_processor->setValue('NOMOR_SKTM', $data->nomor_sktm);
            $template_processor->setValue('TGL_SKTM', tgl_indo($data->tgl_sktm));

            $template_processor->setValue('NAMA_PENGUSUL', $data->fullname);
            $template_processor->setValue('KK_PENGUSUL', $data->kk);
            $template_processor->setValue('NIK_PENGUSUL', $data->nik);
            $template_processor->setValue('TEMPAT_LAHIR_PENGUSUL', $data->tempat_lahir);
            $template_processor->setValue('TGL_LAHIR_PENGUSUL', tgl_indo($data->tgl_lahir));
            $template_processor->setValue('PEKERJAAN_PENGUSUL', $data->pekerjaan);
            $template_processor->setValue('ALAMAT_PENGUSUL', $data->alamat);
            $template_processor->setValue('KELURAHAN_PENGUSUL', $data->nama_kelurahan);
            $template_processor->setValue('KECAMATAN_PENGUSUL', $data->nama_kecamatan);
            $template_processor->setValue('TGL_KELUAR', tgl_indo(date('Y-m-d')));
            $template_processor->setValue('JABATAN_TTD', "Plt. Kepala Dinas Sosial");
            $template_processor->setValue('NAMA_KABUPATEN', "Kabupaten Lampung Tengah");
            $template_processor->setValue('NAMA_TTD', "ARI NUGRAHA MUKTI,S.STP.,M.M.");
            $template_processor->setValue('NIP_TTD', "NIP. 19860720 200501 1 004");

            $template_processor->setImageValue('BARCODE', array('path' => 'http://192.168.33.16:8020/generate?data=https://layanan.dinsos.lampungtengahkab.go.id/verifiqrcodev?token=' . $data->kode_permohonan, 'width' => 100, 'height' => 100, 'ratio' => false));
            // $template_processor->setImageValue('BARCODE', array('path' => 'https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=layanan.disdikbud.lampungtengahkab.go.id/verifiqrcodev?token=' . $ptks[0]->kode_verifikasi . '&choe=UTF-8', 'width' => 100, 'height' => 100, 'ratio' => false));

            $filed = FCPATH . "upload/generate/surat/word/" . $data->kode_permohonan . ".docx";

            $template_processor->saveAs($filed);

            sleep(3);

            $datas = [
                'nama_file' => $data->kode_permohonan . '.docx',
                'file_folder' => $filed,
            ];

            $urlConvert = getenv('beconvert.default.url');

            // $curlHandle = curl_init("http://192.168.33.30:1891/convert");
            $curlHandle = curl_init($urlConvert);
            curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, json_encode($datas));
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
                // 'X-API-TOKEN: ' . $apiToken,
                // 'Authorization: Bearer ' . $jwt,
                'Content-Type: application/json'
            ));
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, 120);
            curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 120);

            $send_data         = curl_exec($curlHandle);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                try {
                    unlink(FCPATH . "upload/generate/surat/word/" . $data->kode_permohonan . ".docx");
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengenerate dokumen.";
                return $response;
            }

            if ($result) {
                if ($result->status == 200) {
                    $response = new \stdClass;
                    $response->status = 200;
                    $response->redirrect = base_url('silastri/operator/layanan/approval');
                    $response->message = "Selesaikan Permohonan $data->fullname berhasil dilakukan. Tinggal menunggu TTE kadis.";
                    $response->result = $result;
                    $response->dir = FCPATH . "upload/generate/surat/pdf/" . $data->kode_permohonan . ".pdf";
                    $response->dir_temp = FCPATH . "upload/generate/surat/word/" . $data->kode_permohonan . ".docx";
                    $response->filename = $data->kode_permohonan . ".pdf";
                    return $response;
                } else {
                    try {
                        unlink(FCPATH . "upload/generate/surat/word/" . $data->kode_permohonan . ".docx");
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->message = $result->message;
                    // $response->message = "Gagal mengenerate dokumen.";
                    return $response;
                }
                // return $result;
            } else {
                try {
                    unlink(FCPATH . "upload/generate/surat/word/" . $data->kode_permohonan . ".docx");
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengenerate dokumen.";
                return $response;
            }

            // header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            // // header('Content-Type: application/pdf');
            // header('Content-Disposition: attachment; filename="' . basename($filed) . '"');
            // header('Content-Length: ' . filesize($filed));
            // readfile($filed);
            // exit;

            // return;
        } else {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Data tidak ditemukan.";
            return $response;
        }
    }
}
