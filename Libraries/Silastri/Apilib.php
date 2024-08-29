<?php

namespace App\Libraries\Silastri;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CURLFile;

class Apilib
{
    private $_db;
    function __construct()
    {
        helper(['text', 'session', 'cookie', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    private function _send_get($methode, $jwt)
    {
        $urlendpoint = getenv('begaji.default.url') . $methode;
        $apiToken = getenv('begaji.default.api_token');

        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "GET");
        // curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'X-API-TOKEN: ' . $apiToken,
            'Authorization: Bearer ' . $jwt,
            'Content-Type: application/json'
        ));
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 30);

        return $curlHandle;
    }

    private function _send_post($data, $methode, $jwt)
    {
        $urlendpoint = getenv('befile.default.url') . $methode;
        $apiToken = getenv('befile.default.api_token');

        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'X-API-TOKEN: ' . $apiToken,
            'Authorization: Bearer ' . $jwt,
            'Content-Type: application/json'
        ));
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 1200);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 1200);


        return $curlHandle;
    }

    private function _send_post_upload($data, $methode, $jwt)
    {
        $urlendpoint = getenv('begaji.default.url') . $methode;
        $apiToken = getenv('begaji.default.api_token');

        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($curlHandle, CURLOPT_POST, true);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'X-API-TOKEN: ' . $apiToken,
            'Authorization: Bearer ' . $jwt,
            // 'Content-Type: application/json'
        ));
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 120);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 120);


        return $curlHandle;
    }

    public function getUser()
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $add         = $this->_send_get('user', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function uploadMeninggal($tahun, $file)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tahun_bulan' => $tahun,
                'lampiran' => new CURLFile($file),
            ];

            $add         = $this->_send_post_upload($data, 'importmeninggal', $jwt);

            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function downloadLaporanPbi($tgl_awal, $tgl_akhir, $layanan, $type)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
            ];
            if ($type == "pdf") {
                if ($layanan == "PBI") {
                    $add         = $this->_send_post($data, 'exportlaporanpbipdf', $jwt);
                } else {
                    return false;
                }
            } else {
                if ($layanan == "PBI") {
                    $add         = $this->_send_post($data, 'exportlaporanpbi', $jwt);
                } else {
                    return false;
                }
            }
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);

            var_dump($result);
            die;


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function downloadLaporanAll($tahun, $type)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tahun' => $tahun,
            ];
            if ($type == "pdf") {
                $add         = $this->_send_post($data, 'exportlaporanallpdf', $jwt);
            } else {
                $add         = $this->_send_post($data, 'exportlaporanall', $jwt);
            }
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function uploadPegawaiGajiSipd($tahun, $filename)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tahun_bulan' => $tahun,
                'filename' => $filename,
            ];
            $add         = $this->_send_post($data, 'importpegawaigajisipd', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function generatePotonganInfak($tahun)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tahun' => $tahun,
                'jenis_potongan' => 'infak',
            ];
            $add         = $this->_send_post($data, 'generatepotongan', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function generatePotonganDharmaWanita($tahun)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tahun' => $tahun,
                'jenis_potongan' => 'dharmawanita',
            ];
            $add         = $this->_send_post($data, 'generatepotongan', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function generatePotonganKorpri($tahun)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tahun' => $tahun,
                'jenis_potongan' => 'korpri',
            ];
            $add         = $this->_send_post($data, 'generatepotongan', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function generatePotonganThr($tahun)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tahun' => $tahun,
                'jenis_potongan' => 'thr',
            ];
            $add         = $this->_send_post($data, 'generatepotongan', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function generatePotonganGaji13($tahun)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'tahun' => $tahun,
                'jenis_potongan' => 'gaji13',
            ];
            $add         = $this->_send_post($data, 'generatepotongan', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function syncPtk($npsn, $tw)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'npsn' => $npsn,
                'tw' => $tw,
                'batas_tmt' => "2023-01-01",
            ];
            $add         = $this->_send_post($data, 'syncptk', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function syncPtkId($idPtk, $npsn, $tw)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'id_ptk' => $idPtk,
                'npsn' => $npsn,
                'tw' => $tw,
                'batas_tmt' => "2023-01-01",
            ];
            $add         = $this->_send_post($data, 'syncptkid', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getPtkById($idPtk)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'id' => $idPtk,
            ];
            $add         = $this->_send_post($data, 'getptkid', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getPtkByNuptk($idPtk)
    {
        $jwt = get_cookie('jwt');
        if ($jwt) {
            $data = [
                'nuptk' => $idPtk,
            ];
            $add         = $this->_send_post($data, 'getptknuptk', $jwt);
            $send_data         = curl_exec($add);

            $result = json_decode($send_data);


            if (isset($result->error)) {
                return false;
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
