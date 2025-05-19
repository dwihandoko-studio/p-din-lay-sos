<?php

namespace App\Controllers\Silastri\Adm\Layanan;

use App\Controllers\BaseController;
use App\Models\Silastri\Adm\Layanan\SelesaiModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Libraries\Profilelib;
use App\Libraries\Silastri\Apilib;
use App\Libraries\Helplib;
use App\Libraries\Silastri\Ttelib;
use App\Libraries\Uuid;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Selesai extends BaseController
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
        $datamodel = new SelesaiModel($request);

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
        return redirect()->to(base_url('silastri/adm/layanan/selesai/data'));
    }

    public function data()
    {
        $data['title'] = 'Selesai Permohonan Layanan';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('auth'));
        }

        $data['user'] = $user->data;
        $layanans = getGrantedAccessLayanan($user->data->id);
        $data['layanans'] = $layanans;
        // $data['layanans'] = $this->_db->table('_permohonan')->select("layanan, count(layanan) as jumlah")->where('status_permohonan', 5)->groupBy('layanan')->orderBy('layanan', 'ASC')->get()->getResult();

        // $data['jeniss'] = ['Surat Keterangan DTKS untuk Pengajuan PIP', 'Surat Keterangan DTKS untuk Pendaftaran PPDB', 'Surat Keterangan DTKS untuk Pengajuan PLN', 'Lainnya'];

        return view('silastri/adm/layanan/selesai/index', $data);
    }

    public function detail()
    {
        if ($this->request->getMethod() != 'get') {
            return view('404', ['error' => "Akses tidak diizinkan."]);
        }

        $data['title'] = 'Detail Selesai Permohonan Layanan';
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
                d.kelurahan as nama_kelurahan,
                e.file_dokumen_tte
                ")
            ->join('_profil_users_tb b', 'b.id = a.user_id')
            ->join('ref_kecamatan c', 'c.id = b.kecamatan')
            ->join('ref_kelurahan d', 'd.id = b.kelurahan')
            ->join('_file_tte e', 'e.id = a.id')
            ->where(['a.id' => $id, 'a.status_permohonan' => 5])->get()->getRowObject();

        if ($current) {
            $data['data'] = $current;
            return view('silastri/adm/layanan/selesai/detail-page', $data);
        } else {
            return view('404', ['error' => "Data tidak ditemukan."]);
        }
    }

    public function download()
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

            $Profilelib = new Profilelib();
            $user = $Profilelib->user();
            if ($user->status != 200) {
                delete_cookie('jwt');
                session()->destroy();
                return redirect()->to(base_url('auth'));
            }
            $kecamatan = $this->_helpLib->getKecamatan($user->data->id);

            $data['user'] = $user->data;
            $layanans = getGrantedAccessLayanan($user->data->id);
            $data['layanans'] = $layanans;

            $response = new \stdClass;
            $response->status = 200;
            $response->message = "Permintaan diizinkan";
            $response->data = view('silastri/adm/layanan/selesai/download', $data);
            return json_encode($response);
            // } else {
            //     $response = new \stdClass;
            //     $response->status = 400;
            //     $response->message = "Data tidak ditemukan";
            //     return json_encode($response);
            // }
        }
    }

    public function _aksidownloadold()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'tgl_awal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Awal tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Akhir tidak boleh kosong. ',
                ]
            ],
            'layanan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Layanan tidak boleh kosong. ',
                ]
            ],
            'type_file' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type file tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('tgl_awal')
                . $this->validator->getError('tgl_akhir')
                . $this->validator->getError('layanan')
                . $this->validator->getError('type_file');
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

            $tgl_awal = htmlspecialchars($this->request->getVar('tgl_awal'), true);
            $tgl_akhir = htmlspecialchars($this->request->getVar('tgl_akhir'), true);
            $layanan = htmlspecialchars($this->request->getVar('layanan'), true);
            $type_file = htmlspecialchars($this->request->getVar('type_file'), true);

            $apiLib = new Apilib();

            $result = $apiLib->downloadLaporanPbi($tgl_awal, $tgl_akhir, $layanan, $type_file);

            if ($result) {
                if ($result->status == 200) {
                    if (isset($result->data)) {
                        $response = new \stdClass;
                        $response->status = 200;
                        $response->data = $result;
                        $response->url = base_url() . "/uploads/api" . $result->data->url;
                        $response->message = "Download Data Berhasil Dilakukan.";
                        return json_encode($response);
                    } else {
                        $response = new \stdClass;
                        $response->status = 400;
                        $response->message = $result->message;
                        return json_encode($response);
                    }
                } else {
                    $response = new \stdClass;
                    $response->status = 400;
                    $response->error = $result;
                    $response->message = "Gagal Tarik Data.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal Tarik Data";
                return json_encode($response);
            }
        }
    }

    public function aksidownload()
    {
        // Check request method
        if ($this->request->getMethod() != 'post') {
            return $this->buildErrorResponse(400, "Permintaan tidak diizinkan");
        }

        // Validation rules
        $rules = [
            'tgl_awal' => [
                'rules' => 'required',
                'errors' => ['required' => 'Tanggal Awal tidak boleh kosong. ']
            ],
            'tgl_akhir' => [
                'rules' => 'required',
                'errors' => ['required' => 'Tanggal Akhir tidak boleh kosong. ']
            ],
            'layanan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Layanan tidak boleh kosong. ']
            ],
            'type_file' => [
                'rules' => 'required',
                'errors' => ['required' => 'Type file tidak boleh kosong. ']
            ],
        ];

        // Validate input
        if (!$this->validate($rules)) {
            $errorMessages = [
                $this->validator->getError('tgl_awal'),
                $this->validator->getError('tgl_akhir'),
                $this->validator->getError('layanan'),
                $this->validator->getError('type_file')
            ];
            return $this->buildErrorResponse(400, implode('', $errorMessages));
        }

        // Check user session
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return $this->buildErrorResponse(401, "Session expired");
        }

        // Sanitize input
        $tgl_awal = htmlspecialchars($this->request->getVar('tgl_awal'), true);
        $tgl_akhir = htmlspecialchars($this->request->getVar('tgl_akhir'), true);
        $layanan = htmlspecialchars($this->request->getVar('layanan'), true);
        $type_file = htmlspecialchars($this->request->getVar('type_file'), true);

        // Get data from database
        $datanya = $this->getLaporanData($tgl_awal, $tgl_akhir, $layanan);

        if (empty($datanya)) {
            return $this->buildErrorResponse(404, "Tidak ada data ditemukan untuk periode tersebut");
        }

        switch ($layanan) {
            case 'PBI':
                return $this->downloadPBI($datanya, $tgl_awal, $tgl_akhir, $layanan);

            default:
                return $this->buildErrorResponse(400, "Download pada layanan yang dipilih belum tersedia.");
        }
    }

    private function downloadPBI($datanya, $tgl_awal, $tgl_akhir, $layanan)
    {

        try {
            // Create Excel file
            $spreadsheet = $this->createExcelReportPBI($datanya, $tgl_awal, $tgl_akhir);

            // Save file
            $filename = 'LAPORAN_PBI_' . $tgl_awal . '_sd_' . $tgl_akhir . '.xlsx';
            $filepath = FCPATH . "uploads/laporan/" . $filename;

            // Ensure directory exists
            if (!is_dir(FCPATH . "uploads/laporan")) {
                mkdir(FCPATH . "uploads/laporan", 0777, true);
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save($filepath);

            // Build success response
            $dataResponse = new \stdClass();
            $dataResponse->url = '/uploads/laporan/' . $filename;

            $response = new \stdClass();
            $response->status = 200;
            $response->data = new \stdClass();
            $response->data->data = $dataResponse;
            $response->url = base_url() . "/uploads/laporan/" . $filename;
            $response->message = "Download Data Berhasil Dilakukan.";

            return $this->response->setJSON($response);
        } catch (\Throwable $th) {
            // Log the error for debugging
            log_message('error', 'Error generating Excel: ' . $th->getMessage());
            return $this->buildErrorResponse(500, "Terjadi kesalahan saat menghasilkan laporan");
        }
    }

    // Helper method to build error responses
    private function buildErrorResponse($status, $message)
    {
        $response = new \stdClass();
        $response->status = $status;
        $response->message = $message;
        return $this->response->setJSON($response);
    }

    // Helper method to get report data
    private function getLaporanData($tgl_awal, $tgl_akhir, $layanan)
    {
        $builder = $this->_db->table('_permohonan a');
        $builder->select("a.kode_permohonan, a.nik, UPPER(a.nama) as nama, a.jenis_kepesertaan, 
                     a.kode_faskes, UPPER(c.nama_faskes) as nama_faskes, b.kk, UPPER(b.tempat_lahir) as tempat_lahir, b.tgl_lahir, b.no_hp, 
                     b.jenis_kelamin, b.kecamatan as kode_kecamatan, UPPER(d.kecamatan) as nama_kecamatan, 
                     b.kelurahan as kode_kampung, UPPER(e.kelurahan) as nama_kampung, UPPER(b.alamat), b.rt, 
                     b.rw, b.kode_pos, b.pekerjaan, a.updated_at as tanggal_usulan, f.field_tambahan as ket_docs");
        $builder->join('_profil_users_tb b', 'a.user_id = b.id', 'left');
        $builder->join('ref_kecamatan d', 'b.kecamatan = d.id', 'left');
        $builder->join('ref_kelurahan e', 'b.kelurahan = e.id', 'left');
        $builder->join('ref_faskes c', 'a.kode_faskes = c.kode_faskes', 'left');
        $builder->join('_permohonan_doc f', 'f.id = a.id', 'left');
        $builder->where('a.status_permohonan', 5);
        $builder->where('a.layanan', strtoupper($layanan));
        $builder->where('a.updated_at >=', $tgl_awal);
        $builder->where('a.updated_at <=', $tgl_akhir);

        return $builder->get()->getResultArray();
    }

    // Helper method to create Excel report
    private function createExcelReportPBI($data, $tgl_awal, $tgl_akhir)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:V1');
        $sheet->setCellValue('A1', 'DATA USULAN CALON PENERIMA BANTUAN IURAN (PBI) APBD KABUPATEN LAMPUNG TENGAH');
        $sheet->mergeCells('A2:V2');
        $sheet->setCellValue('A2', 'PERIODE ' . $tgl_awal . ' s/d ' . $tgl_akhir);

        // Style untuk judul
        $titleStyle = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ];
        $sheet->getStyle('A1:V2')->applyFromArray($titleStyle);

        // Set header tabel
        $sheet->mergeCells('A5:A6');
        $sheet->setCellValue('A5', 'NO');
        $sheet->mergeCells('B5:B6');
        $sheet->setCellValue('B5', 'NOMOR KK');
        $sheet->mergeCells('C5:C6');
        $sheet->setCellValue('C5', 'NIK/KITAS/KITAP');
        $sheet->mergeCells('D5:D6');
        $sheet->setCellValue('D5', 'NAMA LENGKAP');

        $sheet->setCellValue('E5', 'PESERTA, SUAMI, ISTRI, ANAK, TAMBAHAN');
        $sheet->setCellValue('E6', '1=P, 2=S, 3=I, 4=A, 5=T');

        $sheet->mergeCells('F5:G5');
        $sheet->setCellValue('F5', 'DATA KELAHIRAN');
        $sheet->setCellValue('F6', 'TEMPAT LAHIR');
        $sheet->setCellValue('G6', 'TANGGAL LAHIR');

        $sheet->setCellValue('H5', 'JENIS KELAMIN');
        $sheet->setCellValue('H6', 'L/P');

        $sheet->setCellValue('I5', 'STATUS KAWIN');
        $sheet->setCellValue('I6', '1=B, 2=K, 3=C (1 BELUM KAWIN, 2 KAWIN, 3 CERAI)');

        $sheet->mergeCells('J5:J6');
        $sheet->setCellValue('J5', 'ALAMAT TEMPAT TINGGAL');
        $sheet->mergeCells('K5:K6');
        $sheet->setCellValue('K5', 'RT');
        $sheet->mergeCells('L5:L6');
        $sheet->setCellValue('L5', 'RW');
        $sheet->mergeCells('M5:M6');
        $sheet->setCellValue('M5', 'KODE POS');
        $sheet->mergeCells('N5:N6');
        $sheet->setCellValue('N5', 'KODE KECAMATAN');
        $sheet->mergeCells('O5:O6');
        $sheet->setCellValue('O5', 'NAMA KECAMATAN');
        $sheet->mergeCells('P5:P6');
        $sheet->setCellValue('P5', 'KODE KELURAHAN');
        $sheet->mergeCells('Q5:Q6');
        $sheet->setCellValue('Q5', 'NAMA KELURAHAN');
        $sheet->mergeCells('R5:R6');
        $sheet->setCellValue('R5', 'KODE FASKES TK.I');
        $sheet->mergeCells('S5:S6');
        $sheet->setCellValue('S5', 'NAMA FASKES TK.I');
        $sheet->mergeCells('T5:T6');
        $sheet->setCellValue('T5', 'TAMBAHAN KETERANGAN');
        $sheet->mergeCells('U5:U6');
        $sheet->setCellValue('U5', 'TANGGAL PENGUSULAN');
        $sheet->mergeCells('V5:V6');
        $sheet->setCellValue('V5', 'NO TELP.');

        // ... (lanjutkan untuk header lainnya sesuai kebutuhan)

        // Style untuk header
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFD9D9D9']
            ]
        ];
        $sheet->getStyle('A5:U6')->applyFromArray($headerStyle);

        // Isi data
        $row = 7;
        $no = 1;
        foreach ($data as $item) {

            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['kk'] ?? '');
            $sheet->setCellValue('C' . $row, $item['nik'] ?? '');
            $sheet->setCellValue('D' . $row, $item['nama'] ?? '');
            $sheet->setCellValue('E' . $row, $item['jenis_kepesertaan'] ?? '');
            $sheet->setCellValue('F' . $row, $item['tempat_lahir'] ?? '');
            $sheet->setCellValue('G' . $row, $item['tgl_lahir'] ?? '');
            $sheet->setCellValue('H' . $row, $item['jenis_kelamin'] ?? '');
            $sheet->setCellValue('I' . $row, $item['status_kawin'] ?? '');
            $sheet->setCellValue('J' . $row, $item['alamat'] ?? '');
            $sheet->setCellValue('K' . $row, $item['rt'] ?? '');
            $sheet->setCellValue('L' . $row, $item['rw'] ?? '');
            $sheet->setCellValue('M' . $row, $item['kode_pos'] ?? '');
            $sheet->setCellValue('N' . $row, $item['kode_kecamatan'] ?? '');
            $sheet->setCellValue('O' . $row, $item['nama_kecamatan'] ?? '');
            $sheet->setCellValue('P' . $row, $item['kode_kampung'] ?? '');
            $sheet->setCellValue('Q' . $row, $item['nama_kampung'] ?? '');
            $sheet->setCellValue('R' . $row, $item['kode_faskes'] ?? '');
            $sheet->setCellValue('S' . $row, $item['nama_faskes'] ?? '');
            if (isset($item['ket_docs'])) {
                $ketDocs = json_decode($item['ket_docs']);
                if (isset($ketDocs->keterangan_kesehatan)) {
                    $sheet->setCellValue('T' . $row, $ketDocs->keterangan_kesehatan ?? '');
                } else {
                    $sheet->setCellValue('T' . $row, $item['keterangan'] ?? '');
                }
            } else {
                $sheet->setCellValue('T' . $row, $item['keterangan'] ?? '');
            }
            $sheet->setCellValue('U' . $row, $item['tanggal_usulan'] ?? '');
            $sheet->setCellValue('V' . $row, $item['no_hp'] ?? '');

            $row++;
            $no++;
        }

        // Set lebar kolom
        $sheet->getColumnDimension('A')->setWidth(4);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(30);
        // ... (lanjutkan untuk kolom lainnya)

        // Set tinggi baris
        $sheet->getRowDimension(5)->setRowHeight(30);
        $sheet->getRowDimension(6)->setRowHeight(30);

        // Border untuk data
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ];
        $sheet->getStyle('A7:V' . ($row - 1))->applyFromArray($dataStyle);

        foreach (['B', 'C', 'K', 'L', 'N', 'P', 'R', 'V'] as $column) {
            for ($row = 7; $row <= $sheet->getHighestRow(); $row++) {
                $cell = $sheet->getCell($column . $row);
                $cell->setValueExplicit($cell->getValue(), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            }
        }

        foreach (range('A', 'V') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }


        // // Set report title
        // $sheet->mergeCells('A1:U1');
        // $sheet->setCellValue('A1', 'DATA USULAN CALON PENERIMA BANTUAN IURAN (PBI) APBD KABUPATEN LAMPUNG TENGAH');
        // $sheet->mergeCells('A2:U2');
        // $sheet->setCellValue('A2', 'PERIODE ' . $tgl_awal . ' s/d ' . $tgl_akhir);

        // // Title style
        // $titleStyle = [
        //     'font' => ['bold' => true],
        //     'alignment' => [
        //         'horizontal' => Alignment::HORIZONTAL_CENTER,
        //         'vertical' => Alignment::VERTICAL_CENTER
        //     ]
        // ];
        // $sheet->getStyle('A1:U2')->applyFromArray($titleStyle);

        // // Set table headers
        // $headers = [
        //     ['NO', 'Nomor KK', 'NIK/KITAS/KITAP', 'Nama Lengkap'],
        //     ['Peserta, Suami, Istri, Anak, Tambahan', '1=P, 2=S, 3=I, 4=A, 5=T'],
        //     ['Data Kelahiran', 'Tempat Lahir', 'Tanggal Lahir'],
        //     ['Jenis Kelamin', 'L/P'],
        //     ['Status Kawin', '1=B, 2=K, 3=C (1 Belum Kawin, 2 Kawin, 3 Cerai)'],
        //     ['Alamat Tempat Tinggal']
        //     // Add more headers as needed
        // ];

        // // Apply headers to cells (implementation depends on your exact header structure)
        // // ...

        // // Header style
        // $headerStyle = [
        //     'font' => ['bold' => true],
        //     'alignment' => [
        //         'horizontal' => Alignment::HORIZONTAL_CENTER,
        //         'vertical' => Alignment::VERTICAL_CENTER,
        //         'wrapText' => true
        //     ],
        //     'borders' => [
        //         'allBorders' => ['borderStyle' => Border::BORDER_THIN]
        //     ],
        //     'fill' => [
        //         'fillType' => Fill::FILL_SOLID,
        //         'startColor' => ['argb' => 'FFD9D9D9']
        //     ]
        // ];
        // $sheet->getStyle('A5:U6')->applyFromArray($headerStyle);

        // // Fill data rows
        // $row = 7;
        // foreach ($data as $index => $item) {
        //     $sheet->setCellValue('A' . $row, $index + 1);
        //     $sheet->setCellValue('B' . $row, $item['kk'] ?? '');
        //     $sheet->setCellValue('C' . $row, $item['nik'] ?? '');
        //     $sheet->setCellValue('D' . $row, $item['nama'] ?? '');
        //     // Fill more cells as needed
        //     $row++;
        // }

        // // Set column widths
        // $sheet->getColumnDimension('A')->setWidth(4);
        // $sheet->getColumnDimension('B')->setWidth(20);
        // $sheet->getColumnDimension('C')->setWidth(20);
        // $sheet->getColumnDimension('D')->setWidth(30);
        // // Set more column widths as needed

        // // Set row heights
        // $sheet->getRowDimension(5)->setRowHeight(30);
        // $sheet->getRowDimension(6)->setRowHeight(30);

        // // Data style
        // $dataStyle = [
        //     'borders' => [
        //         'allBorders' => ['borderStyle' => Border::BORDER_THIN]
        //     ],
        //     'alignment' => [
        //         'vertical' => Alignment::VERTICAL_CENTER
        //     ]
        // ];
        // $sheet->getStyle('A7:U' . ($row - 1))->applyFromArray($dataStyle);

        return $spreadsheet;
    }

    // public function aksidownload()
    // {
    //     if ($this->request->getMethod() != 'post') {
    //         $response = new \stdClass;
    //         $response->status = 400;
    //         $response->message = "Permintaan tidak diizinkan";
    //         return json_encode($response);
    //     }

    //     $rules = [
    //         'tgl_awal' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tanggal Awal tidak boleh kosong. ',
    //             ]
    //         ],
    //         'tgl_akhir' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tanggal Akhir tidak boleh kosong. ',
    //             ]
    //         ],
    //         'layanan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Layanan tidak boleh kosong. ',
    //             ]
    //         ],
    //         'type_file' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Type file tidak boleh kosong. ',
    //             ]
    //         ],
    //     ];

    //     if (!$this->validate($rules)) {
    //         $response = new \stdClass;
    //         $response->status = 400;
    //         $response->message = $this->validator->getError('tgl_awal')
    //             . $this->validator->getError('tgl_akhir')
    //             . $this->validator->getError('layanan')
    //             . $this->validator->getError('type_file');
    //         return json_encode($response);
    //     } else {
    //         $Profilelib = new Profilelib();
    //         $user = $Profilelib->user();
    //         if ($user->status != 200) {
    //             delete_cookie('jwt');
    //             session()->destroy();
    //             $response = new \stdClass;
    //             $response->status = 401;
    //             $response->message = "Session expired";
    //             return json_encode($response);
    //         }

    //         $tgl_awal = htmlspecialchars($this->request->getVar('tgl_awal'), true);
    //         $tgl_akhir = htmlspecialchars($this->request->getVar('tgl_akhir'), true);
    //         $layanan = htmlspecialchars($this->request->getVar('layanan'), true);
    //         $type_file = htmlspecialchars($this->request->getVar('type_file'), true);
    //         // $tgl_awal = $this->request->getPost('tgl_awal');
    //         // $tgl_akhir = $this->request->getPost('tgl_akhir');
    //         // $layanan = $this->request->getPost('layanan');

    //         $builder = $this->_db->table('_permohonan a');
    //         $builder->select("a.kode_permohonan, a.nik, a.nama, a.jenis_kepesertaan, 
    //                      a.kode_faskes, c.nama_faskes, b.kk, b.tempat_lahir, b.tgl_lahir, 
    //                      b.jenis_kelamin, b.kecamatan as kode_kecamatan, d.kecamatan as nama_kecamatan, 
    //                      b.kelurahan as kode_kampung, e.kelurahan as nama_kampung, b.alamat, b.rt, 
    //                      b.rw, b.kode_pos, b.pekerjaan, a.updated_at as tanggal_usulan");
    //         $builder->join('_profil_users_tb b', 'a.user_id = b.id', 'left');
    //         $builder->join('ref_kecamatan d', 'b.kecamatan = d.id', 'left');
    //         $builder->join('ref_kelurahan e', 'b.kelurahan = e.id', 'left');
    //         $builder->join('ref_faskes c', 'a.kode_faskes = c.kode_faskes', 'left');
    //         $builder->where('a.status_permohonan', 5);
    //         $builder->where('a.layanan', strtoupper($layanan));
    //         $builder->where('a.updated_at >=', $tgl_awal);
    //         $builder->where('a.updated_at <=', $tgl_akhir);

    //         $datanya = $builder->get()->getResultArray();

    //         $response = new \stdClass;
    //         $response->status = 400;
    //         $response->err = $datanya;
    //         $response->message = "tester";
    //         return json_encode($response);

    //         try {

    //             // Buat spreadsheet baru
    //             $spreadsheet = new Spreadsheet();
    //             $sheet = $spreadsheet->getActiveSheet();

    //             // Set judul laporan
    //             $sheet->mergeCells('A1:U1');
    //             $sheet->setCellValue('A1', 'DATA USULAN CALON PENERIMA BANTUAN IURAN (PBI) APBD KABUPATEN LAMPUNG TENGAH');
    //             $sheet->mergeCells('A2:U2');
    //             $sheet->setCellValue('A2', 'PERIODE ' . $tgl_awal . ' s/d ' . $tgl_akhir);

    //             // Style untuk judul
    //             $titleStyle = [
    //                 'font' => ['bold' => true],
    //                 'alignment' => [
    //                     'horizontal' => Alignment::HORIZONTAL_CENTER,
    //                     'vertical' => Alignment::VERTICAL_CENTER
    //                 ]
    //             ];
    //             $sheet->getStyle('A1:U2')->applyFromArray($titleStyle);

    //             // Set header tabel
    //             $sheet->mergeCells('A5:A6');
    //             $sheet->setCellValue('A5', 'NO');
    //             $sheet->mergeCells('B5:B6');
    //             $sheet->setCellValue('B5', 'Nomor KK');
    //             $sheet->mergeCells('C5:C6');
    //             $sheet->setCellValue('C5', 'NIK/KITAS/KITAP');
    //             $sheet->mergeCells('D5:D6');
    //             $sheet->setCellValue('D5', 'Nama Lengkap');

    //             $sheet->setCellValue('E5', 'Peserta, Suami, Istri, Anak, Tambahan');
    //             $sheet->setCellValue('E6', '1=P, 2=S, 3=I, 4=A, 5=T');

    //             $sheet->mergeCells('F5:G5');
    //             $sheet->setCellValue('F5', 'Data Kelahiran');
    //             $sheet->setCellValue('F6', 'Tempat Lahir');
    //             $sheet->setCellValue('G6', 'Tanggal Lahir');

    //             $sheet->setCellValue('H5', 'Jenis Kelamin');
    //             $sheet->setCellValue('H6', 'L/P');

    //             $sheet->setCellValue('I5', 'Status Kawin');
    //             $sheet->setCellValue('I6', '1=B, 2=K, 3=C (1 Belum Kawin, 2 Kawin, 3 Cerai)');

    //             $sheet->mergeCells('J5:J6');
    //             $sheet->setCellValue('J5', 'Alamat Tempat Tinggal');

    //             // ... (lanjutkan untuk header lainnya sesuai kebutuhan)

    //             // Style untuk header
    //             $headerStyle = [
    //                 'font' => ['bold' => true],
    //                 'alignment' => [
    //                     'horizontal' => Alignment::HORIZONTAL_CENTER,
    //                     'vertical' => Alignment::VERTICAL_CENTER,
    //                     'wrapText' => true
    //                 ],
    //                 'borders' => [
    //                     'allBorders' => [
    //                         'borderStyle' => Border::BORDER_THIN
    //                     ]
    //                 ],
    //                 'fill' => [
    //                     'fillType' => Fill::FILL_SOLID,
    //                     'startColor' => ['argb' => 'FFD9D9D9']
    //                 ]
    //             ];
    //             $sheet->getStyle('A5:U6')->applyFromArray($headerStyle);

    //             // Isi data
    //             $row = 7;
    //             $no = 1;
    //             foreach ($datanya as $item) {
    //                 $sheet->setCellValue('A' . $row, $no);
    //                 $sheet->setCellValue('B' . $row, $item['kk'] ?? '');
    //                 $sheet->setCellValue('C' . $row, $item['nik'] ?? '');
    //                 $sheet->setCellValue('D' . $row, $item['nama'] ?? '');
    //                 $sheet->setCellValue('E' . $row, $item['jenis_kepesertaan'] ?? '');
    //                 $sheet->setCellValue('F' . $row, $item['tempat_lahir'] ?? '');
    //                 $sheet->setCellValue('G' . $row, $item['tgl_lahir'] ?? '');
    //                 $sheet->setCellValue('H' . $row, $item['jenis_kelamin'] ?? '');
    //                 $sheet->setCellValue('I' . $row, $item['status_kawin'] ?? '');
    //                 $sheet->setCellValue('J' . $row, $item['alamat'] ?? '');
    //                 // ... (lanjutkan untuk kolom lainnya)

    //                 $row++;
    //                 $no++;
    //             }

    //             // Set lebar kolom
    //             $sheet->getColumnDimension('A')->setWidth(4);
    //             $sheet->getColumnDimension('B')->setWidth(20);
    //             $sheet->getColumnDimension('C')->setWidth(20);
    //             $sheet->getColumnDimension('D')->setWidth(30);
    //             // ... (lanjutkan untuk kolom lainnya)

    //             // Set tinggi baris
    //             $sheet->getRowDimension(5)->setRowHeight(30);
    //             $sheet->getRowDimension(6)->setRowHeight(30);

    //             // Border untuk data
    //             $dataStyle = [
    //                 'borders' => [
    //                     'allBorders' => [
    //                         'borderStyle' => Border::BORDER_THIN
    //                     ]
    //                 ],
    //                 'alignment' => [
    //                     'vertical' => Alignment::VERTICAL_CENTER
    //                 ]
    //             ];
    //             $sheet->getStyle('A7:U' . ($row - 1))->applyFromArray($dataStyle);

    //             ///new saved file
    //             $outputDir = FCPATH . "uploads/laporan";
    //             // if (!is_dir($outputDir)) {
    //             //     mkdir($outputDir, 0777, true);
    //             // }

    //             // Generate filename
    //             $filename = 'LAPORAN_PBI_' . $tgl_awal . '_sd_' . $tgl_akhir . '.xlsx';
    //             $filepath = $outputDir . $filename;

    //             // Save Excel file
    //             $writer = new Xlsx($spreadsheet);
    //             $writer->save($filepath);

    //             // Prepare response
    //             $response = new \stdClass();
    //             $response->status = 200;

    //             $dataResponse = new \stdClass();
    //             $dataResponse->url = '/uploads/laporan/' . $filename;

    //             $response->data = new \stdClass();
    //             $response->data->data = $dataResponse;
    //             $response->url = base_url() . "/uploads/laporan/" . $filename;
    //             $response->message = "Download Data Berhasil Dilakukan.";

    //             // Return JSON response
    //             return $this->response->setJSON($response);
    //             //code...
    //         } catch (\Throwable $th) {
    //             $response = new \stdClass();
    //             $response->status = 400;
    //             $response->err = $th;
    //             $response->message = "Download Data gagal Dilakukan.";

    //             // Return JSON response
    //             return $this->response->setJSON($response);
    //             //throw $th;
    //         }

    //         // Buat writer Excel
    //         // $writer = new Xlsx($spreadsheet);

    //         // $dir = FCPATH . "uploads/lks";

    //         // // Set header untuk download
    //         // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //         // header('Content-Disposition: attachment;filename="LAPORAN_PBI_' . $tgl_awal . '_sd_' . $tgl_akhir . '.xlsx"');
    //         // header('Cache-Control: max-age=0');

    //         // $writer->save('php://output');
    //         // exit;
    //     }
    // }
}
