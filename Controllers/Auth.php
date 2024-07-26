<?php

namespace App\Controllers;

use App\Models\AuthModel;
use Firebase\JWT\JWT;
use App\Libraries\Profilelib;
use App\Libraries\Auth\Authlib;

class Auth extends BaseController
{
    private $_db;
    function __construct()
    {
        helper(['text', 'file', 'form', 'cookie', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function index()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status == 200) {
            return redirect()->to(base_url('portal'));
        }
        $data['title'] = "Login";
        return view('login/index', $data);
    }

    public function register()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status == 200) {
            return redirect()->to(base_url('home'));
        }

        $data['title'] = "Daftar";
        return view('register/index', $data);
    }

    public function lupapassword()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status == 200) {
            return redirect()->to(base_url('home'));
        }

        $data['title'] = "Lupa Password";
        return view('login/lupapassword', $data);
    }

    public function confirmresetpassword()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status == 200) {
            return redirect()->to(base_url('home'));
        }

        $token = htmlspecialchars($this->request->getGet('token') ?? "", true);
        $email = htmlspecialchars($this->request->getGet('email') ?? "", true);
        $code = htmlspecialchars($this->request->getGet('code') ?? "", true);

        $tokenReset = $this->_db->table('_token_reset')->where(['token' => $token, 'email' => $email, 'code' => $code])->get()->getRowObject();

        if (!$tokenReset) {
            $data['title'] = "Error Reset Password";
            $data['error'] = "Link reset password tidak valid";
            return view('404', $data);
        }

        $expiryDateTime = strtotime($tokenReset->created_at);
        $expiryDateTime += 2 * 24 * 60 * 60; // Adding 2 days in seconds

        $currentDateTime = time();

        if ($currentDateTime > $expiryDateTime) {
            $data['title'] = "Error Reset Password";
            $data['error'] = "Token reset telah expired.";
            return view('404', $data);
        }

        $data['title'] = "Lupa Password";
        $data['data'] = $tokenReset;
        return view('login/lupapassword-conf', $data);
    }

    public function saveregis()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status == 200) {
            $response = new \stdClass;
            $response->status = 201;
            $response->message = "Sudah Login";
            return json_encode($response);
            // return redirect()->to(base_url('home'));
        }
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            '_nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            '_nik' => [
                'rules' => 'required|trim|min_length[16]',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong. ',
                    'min_length' => 'NIK harus 16 karakter. ',
                ]
            ],
            '_no_hp' => [
                'rules' => 'required|trim|min_length[8]',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong. ',
                    'min_length' => 'Masukkan no handphone dengan benar. ',
                ]
            ],
            '_email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. ',
                    'valid_email' => 'Masukkan email dengan benar. ',
                ]
            ],
            '_password' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong. ',
                    'min_length' => 'Panjang password minimal 6 karakter. ',
                ]
            ],
            '_re_password' => [
                'rules' => 'required|matches[_password]',
                'errors' => [
                    'required' => 'Ulangi kata sandi tidak boleh kosong. ',
                    'matches' => 'Ulangi kata sandi tidak sama. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('_nama')
                . $this->validator->getError('_nik')
                . $this->validator->getError('_no_hp')
                . $this->validator->getError('_email')
                . $this->validator->getError('_password')
                . $this->validator->getError('_re_password');
            return json_encode($response);
        } else {
            $nama = htmlspecialchars($this->request->getVar('_nama'), true);
            $nik = htmlspecialchars($this->request->getVar('_nik'), true);
            $no_hp = htmlspecialchars($this->request->getVar('_no_hp'), true);
            $email = htmlspecialchars($this->request->getVar('_email'), true);
            $password = htmlspecialchars($this->request->getVar('_password'), true);
            $re_password = htmlspecialchars($this->request->getVar('_re_password'), true);

            $authLib = new Authlib();
            $result = $authLib->postRegis($nama, $nik, $no_hp, $email, $password, $re_password);

            // var_dump($result);
            // die;

            if (!$result) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Kesalahan dalam memuat data.";
                return json_encode($response);
            }

            if (!($result->status == 200)) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = $result->message;
                return json_encode($response);
            }

            set_cookie('jwt', $result->data->access_token, strval(3600 * 24 * 1));

            $response = new \stdClass;
            $response->status = 200;
            $response->message = 'Pendaftaran Akun berhasil.';
            // if ((int)$result->level == 1) {
            $response->url = base_url('portal');
            // } else if ((int)$result->level == 2) {
            //     $response->redirect = base_url('sp/home');
            // } else if ((int)$result->level == 3) {
            //     $response->redirect = base_url('bp/home');
            // } else {
            //     $response->redirect = base_url('p/home');
            // }
            return json_encode($response);
        }
    }

    public function login()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status == 200) {
            $response = new \stdClass;
            $response->status = 201;
            $response->message = "Sudah Login";
            return json_encode($response);
            // return redirect()->to(base_url('home'));
        }
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'username' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Username tidak boleh kosong. ',
                ]
            ],
            'password' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong. ',
                    'min_length' => 'Panjang password minimal 6 karakter. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('username') . $this->validator->getError('password');
            return json_encode($response);
        } else {
            $username = htmlspecialchars($this->request->getVar('username'), true);
            $password = htmlspecialchars($this->request->getVar('password'), true);

            $authLib = new Authlib();
            $results = $authLib->postLogin($username, $password);

            // var_dump($results);
            // die;

            if (!$results) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Username atau password salah.";
                return json_encode($response);
            }


            if (!($results->code == 200)) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = $results->message;
                return json_encode($response);
            }

            $result = $results->data;

            if (!($result->status == 200)) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = $result->message;
                return json_encode($response);
            }

            // $authLib = new AuthModel($this->_db);
            // $result = $authLib->getUsername($username);

            // if (!$result) {
            //     $response = new \stdClass;
            //     $response->status = 400;
            //     $response->message = "Username atau password salah.";
            //     return json_encode($response);
            // }

            // if (!(password_verify($password, $result->password))) {
            //     $response = new \stdClass;
            //     $response->status = 400;
            //     $response->message = "Username atau password salah.";
            //     return json_encode($response);
            // }

            // if ((int)$result->is_active !== 1) {
            //     $response = new \stdClass;
            //     $response->status = 400;
            //     $response->message = "Account anda telah di suspend, silahkan hubungi superadmin.";
            //     return json_encode($response);
            // }

            // $token_jwt = getenv('token_jwt.default.key');

            // $issuer_claim = "THE_CLAIM"; // this can be the servername. Example: https://domain.com
            // $audience_claim = "THE_AUDIENCE";
            // $issuedat_claim = time(); // issued at
            // $notbefore_claim = $issuedat_claim; //not before in seconds
            // $expire_claim = $issuedat_claim + (3600 * 24); // expire time in seconds
            // $token = array(
            //     "iss" => $issuer_claim,
            //     "aud" => $audience_claim,
            //     "iat" => $issuedat_claim,
            //     "nbf" => $notbefore_claim,
            //     "exp" => $expire_claim,
            //     "data" => array(
            //         "id" => $result->uid,
            //         "level" => (int)$result->level,
            //     )
            // );

            // $token = JWT::encode($token, $token_jwt, 'HS256');
            set_cookie('jwt', $result->data->access_token, strval(3600 * 24 * 1));

            $response = new \stdClass;
            $response->status = 200;
            $response->message = 'Login berhasil.';
            // if ((int)$result->level == 1) {
            $response->url = base_url('portal');
            // } else if ((int)$result->level == 2) {
            //     $response->redirect = base_url('sp/home');
            // } else if ((int)$result->level == 3) {
            //     $response->redirect = base_url('bp/home');
            // } else {
            //     $response->redirect = base_url('p/home');
            // }
            return json_encode($response);
        }
    }

    public function kirimlupapassword()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status == 200) {
            $response = new \stdClass;
            $response->status = 201;
            $response->message = "Sudah Login";
            return json_encode($response);
            // return redirect()->to(base_url('home'));
        }
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            '_email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Username tidak boleh kosong. ',
                    'valid_email' => 'Email tidak valid. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('_email');
            return json_encode($response);
        } else {
            $email = htmlspecialchars($this->request->getVar('_email'), true);

            $authLib = new Authlib();
            $result = $authLib->postResetEmail($email);

            // var_dump($result);
            // die;

            if (!$result) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Email tidak terdaftar.";
                return json_encode($response);
            }

            if (!($result->status == 200)) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = $result->message;
                return json_encode($response);
            }

            $response = new \stdClass;
            $response->status = 200;
            $response->data = view('login/send-success', ['message' => $result->message]);
            $response->message = 'Silahkan cek email anda untuk mereset password akun.';
            $response->url = base_url('auth');
            return json_encode($response);
        }
    }

    public function savechangenewpassword()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->status == 200) {
            $response = new \stdClass;
            $response->status = 201;
            $response->message = "Sudah Login";
            return json_encode($response);
            // return redirect()->to(base_url('home'));
        }
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            '_token' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Token tidak boleh kosong. ',
                ]
            ],
            '_email' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. ',
                ]
            ],
            '_password' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Password baru tidak boleh kosong. ',
                    'min_length' => 'Panjang password baru minimal 6 karakter. ',
                ]
            ],
            '_re_password' => [
                'rules' => 'required|matches[_password]',
                'errors' => [
                    'required' => 'Ulangi kata sandi tidak boleh kosong. ',
                    'matches' => 'Ulangi kata sandi tidak sama. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->status = 400;
            $response->message = $this->validator->getError('_password')
                . $this->validator->getError('_token')
                . $this->validator->getError('_email')
                . $this->validator->getError('_re_password');
            return json_encode($response);
        } else {
            $token = htmlspecialchars($this->request->getVar('_token'), true);
            $email = htmlspecialchars($this->request->getVar('_email'), true);
            $password = htmlspecialchars($this->request->getVar('_password'), true);

            $oldData = $this->_db->table('_users_tb')->where(['id' => $token, 'email' => $email])->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "User tidak ditemukan.";
                return json_encode($response);
            }

            $this->_db->transBegin();
            try {
                $this->_db->table('_users_tb')->where('id', $oldData->id)->update([
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } catch (\Exception $e) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal menyimpan password baru.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {
                $this->_db->transCommit();
                $response = new \stdClass;
                $response->status = 200;
                $response->data = view('login/send-success-reset', ['message' => "Password baru berhasil disimpan.", 'buttonText' => "Masuk Sekarang", 'url' => base_url('auth')]);
                $response->message = 'Password baru berhasil disimpan.';
                $response->url = base_url('auth');
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->status = 400;
                $response->message = "Gagal mengajukan permohonan.";
                return json_encode($response);
            }
        }
    }

    // public function resetpassword()
    // {
    //     if ($this->request->getMethod() != 'post') {
    //         $data['title'] = "Reset Password";
    //         return view('login/resetpassword', $data);
    //     }

    //     $rules = [
    //         'email' => 'required|trim',
    //     ];

    //     if (!$this->validate($rules)) {
    //         // $data = new \stdClass;
    //         $data['title'] = "Reset Password";
    //         $data['error'] = $this->validator->getError('email');
    //         return view('login/resetpassword', $data);
    //     } else {
    //         $username = htmlspecialchars($this->request->getVar('email'), true);

    //         $authLib = new Authlib();
    //         $result = $authLib->cekUser($username);
    //         if ($result->code == 200) {
    //             $data['title'] = "Reset Password";
    //             return view('login/sukses', $data);
    //         } else {
    //             $data['title'] = "Reset Password";
    //             $data['error'] = "Username tidak terdaftar atau belum terverifikasi.";
    //             return view('login/resetpassword', $data);
    //         }
    //     }
    // }

    // public function newpassword()
    // {
    //     if (!$this->request->getGet('token')) {
    //         return view('404');
    //     }

    //     if ($this->request->getMethod() != 'post') {
    //         $data['user'] = htmlspecialchars($this->request->getGet('token'), true);

    //         $data['title'] = "Buat Password Baru";
    //         // $data['error'] = "Username tidak terdaftar atau belum terverifikasi.";
    //         return view('login/newpassword', $data);
    //     } else {
    //         $rules = [
    //             'token' => 'required|trim',
    //             'newPassword' => 'required|trim',
    //             'retypeNewPassword' => 'matches[newPassword]',
    //         ];

    //         if (!$this->validate($rules)) {
    //             // $data = new \stdClass;
    //             $data['user'] = htmlspecialchars($this->request->getGet('user'), true);
    //             $data['title'] = "Ganti Password";
    //             $data['error'] = $this->validator->getError('retypeNewPassword');
    //             return view('login/newpassword', $data);
    //         } else {
    //             $pass = htmlspecialchars($this->request->getVar('newPassword'), true);
    //             $token = htmlspecialchars($this->request->getVar('token'), true);

    //             $authLib = new Authlib();
    //             $result = $authLib->changePassword($token, $pass);

    //             if ($validationToken->code == 200) {
    //                 $data['title'] = "Ganti Password";
    //                 $data['message'] = "Ganti password akun berhasil.";
    //                 $data['url'] = base_url();
    //                 return view('login/sukses', $data);
    //             } else if ($validationToken->code == 401) {
    //                 $data['user'] = htmlspecialchars($this->request->getGet('user'), true);
    //                 $data['title'] = "Ganti Password";
    //                 $data['error'] = $validationToken->message;
    //                 return view('login/newpassword', $data);
    //             } else {
    //                 $data['user'] = htmlspecialchars($this->request->getGet('user'), true);
    //                 $data['title'] = "Ganti Password";
    //                 $data['error'] = $validationToken->message;
    //                 return view('login/newpassword', $data);
    //             }
    //         }
    //     }
    // }

    public function logout()
    {
        delete_cookie('jwt');
        session()->destroy();
        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Anda berhasil logout.";
        $response->url = base_url();
        return json_encode($response);
    }
}
