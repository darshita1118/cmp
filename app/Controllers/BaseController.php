<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use function App\Helpers\getHelper;
use CodeIgniter\Database\BaseBuilder;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest|CLIRequest
     */
    protected $request;
    

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'text', 'form', 'array', 'date', 'DBHelper', 'uri', 'Query'];

    /**
     * Constructor.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param LoggerInterface   $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.: $this->session = \Config\Services::session();
        //getHelper();
        //session();
    }

    protected function SendMessageApi($mobile = false, $sms_text = false, $template = false, $type = 'text')
    {
        return true;
        if ($mobile !== false && $sms_text !== false) {
            $api_key = '464A8DB1B3AF15';
            $from = 'SGYNVR';
            $entity = '1701168853516071446';

            $temId = $template;
            $contacts = $mobile;

            if ($type == 'unicode') {
                $sms_text = utf8_encode($sms_text);
            }

            $message = urlencode($sms_text);
            
            $api_url = "https://www.proactivesms.in/sendsms.jsp?user=sgvualka&password=9500add555XX&senderid=" . $from . "&mobiles=" . $contacts . "&sms=$message&tempid=$temId";

            // $api_url = "http://indiaitinfotech.com/app/smsapi/index.php?key=" . $api_key . "&entity=$entity&tempid=$temId&routeid=612&type=$type&contacts=" . $contacts . "&senderid=" . $from . "&msg=" . $message;
            $response = file_get_contents($api_url);
            //dd($response);
            //if (strpos($response, 'SMS-SHOOT-ID') !== false) {
            if (strpos($response, '<status>success</status>') !== false) {
                return true;
            }
        }
        
        return false;

    }
    protected function sendMailer($data)
    {
        return true;

        $email = \Config\Services::email();
        $config = array(
            'protocol'=>'smtp',
			'SMTPHost'=>'103.20.213.86',
			'SMTPUser'=>'support@gbs.mba',
			'SMTPPass'=>'x9xhZasv4EeZdQY',
			'SMTPPort'=>587,
			'SMTPCrypto'=>'',
			'mailType'=>'html',
			'SMTPTimeout'=>40,
        );
        /*
        $config = array(
		'protocol'=>'smtp',
		'SMTPHost'=>'mail.seekho.live',
		'SMTPUser'=>'connect@seekho.live',
		'SMTPPass'=>'Seekho@123',
		'SMTPPort'=>587,
		'SMTPCrypto'=>'',
		'mailType'=>'html',
		'SMTPTimeout'=>40,
	    );*/
        $email->initialize($config);

        
        $email->setFrom('admissions@mygyanvihar.com', 'Suresh Gyan Vihar University');
        $email->setTo($data['senderDetail']['email']);
        //$email->setTo('aakash.kumawat@mygyanvihar.com');
        // do template string
        if (!empty($data['attachment']) && isset($data['attachment'])) {
            $email->attach(base_url('/assets/uploads/emailattachments/' . $data['attachment']['upload_file_name']), 'attachment', $data['attachment']['attachment_name']);
        }
        
        //$email->setCC('naveen1.sharma@mygyanvihar.com');
        //$email->setBCC('them@their-example.com');
        $message = view($data['email']['view'],$data['senderDetail']);
        
        if(isset($data['email']['replyto']) && !empty($data['email']['replyto'])){
            $email->setReplyTo($data['email']['replyto'], $data['email']['replytoname']??'');
        }
        $email->setSubject($data['email']['subject']);
        $email->setMessage($message);
        $email->setPriority(1);

        if ($email->send()) {
            return true;
        }
        
        return false;

    }

    protected function generateSid($nationality=1): array
    {
	    	$detail = getHelper();
    		
	    	if(!$detail){
	    		session()->setFlashdata('toastr', ['error'=>'Session '.session('year').'-'.(session('year')+1).' admission has been close.']);
	           	return [];
	        }
	        $admin = new ApplicationModel('student_login_' . $detail['start_year'], 'sl_id', $detail['admission_db_name']);
		$lastLoginId = $admin->select(['sl_id'])->orderBy('sl_id', 'DESC')->first();
		$sid = ($lastLoginId['sl_id'] ?? 0) + 45001;
		$pass = random_string('alnum', 6);
		$sidData = [
		    'sid' => substr($detail['start_year'], -2) . $sid,
		    'password' => base64_encode($pass),
		    'sl_session' => $detail['start_year'],
		    'form_step' => 1,
		    'sid_type' =>session('admission_source')?? 1,
		    'student_reg_fee_id'=>$nationality,
		];
		
		$x = $admin->save($sidData) ? $sidData : [];
		if($x){
			$sidData['password'] = $pass;
			return $sidData;
		}
		return [];
    }

    protected function getDBSuffix()
    {
        //session()->set('db_suffix','2021_2025');
        return '2021_25';
    }

    public function testView($folder = 'email/handler', $file='email')
    {
        $linkData = [
            'id'=>$user['hid']??1,
            'email'=>$user['handler_email']??'aakash.kumawat@mygyanvihar.com',
            'suffix'=>$db_suffix??$this->getDBSuffix(),
            'year'=>$this->request->getVar('year')??'2022',
            'expireTimestamp'=>time()+3600,
            'time'=>time()
        ];
        $jsonString = json_encode($linkData);
        $baseEncode = base64_encode($jsonString);
        $link = urlencode($baseEncode);

        $senderDetail = [
            'email'=>$postData['email']??'aakash.kumawat@mygyanvihar.com',
            'link'=>base_url('/reset-password/'.$link),
        ];
        return view($folder.'/'.$file, $senderDetail);
    }
    protected function getDBDetail($sid)
    {
        $data = false;
        try {
            $year = substr($sid, 0, 2);
            $div = intdiv($year, 5);
            $startyear = ($div * 5) + 2001;
            $endyear = ($div * 5) + 2005;
            //$startyear = substr($startyear, -2);
            $endyear = substr($endyear, -2);
            $sessionyear = 2000 + $year;
            return ['startyear'=>$startyear, 'endyear'=>$endyear, 'sessionyear'=>$sessionyear];
        } catch (\Throwable $th) {
            return $data;
        }
        
    }
    
    protected function lmsDB($val) {
        $data = [];
        for ($j=5; $j > 0 ; --$j) { 
            $startYear = $val - $j;
            if($startYear%5 == 0){
                $data['start_year'] = $startYear+1;
                break;
            }
        }
        for ($i=0; $i <5 ; $i++) { 
            $endYear = $val + $i;
            if($endYear%5 == 0){
                $data['end_year'] = substr($endYear, 2);
                break;
            }
        }        
        return implode('_',$data);
    }
    
    public function changePass()
    {
        return password_hash("2024@CMP@123", PASSWORD_DEFAULT);
    }
    
    protected function getYEARDBHELPER($sid)
    {
        try {
            $year = substr($sid, 0, 2);
            $div = intdiv($year, 5);
            $startyear = ($div * 5) + 2001;
            $endyear = ($div * 5) + 2005;
            //$startyear = substr($startyear, -2);
            $endyear = substr($endyear, -2);
            $suffix = $startyear.'_'.$endyear;
            $sessionyear = 2000 + $year;
            return ['year'=>$sessionyear, 'suffix'=>$suffix];
        } catch (\Throwable $th) {
            return ['year'=>'2022', 'suffix'=>'2021_25'];
        }
        
    }

    protected function getValidationRulesAndErrors($request, $requestType, $extraDetail=[]):array
    {
        if($requestType == 'schedule-meeting'){
            $rules = [
				'cdate' => 'required|valid_date'
			];
			$errors = [
				'cdate' => [
					'required' => "Please Enter Date & Time.",
					'valid_date' => "Date & Time should be in valid format."
				],
			];
            return ['rules'=>$rules, 'errors'=>$errors];
        }

        if($requestType == 'career-counseling'){
            $rules = [
                'feedback' => 'required|in_list[1,2,3,4,5]'
            ];
            $errors = [
                'feedback' => [
                    'required' => "Please select feedback.",
                    'in_list' => "Feedback should be given from given list."
                ],
            ];
            return ['rules'=>$rules, 'errors'=>$errors];
        }

        if($requestType == 'profile-detail'){
            $rules = [
                'medium'=>'required|numeric',
                'discipline'=>'required|numeric',
                'program'=>'required|numeric',
                'course_type'=>'required',
                'firstname'=>'required|min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]',
                'sex'=>'required|in_list[0,1,2]',
                'dob'=>'required|string',
                'religion'=>'required|numeric',
                'cat'=>'required|numeric',
                'id_type'=>'required|in_list[1,2,3,4,5]',
            ];

            if($request->getVar('id_type')==1){
                $rules['sip_no'] = 'required|regex_match[/^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$/]';
            }
            if($request->getVar('id_type')==2){
                $rules['sip_no'] = 'required|regex_match[/^([a-zA-Z]){3}([0-9]){7}$/]';
            }
            if($request->getVar('id_type')==3){
                $rules['sip_no'] = 'required|regex_match[/^([a-zA-Z]){2}([0-9]){13}$/]';
            }
            if($request->getVar('id_type')==4){
                $rules['sip_no'] = 'required|regex_match[/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}$/]';
            }
            if($request->getVar('middlename') != ''){
                $rules['middlename'] = 'min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]';
            }
            if($request->getVar('lastname') != ''){
                $rules['lastname'] = 'min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]';
            }
            if($request->getVar('landline') != ''){
                $rules['landline'] = 'min_length[6]|max_length[10]|numeric';
            }
            $errors = [
                'medium'=>[
                    'required'=>'Please select a Medium.',
                    'numeric'=>'Your Selected Medium is not Valid.'
                ],
                'discipline'=>[
                    'required'=>'Please Provide a valid department.',
                    'numeric'=>'Your Selected option is not Valid.'
                ],
                'program'=>[
                    'required'=>'Please Provide a valid Program.',
                    'numeric'=>'Your Selected option is not Valid.'
                ],
                'firstname' => [
                    'required' => 'First Name is required.',
                    'min_length' => 'First Name minimum lenght has been 3.',
                    'max_length' => 'First Name maximum lenght has been 255.',
                    'regex_match'=>'First Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)',
                ],
                'lastname' => [
                    'min_length' => 'Last Name minimum lenght has been 3.',
                    'max_length' => 'Last Name maximum lenght has been 255.',
                    'regex_match'=>'Last Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)',
                ],
                'middlename' => [
                    'min_length' => 'Middle Name minimum lenght has been 3.',
                    'max_length' => 'Middle Name maximum lenght has been 255.',
                    'regex_match'=>'Middle Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)',
                ],
                'sex'=>[
                    'required'=>'Please select a gender.',
                    'in_list'=>'Please select a valid gender.'
                ],
                'dob'=>[
                    'required'=>'Please select a date.',
                    'string'=>'Your Date of Birth not in String.'
                ],
                'religion'=>[
                    'required'=>'Please Provide a valid Religion.',
                    'numeric'=>'Your Selected option is not Valid.'
                ],
                'cat'=>[
                    'required'=>'Please Provide a valid Caste.',
                    'numeric'=>'Your Selected option is not Valid.'
                ],
                'landline'=>[
                    'numeric'=>'Landline only support digits.',
                    'min_length'=>'Landline Support minimum 6 digit length.',
                    'max_length'=>'Landline Support minimum 10 digit length.',
                ],
                'course_type'=>[
                    'required'=>'Something Went Wrong.',
                ],
                'id_type'=>[
                    'required'=>'Please Select ID Type.',
                    'in_list'=>'Please select a valid ID Type.',
                ],
                'sip_no'=>[
                    'required'=>'Please Enter ID No.',
                    'regex_match'=>'Plase Enter Correct ID No.',
                ]
            ];

            return ['rules'=>$rules, 'errors'=>$errors];

        }
        if($requestType == 'parent-detail'){
            $rules = [
                'father_name'=>'required|min_length[3]|max_length[255]|alpha_space',
                'mother_name'=>'required|min_length[3]|max_length[255]|alpha_space',
                'father_income'=>'required|numeric',
                //'mother_income'=>'required|numeric',
                //'mother_occupation'=>'required|max_length[255]|alpha_space',
                'father_occupation'=>'required|max_length[255]|alpha_space',
                //'parent_email'=>'required|valid_email',
                //'parent_mobile'=>'required|min_length[8]|max_length[13]|numeric'
            ];
            $errors = [
                'father_name' => [
                    'required' => 'Father Name is required.',
                    'min_length' => 'Father Name minimum lenght has been 3.',
                    'max_length' => 'Father Name maximum lenght has been 255.',
                    'alpha_space' => 'Father Name is support Alphabets and white Space.',
                ],
                'father_occupation'=>[
                    'required' => 'Father Occupation is required.',
                    'max_length' => 'Father Occupation maximum lenght has been 255.',
                    'alpha_space' => 'Father Occupation is support Alphabets and white Space.',
                ],
                'father_income'=>[
                    'numeric'=>'Fateher\'s Income only support digits.',
                    'required'=>'Fateher\'s Income is required.',
                    
                ],
                'mother_name' => [
                    'required' => 'Mother Name is required.',
                    'min_length' => 'Mother Name minimum lenght has been 3.',
                    'max_length' => 'Mother Name maximum lenght has been 255.',
                    'alpha_space' => 'Mother Name is support Alphabets and white Space.',
                ],
                'mother_occupation'=>[
                    'required' => 'Mother\'s Occupation is required.',
                    'max_length' => 'Mother\'s Occupation maximum lenght has been 255.',
                    'alpha_space' => 'Mother\'s Occupation is support Alphabets and white Space.',
                ],				
                'mother_income'=>[
                    'numeric'=>'Mother\'s Income only support digits.',
                    'required'=>'Mother\'s Income is required.',
                    
                ],
                'parent_email'=>[
                    'required'=>'Parent Email is required.',
                    'valid_email'=>'Please provide a valid email address.'
                ],
                'parent_mobile'=>[
                    'required'=>'Parent mobile number is required.',
                    'min_length' => 'Parent mobile number minimum lenght has been 8.',
                    'max_length' => 'Parent mobile number maximum lenght has been 13.',
                    'numeric'=>'Parent mobile number only support digits.'
                ]
            ];
            return ['rules'=>$rules, 'errors'=>$errors];
        }
        if($requestType == 'address-detail'){
            $rules = [
                'country'=>'required|min_length[3]|max_length[255]|string',
                'state'=>'required|min_length[3]|max_length[255]|string',
                'district'=>'required|max_length[255]|string',
                'street_address'=>'required|max_length[255]|string',
                'zipcode'=>'required|min_length[4]|max_length[6]|numeric'
            ];
            if($request->getVar('same') != '1'){
                $rules = [
                    'country'=>'required|max_length[255]|string',
                    'state'=>'required|max_length[255]|string',
                    'district'=>'required|max_length[255]|string',
                    'street_address'=>'required|max_length[255]|string',
                    'zipcode'=>'required|min_length[4]|max_length[8]|numeric',
                    'country1'=>'required|max_length[255]|string',
                    'state1'=>'required|max_length[255]|string',
                    'district1'=>'required|max_length[255]|string',
                    'street_address1'=>'required|max_length[255]|string',
                    'zipcode1'=>'required|min_length[4]|max_length[8]|numeric'
                ];
            }

            $errors = [
                'country' => [
                    'required' => 'Country is required.',
                    'max_length' => 'Country maximum lenght has been 255.',
                    'string' => 'Country should be a string.',
                ],
                'country1' => [
                    'required' => 'Country is required.',
                    'max_length' => 'Country maximum lenght has been 255.',
                    'string' => 'Country should be a string.',
                ],
                'state' => [
                    'required' => 'State is required.',
                    'max_length' => 'State maximum lenght has been 255.',
                    'string' => 'State should be a string.',
                ],
                'state1' => [
                    'required' => 'State is required.',
                    'max_length' => 'State maximum lenght has been 255.',
                    'string' => 'State should be a string.',
                ],
                'district' => [
                    'required' => 'District is required.',
                    'max_length' => 'District maximum lenght has been 255.',
                    'string' => 'District should be a string.',
                ],
                'district1' => [
                    'required' => 'District is required.',
                    'max_length' => 'District maximum lenght has been 255.',
                    'string' => 'District should be a string.',
                ],
                'street_address' => [
                    'required' => 'Street address is required.',
                    'max_length' => 'Street address maximum lenght has been 255.',
                    'string' => 'Street address should be a string.',
                ],
                'street_address1' => [
                    'required' => 'Street address is required.',
                    'max_length' => 'Street address maximum lenght has been 255.',
                    'string' => 'Street address should be a string.',
                ],
                'zipcode'=>[
                    'required'=>'Permanent zipcode is required.',
                    'min_length' => 'Permanent zipcode minimum lenght has been 4.',
                    'max_length' => 'Permanent zipcode maximum lenght has been 8.',
                    'numeric'=>'Permanent zipcode only support digits.'
                ],
                'zipcode1'=>[
                    'required'=>'Zipcode is required.',
                    'min_length' => 'Zipcode minimum lenght has been 4.',
                    'max_length' => 'Zipcode maximum lenght has been 8.',
                    'numeric'=>'Zipcode only support digits.'
                ]
            ];
            return ['rules'=>$rules, 'errors'=>$errors];
        }
        if($requestType == 'academic-detail'){
            $rules = [];
            $errors = [];
            if($request->getPost('awaited')=='on'){
                array_pop($extraDetail);
            }
            foreach ($extraDetail as $level) {
                $rules['board'.$level['el_id']] = 'required|max_length[255]|alpha_space';
                $rules['inst_name'.$level['el_id']] = 'required|max_length[255]|alpha_space';
                $rules['year'.$level['el_id']] = 'required|valid_date[Y]|numeric|exact_length[4]';
                $rules['max_marks'.$level['el_id']] = 'required|numeric|max_length[4]';
                $rules['obtained'.$level['el_id']] = 'required|numeric|max_length[4]|required_with[max_marks'.$level['el_id'].']';
                $rules['resulttype'.$level['el_id']] = 'required|in_list[0,1]|numeric';
                $rules['percentage'.$level['el_id']] = 'required|numeric|less_than_equal_to[100]';

                $errors['board'.$level['el_id']] = [
                    'required'=>'Board/University name is required.',
                    'max_length'=>'Board/University name has maximum length 255 charactors.',
                    'alpha_space'=>'Board/University name is contain only alphabets and space.'
                ];
                $errors['inst_name'.$level['el_id']] = [
                    'required'=>'Institude/School name is required.',
                    'max_length'=>'Institude/School name has maximum length 255 charactors.',
                    'alpha_space'=>'Institude/School name is contain only alphabets and space.'
                ];
                $errors['year'.$level['el_id']] = [
                    'required'=>'Passing year is required.',
                    'valid_date'=>'Passing year is not valid.',
                    'numeric'=>'Passing year contain only digits.',
                    'exact_length'=>'Passing year has exact length 4 digits.'
                ];
                $errors['max_marks'.$level['el_id']] = [
                    'required'=>'Maximum mark is required.',
                    'numeric'=>'Maximum mark contain only digits.',
                    'max_length'=>'Maximum mark has maximum length 4 digits.'
                ];
                $errors['obtained'.$level['el_id']]=[
                    'required'=>'Obtained mark is required.',
                    'numeric'=>'Obtained mark contain only digits.',
                    'max_length'=>'Obtained mark has maximum length 4 digits.',
                    'required_with'=>"Please provide the maximum mark first."
                ];
                $errors['resulttype'.$level['el_id']]=[
                    'required'=>'Result type is required.',
                    'numeric'=>'Selected result type is not valid.',
                    'in_list'=>'Selected result type is not valid.'
                ];
                $errors['percentage'.$level['el_id']] = [
                    'required'=>'Percentage/Grade is required.',
                    'numeric'=>'Percentage/Grade contain only digits.',
                    'less_than_equal_to'=>'Percentage/Grade is not valid.'
                ];
            }
            return ['rules'=>$rules, 'errors'=>$errors];
        }
        if($requestType == 'upload-doc'){
            $in_list = $extraDetail['inlist']??'';
            $rules = [
				'document_type' => "required|in_list[$in_list]",
				'document' => 'uploaded[document]',
			];
            /*$size = '2mb';
			
			if(in_array($mimeType??'', ['image/jpg','image/jpeg','image/gif','image/png']) !== false){
				$rules['document'] .= '|max_size[document,516]';
				$size = '500kb';
			}else if(in_array($mimeType??'', ['application/pdf']) !== false){
				$rules['document'] .= '|max_size[document,2048]';
			}else{
				$rules['document'] .= '|max_size[document,2048]';
			}
            */
			$mimeType = $request->getFile('document')->getMimeType();

            if($request->getVar('document_type') == 6){
				$rules['document'] .= '|mime_in[document,application/pdf,image/jpg,image/jpeg,image/gif,image/png]';
				$r = 'Document accept these mime types image/jpg, image/jpeg, and image/png only.';
				if($mimeType =='application/pdf'){
					$rules['document'] .= '|max_size[document,2048]';
					$size = '2MB';
				}else{
					$rules['document'] .= '|max_size[document,516]';
					$size = '500kb';
				}
			}else{
				$rules['document'] .= '|mime_in[document,image/jpg,image/jpeg,image/gif,image/png]|max_size[document,516]';
				$r = 'Document accept these mime types image/jpg, image/jpeg, and image/png only.';
				$size = '500kb';
			}
			    $errors = [
						'document_type'=>[
							'required'=>'Document type is required.',
							'in_list'=>'Selected Document type is not valid.',
						],
						'document'=>[
							'uploaded'=>'Please provide a valid document.',
							'mime_in'=>$r,
							'max_size'=>"Document size larger than $size.",
						],
					];
			    return ['rules'=>$rules, 'errors'=>$errors];
		}
		return [];
	}

    	public function skip_counselling($sid = false, $lid = false)
	{
		if (session('isLoggedInAdmin')) {
			$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', 'sso_' . session('suffix'));
			$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
			if (!$lmsRefData) {
				session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
				return redirect()->back();
			}
			$formStepModel = new ApplicationModel('form_steps', 'fs_id', 'sso_' . session('suffix'));
			$group = 2;
			$formSteps = $formStepModel->where(['fs_status' => 1])->whereIn('fs_id', function (BaseBuilder $builder) use ($group) {
				return $builder->select('form_step_id')->from('fromstep_gp_members')->where(['fd_gp_id' => $group]);
			})->orderBy('position', 'ASC')->findAll() ?? [];

			$sidModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', 'sso_' . session('suffix'));
			$getFormStep = $sidModel->select(['form_step', 'password', 'page_name', 'slug', 'position'])->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.position', 'left')->where(['sid' => $sid])->first() ?? [];
			$key = array_search($getFormStep['form_step'], array_column($formSteps, 'fs_id'));
			if ($key === false) {
				session()->setFlashdata('toastr', ['error' => 'Request action is not allow']);
				return redirect()->withInput()->back();
			}

			$nextSlug = '';
			if ((array_key_exists($key + 1, $formSteps)) !== false) {
				$nextSlug = $formSteps[$key + 1]['slug'];
				$nextFormStepStatus = $formSteps[$key + 1]['fs_id'];
			} else {
				$nextFormStepDetail = $formStepModel->where(['fs_status' => 1, 'position>' => $formSteps[$key]['position']])->orderBy('position', 'ASC')->first() ?? [];
				$nextFormStepStatus = $nextFormStepDetail['fs_id'] ?? $getFormStep['form_step'];
			}
			$url = 'admin/process-application/' . $lid . '/' . $sid . '/' . $nextSlug;

			$scModel = new ApplicationModel('student_counselling_' . session('year'), 'sc_id', 'sso_' . session('suffix'));
			$scModel->set(['sc_status' => 5])->where('sid', $sid)->update();
			$slModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', 'sso_' . session('suffix'));
			$sl = $slModel->set(['form_step' => $nextFormStepStatus])->where('sid', $sid)->update();
			if ($sl) {
				session()->setFlashdata('toastr', ['success' => 'Career Counselling Skipped Successfully.']);
				return redirect()->to($url);
			} else {
				session()->setFlashdata('toastr', ['error' => 'Something went wrong. Please try after sometime.']);
				return redirect()->back();
			}
		}else if ((session()->get('usertype') == 'handler' || session()->get('usertype') == 'team-leader' ) && session('isLoggedIn')) {
			if(session()->get('usertype') == 'team-leader'){
				$teamLeaderModel = new ApplicationModel('team_leader_'.session('year'), 'tl_id', $this->lmsDb);
				$teamMembers = $teamLeaderModel->select('handler_id')->where('team_leader', session('id'))->findAll();
				$teamMembers = array_column($teamMembers??[], 'handler_id');
				$teamMembers[] = session('id');
			}else{
				// for handlers
				$teamMembers[] = session('id');
			}
			$lmsReferenceModel = new ApplicationModel('lms_db_reference_'.session('year'), 'lr_id', 'sso_'.session('suffix'));
			$lmsRefData = $lmsReferenceModel->where(['lead_id'=>$lid, 'sid'=>$sid,'handler_id'=>session('id'), 'admin_type'=>session('db_priffix')])->whereIn('handler_id',$teamMembers)->first();
			
			$formStepModel = new ApplicationModel('form_steps', 'fs_id', 'sso_' . session('suffix'));
			$group = 2;
			$formSteps = $formStepModel->where(['fs_status' => 1])->whereIn('fs_id', function (BaseBuilder $builder) use ($group) {
				return $builder->select('form_step_id')->from('fromstep_gp_members')->where(['fd_gp_id' => $group]);
			})->orderBy('position', 'ASC')->findAll() ?? [];

			$sidModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', 'sso_' . session('suffix'));
			$getFormStep = $sidModel->select(['form_step', 'password', 'page_name', 'slug', 'position'])->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.position', 'left')->where(['sid' => $sid])->first() ?? [];
			$key = array_search($getFormStep['form_step'], array_column($formSteps, 'fs_id'));
			if ($key === false) {
				session()->setFlashdata('toastr', ['error' => 'Request action is not allow']);
				return redirect()->withInput()->back();
			}

			$nextSlug = '';
			if ((array_key_exists($key + 1, $formSteps)) !== false) {
				$nextSlug = $formSteps[$key + 1]['slug'];
				$nextFormStepStatus = $formSteps[$key + 1]['fs_id'];
			} else {
				$nextFormStepDetail = $formStepModel->where(['fs_status' => 1, 'position>' => $formSteps[$key]['position']])->orderBy('position', 'ASC')->first() ?? [];
				$nextFormStepStatus = $nextFormStepDetail['fs_id'] ?? $getFormStep['form_step'];
			}
			$url = 'handler/process-application/' . $lid . '/' . $sid . '/' . $nextSlug;

			$scModel = new ApplicationModel('student_counselling_' . session('year'), 'sc_id', 'sso_' . session('suffix'));
			$scModel->set(['sc_status' => 5])->where('sid', $sid)->update();
			$slModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', 'sso_' . session('suffix'));
			$sl = $slModel->set(['form_step' => $nextFormStepStatus])->where('sid', $sid)->update();
			if ($sl) {
				session()->setFlashdata('toastr', ['success' => 'Career Counselling Skipped Successfully.']);
				return redirect()->to($url);
			} else {
				session()->setFlashdata('toastr', ['error' => 'Something went wrong. Please try after sometime.']);
				return redirect()->back();
			}

        	} else {
			session()->setFlashdata('toastr', ['error' => 'Request Action is not Allow.']);
			return redirect()->back();
		}
	}
	public function print($lid = false,  $sid = false)
	{
		if (session('isLoggedInAdmin')) {
			// check first admin this
			$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', 'sso_' . session('suffix'));
			$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
			if (!$lmsRefData) {
				session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
				return redirect()->back();
			}
			return view('admission/print', ['sid' => $sid]);
			
		}else if ((session()->get('usertype') == 'handler' || session()->get('usertype') == 'team-leader' ) && session('isLoggedIn')) {
			
	            if(session()->get('usertype') == 'team-leader'){
	                $teamLeaderModel = new ApplicationModel('team_leader_'.session('year'), 'tl_id', $this->lmsDb);
	                $teamMembers = $teamLeaderModel->select('handler_id')->where('team_leader', session('id'))->findAll();
	                $teamMembers = array_column($teamMembers??[], 'handler_id');
	                $teamMembers[] = session('id');
	            }else{
	                // for handlers
	                $teamMembers[] = session('id');
	            }
	            $lmsReferenceModel = new ApplicationModel('lms_db_reference_'.session('year'), 'lr_id', 'sso_'.session('suffix'));
	            $lmsRefData = $lmsReferenceModel->where(['lead_id'=>$lid, 'sid'=>$sid, 'admin_type'=>session('db_priffix')])->whereIn('handler_id',$teamMembers)->first();
	            if(!$lmsRefData){
	                session()->setFlashdata('toastr', ['error'=>'There no reference from this lead1.']);
	                return redirect()->back();
	            }
	            return view('admission/print', ['sid' => $sid]);
	        }else{
			return redirect()->to('/');
		}
		
	}
	
	public function student_learning_report()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$year = session('year');
		$db = 'sso_' . session('suffix');
		$model = new ApplicationModel('student_info_' . $year, 'si_id', $db);
		$model->select([
			'student_info_' . $year . '.sid',
			'si_first_name',
			'si_middle_name',
			'si_last_name',
			'sci_mobile',
			'sci_email',
			'sci_country_code',
			'dept_name',
			'course_name',
			'dr_name',
			'medium',
			'st_name',
			'grade',
			'(CASE WHEN grade>=0 AND grade<=49 THEN "Slow Learner" WHEN grade >= 50 AND grade <= 89 THEN "Average Learner" else "Advance Learner" END) learner_class',
			'year',
			'institute_school',
			'board_university',
			'el_name'
		])
			->join('student_contact_info_' . $year, 'student_info_' . $year . '.sid=student_contact_info_' . $year . '.sid')
			->join('departments', 'departments.dept_id=student_info_' . $year . '.dept_id')
			->join('session_courses_' . $year, 'session_courses_' . $year . '.sc_id=student_info_' . $year . '.program_id')
			->join('course_info', 'course_info.coi_id=session_courses_' . $year . '.course_id')
			->join('student_login_' . $year, 'student_login_' . $year . '.sid=student_info_' . $year . '.sid')
			->join('desk_role', 'desk_role.dr_step=student_login_' . $year . '.form_step')
			->join('source_type', 'student_login_' . $year . '.sid_type=source_type.st_id')
			->join('cet_report_' . $year, 'student_info_' . $year . '.sid=cet_report_' . $year . '.sid')
			->join('education_level', 'cet_report_' . $year . '.education_level=education_level.el_id')
			->whereIn('admisn_status', [1, 2, 5])
			->where('form_step>', 10);


		$whereInSources = $whereInProgram = $whereInDepartment = $whereSID = $whereInDesk = $whereMedium = $whereDate = false;

		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['si_created_at>'] = date('Y-m-d h:i:s', strtotime($_GET['from']));
		}
		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['si_created_at<'] =  date('Y-m-d h:i:s', strtotime($_GET['to']));
		}

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
			$model->whereIn('sid_type', $whereInSources);
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
			$model->whereIn('program_id', $whereInProgram);
		}
		if (array_filter($_GET['department'] ?? []) != []  && isset($_GET['department'])) {
			$whereInDepartment = $_GET['department'] ?? [];
			$model->whereIn('departments.dept_id', $whereInDepartment);
		}
		if (array_filter($_GET['desk'] ?? []) != []  && isset($_GET['desk'])) {
			$whereInDesk = $_GET['desk'] ?? [];
			$model->whereIn('dr_id', $whereInDesk);
		}


		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
			$model->whereIn('student_reg_fee_id', $whereInNationality);
		}

		if (@$_GET['medium'] != '' && isset($_GET['medium']))
			$whereMedium['medium'] = $_GET['medium'];
		if ($whereMedium)
			$model->where($whereMedium);
		if (!empty($_GET['sid']) && isset($_GET['sid']))
			$whereSID['student_info_' . $year . '.sid'] = $_GET['sid'];
		if ($whereSID)
			$model->where($whereSID);

		if ($whereDate)
			$model->where($whereDate);

		$learnerwhere = [
			'slow' => '`grade` BETWEEN "0" AND "49"',
			'average' => '`grade` BETWEEN "50" AND "89"',
			'advance' => '`grade` >= "90"',
		];
		if (!empty($_GET['learner_class']) && in_array($_GET['learner_class'], ['slow', 'average', 'advance'])) {
			$model->where($learnerwhere[$_GET['learner_class']]);
		}

		$data['learner_classes'] = array_keys($learnerwhere);

        $data['total_records'] = $model->countAllResults(false);
		$data['leads'] = $model->orderBy('year', 'DESC')->orderBy('si_id', 'DESC')->paginate(500);
		$data['pager'] = $model->pager;

		$sourceModel = new ApplicationModel('source_type', 'st_id', $db);
		$sources = $sourceModel->select(['st_name', 'st_id'])->where(['st_status' => 1])->findAll();

		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $db);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];
		$data['sources'] = $sources ?? [];

		$courseModel = new ApplicationModel('course_info', 'coi_id', $db);
		$data['courses'] = $courseModel->select(['course_name', 'course_code', 'dept_id', 'coi_id', 'level_id'])->where(['course_delete_status' => 0])->findAll();

		$deptModel = new ApplicationModel('departments', 'dept_id', $db);
		$data['departments'] = $deptModel->select(['dept_name', 'dept_id'])->where(['dept_status' => 1, 'dept_delete_status' => 0])->findAll();

		$drModel = new ApplicationModel('desk_role', 'dr_id', $db);
		$data['desks'] = $drModel->select(['dr_name', 'dr_id'])->where(['dr_step!=' => 0, 'dr_status' => 1])->findAll();

		$data['pagename'] = 'admin/student-learning-report';
		return view('admin/index', $data);
	}
    
}
