<?php

namespace App\Controllers\Silastri\Pengdat\Upload;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Silastri\Pengdat\Upload\DtksModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Libraries\Profilelib;
use App\Libraries\Apilib;
use App\Libraries\Helplib;
use App\Libraries\Uuid;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class Dtks extends BaseController
{
    use ResponseTrait;
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
        $datamodel = new DtksModel($request);

        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, new Key($token_jwt, 'HS256'));
                if ($decoded) {
                    $userId = $decoded->id;
                    $level = $decoded->level;
                } else {
                    $output = [
                        "draw" => $request->getPost('draw'),
                        "recordsTotal" => 0,
                        "recordsFiltered" => 0,
                        "data" => []
                    ];
                    echo json_encode($output);
                    return;
                }
            } catch (\Exception $e) {
                $output = [
                    "draw" => $request->getPost('draw'),
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => []
                ];
                echo json_encode($output);
                return;
            }
        }

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
                            <a class="dropdown-item" href="javascript:actionDetail(\'' . $list->id . '\', \'' . $list->filename . '\');"><i class="bx bxs-show font-size-16 align-middle"></i> &nbsp;Detail</a>
                            <a class="dropdown-item" href="javascript:actionHapus(\'' . $list->id . '\', \'' . $list->filename . '\');"><i class="bx bx-trash font-size-16 align-middle"></i> &nbsp;Delete</a>
                        </div>
                    </div>';
            $row[] = $action;
            // $row[] = str_replace('&#039;', "`", str_replace("'", "`", $list->nama));
            $row[] = $list->filename;
            $row[] = $list->jumlah;
            $row[] = $list->lolos;
            $row[] = $list->gagal;
            $row[] = $list->done;
            $row[] = $list->created_at;

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
        return redirect()->to(base_url('silastri/pengdat/upload/dtks/data'));
    }

    public function data()
    {
        $data['title'] = 'Upload Data DTKS';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;
        $data['data'] = $user->data;

        return view('silastri/pengdat/upload/dtks/index', $data);
    }

    public function upload()
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
            $response = new \stdClass;
            $response->status = 200;
            $response->message = "Permintaan diizinkan";
            $response->data = view('silastri/pengdat/upload/dtks/upload');
            return json_encode($response);
        }
    }

    public function uploadSave()
    {
        // Increase memory and execution time limits
        ini_set('memory_limit', '512M');
        set_time_limit(0);

        // Ensure the request method is POST
        if ($this->request->getMethod() != 'post') {
            return $this->respond(['status' => 400, 'message' => "Permintaan tidak diizinkan"], 400);
        }

        // File upload validation rules
        $rules = [
            '_file' => [
                'rules' => 'uploaded[_file]|max_size[_file,10240]|mime_in[_file,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv]',
                'errors' => [
                    'uploaded' => 'Pilih file terlebih dahulu.',
                    'max_size' => 'Ukuran file terlalu besar, maksimum 10Mb.',
                    'mime_in' => 'Ekstensi yang diperbolehkan hanya xls, xlsx, atau csv.',
                ]
            ],
        ];

        // Validate the uploaded file
        if (!$this->validate($rules)) {
            return $this->respond(['status' => 400, 'message' => $this->validator->getError('_file')], 400);
        }

        // Check user session (assuming $Profilelib is correctly instantiated elsewhere)
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return $this->respond(['status' => 401, 'message' => "Session expired"], 401);
        }

        // Handle file upload
        $lampiran = $this->request->getFile('_file');
        $extension = $lampiran->getClientExtension();
        $fileLocation = $lampiran->getTempName();

        // Determine the correct file reader
        if ($extension === 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ($extension === 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } elseif ($extension === 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            return $this->respond(['status' => 400, 'message' => "Format file tidak didukung."], 400);
        }

        // Load the file
        $spreadsheet = $reader->load($fileLocation);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Get existing NIKs from the database to avoid duplicates
        $existingniks = $this->_db->table('ref_dtks')->select('nik')->get()->getResultArray();
        $existingniks = array_column($existingniks, 'nik');

        // Initialize arrays for batch processing
        $dataToInsert = [];
        $dataToUpdate = [];

        // Start a database transaction
        $this->_db->transBegin();

        try {
            // Loop through the rows of the spreadsheet
            for ($row = 1; $row <= $highestRow; $row++) {
                $rowData = $sheet->rangeToArray("B{$row}:{$highestColumn}{$row}", null, true, true, true);
                $nik = $rowData[$row]['C'];

                // Prepare data for insert or update
                $data = [
                    'nik' => $nik,
                    'nama' => $rowData[$row]['D'],
                    'no_kk' => $rowData[$row]['B'],
                    'hubungan_keluarga' => $rowData[$row]['E'],
                    'alamat' => $rowData[$row]['F'],
                    'kampung' => $rowData[$row]['G'],
                    'kecamatan' => $rowData[$row]['H'],
                    'sembako' => $rowData[$row]['I'],
                    'pkh' => $rowData[$row]['J'],
                    'pbi' => $rowData[$row]['K'],
                    'rst' => $rowData[$row]['L'],
                    'blt_elino' => $rowData[$row]['M'],
                    'blt_bbm' => $rowData[$row]['N'],
                    'sembako_adaptif' => $rowData[$row]['O'],
                    'blt_migor' => $rowData[$row]['P'],
                    'yatim_piatu' => $rowData[$row]['Q'],
                    'permakanan' => $rowData[$row]['R'],
                    'pena' => $rowData[$row]['S'],
                    'bpnt_ppkm' => $rowData[$row]['T'],
                    'bst' => $rowData[$row]['U'],
                    'atensi' => $rowData[$row]['V'],
                    'ket_meninggal' => $rowData[$row]['W'],
                    'ket_disabilitas' => $rowData[$row]['X'],
                    'keterangan' => $rowData[$row]['Y'],
                ];

                if (in_array($nik, $existingniks)) {
                    // Add to update batch
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    $dataToUpdate[] = $data;
                } else {
                    // Add to insert batch
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $dataToInsert[] = $data;
                }

                // Process in batches of 1000 rows
                if ($row % 1000 === 0) {
                    $this->_db->table('ref_dtks')->insertBatch($dataToInsert);
                    $this->_db->table('ref_dtks')->updateBatch($dataToUpdate, 'nik');
                    $dataToInsert = [];
                    $dataToUpdate = [];
                }
            }

            // Insert/update any remaining rows
            if (!empty($dataToInsert)) {
                $this->_db->table('ref_dtks')->insertBatch($dataToInsert);
            }
            if (!empty($dataToUpdate)) {
                $this->_db->table('ref_dtks')->updateBatch($dataToUpdate, 'nik');
            }

            // Commit the transaction
            $this->_db->transCommit();
        } catch (\Exception $e) {
            // Rollback the transaction on error
            $this->_db->transRollback();
            return $this->respond(['status' => 400, 'message' => "Gagal menyimpan data", 'error' => $e->getMessage()], 400);
        }

        // Handle file upload
        $dir = FCPATH . "upload/matching-dtks";
        $newNamelampiran = _create_name_file_import($lampiran->getName(), "PKH");

        if ($lampiran->isValid() && !$lampiran->hasMoved()) {
            $lampiran->move($dir, $newNamelampiran);
        } else {
            return $this->respond(['status' => 400, 'message' => "Gagal mengupload file."], 400);
        }

        // Save the matching file information
        $data = [
            'filename' => $newNamelampiran,
            'jumlah' => $highestRow,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->_db->table('tb_matching_dtks')->insert($data);

        return $this->respond(['status' => 200, 'message' => "Data berhasil disimpan."]);
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
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
            'filename' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Filename tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('id')
                . $this->validator->getError('filename');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $filename = htmlspecialchars($this->request->getVar('filename'), true);

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

            $current = $this->_db->table('tb_matching_dtks')
                ->where('id', $id)
                ->get()->getRowObject();

            if ($current) {

                $this->_db->transBegin();
                try {
                    $this->_db->table('tb_matching_dtks')->where('id', $current->id)->delete();
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->error = var_dump($th);
                    $response->message = "Data matching gagal dihapus.";
                    return json_encode($response);
                }

                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    try {
                        $file = $current->filename;
                        unlink(FCPATH . "upload/matching-dtks/$file");
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    $response = new \stdClass;
                    $response->status = 200;
                    $response->message = "Data matching berhasil dihapus.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->message = "Data matching gagal dihapus.";
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
}
