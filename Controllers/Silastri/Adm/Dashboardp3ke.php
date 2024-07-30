<?php

namespace App\Controllers\Silastri\Adm;

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
        return view('silastri/adm/dashboardp3ke/index', $data);
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
}
