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
}
