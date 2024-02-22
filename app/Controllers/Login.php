<?php

namespace App\Controllers;

use App\Models\ApplicationModel;


class Login extends BaseController
{
    protected $ssoDb;
    protected $lmsDb;
    function __construct()
    {
        $this->ssoDb = SSODB . session('suffix');
        $this->lmsDb = CMPDB . '_' . session('suffix');
    }

    public function index()
    {
        if (session()->get('usertype') == 'handler' || session('usertype') == 'team-leader') {
            return redirect()->to('/handler');
        }
        if (session()->get('usertype') == 'admin') {
            return redirect()->to('/admin');
        }
        $data = [];

        try {
            $modelSession = new ApplicationModel('lms_sessions', 'ls_id', SETTINGDB);
            $sessionData = $modelSession->select('session_tb_suffix')->where('session_status', 1)->where('session_delete_status', 0)->findAll();
            // Example array
            $sessionMakingYear = [];
            // Iterate over each value and trim to last 4 digits
            foreach ($sessionData as $value) {

                array_push($sessionMakingYear, substr((string)$value['session_tb_suffix'], -4)); // Convert to string and get last 4 characters
            }
            // Get unique values only
            $sessionUniqueValues = array_unique($sessionMakingYear);
            $data['sessionData'] = $sessionUniqueValues;
        } catch (\Throwable $th) {
            session()->setFlashdata('toastr', ['error' => 'No Data present in Session.']);
            // return redirect()->withInput()->to('');
        }

        if ($this->request->getMethod() == "post") {
            $postData = $this->request->getVar();
            //dd($postData);
            if (empty($this->request->getVar('year'))) {
                return redirect()->withInput()->to('/login');
            }
            $rules = [
                'email' => 'required|min_length[5]|max_length[255]|valid_email',
                'password' => 'required|min_length[8]|max_length[32]|validatehandler[email, password]',
                'year' => 'required|exact_length[4]|valid_date[Y]',
            ];
            $errors = [
                'email' => [
                    'required' => 'Mail Id is required,',
                    'min_length' => 'Mail Id support minimum lenght 5.',
                    'max_length' => 'Mail Id support maximum lenght 255.',
                    'valid_email' => 'Please provide the valid Mail Id.'
                ],
                'password' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password support minimum lenght 8.',
                    'max_length' => 'Password support maximum lenght 32.',
                    'validatehandler' => 'Email or Password don\'t match',
                ],
                'year' => [
                    'required' => 'Year is required.',
                    'exact_length' => 'Year Support excat length 4.',
                    'valid_date' => 'Provided year is not a valid year.',
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                if (!session('suffix')) {
                    return redirect()->withInput()->to('/login');
                }

                $handlermodel = new ApplicationModel('lms_users_' . $this->request->getVar('year'), 'lu_id', SETTINGDB);
                $user = $handlermodel->where('user_email', $this->request->getVar('email'))->first();
                try {
                    $history = new ApplicationModel('handler_login_history_' . $this->request->getVar('year'), 'hlh_id', $user['db_name'] . '_' . session('suffix'));
                    $hData = [
                        'handler_id' => $user['lu_id'],
                        'handler_ip' => $this->request->getIPAddress(),
                        'login_time' => time(),
                        'logout_time' => time(),
                    ];
                    $history->insert($hData);
                    session()->set('history', $history->getInsertID());
                } catch (\Throwable $th) {
                    session()->setFlashdata('toastr', ['error' => 'Please contact to partener or University IT CELL.']);
                    return redirect()->withInput()->to('/');
                }

                $role = 'handler';
                if ($user['user_role'] == 1) {
                    $role = 'team-leader';
                }
                $this->setUserMethod($user, $role);

                session()->set('year', $this->request->getVar('year'));
                //$adminmodel->login_status();
                //return 'Hello';
                return redirect()->to('/handler/welcome');
            }
        }
        return view("login", $data);
    }
    public function admin()
    {
        if (session()->get('usertype') == 'handler' || session('usertype') == 'team-leader') {
            return redirect()->to('/handler');
        }
        if (session()->get('usertype') == 'admin') {
            return redirect()->to('/admin');
        }
        $data = [];
        try {
            $modelSession = new ApplicationModel('lms_sessions', 'ls_id', SETTINGDB);
            $sessionData = $modelSession->select('session_tb_suffix')->where('session_status', 1)->where('session_delete_status', 0)->findAll();
            // Example array
            $sessionMakingYear = [];
            // Iterate over each value and trim to last 4 digits
            foreach ($sessionData as $value) {

                array_push($sessionMakingYear, substr((string)$value['session_tb_suffix'], -4)); // Convert to string and get last 4 characters
            }
            // Get unique values only
            $sessionUniqueValues = array_unique($sessionMakingYear);
            $data['sessionData'] = $sessionUniqueValues;
        } catch (\Throwable $th) {
            session()->setFlashdata('toastr', ['error' => 'No Data present in Session.']);
            // return redirect()->withInput()->to('/super-login');
        }

        if ($this->request->getMethod() == "post") {
            $postData = $this->request->getVar();
            //dd($postData);
            if (empty($this->request->getVar('year'))) {
                return redirect()->withInput()->to('/super-login');
            }
            $rules = [
                'email' => 'required|min_length[6]|max_length[255]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email, password]',
                'year' => 'required|exact_length[4]|valid_date[Y]',
            ];

            $errors = [
                'email' => [
                    'required' => 'Mail Id is required,',
                    'min_length' => 'Mail Id support minimum lenght 5.',
                    'max_length' => 'Mail Id support maximum lenght 255.',
                    'valid_email' => 'Please provide the valid Mail Id.'
                ],
                'password' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password support minimum lenght 8.',
                    'max_length' => 'Password support maximum lenght 32.',
                    'validateUser' => 'Email or Password don\'t match',
                ],
                'year' => [
                    'required' => 'Year is required.',
                    'exact_length' => 'Year Support excat length 4.',
                    'valid_date' => 'Provided year is not a valid year.',
                ]
            ];
            if (!$this->validate($rules, $errors)) {

                $data['validation'] = $this->validator;
            } else {
                if (!session('suffix')) {
                    return redirect()->withInput()->to('/super-login');
                }

                $adminmodel = new ApplicationModel('lms_users_' . $this->request->getVar('year'), 'lu_id', SETTINGDB);
                $user = $adminmodel->where('user_email', $this->request->getVar('email'))->first();
                try {
                    $history = new ApplicationModel('admin_login_history', 'alh_id', $user['db_name'] . '_' . session('suffix'));
                    $hData = [
                        'admin_id' => $user['lu_id'],
                        'admin_ip' => $this->request->getIPAddress(),
                        'login_time' => time(),
                        'logout_time' => time(),
                    ];
                    $history->insert($hData);
                    session()->set('history', $history->getInsertID());
                } catch (\Throwable $th) {
                    session()->setFlashdata('toastr', ['error' => 'Please contact to University IT CELL.']);
                    return redirect()->withInput()->to('/super-login');
                }
                $this->setUserMethod($user, 'admin');
                session()->set('year', $this->request->getVar('year'));
                //dd($_SESSION);
                //$adminmodel->login_status();
                return redirect()->to('/admin');
            }
        }
        return view("login", $data);
    }

    private function setUserMethod($user, $userType): bool
    {
        $return = false;
        if ($userType == 'handler' ||  $userType == 'team-leader') {
            $data = [
                'id' => $user['lu_id'],
                'name' => $user['user_name'],
                'email' => $user['user_email'],
                'mobile' => $user['user_mobile'],
                'db_priffix' => $user['db_name'],
                'role' => $user['user_role'],
                'usertype' => $userType,
                'isLoggedIn' => true,
                'report_to' => $user['user_report_to'],
                'admission_source' => $user['user_source'],
            ];
            $return = session()->set($data) ? true : false;
        }
        if ($userType == 'admin') {
            $data = [
                'id' => $user['lu_id'],
                'name' => $user['user_name'],
                'email' => $user['user_email'],
                'mobile' => $user['user_mobile'],
                'db_priffix' => $user['db_name'],
                'role' => $user['user_role'],
                'unique_id' => $user['lu_id'],
                'usertype' => $userType,
                'isLoggedInAdmin' => true,
                'report_to' => $user['user_report_to'],
                'admission_source' => $user['user_source'],
            ];
            $return = session()->set($data) ? true : false;
        }
        return $return;
    }

    public function forget_password()
    {
        if (session()->get('usertype') == 'handler' || session('usertype') == 'team-leader') {
            return redirect()->to('/handler');
        }
        if (session()->get('usertype') == 'admin') {
            return redirect()->to('/super-login');
        }

        $data = [];
        if ($this->request->getMethod() == "post") {
            $postData = $this->request->getPost();
            if (empty($this->request->getVar('year'))) {
                return redirect()->to('/forget-password')->withInput()->with('error', 'yes');
            }
            $rules = [
                'email' => 'required|min_length[6]|max_length[255]|valid_email',
                'year' => 'required|exact_length[4]|valid_date[Y]',
            ];
            $errors = [
                'email' => [
                    'required' => 'Mail Id is required,',
                    'min_length' => 'Mail Id support minimum lenght 5.',
                    'max_length' => 'Mail Id support maximum lenght 255.',
                    'valid_email' => 'Please provide the valid Mail Id.'
                ],

                'year' => [
                    'required' => 'Year is required.',
                    'exact_length' => 'Year Support excat length 4.',
                    'valid_date' => 'Provided year is not a valid year.',
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $suffix = $this->getDBSuffix();
                $adminmodel = new ApplicationModel('lms_users_' . $this->request->getVar('year'), 'lu_id', SETTINGDB);
                $user = $adminmodel->where('user_email', $this->request->getVar('email'))->where(['user_status' => 1, 'user_deleted_status' => 0])->first();
                if ($user) {
                    $linkData = [
                        'id' => $user['lu_id'],
                        'email' => $user['user_email'],
                        'suffix' => $suffix,
                        'year' => $this->request->getVar('year'),
                        'expireTimestamp' => time() + 3600,
                        'time' => time()
                    ];
                    $jsonString = json_encode($linkData);
                    $baseEncode = base64_encode($jsonString);
                    $link = urlencode($baseEncode);

                    $senderDetail = [
                        'email' => $postData['email'],
                        'link' => base_url('/reset-password/' . $link),
                    ];
                    $email = [
                        'view' => 'email/handler/forget-password',
                        'from' => 'aakash.kumawat@mygyanvihar.org',
                        'subject' => 'Forget Password [leadform]',
                        'replyto' => 'aakash.49169@mygyanvihar.com',
                        'replytoname' => 'John Due',
                    ];

                    if ($this->sendMailer(['email' => $email, 'senderDetail' => $senderDetail])) {
                        return redirect()->to('/forget-password/success');
                    } else {
                        return redirect()->to('/forget-password')->withInput()->with('error', 'yes');
                    }
                } else {
                    //return 'Hi';
                    return redirect()->to('/forget-password')->withInput()->with('error', 'yes');
                }

                //$adminmodel->login_status();

            }
        }

        return view('forget-password', $data);
    }

    public function reset_password($user = false)
    {
        if (session()->get('usertype') == 'handler' || session('usertype') == 'team-leader') {
            return redirect()->to('/handler');
        }
        if (session()->get('usertype') == 'admin') {
            return redirect()->to('/super-login');
        }
        $data = [];
        if ($user === false) {
            session()->setFlashdata('toastr', ['danger' => "Something Went Wrong"]);
            return redirect()->to('/');
        }
        $data = [];
        $userData = json_decode(base64_decode(urldecode($user)), true);

        if (empty($userData['id']) || empty($userData['email']) || empty($userData['suffix']) || empty($userData['year'])) {
            session()->setFlashdata('toastr', ['danger' => "Something Went Wrong "]);
            return redirect()->to('/');
        }
        if (empty($userData['expireTimestamp']) || $userData['expireTimestamp'] < time()) {
            session()->setFlashdata('toastr', ['danger' => "Reset Password link has been Expire"]);
            return redirect()->to('/forget-password');
        }
        $userId = $userData['id'];
        $data['email'] = $userData['email'];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => 'required|min_length[8]|max_length[32]',
            ];
            $errors = [
                'password' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password support minimum lenght 8.',
                    'max_length' => 'Password support maximum lenght 32.',
                    'validateUser' => 'Email or Password don\'t match',
                ],
            ];
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $adminmodel = new ApplicationModel('lms_users_' . $userData['year'], 'lu_id', SETTINGDB);
                $user = $adminmodel->update($userData['id'], ['user_password' => $this->request->getVar('password')]);
                if ($user) {
                    return redirect()->to('/');
                } else {
                    return redirect()->to('/reset-password/' . $user)->with('error', 'yes');
                }
                //$adminmodel->login_status();
            }
        }
        return view('reset-password', $userData);
    }

    public function register()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == "post") {
            $rules = [
                'first_name' => 'required|min_length[3]|max_length[255]',
                'last_name' => 'required|min_length[3]|max_length[255]',
                'email' => 'required|min_length[6]|max_length[255]|valid_email|is_unique[admin.email]',
                'mobile' => 'required|min_length[10]|max_length[15]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirmation' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $adminmodel = new AdminModel(); //instance
                $newData = [
                    'firstname' => $this->request->getVar('first_name'),
                    'lastname' => $this->request->getVar('last_name'),
                    'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                ];
                $adminmodel->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Successfull Registration');
                return redirect()->to('/');
            }
        }
        echo view("templates/register", $data);
    }

    //--------------------------------------------------------------------

}
