<?php

namespace App\Controllers\Silastri\Pengdat;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Helplib;

class Dashboardp3ke extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $_helpLib;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->_helpLib = new Helplib();
    }

    public function index()
    {
        return redirect()->to(base_url('silastri/adm/dashboardp3ke/data'));
    }

    public function data()
    {

        $Profilelib = new Profilelib();
        $user = $Profilelib->user();

        if (!$user || $user->status !== 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;
        $data['title'] = 'Dashboard';
        return view('silastri/pengdat/dashboardp3ke/index', $data);
    }

    public function statistik()
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

                $result = $this->_db->table('ref_p3ke_individu a')
                    ->select("
        COUNT(DISTINCT id_keluarga) as total_keluarga,
        COUNT(*) as total_individu,
        SUM(CASE WHEN status_verval_individu != 'Belum Terverifikasi Pemda' THEN 1 ELSE 0 END) as total_sudah_verval,
        SUM(CASE WHEN status_verval_individu = 'Belum Terverifikasi Pemda' THEN 1 ELSE 0 END) as total_belum_verval
    ")
                    ->get()
                    ->getRow();

                // Menyimpan hasil ke dalam objek detail
                $detail = new \stdClass;
                $detail->total_keluarga = (int)$result->total_keluarga;
                $detail->total_individu = (int)$result->total_individu;
                $detail->total_sudah_verval = (int)$result->total_sudah_verval;
                $detail->total_belum_verval = (int)$result->total_belum_verval;

                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = $detail;
                return json_encode($response);
            }
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function detailStatistik()
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

                $id = htmlspecialchars($this->request->getVar('id'), true);

                switch ($id) {
                    case 'rekap_p3ke_perkecamatan':
                        $result = $this->_db->table('ref_p3ke_individu a')
                            ->select("kecamatan, count(id_kecamatan) as jumlah_perkecamatan")
                            ->groupBy('id_kecamatan')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah_perkecamatan;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_kecamatan', $x);
                        return json_encode($response);
                        break;
                    case 'rekap_p3ke_verval':
                        $result = $this->_db->table('ref_p3ke_individu a')
                            ->select("status_verval_individu, count(status_verval_individu) as jumlah")
                            ->groupBy('status_verval_individu')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_verval', $x);
                        return json_encode($response);
                        break;
                    case 'air_minum':
                        $result = $this->_db->table('ref_p3ke_keluarga a')
                            ->select("sumber_air_minum, count(sumber_air_minum) as jumlah")
                            ->groupBy('sumber_air_minum')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_airminum', $x);
                        return json_encode($response);
                        break;
                    case 'bahan_bakar_memasak':
                        $result = $this->_db->table('ref_p3ke_keluarga a')
                            ->select("bahan_bakar_memasak, count(bahan_bakar_memasak) as jumlah")
                            ->groupBy('bahan_bakar_memasak')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_bahan_bakar_memasak', $x);
                        return json_encode($response);
                        break;
                    case 'disabilitas':
                        $result = $this->_db->table('ref_p3ke_keluarga a')
                            ->select("bahan_bakar_memasak, count(bahan_bakar_memasak) as jumlah")
                            ->groupBy('bahan_bakar_memasak')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_disabilitas', $x);
                        return json_encode($response);
                        break;
                    case 'ijazah':
                        $result = $this->_db->table('ref_p3ke_individu a')
                            ->select("pendidikan, count(pendidikan) as jumlah")
                            ->groupBy('pendidikan')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_pendidikan', $x);
                        return json_encode($response);
                        break;
                    case 'jenis_dinding':
                        $result = $this->_db->table('ref_p3ke_keluarga a')
                            ->select("jenis_dinding, count(jenis_dinding) as jumlah")
                            ->groupBy('jenis_dinding')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_jenis_dinding', $x);
                        return json_encode($response);
                        break;
                    case 'kepemilikan_tempat':
                        $result = $this->_db->table('ref_p3ke_keluarga a')
                            ->select("kepemilikan_rumah, count(kepemilikan_rumah) as jumlah")
                            ->groupBy('kepemilikan_rumah')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_kepemilikan_tempat', $x);
                        return json_encode($response);
                        break;
                    case 'pekerjaan':
                        $result = $this->_db->table('ref_p3ke_individu a')
                            ->select("pekerjaan, count(pekerjaan) as jumlah")
                            ->groupBy('pekerjaan')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_pekerjaan', $x);
                        return json_encode($response);
                        break;
                    case 'resiko_stunting':
                        $result = $this->_db->table('ref_p3ke_keluarga a')
                            ->select("resiko_stunting, count(resiko_stunting) as jumlah")
                            ->groupBy('resiko_stunting')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_resiko_stunting', $x);
                        return json_encode($response);
                        break;
                    case 'status_perkawinan':
                        $result = $this->_db->table('ref_p3ke_individu a')
                            ->select("status_kawin, count(status_kawin) as jumlah")
                            ->groupBy('status_kawin')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_status_kawin', $x);
                        return json_encode($response);
                        break;
                    case 'sumber_penerangan':
                        $result = $this->_db->table('ref_p3ke_keluarga a')
                            ->select("sumber_penerangan, count(sumber_penerangan) as jumlah")
                            ->groupBy('sumber_penerangan')
                            ->get()
                            ->getResult();

                        $totalData = array_reduce($result, function ($carry, $item) {
                            return $carry + $item->jumlah;
                        }, 0);

                        $x['data'] = $result;
                        $x['total_data'] = $totalData;
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->message = "dikenali.";
                        $response->data = view('silastri/pengdat/dashboardp3ke/statistik_rekap_p3ke_sumber_penerangan', $x);
                        return json_encode($response);
                        break;

                    default:
                        $response = new \stdClass;
                        $response->status = 400;
                        $response->message = "Gagal id tidak dikenali.";
                        return json_encode($response);
                        break;
                }

                $result = $this->_db->table('ref_p3ke_individu a')
                    ->select("
        COUNT(DISTINCT id_keluarga) as total_keluarga,
        COUNT(*) as total_individu,
        SUM(CASE WHEN status_verval_individu != 'Belum Terverifikasi Pemda' THEN 1 ELSE 0 END) as total_sudah_verval,
        SUM(CASE WHEN status_verval_individu = 'Belum Terverifikasi Pemda' THEN 1 ELSE 0 END) as total_belum_verval
    ")
                    ->get()
                    ->getRow();

                // Menyimpan hasil ke dalam objek detail
                $detail = new \stdClass;
                $detail->total_keluarga = (int)$result->total_keluarga;
                $detail->total_individu = (int)$result->total_individu;
                $detail->total_sudah_verval = (int)$result->total_sudah_verval;
                $detail->total_belum_verval = (int)$result->total_belum_verval;

                $response = new \stdClass;
                $response->status = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = $detail;
                return json_encode($response);
            }
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
