<?php

namespace App\Controllers\Silastri\Peng\Permohonan;

use App\Controllers\BaseController;
use App\Models\Silastri\Peng\Permohonan\DitolakModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Libraries\Profilelib;
use App\Libraries\Apilib;
use App\Libraries\Helplib;
use App\Libraries\Silastri\Ttelib;
use App\Libraries\Uuid;
use Dompdf\Dompdf;

class Ditolak extends BaseController
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
        $datamodel = new DitolakModel($request);

        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $lists = $datamodel->get_datatables($user->data->id);
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row[] = $no;
            $action = '<a href="javascript:actionDetail(\'' . $list->id_permohonan . '\', \'' . $list->nik . '\', \'' . str_replace('&#039;', "`", str_replace("'", "`", $list->nama)) . '\');"><button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1">
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
            "recordsTotal" => $datamodel->count_all($user->data->id),
            "recordsFiltered" => $datamodel->count_filtered($user->data->id),
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function index()
    {
        return redirect()->to(base_url('silastri/peng/permohonan/ditolak/data'));
    }

    public function data()
    {
        $data['title'] = 'Permohonan Layanan Yang Ditolak';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;
        $data['layanans'] = $this->_db->table('ref_layanan')->where('layanan_status', 1)->get()->getResult();

        // $data['jeniss'] = ['Surat Keterangan DTKS untuk Pengajuan PIP', 'Surat Keterangan DTKS untuk Pendaftaran PPDB', 'Surat Keterangan DTKS untuk Pengajuan PLN', 'Lainnya'];

        return view('silastri/peng/permohonan/ditolak/index', $data);
    }

    public function detail()
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
            session()->destroy();
            delete_cookie('jwt');
            $response = new \stdClass;
            $response->status = 401;
            $response->message = "Session expired";
            return json_encode($response);
        }

        $rules = [
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
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
            $response->message = $this->validator->getError('id')
                . $this->validator->getError('nik')
                . $this->validator->getError('nama');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $nik = htmlspecialchars($this->request->getVar('nik'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);

            $current = $this->_db->table('_permohonan_tolak a')
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
                ->where("a.id = '$id'")->get()->getRowObject();

            if ($current) {
                $data['data'] = $current;
                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permintaan diizinkan";
                // $response->data = view('silastri/peng/permohonan/antrian/detail', $data);
                switch ($current->layanan) {
                    case 'LKS':
                        $data['lks'] = $this->_db->table('_permohonan_lksa')->where('id_permohonan', $current->id)->get()->getRowObject();
                        $response->data = view('silastri/peng/permohonan/ditolak/detail_lks', $data);
                        break;
                    case 'RPPBKKS':
                        $response->data = view('silastri/peng/permohonan/ditolak/detail_rppbkks', $data);
                        break;

                    default:
                        $response->data = view('silastri/peng/permohonan/ditolak/detail', $data);
                        break;
                }
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }
            // if ($current) {
            //     $data['data'] = $current;
            //     // return view('silastri/peng/permohonan/proses/detail', $data);
            //     switch ($current->layanan) {
            //         case 'LKS':
            //             $data['lks'] = $this->_db->table('_permohonan_lksa')->where('id_permohonan', $current->id)->get()->getRowObject();
            //             return view('silastri/peng/permohonan/proses/detail_lks', $data);
            //             break;

            //         default:
            //             return view('silastri/peng/permohonan/proses/detail', $data);
            //             break;
            //     }
            // } else {
            //     return view('404', ['error' => "Data tidak ditemukan."]);
            // }
        }
    }

    public function printPdf()
    {

        $id = htmlspecialchars($this->request->getGet('id'), true);

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
            ->where(['a.id' => $id])->get()->getRowObject();

        if ($current) {

            $dataFileGambar = file_get_contents(FCPATH . './favicon/android-icon-144x144.png');
            $base64 = "data:image/png;base64," . base64_encode($dataFileGambar);

            $qrCode = "data:image/png;base64," . base64_encode(file_get_contents('http://192.168.33.16:8020/generate?data=' . base_url() . '/verifiqrcode?token=' . $current->id));

            $html   =  '<html>
                        <head>
                            <link href="';
            $html   .=              base_url() . '/assets/css/bootstrap.min.css';
            $html   .=          '" rel="stylesheet">
                        </head>
                        <body>
                            <div class="container">
                                <div class="row">
                                    <table class="table table-responsive" style="border: none;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img class="image-responsive" width="110px" height="110px" src="';
            $html   .=                                      $base64;
            $html   .=                                  '"/>
                                                </td>
                                                <td>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td>
                                                    <h3 style="margin: 0rem;font-size: 16px; font-weight: 500;">PEMERINTAH KABUPATEN LAMPUNG TENGAH</h3>
                                                    <h3 style="margin: 0rem;font-size: 16px; font-weight: 500;">DINAS SOSIAL</h3>
                                                    <h3 style="margin: 0rem;font-size: 16px; font-weight: 500;">KABUPATEN LAMPUNG TENGAH</h3>
                                                    <h3 style="margin: 0rem;font-size: 16px; font-weight: 500;">Jl. Raya Padang Ratu No. 01 Komplek Perkantoran Pemerintah Daerah Gunung Sugih, Kabupaten Lampung Tengah Provinsi Lampung Kode Pos: 34161</h3>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div style="text-align: center;margin-top: 30px; border:1px solid black;">
                                        <h3 style="margin: 0rem;font-size: 14px;">KARTU TANDA DAFTAR LAYANAN</h3>
                                        <h3 style="margin: 0rem;font-size: 12px;">NOMOR : ';
            $html   .=                          $current->kode_permohonan;
            $html   .=                          '</h3>
                                    </div>
                                </div>
                                <div style="max-width: 100%; padding-left: 10px; padding-right: 8px;">
                                    <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                                        <tbody>
                                            <tr>
                                                <td width="35%" align="" style="padding-left: 10px;">Kode Permohonan</td>
                                                <td width="5%" align="center">:</td>
                                                <td width="60%" align="left">' . $current->kode_permohonan . '</td>
                                                <td rowspan="7" style="border: none" width="10%">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="" style="padding-left: 10px;">Nama Lengkap</td>
                                                <td align="center">:</td>
                                                <td align="left">' . str_replace('&#039;', "`", str_replace("'", "`", $current->nama)) . '</td>
                                            </tr>
                                            <tr>
                                                <td align="" style="padding-left: 10px;">NIK</td>
                                                <td align="center">:</td>
                                                <td align="left">' . $current->nik . '</td>
                                            </tr>
                                            <tr>
                                                <td align="" style="padding-left: 10px;">Tempat Lahir</td>
                                                <td align="center">:</td>
                                                <td align="left">' . $current->tempat_lahir . '</td>
                                            </tr>
                                            <tr>
                                                <td align="" style="padding-left: 10px;">Tanggal Lahir</td>
                                                <td align="center">:</td>
                                                <td align="left">' . tgl_indo2($current->tgl_lahir) . '</td>
                                            </tr>
                                            <tr>
                                                <td align="" style="padding-left: 10px;">Jenis Kelamin</td>
                                                <td align="center">:</td>
                                                <td align="left">';
            if ($current->jenis_kelamin == 'L') {
                $html .= "Laki-Laki";
            } else {
                $html .= "Perempuan";
            }
            $html .= '</td>
                                            </tr>
                                            <tr>
                                                <td align="" style="padding-left: 10px;">No Handphone</td>
                                                <td align="center">:</td>
                                                <td align="left">' . $current->no_hp . '</td>
                                            </tr>
                                            <tr>
                                                <td align="" style="padding-left: 10px;">Email</td>
                                                <td align="center">:</td>
                                                <td align="left">' . $current->email . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="max-width: 100%; padding-top: 5px; padding-left: 10px; padding-right: 8px;">
                                    <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                                        <tbody>
                                            <tr>
                                                <td colspan="5" align="left">&nbsp;&nbsp;&nbsp;<b>Daftar Layanan</b></td>
                                                <td rowspan="6" style="border: none" width="10%">
                                                    <img class="image-responsive" width="100px" height="100px" src="' . $qrCode . '"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="5%"></td>
                                                <td width="30%" align="">Kode Permohonan</td>
                                                <td width="5%" align="center">:</td>
                                                <td width="60%" align="left">
                                                    ' . $current->kode_permohonan . '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td align="">Nama Layanan</td>
                                                <td align="center">:</td>
                                                <td align="left">' . $current->layanan . '</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td align="">Jenis Layanan</td>
                                                <td align="center">:</td>
                                                <td align="left">' . $current->jenis . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </body>
                    </html>';

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'potrait');
            $dompdf->render();
            // $dompdf->output();
            // $m->addRaw($dompdf->output());
            // unset($dompdf);

            // $m->addRaw($dompdf1->output());

            $dir = FCPATH . "upload/generate/pendaftaran";
            $fileNya = $dir . '/' . $current->kode_permohonan . '.pdf';

            file_put_contents($fileNya, $dompdf->output());

            sleep(3);

            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($fileNya) . '"');
            header('Content-Length: ' . filesize($fileNya));
            readfile($fileNya);

            return;
            // return view('silastri/peng/permohonan/print', $data);
        } else {
            return view('404');
        }
    }
}
