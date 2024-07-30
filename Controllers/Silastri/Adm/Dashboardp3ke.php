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

                $keluarga = $this->_db->table('ref_p3ke_keluarga a')
                    ->countAllResults();
                $individu = $this->_db->table('ref_p3ke_individu a')
                    ->countAllResults();
                $sudah_verval = $this->_db->table('ref_p3ke_individu a')
                    ->where("status_verval_individu != 'Belum Terverifikasi Pemda'")
                    ->countAllResults();
                $belum_verval = $this->_db->table('ref_p3ke_individu a')
                    ->where("status_verval_individu = 'Belum Terverifikasi Pemda'")
                    ->countAllResults();

                $detail = new \stdClass;
                $detail->total_keluarga = (int)$keluarga;
                $detail->total_individu = (int)$individu;
                $detail->total_sudah_verval = (int)$sudah_verval;
                $detail->total_belum_verval = (int)$belum_verval;

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
