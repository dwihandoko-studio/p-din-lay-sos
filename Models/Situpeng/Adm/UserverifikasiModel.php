<?php

namespace App\Models\Situpeng\Adm;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class UserverifikasiModel extends Model
{
    protected $table = "v_user_pengawas a";
    protected $column_order = array(null, 'a.fullname', 'a.username', 'a.role_user', 'a.kecamatan', null);
    protected $column_search = array('a.fullname', 'a.username', 'a.no_hp');
    protected $order = array('a.fullname' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt = $this->db->table($this->table);
    }
    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->dt->select("a.*");
        // $this->dt->join('ref_kecamatan b', 'a.kecamatan = b.kode_kecamatan');
        // $this->dt->whereIn("a.role_user", [2, 3, 4]);
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $this->dt->select("a.*");
        // $this->dt->join('ref_kecamatan b', 'a.kecamatan = b.kode_kecamatan');
        // $this->dt->whereIn("a.role_user", [2, 3, 4]);
        $this->_get_datatables_query();

        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $this->dt->select("a.*");
        // $this->dt->join('ref_kecamatan b', 'a.kecamatan = b.kode_kecamatan');
        // $this->dt->whereIn("a.role_user", [2, 3, 4]);
        $this->_get_datatables_query();

        return $this->dt->countAllResults();
    }
}