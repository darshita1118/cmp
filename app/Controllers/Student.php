<?php

namespace App\Controllers;
use  App\Controllers\BaseController;
use App\Models\ApplicationModel;
use CodeIgniter\API\ResponseTrait;
use function App\Helpers\getHelper;
/**
 * Class Student
 *
 * Student provides a convenient place for proccess operation by student own to complete the Admission
 * 1. payment
 * 2. profile
 *     a. personal
 * 	   b. Family
 *     c. Residential
 * 3. Academiea
 * 4. Document
 * 5. Review
 *
 * 
 */

class Student extends BaseController
{
	use ResponseTrait;
	public function index()
	{
		
		$data = [];
		$data['pagename'] = 'student/home';
		return view('student/index', $data);
	}
	public function payment()
	{
		return view('student/application');
	}

	

	public function apply_now()
	{
		//return password_hash('GinqeT', PASSWORD_DEFAULT);
		
		$data = [];
		helper('DBHelper');
		getHelper();
		if($this->request->getMethod() == 'post' && $this->request->getVar('btntype') == 'sid_create'){
			$postData = $this->request->getPost();
			$rules = [
				'email' => "required|max_length[255]|valid_email|is_unique_email[email]",
        		'mobile' => "required|is_natural_no_zero|min_length[8]|max_length[12]|is_unique_mobile[mobile]",
				'country_code'=>'required|min_length[1]|max_length[4]',
				'firstname'=>'required|min_length[3]|max_length[255]',
				'course'=>'required|is_natural_no_zero',
				'level'=>'required|is_natural_no_zero',
				'department'=>'required|is_natural_no_zero',
			];
			if($this->request->getVar('middlename')){
				$rules['middlename'] ='min_length[1]|max_length[255]';
			}
			if($this->request->getVar('lastname')){
				$rules['lastname'] ='min_length[1]|max_length[255]';
			}
			
			$errors = [
				'email'=>[
					'is_unique_email' => 'Your Mail Id  is already registered.',
					'valid_email' => 'Your Mail Id is not valid.',
					'max_length' => 'Mail Id maxinmum Lenght support 255 charactor.',
					'required' => 'Mail Id is required.',
				],
				'mobile'=>[
					'is_unique_mobile' => 'Your Mobile Number is already registered.',
					'max_length' => 'Mobile Number has been maxinmum lenght 12.',
					'min_length' => 'Mobile Number has been minimum lenght 8.',
					'required' => 'Mobile Number is Required.',
					'is_natural_no_zero'=>"Mobile Number is not start with zero."
				],
				'firstname'=>[
					'max_length' => 'First Name has been maxinmum lenght 255.',
					'min_length' => 'First Name has been minimum lenght 3.',
					'required' => 'First Name is required.',
				],
				'lastname' => [
					'max_length' => 'Last Name has been maxinmum lenght 255.',
					'min_length' => 'Last Name has been minimum lenght 1.',
				],
				'middlename' => [
					'max_length' => 'Middle Name has been maxinmum lenght 255.',
					'min_length' => 'Middle Name has been minimum lenght 1.',
				],
				'course' => [
					'required' => 'Course is required.',
					'is_natural_no_zero'=>"Course is not start with zero."
				],
				'level' => [
					'required' => 'Course Level is required.',
					'is_natural_no_zero'=>"Course Level is not start with zero."
				],
				'department' => [
					'required' => 'Course Desipline is required.',
					'is_natural_no_zero'=>"Course Desipline is not start with zero."
				],
				'country_code'=>[
					'max_length' => 'Country Code has been maxinmum lenght 4.',
					'min_length' => 'Country Code has been minimum lenght 1.',
					'required' => 'Country Code is required.',
				],
			];

			if(!$this->validate($rules, $errors)){
				$data['validation'] = $this->validator;
				if(url_is('api*')){
					$validation =  \Config\Services::validation();
        			$er = $validation->getErrors();
        			return $this->respond(['insertstatus' => false, 'msg' => 'lead insert fail', 'errs' => $er], 200);
				}
			}else{
				$admin = new ApplicationModel('student_contact_info_'.session('current')['s2'],'sci_id',session('current')['s1']);
				
				$contactData = [
					'sci_mobile'=>$postData['mobile'],
					'sci_email'=>$postData['email'],
					'sci_country_code'=>$postData['country_code'],
					'sci_delete_status' => 0
				];
				$checkDelete = $admin->select(['sci_id','sid'])->where(['sci_mobile'=>$postData['mobile'],				'sci_email'=>$postData['email']])->where('sci_delete_status',1)->first();
				if($checkDelete){
					$contactData['sci_id'] = $checkDelete['sci_id'];
					$x = $admin->save($contactData);
					if ($x) {
						// get sid detail
						$sidModel = new ApplicationModel('student_login_'.session('current')['s2'],'sl_id',session('current')['s1']);
						$sidDetail = $sidModel->select(['password','sid','sid_type','sl_session','form_step'])->where('sid',$checkDelete['sid'])->first();
						if($sidDetail){
							$data['sidDetail'] = $sidDetail;
							if(url_is('api*')){
								return $this->respond(['insertstatus' => true, 'msg' => 'insert Successfully', 'data'=>$sidDetail], 200);
							}else{
								$senderDetail = [
									'email'=>$postData['email'],
									'sid'=>$sidDetail['sid'],
									'password'=>$sidDetail['password'],
								];
								$email = [
									'view'=>'email/student/email',
									'from'=>'aakash.kumawat@mygyanvihar.com',
									'subject'=>'Welcome To Suresh Gyan Vihar University [leadform]',
									'replyto'=>'admissions@mygyanvihar.com',
									'replytoname'=>'Admissions Team',
								];
				
								$this->sendMailer(['email'=>$email, 'senderDetail'=>$senderDetail]);
								// send SMS and Email Here
								session()->setFlashdata('toastr', ['success'=>'Your Sid Has Been Created Successfully']);
								return redirect()->withInput()->back();
							}
						}else{
							if(url_is('api*')){
								return $this->respond(['insertstatus' => false, 'msg' => 'Something Went Wrong'], 200);
							}else{
								return redirect()->withInput()->back();
							}
						}
					}else{
						if(url_is('api*')){
							return $this->respond(['insertstatus' => false, 'msg' => 'Something Went Wrong'], 200);
						}else{
							session()->setFlashdata('toastr', ['danger'=>'Something Went Wrong']);
							return redirect()->withInput()->back();
						}
					}
				}

				// generated sid here
				$getSidDetail = $this->generateSid();
				if(!empty($getSidDetail)){
					$sid = $getSidDetail['sid'];
					$contactData['sid'] = $sid;
					$studentInfoData = [
						'sid'=>$sid,
						'si_first_name'=>$postData['firstname']??'',
						'si_middle_name'=>$postData['middlename']??'',
						'si_last_name'=>$postData['lastname']??'',
						'program_id'=>$postData['course']??'',
						'dept_id'=>$postData['department']??'',
						'si_course_level'=>$postData['level']??'',
						'dd'=>date('d'),
						'mm'=>date('m'),
						'yy'=>date('Y'),
					];

					$studentInfoModel = new ApplicationModel('student_info_'.session('current')['s2'], 'si_id', session('current')['s1']);
					$y = $studentInfoModel->save($studentInfoData);
					$x = $admin->save($contactData);
					if($x && $y){
						$data['sidDetail'] = $getSidDetail;
						if(url_is('api*')){
							return $this->respond(['insertstatus' => true, 'msg' => 'insert Successfully', 'data'=>$getSidDetail], 200);
						}else{
							// send sid and passord
							$senderDetail = [
								'email'=>$postData['email'],
								'sid'=>$sid,
								'password'=>$getSidDetail['password'],
							];
							$email = [
								'view'=>'email/student/email',
								'from'=>'aakash.kumawat@mygyanvihar.com',
								'subject'=>'Welcome To Suresh Gyan Vihar University [leadform]',
								'replyto'=>'admissions@mygyanvihar.com',
								'replytoname'=>'Admissions Team',
							];
			
							$this->sendMailer(['email'=>$email, 'senderDetail'=>$senderDetail]);
							session()->setFlashdata('toastr', ['success'=>'Your Sid Has Been Created Successfully']);
							// set Session
							return redirect()->to('/student/step-4');
						}
					}else{
						session()->setFlashdata('toastr', ['danger'=>'Something Went Wrong']);
						return redirect()->withInput()->back();
					}
				}else{
					if(url_is('api*')){
						return $this->respond(['insertstatus' => false, 'msg' => 'Something Went Wrong'], 200);
					}else{
						session()->setFlashdata('toastr', ['danger'=>'Something Went Wrong']);
						return redirect()->withInput()->back();
					}
				}
			}
		}

		if(url_is('api*')){
			return $this->respond(['insertstatus' => false, 'msg' => 'Required Feilds are Mandentory'], 200);
		}else{
			$data['countries'] = json_decode(file_get_contents('./assets/json/country.json'), true);
			return view('test-view/apply-now', $data);
			//return view('student/application', $data);
		}
		

	}


	
}
