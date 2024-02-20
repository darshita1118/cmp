<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use App\Models\CustomModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\BaseBuilder;
use App\Libraries\CSVReader;
use Dompdf\Dompdf;

class Admin extends BaseController
{
	use ResponseTrait;

	protected $ssoDb;
	protected $lmsDb;
	function __construct()
	{
		$this->ssoDb = SSODB . session('suffix');
		$this->lmsDb = CMPDB . '_' . session('suffix');
	}
	// dashboard key states
	// chart by lead status
	// chart by source
	// figures leads status and source
	// chart by program (Most Choose)
	// chart by status group
	// chart by source group
	// team performace chart
	public function index()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		$data['pagename'] = 'welcome';
		return view('admin/index', $data);
	}

	// admin assign leads
	// update profile
	// update password
	// admin report

	/******************** Handler Operations START *************/
	// create handler or team leader
	public function create_handler()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}

		$data = [];
		if ($this->request->getMethod() == 'post') {
			$postData = $this->request->getPost();
			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_space',
				'email' => 'required|min_length[3]|max_length[255]|valid_email|uniqueHandlerEmail[email]',
				'mobile' => 'required|min_length[8]|max_length[12]|numeric|uniqueHandlerMobile[mobile]',
				'password' => 'required|min_length[8]|max_length[32]',
				'role' => 'required|in_list[0,1]',
				'status' => 'required|in_list[0,1]',
			];
			$errors = [
				'name' => [
					'required' => 'Name is required.',
					'min_length' => 'Name minimum lenght has been 3.',
					'max_length' => 'Name maximum lenght has been 255.',
					'alpha_space' => 'Name is support Alphabets ans white Space.',
				],
				'email' => [
					'required' => 'Mail Id is required.',
					'min_length' => 'Mail Id minimum lenght has been 5.',
					'max_length' => 'Mail Id maximum lenght has been 255.',
					'valid_email' => 'Mail Id is not valid.',
					'uniqueHandlerEmail' => "Mail Id is already present in system"
				],
				'mobile' => [
					'required' => 'Mobile Number is required.',
					'min_length' => 'Mobile Number minimum lenght has been 8.',
					'max_length' => 'Mobile Number maximum lenght has been 12.',
					'numeric' => 'Mobile Number is not valid.',
					'uniqueHandlerMobile' => "Mobile Number is already present in system"
				],
				'password' => [
					'required' => 'Password is required.',
					'min_length' => 'Password minimum lenght has been 8.',
					'max_length' => 'Password maximum lenght has been 32.',

				],
				'role' => [
					'required' => 'Role is required.',
					'in_list' => 'Role is does not exits select box.',
				],
				'status' => [
					'required' => 'Status is required.',
					'in_list' => 'Status is does not exits select box.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err)->back();
			} else {
				$data = [
					'user_email' => $postData['email'],
					'user_mobile' => $postData['mobile'],
					'user_name' => $postData['name'],
					'user_password' => $postData['password'],
					'user_role' => $postData['role'],
					'user_status' => $postData['status'],
					'user_report_to' => session('id'),
					'db_name' => session('db_priffix'),
					'user_source' => session('admission_source') ?? 1,
				];

				$handlerModel =  new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

				$x = $handlerModel->save($data);
				if ($x) {
					$senderDetail = [
						'email' => $postData['email'],
						'name' => $postData['name'],
						'sid' => $postData['email'],
						'password' => $postData['password']
					];
					$email = [
						'view' => 'email/handler/email',
						'from' => session('email'),
						'subject' => 'Welcome To Suresh Gyan Vihar University [leadform]',
						'replyto' => session('email'),
						'replytoname' => session('name'),
					];
					$this->sendMailer(['email' => $email, 'senderDetail' => $senderDetail]);
					session()->setFlashdata('toastr', ['success' => 'Handler Successfully Created']);
					return redirect()->to('/admin/handlers');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}
		$data['pagename'] = 'admin/new-handler';
		return view('admin/index', $data);
	}

	// handler list 
	public function handlers()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];

		$handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

		$data['handlers'] = $handlerModel->select(['lu_id', 'user_name', 'user_email', 'user_mobile', 'user_role', 'user_status', 'user_created_at'])->where('user_deleted_status', 0)->where(['user_report_to' => session('id')])->whereIn('user_role', [0, 1]);

		if (!empty($_GET['type']) && isset($_GET['type'])) {
			$type = $_GET['type'] == 'handler' ? '0' : 1;
			$data['handlers'] = $data['handlers']->where('user_role', $type);
		}

		$data['total_handlers'] = $data['handlers']->countAllResults(false);
		$data['handlers'] = $data['handlers']->orderBy('lu_id', 'DESC')->paginate(500);
		$data['pager'] = $handlerModel->pager;

		$data['pagename'] = 'admin/handlers';
		//dd($data);
		return view('admin/index', $data);
	}

	// update handler
	public function edit_handler($hid = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($hid === false) {
			return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try again After Sometime.'])->back();
		}
		$handlerProfileModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

		$handlerProfileDetail = $handlerProfileModel->where('lu_id', $hid)->where(['user_deleted_status' => 0, 'user_report_to' => session('id')])->first();
		if (!$handlerProfileDetail)
			return redirect()->with('toastr', ['error' => 'Handler does not Exit.'])->back();
		$data = [];
		$data['handlerDetail'] = $handlerProfileDetail;
		if ($this->request->getMethod() == 'post') {
			$postData = $this->request->getPost();
			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
				'role' => 'required|in_list[0,1]',
				'status' => 'required|in_list[0,1]',
			];
			$errors = [
				'name' => [
					'required' => 'Name is required.',
					'min_length' => 'Name minimum lenght has been 3.',
					'max_length' => 'Name maximum lenght has been 255.',
					'alpha_numeric_space' => 'Name is support Alphabets, Digits and white Space Only.',
				],
				'role' => [
					'required' => 'Role is required.',
					'in_list' => 'Role is does not exits select box.',
				],
				'status' => [
					'required' => 'Status is required.',
					'in_list' => 'Status is does not exits select box.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err)->back();
			} else {
				$data = [
					'lu_id' => $hid,
					'user_name' => $postData['name'],
					'user_role' => $postData['role'],
					'user_status' => $postData['status'],
				];

				$handlerModel =  new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

				$x = $handlerModel->save($data);
				if ($x) {
					session()->setFlashdata('toastr', ['success' => 'Handler Successfully Updated']);
					return redirect()->to('/admin/handlers');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}

		$data['pagename'] = 'admin/handler-edit';

		return view('admin/index', $data);
	}

	// handler bulk action such update password indiviual or team, suspend indiviual or team
	public function bulk_action()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($this->request->getMethod() == 'post' && $this->request->getVar('btn') == 'handlerBulk') {
			$postData = $this->request->getPost();
			if ($this->request->getVar('actionType') == '2' || $this->request->getVar('actionType') == '4') {

				$hids = $postData['hid'] ?? [];
				if (!empty($hids)) {
					$action = ($postData['actionType'] == '4') ? '1' : '0';
					$handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
					$x = $handlerModel->where(['user_report_to' => session('id')])->whereIn('lu_id', $hids)->set(['user_status' => $action])->update();
					if ($x) {
						$type = $action ? 'Activated' : 'Suspended';
						session()->setFlashdata('toastr', ['success' => "Selected handler are successfully $type"]);
						return redirect()->back();
					}
				}
			} else if ($this->request->getVar('actionType') == '1' && $this->request->getVar('password') != '') {
				$hids = $postData['hid'] ?? [];
				if (!empty($hids)) {
					$action = $postData['password'];
					$handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
					$x = $handlerModel->where(['user_report_to' => session('id')])->whereIn('lu_id', $hids)->set(['user_password' => $action])->update();
					if ($x) {
						$type = $action ? 'Active' : 'Suspend';
						session()->setFlashdata('toastr', ['success' => "Selected handler are successfully password Has been changed."]);
						return redirect()->back();
					}
				}
			} else if ($this->request->getVar('actionType') == '3' && $this->request->getVar('teamLeader') != '') {
				$hids = $postData['hid'] ?? [];
				if (!empty($hids)) {
					$teamLeader = new ApplicationModel('team_leader_' . session('year'), 'tl_id', $this->lmsDb);
					$teamList = $teamLeader->select('handler_id')->findAll() ?? [];
					$teamList = array_column($teamList, 'handler_id');
					foreach ($hids as $key => $value) {
						if (in_array($value, $teamList) === false) {
							$teamLeader->save(['team_leader' => $postData['teamLeader'], 'handler_id' => $value]);
						}
					}
					session()->setFlashdata('toastr', ['success' => "Selected handler are successfully assign to team leader."]);
					return redirect()->back();
				}
			}
			session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
			return redirect()->back();
		}
	}



	// report
	// handler group for allocation
	// transfer leads

	/******************** Handler Operations END *************/

	/******************* Comman Operations START *************/
	// delete handler,lead, source, status, email template, sms template
	public function delete($from = false, $which = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if (empty($which) || empty($from)) {
			session()->setFlashdata('toastr', ['error' => 'Something went wrong.']);
			return redirect()->back();
		}
		if ($from == 'lead') {
			$id = $which;
			$model = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
			$x = $model->set('lead_delete_status', 1)->where('lid', $id)->update();
			if ($x) {
				session()->setFlashdata('toastr', ['success' => 'Lead Successfully Deleted.']);
				return redirect()->back();
			}
		}
		if ($from == 'handler') {
			$id = $which;
			$model = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
			$x = $model->set('user_deleted_status', 1)->where('lu_id', $id)->update();
			if ($x) {
				session()->setFlashdata('toastr', ['success' => 'Handler Successfully Deleted.']);
				return redirect()->back();
			}
		}
		if ($from == 'status') {
			$id = $which;
			$model = new ApplicationModel('status', 'status_id', $this->lmsDb);
			$x = $model->set('delete_status', 1)->where('status_id', $id)->update();
			if ($x) {
				session()->setFlashdata('toastr', ['success' => 'Status Successfully Deleted.']);
				return redirect()->back();
			}
		}
		if ($from == 'source') {
			$id = $which;
			$model = new ApplicationModel('sources', 'source_id', $this->lmsDb);
			$x = $model->set('source_status', 0)->where('source_id', $id)->update();
			if ($x) {
				session()->setFlashdata('toastr', ['success' => 'Source Successfully Dective.']);
				return redirect()->back();
			}
		}
		if ($from == 'email-template') {
			$id = $which;
			$model = new ApplicationModel('email_templates', 'et_id', $this->lmsDb);
			$x = $model->set('et_delete_status', 1)->where('et_id', $id)->update();
			if ($x) {
				session()->setFlashdata('toastr', ['success' => 'Email Template Successfully Deleted.']);
				return redirect()->back();
			}
		}
		if ($from == 'sms-template') {
			$id = $which;
			$model = new ApplicationModel('sms_templates', 'st_id', $this->lmsDb);
			$x = $model->set('st_delete_status', 1)->where('st_id', $id)->update();
			if ($x) {
				session()->setFlashdata('toastr', ['success' => 'SMS Template Successfully Deleted.']);
				return redirect()->back();
			}
		}

		if ($from == 'team-leader') {
			$id = $which;
			$model =  new ApplicationModel('team_leader_' . session('year'), 'tl_id', $this->lmsDb);
			if ($model->where(['handler_id' => $id])->delete()) {
				session()->setFlashdata('toastr', ['success' => 'Team Member Successfully removed.']);
				return redirect()->back();
			}
			session()->setFlashdata('toastr', ['success' => 'Team Member already removed.']);
			return redirect()->back();
		}

		session()->setFlashdata('toastr', ['error' => 'Something went wrong.']);
		return redirect()->back();
	}


	public function chanagestatus()
	{
		# code...
	}

	/****************** Comman Operation END ****************/


	/**************** Lead Operations START ******************/
	// create lead
	public function add_lead()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		$departmentModel = new ApplicationModel('departments', 'dept_id', $this->ssoDb);
		$deparments = $departmentModel->select(['dept_name', 'dept_id'])->where(['dept_delete_status' => 0, 'dept_status' => 1])->findAll();
		$sourceModel = new ApplicationModel('sources', 'et_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
		$statuses = $statusModel->select(['status_name', 'status_get_more_info', 'status_id', 'score'])->where(['delete_status' => 0, 'status_type' => 1])->findAll();
		$data['departments'] = $deparments ?? [];
		$data['sources'] = $sources ?? [];
		$data['countries'] = json_decode(file_get_contents('./assets/json/country.json'), true);
		$data['statues'] = $statuses ?? [];
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0, 'srf_status' => 1])->findAll() ?? [];
		$data['pagename'] = 'admin/add-lead';
		return view('admin/index', $data);
	}
	// update lead
	public function edit_lead($leadId = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($leadId === false) {
			return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try7 again After Sometime.'])->back();
		}
		$leadProfileModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);

		$leadProfileDetail = $leadProfileModel->where('lid', $leadId)->where('lead_delete_status', 0)->first();
		if (!$leadProfileDetail)
			return redirect()->with('toastr', ['error' => 'Lead does not Exit.'])->back();

		$data = [];
		$data['profile_detail'] = $leadProfileDetail;
		$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
		$data['remarks'] = $remarkModel->where('lead_id', $leadId)->findAll();

		$scoreModel = new ApplicationModel('lead_score_' . session('year'), 'lead_id', $this->lmsDb);
		$data['score'] = $scoreModel->where(['lead_id' => $leadId])->first();

		$transactionModel = new ApplicationModel('lead_score_transaction_' . session('year'), 'lst_id', $this->lmsDb);
		$data['scoreTransaction'] = $transactionModel->where(['lead_id' => $leadId])->findAll();

		$leadStatusModel = new ApplicationModel('lead_status_' . session('year'), 'lead_id', $this->lmsDb);
		$data['leadstatus'] = $leadStatusModel->where(['lead_id' => $leadId])->first();

		$statusMessageModel = new ApplicationModel('lead_status_message_' . session('year'), 'lead_id', $this->lmsDb);
		$data['statusMessage'] = $statusMessageModel->where(['lead_id' => $leadId])->first();

		$LeadSourceModel = new ApplicationModel('lead_source_' . session('year'), 'lso_id', $this->lmsDb);
		$data['leadSources'] = $LeadSourceModel->where(['lead_id' => $leadId])->findAll();

		$departmentModel = new ApplicationModel('departments', 'dept_id', $this->ssoDb);
		$deparments = $departmentModel->select(['dept_name', 'dept_id'])->where(['dept_delete_status' => 0, 'dept_status' => 1])->findAll();
		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
		$statuses = $statusModel->select(['status_name', 'status_get_more_info', 'status_id', 'score'])->where(['delete_status' => 0, 'status_type' => 1])->findAll();
		$data['departments'] = $deparments ?? [];
		$data['sources'] = $sources ?? [];
		$data['countries'] = json_decode(file_get_contents('./assets/json/country.json'), true);
		$data['statues'] = $statuses ?? [];

		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0, 'srf_status' => 1])->findAll() ?? [];

		//if($lid = )
		$data['pagename'] = 'admin/edit-lead';

		return view('admin/index', $data);
	}
	// post method
	public function lead_action($lead = false)
	{
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$studentNationality = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0, 'srf_status' => 1])->findAll() ?? [];
		$studentNationality = array_column($studentNationality, 'id');
		$nationalityString = implode(',', $studentNationality);
		if ($this->request->getMethod() == 'post') {
			if (!session('isLoggedInAdmin')) {
				return redirect()->to('/super-login');
			}
			$postData = $this->request->getPost();
			// common rules
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]',
				'email' => 'required|min_length[3]|max_length[255]|valid_email|uniqueEmail[email]',
				'mobile' => 'required|min_length[8]|max_length[12]|numeric|uniqueMobile[mobile]',
				'country_code' => 'required|min_length[1]|max_length[4]|numeric',
				'programe' => 'required|numeric',
				'department' => 'required|numeric',
				'status' => 'required|numeric',
				'source' => 'required|numeric',
				'nationality' => "required|in_list[$nationalityString]",
			];
			$lid = false;
			$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
			if ($lead === false) {
			} else {
				$user = $leadModel->where('lid', $lead)->first();
				if ($user) {
					$lid = $user['lid'];
				} else {
					return redirect()->withInput()->with('error', 'Something Went Wrong')->back();
				}
			}
			if ($this->request->getVar('lastname')) {
				$rules['lastname'] = 'min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]';
			}
			if ($this->request->getVar('middlename')) {
				$rules['middlename'] = 'min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]';
			}

			$errors = [
				'firstname' => [
					'required' => 'First Name is required.',
					'min_length' => 'First Name minimum lenght has been 3.',
					'max_length' => 'First Name maximum lenght has been 255.',
					'regex_match' => 'First Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)',
				],
				'lastname' => [
					'min_length' => 'Last Name minimum lenght has been 3.',
					'max_length' => 'Last Name maximum lenght has been 255.',
					'regex_match' => 'Last Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)',
				],
				'middlename' => [
					'min_length' => 'Middle Name minimum lenght has been 3.',
					'max_length' => 'Middle Name maximum lenght has been 255.',
					'regex_match' => 'Middle Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)',
				],
				'email' => [
					'required' => 'Mail Id is required.',
					'min_length' => 'Mail Id minimum lenght has been 5.',
					'max_length' => 'Mail Id maximum lenght has been 255.',
					'valid_email' => 'Mail Id is not valid.',
					'uniqueEmail' => "Mail Id is already present in system"
				],
				'mobile' => [
					'required' => 'Mobile Number is required.',
					'min_length' => 'Mobile Number minimum lenght has been 8.',
					'max_length' => 'Mobile Number maximum lenght has been 12.',
					'numeric' => 'Mobile Number is not valid.',
					'uniqueMobile' => "Mobile Number is already present in system"
				],
				'country_code' => [
					'required' => 'Country Code is required.',
					'min_length' => 'Country Code minimum lenght has been 1.',
					'max_length' => 'Country Code maximum lenght has been 4.',
					'numeric' => 'Country Code is support numbers only.',
				],
				'programe' => [
					'required' => 'Program Name is required.',
					'numeric' => 'Program Name is does not exits.',
				],
				'department' => [
					'required' => 'Department Name is required.',
					'numeric' => 'Department Name is does not exit.',
				],
				'status' => [
					'required' => 'Status is required.',
					'numeric' => 'Status  is numbers only.',
				],
				'source' => [
					'required' => 'Source is required.',
					'numeric' => 'Source  is support numbers only.',
				],
				'nationality' => [
					'required' => 'Nationality is required.',
					'in_list' => "Nationality is not valid."
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err)->back();
			} else {
				$data = [
					'lead_email' => $postData['email'],
					'lead_mobile' => $postData['mobile'],
					'lead_first_name' => $postData['firstname'],
					'lead_middle_name' => $postData['middlename'],
					'lead_last_name' => $postData['lastname'],
					'lead_country_code' => $postData['country_code'],
					'lead_programe' => $postData['programe'],
					'lead_department' => $postData['department'],
					'lead_status' => $postData['status'],
					'lead_source' => $postData['source'] ?? '',
					'lead_nationality' => $postData['nationality'],
				];
				// check user is exit in delete
				if ($lid) {
					$data['lid'] = $lid;
				} else {
					// check user is exit in delete
					$user = $leadModel->where(['lead_mobile' => $postData['mobile'], 'lead_email' => $postData['email'], 'lead_delete_status' => 1])->first();
					if ($user) {
						$data['lid'] = $user['lid'];
						$data['lead_delete_status'] = 0;
					}
				}
				$x = $leadModel->save($data);
				if ($lid === false) {
					$lid = $leadModel->select('lid')->where(['lead_email' => $postData['email'], 'lead_mobile' => $postData['mobile']])->first();
					$lid = $lid['lid'];
				}
				// check status Type
				$remark = [];
				$remark['handler_id'] = session('unique_id');
				$remark['lead_id'] = $lid;
				$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
				$getStatusType = $statusModel->where(['status_id' => $postData['status']])->first();

				// insert status
				$leadStatusModel = new ApplicationModel('lead_status_' . session('year'), 'ls_id', $this->lmsDb);
				// $leadStatusModel->save(['message'=>$postData['message'], 'lead_id'=>$lid]);
				if ($leadStatus = $leadStatusModel->where('lead_id', $lid)->first()) {
					$leadstatusData['ls_id'] = $leadStatus['ls_id'];
				}
				$leadstatusData['lead_id'] = $lid;
				if ($getStatusType['status_get_more_info'] == 1 || $getStatusType['status_get_more_info'] == 2) {

					$leadstatusData['message'] = $postData['message'];


					$remark['lr_remark'] = '<b>lead status:</b> ' . $getStatusType['status_name'] . '   <br> <b>Message:</b> ' . $postData['message'] . '<br>';
					$remark['lr_type'] = '1';
				} else {
					$remark['lr_remark'] = 'lead status: ' . $getStatusType['status_name'] . '<br>';
					$remark['lr_type'] = '1';
				}
				if ($getStatusType['status_get_more_info'] == 2) {
					$leadstatusData['ls_time'] = $postData['time'];
					$leadstatusData['ls_date'] = $postData['date'];
					$remark['lr_remark'] .= '<b>Date</b> ' . $postData['date'] . ' & <b>Time: </b>' . $postData['time'];
				}

				$leadStatusModel->save($leadstatusData);


				// insert source 
				$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
				$leadSourceModel = new ApplicationModel('lead_source_' . session('year'), 'lso_id', $this->lmsDb);
				$getLeadSource = $sourceModel->select(['source_name', 'adjust_score_level'])->where(['source_id' => $postData['source']])->first();
				$remark['lr_remark'] .= '<br> <b>Source Of Lead: </b>: ' . $getLeadSource['source_name'];


				if (!$leadSourceModel->where(['lead_id' => $lid, 'source_id' => $postData['source']])->first()) {
					$leadSourceModel->insert(['lead_id' => $lid, 'source_id' => $postData['source']]);
				}



				$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
				$remarkModel->insert($remark);

				$scoreTransctionModel = new ApplicationModel('lead_score_transaction_' . session('year'), 'lst_id', $this->lmsDb);

				$getScoreTransctions = $scoreTransctionModel->select(['destination_id', 'lst_type'])->where(['lead_id' => $lid])->groupBy('lst_type')->orderBy('lst_id', 'DESC')->findAll();
				$sourceScore = $postData['score']['source'];
				$statusScore = $postData['score']['status'];
				if ($getScoreTransctions) {
					foreach ($getScoreTransctions as $transction) {
						if ($transction['lst_type'] == 1) {
							$checkLevel = $statusModel->select(['status_id'])->where(['adjust_score_level>', $getStatusType['adjust_score_level'], 'status_id' => $transction['destination_id']]);
							$statusScore = $postData['score']['status'];
							if ($checkLevel)
								$statusScore = -$postData['score']['status'];
							$scoreTransctionModel->insert(['lead_id' => $lid, 'destination_id' => $postData['source'], 'lst_type' => 2, 'lst_score' => $statusScore]);
						}
						if ($transction['lst_type'] == 2) {
							$checkLevel = $leadSourceModel->select(['source_id'])->where(['adjust_score_level>', $getLeadSource['adjust_score_level'], 'source_id' => $transction['destination_id']]);
							$sourceScore = $postData['score']['source'];
							if ($checkLevel)
								$sourceScore = -$postData['score']['source'];
							$scoreTransctionModel->insert(['lead_id' => $lid, 'destination_id' => $postData['source'], 'lst_type' => 2, 'lst_score' => $sourceScore]);
						}
					}
				} else {
					$scoreTransctionModel->insert(['lead_id' => $lid, 'destination_id' => $postData['status'], 'lst_type' => '1', 'lst_score' => $statusScore]);
					$scoreTransctionModel->insert(['lead_id' => $lid, 'destination_id' => $postData['source'], 'lst_type' => '2', 'lst_score' => $sourceScore]);
				}

				//lead_score_2022
				$leadScoreModel = new ApplicationModel('lead_score_' . session('year'), 'lead_id', $this->lmsDb);
				$getLeadScore = $leadScoreModel->select('score')->where('lead_id', $lid)->first();
				$TotalScore = $sourceScore + $statusScore;
				if ($getLeadScore) {
					$TotalScore = $TotalScore + ($getLeadScore['score'] ?? 0);
					$leadScoreModel->save(['lead_id' => $lid, 'score' => $TotalScore]);
				} else {
					$leadScoreModel->insert(['lead_id' => $lid, 'score' => $TotalScore]);
				}

				if ($x) {
					return redirect()->with('toastr', ['success' => 'Successfully Done'])->to('admin/lead-profile/' . $lid);;
				} else {
					return redirect()->withInput()->with('toastr', ['error' => 'Something Went Wrong'])->back();
				}
			}
		}

		return redirect()->to('/404');
	}
	// lead list
	public function leads()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		//dd($this->request->getVar());
		$data = [];
		$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['sc_id', 'course_name', 'course_code', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->findAll();

		$deptModel = new ApplicationModel('departments', 'dept_id', $this->ssoDb);
		$data['departments'] = $deptModel->select(['dept_name', 'dept_id'])->findAll();

		$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
		$data['leads'] = $leadModel->select(['lid', 'lead_first_name', 'lead_middle_name', 'lead_last_name', 'lead_email', 'lead_mobile', 'lead_country_code', 'lead_programe', 'lead_department', 'lead_status', 'lead_source', 'source_name', 'status_name', 'status_get_more_info', 'course_name', 'dept_name', 'lead_created_at'])
			->join($this->ssoDb . '.departments', $this->ssoDb . '.departments.dept_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_department', 'left')
			->join('sources', 'sources.source_id=lead_profile_' . session('year') . '.lead_source', 'left')
			->join($this->ssoDb . '.session_courses_' . session('year'), $this->ssoDb . '.session_courses_' . session('year') . '.sc_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_programe', 'left')
			->join($this->ssoDb . '.course_info', $this->ssoDb . '.course_info.coi_id=' . $this->ssoDb  . '.session_courses_' . session('year') . '.course_id', 'left')
			->join('status', 'status.status_id=lead_profile_' . session('year') . '.lead_status', 'left')
			->where('lead_delete_status', 0);

		// filters
		$whereInSources = $whereInStatus = $whereInProgram = $whereInDepartment = $whereDate = false;

		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['lead_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}

		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['lead_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));;
		}

		if (array_filter($_GET['status'] ?? []) != [] && isset($_GET['status'])) {
			$whereInStatus = $_GET['status'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_status', $whereInStatus);
		}

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_source', $whereInSources);
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_programe', $whereInProgram);
		}
		if (array_filter($_GET['department'] ?? []) != []  && isset($_GET['department'])) {
			$whereInDepartment = $_GET['department'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_department', $whereInDepartment);
		}

		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_nationality', $whereInNationality);
		}

		if (!empty($_GET['mobile']) && isset($_GET['mobile']))
			$whereDate['lead_mobile'] = $_GET['mobile'];

		if ($whereDate)
			$data['leads'] = $data['leads']->where($whereDate);

		$data['total_leads'] = $data['leads']->countAllResults(false);
		$data['leads'] = $data['leads']->orderBy('lid', 'DESC')->paginate(500);
		$data['pager'] = $leadModel->pager;

		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
		$statuses = $statusModel->select(['status_name', 'status_get_more_info', 'status_id', 'score'])->where(['delete_status' => 0, 'status_type' => 1])->findAll();

		$data['sources'] = $sources ?? [];
		$data['statues'] = $statuses ?? [];
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];
		// dd($data);
		//return 'Hello';
		$data['pagename'] = 'admin/lead-list';
		return view('admin/index', $data);
	}
	// bulk upload
	public function bulk_upload_lead()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];

		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$data['sources'] = $sources ?? [];
		$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$courses = $courseModel->select(['sc_id as coi_id', 'course_name', 'dept_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_status' => 1, 'course_delete_status' => 0, 'sc_course_delete' => 0])->findAll();
		$data['courses'] = $courses ?? [];

		if ($this->request->getMethod() == "post" && $this->request->getVar('btn') == 'upload-lead') {
			$postData = $this->request->getPost();
			$rules = [
				'csvfile' => 'uploaded[csvfile]|ext_in[csvfile,csv]|mime_in[csvfile,text/x-comma-separated-values,text/comma-separated-values,application/octet-stream,application/vnd.ms-excel,application/x-csv,text/x-csv,text/csv,application/csv,application/excel,application/vnd.msexcel,text/plain]',
				'source' => 'required|in_list[' . implode(',', array_column($data['sources'] ?? [], 'source_id')) . ']',
			];
			if ($this->request->getVar('course') != '') {
				$rules['course'] = 'required|in_list[' . implode(',', array_column($data['courses'] ?? [], 'coi_id')) . ']';
			}
			if (!$this->validate($rules)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err->getErrors())->back();
			} else {
				$insertCount = $rowCount = $notAddCount = 0;
				$notadd = array();
				if (is_uploaded_file($_FILES['csvfile']['tmp_name'])) {
					$csvReader = new CSVReader();
					// Parse data from CSV file
					$csvData = $csvReader->parse_csv($_FILES['csvfile']['tmp_name']);
					// Insert/update CSV data into database
					if (!empty($csvData)) {
						$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
						foreach ($csvData as $row) {
							$rowCount++;
							if (!empty($row['email']) && !empty($row['mobile'])) {
								$leadData = array(
									'lead_first_name' => $row['firstname'],
									'lead_last_name' => $row['lastname'] ?? null,
									'lead_middle_name' => $row['middlename'] ?? null,
									'lead_email' => $row['email'],
									'lead_mobile' => $row['mobile'],
									'lead_country_code' => (isset($row['mobile_code']) && !empty($row['mobile_code'])) ? $row['mobile_code'] : '+91',
									'lead_programe' => $postData['course'] ?? null,
									'lead_source' => $postData['source'],
									'lead_department' => $postData['department'] ?? null,
									'lead_status' => 1,
								);
								//check lead already present or not
								if ($d = $leadModel->select(['lid', 'lead_delete_status'])->where(['lead_email' => $row['email']])->Orwhere(['lead_mobile' => $row['mobile']])->first()) {
									//check first if deleted than update status
									if ($d['lead_delete_status'] == 1) {
										$leadModel->save(['lid' => $d['lid'], 'lead_source' => $postData['source'], 'lead_delete_status' => 0]);
									} else {
										$notadd[$notAddCount] = [
											'email' => $leadData['lead_email'],
											'mobile' => $leadData['lead_mobile'],
										];
										$notAddCount++;
									}
								} else {
									$leadModel->save($leadData);
									$insertCount++;
								}
							}
						}
					}
				}
				// statics
				$data['upload'] = [
					'total_data' => $rowCount,
					'total_insert' => $insertCount,
					'notupload' => $notAddCount,
					'notuploaddata' => $notadd,
				];
			}
		}
		$data['pagename'] = 'admin/bulk-upload';
		return view('admin/index', $data);
	}
	// allocated leads
	public function allocated_leads()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['sc_id as coi_id', 'course_name', 'course_code', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->findAll();

		$deptModel = new ApplicationModel('departments', 'dept_id', $this->ssoDb);
		$data['departments'] = $deptModel->select(['dept_name', 'dept_id'])->findAll();

		$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
		$data['leads'] = $leadModel->select(['lid', 'lead_first_name', 'lead_middle_name', 'lead_last_name', 'lead_email', 'lead_mobile', 'lead_country_code', 'lead_programe', 'lead_department', 'lead_status', 'lead_source', 'source_name', 'status_name', 'status_get_more_info', 'course_name', 'dept_name', 'user_name', 'user_email', 'user_mobile', 'lal_created_at'])
			->join($this->ssoDb . '.departments', $this->ssoDb . '.departments.dept_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_department', 'left')
			->join('sources', 'sources.source_id=lead_profile_' . session('year') . '.lead_source', 'left')
			->join($this->ssoDb . '.session_courses_' . session('year'), $this->ssoDb . '.session_courses_' . session('year') . '.sc_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_programe', 'left')
			->join($this->ssoDb . '.course_info', $this->ssoDb . '.course_info.coi_id=' . $this->ssoDb  . '.session_courses_' . session('year') . '.course_id', 'left')
			->join('status', 'status.status_id=lead_profile_' . session('year') . '.lead_status', 'left')
			->join('lead_allocation_' . session('year'), 'lead_allocation_' . session('year') . '.lead_id=lead_profile_' . session('year') . '.lid', 'left')
			->join(SETTINGDB . '.lms_users_' . session('year'), SETTINGDB . '.lms_users_' . session('year') . '.lu_id=lead_allocation_' . session('year') . '.handler_id', 'left')
			->where('lead_delete_status', 0)->where(['db_name' => session('db_priffix')]);

		// filters
		$whereInSources = $whereInStatus = $whereInProgram = $whereInDepartment = $whereDate = false;

		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['lead_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}

		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['lead_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));;
		}

		if (array_filter($_GET['status'] ?? []) != [] && isset($_GET['status'])) {
			$whereInStatus = $_GET['status'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_status', $whereInStatus);
		}

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_source', $whereInSources);
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_programe', $whereInProgram);
		}
		if (array_filter($_GET['department'] ?? []) != []  && isset($_GET['department'])) {
			$whereInDepartment = $_GET['department'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_department', $whereInDepartment);
		}

		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_nationality', $whereInNationality);
		}

		if (!empty($_GET['mobile']) && isset($_GET['mobile']))
			$whereDate['lead_mobile'] = $_GET['mobile'];

		if ($whereDate)
			$data['leads'] = $data['leads']->where($whereDate);

		$data['total_leads'] = $data['leads']->countAllResults(false);
		$data['leads'] = $data['leads']->orderBy('lid', 'DESC')->paginate(500);
		$data['pager'] = $leadModel->pager;

		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
		$statuses = $statusModel->select(['status_name', 'status_get_more_info', 'status_id', 'score'])->where(['delete_status' => 0, 'status_type' => 1])->findAll();

		$data['sources'] = $sources ?? [];
		$data['statues'] = $statuses ?? [];
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];
		$data['pagename'] = 'admin/allocated-leads';
		return view('admin/index', $data);
	}
	// unallocated leads
	public function unallocated_leads()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['sc_id as coi_id', 'course_name', 'course_code', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->findAll();

		$deptModel = new ApplicationModel('departments', 'dept_id', $this->ssoDb);
		$data['departments'] = $deptModel->select(['dept_name', 'dept_id'])->findAll();

		$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
		$data['leads'] = $leadModel->select(['lid', 'lead_first_name', 'lead_middle_name', 'lead_last_name', 'lead_email', 'lead_mobile', 'lead_country_code', 'lead_programe', 'lead_department', 'lead_status', 'lead_source', 'source_name', 'status_name', 'status_get_more_info', 'course_name', 'dept_name', 'lead_created_at'])
			->join($this->ssoDb . '.departments', $this->ssoDb . '.departments.dept_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_department', 'left')
			->join('sources', 'sources.source_id=lead_profile_' . session('year') . '.lead_source', 'left')

			->join($this->ssoDb . '.session_courses_' . session('year'), $this->ssoDb . '.session_courses_' . session('year') . '.sc_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_programe', 'left')

			->join($this->ssoDb . '.course_info', $this->ssoDb . '.course_info.coi_id=' . $this->ssoDb  . '.session_courses_' . session('year') . '.course_id', 'left')

			->join('status', 'status.status_id=lead_profile_' . session('year') . '.lead_status', 'left')
			->where('lead_delete_status', 0)->whereNotIn('lid', function (BaseBuilder $builder) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'));
			});

		// filters
		$whereInSources = $whereInStatus = $whereInProgram = $whereInDepartment = $whereDate = false;

		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['lead_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}

		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['lead_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));;
		}

		if (array_filter($_GET['status'] ?? []) != [] && isset($_GET['status'])) {
			$whereInStatus = $_GET['status'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_status', $whereInStatus);
		}

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_source', $whereInSources);
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_programe', $whereInProgram);
		}
		if (array_filter($_GET['department'] ?? []) != []  && isset($_GET['department'])) {
			$whereInDepartment = $_GET['department'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_department', $whereInDepartment);
		}
		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_nationality', $whereInNationality);
		}

		if (!empty($_GET['mobile']) && isset($_GET['mobile']))
			$whereDate['lead_mobile'] = $_GET['mobile'];

		if ($whereDate)
			$data['leads'] = $data['leads']->where($whereDate);

		$data['total_leads'] = $data['leads']->countAllResults(false);
		$data['leads'] = $data['leads']->orderBy('lid', 'DESC')->paginate(500);
		$data['pager'] = $leadModel->pager;

		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
		$statuses = $statusModel->select(['status_name', 'status_get_more_info', 'status_id', 'score'])->where(['delete_status' => 0, 'status_type' => 1])->findAll();

		$data['sources'] = $sources ?? [];
		$data['statues'] = $statuses ?? [];

		if ($this->request->getMethod() == 'post' && $this->request->getVar('btn') == 'btn-submit') {
			$postData = $this->request->getPost();
			$rules = [
				'technique' => 'required|in_list[roastr,one,self]',
				'leads' => 'required',
			];
			if ($this->request->getVar('technique') == 'one') {
				$rules['handler'] = 'required|numeric';
			} else if ($this->request->getVar('technique') == 'roastr') {
				$rules['roastrBy'] = 'required|in_list[group,team,specific-persons]';
				$rules['handler'] = 'required|numeric';
				if ($this->request->getVar('roastrBy') == 'specific-persons') {
					$rules['handler.*'] = 'required|numeric';
				}
			} else if ($this->request->getVar('technique') == 'self') {
				$rules['handler'] = 'required|numeric';
			}

			$errors = [
				'technique' => [
					'required' => 'Technique is required.',
					'in_list' => 'Your selected technique are not in list.'
				],
				'roastrBy' => [
					'required' => 'Roastr BY method is required.',
					'in_list' => 'Your selected Roastr BY method are not in list.'
				],
				'leads' => [
					'required' => 'Leads is required.',
				],
				'handler' => [
					'required' => 'Handler is Required.',
					'numeric' => 'Handler is does not exit.',
				],
				'handler.*' => [
					'required' => 'Handler is Required.',
					'numeric' => 'Handler is does not exit.',
				]
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err->getErrors())->back();
			} else {
				$allocationModel = new ApplicationModel('lead_allocation_' . session('year'), 'lal_id', $this->lmsDb);
				if ($postData['technique'] == 'roastr') {
					// allocated in team
					if ($postData['roastrBy'] == 'team') {
						// get team 
						$teamModel = new ApplicationModel('team_leader_' . session('year'), 'tl_id', $this->lmsDb);
						if ($teamMember = $teamModel->select('handler_id')->join(SETTINGDB . '.lms_users_' . session('year'), SETTINGDB . '.lms_users_' . session('year') . '.lu_id=team_leader_' . session('year') . '.handler_id')->where('team_leader', $postData['handler'])->where(['handler_status' => 1, 'user_deleted_status' => 0])->findAll()) {
							$handlers = array_column($teamMember, 'handler_id');
							// include team leader here
							$handlers[] = $postData['handler'];
							$hcounter = count($handlers);
							$lidcount = count($postData['leads']);

							if ($lidcount > 500) {
								session()->setFlashdata('toastr', ['error' => 'leads are not more than 500']);
								return redirect()->back();
							}
							for ($i = 0; $i < $lidcount; $i++) {
								if ($i == 0) {
									$g = 0;
								} elseif ($g == $hcounter) {
									$g = 0;
								}
								$allocate = array(
									'lead_id' => $this->request->getVar('leads')[$i],
									'handler_id' => $handlers[$g],
								);

								if ($allocationModel->where('lead_id', $allocate['lead_id'])->first()) {
									//$data['notadded'] = "lead_$i";
								} else {
									$allocationModel->save($allocate);
								}
								$g++;
							}
							//dd($allocate);
							session()->setFlashdata('toastr', ['success' => "Leads are allocated successfully"]);
							return redirect()->back();
						}
						session()->setFlashdata('toastr', ['error' => 'Handler Teams mates are may be dective or deleted']);
						return redirect()->back();
					}
					// allocated specific persons
					if ($postData['roastrBy'] == 'specific-persons') {
						// check handler 

						$handlers = $postData['handler'];
						$hcounter = count($postData['handler']) ?? 0;
						if ($hcounter == 0) {
							session()->setFlashdata('toastr', ['error' => 'Handler are not selected']);
							return redirect()->back();
						}
						$lidcount = count($postData['leads']);

						if ($lidcount > 500) {
							session()->setFlashdata('toastr', ['error' => 'leads are not more than 500']);
							return redirect()->back();
						}
						for ($i = 0; $i < $lidcount; $i++) {
							if ($i == 0) {
								$g = 0;
							} elseif ($g == $hcounter) {
								$g = 0;
							}
							$allocate = array(
								'lead_id' => $this->request->getVar('leads')[$i],
								'handler_id' => $handlers[$g],
							);

							if ($allocationModel->where('lead_id', $allocate['lead_id'])->first()) {
								//$data['notadded'] = "lead_$i";
							} else {
								$allocationModel->save($allocate);
							}
							$g++;
						}
						//dd($allocate);
						session()->setFlashdata('toastr', ['success' => "Leads are allocated successfully"]);
						return redirect()->back();
					}
					// group
					if ($postData['roastrBy'] == 'group') {
						$groupModel = new ApplicationModel('group_members', 'gm_id', $this->lmsDb);
						if ($groupMembers = $groupModel->select('ref_id')->join(SETTINGDB . '.lms_users_' . session('year'), SETTINGDB . '.lms_users_' . session('year') . '.lu_id=group_members.ref_id')->where('g_id', $postData['handler'])->where(['handler_status' => 1, 'user_deleted_status' => 0])->findAll()) {
							$handlers = array_column($groupMembers, 'ref_id');
							$hcounter = count($handlers);
							$lidcount = count($postData['leads']);

							if ($lidcount > 500) {
								session()->setFlashdata('toastr', ['error' => 'leads are not more than 500']);
								return redirect()->back();
							}
							for ($i = 0; $i < $lidcount; $i++) {
								if ($i == 0) {
									$g = 0;
								} elseif ($g == $hcounter) {
									$g = 0;
								}
								$allocate = array(
									'lead_id' => $this->request->getVar('leads')[$i],
									'handler_id' => $handlers[$g],
								);

								if ($allocationModel->where('lead_id', $allocate['lead_id'])->first()) {
									//$data['notadded'] = "lead_$i";
								} else {
									$allocationModel->save($allocate);
								}
								$g++;
							}
							//dd($allocate);
							session()->setFlashdata('toastr', ['success' => "Leads are allocated successfully"]);
							return redirect()->back();
						}
						session()->setFlashdata('toastr', ['error' => 'Handler Group members are may be dective or deleted.']);
						return redirect()->back();
					}

					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong. System Error']);
					return redirect()->back();
				} else if ($postData['technique'] == 'one') {
					if (count($this->request->getVar('leads')) <= 200) {
						//dd($_POST);

						$lidcount = count($postData['leads']);
						for ($i = 0; $i < $lidcount; $i++) {
							$allocate = array(
								'lead_id' => $this->request->getVar('leads')[$i],
								'handler_id' => $this->request->getVar('handler'),
							);
							if ($allocationModel->where('lead_id', $allocate['lead_id'])->first()) {
								//$data['notadded'] = "lead_$i";
							} else {
								$allocationModel->save($allocate);
							}
						}
						session()->setFlashdata('toastr', ['success' => "Leads are allocated successfully"]);
						return redirect()->back();
					} else {
						session()->setFlashdata('toastr', ['error' => "Leads are more than 200 or Something went wrong"]);
						return redirect()->back();
					}
				} else if ($postData['technique'] == 'self') {
					if (count($this->request->getVar('leads')) <= 200) {
						//dd($_POST);
						$lidcount = count($postData['leads']);
						for ($i = 0; $i < $lidcount; $i++) {
							$allocate = array(
								'lead_id' => $this->request->getVar('leads')[$i],
								'handler_id' => $this->request->getVar('handler'),
							);
							if ($allocationModel->where('lead_id', $allocate['lead_id'])->first()) {
								//$data['notadded'] = "lead_$i";
							} else {
								$allocationModel->save($allocate);
							}
						}
						session()->setFlashdata('toastr', ['success' => "Leads are allocated successfully"]);
						return redirect()->back();
					} else {
						session()->setFlashdata('toastr', ['error' => "Leads are more than 200 or Something went wrong"]);
						return redirect()->back();
					}
				} else {
					session()->setFlashdata('toastr', ['error' => 'Not Valid Option']);
					return redirect()->back();
				}
			}
		}

		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];

		$data['pagename'] = 'admin/unallocated-leads';
		return view('admin/index', $data);
	}
	// transfer lead
	public function transfered_leads()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		// transfer Lead
		if ($this->request->getMethod() == 'post') {
			if ($this->request->getVar('btn') == 'transfer') {
				$postData = $this->request->getPost();
				$rules = [
					'handler' => 'required|numeric',
					'lead' => 'required|numeric',
				];
				$errors = [
					'handler' => [
						'required' => 'Handler is required.',
						'numeric' => 'Selected Handler does not exits.'
					],
					'lead' => [
						'required' => 'Handler is required.',
						'numeric' => 'Selected lead does not exits.'
					]
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong ']);
					return redirect()->withInput()->with('transferError', $err->getErrors())->back();
				} else {
					$lead_id = $postData['lead'];
					// update allocation table
					$allocationModel =  new ApplicationModel('lead_allocation_' . session('year'), 'lal_id', $this->lmsDb);
					$x = $allocationModel->where(['lead_id' => $lead_id])->set('handler_id', $postData['handler'])->update();
					if ($x) {
						// insert in transfer table
						$tranferModel = new ApplicationModel('lead_transfer_' . session('year'), 'lt_id', $this->lmsDb);
						$tranferData = [
							'lead_id' => $lead_id,
							'from_handler' => session('unique_id'),
							'to_handler' => $postData['handler'],
						];
						$y = $tranferModel->save($tranferData);
						if ($y) {
							// insert remark
							$tranferRemark = [
								'lead_id' => $lead_id,
								'handler_id' => session('unique_id'),
								'lr_remark' => 'Lead is tranfer from admin to ' . $this->getSinglehandler($postData['handler']) . '.',
								'lr_type' => 5
							];
							$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
							$remarkModel->insert($tranferRemark);
							session()->setFlashdata('toastr', ['success' => 'Your lead is successfully Transfered.']);
							return redirect()->back();
						}
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something Went wrong on Transfer form.']);
				return redirect()->back();
			}
		}

		$data = [];
		return view('admin/transfer-leads', $data);
	}

	// self assign leads
	public function self_assign_lead()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		//dd($this->request->getVar());
		$data = [];
		$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['sc_id as coi_id', 'course_name', 'course_code', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->findAll();

		$deptModel = new ApplicationModel('departments', 'dept_id', $this->ssoDb);
		$data['departments'] = $deptModel->select(['dept_name', 'dept_id'])->findAll();

		$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
		$data['leads'] = $leadModel->select(['lid', 'lead_first_name', 'lead_middle_name', 'lead_last_name', 'lead_email', 'lead_mobile', 'lead_country_code', 'lead_programe', 'lead_department', 'lead_status', 'lead_source', 'source_name', 'status_name', 'status_get_more_info', 'course_name', 'dept_name', 'lead_created_at'])
			->join($this->ssoDb . '.departments', $this->ssoDb . '.departments.dept_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_department', 'left')
			->join('sources', 'sources.source_id=lead_profile_' . session('year') . '.lead_source', 'left')

			->join($this->ssoDb . '.session_courses_' . session('year'), $this->ssoDb . '.session_courses_' . session('year') . '.sc_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_programe', 'left')

			->join($this->ssoDb . '.course_info', $this->ssoDb . '.course_info.coi_id=' . $this->ssoDb  . '.session_courses_' . session('year') . '.course_id', 'left')

			->join('status', 'status.status_id=lead_profile_' . session('year') . '.lead_status', 'left')
			->join('lead_allocation_' . session('year'), 'lead_allocation_' . session('year') . '.lead_id=lead_profile_' . session('year') . '.lid', 'left')
			->where('lead_delete_status', 0)->where(['handler_id' => session('unique_id')]);

		// filters
		$whereInSources = $whereInStatus = $whereInProgram = $whereInDepartment = $whereDate = false;

		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['lead_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}

		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['lead_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));;
		}

		if (array_filter($_GET['status'] ?? []) != [] && isset($_GET['status'])) {
			$whereInStatus = $_GET['status'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_status', $whereInStatus);
		}

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_source', $whereInSources);
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_programe', $whereInProgram);
		}
		if (array_filter($_GET['department'] ?? []) != []  && isset($_GET['department'])) {
			$whereInDepartment = $_GET['department'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_department', $whereInDepartment);
		}

		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
			$data['leads'] = $data['leads']->whereIn('lead_nationality', $whereInNationality);
		}

		if (!empty($_GET['mobile']) && isset($_GET['mobile']))
			$whereDate['lead_mobile'] = $_GET['mobile'];

		if ($whereDate)
			$data['leads'] = $data['leads']->where($whereDate);

		$data['total_leads'] = $data['leads']->countAllResults(false);
		$data['leads'] = $data['leads']->orderBy('lid', 'DESC')->paginate(500);
		$data['pager'] = $leadModel->pager;

		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
		$statuses = $statusModel->select(['status_name', 'status_get_more_info', 'status_id', 'score'])->where(['delete_status' => 0, 'status_type' => 1])->findAll();

		$data['sources'] = $sources ?? [];
		$data['statues'] = $statuses ?? [];
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];
		$data['pagename'] = 'admin/self-assign-leads';
		return view('admin/index', $data);
	}

	// lead profile
	public function lead_profile($lead_id = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($lead_id === false) {
			return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try again After Sometime.'])->back();
		}
		$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);

		$leadProfileDetail =
			$leadModel->where('lead_delete_status!=', 1)->where(['lid' => $lead_id])->first();
		if (!$leadProfileDetail)
			return redirect()->with('toastr', ['error' => 'Lead does not exit or assign.'])->back();
		$data = [];

		// get Courses
		$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['sc_id as coi_id', 'course_name', 'course_code', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_status' => 1, 'sc_course_delete' => 0])->findAll();
		// get status
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
		$statuses = $statusModel->select(['status_name', 'status_get_more_info', 'status_id', 'score'])->where(['delete_status' => 0, 'status_type' => 1])->findAll();
		$data['status_list'] = $statuses;
		$statusIds = array_column($statuses, 'status_id');
		$leadProfileDetail['statusInfo'] = '1';
		if (($keyst = array_search($leadProfileDetail['lead_status'], $statusIds)) !== false) {
			$leadProfileDetail['statusInfo'] = $statuses[$keyst]['status_get_more_info'];
		}

		$courseIds = array_column($data['courses'], 'coi_id');
		$leadProfileDetail['coursename'] = '';
		if (($key = array_search($leadProfileDetail['lead_programe'], $courseIds)) !== false) {
			$leadProfileDetail['coursename'] = $data['courses'][$key]['course_name'];
		}
		$alternativeModel = new ApplicationModel('lead_contact_info_' . session('year'), 'ci_id', $this->lmsDb);
		$alternatives = $alternativeModel->select(['ci_email', 'ci_id', 'ci_mobile'])->where(['lead_id' => $lead_id])->first() ?? [];
		$data['alternatives'] = $alternatives;
		if ($leadProfileDetail['lead_delete_status'] == '2' && $alternatives) {
			$leadProfileDetail['lead_mobile'] = $alternatives['ci_mobile'];
			$leadProfileDetail['lead_email'] = $alternatives['ci_email'];
		}
		$data['profileDetail'] = $leadProfileDetail;

		$smsTemplatesModel = new ApplicationModel('sms_templates', 'st_id', $this->lmsDb);
		$smsTemplates = $smsTemplatesModel->select(['st_name', 'st_id'])->where(['st_delete_status' => 0, 'st_status' => 1, 'st_type' => 1])->findAll();
		$data['smsTemplates'] = $smsTemplates ?? [];

		$emailTemplatesModel = new ApplicationModel('email_templates', 'et_id', $this->lmsDb);
		$emailTemplates = $emailTemplatesModel->select(['et_name', 'et_id', 'et_have_attachment'])->where(['et_delete_status' => 0, 'et_status' => 1, 'et_type' => 1])->findAll();
		$data['emailTemplates'] = $emailTemplates ?? [];

		$addressModel = new ApplicationModel('lead_address_' . session('year'), 'la_id', $this->lmsDb);
		$data['address'] = $address = $addressModel->where(['lead_id' => $lead_id])->first() ?? [];

		$data['countries'] = json_decode(file_get_contents('./assets/json/country.json'), true);

		$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
		$data['remarks'] = $remarkModel->select(['lr_remark', 'handler_id', 'lr_type', 'lr_created_at'])->where('lead_id', $lead_id)->findAll() ?? [];

		if ($this->request->getMethod() == 'post') {

			// sms send
			if ($this->request->getVar('btn') == 'sendSMS') {
				$postData = $this->request->getPost();
				$smsModel = new ApplicationModel('sms_templates', 'st_id', $this->lmsDb);
				$smsTemplate = $smsModel->where(['st_id' => $postData['sms'], 'st_delete_status' => 0])->first();
				if ($smsTemplate) {
					$smsData = [
						'sms_detail' => $smsTemplate,
						'lead_detail' => $leadProfileDetail
					];
					$x = $this->sendSms($smsData);
					if ($x) {
						return redirect()->with('toastr', ['success' => 'SMS Send Successfully'])->back();
					}
				}
				return redirect()->with('toastr', ['error' => 'SMS Template not properly set.'])->back();
			}

			// sendEmail
			if ($this->request->getVar('btn') == 'sendEmail') {
				$postData = $this->request->getPost();
				$emailModel = new ApplicationModel('email_templates', 'et_id', $this->lmsDb);
				$emailTemplate = $emailModel->select(['et_template_url'])->where(['et_id' => $postData['email'], 'et_delete_status' => 0])->first();

				if ($emailTemplate && $leadProfileDetail['lead_email'] != 'demo@gmail.com') {
					$senderDetail = [
						'email' => $leadProfileDetail['lead_email'],
						'lead_detail' => $leadProfileDetail
					];
					$emailDetail = [
						'view' => $emailTemplate['et_template_url'],
						'replyto' => 'aakash.kumawat@mygyanvihar.com',
						'replytoname' => 'Aakash Kumawat',
						'subject' => 'Email Template',
					];

					$emailData = [
						'senderDetail' => $senderDetail,
						'email' => $emailDetail
					];
					if (isset($postData['attachment']) && !empty($postData['attachment'])) {
						$attachmentModel = new ApplicationModel('email_attachments', 'ea_id', $this->lmsDb);
						if ($attachmentDetail = $attachmentModel->select(['attachment_name', 'ea_attachment'])->where(['email_template_id' => $postData['email']])) {
							$emailData['attachment'] = [
								'upload_file_name' => $attachmentDetail['ea_attachment'],
								'attachment_name' => $attachmentDetail['attachment_name']
							];
						}
					}
					$x = $this->sendMailer($emailData);
					if ($x) {
						return redirect()->with('toastr', ['success' => 'Email Send Successfully'])->back();
					}
				}
				return redirect()->with('toastr', ['error' => 'Email Template not properly set.'])->back();
			}

			// add address
			if ($this->request->getVar('btn') == 'address-btn') {
				$postData = $this->request->getPost();
				$rules = [
					'country' => 'required',
					'district' => 'required',
					'street_address' => 'required|max_length[255]',
				];
				if ($this->request->getVar('country') == 'India') {
					$rules['state'] = 'required';
					$rules['zipcode'] = 'required|numeric|exact_length[6]';
				}

				$errors = [
					'country' => [
						'required' => 'Country is Required.',
					],
					'state' => [
						'required' => 'State is Required.',
					],
					'district' => [
						'required' => 'District is Required.',
					],
					'street_address' => [
						'required' => 'Street Address is Required.',
						'max_length' => 'Street Address max length support 255.'
					],
					'zipcode' => [
						'required' => 'Zipcode/Pincode is Required.',
						'numeric' => 'Zipcode/Pincode support only digits.',
						'exact_length' => 'Zipcode/Pincode has exact length 6.'
					],
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('addressError', $err->getErrors())->back();
				} else {
					$address_data = [
						'lead_id' => $lead_id,
						'la_country' => $postData['country'],
						'la_district' => $postData['district'],
						'la_state' => $postData['state'] ?? null,
						'la_street_address' => $postData['street_address'],
						'la_zipcode' => $postData['zipcode']
					];
					if ($address) {
						$address_data['la_id'] = $address['la_id'];
					}
					$x = $addressModel->save($address_data);
					if ($x) {
						session()->setFlashdata('toastr', ['success' => 'Successfully Address updated.']);
						return redirect()->back();
					}
				}
			}
			// update program
			if ($this->request->getVar('btn') == 'lead-program') {
				$postData = $this->request->getPost();
				$rules = [
					'program' => "required|in_list[" . implode(',', $courseIds) . "]",
				];
				$errors = [
					'program' => [
						'required' => 'Program are Not Selected.',
						'in_list' => "Your Selected Program not Exits",
					],
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('programError', $err->getErrors())->back();
				} else {
					$progrmData = [
						'lid' => $lead_id,
						'lead_programe' => $postData['program'],
						'lead_department' => $postData['dept'] ?? '',
					];
					$x = $leadModel->save($progrmData);
					if ($x) {
						if (($key = array_search($postData['program'], $courseIds)) !== false) {
							$pname = $data['courses'][$key]['course_name'] ?? '';
						}
						$prgogamRemark = [
							'lead_id' => $lead_id,
							'handler_id' => session('unique_id'),
							'lr_remark' => 'Program has been updated to ' . $pname,
							'lr_type' => 3
						];
						$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
						$remarkModel->insert($prgogamRemark);
						session()->setFlashdata('toastr', ['success' => 'Your program is successfully updated.']);
						return redirect()->back();
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something Went wrong on program selection.']);
				return redirect()->back();
			}
			// update name
			if ($this->request->getVar('btn') == 'update-name') {
				$postData = $this->request->getPost();
				$rules = [
					'firstname' => 'required|min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]',
				];
				if ($this->request->getVar('lastname')) {
					$rules['lastname'] = 'min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]';
				}
				if ($this->request->getVar('middlename')) {
					$rules['middlename'] = 'min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]';
				}
				$errors = [
					'firstname' => [
						'required' => 'First Name is required.',
						'min_length' => 'First Name minimum lenght has been 3.',
						'max_length' => 'First Name maximum lenght has been 255.',
						'regex_match' => 'First Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)'
					],
					'lastname' => [
						'min_length' => 'Last Name minimum lenght has been 3.',
						'max_length' => 'Last Name maximum lenght has been 255.',
						'regex_match' => 'Last Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)'
					],
					'middlename' => [
						'min_length' => 'Middle Name minimum lenght has been 3.',
						'max_length' => 'Middle Name maximum lenght has been 255.',
						'regex_match' => 'Middle Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)'
					],
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong1']);
					return redirect()->withInput()->with('nameError', $err->getErrors())->back();
				} else {
					$nameData = [
						'lid' => $lead_id,
						'lead_first_name' => $postData['firstname'],
						'lead_middle_name' => $postData['middlename'] ?? '',
						'lead_last_name' => $postData['lastname'] ?? '',
					];
					$x = $leadModel->save($nameData);
					if ($x) {

						$nameRemark = [
							'lead_id' => $lead_id,
							'handler_id' => session('unique_id'),
							'lr_remark' => 'Personal Information upedated ',
							'lr_type' => 4
						];
						$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
						$remarkModel->insert($nameRemark);
						session()->setFlashdata('toastr', ['success' => 'Your Student Info is successfully updated.']);
						return redirect()->back();
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something Went wrong on Student info.']);
				return redirect()->back();
			}
			// update Email
			if ($this->request->getVar('btn') == 'update-email') {
				$postData = $this->request->getPost();
				$rules = [
					'email' => 'required|min_length[3]|max_length[255]|valid_email|uniqueEmail[email]',
				];

				$errors = [
					'email' => [
						'required' => 'Mail Id is required.',
						'min_length' => 'Mail Id minimum lenght has been 5.',
						'max_length' => 'Mail Id maximum lenght has been 255.',
						'valid_email' => 'Mail Id is not valid.',
						'uniqueEmail' => "Mail Id is already present in system"
					],
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong or Email already exits']);
					return redirect()->withInput()->with('emailError', $err->getErrors())->back();
				} else {
					$emailData = [
						'lid' => $lead_id,
						'lead_email' => $postData['email'],
					];
					$x = $leadModel->save($emailData);
					if ($x) {

						$emailRemark = [
							'lead_id' => $lead_id,
							'handler_id' => session('unique_id'),
							'lr_remark' => 'Email has been updated.',
							'lr_type' => 4
						];
						$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
						$remarkModel->insert($emailRemark);
						session()->setFlashdata('toastr', ['success' => 'Your Contact Info is successfully updated.']);
						return redirect()->back();
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something Went wrong on Contact info.']);
				return redirect()->back();
			}

			// update Alternative
			if ($this->request->getVar('btn') == 'lead-alternative') {
				$postData = $this->request->getPost();
				$rules = [
					'alter_email' => 'required|min_length[3]|max_length[255]|valid_email',
					'alter_mobile' => 'required|min_length[8]|max_length[12]|numeric',
				];

				$errors = [
					'alter_email' => [
						'required' => 'Mail Id is required.',
						'min_length' => 'Mail Id minimum lenght has been 5.',
						'max_length' => 'Mail Id maximum lenght has been 255.',
						'valid_email' => 'Mail Id is not valid.',
					],
					'alter_mobile' => [
						'required' => 'Mobile Number is required.',
						'min_length' => 'Mobile Number minimum lenght has been 8.',
						'max_length' => 'Mobile Number maximum lenght has been 12.',
						'numeric' => 'Mobile Number is not valid.',
					],
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong ']);
					return redirect()->withInput()->with('alterError', $err->getErrors())->back();
				} else {
					$alterData = [
						'lead_id' => $lead_id,
						'ci_email' => $postData['alter_email'],
						'ci_mobile' => $postData['alter_mobile'],
					];
					if ($alternatives) {
						$alterData['ci_id'] = $alternatives['ci_id'];
					}
					$x = $alternativeModel->save($alterData);
					if ($x) {

						$alterRemark = [
							'lead_id' => $lead_id,
							'handler_id' => session('unique_id'),
							'lr_remark' => 'Alternative Contact Information has been saved.',
							'lr_type' => 7
						];
						$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
						$remarkModel->insert($alterRemark);
						session()->setFlashdata('toastr', ['success' => 'Your Alternative Contact Info is successfully updated.']);
						return redirect()->back();
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something Went wrong on Alternative Contact info.']);
				return redirect()->back();
			}

			// transfer Lead
			if ($this->request->getVar('btn') == 'transfer') {
				$postData = $this->request->getPost();
				$rules = [
					'handler' => 'required|numeric',
				];
				$errors = [
					'handler' => [
						'required' => 'Handler is required.',
						'numeric' => 'Selected Handler does not exits.'
					]
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong ']);
					return redirect()->withInput()->with('transferError', $err->getErrors())->back();
				} else {
					// update allocation table
					$allocationModel =  new ApplicationModel('lead_allocation_' . session('year'), 'lal_id', $this->lmsDb);
					$x = $allocationModel->where(['lead_id' => $lead_id])->set('handler_id', $postData['handler'])->update();
					//$x = $allocationModel->update(['lead_id' => $lead_id], ['handler_id' => $postData['handler']]);
					if ($x) {
						// insert in transfer table
						$tranferModel = new ApplicationModel('lead_transfer_' . session('year'), 'lt_id', $this->lmsDb);
						$tranferData = [
							'lead_id' => $lead_id,
							'from_handler' => session('unique_id'),
							'to_handler' => $postData['handler'],
						];
						$y = $tranferModel->save($tranferData);
						if ($y) {
							// insert remark
							$tranferRemark = [
								'lead_id' => $lead_id,
								'handler_id' => session('unique_id'),
								'lr_remark' => 'Lead is tranfer from admin to ' . $this->getSinglehandler($postData['handler']) . '.',
								'lr_type' => 5
							];
							$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
							$remarkModel->insert($tranferRemark);
							session()->setFlashdata('toastr', ['success' => 'Your lead is successfully Transfered.']);
							return redirect()->to('admin/self-assign-lead');
						}
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something Went wrong on Transfer form.']);
				return redirect()->back();
			}

			// remark insert
			// update Alternative
			if ($this->request->getVar('btn') == 'remark') {
				$postData = $this->request->getPost();
				$rules = [
					'remarkMessage' => 'required|max_length[255]',

				];

				$errors = [
					'remarkMessage' => [
						'required' => 'Remark Message is required.',
						'max_length' => 'Remark Message maximum lenght has been 255.',
					]
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong ']);
					return redirect()->withInput()->with('remarkError', $err->getErrors())->back();
				} else {
					$alterRemark = [
						'lead_id' => $lead_id,
						'handler_id' => session('unique_id'),
						'lr_remark' => $postData['remarkMessage'],
						'lr_type' => 10
					];
					$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
					$remarkModel->insert($alterRemark);
					session()->setFlashdata('toastr', ['success' => 'Your Remark is successfully saved.']);
					return redirect()->back();
				}
				session()->setFlashdata('toastr', ['error' => 'Something Went wrong on Remark Form.']);
				return redirect()->back();
			}


			// status update
			if ($this->request->getVar('btn') == 'update-status') {
				$postData = $this->request->getPost();
				$rules = [
					'status' => 'required|numeric',
				];
				// check course type
				$time = '';
				$msgst = '';
				if (($keyst = array_search($postData['status'], $statusIds)) !== false) {
					$upstatusdetail = $statuses[$keyst];
					if ($upstatusdetail['status_get_more_info'] == 2) {
						$rules['date'] = 'required';
						$rules['time'] = 'required';
						$time = "<br> Date: " . @$postData['date'] . "<br>Time: " . @$postData['time'];
					}
					if ($upstatusdetail['status_get_more_info'] == 1) {
						$rules['message'] = 'required|max_length[255]';
						$msgst = "<br>Message: " . @$postData['message'];
					}
				}

				$errors = [
					'status' => [
						'required' => 'Status is required.',
						'numeric' => 'Selected Status not Exist.',
					],
					'message' => [
						'required' => 'Please Provide the Status message.',
						'max_length' => 'Status Message maximum lenght has been 255.',
					],
					'date' => [
						'required' => 'Please Provide the Date.',
					],
					'time' => [
						'required' => 'Please Provide the Time.',
					]
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong in status form']);
					return redirect()->withInput()->with('statusError', $err->getErrors())->back();
				} else {
					$leadStatusModel = new ApplicationModel('lead_status_' . session('year'), 'ls_id', $this->lmsDb);
					if (($keyst = array_search($leadProfileDetail['lead_status'], $statusIds)) !== false) {
						$curretStatus = $statuses[$keyst];
					}
					$y = $leadModel->update($lead_id, ['lead_status' => $postData['status']]);
					$statusData = [
						'lead_id' => $lead_id,
						'message' => $postData['message'] ?? null,
						'ls_time' => $postData['time'] ?? null,
						'ls_date' => $postData['date'] ?? null,
					];
					if ($statusDetail = $leadStatusModel->select('ls_id')->where('lead_id', $lead_id)->first()) {
						$statusData['ls_id'] = $statusDetail['ls_id'];
					}
					$x = $leadStatusModel->save($statusData);
					if ($x) {
						$statusRemark = [
							'lead_id' => $lead_id,
							'handler_id' => session('unique_id'),
							'lr_remark' => 'Status Updated from ' . @$curretStatus['status_name'] . '  to ' . @$upstatusdetail['status_name'] . $msgst . $time,
							'lr_type' => 1
						];
						$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);
						$remarkModel->insert($statusRemark);
						session()->setFlashdata('toastr', ['success' => 'Your Status is successfully updated.']);
						return redirect()->back();
					}
					session()->setFlashdata('toastr', ['error' => 'Something Went wrong on Status Form.']);
					return redirect()->back();
				}
			}

			session()->setFlashdata('toastr', ['error' => 'Something Went wrong or you choose wrong Option.']);
			return redirect()->back();
		}

		$data['pagename'] = 'admin/profile';
		return view('admin/index', $data);
	}

	protected function getSinglehandler($handler)
	{
		$handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		$handler = $handlerModel->select(['user_name'])->where('lu_id', $handler)->first();
		return $handler ? $handler['user_name'] : '';
	}

	protected function sendSms($data)
	{
		$smsData = $data['sms_detail'];
		$leadDetail = $data['lead_detail'];
		$array = json_decode($smsData['st_parameter'], true) ?? [];
		$number = $leadDetail['lead_mobile']; //explode(',',$data['sms']['template']);
		//dd($array);
		$message = $smsData['st_message'];
		for ($i = 0; $i < count($array); $i++) {
			if (strpos($message, $array[$i]) !== false) {
				if ($array[$i] == '{name}') {
					$message = str_replace("{name}", ucwords(trim($leadDetail['lead_first_name'] . " " . $leadDetail['lead_middle_name'] . ' ' . $leadDetail['lead_last_name'])), $message);
					continue;
				} elseif ($array[$i] == '{program}') {
					$message = str_replace("{program}", $leadDetail['coursename'], $message);
					continue;
				} elseif ($array[$i] == '{sid}') {
					$message = str_replace("{sid}", $leadDetail['sid'], $message);
					continue;
				} elseif ($array[$i] == '{password}') {
					$message = str_replace("{password}", $leadDetail['passinfo'], $message);
					continue;
				} elseif ($array[$i] == '{link}') {
					$message = str_replace("{link}", $leadDetail['link'], $message);
					continue;
				}
			}
		}

		$temp = $leadDetail['st_approved_id'];
		if ($this->SendMessageApi($number, $message, $temp)) {
			$leadSMSModel = new ApplicationModel('lead_sms_history_' . session('year'), 'lsh_id', $this->lmsDb);
			$dataCounter = [
				'sms_template_id' => $smsData['st_id'],
				'lead_id' => $leadDetail['lid'],
				'handler_id' => session('unique_id')
			];
			$leadSMSModel->insert($dataCounter);
			$handlerCounterModel = new ApplicationModel('lead_sms_counter_' . session('year'), 'lsc_id', $this->lmsDb);
			$handlerCounter = [
				'handler_id' => session('unique_id'),
				'lsc_count' => 1
			];
			if ($x = $handlerCounterModel->select(['lsc_count', 'lsh_id'])->where(['handler_id' => session('unique_id')])->first()) {
				$handlerCounter['lsc_count'] = $x['lsc_count'] + 1;
				$handlerCounter['lsh_id'] = $x['lsh_id'];
			}
			$handlerCounterModel->save($handlerCounter);
			return true;
		}

		return false;
	}



	// report
	/**************** Lead Operations END ******************/

	/***************** Application Proccess Opteration START *******************/

	public function apply_now($lead_id = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($lead_id === false) {
			return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try again After Sometime.'])->back();
		}
		$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);

		$leadProfileDetail =
			$leadModel->where('lead_delete_status!=', 1)->where(['lid' => $lead_id])->first();
		if (!$leadProfileDetail)
			return redirect()->with('toastr', ['error' => 'Lead does not exit or assign.'])->back();
		// check data present or not 
		$contactModel =  new ApplicationModel('student_contact_info_' . session('year'), 'sci_id', $this->ssoDb);
		if ($student = $contactModel->where(['sci_mobile' => $leadProfileDetail['lead_mobile']])->Orwhere(['sci_email' => $leadProfileDetail['lead_email']])->first()) {
			if ($student['sci_delete_status'] == '1') {
				// update status
				$contactModel->update($student['sci_id'], ['sci_delete_status' => 0]);
				// check in lms reference table
				$lmsReferenceModel =  new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
				$lmsReferencedata = [
					'sid' => $student['sid'],
					'lead_id' => $lead_id,
					'handler_id' => session('unique_id'),
					'admin_type' => session('db_priffix'),
				];
				if ($lmsReferenceDetail = $lmsReferenceModel->select('lr_id')->where('sid', $student['sid'])->first()) {
					$lmsReferencedata['lr_id'] = $lmsReferenceDetail['lr_id'];
				}
				$x = $lmsReferenceModel->save($lmsReferencedata);
				$loginModel =  new  ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);

				$getPassword = $loginModel->select('password')->where('sid', $student['sid'])->first();
				$url = base_url('admin/process-application/' . $lead_id . '/' . $student['sid']);

				if ($leadProfileDetail['lead_country_code'] == '91' || $leadProfileDetail['lead_country_code'] == '+91') {
					// sms 
					$sid = $student['sid'];
					$pass = base64_decode($getPassword['password']);
					$url = 'https://ldm.merishiksha.org';
					$templateId = '1707168863578982012';
					$message = "Welcome to Suresh Gyan Vihar University. Your Sid is $sid. and password is $pass Click on the url for login $url Thanks.";
					$this->SendMessageApi($leadProfileDetail['lead_mobile'], $message, $templateId);
				}

				// send sid and passord
				$senderDetail = [
					'email' => $leadProfileDetail['lead_email'],
					'sid' => $student['sid'],
					'password' => base64_decode($getPassword['password']),
					'name' => ucwords(trim(($leadProfileDetail['lead_first_name']) . ' ' . ($leadProfileDetail['lead_middle_name'] ?? '') . ' ' . ($leadProfileDetail['lead_last_name'] ?? ''))),
				];
				$email = [
					'view' => 'email/student/email',
					'from' => 'aakash.kumawat@mygyanvihar.com',
					'subject' => 'Welcome To Suresh Gyan Vihar University [leadform]',
					'replyto' => 'admissions@mygyanvihar.com',
					'replytoname' => 'Admissions Team',
				];
				$this->sendMailer(['email' => $email, 'senderDetail' => $senderDetail]);
				return redirect()->to($url);
			} else {
				return redirect()->with('toastr', ['error' => 'Email and Mobile already Exits.'])->back();
			}
		} else {
			$getSidDetail = $this->generateSid($leadProfileDetail['lead_nationality']);
			$sid = $getSidDetail['sid'];

			$contactData = [
				'sci_mobile' => $leadProfileDetail['lead_mobile'],
				'sci_email' => $leadProfileDetail['lead_email'],
				'sci_country_code' => $leadProfileDetail['lead_country_code'],
				'sci_delete_status' => 0
			];
			$contactData['sid'] = $sid;
			$studentInfoData = [
				'sid' => $sid,
				'si_first_name' => $leadProfileDetail['lead_first_name'] ?? '',
				'si_middle_name' => $leadProfileDetail['lead_middle_name'] ?? '',
				'si_last_name' => $leadProfileDetail['lead_last_name'] ?? '',
				'program_id' => $leadProfileDetail['lead_programe'] ?? '',
				'dept_id' => $leadProfileDetail['lead_department'] ?? '',
				'si_course_level' => $leadProfileDetail['level'] ?? '',
				'dd' => date('d'),
				'mm' => date('m'),
				'yy' => date('Y'),
			];
			$studentInfoModel = new ApplicationModel('student_info_' . session('year'), 'si_id', $this->ssoDb);
			$y = $studentInfoModel->save($studentInfoData);
			$x = $contactModel->save($contactData);
			if ($x && $y) {
				// insert into reference table
				$lmsReferenceModel =  new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
				$lmsReferencedata = [
					'sid' => $sid,
					'lead_id' => $lead_id,
					'handler_id' => session('unique_id'),
					'admin_type' => session('db_priffix'),
				];
				$lmsReferenceModel->save($lmsReferencedata);
				if ($leadProfileDetail['lead_country_code'] == '91' || $leadProfileDetail['lead_country_code'] == '+91') {
					// sms 
					$pass = $getSidDetail['password'];
					$url = 'https://ldm.merishiksha.org';
					$templateId = '1707168863578982012';
					$message = "Welcome to Suresh Gyan Vihar University. Your Sid is $sid. and password is $pass Click on the url for login $url Thanks.";
					$this->SendMessageApi($leadProfileDetail['lead_mobile'], $message, $templateId);
				}
				// send sid and passord
				$senderDetail = [
					'email' => $leadProfileDetail['lead_email'],
					'sid' => $sid,
					'password' => $getSidDetail['password'],
					'name' => ucwords(trim(($leadProfileDetail['lead_first_name']) . ' ' . ($leadProfileDetail['lead_middle_name'] ?? '') . ' ' . ($leadProfileDetail['lead_last_name'] ?? ''))),
				];
				$email = [
					'view' => 'email/student/email',
					'from' => 'aakash.kumawat@mygyanvihar.com',
					'subject' => 'Welcome To Suresh Gyan Vihar University [leadform]',
					'replyto' => 'admissions@mygyanvihar.com',
					'replytoname' => 'Admissions Team',
				];
				$this->sendMailer(['email' => $email, 'senderDetail' => $senderDetail]);
				$url = $url = base_url('admin/process-application/' . $lead_id . '/' . $sid);
				return redirect()->to($url);
			}
		}

		return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try again After Sometime.'])->back();
	}

	public function applicant_list()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$appliantDetail = $lmsReferenceModel->select(['lms_db_reference_' . session('year') . '.sid', 'form_step', 'handler_id', 'admin_type', 'lead_id', 'password', "CONCAT(lead_first_name,' ',lead_middle_name,' ',lead_last_name) as lead_name", 'lead_email', 'lead_mobile', 'lead_country_code', 'lead_programe', 'course_name', 'course_code', 'lead_source', 'source_name', 'admisn_status', 'student_reg_fee_id', 'fs_name', 'sl_created_at'])
			->join($this->lmsDb . '.lead_profile_' . session('year'), $this->ssoDb . '.lms_db_reference_' . session('year') . '.lead_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lid', 'left')

			->join($this->ssoDb . '.session_courses_' . session('year'), $this->ssoDb . '.session_courses_' . session('year') . '.sc_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_programe', 'left')

			->join($this->ssoDb . '.course_info', $this->ssoDb . '.course_info.coi_id=' . $this->ssoDb  . '.session_courses_' . session('year') . '.course_id', 'left')

			->join($this->lmsDb . '.sources', $this->lmsDb . '.sources.source_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_source', 'left')
			->join('student_login_' . session('year'), 'student_login_' . session('year') . '.sid=lms_db_reference_' . session('year') . '.sid', 'left')
			->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.position', 'left')
			->where(['admin_type' => session('db_priffix')]);

		$whereInSources = $whereInProgram  = $whereDate = $whereInHandler = $whereInNationality = false;


		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['lr_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}
		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['lr_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
		}



		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
			$appliantDetail = $appliantDetail->whereIn('lead_source', $whereInSources);
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
			$appliantDetail = $appliantDetail->whereIn('lead_programe', $whereInProgram);
		}
		if (array_filter($_GET['handlers'] ?? []) != []  && isset($_GET['handlers'])) {
			$whereInHandler = $_GET['handlers'] ?? [];
			$appliantDetail = $appliantDetail->whereIn('handler_id', $whereInHandler);
		}
		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
			$appliantDetail = $appliantDetail->whereIn('student_reg_fee_id', $whereInNationality);
		}

		if (!empty($_GET['mobile']) && isset($_GET['mobile']))
			$whereDate['lead_mobile'] = $_GET['mobile'];

		if ($whereDate)
			$appliantDetail = $appliantDetail->where($whereDate);

		$data['total_leads'] = $appliantDetail->countAllResults(false);
		$data['leads'] = $appliantDetail->orderBy('lr_id', 'DESC')->paginate(500);
		$data['pager'] = $lmsReferenceModel->pager;
		$courseModel = new ApplicationModel('course_info', 'coi_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['course_name', 'course_code', 'dept_id', 'coi_id', 'level_id'])->findAll();
		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$data['sources'] = $sources ?? [];
		$lmsHandlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		$data['handlers'] = $lmsHandlerModel->select(['user_name', 'lu_id'])->where('user_report_to', session('id'))->where('user_deleted_status', 0)->orderBy('lu_id', 'DESC')->findAll();
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];
		$data['pagename'] = 'admin/applicant-list';
		return view('admin/index', $data);
	}

	public function process_application_old($lid = false,  $sid = false, $step = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		// check first admin this
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
		if (!$lmsRefData) {
			session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
			return redirect()->back();
		}

		$sidModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
		$getFormStep = $sidModel->select(['form_step', 'password'])->where(['sid' => $sid])->first();
		$pagename = 'admin/process-application';
		if ($getFormStep) {
			if ($getFormStep['form_step'] == '1') {
				$step = 'payment';
			} else if ($getFormStep['form_step'] == '2') {
				if ($step == false) {
					$step = 'profile-detail';
				} else if (in_array($step, ['profile-detail', 'parent-detail', 'address-detail']) !== false) {
				} else {
					session()->setFlashdata('toastr', ['error' => 'You are not allow to this form.']);
					return redirect()->to('admin/process-application/' . $lid . '/' . $sid . '/profile-detail');
				}
			} else if ($getFormStep['form_step'] == '3') {
				// allow profile-detail also
				if (in_array($step, ['profile-detail', 'parent-detail', 'address-detail']) === false) {
					if ($step == false || $step == 'academic-detail') {
						$step = 'academic-detail';
					} else {
						session()->setFlashdata('toastr', ['error' => 'You are not allow to this form.']);
						return redirect()->to('admin/process-application/' . $lid . '/' . $sid . '/academic-detail');
					}
				}
			} else if ($getFormStep['form_step'] == '4') {
				if (in_array($step, ['profile-detail', 'parent-detail', 'address-detail', 'academic-detail']) === false) {
					if ($step == false || $step == 'document-upload') {
						$step = 'document-upload';
					} else {
						session()->setFlashdata('toastr', ['error' => 'You are not allow to this form.']);
						return redirect()->to('admin/process-application/' . $lid . '/' . $sid . '/document-upload');
					}
				}
				// allow profile and academic detail
			} else if ($getFormStep['form_step'] == '5') {
				// allow profile, academic and document upload
				if (in_array($step, ['profile-detail', 'parent-detail', 'address-detail', 'academic-detail', 'document-upload']) === false) {
					if (in_array($step, ['profile-detail', 'parent-detail', 'address-detail', 'academic-detail']) === false) {
						if ($step == false || $step == 'review') {
							$step = 'review';
						} else {
							session()->setFlashdata('toastr', ['error' => 'You are not allow to this form.']);
							return redirect()->to('admin/process-application/' . $lid . '/' . $sid . '/review');
						}
					}
				}
			} else if ($getFormStep['form_step'] >= '6') {
				if (in_array($step, ['payment', 'profile-detail', 'parent-detail', 'address-detail', 'academic-detail', 'document-upload', 'review']) === false) {
					if ($step == false || $step == 'application-detail') {
						$step = 'application-detail';
						$pagename = 'admin/application-detail';
					} else {
						session()->setFlashdata('toastr', ['error' => 'Your application is under proccess so you cannot update your detail. if you want to edit then contact to University.']);
						return redirect()->to('admin/process-application/' . $lid . '/' . $sid . '/application-detail');
					}
				}
			}
		} else {
			session()->setFlashdata('toastr', ['error' => 'Their is not any student.']);
			return redirect()->back();
		}

		$valid_step = ['payment', 'profile-detail', 'parent-detail', 'address-detail', 'academic-detail', 'document-upload', 'review', 'application-detail'];
		if (in_array($step, $valid_step) === false) {
			session()->setFlashdata('toastr', ['error' => 'Not a valid step']);
			return redirect()->back();
		}
		$data = [];
		$data['lid'] = $lid;
		$data['sid'] = $sid;
		$data['step'] = $step;
		$data['pagename'] = $pagename;
		return view('admin/index', $data);
	}

	public function profile_step_action($lid = false, $sid = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		// check first admin this
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
		if (!$lmsRefData) {
			session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
			return redirect()->back();
		}
		$formStepModel = new ApplicationModel('form_steps', 'fs_id', $this->ssoDb);
		$group = 2;
		$formSteps = $formStepModel->where(['fs_status' => 1])->whereIn('fs_id', function (BaseBuilder $builder) use ($group) {
			return $builder->select('form_step_id')->from('fromstep_gp_members')->where(['fd_gp_id' => $group]);
		})->orderBy('position', 'ASC')->findAll() ?? [];

		$sidModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
		$getFormStep = $sidModel->select(['form_step', 'password', 'page_name', 'slug', 'position'])->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.position', 'left')->where(['sid' => $sid])->first() ?? [];
		$key = array_search($getFormStep['form_step'], array_column($formSteps, 'fs_id'));
		if ($key === false) {
			session()->setFlashdata('toastr', ['error' => 'Request action is not allow']);
			return redirect()->withInput()->back();
		}
		$currentFormStepPosition = $getFormStep['position'];
		$nextSlug = '';
		if ((array_key_exists($key + 1, $formSteps)) !== false) {
			$nextSlug = $formSteps[$key + 1]['slug'];
			$nextFormStepStatus = $formSteps[$key + 1]['fs_id'];
		} else {
			$nextFormStepDetail = $formStepModel->where(['fs_status' => 1, 'position>' => $formSteps[$key]['position']])->orderBy('position', 'ASC')->first() ?? [];
			$nextFormStepStatus = $nextFormStepDetail['fs_id'] ?? $getFormStep['form_step'];
		}


		if ($this->request->getMethod() == 'post') {
			// career couselling
			if ($this->request->getVar('btn') == 'schedule-meeting') {
				$postData = $this->request->getPost();
				$validtionRulesAndError = $this->getValidationRulesAndErrors($this->request, 'schedule-meeting');
				if (!$this->validate($validtionRulesAndError['rules'] ?? [], $validtionRulesAndError['errors'] ?? [])) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$adminModel = new ApplicationModel('admin_info', 'aid', $this->ssoDb);
					$adminUsers = $adminModel->select(['aid'])->where(['admin_status' => 1, 'admin_delete_status' => 0, 'admin_role' => 1])->findAll() ?? [];
					$scModel = new ApplicationModel('student_counselling_' . session('year'), 'sc_id', $this->ssoDb);
					$scLast = $scModel->select(['sc_admin'])->orderBy('sc_id', 'DESC')->first() ?? [];
					//dd($scLast);
					$lastAdmin = array_search(@$scLast['sc_admin'], array_column($adminUsers, 'aid'));

					//dd($lastAdmin);
					if ($lastAdmin === false) {
						$lastAdmin = -1;
					}

					if (@$adminUsers[@$lastAdmin + 1]['aid'] != null) {
						$newAdmin = @$adminUsers[@$lastAdmin + 1]['aid'];
					} else {
						$newAdmin = $adminUsers[0]['aid'];
					}
					$sc_data = [
						'sid' => $sid,
						'sc_time' => $postData['cdate'],
						'sc_status' => 0,
						'sc_admin' => $newAdmin
					];

					$counselling = $scModel->select(['sc_id', 'sc_time', 'sc_status', 'sc_link', 'sc_password'])->where('sid', $sid)->first() ?? [];
					if (@$counselling['sc_id'] != '') {
						$sc_data['sc_id'] = $counselling['sc_id'];
					}
					$sc = $scModel->save($sc_data);
					if ($sc) {
						session()->setFlashdata('toastr', ['success' => 'Counselling Scheduled successfully.']);
						return redirect()->back();
					} else {
						session()->setFlashdata('toastr', ['error' => 'Something went wrong.']);
						return redirect()->back();
					}
				}
			}
			if ($this->request->getVar('btn') == 'career-counseling') {
				$postData = $this->request->getPost();
				$validtionRulesAndError = $this->getValidationRulesAndErrors($this->request, 'career-counseling');
				if (!$this->validate($validtionRulesAndError['rules'] ?? [], $validtionRulesAndError['errors'] ?? [])) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$scModel = new ApplicationModel('student_counselling_' . session('year'), 'sc_id',  $this->ssoDb);
					$counselling = $scModel->select(['sc_id', 'sc_time', 'sc_status', 'sc_link', 'sc_password'])->where('sid', $sid)->first() ?? [];
					$sc = $scModel->set(['sc_feedback' => $postData['feedback'], 'sc_status' => 2])->where('sc_id', $counselling['sc_id'] ?? '')->update();
					if ($sc) {
						$requestedFormStepKey = array_search('career-counseling', array_column($formSteps, 'slug'));
						$requestFormStepPosition = $formSteps[$requestedFormStepKey ?? 'n']['position'] ?? 0;
						$url = 'admin/process-application/' . $lid . '/' . $sid . '/' . $nextSlug;
						if ($requestFormStepPosition == $currentFormStepPosition) {
							$updateForm = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
							$updateForm->set('form_step', $nextFormStepStatus)->where(['sid' => $sid])->update();
							session()->setFlashdata('toastr', ['success' => 'Feedback Submitted successfully and form step has been cleared.']);
							return redirect()->to($url);
						} else {
							session()->setFlashdata('toastr', ['error' => 'Feedback Submitted successfully submitted.']);
							return redirect()->to($url);
						}
					} else {
						session()->setFlashdata('toastr', ['error' => 'Something went wrong.']);
						return redirect()->back();
					}
					//dd(@$scLast['sc_admin'],count($adminUsers),$adminUsers,$lastAdmin,$newAdmin);
				}
			}
			// entrance exam

			if ($this->request->getVar('btn') == 'profile-detail') {
				$postData = $this->request->getPost();

				if ($this->request->getVar('nature') == 2) {
					if (count($postData['course_type']) != 3) {
						session()->setFlashdata('toastr', ['error' => 'Please select any three subject']);
						return redirect()->withInput()->back();
					}
				}
				$validtionRulesAndError = $this->getValidationRulesAndErrors($this->request, 'profile-detail');
				if (!$this->validate($validtionRulesAndError['rules'] ?? [], $validtionRulesAndError['errors'] ?? [])) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$stram_gp = $postData['nature'] == 2 ? (json_encode($postData['course_type'] ?? '[]')) : ($postData['course_type'] ?? null);
					$dataStudentInfo = [
						'sid' => $sid,
						'medium' => $postData['medium'] ?? '',
						'si_first_name' => $postData['firstname'] ?? '',
						'si_middle_name' => $postData['middlename'] ?? '',
						'si_last_name' => $postData['lastname'] ?? '',
						'program_id' => $postData['program'] ?? '',
						'dept_id' => $postData['discipline'] ?? '',
						'si_course_level' => $postData['level'] ?? '',
						'si_course_nature' => $postData['nature'] ?? '',
						'si_stream_group' => $stram_gp,
						'dd' => date('d'),
						'mm' => date('m'),
						'yy' => date('Y'),
					];
					if (isset($postData['student_info']) && !empty($postData['student_info'])) {
						$dataStudentInfo['si_id'] = $postData['student_info'];
					}
					$studenInfoModel = new ApplicationModel('student_info_' . session('year'), 'si_id', $this->ssoDb);
					$x = $studenInfoModel->save($dataStudentInfo);

					$dataStudentOther = [
						'sid' => $sid,
						'gender' => $postData['sex'],
						'dob' => $postData['dob'],
						'caste_id' => $postData['cat'],
						'religion_id' => $postData['religion'],
						'sip_type' => $postData['id_type'],
						'sip_no' => $postData['sip_no'],
						'landline' => $postData['landline'] ?? ''
					];
					if (isset($postData['student_other']) && !empty($postData['student_other'])) {
						$dataStudentOther['soi_id'] = $postData['student_other'];
					}
					$studentOtherModel = new ApplicationModel('student_other_info_' . session('year'), 'soi_id', $this->ssoDb);
					$y = $studentOtherModel->save($dataStudentOther);

					if ($x && $y) {
						session()->setFlashdata('toastr', ['success' => 'Your profile detail is successfully submited.']);
						return redirect()->to('admin/process-application/' . $lid . '/' . $sid . '/profile/parent');
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something went wrong try again after sometime.']);
				return redirect()->back();
			}
			if ($this->request->getVar('btn') == 'parent-detail') {
				$postData = $this->request->getPost();
				$validtionRulesAndError = $this->getValidationRulesAndErrors($this->request, 'parent-detail');
				if (!$this->validate($validtionRulesAndError['rules'] ?? [], $validtionRulesAndError['errors'] ?? [])) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$dataParentInfo = [
						'sid' => $sid,
						'father_name' => $postData['father_name'],
						'father_occupation' => $postData['father_occupation'],
						'father_income' => $postData['father_income'],
						'mother_name' => $postData['mother_name'],
						'mother_occupation' => $postData['mother_occupation'] ?? '',
						'mother_income' => $postData['mother_income'] ?? '0',
						'parent_mobile' => $postData['parent_mobile'],
						'parent_email' => $postData['parent_email'] ?? '',
					];
					if (isset($postData['parent']) && !empty($postData['parent'])) {
						$dataParentInfo['sfi_id'] = $postData['parent'];
					}
					$studenInfoModel = new ApplicationModel('student_family_info_' . session('year'), 'sfi_id', $this->ssoDb);
					$x = $studenInfoModel->save($dataParentInfo);

					if ($x) {
						session()->setFlashdata('toastr', ['success' => 'Your Parent detail is successfully submited.']);
						return redirect()->to('admin/process-application/' . $lid . '/' . $sid . '/profile/address');
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something went wrong try again after sometime.']);
				return redirect()->back();
			}
			if ($this->request->getVar('btn') == 'address-detail') {
				$requestedFormStepKey = array_search('profile', array_column($formSteps, 'slug'));
				$requestFormStepPosition = $formSteps[$requestedFormStepKey ?? 'n']['position'] ?? 0;
				//dd($currentFormStepPosition, $requestFormStepPosition, $nextFormStepStatus, $requestedFormStepKey, $formSteps);
				$postData = $this->request->getPost();
				$validtionRulesAndError = $this->getValidationRulesAndErrors($this->request, 'address-detail');
				if (!$this->validate($validtionRulesAndError['rules'] ?? [], $validtionRulesAndError['errors'] ?? [])) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$addressModel = new ApplicationModel('addresses_' . session('year'), 'a_id', $this->ssoDb);
					$studentAddress = new ApplicationModel('student_address_' . session('year'), 'sa_id', $this->ssoDb);
					$permanentAddressData = [
						'country' => $postData['country'],
						'state' => $postData['state'],
						'district' => $postData['district'],
						'street_address' => $postData['street_address'],
						'zipcode' => $postData['zipcode']
					];
					$y = true;
					if (isset($postData['permanent']) && !empty($postData['permanent']))
						$permanentAddressData['a_id'] = $postData['permanent'];
					if ($this->request->getVar('same') != '1') {
						$currentAddressData = [
							'country' => $postData['country1'],
							'state' => $postData['state1'],
							'district' => $postData['district1'],
							'street_address' => $postData['street_address1'],
							'zipcode' => $postData['zipcode1']
						];
						if (isset($postData['current']) && !empty($postData['current'])) {
							$currentAddressData['a_id'] = $postData['current'];
						}
						$y = $addressModel->save($currentAddressData);
						// insert into student Address
						if ((isset($postData['current']) && empty($postData['current'])) && $y) {
							$caddres_id = $addressModel->getInsertID();
							$studentCAddData = [
								'sid' => $sid,
								'address_id' => $caddres_id,
								'address_type' => 1
							];
							$studentAddress->save($studentCAddData);
						}
					} else {
						if (isset($postData['current']) && !empty($postData['current'])) {
							// check if current address is present then delete it

							$studentAddress->where(['address_id' => $postData['current'], 'type' => 1])->delete();
							$addressModel->where(['a_id' => $postData['current']])->delete();
						}
					}
					$x = $addressModel->save($permanentAddressData);
					$url = 'admin/process-application/' . $lid . '/' . $sid . '/' . $nextSlug;
					if ((isset($postData['permanent']) && empty($postData['permanent'])) && $x) {
						$paddres_id = $addressModel->getInsertID();
						$studentPAddData = [
							'sid' => $sid,
							'address_id' => $paddres_id,
							'address_type' => 0
						];
						$ch = $studentAddress->save($studentPAddData);
					}
					// check your form submitted or not fully
					$studenInfoModel = new ApplicationModel('student_family_info_' . session('year'), 'sfi_id', $this->ssoDb);
					$family = $studenInfoModel->where(['sid' => $sid])->first();
					$studentOtherModel = new ApplicationModel('student_other_info_' . session('year'), 'soi_id', $this->ssoDb);
					$otherInfo = $studentOtherModel->where(['sid' => $sid])->first();
					if ($family && $otherInfo) {
						$message = '';
						if ($requestFormStepPosition == $currentFormStepPosition) {
							$updateForm = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
							$updateForm->set('form_step', $nextFormStepStatus)->where(['sid' => $sid])->update();
						}
					} else {
						$url = 'admin/process-application/' . $lid . '/' . $sid . '/profile/personal';
						$message = ' Please Fill family and profile detail properly';
					}

					if ($x && $y) {
						session()->setFlashdata('toastr', ['success' => 'Your residentail address is successfully submited.' . $message]);
						return redirect()->to($url);
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something went wrong try again after sometime.']);
				return redirect()->back();
			}
			if ($this->request->getVar('btn') == 'academic-detail') {
				$postData = $this->request->getPost();
				$requestedFormStepKey = array_search('academic', array_column($formSteps, 'slug'));
				$requestFormStepPosition = $formSteps[$requestedFormStepKey ?? 'n']['position'] ?? 0;
				//dd($postData);
				$departmentModel = new ApplicationModel('student_info_' . session('year'), 'si_id', $this->ssoDb);
				$studentInfo = $departmentModel->where(['sid' => $sid])->first() ?? [];

				$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
				$courseInfo = $courseModel->select(['validation_level'])->join('course_info', 'session_courses_' . session('year') . '.course_id=course_info.coi_id')->where('sc_id', $studentInfo['program_id'] ?? '')->first();

				$elModel = new ApplicationModel('education_level', 'el_id', $this->ssoDb);
				$el = $elModel->select(['el_id', 'el_name'])->whereIn('el_id', json_decode($courseInfo['validation_level'] ?? ''))->where('el_status', 1)->orderBy('prority', 'ASC')->findAll() ?? [];
				$validtionRulesAndError = $this->getValidationRulesAndErrors($this->request, 'academic-detail', $el);
				if ($this->request->getPost('awaited') == 'on') {
					array_pop($el);
				}
				if (empty($validtionRulesAndError['rules'])) {
					session()->setFlashdata('toastr', ['error' => 'Please contact to university.']);
					return redirect()->withInput()->back();
				}
				if (!$this->validate($validtionRulesAndError['rules'] ?? [], $validtionRulesAndError['errors'] ?? [])) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$studentEducationModel = new ApplicationModel('student_education_' . session('year'), 'se_id', $this->ssoDb);

					foreach ($el as $level) {
						$educationData = [
							'sid' => $sid,
							'education_level' => $postData['education_level' . $level['el_id']],
							'board_university' => $postData['board' . $level['el_id']],
							'institute_school' => $postData['inst_name' . $level['el_id']],
							'year' => $postData['year' . $level['el_id']],
							'obtain_marks' => $postData['obtained' . $level['el_id']],
							'total_marks' => $postData['max_marks' . $level['el_id']],
							'grade_precentage' => $postData['percentage' . $level['el_id']],
							'grade_type' => $postData['resulttype' . $level['el_id']],
						];
						if ($ch = $studentEducationModel->select(['se_id'])->where(['sid' => $sid, 'education_level' => $postData['education_level' . $level['el_id']]])->first()) {
							$educationData['se_id'] = $ch['se_id'];
						}
						$studentEducationModel->save($educationData);
					}
					//check all education
					$url = 'admin/process-application/' . $lid . '/' . $sid . '/' . $nextSlug;
					$educationDetails = $studentEducationModel->select('distinct(education_level)')->where('sid', $sid)->whereIn('education_level', array_column($el, 'el_id'))->findAll() ?? 0;
					if (count($educationDetails) == count($el)) {
						$message = '';
						if ($requestFormStepPosition == $currentFormStepPosition) {
							$updateForm = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
							$updateForm->set('form_step', $nextFormStepStatus)->where(['sid' => $sid])->update();
						}
					} else {
						$url = 'admin/process-application/' . $lid . '/' . $sid . '/academic';
						$message = ' Please Fill Academic detail properly.';
					}
					session()->setFlashdata('toastr', ['success' => 'Your Academic Detail is successfully submited.' . $message]);
					return redirect()->to($url);
				}
				session()->setFlashdata('toastr', ['error' => 'Something went wrong try again after sometime.']);
				return redirect()->back();
			}
			if ($this->request->getVar('btn') == 'document-upload') {
				if (null !== $this->request->getPost('require')) {
					$rules = [
						'require' => 'required',
					];
					$error = [
						'require' => [
							'required' => 'Please Upload Required Documents',
						],
					];

					if ($this->validate($rules, $error)) {
						session()->setFlashdata('toastr', ['error' => 'Some Documents are pending!']);
					}
				} else {
					$requestedFormStepKey = array_search('document', array_column($formSteps, 'slug'));
					$requestFormStepPosition = $formSteps[$requestedFormStepKey ?? 'n']['position'] ?? 0;
					$url = 'admin/process-application/' . $lid . '/' . $sid . '/' . $nextSlug;
					if ($requestFormStepPosition == $currentFormStepPosition) {
						$updateForm = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
						$updateForm->set('form_step', $nextFormStepStatus)->where(['sid' => $sid])->update();
					}
					session()->setFlashdata('toastr', ['success' => 'Your document is successfully uploaded.']);
					return redirect()->to($url);
				}
			}
			if ($this->request->getVar('btn') == 'review') {
				if ($this->request->getVar('final_submit') == 1) {
					$requestedFormStepKey = array_search('review', array_column($formSteps, 'slug'));
					$requestFormStepPosition = $formSteps[$requestedFormStepKey ?? 'n']['position'] ?? 0;
					$url = 'admin/process-application/' . $lid . '/' . $sid . '/' . $nextSlug;
					if ($requestFormStepPosition == $currentFormStepPosition) {
						$updateForm = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
						$updateForm->set('form_step', $nextFormStepStatus)->set('admisn_status', 1)->where(['sid' => $sid])->update();
					}
					session()->setFlashdata('toastr', ['success' => 'Your application is successfully submited.']);
					return redirect()->to($url);
				}
				session()->setFlashdata('toastr', ['error' => 'To final submited please check the checkbox.']);
				return redirect()->back();
			}
		}
		session()->setFlashdata('toastr', ['error' => 'Your requested action is not valid.']);
		return redirect()->back();
	}



	public function upload_documents($lid = false, $sid = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
		if (!$lmsRefData) {
			session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
			return redirect()->back();
		}
		if ($this->request->getMethod() == 'post' && $this->request->getVar('document') == 'Upload') {
			$elModel = new ApplicationModel('document_type', 'dt_id', $this->ssoDb);
			$el = $elModel->select(['dt_id'])->where('dt_status', 0)->orderBy('dt_id', 'ASC')->findAll();
			$in_list = implode(',', array_column($el, 'dt_id'));
			$validtionRulesAndError = $this->getValidationRulesAndErrors($this->request, 'upload-doc', ['inlist' => $in_list]);
			if (!$this->validate($validtionRulesAndError['rules'] ?? [], $validtionRulesAndError['errors'] ?? [])) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err->getErrors())->back();
			} else {
				if ($this->request->getFile('document')->isValid()) {
					$mobile = $this->request->getFile('document');
					if ($mobile->isValid() && !$mobile->hasMoved()) {
						$fileURL = "/assets/uploads/" . session('year') . '/' . $sid;
						$mobile->move('ldm.merishiksha.org' . $fileURL, $mobile->getRandomName());
						$sdModel = new ApplicationModel('student_document_' . session('year'), 'sd_id', $this->ssoDb);
						$sd_dat = [
							'sid' => $sid,
							'document_type' => $this->request->getPost('document_type'),
							'sd_url' => '.' . $fileURL . '/' . $mobile->getName(),
						];
						$getDocument = $sdModel->select('sd_id')->where(['sid' => $sid, 'document_type' => $this->request->getVar('document_type')])->first();
						if ($getDocument) {
							$sd_dat['sd_id'] = $getDocument['sd_id'];
						}
						$sd_x = $sdModel->save($sd_dat);
						if ($sd_x) {
							session()->setFlashdata('toastr', ['success' => 'Your Document is Successfully uploaded.']);
							return redirect()->back();
						}
					}
				}
			}
		}
		if ($this->request->getMethod() == 'get' && $this->request->getVar('delete')) {
			//dd($this->request->getVar('delete'));
			$sdModel = new ApplicationModel('student_document_' . session('year'), 'sd_id', $this->ssoDb);
			$sd_dat = [
				'sd_url' => '',
			];
			$getDocument = $sdModel->select('sd_id')->where(['sid' => $sid, 'sd_id' => $this->request->getVar('delete')])->first();
			if ($getDocument) {
				$sd_dat['sd_id'] = $getDocument['sd_id'];
			}
			$sd_x = $sdModel->save($sd_dat);
			if ($sd_x) {
				session()->setFlashdata('toastr', ['success' => 'Your Document is Successfully deleted.']);
				return redirect()->back();
			}
			session()->setFlashdata('toastr', ['error' => 'Something Went Wrong. Try after sometime.']);
			return redirect()->back();
		}
		session()->setFlashdata('toastr', ['error' => 'Your requested action is not valid.']);
		return redirect()->back();
	}

	public function application_form_reopen()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$appliantDetail = $lmsReferenceModel->select(['lms_db_reference_' . session('year') . '.sid', 'er_desk', 'form_step', 'handler_id', 'admin_type', 'lead_id', 'password', "CONCAT(lead_first_name,' ',lead_middle_name,' ',lead_last_name) as lead_name", 'lead_email', 'lead_mobile', 'lead_country_code', 'lead_programe', 'course_name', 'course_code', 'lead_source', 'source_name', 'admisn_status', 'fs_name', 'sl_created_at'])
			->join($this->lmsDb . '.lead_profile_' . session('year'), $this->ssoDb . '.lms_db_reference_' . session('year') . '.lead_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lid')

			->join($this->ssoDb . '.session_courses_' . session('year'), $this->ssoDb . '.session_courses_' . session('year') . '.sc_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_programe')

			->join($this->ssoDb . '.course_info', $this->ssoDb . '.course_info.coi_id=' . $this->ssoDb  . '.session_courses_' . session('year') . '.course_id')

			->join($this->lmsDb . '.sources', $this->lmsDb . '.sources.source_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_source')
			->join('student_login_' . session('year'), 'student_login_' . session('year') . '.sid=lms_db_reference_' . session('year') . '.sid')
			->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.position', 'left')
			->join($this->ssoDb . '.edit_right_' . session('year'), $this->ssoDb . '.edit_right_' . session('year') . '.sid=lms_db_reference_' . session('year') . '.sid')
			->where(['admin_type' => session('db_priffix')]);

		$whereInSources = $whereInProgram  = $whereDate = $whereInHandler = false;


		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['lr_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}
		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['lr_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
		}

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
			$appliantDetail = $appliantDetail->whereIn('lead_source', $whereInSources);
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
			$appliantDetail = $appliantDetail->whereIn('lead_programe', $whereInProgram);
		}

		if (array_filter($_GET['handlers'] ?? []) != []  && isset($_GET['handlers'])) {
			$whereInHandler = $_GET['handlers'] ?? [];
			$appliantDetail = $appliantDetail->whereIn('handler_id', $whereInHandler);
		}
		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
			$appliantDetail = $appliantDetail->whereIn('student_reg_fee_id', $whereInNationality);
		}

		if (!empty($_GET['mobile']) && isset($_GET['mobile']))
			$whereDate['lead_mobile'] = $_GET['mobile'];

		if ($whereDate)
			$appliantDetail = $appliantDetail->where($whereDate);
		$appliantDetail->where('er_status', 0)->where(['er_from<' => date('Y-m-d H:i:s'), 'er_to>' => date('Y-m-d H:i:s')]);
		$data['total_leads'] = $appliantDetail->countAllResults(false);
		$data['leads'] = $appliantDetail->orderBy('er_id', 'DESC')->paginate(500);
		$data['pager'] = $lmsReferenceModel->pager;
		$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['sc_id as coi_id', 'course_name', 'course_code', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->findAll();

		$lmsHandlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		$data['handlers'] = $lmsHandlerModel->select(['user_name', 'lu_id'])->where('user_report_to', session('id'))->where('user_deleted_status', 0)->orderBy('lu_id', 'DESC')->findAll();

		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$data['sources'] = $sources ?? [];
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];
		$data['pagename'] = 'admin/application-form-reopen';
		return view('admin/index', $data);
	}
	public function edit_application_form($lid = false,  $sid = false, $step = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		// check first admin this
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
		if (!$lmsRefData) {
			session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
			return redirect()->back();
		}
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
		if (!$lmsRefData) {
			session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
			return redirect()->back();
		}

		$sidModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
		$getFormStep = $sidModel->select(['form_step', 'password'])->where(['sid' => $sid])->first();
		$pagename = 'admin/edit-application-form';
		if ($getFormStep) {
			$formReopenModel = new ApplicationModel('edit_right_' . session('year'), 'er_id', $this->ssoDb);
			$checkEligible = $formReopenModel->select('er_id')->where('sid', $sid)->where('er_status', 0)->where(['er_from<' => date('Y-m-d H:i:s'), 'er_to>' => date('Y-m-d H:i:s')])->first();
			// check edit right is Done than or open than got this order wise go to profile
			if (!$checkEligible) {
				session()->setFlashdata('toastr', ['warning' => 'Reopen Application Form has been already fill and Submit OR Reopen Application Form time is expire. If you want to reopen than contact to university']);
				$step = 'application-detail';
				$pagename = 'admin/application-detail';
			} else {
				if (in_array($step, ['profile-detail', 'parent-detail', 'address-detail', 'academic-detail', 'document-upload']) !== false) {
				} else {
					$step = 'review';
				}
			}
		} else {
			session()->setFlashdata('toastr', ['error' => 'Their is not any student.']);
			return redirect()->back();
		}

		$valid_step = ['payment', 'profile-detail', 'parent-detail', 'address-detail', 'academic-detail', 'document-upload', 'review', 'application-detail'];
		if (in_array($step, $valid_step) === false) {
			session()->setFlashdata('toastr', ['error' => 'Not a valid step']);
			return redirect()->back();
		}
		$data = [];

		$editRightRemarkModel = new ApplicationModel('student_desk_status_' . session('year'), 'sds_id', $this->ssoDb);
		$data['editRemark'] = $editRightRemarkModel->select(['sds_remark'])->where(['sid' => $sid, 'desk_status' => 'Edit Right Given'])->first() ?? [];

		$data['lid'] = $lid;
		$data['sid'] = $sid;
		$data['step'] = $step;
		$data['pagename'] = $pagename;
		return view('admin/index', $data);
	}
	public function edit_profile_step_action($lid = false, $sid = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		// check first admin this
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
		if (!$lmsRefData) {
			session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
			return redirect()->back();
		}
		$formReopenModel = new ApplicationModel('edit_right_' . session('year'), 'er_id', $this->ssoDb);
		$checkEligible = $formReopenModel->select('er_id')->where('sid', $sid)->where('er_status', 0)->where(['er_from<' => date('Y-m-d H:i:s'), 'er_to>' => date('Y-m-d H:i:s')])->first();
		if (!$checkEligible) {
			session()->setFlashdata('toastr', ['warning' => 'Reopen Application Form has been already fill and Submit OR Reopen Application Form time is expire. If you want to reopen than contact to university']);
			return redirect()->back();
		}
		if ($this->request->getMethod() == 'post') {
			if ($this->request->getVar('btn') == 'profile-detail') {
				$postData = $this->request->getPost();
				$rules = [
					'medium' => 'required|numeric',
					'discipline' => 'required|numeric',
					'program' => 'required|numeric',
					'course_type' => 'required',
					'firstname' => 'required|min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]',
					'sex' => 'required|in_list[0,1,2]',
					'dob' => 'required|string',
					'religion' => 'required|numeric',
					'cat' => 'required|numeric',
					'id_type' => 'required|in_list[1,2,3,4,5]',
				];
				if ($this->request->getVar('nature') == 2) {
					if (count($postData['course_type']) != 3) {
						session()->setFlashdata('toastr', ['error' => 'Please select any three subject']);
						return redirect()->withInput()->back();
					}
				}
				if ($this->request->getVar('id_type') == 1) {
					$rules['sip_no'] = 'required|regex_match[/^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$/]';
				}
				if ($this->request->getVar('id_type') == 2) {
					$rules['sip_no'] = 'required|regex_match[/^([a-zA-Z]){3}([0-9]){7}$/]';
				}
				if ($this->request->getVar('id_type') == 3) {
					$rules['sip_no'] = 'required|regex_match[/^([a-zA-Z]){2}([0-9]){13}$/]';
				}
				if ($this->request->getVar('id_type') == 4) {
					$rules['sip_no'] = 'required|regex_match[/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}$/]';
				}

				if ($this->request->getVar('middlename') != '') {
					$rules['middlename'] = 'min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]';
				}
				if ($this->request->getVar('lastname') != '') {
					$rules['lastname'] = 'min_length[3]|max_length[255]|regex_match[^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$]';
				}
				if ($this->request->getVar('landline') != '') {
					$rules['landline'] = 'min_length[6]|max_length[10]|numeric';
				}
				$errors = [
					'medium' => [
						'required' => 'Please select a Medium.',
						'numeric' => 'Your Selected Medium is not Valid.'
					],
					'discipline' => [
						'required' => 'Please Provide a valid department.',
						'numeric' => 'Your Selected option is not Valid.'
					],
					'program' => [
						'required' => 'Please Provide a valid Program.',
						'numeric' => 'Your Selected option is not Valid.'
					],
					'firstname' => [
						'required' => 'First Name is required.',
						'min_length' => 'First Name minimum lenght has been 3.',
						'max_length' => 'First Name maximum lenght has been 255.',
						'regex_match' => 'First Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)',
					],
					'lastname' => [
						'min_length' => 'Last Name minimum lenght has been 3.',
						'max_length' => 'Last Name maximum lenght has been 255.',
						'regex_match' => 'Last Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)'
					],
					'middlename' => [
						'min_length' => 'Middle Name minimum lenght has been 3.',
						'max_length' => 'Middle Name maximum lenght has been 255.',
						'regex_match' => 'Middle Name is allow only alphabates(A-Z,a-z), space( ), and DOT(.)'
					],
					'sex' => [
						'required' => 'Please select a gender.',
						'in_list' => 'Please select a valid gender.'
					],
					'dob' => [
						'required' => 'Please select a date.',
						'string' => 'Your Date of Birth not in String.'
					],
					'religion' => [
						'required' => 'Please Provide a valid Religion.',
						'numeric' => 'Your Selected option is not Valid.'
					],
					'cat' => [
						'required' => 'Please Provide a valid Caste.',
						'numeric' => 'Your Selected option is not Valid.'
					],
					'landline' => [
						'numeric' => 'Landline only support digits.',
						'min_length' => 'Landline Support minimum 6 digit length.',
						'max_length' => 'Landline Support minimum 10 digit length.',
					],
					'course_type' => [
						'required' => 'Something Went Wrong.',
					],
					'aadhar' => [
						'required' => 'Please Enter 12 digit Aadhar No.',
						'regex_match' => 'Plase Enter Correct Aadhar No.',
					]
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$stram_gp = $postData['nature'] == 2 ? (json_encode($postData['course_type'] ?? '[]')) : ($postData['course_type'] ?? null);
					$dataStudentInfo = [
						'sid' => $sid,
						'medium' => $postData['medium'] ?? '',
						'si_first_name' => $postData['firstname'] ?? '',
						'si_middle_name' => $postData['middlename'] ?? '',
						'si_last_name' => $postData['lastname'] ?? '',
						'program_id' => $postData['program'] ?? '',
						'dept_id' => $postData['discipline'] ?? '',
						'si_course_level' => $postData['level'] ?? '',
						'si_course_nature' => $postData['nature'] ?? '',
						'si_stream_group' => $stram_gp,
						'dd' => date('d'),
						'mm' => date('m'),
						'yy' => date('Y'),
					];
					if (isset($postData['student_info']) && !empty($postData['student_info'])) {
						$dataStudentInfo['si_id'] = $postData['student_info'];
					}
					$studenInfoModel = new ApplicationModel('student_info_' . session('year'), 'si_id', $this->ssoDb);
					$x = $studenInfoModel->save($dataStudentInfo);

					$dataStudentOther = [
						'sid' => $sid,
						'gender' => $postData['sex'],
						'dob' => $postData['dob'],
						'caste_id' => $postData['cat'],
						'religion_id' => $postData['religion'],
						'aadhar' => $postData['aadhar'],
						'landline' => $postData['landline'] ?? ''
					];
					if (isset($postData['student_other']) && !empty($postData['student_other'])) {
						$dataStudentOther['soi_id'] = $postData['student_other'];
					}
					$studentOtherModel = new ApplicationModel('student_other_info_' . session('year'), 'soi_id', $this->ssoDb);
					$y = $studentOtherModel->save($dataStudentOther);

					if ($x && $y) {
						session()->setFlashdata('toastr', ['success' => 'Your profile detail is successfully submited.']);
						return redirect()->to('admin/edit-application-form/' . $lid . '/' . $sid . '/parent-detail');
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something went wrong try again after sometime.']);
				return redirect()->back();
			}
			if ($this->request->getVar('btn') == 'parent-detail') {
				$postData = $this->request->getPost();
				$rules = [
					'father_name' => 'required|min_length[3]|max_length[255]|alpha_space',
					'mother_name' => 'required|min_length[3]|max_length[255]|alpha_space',
					'father_income' => 'required|numeric',
					//'mother_income'=>'required|numeric',
					//'mother_occupation'=>'required|max_length[255]|alpha_space',
					'father_occupation' => 'required|max_length[255]|alpha_space',
					//'parent_email'=>'required|valid_email',
					'parent_mobile' => 'required|min_length[8]|max_length[13]|numeric'
				];

				$errors = [
					'father_name' => [
						'required' => 'Father Name is required.',
						'min_length' => 'Father Name minimum lenght has been 3.',
						'max_length' => 'Father Name maximum lenght has been 255.',
						'alpha_space' => 'Father Name is support Alphabets and white Space.',
					],
					'father_occupation' => [
						'required' => 'Father Occupation is required.',
						'max_length' => 'Father Occupation maximum lenght has been 255.',
						'alpha_space' => 'Father Occupation is support Alphabets and white Space.',
					],
					'father_income' => [
						'numeric' => 'Fateher\'s Income only support digits.',
						'required' => 'Fateher\'s Income is required.',

					],
					'mother_name' => [
						'required' => 'Mother Name is required.',
						'min_length' => 'Mother Name minimum lenght has been 3.',
						'max_length' => 'Mother Name maximum lenght has been 255.',
						'alpha_space' => 'Mother Name is support Alphabets and white Space.',
					],
					'mother_occupation' => [
						'required' => 'Mother\'s Occupation is required.',
						'max_length' => 'Mother\'s Occupation maximum lenght has been 255.',
						'alpha_space' => 'Mother\'s Occupation is support Alphabets and white Space.',
					],
					'mother_income' => [
						'numeric' => 'Mother\'s Income only support digits.',
						'required' => 'Mother\'s Income is required.',

					],
					'parent_email' => [
						'required' => 'Parent Email is required.',
						'valid_email' => 'Please provide a valid email address.'
					],
					'parent_mobile' => [
						'required' => 'Parent mobile number is required.',
						'min_length' => 'Parent mobile number minimum lenght has been 8.',
						'max_length' => 'Parent mobile number maximum lenght has been 13.',
						'numeric' => 'Parent mobile number only support digits.'
					]
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$dataParentInfo = [
						'sid' => $sid,
						'father_name' => $postData['father_name'],
						'father_occupation' => $postData['father_occupation'],
						'father_income' => $postData['father_income'],
						'mother_name' => $postData['mother_name'],
						'mother_occupation' => $postData['mother_occupation'] ?? '',
						'mother_income' => $postData['mother_income'] ?? '0',
						'parent_mobile' => $postData['parent_mobile'],
						'parent_email' => $postData['parent_email'] ?? '',
					];
					if (isset($postData['parent']) && !empty($postData['parent'])) {
						$dataParentInfo['sfi_id'] = $postData['parent'];
					}
					$studenInfoModel = new ApplicationModel('student_family_info_' . session('year'), 'sfi_id', $this->ssoDb);
					$x = $studenInfoModel->save($dataParentInfo);

					if ($x) {
						session()->setFlashdata('toastr', ['success' => 'Your Parent detail is successfully submited.']);
						return redirect()->to('admin/edit-application-form/' . $lid . '/' . $sid . '/address-detail');
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something went wrong try again after sometime.']);
				return redirect()->back();
			}
			if ($this->request->getVar('btn') == 'address-detail') {
				$postData = $this->request->getPost();
				$rules = [
					'country' => 'required|min_length[3]|max_length[255]|string',
					'state' => 'required|min_length[3]|max_length[255]|string',
					'district' => 'required|max_length[255]|string',
					'street_address' => 'required|max_length[255]|string',
					'zipcode' => 'required|min_length[4]|max_length[6]|numeric'
				];
				if ($this->request->getVar('same') != '1') {
					$rules = [
						'country' => 'required|max_length[255]|string',
						'state' => 'required|max_length[255]|string',
						'district' => 'required|max_length[255]|string',
						'street_address' => 'required|max_length[255]|string',
						'zipcode' => 'required|min_length[4]|max_length[8]|numeric',
						'country1' => 'required|max_length[255]|string',
						'state1' => 'required|max_length[255]|string',
						'district1' => 'required|max_length[255]|string',
						'street_address1' => 'required|max_length[255]|string',
						'zipcode1' => 'required|min_length[4]|max_length[8]|numeric'
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
					'street_address' => [
						'required' => 'Street address is required.',
						'max_length' => 'Street address maximum lenght has been 255.',
						'string' => 'Street address should be a string.',
					],
					'zipcode' => [
						'required' => 'Permanent zipcode is required.',
						'min_length' => 'Permanent zipcode minimum lenght has been 4.',
						'max_length' => 'Permanent zipcode maximum lenght has been 8.',
						'numeric' => 'Permanent zipcode only support digits.'
					],
					'zipcode1' => [
						'required' => 'Zipcode is required.',
						'min_length' => 'Zipcode minimum lenght has been 4.',
						'max_length' => 'Zipcode maximum lenght has been 8.',
						'numeric' => 'Zipcode only support digits.'
					]
				];
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$addressModel = new ApplicationModel('addresses_' . session('year'), 'a_id', $this->ssoDb);
					$studentAddress = new ApplicationModel('student_address_' . session('year'), 'sa_id', $this->ssoDb);
					$permanentAddressData = [
						'country' => $postData['country'],
						'state' => $postData['state'],
						'district' => $postData['district'],
						'street_address' => $postData['street_address'],
						'zipcode' => $postData['zipcode']
					];
					$y = true;
					if (isset($postData['permanent']) && !empty($postData['permanent']))
						$permanentAddressData['a_id'] = $postData['permanent'];
					if ($this->request->getVar('same') != '1') {
						$currentAddressData = [
							'country' => $postData['country1'],
							'state' => $postData['state1'],
							'district' => $postData['district1'],
							'street_address' => $postData['street_address1'],
							'zipcode' => $postData['zipcode1']
						];
						if (isset($postData['current']) && !empty($postData['current'])) {
							$currentAddressData['a_id'] = $postData['current'];
						}
						$y = $addressModel->save($currentAddressData);
						// insert into student Address
						if ((isset($postData['current']) && empty($postData['current'])) && $y) {
							$caddres_id = $addressModel->getInsertID();
							$studentCAddData = [
								'sid' => $sid,
								'address_id' => $caddres_id,
								'address_type' => 1
							];
							$studentAddress->save($studentCAddData);
						}
					} else {
						if (isset($postData['current']) && !empty($postData['current'])) {
							// check if current address is present then delete it

							$studentAddress->where(['address_id' => $postData['current'], 'type' => 1])->delete();
							$addressModel->where(['a_id' => $postData['current']])->delete();
						}
					}
					$x = $addressModel->save($permanentAddressData);
					$url = 'admin/edit-application-form/' . $lid . '/' . $sid . '/academic-detail';
					if ((isset($postData['permanent']) && empty($postData['permanent'])) && $x) {
						$paddres_id = $addressModel->getInsertID();
						$studentPAddData = [
							'sid' => $sid,
							'address_id' => $paddres_id,
							'address_type' => 0
						];
						$ch = $studentAddress->save($studentPAddData);
					}
					// check your form submitted or not fully
					$studenInfoModel = new ApplicationModel('student_family_info_' . session('year'), 'sfi_id', $this->ssoDb);
					$family = $studenInfoModel->where(['sid' => $sid])->first();
					$studentOtherModel = new ApplicationModel('student_other_info_' . session('year'), 'soi_id', $this->ssoDb);
					$otherInfo = $studentOtherModel->where(['sid' => $sid])->first();
					if ($family && $otherInfo) {
						$message = '';
					} else {
						$url = 'admin/edit-application-form/' . $lid . '/' . $sid . '/profile-detail';
						$message = ' Please Fill family and profile detail properly';
					}


					if ($x && $y) {
						session()->setFlashdata('toastr', ['success' => 'Your residentail address is successfully submited.' . $message]);
						return redirect()->to($url);
					}
				}
				session()->setFlashdata('toastr', ['error' => 'Something went wrong try again after sometime.']);
				return redirect()->back();
			}
			if ($this->request->getVar('btn') == 'academic-detail') {
				$postData = $this->request->getPost();
				//dd($postData);
				$departmentModel = new ApplicationModel('student_info_' . session('year'), 'si_id', $this->ssoDb);
				$studentInfo = $departmentModel->where(['sid' => $sid])->first() ?? [];

				$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
				$courseInfo = $courseModel->select(['validation_level'])->join('course_info', 'session_courses_' . session('year') . '.course_id=course_info.coi_id')->where('sc_id', $studentInfo['program_id'] ?? '')->first();

				$elModel = new ApplicationModel('education_level', 'el_id', $this->ssoDb);
				$el = $elModel->select(['el_id', 'el_name'])->whereIn('el_id', json_decode($courseInfo['validation_level'] ?? ''))->where('el_status', 1)->orderBy('prority', 'ASC')->findAll();
				$rules = [];
				$errors = [];
				foreach ($el as $level) {

					$rules['board' . $level['el_id']] = 'required|max_length[255]|alpha_space';
					$rules['inst_name' . $level['el_id']] = 'required|max_length[255]|alpha_space';
					$rules['year' . $level['el_id']] = 'required|valid_date[Y]|numeric|exact_length[4]';
					$rules['max_marks' . $level['el_id']] = 'required|numeric|max_length[4]';
					$rules['obtained' . $level['el_id']] = 'required|numeric|max_length[4]|required_with[max_marks' . $level['el_id'] . ']';
					$rules['resulttype' . $level['el_id']] = 'required|in_list[0,1]|numeric';
					$rules['percentage' . $level['el_id']] = 'required|numeric|less_than_equal_to[100]';

					$errors['board' . $level['el_id']] = [
						'required' => 'Board/University name is required.',
						'max_length' => 'Board/University name has maximum length 255 charactors.',
						'alpha_space' => 'Board/University name is contain only alphabets and space.'
					];
					$errors['inst_name' . $level['el_id']] = [
						'required' => 'Institude/School name is required.',
						'max_length' => 'Institude/School name has maximum length 255 charactors.',
						'alpha_space' => 'Institude/School name is contain only alphabets and space.'
					];
					$errors['year' . $level['el_id']] = [
						'required' => 'Passing year is required.',
						'valid_date' => 'Passing year is not valid.',
						'numeric' => 'Passing year contain only digits.',
						'exact_length' => 'Passing year has exact length 4 digits.'
					];
					$errors['max_marks' . $level['el_id']] = [
						'required' => 'Maximum mark is required.',
						'numeric' => 'Maximum mark contain only digits.',
						'max_length' => 'Maximum mark has maximum length 4 digits.'
					];
					$errors['obtained' . $level['el_id']] = [
						'required' => 'Obtained mark is required.',
						'numeric' => 'Obtained mark contain only digits.',
						'max_length' => 'Obtained mark has maximum length 4 digits.',
						'required_with' => "Please provide the maximum mark first."
					];
					$errors['resulttype' . $level['el_id']] = [
						'required' => 'Result type is required.',
						'numeric' => 'Selected result type is not valid.',
						'in_list' => 'Selected result type is not valid.'
					];
					$errors['percentage' . $level['el_id']] = [
						'required' => 'Percentage/Grade is required.',
						'numeric' => 'Percentage/Grade contain only digits.',
						'less_than_equal_to' => 'Percentage/Grade is not valid.'
					];
				}
				if (empty($rules)) {
					session()->setFlashdata('toastr', ['error' => 'Please contact to university.']);
					return redirect()->withInput()->back();
				}
				if (!$this->validate($rules, $errors)) {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err->getErrors())->back();
				} else {
					$studentEducationModel = new ApplicationModel('student_education_' . session('year'), 'se_id', $this->ssoDb);

					foreach ($el as $level) {
						$educationData = [
							'sid' => $sid,
							'education_level' => $postData['education_level' . $level['el_id']],
							'board_university' => $postData['board' . $level['el_id']],
							'institute_school' => $postData['inst_name' . $level['el_id']],
							'year' => $postData['year' . $level['el_id']],
							'obtain_marks' => $postData['obtained' . $level['el_id']],
							'total_marks' => $postData['max_marks' . $level['el_id']],
							'grade_precentage' => $postData['percentage' . $level['el_id']],
							'grade_type' => $postData['resulttype' . $level['el_id']],
						];
						if ($ch = $studentEducationModel->select(['se_id'])->where(['sid' => $sid, 'education_level' => $postData['education_level' . $level['el_id']]])->first()) {
							$educationData['se_id'] = $ch['se_id'];
						}
						$studentEducationModel->save($educationData);
					}
					//check all education
					$url = 'admin/edit-application-form/' . $lid . '/' . $sid . '/document-upload';
					$educationDetails = $studentEducationModel->select('distinct(education_level)')->where('sid', $sid)->whereIn('education_level', array_column($el, 'el_id'))->findAll() ?? 0;
					if (count($educationDetails) == count($el)) {
						$message = '';
					} else {
						$url = 'admin/edit-application-form/' . $lid . '/' . $sid . '/academic-detail';
						$message = ' Please Fill Academic detail properly.';
					}
					session()->setFlashdata('toastr', ['success' => 'Your Academic Detail is successfully submited.' . $message]);
					return redirect()->to($url);
				}
				session()->setFlashdata('toastr', ['error' => 'Something went wrong try again after sometime.']);
				return redirect()->back();
			}
			if ($this->request->getVar('btn') == 'document-upload') {
				if (null !== $this->request->getPost('require')) {
					$rules = [
						'require' => 'required',
					];
					$error = [
						'require' => [
							'required' => 'Please Upload Required Documents',
						],
					];

					if ($this->validate($rules, $error)) {
						session()->setFlashdata('toastr', ['error' => 'Some Documents are pending!']);
					}
				} else {
					$url = 'admin/edit-application-form/' . $lid . '/' . $sid . '/review';
					session()->setFlashdata('toastr', ['success' => 'Your document is successfully uploaded.']);
					return redirect()->to($url);
				}
			}
			if ($this->request->getVar('btn') == 'review') {
				if ($this->request->getVar('final_submit') == 1) {
					// close form edit list
					$formReopenModel->save(['er_id' => $checkEligible['er_id'], 'er_status' => 1]);
					$url = 'admin/process-application/' . $lid . '/' . $sid . '/application-detail';
					session()->setFlashdata('toastr', ['success' => 'Your application is successfully submited.']);
					return redirect()->to($url);
				}
				session()->setFlashdata('toastr', ['error' => 'To final submited please check the checkbox.']);
				return redirect()->back();
			}
		}
		session()->setFlashdata('toastr', ['error' => 'Your requested action is not valid.']);
		return redirect()->back();
	}

	/***************** Application Proccess Opteration END *********************/

	/**************** Status Operations START ******************/
	// create lead status
	public function create_status()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		if ($this->request->getMethod() == 'post' && $this->request->getVar('btn') == 'create-status') {
			$postData = $this->request->getPost();
			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_space',
				'score' => 'required|numeric',
				'type' => 'required|in_list[0,1]',
				'info' => 'required|in_list[0,1,2]',
			];
			$errors = [
				'name' => [
					'required' => 'Status Name is required.',
					'min_length' => 'Status Name minimum lenght has been 3.',
					'max_length' => 'Status Name maximum lenght has been 255.',
					'alpha_space' => 'Status Name is support Alphabets ans white Space.',
				],

				'score' => [
					'required' => 'Status Score is required.',
					'numeric' => 'Status Score is contain digits.',
				],
				'info' => [
					'required' => 'Status Info is required.',
					'in_list' => 'Status Info is does not exits select box.',
				],
				'type' => [
					'required' => 'Status Type is required.',
					'in_list' => 'Status Type is does not exits select box.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err)->back();
			} else {
				$data = [
					'status_name' => $postData['name'],
					'status_get_more_info' => $postData['info'],
					'status_type' => $postData['type'],
					'score' => $postData['score'],

				];

				$statusModel =  new ApplicationModel('status', 'status_id', $this->lmsDb);

				$x = $statusModel->save($data);
				if ($x) {
					session()->setFlashdata('toastr', ['success' => 'Status Created Successfully Created']);
					return redirect()->to('/admin/status-list');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}
		$data['pagename'] = 'admin/new-status';
		//dd($data);
		return view('admin/index', $data);
	}
	// status list
	public function status_list()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];

		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);

		$data['statuses'] = $statusModel->select(['status_id', 'status_name', 'status_type', 'status_get_more_info', 'score', 'delete_status', 'status_created_at'])->where('delete_status', 0);

		if (!empty($_GET['type']) && isset($_GET['type'])) {
			$type = $_GET['type'] == 'handler' ? '0' : 1;
			$data['statuses'] = $data['statuses']->where('status_type', $type);
		}

		$data['total_status'] = $data['statuses']->countAllResults(false);
		$data['statuses'] = $data['statuses']->orderBy('status_id', 'DESC')->paginate(500);
		$data['pager'] = $statusModel->pager;

		$data['pagename'] = 'admin/status';
		//dd($data);
		return view('admin/index', $data);
	}
	// edit Status
	public function edit_status($status_id = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($status_id === false) {
			return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try again After Sometime.'])->back();
		}
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);

		$statusDetail = $statusModel->where('status_id', $status_id)->where('delete_status', 0)->first();
		if (!$statusDetail)
			return redirect()->with('toastr', ['error' => 'Status does not Exit.'])->back();
		$data = [];
		$data['statusDetail'] = $statusDetail;
		if ($this->request->getMethod() == 'post' && $this->request->getVar('btn') == 'edit-status') {
			$postData = $this->request->getPost();
			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
				'type' => 'required|in_list[0,1]',
				'info' => 'required|in_list[0,1,2]',
				'score' => 'required|numeric',
			];
			$errors = [
				'name' => [
					'required' => 'Status Name is required.',
					'min_length' => 'Status Name minimum lenght has been 3.',
					'max_length' => 'Status Name maximum lenght has been 255.',
					'alpha_space' => 'Status Name is support Alphabets ans white Space.',
				],

				'score' => [
					'required' => 'Status Score is required.',
					'numeric' => 'Status Score is contain digits.',
				],
				'info' => [
					'required' => 'Status Info is required.',
					'in_list' => 'Status Info is does not exits select box.',
				],
				'type' => [
					'required' => 'Status Type is required.',
					'in_list' => 'Status Type is does not exits select box.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err)->back();
			} else {
				$data = [
					'status_id' => $status_id,
					'status_name' => $postData['name'],
					'status_type' => $postData['type'],
					'score' => $postData['score'],
					'status_get_more_info' => $postData['info'],
				];

				$statusModel =  new ApplicationModel('status', 'status_id', $this->lmsDb);

				$x = $statusModel->save($data);
				if ($x) {
					session()->setFlashdata('toastr', ['success' => 'Status Successfully Updated']);
					return redirect()->to('/admin/status-list');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}

		$data['pagename'] = 'admin/edit-status';
		//dd($data);
		return view('admin/index', $data);
	}
	// adjust status score
	public function adjust_score_status()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];

		$data['pagename'] = 'admin/handlers';
		//dd($data);
		return view('admin/index', $data);
	}

	/**************** Status Operations START ******************/

	/**************** Source Operations START ******************/

	// create lead source
	public function create_source()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}

		$data = [];
		if ($this->request->getMethod() == 'post'  && $this->request->getVar('btn') == 'create-source') {
			$postData = $this->request->getPost();
			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_space',
				'score' => 'required|numeric',
			];
			$errors = [
				'name' => [
					'required' => 'Source Name is required.',
					'min_length' => 'Source Name minimum lenght has been 3.',
					'max_length' => 'Source Name maximum lenght has been 255.',
					'alpha_space' => 'Source Name is support Alphabets ans white Space.',
				],
				'score' => [
					'required' => 'Source Score is required.',
					'numeric' => 'Source Score is contain digits only.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err)->back();
			} else {
				$data = [
					'source_name' => $postData['name'],
					'source_score' => $postData['score'],
					'source_handler_id' => ($postData['handler'] ?? '') ? $postData['handler'] : null
				];

				$handlerModel =  new ApplicationModel('sources', 'source_id', $this->lmsDb);

				$x = $handlerModel->save($data);
				if ($x) {
					session()->setFlashdata('toastr', ['success' => 'Sources Successfully Created']);
					return redirect()->to('/admin/source-list');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}


		$handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

		$data['handlers'] = $handlerModel->select(['lu_id id', 'user_name name', 'user_email email'])->where('user_deleted_status', 0)->where(['user_report_to' => session('id')])->whereIn('user_role', [0, 1])->orderBy('user_name')->findAll() ?? [];

		$data['pagename'] = 'admin/new-source';
		return view('admin/index', $data);
	}

	// source list
	public function source_list()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];

		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);

		$data['sources'] = $sourceModel->select(['source_id', 'source_name', 'source_score'])->where('source_status', 1);

		$data['total_source'] = $data['sources']->countAllResults(false);
		$data['sources'] = $data['sources']->orderBy('source_id', 'DESC')->paginate(500);
		$data['pager'] = $sourceModel->pager;

		$data['pagename'] = 'admin/source';
		//dd($data);
		return view('admin/index', $data);
	}

	// update lead source
	public function edit_source($source_id = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($source_id === false) {
			return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try again After Sometime.'])->back();
		}
		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);

		$sourceDetail = $sourceModel->select(['*', 'source_handler_id handler_id'])->where('source_id', $source_id)->first();
		if (!$sourceDetail)
			return redirect()->with('toastr', ['error' => 'Source does not Exit.'])->back();
		$data = [];
		$data['sourceDetail'] = $sourceDetail;
		if ($this->request->getMethod() == 'post'  && $this->request->getVar('btn') == 'edit-source') {
			$postData = $this->request->getPost();
			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
				'score' => 'required|numeric',
				'status' => 'required|in_list[0,1]',
			];
			$errors = [
				'name' => [
					'required' => 'Source Name is required.',
					'min_length' => 'Source Name minimum lenght has been 3.',
					'max_length' => 'Source Name maximum lenght has been 255.',
					'alpha_numeric_space' => 'Source Name is support Alphabets, Digits and white Space Only.',
				],
				'score' => [
					'required' => 'Score is required.',
					'in_list' => 'Score is contain only digits.',
				],
				'status' => [
					'required' => 'Status is required.',
					'in_list' => 'Status is does not exits select box.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err)->back();
			} else {
				$data = [
					'source_id' => $source_id,
					'source_name' => $postData['name'],
					'source_score' => $postData['score'],
					'source_status' => $postData['status'],
					'source_handler_id' => ($postData['handler'] ?? '') ? $postData['handler'] : null
				];

				$sourceModel =  new ApplicationModel('sources', 'source_id', $this->lmsDb);

				$x = $sourceModel->save($data);
				if ($x) {
					session()->setFlashdata('toastr', ['success' => 'Source Successfully Updated']);
					return redirect()->to('/admin/source-list');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}

		$handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

		$data['handlers'] = $handlerModel->select(['lu_id id', 'user_name name', 'user_email email'])->where('user_deleted_status', 0)->where(['user_report_to' => session('id')])->whereIn('user_role', [0, 1])->orderBy('user_name')->findAll() ?? [];

		$data['pagename'] = 'admin/edit-source';

		return view('admin/index', $data);
	}

	// score
	// adjust score

	/**************** Source Operations END ******************/

	// delete lead source


	/**************** Email template Operations START ******************/
	// email template upload
	public function create_email_template()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		if ($this->request->getMethod() == 'post' && $this->request->getVar('btn') == 'create-email-template') {
			$postData = $this->request->getPost();

			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
				'template' => 'uploaded[template]|ext_in[template,php]', // file
				'have_attachment' => 'required|in_list[0,1]',
				'type' => 'required|in_list[0,1]',
				'score' => 'required|numeric',
			];
			if ($this->request->getVar('have_attachment') == 1) {
				$rules['attachment'] = 'uploaded[attachment]|ext_in[attachment,pdf,jpg,jpeg,png,docx]';
				$rules['attachment_name'] = 'required|min_length[3]|max_length[255]|alpha_numeric_space';
			}
			$errors = [
				'name' => [
					'required' => 'Template Name is required.',
					'min_length' => 'Template Name minimum lenght has been 3.',
					'max_length' => 'Template Name maximum lenght has been 255.',
					'alpha_numeric_space' => 'Template Name is support alphabets, digits and white space.',
				],
				'score' => [
					'required' => 'Score is required.',
					'numeric' => 'Score is contain only digits.',
				],
				'template' => [
					'uploaded' => 'Template is required.',
					'ext_in' => 'Template only accept php extension.',
				],
				'parameters' => [
					'required' => 'Parameters is required.',
					'string' => 'Parameters is not string.',
				],
				'type' => [
					'required' => 'Email Type is required.',
					'in_list' => 'Email Type is does not exits select box.',
				],
				'have_attachment' => [
					'required' => 'Have Attachment is required.',
					'in_list' => 'Have Attachment is does not exits select box.',
				],
				'attachment' => [
					'uploaded' => 'Attachment is required.',
					'ext_in' => 'Attachment only accept these extension .pdf, .jpg, .png, and .docx.',
				],
				'attachment_name' => [
					'required' => 'Attachment Name is required.',
					'min_length' => 'Attachment Name minimum lenght has been 3.',
					'max_length' => 'Attachment Name maximum lenght has been 255.',
					'alpha_numeric_space' => 'Attachment Name is support alphabets, digits and white space.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				$data['err'] = $err->listErrors();
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);

				return redirect()->withInput()->with('formerror', $err->getErrors())->back();
			} else {
				// upload file here
				if ($this->request->getFile('template')->isValid()) {
					$file = $this->request->getFile('template');
					if ($file->isValid() && !$file->hasMoved()) {
						$file->move('./system/app/Views/email', $file->getRandomName());
					}
				}

				$data1 = [
					'et_name' => $postData['name'],
					'et_template_url' => 'email/' . $file->getName(),
					'et_have_attachment' => $postData['have_attachment'],
					'et_type' => $postData['type'],
					'et_score' => $postData['score'],
				];

				$statusModel =  new ApplicationModel('email_templates', 'et_id', $this->lmsDb);

				$x = $statusModel->save($data1);
				if ($x) {
					if ($this->request->getVar('have_attachment') == 1) {
						// get template Email
						$etId = $statusModel->select(['et_id'])->where($data1)->first();
						if ($etId) {
							$etId = $etId['et_id'];
							if ($this->request->getFile('attachment')->isValid() && $etId) {
								$file = $this->request->getFile('attachment');
								$extention = $file->getExtension();
								if ($file->isValid() && !$file->hasMoved()) {
									$file->move('./assets/uploads/emailattachments', $file->getRandomName());
								}

								$att_data = [
									'attachment_name' => url_title($postData['attachment_name'], '-', TRUE) . "." . $extention,
									'email_template_id' => $etId,
									'ea_attachment' => '/assets/uploads/emailattachments/' . $file->getName(),
									'ea_file_type' => $file->getClientMimeType(),
								];
								$attachmentModel = new ApplicationModel('email_attachments', 'ea_id', $this->lmsDb);
								$attachmentModel->save($att_data);
							}
						}
					}
					session()->setFlashdata('toastr', ['success' => 'Email Template Successfully Created']);
					return redirect()->to('/admin/email-templates');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}
		$data['pagename'] = 'admin/new-email-template';
		//dd($data);
		return view('admin/index', $data);
	}
	// email Templates
	public function email_templates()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];

		$emailTemplateModel = new ApplicationModel('email_templates', 'et_id', $this->lmsDb);

		$data['email_templates'] = $emailTemplateModel->select(['et_id', 'et_name', 'et_template_url', 'et_have_attachment', 'et_type', 'et_status', 'et_score'])->where('et_delete_status', 0);

		$data['total_templates'] = $data['email_templates']->countAllResults(false);
		$data['email_templates'] = $data['email_templates']->orderBy('et_id', 'DESC')->paginate(500);
		$data['pager'] = $emailTemplateModel->pager;

		$data['pagename'] = 'admin/email-template-list';
		//dd($data);
		return view('admin/index', $data);
	}

	// edit email template
	public function edit_email_template($et_id = false)
	{

		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($et_id === false) {
			return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try again After Sometime.'])->back();
		}
		$emailTemplateModel = new ApplicationModel('email_templates', 'et_id', $this->lmsDb);

		$emailTemplateDetail = $emailTemplateModel->where('et_id', $et_id)->where('et_delete_status', 0)->first();
		if (!$emailTemplateDetail)
			return redirect()->with('toastr', ['error' => 'Email Templates does not Exit.'])->back();
		$data = [];
		$data['emailTemplateDetail'] = $emailTemplateDetail;
		if ($this->request->getMethod() == 'post'  && $this->request->getVar('btn') == 'edit-email-template') {
			$postData = $this->request->getPost();
			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
				'score' => 'required|numeric',
				'type' => 'required|in_list[0,1]',
			];
			$errors = [
				'name' => [
					'required' => 'Source Name is required.',
					'min_length' => 'Source Name minimum lenght has been 3.',
					'max_length' => 'Source Name maximum lenght has been 255.',
					'alpha_numeric_space' => 'Source Name is support Alphabets, Digits and white Space Only.',
				],
				'score' => [
					'required' => 'Score is required.',
					'in_list' => 'Score is contain only digits.',
				],
				'type' => [
					'required' => 'Type is required.',
					'in_list' => 'Type is does not exits select box.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err->getErrors())->back();
			} else {
				$data = [
					'et_id' => $et_id,
					'et_name' => $postData['name'],
					'et_type' => $postData['type'],
					'et_score' => $postData['score'],
				];

				$emailTemplateModel =  new ApplicationModel('email_templates', 'et_id', $this->lmsDb);

				$x = $emailTemplateModel->save($data);
				if ($x) {
					session()->setFlashdata('toastr', ['success' => 'Email Template Successfully Updated']);
					return redirect()->to('/admin/email-templates');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}
		$data['pagename'] = 'admin/edit-email-template';
		return view('admin/index', $data);
	}

	// email report
	// send Email bulk and invidual

	/**************** Email Template Operations END ******************/


	/**************** SMS Template Operations START ******************/
	// create sms template
	public function create_sms_template()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		if ($this->request->getMethod() == 'post' && $this->request->getVar('btn') == 'create-sms-template') {
			$postData = $this->request->getPost();

			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
				'approved_id' => 'required|alpha_numeric_space', // file
				'message' => 'required|string|max_length[255]', // file
				'parameter' => 'required',
				'type' => 'required|in_list[0,1]',
				'score' => 'required|numeric',
			];

			$errors = [
				'name' => [
					'required' => 'Template Name is required.',
					'min_length' => 'Template Name minimum lenght has been 3.',
					'max_length' => 'Template Name maximum lenght has been 255.',
					'alpha_numeric_space' => 'Template Name is support alphabets, digits and white space.',
				],
				'approved_id' => [
					'required' => 'Approved id is required.',
					'alpha_numeric_space' => 'Approved id is support alphabets, digits and white space.',
				],
				'message' => [
					'required' => 'Message is required.',
					'max_length' => 'Message maximum lenght has been 255.',
					'alpha_numeric_space' => 'Message is support alphabets, digits and white space.',
				],
				'parameters' => [
					'required' => 'Parameters is required.',
					'string' => 'Parameters are not in string.',
				],
				'type' => [
					'required' => 'Email Type is required.',
					'in_list' => 'Email Type is does not exits select box.',
				],
				'score' => [
					'required' => 'Score is required.',
					'numeric' => 'Score is contain only digits.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;

				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);

				return redirect()->withInput()->with('formerror', $err->getErrors())->back();
			} else {
				// upload file here


				$data1 = [
					'st_name' => $postData['name'],
					'st_approved_id' => $postData['approved_id'],
					'st_message' => $postData['message'],
					'st_parameter' => json_encode($postData['parameter'] ?? []),
					'st_score' => $postData['score'],
					'st_type' => $postData['type'],
				];

				$statusModel =  new ApplicationModel('sms_templates', 'st_id', $this->lmsDb);

				$x = $statusModel->save($data1);
				if ($x) {

					session()->setFlashdata('toastr', ['success' => 'SMS Template Successfully Created']);
					return redirect()->to('/admin/sms-templates');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}
		$data['pagename'] = 'admin/new-sms-template';
		//dd($data);
		return view('admin/index', $data);
	}
	// sms templates list
	public function sms_templates()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];

		$smsTemplateModel = new ApplicationModel('sms_templates', 'st_id', $this->lmsDb);

		$data['sms_templates'] = $smsTemplateModel->select(['st_id', 'st_name', 'st_approved_id', 'st_message', 'st_parameter', 'st_type', 'st_score', 'st_status'])->where('st_delete_status', 0);

		$data['total_templates'] = $data['sms_templates']->countAllResults(false);
		$data['sms_templates'] = $data['sms_templates']->orderBy('st_id', 'DESC')->paginate(500);
		$data['pager'] = $smsTemplateModel->pager;

		$data['pagename'] = 'admin/sms-template-list';
		//dd($data);
		return view('admin/index', $data);
	}
	// edit sms template
	public function edit_sms_template($st_id = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if ($st_id === false) {
			return redirect()->with('toastr', ['error' => 'Something Went Wrong. Please try again After Sometime.'])->back();
		}
		$smsTemplateModel = new ApplicationModel('sms_templates', 'st_id', $this->lmsDb);

		$smsTemplateDetail = $smsTemplateModel->where('st_id', $st_id)->where('st_delete_status', 0)->first();
		if (!$smsTemplateDetail)
			return redirect()->with('toastr', ['error' => 'SMS Templates does not Exit.'])->back();
		$data = [];
		$data['smsTemplateDetail'] = $smsTemplateDetail;
		if ($this->request->getMethod() == 'post'  && $this->request->getVar('btn') == 'edit-sms-template') {
			$postData = $this->request->getPost();
			$rules = [
				'name' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
				'approved_id' => 'required|alpha_numeric_space', // file
				'message' => 'required|string|max_length[255]', // file
				'parameter' => 'required',
				'type' => 'required|in_list[0,1]',
				'score' => 'required|numeric',
			];
			$errors = [
				'name' => [
					'required' => 'Template Name is required.',
					'min_length' => 'Template Name minimum lenght has been 3.',
					'max_length' => 'Template Name maximum lenght has been 255.',
					'alpha_numeric_space' => 'Template Name is support alphabets, digits and white space.',
				],
				'approved_id' => [
					'required' => 'Approved id is required.',
					'alpha_numeric_space' => 'Approved id is support alphabets, digits and white space.',
				],
				'message' => [
					'required' => 'Message is required.',
					'max_length' => 'Message maximum lenght has been 255.',
					'alpha_numeric_space' => 'Message is support alphabets, digits and white space.',
				],
				'parameter' => [
					'required' => 'Parameters is required.',
					'string' => 'Parameters are not in string.',
				],
				'type' => [
					'required' => 'Email Type is required.',
					'in_list' => 'Email Type is does not exits select box.',
				],
				'score' => [
					'required' => 'Score is required.',
					'numeric' => 'Score is contain only digits.',
				],
			];
			if (!$this->validate($rules, $errors)) {
				$err = $this->validator;
				session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
				return redirect()->withInput()->with('formerror', $err->getErrors())->back();
			} else {
				$data = [
					'st_id' => $st_id,
					'st_name' => $postData['name'],
					'st_approved_id' => $postData['approved_id'],
					'st_message' => $postData['message'],
					'st_parameter' => json_encode($postData['parameter'] ?? []),
					'st_score' => $postData['score'],
					'st_type' => $postData['type'],
				];
				$smsTemplateModel =  new ApplicationModel('sms_templates', 'st_id', $this->lmsDb);
				$x = $smsTemplateModel->save($data);
				if ($x) {
					session()->setFlashdata('toastr', ['success' => 'SMS Template Successfully Updated']);
					return redirect()->to('/admin/sms-templates');
				} else {
					$err = $this->validator;
					session()->setFlashdata('toastr', ['error' => 'Something Went Wrong']);
					return redirect()->withInput()->with('formerror', $err)->back();
				}
			}
		}

		$data['pagename'] = 'admin/edit-sms-template';

		return view('admin/index', $data);
	}

	// sms report
	// send sms bulk and invidual

	/**************** SMS Template Operations END ******************/


	public function htmlToPDF()
	{
		$dompdf = new Dompdf();
		$dompdf->loadHtml(view('test-view/print'));
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream('test.pdf');
	}








	// event 
	// form making

	// work load transfer

	// create notifcation
	// update notfication
	// delete notfication

	// report admission report for in which desk
	// process application

	// login activity



	public function logout()
	{

		if (session('id') && session('history_id')) {
			$admin = new ApplicationModel('admin_login_history', 'alh_id', $this->lmsDb);
			$data = [
				'alh_id' => session('history'),
				'logout_time' => time(),
			];
			$admin->save($data);
		}
		session()->destroy();
		return redirect()->to('/super-login');
	}

	public function under_construction()
	{
		$data['pagename'] = 'under-construction';
		return view('admin/index', $data);
	}


	// ticket system here
	public function tickets($ticket = null)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$tcpModel = new ApplicationModel('to_cc_person', 'tc_id', 'ticket_db');
		$tcp = $tcpModel->select(['tc_id'])->join('ticket_detail', 'ticket_detail.token_number=to_cc_person.token_id')->where(['tc_department' => session('id'), 'user_type' => 3, 'transfer' => 0])->whereIn('action_status', [1, 3])->countAllResults();
		$tfModel = new ApplicationModel('transfer', 'tf_id', 'ticket_db');
		$tf = $tfModel->select(['tf_id'])->join('ticket_detail', 'ticket_detail.token_number=transfer.token_id')->where(['tf_to' => session('id'), 'to_type' => 3])->whereIn('action_status', [1, 3])->countAllResults();
		$data['inbox'] = $tcp + $tf;

		$tgbModel = new ApplicationModel('token_generated_by', 'tgb_id', 'ticket_db');
		$data['sent'] = $tgbModel->select(['tgb_id'])->join('ticket_detail', 'ticket_detail.token_number=token_generated_by.token_id')->where(['user_id' => session('id'), 'user_type' => 3])->countAllResults();

		$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
		$data['answered'] = $tdModel->select(['tid'])->join('reply_to', 'reply_to.token_id=ticket_detail.token_number')->where(['user_id' => session('id'), 'user_type' => 3, 'action_status' => 4])->groupBy('reply_to.token_id')->countAllResults();

		$tfModel = new ApplicationModel('transfer', 'tf_id', 'ticket_db');
		$data['transfered'] = $tfModel->select(['tf_id'])->join('ticket_detail', 'ticket_detail.token_number=transfer.token_id')->where(['tf_from' => session('id'), 'from_type' => 3])->countAllResults();

		$data['closed'] = $tdModel->select(['tid'])->join('reply_to', 'reply_to.token_id=ticket_detail.token_number')->join('token_generated_by', 'token_generated_by.token_id=ticket_detail.token_number')->where(['reply_to.user_id' => session('id'), 'reply_to.user_type' => 3, 'action_status' => 2, 'token_generated_by.user_id!=' => session('id')])->groupBy('reply_to.token_id')->countAllResults();

		$tcModel = new CustomModel('ticket_db');
		$totalItems = $tcModel->customQuery("SELECT `token_id` from (
			(SELECT `token_id`, `tf_to` as `tc_department`, `title`, `subject`, `read_status`, `updated_at`, `action_status`, `status_name`, `status_color`,'transfer','type' FROM `transfer` JOIN `ticket_detail` ON `ticket_detail`.`token_number`=`transfer`.`token_id` JOIN `title` ON `title`.`t_id`=`ticket_detail`.`title_id` JOIN `status` ON `status`.`status_id`=`ticket_detail`.`action_status` WHERE `to_type` = 3 )
			UNION
			  (SELECT `token_id`, `tc_department`, `title`, `subject`, `read_status`, `updated_at`, `action_status`, `status_name`, `status_color`, `transfer`,`type` FROM `to_cc_person` JOIN `ticket_detail` ON `ticket_detail`.`token_number`=`to_cc_person`.`token_id` JOIN `title` ON `title`.`t_id`=`ticket_detail`.`title_id` JOIN `status` ON `status`.`status_id`=`ticket_detail`.`action_status` WHERE `user_type` = 3 AND `transfer` = 0 )
		) t GROUP BY token_id ;") ?? [];

		$data['team'] = count($totalItems);
		//Ticket View-----
		if ($ticket != null) {
			$tgbModel = new ApplicationModel('token_generated_by', 'tgb_id', 'ticket_db');
			$sender = $tgbModel->select(['user_id', 'user_type'])->where('token_id', $ticket)->first();
			if ($sender['user_type'] == 1) {
				$siModel = new ApplicationModel('student_info_' . session('year'), 'tf_id', $this->ssoDb);
				$name = $siModel->select(['si_first_name', 'si_middle_name', 'si_last_name'])->where('sid', $sender['user_id'])->first();
				$data['sender']['name'] = ucwords(trim($name['si_first_name'] . ' ' . $name['si_middle_name'] . ' ' . $name['si_last_name']));
				$data['sender']['sub'] = 'SID - ' . $sender['user_id'];
			} elseif ($sender['user_type'] == 2) {
				$siModel = new ApplicationModel('admin_info', 'aid', $this->ssoDb);
				$name = $siModel->select(['admin_name', 'dr_name'])->join('desk_role', 'desk_role.dr_id=admin_info.admin_role')->where('aid', $sender['user_id'])->first();
				$data['sender']['name'] = $name['admin_name'];
				$data['sender']['sub'] = ucwords($name['dr_name'] . ' desk');
			} elseif ($sender['user_type'] == 3) {
				$luModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
				$name = $luModel->select(['user_name', 'user_role'])->where('lu_id', $sender['user_id'])->first();
				$data['sender']['name'] = $name['user_name'];
				if ($name['user_role'] == 0) {
					$data['sender']['sub'] = 'Handler';
				} elseif ($name['user_role'] == 1) {
					$data['sender']['sub'] = 'Team-Leader';
				} elseif ($name['user_role'] == 2) {
					$data['sender']['sub'] = 'Admin';
				}
			} elseif ($sender['user_type'] == 4) {
				$guModel = new ApplicationModel('guest_users', 'gu_id', 'ticket_db');
				$name = $guModel->select(['gu_name'])->where('gu_id', $sender['user_id'])->first();
				$data['sender']['name'] = $name['gu_name'];
				$data['sender']['sub'] = 'Guest';
			}
			if ($_GET['step'] == 'sent') {
				$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
				$data['ticket'] = $tdModel->select(['token_number', 'title', 'subject', 'issue', 'token_generated_by.created_at', 'updated_at', 'action_status', 'status_name', 'status_color', 'attachment_id', 'priority'])
					->join('token_generated_by', 'token_generated_by.token_id=ticket_detail.token_number')
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->where(['token_number' => $ticket, 'user_id' => session('id'), 'user_type' => 3])->first();
				if (@$data['ticket'] == '') {
					session()->setFlashdata('toastr', ['error' => 'Ticket not found!']);
					return redirect()->back();
				}
				$tdModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
				$data['replies'] = $tdModel->select(['rt_created_at', 'reply_text', 'user_id', 'reply_by', 'attachment_id', 'user_type'])
					->join('reply', 'reply.reply_id=reply_to.reply_id')
					->where(['token_id' => $ticket])->orderBy('rt_id', 'ASC')->findAll();

				if ($this->request->getPost('answer') == 'Submit') {
					$rules = [
						'answer_text' => 'required|min_length[5]'
					];
					$error = [
						'answer_text' => [
							'required' => "Please Enter Reply Text.",
							'min_length' => "Reply Description should be minimum 5 charactors in length."
						],
					];
					if (!$this->validate($rules, $error)) {
						session()->setFlashdata('toastr', ['error' => 'Reply Description should be minimum 5 charactors in length.']);
						$data['validation'] = $this->validator;
					} else {
						$replyModel = new ApplicationModel('reply', 'reply_id', 'ticket_db');
						$reply_x = $replyModel->save(['reply_text' => $this->request->getPost('answer_text')]);
						if (!empty($_FILES['attachment']['name'])) {
							if ($this->request->getFile('attachment')->isValid()) {
								$mobile = $this->request->getFile('attachment');
								if ($mobile->isValid() && !$mobile->hasMoved()) {
									$fileURL = "./assets/uploads/ticket/" . $ticket;
									$name = $mobile->getClientName();
									$type = $mobile->getMimeType();
									$mobile->move($fileURL, $mobile->getClientName());

									$attModel = new ApplicationModel('attachment', 'att_id', 'ticket_db');
									$att_x = $attModel->save(['attachment' => base_url('assets/uploads/ticket/' . $ticket . '/' . $name), 'attachment_type' => $type]);
									if ($att_x) {
										$attachment_id = $attModel->getInsertID();
									}
								}
							}
						}
						if ($reply_x) {
							$reply_id = $replyModel->getInsertID();
							$rtModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
							$rt_x = $rtModel->save(['token_id' => $ticket, 'reply_id' => $reply_id, 'attachment_id' => $attachment_id, 'user_id' => session('id'), 'user_type' => 3, 'reply_by' => 3]);
							if ($rt_x) {
								$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
								$td_x = $tdModel->set(['action_status' => 3])->where('token_number', $ticket)->update();
								if ($td_x) {
									$ahModel = new ApplicationModel('action_history', 'ah_id', 'ticket_db');
									$ah_x = $ahModel->save(['ticket' => $ticket, 'action' => 'Replied', 'user_id' => session('id'), 'user_type' => 3]);
									if ($ah_x) {
										session()->setFlashdata('toastr', ['success' => 'Replied successfully.']);
										return redirect()->to('admin/tickets/' . $ticket . '?step=sent');
									}
								}
							}
						}
					}
				}

				if ($this->request->getPost('close') == 'Submit') {
					$rules = [
						'rating' => 'required|in_list[1,2,3,4,5]',
					];
					$error = [
						'rating' => [
							'required' => "Please Select Rating",
							'in_list' => "Please Select Rating from given options.",
						],
					];
					if (!$this->validate($rules, $error)) {
						$data['validation'] = $this->validator;
						session()->setFlashdata('toastr', ['error' => 'Please Select Rating from given options.']);
					} else {
						$sModel = new ApplicationModel('satisfication', 's_id', 'ticket_db');
						$s_x = $sModel->save(['token_id' => $ticket, 'rating' => $this->request->getPost('rating'), 'remark' => $this->request->getPost('remark')]);
						if ($s_x) {
							$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
							$td_x = $tdModel->set(['action_status' => 2])->where('token_number', $ticket)->update();
							if ($td_x) {
								$ahModel = new ApplicationModel('action_history', 'ah_id', 'ticket_db');
								$ah_x = $ahModel->save(['ticket' => $ticket, 'action' => 'Closed', 'user_id' => session('id'), 'user_type' => 3]);
								if ($ah_x) {
									session()->setFlashdata('toastr', ['success' => 'Ticket ' . $ticket . ' Closed Successfully.']);
									return redirect()->to('admin/tickets/' . $ticket . '?step=sent');
								}
							}
						}
					}
				}
			} elseif ($_GET['step'] == 'answered') {
				$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
				$data['ticket'] = $tdModel->select(['token_number', 'title', 'subject', 'issue', 'created_at', 'type', 'action_status', 'status_name', 'status_color', 'attachment_id', 'priority'])
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->join('to_cc_person', 'to_cc_person.token_id=ticket_detail.token_number')
					->where(['token_number' => $ticket, 'tc_department' => session('id'), 'user_type' => 3, 'action_status' => 4])->first();
				if (@$data['ticket'] == '') {
					$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
					$data['ticket'] = $tdModel->select(['token_number', 'title', 'subject', 'issue', 'transfer.created_at', 'action_status', 'status_name', 'status_color', 'attachment_id', 'priority'])
						->join('title', 'title.t_id=ticket_detail.title_id')
						->join('status', 'status.status_id=ticket_detail.action_status')
						->join('transfer', 'transfer.token_id=ticket_detail.token_number')
						->where(['token_number' => $ticket, 'tf_to' => session('id'), 'to_type' => 3])->first();
					if (@$data['ticket'] == '') {
						session()->setFlashdata('toastr', ['error' => 'Ticket not found!']);
						return redirect()->back();
					}
				}
				$tdModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
				$data['replies'] = $tdModel->select(['rt_created_at', 'reply_text', 'user_id', 'reply_by', 'attachment_id', 'user_type'])
					->join('reply', 'reply.reply_id=reply_to.reply_id')
					->where(['token_id' => $ticket])->orderBy('rt_id', 'ASC')->findAll();
			} elseif ($_GET['step'] == 'transfered') {
				$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
				$data['ticket'] = $tdModel->select(['token_number', 'title', 'subject', 'issue', 'transfer.created_at', 'action_status', 'status_name', 'status_color', 'tf_to', 'attachment_id', 'priority'])
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->join('transfer', 'transfer.token_id=ticket_detail.token_number')
					->where(['token_number' => $ticket, 'tf_from' => session('id'), 'from_type' => 3])->first();
				if (@$data['ticket'] == '') {
					session()->setFlashdata('toastr', ['error' => 'Ticket not found!']);
					return redirect()->back();
				}
				$tdModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
				$data['replies'] = $tdModel->select(['rt_created_at', 'reply_text', 'user_id', 'reply_by', 'attachment_id'])
					->join('reply', 'reply.reply_id=reply_to.reply_id')
					->where(['token_id' => $ticket])->orderBy('rt_id', 'ASC')->findAll();

				$drModel = new ApplicationModel('desk_role', 'dr_id', $this->ssoDb);
				$data['desk'] = $drModel->select(['dr_name'])->where('dr_id', $data['ticket']['tf_to'])->first();
			} elseif ($_GET['step'] == 'inbox') {
				$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
				$data['ticket'] = $tdModel->select(['token_number', 'title', 'subject', 'issue', 'created_at', 'type', 'action_status', 'status_name', 'status_color', 'attachment_id', 'priority'])
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->join('to_cc_person', 'to_cc_person.token_id=ticket_detail.token_number')
					->where(['token_number' => $ticket, 'tc_department' => session('id'), 'user_type' => 3, 'transfer' => 0])
					->whereIn('action_status', [1, 3])->first();

				$drModel = new ApplicationModel('desk_role', 'dr_id', $this->ssoDb);
				$data['desks'] = $drModel->select(['dr_name', 'dr_id'])->whereNotIn('dr_step', [11])->where(['dr_status' => 1])->findAll();

				$luModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
				$data['members'] = $luModel->select(['lu_id', 'user_name', 'user_role'])->where(['user_report_to' => session('id'), 'user_status' => 1, 'user_deleted_status' => 0])->findAll();

				$tdModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
				$data['replies'] = $tdModel->select(['rt_created_at', 'reply_text', 'user_id', 'reply_by', 'attachment_id', 'user_type'])
					->join('reply', 'reply.reply_id=reply_to.reply_id')
					->where(['token_id' => $ticket])->orderBy('rt_id', 'ASC')->findAll();

				if (@$data['ticket'] == '') {
					$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
					$data['ticket'] = $tdModel->select(['token_number', 'title', 'subject', 'issue', 'transfer.created_at', 'action_status', 'status_name', 'status_color', 'attachment_id', 'priority'])
						->join('title', 'title.t_id=ticket_detail.title_id')
						->join('status', 'status.status_id=ticket_detail.action_status')
						->join('transfer', 'transfer.token_id=ticket_detail.token_number')
						->where(['token_number' => $ticket, 'tf_to' => session('id'), 'to_type' => 3])
						->whereIn('action_status', [1, 3])->first();
					if (@$data['ticket'] == '') {
						session()->setFlashdata('toastr', ['error' => 'Ticket not found!']);
						return redirect()->back();
					} else {
						$tcpModel = new ApplicationModel('transfer', 'tf_id', 'ticket_db');
						$tcpModel->set(['read_status' => 1])->where(['token_id' => $ticket, 'tf_to' => session('id')])->update();
					}
				} else {
					$tcpModel = new ApplicationModel('to_cc_person', 'tc_id', 'ticket_db');
					$tcpModel->set(['read_status' => 1])->where(['token_id' => $ticket, 'tc_department' => session('id')])->update();
				}

				if ($this->request->getPost('transfer') == 'Submit') {
					$rules = [
						'to' => 'required',
					];
					$error = [
						'to' => [
							'required' => "Please Select Destination Desk",
						],
					];
					if (!$this->validate($rules, $error)) {
						session()->setFlashdata('toastr', ['error' => 'something went wrong.']);
						$data['validation'] = $this->validator;
					} else {
						$tcModel = new ApplicationModel('to_cc_person', 'tc_id', 'ticket_db');
						$tcModel->set(['transfer' => 1])->where(['token_id' => $ticket, 'tc_department' => session('id')])->update();

						$tfModel = new ApplicationModel('transfer', 'tf_id', 'ticket_db');
						$ex = explode('-', $this->request->getPost('to'));
						$tf_x = $tfModel->save(['tf_from' => session('id'), 'from_type' => 3, 'tf_to' => $ex[0], 'to_type' => $ex[1], 'token_id' => $ticket]);
						if ($tf_x) {
							$ahModel = new ApplicationModel('action_history', 'ah_id', 'ticket_db');
							$ah_x = $ahModel->save(['ticket' => $ticket, 'action' => 'Transfer', 'user_id' => session('id'), 'user_type' => 3]);
							if ($ah_x) {
								session()->setFlashdata('toastr', ['success' => 'Ticket Transferred Successfully.']);
								return redirect()->to('admin/tickets/' . $ticket . '?step=transfered');
							} else {
								session()->setFlashdata('toastr', ['success' => 'Ticket Transferred Successfully. Action History not saved.']);
								return redirect()->to('admin/tickets/' . $ticket . '?step=transfered');
							}
						} else {
							session()->setFlashdata('toastr', ['error' => 'Ticket not Transferred.']);
							return redirect()->to('admin/tickets?step=inbox');
						}
					}
				}
				if ($this->request->getPost('answer') == 'Submit') {
					$rules = [
						'answer_text' => 'required|min_length[5]'
					];
					$error = [
						'answer_text' => [
							'required' => "Please Enter Reply Text.",
							'min_length' => "Reply Description should be minimum 5 charactors in length."
						],
					];
					if ($data['ticket']['action_status'] == 1) {
						$rules = array_merge($rules, ['priority' => 'required|in_list[0,1,2]']);
						$error = array_merge($error, ['priority' => ['required' => "Please Select Priority", 'in_list' => "Please select correct Priority Option."]]);
					}
					if (!empty($_FILES['attachment']['name'])) {
						if ($this->request->getFile('attachment')->getMimeType() == 'application/pdf') {
							$rules = array_merge($rules, ['attachment' => 'max_size[attachment,2048]|mime_in[attachment,application/pdf,image/jpg,image/jpeg,image/gif,image/png]']);
							$error = array_merge($error, ['attachment' => [
								'max_size' => "File size must be lower than 2 mb",
								'mime_in' => "Please Choose a PDF or Image file to upload"
							]]);
						} else {
							$rules = array_merge($rules, ['attachment' => 'max_size[attachment,500]|mime_in[attachment,application/pdf,image/jpg,image/jpeg,image/gif,image/png]']);
							$error = array_merge($error, ['attachment' => [
								'max_size' => "File size must be lower than 500 kb",
								'mime_in' => "Please Choose a PDF or Image file to upload"
							]]);
						}
					}
					if (!$this->validate($rules, $error)) {
						$data['validation'] = $this->validator;
					} else {
						$replyModel = new ApplicationModel('reply', 'reply_id', 'ticket_db');
						$reply_x = $replyModel->save(['reply_text' => $this->request->getPost('answer_text')]);
						if ($reply_x) {
							$reply_id = $replyModel->getInsertID();
							$rtModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
							if (!isset($data['ticket']['type'])) {
								$reply_by = 2;
							} else {
								$reply_by = $data['ticket']['type'];
							}
							$dat = [
								'token_id' => $ticket,
								'reply_id' => $reply_id,
								'user_id' => session('id'),
								'user_type' => 3,
								'reply_by' => $reply_by
							];
							if (!empty($_FILES['attachment']['name'])) {
								if ($this->request->getFile('attachment')->isValid()) {
									$mobile = $this->request->getFile('attachment');
									if ($mobile->isValid() && !$mobile->hasMoved()) {
										$fileURL = "./assets/uploads/ticket/" . $ticket;
										$name = $mobile->getClientName();
										$type = $mobile->getMimeType();
										$mobile->move($fileURL, $mobile->getClientName());

										$attModel = new ApplicationModel('attachment', 'att_id', 'ticket_db');
										$att_x = $attModel->save(['attachment' => base_url('assets/uploads/ticket/' . $ticket . '/' . $name), 'attachment_type' => $type]);
										if ($att_x) {
											$attachment_id = $attModel->getInsertID();
											$dat['attachment_id'] = $attachment_id;
										}
									}
								}
							}
							$rt_x = $rtModel->save($dat);
							if ($rt_x) {
								$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
								$td_x = $tdModel->set(['priority' => $this->request->getPost('priority'), 'action_status' => 4])->where('token_number', $ticket)->update();
								if ($td_x) {
									$ahModel = new ApplicationModel('action_history', 'ah_id', 'ticket_db');
									$ah_x = $ahModel->save(['ticket' => $ticket, 'action' => 'Answered', 'user_id' => session('id'), 'user_type' => 3]);
									if ($ah_x) {
										session()->setFlashdata('toastr', ['success' => 'Answered successfully.']);
										return redirect()->to('admin/tickets/' . $ticket . '?step=answered');
									}
								}
							}
						}
					}
				}
			} elseif ($_GET['step'] == 'closed') {
				$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
				$data['ticket'] = $tdModel->select(['token_number', 'title', 'subject', 'type', 'issue', 'token_generated_by.created_at', 'updated_at', 'action_status', 'status_name', 'status_color', 'ticket_detail.attachment_id', 'priority'])
					->join('reply_to', 'reply_to.token_id=ticket_detail.token_number')
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('to_cc_person', 'to_cc_person.token_id=ticket_detail.token_number')
					->join('token_generated_by', 'token_generated_by.token_id=ticket_detail.token_number')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->where(['token_number' => $ticket, 'action_status' => 2, 'reply_to.user_type' => 3, 'token_generated_by.user_id!=' => session('id')])
					->groupBy('reply_to.token_id')->first();
				if (@$data['ticket'] == '') {
					session()->setFlashdata('toastr', ['error' => 'Ticket not found!']);
					return redirect()->back();
				}
				$tdModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
				$data['replies'] = $tdModel->select(['rt_created_at', 'reply_text', 'user_id', 'reply_by', 'attachment_id', 'user_type'])
					->join('reply', 'reply.reply_id=reply_to.reply_id')
					->where(['token_id' => $ticket])->orderBy('rt_id', 'ASC')->findAll();
			} elseif ($_GET['step'] == 'team') {
				$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
				$data['ticket'] = $tdModel->select(['token_number', 'tf_to as tc_department', 'title', 'priority', 'subject', 'issue', 'attachment_id', 'transfer.created_at', 'action_status', 'status_name', 'status_color'])
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->join('transfer', 'transfer.token_id=ticket_detail.token_number')
					->where(['token_number' => $ticket, 'to_type' => 3])->first();
				if (@$data['ticket'] == '') {
					$tgbModel = new ApplicationModel('to_cc_person', 'tc_id', 'ticket_db');
					$data['ticket'] = $tgbModel->select(['token_number', 'tc_department', 'title', 'type', 'subject', 'issue', 'created_at', 'priority', 'action_status', 'status_name', 'status_color', 'attachment_id'])
						->join('ticket_detail', 'ticket_detail.token_number=to_cc_person.token_id')
						->join('title', 'title.t_id=ticket_detail.title_id')
						->join('status', 'status.status_id=ticket_detail.action_status')
						->where(['token_number' => $ticket, 'user_type' => 3, 'transfer' => 0])->first();

					if (@$data['ticket'] == '') {
						session()->setFlashdata('toastr', ['error' => 'Ticket not found!']);
						return redirect()->back();
					}
				}
				// $tcModel = new CustomModel('ticket_db');
				// $data['ticket'] = $tcModel->customQuery("SELECT * from (
				// 	(SELECT `token_number`, `tf_to` as `tc_department`, `title`, `subject`, `transfer.created_at` as `created_at`,`priority`,`attachment_id`, `action_status`, `status_name`, `status_color`,'transfer','type' FROM `transfer` JOIN `ticket_detail` ON `ticket_detail`.`token_number`=`transfer`.`token_id` JOIN `title` ON `title`.`t_id`=`ticket_detail`.`title_id` JOIN `status` ON `status`.`status_id`=`ticket_detail`.`action_status` WHERE `to_type` = 2 )
				// 	UNION
				// 	(SELECT `token_number`, `tc_department`, `title`, `subject`, `created_at`,`priority`,`attachment_id`, `action_status`, `status_name`, `status_color`, `transfer`,`type` FROM `to_cc_person` JOIN `ticket_detail` ON `ticket_detail`.`token_number`=`to_cc_person`.`token_id` JOIN `title` ON `title`.`t_id`=`ticket_detail`.`title_id` JOIN `status` ON `status`.`status_id`=`ticket_detail`.`action_status` WHERE `user_type` = 2 AND `transfer` = 0 )
				// ) t where token_id=$ticket GROUP BY token_id;");
				// if (@$data['ticket'] == '') {
				// 	session()->setFlashdata('toastr', ['error' => 'Ticket not found!']);
				// 	return redirect()->back();
				// }

				$tdModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
				$data['replies'] = $tdModel->select(['rt_created_at', 'reply_text', 'user_id', 'reply_by', 'user_type', 'attachment_id'])
					->join('reply', 'reply.reply_id=reply_to.reply_id')
					->where(['token_id' => $ticket])->orderBy('rt_id', 'ASC')->findAll();

				$drModel = new ApplicationModel('desk_role', 'dr_id', $this->ssoDb);
				$data['desks'] = $drModel->select(['dr_name', 'dr_id'])->whereNotIn('dr_step', [11])->where(['dr_status' => 1, 'dr_id!=' => session('role')])->findAll();

				$luModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
				$data['members'] = $luModel->select(['lu_id', 'user_name', 'user_role'])->where(['user_report_to' => session('id'), 'user_status' => 1, 'user_deleted_status' => 0])->findAll();

				if ($this->request->getPost('transfer') == 'Submit') {
					$rules = [
						'to' => 'required',
					];
					$error = [
						'to' => [
							'required' => "Please Select Destination Desk",
						],
					];
					if (!$this->validate($rules, $error)) {
						session()->setFlashdata('toastr', ['error' => 'something went wrong.']);
						$data['validation'] = $this->validator;
					} else {
						$tcModel = new ApplicationModel('to_cc_person', 'tc_id', 'ticket_db');
						$tcModel->set(['transfer' => 1])->where(['token_id' => $ticket])->update();

						$tfModel = new ApplicationModel('transfer', 'tf_id', 'ticket_db');
						$ex = explode('-', $this->request->getPost('to'));
						$tf_x = $tfModel->save(['tf_from' => session('id'), 'from_type' => 3, 'tf_to' => $ex[0], 'to_type' => $ex[1], 'token_id' => $ticket]);
						if ($tf_x) {
							$ahModel = new ApplicationModel('action_history', 'ah_id', 'ticket_db');
							$ah_x = $ahModel->save(['ticket' => $ticket, 'action' => 'Transfer', 'user_id' => session('id'), 'user_type' => 3]);
							if ($ah_x) {
								session()->setFlashdata('toastr', ['success' => 'Ticket Transferred Successfully.']);
								return redirect()->to('admin/tickets/' . $ticket . '?step=team');
							} else {
								session()->setFlashdata('toastr', ['success' => 'Ticket Transferred Successfully. Action History not saved.']);
								return redirect()->to('admin/tickets/' . $ticket . '?step=team');
							}
						} else {
							session()->setFlashdata('toastr', ['error' => 'Ticket not Transferred.']);
							return redirect()->to('admin/tickets?step=team');
						}
					}
				}
				if ($this->request->getPost('answer') == 'Submit') {
					$rules = [
						'answer_text' => 'required|min_length[5]'
					];
					$error = [
						'answer_text' => [
							'required' => "Please Enter Reply Text.",
							'min_length' => "Reply Description should be minimum 5 charactors in length."
						],
					];
					if ($data['ticket']['action_status'] == 1) {
						$rules = array_merge($rules, ['priority' => 'required|in_list[0,1,2]']);
						$error = array_merge($error, ['priority' => ['required' => "Please Select Priority", 'in_list' => "Please select correct Priority Option."]]);
					}
					if (!empty($_FILES['attachment']['name'])) {
						if ($this->request->getFile('attachment')->getMimeType() == 'application/pdf') {
							$rules = array_merge($rules, ['attachment' => 'max_size[attachment,2048]|mime_in[attachment,application/pdf,image/jpg,image/jpeg,image/gif,image/png]']);
							$error = array_merge($error, ['attachment' => [
								'max_size' => "File size must be lower than 2 mb",
								'mime_in' => "Please Choose a PDF or Image file to upload"
							]]);
						} else {
							$rules = array_merge($rules, ['attachment' => 'max_size[attachment,500]|mime_in[attachment,application/pdf,image/jpg,image/jpeg,image/gif,image/png]']);
							$error = array_merge($error, ['attachment' => [
								'max_size' => "File size must be lower than 500 kb",
								'mime_in' => "Please Choose a PDF or Image file to upload"
							]]);
						}
					}
					if (!$this->validate($rules, $error)) {
						$data['validation'] = $this->validator;
					} else {
						$replyModel = new ApplicationModel('reply', 'reply_id', 'ticket_db');
						$reply_x = $replyModel->save(['reply_text' => $this->request->getPost('answer_text')]);
						if ($reply_x) {
							$reply_id = $replyModel->getInsertID();
							$rtModel = new ApplicationModel('reply_to', 'rt_id', 'ticket_db');
							$reply_by = 4;

							$dat = [
								'token_id' => $ticket,
								'reply_id' => $reply_id,
								'user_id' => session('id'),
								'user_type' => 3,
								'reply_by' => $reply_by
							];
							if (!empty($_FILES['attachment']['name'])) {
								if ($this->request->getFile('attachment')->isValid()) {
									$mobile = $this->request->getFile('attachment');
									if ($mobile->isValid() && !$mobile->hasMoved()) {
										$fileURL = "./assets/uploads/ticket/" . $ticket;
										$name = $mobile->getClientName();
										$type = $mobile->getMimeType();
										$mobile->move($fileURL, $mobile->getClientName());

										$attModel = new ApplicationModel('attachment', 'att_id', 'ticket_db');
										$att_x = $attModel->save(['attachment' => base_url('assets/uploads/ticket/' . $ticket . '/' . $name), 'attachment_type' => $type]);
										if ($att_x) {
											$attachment_id = $attModel->getInsertID();
											$dat['attachment_id'] = $attachment_id;
										}
									}
								}
							}
							$rt_x = $rtModel->save($dat);
							if ($rt_x) {
								$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
								$td_x = $tdModel->set(['priority' => $this->request->getPost('priority'), 'action_status' => 4])->where('token_number', $ticket)->update();
								if ($td_x) {
									$ahModel = new ApplicationModel('action_history', 'ah_id', 'ticket_db');
									$ah_x = $ahModel->save(['ticket' => $ticket, 'action' => 'Answered', 'user_id' => session('id'), 'user_type' => 3]);
									if ($ah_x) {
										session()->setFlashdata('toastr', ['success' => 'Answered successfully.']);
										return redirect()->to('admin/tickets/' . $ticket . '?step=team');
									}
								}
							}
						}
					}
				}
			}
		}

		//Ticket List
		else {
			if (@$_GET['step'] == '' || @$_GET['step'] == 'inbox') {
				$tgbModel = new ApplicationModel('to_cc_person', 'tc_id', 'ticket_db');
				$data['tickets'] = $tgbModel->select(['token_id', 'type', 'title', 'subject', 'read_status', 'updated_at', 'action_status', 'status_name', 'status_color'])
					->join('ticket_detail', 'ticket_detail.token_number=to_cc_person.token_id')
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->where(['tc_department' => session('id'), 'user_type' => 3, 'transfer' => 0])
					->whereIn('action_status', [1, 3])
					->orderBy('tid', 'DESC')->findAll();

				$tfModel = new ApplicationModel('transfer', 'tf_id', 'ticket_db');
				$tf = $tfModel->select(['token_id', 'title', 'subject', 'read_status', 'updated_at', 'action_status', 'status_name', 'status_color'])
					->join('ticket_detail', 'ticket_detail.token_number=transfer.token_id')
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->where(['tf_to' => session('id'), 'to_type' => 3])
					->whereIn('action_status', [1, 3])->findAll();
				$data['tickets'] = array_merge($data['tickets'], $tf);
			} elseif (@$_GET['step'] == 'sent') {
				$tgbModel = new ApplicationModel('token_generated_by', 'tgb_id', 'ticket_db');
				$data['tickets'] = $tgbModel->select(['token_id', 'title', 'subject', 'updated_at', 'action_status', 'status_name', 'status_color'])
					->join('ticket_detail', 'ticket_detail.token_number=token_generated_by.token_id')
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->where(['user_type' => 3, 'user_id' => session('id')])
					->orderBy('tgb_id', 'DESC')->findAll();
			} elseif (@$_GET['step'] == 'answered') {
				$tgbModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
				$data['tickets'] = $tgbModel->select(['token_id', 'title', 'subject', 'updated_at', 'status_name', 'status_color'])
					->join('reply_to', 'reply_to.token_id=ticket_detail.token_number', 'inner')
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->where(['user_id' => session('id'), 'user_type' => 3, 'action_status' => 4])
					->groupBy('reply_to.token_id')
					->orderBy('tid', 'DESC')->findAll();
			} elseif (@$_GET['step'] == 'transfered') {
				$tgbModel = new ApplicationModel('transfer', 'tf_id', 'ticket_db');
				$data['tickets'] = $tgbModel->select(['token_id', 'title', 'tf_to', 'subject', 'transfer.created_at', 'action_status', 'status_name', 'status_color'])
					->join('ticket_detail', 'ticket_detail.token_number=transfer.token_id')
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->where(['tf_from' => session('id'), 'from_type' => 3,])
					->orderBy('tf_id', 'DESC')->findAll();
			} elseif (@$_GET['step'] == 'closed') {
				$tgbModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
				$data['tickets'] = $tgbModel->select(['reply_to.token_id', 'title', 'subject', 'updated_at', 'status_name', 'status_color'])
					->join('reply_to', 'reply_to.token_id=ticket_detail.token_number')
					->join('title', 'title.t_id=ticket_detail.title_id')
					->join('token_generated_by', 'token_generated_by.token_id=ticket_detail.token_number')
					->join('status', 'status.status_id=ticket_detail.action_status')
					->where(['reply_to.user_id' => session('id'), 'reply_to.user_type' => 3, 'action_status' => 2, 'token_generated_by.user_id!=' => session('id')])
					->groupBy('reply_to.token_id')
					->orderBy('tid', 'DESC')->findAll();
			} elseif (@$_GET['step'] == 'create-ticket') {
				$drModel = new ApplicationModel('desk_role', 'dr_id', $this->ssoDb);
				$data['desks'] = $drModel->select(['dr_name', 'dr_id'])->whereNotIn('dr_step', [11])->findAll();

				$luModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
				$data['members'] = $luModel->select(['lu_id', 'user_name', 'user_role'])->where(['user_report_to' => session('id'), 'user_status' => 1, 'user_deleted_status' => 0])->findAll();

				$tModel = new ApplicationModel('title', 't_id', 'ticket_db');
				$data['titles'] = $tModel->select(['t_id', 'title'])->where(['t_delete_status' => 0, 't_status' => 1, 't_applicable' => 3])->findAll();

				if ($this->request->getPost('create-ticket') == 'Submit') {

					$rules = [
						'title' => 'required',
						'subject' => 'required|min_length[5]|max_length[255]',
						'description' => 'required|min_length[5]',
					];
					$error = [
						'title' => [
							'required' => 'Please Select Title.',
						],
						'subject' => [
							'required' => 'Please enter description.',
							'min_length' => 'Description should have minimum 5 characters.',
						],
						'description' => [
							'required' => 'Please enter description.',
							'min_length' => 'Description should have minimum 5 characters.',
						]
					];
					if (!empty($_FILES['attachment']['name'])) {
						if ($this->request->getFile('attachment')->getMimeType() == 'application/pdf') {
							$rules = array_merge($rules, ['attachment' => 'max_size[attachment,1024]|mime_in[attachment,application/pdf,image/jpg,image/jpeg,image/gif,image/png]']);
							$error = array_merge($error, ['attachment' => [
								'max_size' => "File size must be lower than 1024 kb",
								'mime_in' => "Please Choose a PDF or Image file to upload"
							]]);
						} else {
							$rules = array_merge($rules, ['attachment' => 'max_size[attachment,200]|mime_in[attachment,application/pdf,image/jpg,image/jpeg,image/gif,image/png]']);
							$error = array_merge($error, ['attachment' => [
								'max_size' => "File size must be lower than 200 kb",
								'mime_in' => "Please Choose a PDF or Image file to upload"
							]]);
						}
					}
					if ($this->request->getPost('titletype') == 'yes') {
						if ($this->request->getPost('to') == null) {
							session()->setFlashdata('toastr', ['error' => 'Please Select To']);
							return redirect()->back()->withInput();
						}
					}
					if (!$this->validate($rules, $error)) {
						$data['validation'] = $this->validator;
					} else {
						$tgbModel = new ApplicationModel('token_generated_by', 'tgb_id', 'ticket_db');
						$last = $tgbModel->select(['token_id'])->orderBy('tgb_id', 'DESC')->first();
						$token_id = '3' . sprintf('%04d', substr($last['token_id'], 1) + 1);
						$tgb_x = $tgbModel->save(['user_id' => session('id'), 'token_id' => $token_id, 'user_type' => 3]);
						if ($tgb_x) {
							$tdModel = new ApplicationModel('ticket_detail', 'tid', 'ticket_db');
							$data = [
								'token_number' => $token_id,
								'title_id' => $this->request->getPost('title'),
								'subject' => $this->request->getPost('subject'),
								'issue' => $this->request->getPost('description'),
							];
							if (!empty($_FILES['attachment']['name'])) {
								if ($this->request->getFile('attachment')->isValid()) {
									$mobile = $this->request->getFile('attachment');
									if ($mobile->isValid() && !$mobile->hasMoved()) {
										$fileURL = "./assets/uploads/ticket/" . $token_id;
										$name = $mobile->getClientName();
										$type = $mobile->getMimeType();
										$mobile->move($fileURL, $mobile->getClientName());

										$attModel = new ApplicationModel('attachment', 'att_id', 'ticket_db');
										$att_x = $attModel->save(['attachment' => base_url('assets/uploads/ticket/' . $token_id . '/' . $name), 'attachment_type' => $type]);
										if ($att_x) {
											$attachment_id = $attModel->getInsertID();
											$data['attachment_id'] = $attachment_id;
										}
									}
								}
							}
							$td_x = $tdModel->save($data);
							if ($td_x) {
								$tcModel = new ApplicationModel('to_cc_person', 'tc_id', 'ticket_db');
								$ttModel = new ApplicationModel('title_to', 'tt_id', 'ticket_db');
								$to_cc = $ttModel->select(['user', 'type', 'user_type'])->where('title_id', $this->request->getPost('title'))->findAll();
								if ($to_cc != null) {
									foreach ($to_cc as $t_c) {
										$tcModel->save(['token_id' => $token_id, 'tc_department' => $t_c['user'], 'user_type' => $t_c['user_type'], 'type' => $t_c['type']]);
									}
								} else {
									if ($this->request->getPost('to') != null) {
										foreach ($this->request->getPost('to') as $to) {
											$ex = explode('-', $to);
											$tt_data = [
												'token_id' => $token_id,
												'tc_department' => $ex[0],
												'user_type' => $ex[1],
												'type' => 0,
											];
											$tcModel->save($tt_data);
										}
									}
									if ($this->request->getPost('cc') != null) {
										foreach ($this->request->getPost('cc') as $cc) {
											$ex = explode('-', $cc);
											$tt_dat = [
												'token_id' => $token_id,
												'tc_department' => $ex[0],
												'user_type' => $ex[1],
												'type' => 1,
											];
											$tcModel->save($tt_dat);
										}
									}
								}
								$ahModel = new ApplicationModel('action_history', 'ah_id', 'ticket_db');
								$ah_x = $ahModel->save(['ticket' => $token_id, 'action' => 'Created', 'user_id' => session('id'), 'user_type' => 3]);
								if ($ah_x) {
									session()->setFlashdata('toastr', ['success' => 'Ticket generated successfully. Your Ticket No. is ' . $token_id]);
									return redirect()->to('admin/tickets/' . $token_id . '?step=sent');
								} else {
									session()->setFlashdata('toastr', ['success' => 'Ticket generated successfully. Your Ticket No. is ' . $token_id . '. Trail not Saved.']);
									return redirect()->to('admin/tickets/' . $token_id . '?step=sent');
								}
							} else {
								session()->setFlashdata('toastr', ['error' => 'Problem with ticket details.']);
								return redirect()->to('admin/tickets');
							}
						} else {
							session()->setFlashdata('toastr', ['error' => 'Prblem in Token generate.']);
							return redirect()->to('admin/tickets');
						}
					}
				}
			} elseif (@$_GET['step'] == 'team') {

				$tcModel = new CustomModel('ticket_db');
				$perPage = 100;
				if (!isset($_GET['page']) && empty($_GET['page'])) {
					$page = 1;
				} else {
					$page = ((int) $_GET['page']) ? $_GET['page'] : 1;
				}

				$startIndex = ($page - 1) * $perPage;
				$totalItems = $tcModel->customQuery("SELECT `token_id` from (
					(SELECT `token_id`, `tf_to` as `tc_department`, `title`, `subject`, `read_status`, `updated_at`, `action_status`, `status_name`, `status_color`,'transfer','type' FROM `transfer` JOIN `ticket_detail` ON `ticket_detail`.`token_number`=`transfer`.`token_id` JOIN `title` ON `title`.`t_id`=`ticket_detail`.`title_id` JOIN `status` ON `status`.`status_id`=`ticket_detail`.`action_status` WHERE `to_type` = 3 )
					UNION
			  		(SELECT `token_id`, `tc_department`, `title`, `subject`, `read_status`, `updated_at`, `action_status`, `status_name`, `status_color`, `transfer`,`type` FROM `to_cc_person` JOIN `ticket_detail` ON `ticket_detail`.`token_number`=`to_cc_person`.`token_id` JOIN `title` ON `title`.`t_id`=`ticket_detail`.`title_id` JOIN `status` ON `status`.`status_id`=`ticket_detail`.`action_status` WHERE `user_type` = 3 AND `transfer` = 0 )
				) t GROUP BY token_id ;") ?? [];

				$data['tickets'] = $tcModel->customQuery("SELECT * from (
					(SELECT `token_id`, `tf_to` as `tc_department`, `title`, `subject`, `read_status`, `updated_at`, `action_status`, `status_name`, `status_color`,'transfer','type' FROM `transfer` JOIN `ticket_detail` ON `ticket_detail`.`token_number`=`transfer`.`token_id` JOIN `title` ON `title`.`t_id`=`ticket_detail`.`title_id` JOIN `status` ON `status`.`status_id`=`ticket_detail`.`action_status` WHERE `to_type` = 3 )
					UNION
			  		(SELECT `token_id`, `tc_department`, `title`, `subject`, `read_status`, `updated_at`, `action_status`, `status_name`, `status_color`, `transfer`,`type` FROM `to_cc_person` JOIN `ticket_detail` ON `ticket_detail`.`token_number`=`to_cc_person`.`token_id` JOIN `title` ON `title`.`t_id`=`ticket_detail`.`title_id` JOIN `status` ON `status`.`status_id`=`ticket_detail`.`action_status` WHERE `user_type` = 3 AND `transfer` = 0 )
				) t GROUP BY token_id order by updated_at desc Limit $startIndex, $perPage;") ?? [];

				$data['page'] = $page;
				$data['perPage'] = $perPage;
				$data['totalItems'] = count($totalItems);
			}
		}
		$data['pagename'] = 'admin/tickets';
		return view('admin/index', $data);
	}


	public function reports_old()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		$modelLeadSource = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$data['sources'] = $modelLeadSource->select(['source_name', 'source_id'])->findAll() ?? [];

		$modelStatuses =  new ApplicationModel('status', 'status_id', $this->lmsDb);
		$data['statuses'] = $modelStatuses->select(['status_name', 'status_id'])->findAll() ?? [];

		$modelHandlers = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		$data['handlers'] = $modelHandlers->select(['user_name', 'lu_id'])->where(['db_name' => session('db_priffix')])->findAll() ?? [];

		$modelPrograms = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['programs'] = $modelPrograms->select(['sc_id', 'course_name'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->findAll() ?? [];


		// lmsdb 
		// get total number of leads, Allocated, unallocated, total registered
		$modelLms = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
		$totalLeads = $modelLms->selectCount('lid')->where(['lead_delete_status' => 0])->first();
		$data['totalLeads'] = $totalLeads['lid'] ?? '0';

		$totalAllocated = $modelLms->selectCount('lid')->where(['lead_delete_status' => 0])->whereIn("lid", function (BaseBuilder $builder) {
			return $builder->select('lead_id')->from('lead_allocation_' . session('year'));
		})->first();
		$data['totalAllocated'] = $totalAllocated['lid'] ?? '0';

		$totalUnallocated = $modelLms->selectCount('lid')->where(['lead_delete_status' => 0])->whereNotIn("lid", function (BaseBuilder $builder) {
			return $builder->select('lead_id')->from('lead_allocation_' . session('year'));
		})->first();
		$data['totalUnallocated'] = $totalUnallocated['lid'] ?? '0';

		$totalRegistered = $modelLms->selectCount('lid')->where(['lead_delete_status' => 0])->whereIn("lid", function (BaseBuilder $builder) {
			return $builder->select('lead_id')->from($this->ssoDb . '.lms_db_reference_' . session('year'))->where('admin_type', session('db_priffix'));
		})->first();
		$data['totalRegistered'] = $totalRegistered['lid'] ?? '0';

		// Admssion DB Status
		$modelReferenceDb = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$totalRegisteredStudent = $modelReferenceDb->selectCount('sid')->where('admin_type', session('db_priffix'))->first();
		$data['totalRegisteredStudent'] = $totalRegisteredStudent['sid'] ?? '0';

		$data['admissionStatus'] = $modelReferenceDb->select(['admisn_status', 'count(student_login_' . session('year') . '.admisn_status) as sid'])->join('student_login_' . session('year'), 'lms_db_reference_' . session('year') . '.sid=student_login_' . session('year') . '.sid')->where('admin_type', session('db_priffix'))->groupBy('admisn_status')->findAll() ?? [];


		$data['formStep'] = $modelReferenceDb->select(['form_step', 'count(student_login_' . session('year') . '.form_step) as total_sid'])->join('student_login_' . session('year'), 'lms_db_reference_' . session('year') . '.sid=student_login_' . session('year') . '.sid')->where('admin_type', session('db_priffix'))->groupBy('form_step')->findAll() ?? [];

		$data['pagename'] = "admin/report";
		//print_r($data['formStep']);
		//dd($data);
		return view('admin/index', $data);
		/**
		 * Global Filter Such as DateTime Range, Course Level, Source, department etc.
		 * 
		 * Filter on Base
		 * 1. Lead Source Independent
		 * 2. Date Between Independent
		 * 3. Handler wise Independent
		 * 4. Program Wise Independent
		 * 5. Lead Status Independent
		 * 6. Department Wise // not neccesary
		 * 7. TL Wise
		 * 
		 * 
		 */

		/**
		 * ## Key-Stats of LMS DB
		 * 1. Total Lead of Admin
		 * 2. total Allocated
		 * 3. total Unallocated
		 * 4. Total Sid/Applied Student
		 * 
		 * Group Graph acc. to Time Line such as semi-year, quartly, monthly, weekly and daily
		 * 
		 * ## Key-Stats of Admission DB
		 * 1. Total Sid Generated/Registered
		 * 2. Total Applied Student/Application Form
		 * 3. Total Enrollment
		 * 4. Total Rejected/Span Form
		 * 
		 * Group Graph acc. to Time Line such as semi-year, quartly, monthly, weekly and daily
		 */

		// Form Step Status wise Graph
		// Application Form Status wise Graph
		// Location/Region Wise Graph
		// Source Wise Graph
		// Status Wise Graph
		// Program Wise Graph
		// Department Wise Graph
		// Handler Wise Graph
		// Team Leader wise Graph

	}


	public function reports()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];

		$modelLeadSource = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$data['sources'] = $modelLeadSource->select(['source_name', 'source_id'])->findAll() ?? [];

		$modelStatuses =  new ApplicationModel('status', 'status_id', $this->lmsDb);
		$data['statuses'] = $modelStatuses->select(['status_name', 'status_id'])->findAll() ?? [];

		$modelHandlers = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		$data['handlers'] = $modelHandlers->select(['user_name', 'lu_id'])->where(['db_name' => session('db_priffix')])->findAll() ?? [];

		$data['teamLeaders'] = $modelHandlers->select(['user_name', 'lu_id'])->where(['db_name' => session('db_priffix'), 'user_role' => 1])->findAll() ?? [];

		$modelPrograms = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['programs'] = $modelPrograms->select(['sc_id', 'course_name'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->findAll() ?? [];


		// lmsdb 
		// get total number of leads, Allocated, unallocated, total registered
		$modelLms = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);

		$totalLeads = $modelLms;
		$lineChart = $modelLms;
		$totalAllocated = $modelLms;
		$totalUnallocated = $modelLms;
		$totalRegistered = $modelLms;
		$leadStatusWise = $modelLms;
		$leadSourceWise = $modelLms;
		$programWise = $modelLms;
		$departmentWise = $modelLms;

		$whereDate = $whereDateAdmission = false;
		$whereInSources = $whereInStatus = $whereInProgram = $whereInHandler = $whereInTeams = [];

		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['lead_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
			$whereDateAdmission['lr_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}
		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['lead_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
			$whereDateAdmission['lr_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
		}

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
		}

		if (array_filter($_GET['status'] ?? []) != []  && isset($_GET['status'])) {
			$whereInStatus = $_GET['status'] ?? [];
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
		}

		if (array_filter($_GET['handlers'] ?? []) != []  && isset($_GET['handlers'])) {
			$whereInHandler = $_GET['handlers'] ?? [];
		}

		if (array_filter($_GET['tl'] ?? []) != []  && isset($_GET['tl'])) {
			$tlMemberModel = new ApplicationModel('team_leader_' . session('year'), 'tl_id', $this->lmsDb);
			$teamMembers = $tlMemberModel->select(['handler_id'])->whereIn('team_leader', $_GET['tl'])->findAll() ?? [];
			$teamMembers = array_column($teamMembers, 'handler_id');
			$whereInTeams  = array_merge($teamMembers, $_GET['tl']);
		}





		$totalLeads = $totalLeads->selectCount('lid')->where(['lead_delete_status' => 0]);
		if ($whereDate) {
			$totalLeads = $totalLeads->where($whereDate);
		}
		if ($whereInSources) {
			$totalLeads = $totalLeads->whereIn('lead_source', $whereInSources);
		}
		if ($whereInStatus) {
			$totalLeads = $totalLeads->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$totalLeads = $totalLeads->whereIn('lead_programe', $whereInProgram);
		}
		if ($whereInHandler) {
			$totalLeads = $totalLeads->whereIn('lid', function (BaseBuilder $builder) use ($whereInHandler) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInHandler);
			});
		}
		if ($whereInTeams) {
			$totalLeads = $totalLeads->whereIn('lid', function (BaseBuilder $builder) use ($whereInTeams) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInTeams);
			});
		}

		$totalLeads = $totalLeads->first();
		$data['totalLeads'] = $totalLeads['lid'] ?? '0';

		$lineChart = $lineChart->select(['DATE_FORMAT(`lead_created_at`, "%b-%Y") as year', 'count(lid) as value'], false)->where(['lead_delete_status' => 0])->groupBy('DATE_FORMAT(`lead_created_at`, "%b-%Y")')->orderBy('lead_created_at', 'DESC');
		if ($whereDate) {
			$lineChart = $lineChart->where($whereDate);
		}
		if ($whereInSources) {
			$lineChart = $lineChart->whereIn('lead_source', $whereInSources);
		}
		if ($whereInStatus) {
			$lineChart = $lineChart->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$lineChart = $lineChart->whereIn('lead_programe', $whereInProgram);
		}
		if ($whereInHandler) {
			$lineChart = $lineChart->whereIn('lid', function (BaseBuilder $builder) use ($whereInHandler) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInHandler);
			});
		}
		if ($whereInTeams) {
			$lineChart = $lineChart->whereIn('lid', function (BaseBuilder $builder) use ($whereInTeams) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInTeams);
			});
		}
		$lineChart = $lineChart->findAll();
		$data['lineChart'] = $lineChart;

		$totalAllocated = $totalAllocated->selectCount('lid')->where(['lead_delete_status' => 0])->whereIn("lid", function (BaseBuilder $builder) {
			return $builder->select('lead_id')->from('lead_allocation_' . session('year'));
		});
		if ($whereDate) {
			$totalAllocated = $totalAllocated->where($whereDate);
		}
		if ($whereInSources) {
			$totalAllocated = $totalAllocated->whereIn('lead_source', $whereInSources);
		}
		if ($whereInStatus) {
			$totalAllocated = $totalAllocated->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$totalAllocated = $totalAllocated->whereIn('lead_programe', $whereInProgram);
		}
		if ($whereInHandler) {
			$totalAllocated = $totalAllocated->whereIn('lid', function (BaseBuilder $builder) use ($whereInHandler) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInHandler);
			});
		}
		if ($whereInTeams) {
			$totalAllocated = $totalAllocated->whereIn('lid', function (BaseBuilder $builder) use ($whereInTeams) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInTeams);
			});
		}
		$totalAllocated = $totalAllocated->first();
		$data['totalAllocated'] = $totalAllocated['lid'] ?? '0';

		$totalUnallocated = $totalUnallocated->selectCount('lid')->where(['lead_delete_status' => 0])->whereNotIn("lid", function (BaseBuilder $builder) {
			return $builder->select('lead_id')->from('lead_allocation_' . session('year'));
		});
		if ($whereDate) {
			$totalUnallocated = $totalUnallocated->where($whereDate);
		}
		if ($whereInSources) {
			$totalUnallocated = $totalUnallocated->whereIn('lead_source', $whereInSources);
		}
		if ($whereInStatus) {
			$totalUnallocated = $totalUnallocated->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$totalUnallocated = $totalUnallocated->whereIn('lead_programe', $whereInProgram);
		}
		if ($whereInHandler) {
			$totalUnallocated = $totalUnallocated->whereIn('lid', function (BaseBuilder $builder) use ($whereInHandler) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInHandler);
			});
		}
		if ($whereInTeams) {
			$totalUnallocated = $totalUnallocated->whereIn('lid', function (BaseBuilder $builder) use ($whereInTeams) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInTeams);
			});
		}
		$totalUnallocated = $totalUnallocated->first();
		$data['totalUnallocated'] = $totalUnallocated['lid'] ?? '0';

		$totalRegistered = $totalRegistered->selectCount('lid')->where(['lead_delete_status' => 0])->whereIn("lid", function (BaseBuilder $builder) use ($whereInHandler, $whereInTeams) {
			$builder->select('lead_id')->from($this->ssoDb . '.lms_db_reference_' . session('year'))->where('admin_type', session('db_priffix'));
			if ($whereInHandler) {
				$builder->whereIn('handler_id', $whereInHandler);
			}
			if ($whereInTeams) {
				$builder->whereIn('handler_id', $whereInTeams);
			}
			return $builder;
		});
		if ($whereInSources) {
			$totalRegistered = $totalRegistered->whereIn('lead_source', $whereInSources);
		}
		if ($whereDate) {
			$totalRegistered = $totalRegistered->where($whereDate);
		}
		if ($whereInStatus) {
			$totalRegistered = $totalRegistered->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$totalRegistered = $totalRegistered->whereIn('lead_programe', $whereInProgram);
		}
		$totalRegistered = $totalRegistered->first();
		$data['totalRegistered'] = $totalRegistered['lid'] ?? '0';


		// lead status graph filters and query
		$leadStatusWise = $leadStatusWise->select(['status_name as category', 'count(lead_status) as value'])->join('status', 'lead_profile_' . session('year') . '.lead_status=status.status_id', 'right')->groupBy('lead_status')->orderBy('status_id', 'ASC');

		if ($whereDate) {
			$leadStatusWise = $leadStatusWise->where($whereDate);
		}
		if ($whereInSources) {
			$leadStatusWise = $leadStatusWise->whereIn('lead_source', $whereInSources);
		}
		if ($whereInStatus) {
			$leadStatusWise = $leadStatusWise->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$leadStatusWise = $leadStatusWise->whereIn('lead_programe', $whereInProgram);
		}
		if ($whereInHandler) {
			$leadStatusWise = $leadStatusWise->whereIn('lid', function (BaseBuilder $builder) use ($whereInHandler) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInHandler);
			});
		}
		if ($whereInTeams) {
			$leadStatusWise = $leadStatusWise->whereIn('lid', function (BaseBuilder $builder) use ($whereInTeams) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInTeams);
			});
		}

		$data['leadStatusWise'] = $leadStatusWise->findAll() ?? [];


		// lead source graph filters and query
		$leadSourceWise = $leadSourceWise->select(['source_name as category', 'count(lead_source) as value'])->join('sources', 'lead_profile_' . session('year') . '.lead_source=sources.source_id', 'right')->groupBy('lead_source')->orderBy('source_id', 'ASC');
		if ($whereDate) {
			$leadSourceWise = $leadSourceWise->where($whereDate);
		}
		if ($whereInSources) {
			$leadSourceWise = $leadSourceWise->whereIn('lead_source', $whereInSources);
		}
		if ($whereInStatus) {
			$leadSourceWise = $leadSourceWise->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$leadSourceWise = $leadSourceWise->whereIn('lead_programe', $whereInProgram);
		}
		if ($whereInHandler) {
			$leadSourceWise = $leadSourceWise->whereIn('lid', function (BaseBuilder $builder) use ($whereInHandler) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInHandler);
			});
		}
		if ($whereInTeams) {
			$leadSourceWise = $leadSourceWise->whereIn('lid', function (BaseBuilder $builder) use ($whereInTeams) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInTeams);
			});
		}
		$data['leadSourceWise'] = $leadSourceWise->findAll() ?? [];

		$programWise = $programWise->select(['course_name as category', 'count(lead_programe) as value'])
			->join($this->ssoDb . '.session_courses_' . session('year'), 'lead_profile_' . session('year') . '.lead_programe=sso_' . session('suffix') . '.session_courses_' . session('year') . '.sc_id', 'right')
			->join($this->ssoDb . '.course_info', $this->ssoDb . '.session_courses_' . session('year') . '.course_id=sso_' . session('suffix') . '.course_info.coi_id', 'left')
			->groupBy('sc_id')->where('sc_course_delete', 0)->orderBy('sc_id', 'ASC');
		if ($whereDate) {
			$programWise = $programWise->where($whereDate);
		}
		if ($whereInSources) {
			$programWise = $programWise->whereIn('lead_source', $whereInSources);
		}
		if ($whereInStatus) {
			$programWise = $programWise->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$programWise = $programWise->whereIn('lead_programe', $whereInProgram);
		}
		if ($whereInHandler) {
			$programWise = $programWise->whereIn('lid', function (BaseBuilder $builder) use ($whereInHandler) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInHandler);
			});
		}
		if ($whereInTeams) {
			$programWise = $programWise->whereIn('lid', function (BaseBuilder $builder) use ($whereInTeams) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInTeams);
			});
		}
		$data['programWise'] = $programWise->findAll() ?? [];

		//lead department wise
		$departmentWise = $departmentWise->select(['dept_name as category', 'count(lead_department) as value'])
			->join($this->ssoDb . '.departments', 'lead_profile_' . session('year') . '.lead_department=sso_' . session('suffix') . '.departments.dept_id', 'right')
			->groupBy('dept_id')->where(['dept_delete_status' => 0])->orderBy('dept_id', 'ASC');
		if ($whereDate) {
			$departmentWise = $departmentWise->where($whereDate);
		}
		if ($whereInSources) {
			$departmentWise = $departmentWise->whereIn('lead_source', $whereInSources);
		}
		if ($whereInStatus) {
			$departmentWise = $departmentWise->whereIn('lead_status', $whereInStatus);
		}
		if ($whereInProgram) {
			$departmentWise = $departmentWise->whereIn('lead_programe', $whereInProgram);
		}
		if ($whereInHandler) {
			$departmentWise = $departmentWise->whereIn('lid', function (BaseBuilder $builder) use ($whereInHandler) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInHandler);
			});
		}
		if ($whereInTeams) {
			$departmentWise = $departmentWise->whereIn('lid', function (BaseBuilder $builder) use ($whereInTeams) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereInTeams);
			});
		}
		$data['departmentWise'] = $departmentWise->findAll() ?? [];

		/*

		$lineChart1 = $modelLms->select(['DATE_FORMAT(`lead_created_at`, "%Y-%m-%d %H:%i:%s") as year','DATE_FORMAT(`lead_created_at`, "%Y-%m-%d") as dates', 'count(lid) as value'], false)->where(['lead_delete_status'=>0])->groupBy('DATE_FORMAT(`lead_created_at`, "%Y-%m-%d %H:%i:%s")')->orderBy('lead_created_at', 'DESC')->findAll(0,180);
		$data['lineChart1'] = $lineChart1;
		*/



		// Admssion DB Status
		$modelReferenceDB = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$totalRegisterPayment = $modelReferenceDB;
		$modelReferenceDb = $modelReferenceDB;
		$totalProvisionalModel = $modelReferenceDB;
		$totalRegisteredStudent = $modelReferenceDb->selectCount('sid')->where('admin_type', session('db_priffix'));
		if ($whereDateAdmission) {
			$totalRegisteredStudent = $totalRegisteredStudent->where($whereDateAdmission);
		}
		if ($whereInSources) {
			$totalRegisteredStudent = $totalRegisteredStudent->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInSources) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_source', $whereInSources);
			});
		}
		if ($whereInStatus) {
			$totalRegisteredStudent = $totalRegisteredStudent->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInStatus) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_status', $whereInStatus);
			});
		}
		if ($whereInProgram) {
			$totalRegisteredStudent = $totalRegisteredStudent->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInProgram) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_programe', $whereInProgram);
			});
		}
		if ($whereInHandler) {
			$totalRegisteredStudent = $totalRegisteredStudent->whereIn('handler_id', $whereInHandler);
		}

		if ($whereInTeams) {
			$totalRegisteredStudent = $totalRegisteredStudent->whereIn('handler_id', $whereInTeams);
		}
		$totalRegisteredStudent = $totalRegisteredStudent->first();
		$data['totalRegisteredStudent'] = $totalRegisteredStudent['sid'] ?? '0';


		// registration Payment Done
		$totalRegisterPayment = $modelReferenceDb->selectCount('student_login_' . session('year') . '.sid')->join('student_login_' . session('year'), 'lms_db_reference_' . session('year') . '.sid=student_login_' . session('year') . '.sid')->where('admin_type', session('db_priffix'))->where('payment_status IS NOT NULL');
		if ($whereDateAdmission) {
			$totalRegisterPayment = $totalRegisterPayment->where($whereDateAdmission);
		}
		if ($whereInSources) {
			$totalRegisterPayment = $totalRegisterPayment->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInSources) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_source', $whereInSources);
			});
		}
		if ($whereInStatus) {
			$totalRegisterPayment = $totalRegisterPayment->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInStatus) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_status', $whereInStatus);
			});
		}
		if ($whereInProgram) {
			$totalRegisterPayment = $totalRegisterPayment->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInProgram) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_programe', $whereInProgram);
			});
		}
		if ($whereInHandler) {
			$totalRegisterPayment = $totalRegisterPayment->whereIn('handler_id', $whereInHandler);
		}

		if ($whereInTeams) {
			$totalRegisterPayment = $totalRegisterPayment->whereIn('handler_id', $whereInTeams);
		}
		$totalRegisterPayment = $totalRegisterPayment->first();
		$data['totalRegisterPayment'] = $totalRegisterPayment['sid'] ?? '0';

		// registration Provisional fee Done
		$totalProvisionalModel = $modelReferenceDb->selectCount('student_login_' . session('year') . '.sid')->join('student_login_' . session('year'), 'lms_db_reference_' . session('year') . '.sid=student_login_' . session('year') . '.sid')->where('admin_type', session('db_priffix'))->where('provisional_fees IS NOT NULL');
		if ($whereDateAdmission) {
			$totalProvisionalModel = $totalProvisionalModel->where($whereDateAdmission);
		}
		if ($whereInSources) {
			$totalProvisionalModel = $totalProvisionalModel->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInSources) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_source', $whereInSources);
			});
		}
		if ($whereInStatus) {
			$totalProvisionalModel = $totalProvisionalModel->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInStatus) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_status', $whereInStatus);
			});
		}
		if ($whereInProgram) {
			$totalProvisionalModel = $totalProvisionalModel->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInProgram) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_programe', $whereInProgram);
			});
		}
		if ($whereInHandler) {
			$totalProvisionalModel = $totalProvisionalModel->whereIn('handler_id', $whereInHandler);
		}

		if ($whereInTeams) {
			$totalProvisionalModel = $totalProvisionalModel->whereIn('handler_id', $whereInTeams);
		}
		$totalProvisionalModel = $totalProvisionalModel->first();
		$data['totalProvisionalModel'] = $totalProvisionalModel['sid'] ?? '0';
		/*
		'CASE
			WHEN `admisn_status` = 1 THEN "Application Form"
			WHEN `admisn_status` = 2 THEN "Under Proccess Form"
			WHEN `admisn_status` = 3 THEN "Rejected Form"
			WHEN `admisn_status` = 4 THEN "Span Form"
			WHEN `admisn_status` = 5 THEN "Admission Done"
			ELSE "Open Form"
		END as `admission_status`', 'CASE
			WHEN `admisn_status` = 1 THEN "#32ccc4"
			WHEN `admisn_status` = 2 THEN "#ffa800"
			WHEN `admisn_status` = 3 THEN "#3699ff"
			WHEN `admisn_status` = 4 THEN "#f64e60"
			WHEN `admisn_status` = 5 THEN "#f64e60"
		ELSE "#32ccc4"
		END as `admission_color`'
		*/
		$admissionStatus = $modelReferenceDb->select(['admisn_status', 'count(student_login_' . session('year') . '.sid) as sid'])->join('student_login_' . session('year'), 'lms_db_reference_' . session('year') . '.sid=student_login_' . session('year') . '.sid')->where('admin_type', session('db_priffix'))->groupBy('admisn_status');
		if ($whereDateAdmission) {
			$admissionStatus = $admissionStatus->where($whereDateAdmission);
		}
		if ($whereInSources) {
			$admissionStatus = $admissionStatus->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInSources) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_source', $whereInSources);
			});
		}
		if ($whereInStatus) {
			$admissionStatus = $admissionStatus->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInStatus) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_status', $whereInStatus);
			});
		}
		if ($whereInProgram) {
			$admissionStatus = $admissionStatus->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInProgram) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_programe', $whereInProgram);
			});
		}
		if ($whereInHandler) {
			$admissionStatus = $admissionStatus->whereIn('handler_id', $whereInHandler);
		}
		if ($whereInTeams) {
			$admissionStatus = $admissionStatus->whereIn('handler_id', $whereInTeams);
		}
		$data['admissionStatus'] = $admissionStatus->findAll() ?? [];



		$formStep = $modelReferenceDb->select(['fs_name as category', 'count(student_login_' . session('year') . '.form_step) as value'])
			->join('student_login_' . session('year'), 'lms_db_reference_' . session('year') . '.sid=student_login_' . session('year') . '.sid', 'right')
			->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.position', 'right')
			->where('admin_type', session('db_priffix'))->groupBy('form_step');
		if ($whereDateAdmission) {
			$formStep = $formStep->where($whereDateAdmission);
		}
		if ($whereInSources) {
			$formStep = $formStep->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInSources) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_source', $whereInSources);
			});
		}
		if ($whereInStatus) {
			$formStep = $formStep->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInStatus) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_status', $whereInStatus);
			});
		}
		if ($whereInProgram) {
			$formStep = $formStep->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInProgram) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_programe', $whereInProgram);
			});
		}
		if ($whereInHandler) {
			$formStep = $formStep->whereIn('handler_id', $whereInHandler);
		}
		if ($whereInTeams) {
			$formStep = $formStep->whereIn('handler_id', $whereInTeams);
		}
		$data['formStep'] = $formStep->findAll() ?? [];

		$data['pagename'] = "admin/report";
		//print_r($data['formStep']);
		//dd($data);
		return view('admin/index', $data);
		/**
		 * Global Filter Such as DateTime Range, Course Level, Source, department etc.
		 * 
		 * Filter on Base
		 * 1. Lead Source Independent
		 * 2. Date Between Independent
		 * 3. Handler wise Independent
		 * 4. Program Wise Independent
		 * 5. Lead Status Independent
		 * 6. Department Wise // not neccesary
		 * 7. TL Wise
		 * 
		 * 
		 */

		/**
		 * ## Key-Stats of LMS DB
		 * 1. Total Lead of Admin
		 * 2. total Allocated
		 * 3. total Unallocated
		 * 4. Total Sid/Applied Student
		 * 
		 * Group Graph acc. to Time Line such as semi-year, quartly, monthly, weekly and daily
		 * 
		 * ## Key-Stats of Admission DB
		 * 1. Total Sid Generated/Registered
		 * 2. Total Applied Student/Application Form
		 * 3. Total Enrollment
		 * 4. Total Rejected 
		 * 5. Total Span Form
		 * 
		 * Group Graph acc. to Time Line such as semi-year, quartly, monthly, weekly and daily
		 */

		// Form Step Status wise Graph
		// Application Form Status wise Graph
		// Location/Region Wise Graph
		// Source Wise Graph
		// Status Wise Graph
		// Program Wise Graph
		// Department Wise Graph
		// Handler Wise Graph
		// Team Leader wise Graph

	}

	public function team_members($teamLeader = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$data = [];
		$userModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		$userDetail = $userModel->where(['user_status' => 1, 'user_deleted_status' => 0, 'user_role' => 1, 'lu_id' => $teamLeader, 'db_name' => session('db_priffix')])->first();
		if (!$userDetail) {
			session()->setFlashdata('toastr', ['error' => 'this member is not a team leader.']);
			return redirect()->back();
		}
		$data['userDetail'] = $userDetail;
		$teamMemberModel = new ApplicationModel('team_leader_' . session('year'), 'tl_id', $this->lmsDb);
		$data['teamMembers'] = $teamMemberModel->join(SETTINGDB . '.lms_users_' . session('year'), 'team_leader_' . session('year') . '.handler_id=' . SETTINGDB . '.lms_users_' . session('year') . '.lu_id')->where(['team_leader' => $teamLeader])->paginate(500);
		$data['pager'] = $teamMemberModel->pager;

		$data['pagename'] = "admin/team-members";
		return view('admin/index', $data);
	}

	public function login_history($userType = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		if (in_array($userType, ['handlers', 'admins']) === false) {
			session()->setFlashdata('toastr', ['error' => 'Something went wrong']);
			return redirect()->back();
		}
		$requiredDetail = [
			'handlers' => [
				'table' => 'handler_login_history_' . session('year'),
				'primaryKey' => 'hlh_id',
				'select' => [
					'hlh_id pid',
					'handler_id user_id',
					'login_time',
					'logout_time',
					'handler_ip ip_address',
					'user_name',
					'db_name',
					'user_mobile',
					'user_email',
					'user_role'
				],
				'foreginkey' => 'handler_id',
			],
			'admins' => [
				'table' => 'admin_login_history',
				'primaryKey' => 'alh_id',
				'select' => [
					'alh_id pid',
					'admin_id user_id',
					'login_time',
					'logout_time',
					'admin_ip ip_address',
					'user_name',
					'db_name',
					'user_mobile',
					'user_email',
					'user_role'
				],
				'foreginkey' => 'admin_id',
			]
		];
		$modelDetail = $requiredDetail[$userType];
		$model = new ApplicationModel($modelDetail['table'], $modelDetail['primaryKey'], $this->lmsDb);

		$userDetails = $model->select($modelDetail['select'])->join(SETTINGDB . '.lms_users_' . session('year'), SETTINGDB . '.lms_users_' . session('year') . '.lu_id=' . $modelDetail['table'] . '.' . $modelDetail['foreginkey']);

		$whereDate = [];
		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}
		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
		}

		if (array_filter($_GET['users'] ?? []) != []  && isset($_GET['users'])) {
			$whereInhandlers = $_GET['users'] ?? [];
			$userDetails = $userDetails->whereIn('lu_id', $whereInhandlers);
		}

		if (!empty($_GET['type']) && isset($_GET['type'])) {
			$whereDate['user_role'] = htmlspecialchars(trim($_GET['type']));
		}

		if (!empty($_GET['email']) && isset($_GET['email'])) {
			$whereDate['user_email'] = htmlspecialchars(trim($_GET['email']));
		}

		if (!empty($_GET['mobile']) && isset($_GET['mobile'])) {
			$whereDate['user_mobile'] = htmlspecialchars(trim($_GET['mobile']));
		}

		if ($whereDate)
			$userDetails = $userDetails->where($whereDate);

		if (!empty($_GET['sort']) && isset($_GET['sort'])) {
			$key = $_GET['sort'] == 'user' ? 'user_name' : null;
		} else {
			$key = $modelDetail['primaryKey'];
		}
		$userDetails->where(['db_name' => session('db_priffix')])->where('user_deleted_status', 0);
		$data['total_records'] = $userDetails->countAllResults(false);
		$data['users'] = $userDetails->orderBy($key, 'DESC')->paginate(500);
		$data['pager'] = $model->pager;
		$handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		if ($userType == 'admin') {
			$data['handlers'] = $handlerModel->select(['user_name', 'lu_id'])->where(['user_role' => 2, 'user_deleted_status' => 0])->findAll() ?? [];
		} else {
			$data['handlers'] = $handlerModel->select(['user_name', 'lu_id'])->whereIn('user_role', ['1', '0'])->where(['user_deleted_status' => 0])->findAll() ?? [];
		}
		$data['userType'] = $userType;
		$data['pagename'] = "admin/login-history-list";
		//dd($data);
		return view('admin/index', $data);
	}

	public function report($slug = false)
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		$validSlug = ['created-sid', 'registration', 'admission-done'];
		$pageInfo = [
			'created-sid' => [
				'title' => "Created SID List",
				'created_at' => 'sl_created_at dated',
				'field_name' => 'sl_created_at'
			],
			'registration' => [
				'title' => 'Registration List',
				'created_at' => 'payment_status dated',
				'field_name' => 'payment_status'
			],
			'admission-done' => [
				'title' => 'Admission Done List',
				'created_at' => 'provisional_fees dated',
				'field_name' => 'provisional_fees'
			]
		];
		if (in_array($slug, $validSlug) === false) {
			session()->setFlashdata('toastr', ['error' => 'Page not Exits']);
			return redirect()->back();
		}
		$dated = $pageInfo[$slug]['created_at'];
		$field_name = $pageInfo[$slug]['field_name'];
		$whereDate = $whereDateAdmission = false;
		$whereInSources = $whereInStatus = $whereInProgram = $whereInHandler = $whereInTeams = $whereInNationality = [];


		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$whereDate['lead_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
			$whereDateAdmission[$field_name . '<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
		}
		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$whereDate['lead_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
			$whereDateAdmission[$field_name . '>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
		}


		if (!empty($_GET['mobile']) && isset($_GET['mobile']))
			$whereDateAdmission['lead_mobile'] = $_GET['mobile'];

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
		}

		if (array_filter($_GET['status'] ?? []) != []  && isset($_GET['status'])) {
			$whereInStatus = $_GET['status'] ?? [];
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
		}

		if (array_filter($_GET['handlers'] ?? []) != []  && isset($_GET['handlers'])) {
			$whereInHandler = $_GET['handlers'] ?? [];
		}
		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
		}

		if (array_filter($_GET['tl'] ?? []) != []  && isset($_GET['tl'])) {
			$tlMemberModel = new ApplicationModel('team_leader_' . session('year'), 'tl_id', $this->lmsDb);
			$teamMembers = $tlMemberModel->select(['handler_id'])->whereIn('team_leader', $_GET['tl'])->findAll() ?? [];
			$teamMembers = array_column($teamMembers, 'handler_id');
			$whereInTeams  = array_merge($teamMembers, $_GET['tl']);
		}
		$data = [];
		$modelReferenceDB = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$modelReferenceDb = $modelReferenceDB;
		$studentList = $modelReferenceDb->select(['lms_db_reference_' . session('year') . '.sid', 'form_step', 'handler_id', 'admin_type', 'lead_id', 'password', "CONCAT(lead_first_name,' ',lead_middle_name,' ',lead_last_name) as lead_name", 'lead_email', 'lead_mobile', 'lead_country_code', 'lead_programe', 'course_name', 'course_code', 'lead_source', 'source_name', 'admisn_status', 'student_reg_fee_id', 'fs_name', "$dated"])
			->join($this->lmsDb . '.lead_profile_' . session('year'), $this->ssoDb . '.lms_db_reference_' . session('year') . '.lead_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lid')

			->join($this->ssoDb . '.session_courses_' . session('year'), $this->ssoDb . '.session_courses_' . session('year') . '.sc_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_programe')

			->join($this->ssoDb . '.course_info', $this->ssoDb . '.course_info.coi_id=' . $this->ssoDb  . '.session_courses_' . session('year') . '.course_id')

			->join($this->lmsDb . '.sources', $this->lmsDb . '.sources.source_id=' . $this->lmsDb . '.lead_profile_' . session('year') . '.lead_source')
			->join('student_login_' . session('year'), 'student_login_' . session('year') . '.sid=lms_db_reference_' . session('year') . '.sid')
			->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.position', 'left')
			->where('admin_type', session('db_priffix'));
		if ($whereDateAdmission) {
			$studentList = $studentList->where($whereDateAdmission);
		}
		if ($whereInSources) {
			$studentList = $studentList->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInSources) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_source', $whereInSources);
			});
		}
		if ($whereInStatus) {
			$studentList = $studentList->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInStatus) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_status', $whereInStatus);
			});
		}
		if ($whereInProgram) {
			$studentList = $studentList->whereIn('lead_id', function (BaseBuilder $builder) use ($whereInProgram) {
				return $builder->select('lid')->from($this->lmsDb . '.lead_profile_' . session('year'))->whereIn('lead_programe', $whereInProgram);
			});
		}
		if ($whereInHandler) {
			$studentList = $studentList->whereIn('handler_id', $whereInHandler);
		}
		if ($whereInTeams) {
			$studentList = $studentList->whereIn('handler_id', $whereInTeams);
		}
		if ($whereInNationality) {
			$studentList = $studentList->whereIn('student_reg_fee_id', $whereInNationality);
		}

		if ($slug == 'registration') {
			$studentList = $studentList->where('payment_status is NOT null');
		}
		if ($slug == 'admission-done') {
			$studentList = $studentList->where('provisional_fees is NOT null');
		}


		$data['total_records'] = $studentList->countAllResults(false);
		$data['studentList'] = $studentList->orderBy('lr_id', 'DESC')->paginate(500);
		$data['pager'] = $modelReferenceDb->pager;
		$data['pageInfo'] = $pageInfo[$slug];
		$data['pagename'] = "admin/report-list";
		$courseModel = new ApplicationModel('course_info', 'coi_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['course_name', 'course_code', 'dept_id', 'coi_id', 'level_id'])->findAll();
		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$data['sources'] = $sources ?? [];
		$lmsHandlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		$data['handlers'] = $lmsHandlerModel->select(['user_name', 'lu_id'])->where('user_report_to', session('id'))->where('user_deleted_status', 0)->orderBy('lu_id', 'DESC')->findAll();
		$data['teamLeaders'] = $lmsHandlerModel->select(['user_name', 'lu_id'])->where(['db_name' => session('db_priffix'), 'user_role' => 1])->findAll() ?? [];
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];
		//dd($data);
		return view('admin/index', $data);
	}

	public function process_application($lid = false,  $sid = false, $slug = false, $subSlug = 'personal')
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		// check first admin this
		$lmsReferenceModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', $this->ssoDb);
		$lmsRefData = $lmsReferenceModel->where(['lead_id' => $lid, 'sid' => $sid, 'admin_type' => session('db_priffix')])->first();
		if (!$lmsRefData) {
			session()->setFlashdata('toastr', ['error' => 'There no reference from this lead.']);
			return redirect()->back();
		}


		$formStepModel = new ApplicationModel('form_steps', 'fs_id', $this->ssoDb);
		$group = 2;
		$formSteps = $formStepModel->where(['fs_status' => 1])->whereIn('fs_id', function (BaseBuilder $builder) use ($group) {
			return $builder->select('form_step_id')->from('fromstep_gp_members')->where(['fd_gp_id' => $group]);
		})->orderBy('position', 'ASC')->findAll() ?? [];

		$sidModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);
		$getFormStep = $sidModel->select(['form_step', 'password', 'page_name', 'slug', 'position'])->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.fs_id', 'left')->where(['sid' => $sid])->first() ?? [];
		$pagename = 'admission/process-application';
		if (($key = array_search($getFormStep['form_step'], array_column($formSteps, 'fs_id'))) !== false) {
			$availablePosition = $formSteps[$key]['position'];
			$currentPosition = $formSteps[$key]['position'];
			$formView = $formSteps[$key]['page_name'];
			if ($slug === false) {
				$slug = $formSteps[$key]['slug'];
			} else {
				if (($key1 = array_search($slug, array_column($formSteps, 'slug'))) !== false) {
					if ($availablePosition > $formSteps[$key1]['position']) {
						$slug = $formSteps[$key1]['slug'];
						$formView = $formSteps[$key1]['page_name'];
						$currentPosition = $formSteps[$key1]['position'];
					} else {
						if ($slug !== $formSteps[$key]['slug'])
							session()->setFlashdata('toastr', ['info' => 'Request Page are not available for this student.']);
					}
				} else {

					session()->setFlashdata('toastr', ['error' => 'There is no such kind of form step available.']);
					return redirect()->back();
				}
			}
		} else {
			if ($getFormStep['page_name']) {
				$formView = $getFormStep['page_name'];
				$pagename = $getFormStep['page_name'];
				$availablePosition = $getFormStep['position'];
				$currentPosition = $getFormStep['position'];
			} else {
				session()->setFlashdata('toastr', ['error' => 'There is no such kind of form step available.']);
				return redirect()->back();
			}
		}
		$validSubSlug = ['personal', 'parent', 'address'];

		if ($slug == 'profile') {
			if (in_array($subSlug, $validSubSlug) !== false) {
			} else {
				session()->setFlashdata('toastr', ['error' => 'There is no such kind of form step available.']);
				return redirect()->back();
			}
		}
		$data = [];
		$data['validSubSlug'] = $validSubSlug;
		$data['route'] = 'admin/process-application/';
		$data['actionUrl'] = 'admin/profile-step-action/';
		$data['actionUrlDoc'] = 'admin/upload-documents/';
		$data['skipCouselling'] = 'admin/skip-counselling/';
		$data['ssoUrl'] = 'https://ldm.merishiksha.org/';
		$data['controller'] = 'admin';
		$data['lid'] = $lid;
		$data['sid'] = $sid;
		$data['slug'] = $slug;
		$data['formView'] = $formView;
		$data['subStep'] = $subSlug;
		$data['currentPosition'] = $currentPosition;
		$data['availablePosition'] = $availablePosition;
		$data['studentStep'] = $getFormStep ?? [];
		$data['formSteps'] = $formSteps;
		$data['pagename'] = $pagename;
		//dd($data);
		return view('admin/index', $data);
	}

	public function reportall()
	{
		if (!session('isLoggedInAdmin')) {
			return redirect()->to('/super-login');
		}
		ini_set('memory_limit', '-1');

		$remarkModel = new ApplicationModel('lead_remark_' . session('year'), 'lr_id', $this->lmsDb);

		$remarkModel->select(['lead_profile_' . session('year') . '.*', 'lr_remark', 'user_name', 'user_email', 'lr_created_at'])
			->join('lead_profile_' . session('year'), 'lead_remark_' . session('year') . '.lead_id=lead_profile_' . session('year') . '.lid')
			->join(SETTINGDB . '.lms_users_' . session('year'), 'lead_remark_' . session('year') . '.handler_id=' . SETTINGDB . '.lms_users_' . session('year') . '.lu_id');

		$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', $this->lmsDb);
		$leadModel->select(['status_name name', 'status_get_more_info type', 'COUNT(lid) total_leads', 'status_id id'])->join('status', 'lead_profile_' . session('year') . '.lead_status=status.status_id', 'right')->where(['lead_delete_status' => 0])->groupBy('status_id');

		// filters
		$whereInSources = $whereInStatus = $whereInProgram = $whereInDepartment = $whereDate = false;

		if (!empty($_GET['to']) && isset($_GET['to'])) {
			$todate = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
			$whereDate['lr_created_at<'] = $todate;
			$leadModel->whereIn('lid', function (BaseBuilder $builder) use ($todate) {
				return $builder->select('lead_id')->from('lead_remark_' . session('year'))->where(['lr_created_at<' => $todate]);
			});
		}

		if (!empty($_GET['from']) && isset($_GET['from'])) {
			$fromDate = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
			$whereDate['lr_created_at>'] = $fromDate;
			$leadModel->whereIn('lid', function (BaseBuilder $builder) use ($fromDate) {
				return $builder->select('lead_id')->from('lead_remark_' . session('year'))->where(['lr_created_at>' => $fromDate]);
			});
		}

		if (array_filter($_GET['status'] ?? []) != [] && isset($_GET['status'])) {
			$whereInStatus = $_GET['status'] ?? [];
			$remarkModel->whereIn('lead_status', $whereInStatus);
			$leadModel->whereIn('lead_status', $whereInStatus);
		}

		if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
			$whereInSources = $_GET['source'] ?? [];
			$remarkModel->whereIn('lead_source', $whereInSources);
			$leadModel->whereIn('lead_source', $whereInSources);
		}

		if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
			$whereInProgram = $_GET['program'] ?? [];
			$remarkModel->whereIn('lead_programe', $whereInProgram);
			$leadModel->whereIn('lead_programe', $whereInProgram);
		}
		if (array_filter($_GET['department'] ?? []) != []  && isset($_GET['department'])) {
			$whereInDepartment = $_GET['department'] ?? [];
			$remarkModel->whereIn('lead_department', $whereInDepartment);
			$leadModel->whereIn('lead_department', $whereInDepartment);
		}

		if (array_filter($_GET['nationality'] ?? []) != []  && isset($_GET['nationality'])) {
			$whereInNationality = $_GET['nationality'] ?? [];
			$remarkModel->whereIn('lead_nationality', $whereInNationality);
			$leadModel->whereIn('lead_nationality', $whereInNationality);
		}

		if (array_filter($_GET['handlers'] ?? []) != []  && isset($_GET['handlers'])) {
			$whereHandlers = $_GET['handlers'] ?? [];
			$remarkModel->whereIn('handler_id', $whereHandlers);
			$leadModel->whereIn('lid', function (BaseBuilder $builder) use ($whereHandlers) {
				return $builder->select('lead_id')->from('lead_allocation_' . session('year'))->whereIn('handler_id', $whereHandlers);
			});
		}

		if (!empty($_GET['mobile']) && isset($_GET['mobile'])) {
			$whereDate['lead_mobile'] = $_GET['mobile'];
			$leadModel->where('lead_mobile', $whereDate['lead_mobile']);
		}


		if ($whereDate) {
			$remarkModel->where($whereDate);
		}

		$data = [];
		$data['statusWise'] = $leadModel->findAll() ?? [];
		$data['remarks'] = $remarkModel->orderBy('lr_id', 'DESC')->paginate(250);
		$data['pager'] = $remarkModel->pager;

		$lmsHandlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
		$data['handlers'] = $lmsHandlerModel->select(['user_name', 'lu_id'])->where('user_report_to', session('id'))->where('user_deleted_status', 0)->orderBy('lu_id', 'DESC')->findAll();

		$courseModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', $this->ssoDb);
		$data['courses'] = $courseModel->select(['sc_id', 'course_name', 'course_code'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->findAll();

		$deptModel = new ApplicationModel('departments', 'dept_id', $this->ssoDb);
		$data['departments'] = $deptModel->select(['dept_name', 'dept_id'])->findAll();

		$sourceModel = new ApplicationModel('sources', 'source_id', $this->lmsDb);
		$sources = $sourceModel->select(['source_name', 'source_score', 'source_id'])->where(['source_status' => 1])->findAll();
		$statusModel = new ApplicationModel('status', 'status_id', $this->lmsDb);
		$statuses = $statusModel->select(['status_name', 'status_get_more_info', 'status_id', 'score'])->where(['delete_status' => 0, 'status_type' => 1])->findAll();

		$data['sources'] = $sources ?? [];
		$data['statues'] = $statuses ?? [];
		$studentRegistrationModel = new ApplicationModel('student_reg_fee', 'srf_id', $this->ssoDb);
		$data['student_nationalities'] = $studentRegistrationModel->select(['srf_id as id', 'srf_name as name'])->where(['srf_delete_status' => 0])->findAll() ?? [];
		$data['title'] = 'Handler Work Report';
		$data['pagename'] = 'admin/report-all';
		return view('admin/index', $data);
	}
}
