<?php
namespace App\Controllers;
use function App\Helpers\decrypt;
use function App\Helpers\encrypt;

use App\Models\ApplicationModel;
header('Set-Cookie:'.session_name().'='.session_id().';SameSite=None;Secure',false);
//use 
// use CodeIgniter\API\ResponseTrait;

class Payment extends BaseController
{
    /*

    private $workingKey = '271F65CF95CBCC8A10A64E946E17ED38';
    private $accessCode = 'AVHM78JD91BR62MHRB';
    private $merchantId = '899534';
    private $testUrl = 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
    private $productionUrl = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
    
    */
    
    private $workingKey = '85F0B4ED230C6314266D020D9115C9E8';//'271F65CF95CBCC8A10A64E946E17ED38';
    private $accessCode = 'AVEN74EK33BH31NEHB';//'AVHM78JD91BR62MHRB';
    private $merchantId = '155090';
    private $testUrl = 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
    private $productionUrl = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
    
    
    protected $DBPrifixSSO = 'sso_';


    public function index($lid=false, $sid=false)
	{
        	if (!(session('isLoggedInAdmin') xor session('isLoggedIn'))) {
			return redirect()->to('/');
		}
		header('Set-Cookie:'.session_name().'='.session_id().';SameSite=None;Secure',false);
        // check first admin this
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_'.session('year'), 'lr_id', $this->DBPrifixSSO.session('suffix'));
		$lmsRefData = $lmsReferenceModel->where(['lead_id'=>$lid, 'sid'=>$sid, 'admin_type'=>session('db_priffix')])->first();
		if(!$lmsRefData){
			session()->setFlashdata('toastr', ['error'=>'There no reference from this lead.']);
			return redirect()->back();
		}
        $sidModel = new ApplicationModel('student_login_'.session('year'), 'sl_id', $this->DBPrifixSSO.session('suffix'));
        $getFormStep = $sidModel->select(['form_step','password'])->where(['sid'=>$sid])->first();
        if ($getFormStep['form_step'] != 1) {
           return redirect()->back();
        }

        if($this->request->getMethod() == 'post'){
            if($this->request->getVar('btn') == 'payment'){
                $postData = $this->request->getPost();
                $encrypter = \Config\Services::encrypter();
                try {
                    $deCryptAmt = $encrypter->decrypt(base64_decode($_POST['amount']));
                } catch (\Throwable $th) {
                    session()->setFlashdata('toastr', ['error'=>'Something Went Wrong']);
                    return redirect()->withInput()->back();
                }
                $rules = [
                    'discipline' => 'required|numeric',
                    'program' => 'required|numeric',
                    'nature' => 'required',
                ];
                if ($this->request->getVar('nature') == 1) {
                    $rules['course_type'] = 'required';
                    $si_stream_group = $postData['course_type'];
                }elseif ($this->request->getVar('nature') == 2) {
                    $rules['course_type'] = 'required';
                    if(@count($this->request->getVar('course_type'))!=3){
                        session()->setFlashdata('toastr', ['error' => 'Please Select 3 Subjects.']);
                        return redirect()->back();
                    }	
                    $si_stream_group = json_encode($postData['course_type']);		
                }elseif ($this->request->getVar('nature') == 3) {
                    $rules['course_type'] = 'required'; 
                    $si_stream_group = $postData['course_type'];
                }else{
                    session()->setFlashdata('toastr', ['error' => 'Please Select right Course.']);
                    return redirect()->back();
                }
                $errors = [
                    'discipline' => [
                        'required' => "Discipline is Required",
                    ],
                    'program' => [
                        'required' => "Program is Required",
                    ],
                    'nature' => [
                        'required' => "Course Nature is Required",
                    ],
                    'stream' => [
                        'required' => "Please select Stream."
                    ],
                    'subjects' => [
                        'required' => "Please select 3 Subjects."
                    ],
                    'specialization' => [
                        'required' => "Please select Specialization."
                    ]
                ];
                if(!$this->validate($rules, $errors)){
                    session()->setFlashdata('toastr', ['error'=>'Something Went Wrong']);
                    return redirect()->withInput()->back();
                }else{
                        
                    $model = new ApplicationModel('student_info_'.session('year'), 'si_id', $this->DBPrifixSSO.session('suffix'));
                    $model->set('dept_id', $postData['discipline'])->set('program_id', $postData['program'])->set('si_course_nature', $postData['nature'])->set('si_stream_group', $si_stream_group)->where(['sid'=>$sid])->update();
                    
                    $studentDetail  = $model->join('student_contact_info_' . session('year'), 'student_info_' . session('year') . '.sid=student_contact_info_' . session('year') . '.sid')->where('student_info_' . session('year') . '.sid=' . $sid)->first();

                    $programModel = new ApplicationModel('session_courses_'.session('year'), 'sc_id', $this->DBPrifixSSO.session('suffix'));
                    $programDetail = $programModel->select(['course_full_name'])->join('course_info','session_courses_'.session('year').'.course_id=course_info.coi_id')->where(['sc_id'=>$studentDetail['program_id']])->first();
                    //773b587b752ea42ec0eca77576669028445b9bb58200850b017b202d2460c09e
                    $trans = substr(hash('sha256', microtime()), 0, 20);
                    $orderData = [
                        'order_id'=>$trans,
                        'amount'=>$deCryptAmt,
                        'sid'=>$sid,
                        'purpose'=>'Registration',
                    ];
                    $orderModel = new ApplicationModel('registration_fees_'.session('year'), 'rf_id', $this->DBPrifixSSO.session('suffix'));
                    if($orderModel->insert($orderData)){
                    	helper('Payment');
                        $merchant_data='';
                        $working_key=$this->workingKey;//Shared by CCAVENUES
                        $access_code=$this->accessCode;//Shared by CCAVENUES
                        $url = $this->productionUrl;
                        if((isset($_POST['urlType']) && !empty($_POST['urlType'])) && $_POST['urlType'] == 'test-server-JGDbKGJEH%$^%%HGDVBSJKHJKLHS'){
                            $url = $this->testUrl;
                        }
                        $tm = time();
                        $currency = 'INR';
                        $name = trim($studentDetail['si_first_name'].' '.$studentDetail['si_middle_name'].' '.$studentDetail['si_last_name']);
                        // session('fullname');
                        $mobile = $studentDetail['sci_mobile'];
                        $email = $studentDetail['sci_email'];
                        $redirectURL = base_url('/payment/response');
                        $country = 'India';
                        $prog = $programDetail['course_full_name']??'Not Available';
                        $sem = 0;

                        $merchant_data.='tid='.$tm.'&';
                        $merchant_data.='merchant_id='.$this->merchantId.'&';
                        $merchant_data.='order_id='.$trans.'&';
                        $merchant_data.='amount='.$deCryptAmt.'&';
                        $merchant_data.='currency='.$currency.'&';
                        $merchant_data.='redirect_url='.$redirectURL.'&';
                        $merchant_data.='cancel_url='.$redirectURL.'&';
                        $merchant_data.='billing_tel='.$mobile.'&';
                        $merchant_data.='billing_email='.$email.'&';
                        $merchant_data.='sid='.$sid.'&';
                        $merchant_data.='delivery_name='.$name.'&';
                        $merchant_data.='delivery_country='.$country.'&';
                        $merchant_data.='delivery_tel='.$mobile.'&';
                        $merchant_data.='merchant_param1='.$sid.'&';
                        $merchant_data.='merchant_param2='.$name.'&';
                        $merchant_data.='merchant_param3='.$mobile.'&';
                        $merchant_data.='merchant_param4='.$prog.'&';
                        $merchant_data.='merchant_param5='.$sem.'&';
                    
			//dd($merchant_data);
                        $encrypted_data=encrypt($merchant_data,$working_key);
                        //dd(['encrypted_data'=>$encrypted_data, 'access_code'=>$access_code]);
                        return view('payment/payment', ['encrypted_data'=>$encrypted_data, 'access_code'=>$access_code,'url'=>$url]);
                        /*
                        $data['sid']=$sid;
                        $data['tm']=time();
                        $data['name']=session('fullname');
                        $data['email']=$studentDetail['sci_email'];
                        $data['mobile']=$studentDetail['sci_mobile'];
                        $data['prog']= $programDetail['course_full_name']??'Not Available';
                        $data['amt']=$deCryptAmt;
                        $data['sem']=0;
                        $data['tran']=$trans;
                        $data['merchantId'] = $this->merchantId;
                        $data['redirectURL'] = base_url('/payment/response');
                        $data['env'] = 'test';
                        return view('payment/payment-request', $data);
                        */
                    }
                    session()->setFlashdata('toastr', ['error'=>'Something Went Wrong']);
                    return redirect()->withInput()->back();
                }
            }else{
                session()->setFlashdata('toastr', ['error'=>'Your action is not allow.']);
			    return redirect()->back();
            }
            
        }
        return "Action not Allow";
	}

    public function response_old()
    {
        helper('payment');
        dd($_POST);
        $workingKey = $this->workingKey; //Working Key should be provided here.
        $encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey); //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        //    echo "<center>";

        $decryptValues = explode('&', $rcvdString);
        $order = $decryptValues[1];

        $information = explode('=', $order);
        //echo $RefNo = $information[1];

        $Phone = $decryptValues[17];
        $Phone1 = explode('=', $Phone);
        //echo $Mobile = $Phone1[1];

        $Email = $decryptValues[18];
        $Email1 = explode('=', $Email);
        //echo $Email2 = $Email1[1];

        $Name = $decryptValues[19];
        $Name1 = explode('=', $Name);
        //echo $Name2 = $Name1[1];

        $Sid = $decryptValues[26];
        $Sid1 = explode('=', $Sid);
        //echo $Sid2 = $Sid1[1];

        $Amt = $decryptValues[35];
        $Amt1 = explode('=', $Amt);
        //echo $Amt2 = $Amt1[1];

        $date = $decryptValues[40];
        $date1 = explode('=', $date);
        //echo $date2 = $date1[1];

        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            if ($i == 3) {
                $order_status = $information[1];
            }

        }
        //dd()
        //echo $order_status;
        if ($order_status === "Success") {
            // Call Success function
            $year = '2022';
            $suffix = '2021_25';
            $model = new ApplicationModel('registration_fees_status_'.$year, 'rfs_id', $this->DBPrifixSSO.$suffix);
            $transactionId = '123456789';
            return redirect()->to('payment/success?transaction='.$transactionId);
        } else if ($order_status === "Aborted") {
            // Call Cancel Url with Type
            // echo "Failure 1";
            $year = '2022';
            $suffix = '2021_25';
            $model = new ApplicationModel('registration_fees_status_'.$year, 'rfs_id', $this->DBPrifixSSO.$suffix);
            $transactionId = '123456789';
            return redirect()->to('payment/fail?transaction='.$transactionId);
            exit;
        } else if ($order_status === "Failure") {
            // Call Cancel Url with Type
            // echo "Failure 2";
            $year = '2022';
            $suffix = '2021_25';
            $model = new ApplicationModel('registration_fees_status_'.$year, 'rfs_id', $this->DBPrifixSSO.$suffix);
            $transactionId = '123456789';
            return redirect()->to('payment/fail?transaction='.$transactionId);
            exit;
        } else {
            // Call Cancel Url with Type else
            // echo "Failure 3";
            $year = '2022';
            $suffix = '2021_25';
            $model = new ApplicationModel('registration_fees_status_'.$year, 'rfs_id', $this->DBPrifixSSO.$suffix);
            $transactionId = '123456789';
            return redirect()->to('payment/fail?transaction='.$transactionId);
            exit;
        }
    }
    public function request()
    {
    	header('Set-Cookie:'.session_name().'='.session_id().';SameSite=None;Secure',false);
        helper('Payment');
        $merchant_data='';
        $working_key=$this->workingKey;//Shared by CCAVENUES
        $access_code=$this->accessCode;//Shared by CCAVENUES
        $url = $this->productionUrl;
        if((isset($_GET['urlType']) && !empty($_GET['urlType'])) && $_GET['urlType'] == 'test-server-JGDbKGJEH%$^%%HGDVBSJKHJKLHS'){
            $url = $this->testUrl;
        }
        foreach ($_POST as $key => $value){
            $merchant_data.=$key.'='.$value.'&';
        }
        $encrypted_data=encrypt($merchant_data,$working_key);
        //dd(['encrypted_data'=>$encrypted_data, 'access_code'=>$access_code]);
        return view('payment/payment', ['encrypted_data'=>$encrypted_data, 'access_code'=>$access_code,'url'=>$url]);
    }

    public function success_old()
    {   
        $data = [];
        if (session('isLoggedInAdmin')) {
			$data['redirectUrl'] = base_url('/admin/applicant-list');
		}else{
            $data['redirectUrl'] = base_url('/super-login');
        }
        $data['transaction'] = isset($_GET['transaction'])?$_GET['transaction']:'1234567';
        return view('payment/success', $data);
    }

    public function fail_old()
    {
        $data = [];
        if (session('isLoggedInAdmin')){
            //return redirect()->to('/');
            $data['redirectUrl'] = base_url('/admin/applicant-list');
        }else{
            $data['redirectUrl'] = base_url('/super-login');
        }
        $data['transaction'] = isset($_GET['transaction'])?$_GET['transaction']:'';
        return view('payment/fail', $data);
    }
    
    public function response()
    {
    	header('Set-Cookie:'.session_name().'='.session_id().';SameSite=None;Secure',false);
    	if ((session()->get('isLoggedInAdmin') xor session()->get('isLoggedIn'))) {
			//return redirect()->to('/');
	}
        helper('Payment');
        $workingKey = $this->workingKey; //Working Key should be provided here.
        $encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey); //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        //dd($decryptValues,$_POST);
        //    echo "<center>";
        $decryptValues = explode('&', $rcvdString);
        $responseData = [];
        $order_status = '';
        for ($i=0; $i < $dataSize; $i++) { 
            $information = explode('=', $decryptValues[$i]);
            $responseData[$information[0]] = $information[1];
            if ($i == 3) {
                $order_status = $information[1];
            }
        }
        //dd($decryptValues,$responseData, $order_status);
        
        if ($order_status === "Success") {
            // Call Success function
            $sid = $responseData['merchant_param1'];
            $dbDetail = $this->getYEARDBHELPER($sid??'');
            $year = $dbDetail['year'];
            $suffix = $dbDetail['suffix'];
            $model = new ApplicationModel('registration_fees_status_'.$year, 'rfs_id', $this->DBPrifixSSO.$suffix);
            $transactionId = $responseData['tracking_id'];
            $amount = $responseData['amount'];
            $orderID = $responseData['order_id'];
            $check = $model->select(['trsansaction_status','rfs_id'])->where(['order_id'=>$responseData['order_id'], 'trsansaction_id'=>$responseData['tracking_id']])->first();
            if(!$check){
                $registrationData = [
                    'order_id'=>$responseData['order_id'],
                    'trsansaction_id'=>$responseData['tracking_id'],
                    'bank_ref_no'=>$responseData['bank_ref_no']??null,
                    'trsansaction_status'=>1,
                    'payment_response'=>json_encode($responseData??[]),
                ];

                $x = $model->insert($registrationData);
                if($x){
                    $modelLogin = new ApplicationModel('student_login_'.$year, 'sl_id', $this->DBPrifixSSO.$suffix);
                    $y = $modelLogin->set('form_step', 2)->set('payment_status', date("Y-m-d H:i:s"))->where(['sid'=>$sid])->update();
                    if($y)
                        session()->setFlashdata('toastr', ['success'=>'Your transaction has been successfully paid.']);
                    else
                        session()->setFlashdata('toastr', ['error'=>'Kindly please contact to the university.']);
		    
		    
		    $responseArray = [
                        'transaction'=>$transactionId??'',
                        'order_id'=>$orderID??'',
                        'amount'=>$amount??''
                    ];
                    $encrypter = \Config\Services::encrypter();
                    $responseJson = $encrypter->encrypt(json_encode($responseArray));
                    $resp = urlencode(base64_encode($responseJson));
                    return redirect()->to('payment/success?response='.$resp);
                    // return redirect()->to('payment/success?transaction='.$transactionId.'&order_id='.$orderID.'&amount='.$amount);
                }else{
                    session()->setFlashdata('toastr', ['error'=>'Kindly please contact to the university. Some system error has been occur']);
                    $responseArray = [
	                'transaction'=>$transactionId??'',
	                'order_id'=>$orderID??'',
	                'amount'=>$amount??''
	            ];
	            $encrypter = \Config\Services::encrypter();
	            $responseJson = $encrypter->encrypt(json_encode($responseArray));
	            $resp = urlencode(base64_encode($responseJson));
	            return redirect()->to('payment/fail?response='.$resp);
                    //return redirect()->to('payment/fail?transaction='.$transactionId);
                }
                
            }else{
                if($check['trsansaction_status'] == '1'){
                    session()->setFlashdata('toastr', ['info'=>'This transaction has already done.']);
                    $responseArray = [
                        'transaction'=>$transactionId??'',
                        'order_id'=>$orderID??'',
                        'amount'=>$amount??''
                    ];
                    $modelLogin = new ApplicationModel('student_login_'.$year, 'sl_id', $this->DBPrifixSSO.$suffix);
                    $y = $modelLogin->set('form_step', 2)->set('payment_status', date("Y-m-d H:i:s"))->where(['sid'=>$sid, 'form_step'=>1])->update();
                    $encrypter = \Config\Services::encrypter();
                    $responseJson = $encrypter->encrypt(json_encode($responseArray));
                    $resp = urlencode(base64_encode($responseJson));
                    return redirect()->to('payment/success?response='.$resp);
                    //return redirect()->to('payment/success?transaction='.$transactionId.'&order_id='.$orderID.'&amount='.$amount);
                }else{
                    session()->setFlashdata('toastr', ['error'=>'kindly retry the payment']);
                    $responseArray = [
	                'transaction'=>$transactionId??'',
	                'order_id'=>$orderID??'',
	                'amount'=>$amount??''
	            ];
	            $encrypter = \Config\Services::encrypter();
	            $responseJson = $encrypter->encrypt(json_encode($responseArray));
	            $resp = urlencode(base64_encode($responseJson));
	            return redirect()->to('payment/fail?response='.$resp);
                    // return redirect()->to('payment/fail?transaction='.$transactionId.'&order_id='.$orderID.'&amount='.$amount);
                }
            }
        } else if ($order_status === "Failure") {
            // Call Success function
            $sid = $responseData['merchant_param1'];
            $dbDetail = $this->getYEARDBHELPER($sid??'');
            $year = $dbDetail['year'];
            $suffix = $dbDetail['suffix'];
            $model = new ApplicationModel('registration_fees_status_'.$year, 'rfs_id', $this->DBPrifixSSO.$suffix);
            $transactionId = $responseData['tracking_id'];
            $amount = $responseData['amount']??'Not Given';
            $orderID = $responseData['order_id'];
            $check = $model->select(['trsansaction_status','rfs_id'])->where(['order_id'=>$responseData['order_id'], 'trsansaction_id'=>$responseData['tracking_id']])->first();
            if(!$check){
                $registrationData = [
                    'order_id'=>$responseData['order_id'],
                    'trsansaction_id'=>$responseData['tracking_id'],
                    'bank_ref_no'=>$responseData['bank_ref_no']??null,
                    'trsansaction_status'=>0,
                    'payment_response'=>json_encode($responseData??[]),
                ];
                $x = $model->insert($registrationData);
                session()->setFlashdata('toastr', ['error'=>'Your transaction is fail. Kindly please re-try the payment.']);
	            $responseArray = [
	                'transaction'=>$transactionId??'',
	                'order_id'=>$orderID??'',
	                'amount'=>$amount??''
	            ];
	            $encrypter = \Config\Services::encrypter();
	            $responseJson = $encrypter->encrypt(json_encode($responseArray));
	            $resp = urlencode(base64_encode($responseJson));
	            return redirect()->to('payment/fail?response='.$resp);
                //  return redirect()->to('payment/fail?transaction='.$transactionId.'&order_id='.$orderID.'&amount='.$amount);
            }else{
                if($check['trsansaction_status'] == '1'){
                    session()->setFlashdata('toastr', ['info'=>'This transaction has already done.']);
                    $responseArray = [
                        'transaction'=>$transactionId??'',
                        'order_id'=>$orderID??'',
                        'amount'=>$amount??''
                    ];
                    $encrypter = \Config\Services::encrypter();
                    $responseJson = $encrypter->encrypt(json_encode($responseArray));
                    $resp = urlencode(base64_encode($responseJson));
                    return redirect()->to('payment/success?response='.$resp);
                    // return redirect()->to('payment/success?transaction='.$transactionId.'&order_id='.$orderID.'&amount='.$amount);
                }else{
                    session()->setFlashdata('toastr', ['error'=>'Your transaction is fail. Kindly please re-try the payment.']);
                    $responseArray = [
	                'transaction'=>$transactionId??'',
	                'order_id'=>$orderID??'',
	                'amount'=>$amount??''
	            ];
	            $encrypter = \Config\Services::encrypter();
	            $responseJson = $encrypter->encrypt(json_encode($responseArray));
	            $resp = urlencode(base64_encode($responseJson));
	            return redirect()->to('payment/fail?response='.$resp);
                    // return redirect()->to('payment/fail?transaction='.$transactionId.'&order_id='.$orderID.'&amount='.$amount);
                }
            }
        } else if ($order_status === "Aborted") {
            $transactionId = 'Cancel by user';
            $amount = $responseData['amount']??'Not Given';
            $orderID = $responseData['order_id'];
            session()->setFlashdata('toastr', ['error'=>'Your transaction is fail. Kindly please re-try the payment.']);
            $responseArray = [
                'transaction'=>$transactionId??'',
                'order_id'=>$orderID??'',
                'amount'=>$amount??''
            ];
            $encrypter = \Config\Services::encrypter();
            $responseJson = $encrypter->encrypt(json_encode($responseArray));
            $resp = urlencode(base64_encode($responseJson));
            return redirect()->to('payment/fail?response='.$resp);
            
            // return redirect()->to('payment/fail?transaction='.$transactionId.'&order_id='.$orderID.'&amount='.$amount);
        }else {
            $transactionId = 'invalid';
            $amount = $responseData['amount']??'Not Given';
            $orderID = $responseData['order_id']??'Not available';
            session()->setFlashdata('toastr', ['error'=>'Your transaction is fail. Kindly please re-try the payment.']);
            $responseArray = [
                'transaction'=>$transactionId??'',
                'order_id'=>$orderID??'',
                'amount'=>$amount??''
            ];
            $encrypter = \Config\Services::encrypter();
            $responseJson = $encrypter->encrypt(json_encode($responseArray));
            $resp = urlencode(base64_encode($responseJson));
            return redirect()->to('payment/fail?response='.$resp);
            // return redirect()->to('payment/fail?transaction='.$transactionId.'&order_id='.$orderID.'&amount='.$amount);
        }
    }

    public function success()
    {   
        $data = [];
        if ((session('isLoggedInAdmin') xor session('isLoggedIn'))){
            //return redirect()->to('/');
            $data['redirectUrl'] = base_url('/');
        }else{
            $data['redirectUrl'] = base_url('/');
        }
        
        try {
            $encrypter = \Config\Services::encrypter();
            $response = json_decode($encrypter->decrypt(base64_decode(($_GET['response']))),true);
            $data['transaction'] = isset($response['transaction'])?$response['transaction']:'Not Available';
                $data['order_id'] = isset($response['order_id'])?$response['order_id']:'Not Available';
                $data['amount'] = isset($response['amount'])?$response['amount']:'Not Available';
            
        } catch (\Throwable $th) {
            session()->setFlashdata('toastr', ['error'=>'Something Went Wrong']);
            $data['transaction'] = 'Not Available';
                $data['order_id'] = 'Not Available';
                $data['amount'] = 'Not Available';
            //return redirect()->withInput()->back();
        }
        
        return view('payment/success', $data);
    }

    public function fail()
    {
    	
        $data = [];
        if ((session()->get('isLoggedInAdmin') xor session()->get('isLoggedIn'))){
            //return redirect()->to('/');
            $data['redirectUrl'] = base_url('/');
        }else{
            $data['redirectUrl'] = base_url('/');
        }
        
        try {
            $encrypter = \Config\Services::encrypter();
            //print($_GET['response']); die;
            $response = json_decode($encrypter->decrypt(base64_decode(($_GET['response']))),true);
            $data['transaction'] = isset($response['transaction'])?$response['transaction']:'Not Available';
                $data['order_id'] = isset($response['order_id'])?$response['order_id']:'Not Available';
                $data['amount'] = isset($response['amount'])?$response['amount']:'Not Available';
            
        } catch (\Throwable $th) {
            session()->setFlashdata('toastr', ['error'=>'Something Went Wrong']);
            $data['transaction'] = 'Not Available';
                $data['order_id'] = 'Not Available';
                $data['amount'] = 'Not Available';
            //return redirect()->withInput()->back();
        }
        // $data['transaction'] = isset($_GET['transaction'])?$_GET['transaction']:'';
        // $data['order_id'] = isset($_GET['order_id'])?$_GET['order_id']:'Not Available';
        //$data['amount'] = isset($_GET['amount'])?$_GET['amount']:'Not Available';
        return view('payment/fail', $data);
    }

    
}

