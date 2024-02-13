<?php

namespace App\Validation;

use App\Models\ApplicationModel;


use function App\Helpers\getHelper;

/**
 * // DistanceSystem@123
 *	distance_system_admin
 */
class UserRules
{
	public function is_unique_email(string $str, string $feilds, array $data)
	{

		getHelper();
		$model = new ApplicationModel('student_contact_info_' . session('current')['s2'], 'sci_id', session('current')['s1']);
		$user = $model->where('sci_email', $data['email'])->where('sci_delete_status!=', 1)->first();

		if (!$user)
			return true;

		return false;
	}
	public function is_unique_mobile(string $str, string $feilds, array $data)
	{
		getHelper();
		$model = new ApplicationModel('student_contact_info_' . session('current')['s2'], 'sci_id', session('current')['s1']);
		$user = $model->where('sci_mobile', $data['mobile'])->where('sci_delete_status!=', 1)->first();

		if (!$user)
			return true;

		return false;
	}



	public function validateUser(string $str, string $feilds, array $data)
	{
		//dd($data);
		try {
			$model = new ApplicationModel('lms_users_' . $data['year'], 'lu_id', 'reg_setting_db');

			session()->set('suffix', $this->lmsDB($data['year']));
			//return false;
		} catch (\Throwable $th) {
			//dd($th);
			return false;
		}
		$user = $model->where(['user_email' => $data['email'], 'user_status' => 1, 'user_deleted_status' => 0, 'user_role' => 2])->first();
		if ($user) {
			return password_verify($data['password'], $user['user_password']);
		}
		return false;
	}
	public function uniqueEmail(string $str, string $feilds, array $data)
	{
		$model = new ApplicationModel('lead_profile_' . session('year'), 'lid', session('db_priffix') . '_' . session('suffix'));
		//dd($data);
		if ($data['email'] == 'demo@gmail.com') {
			return true;
		}

		$user = $model->where(['lead_email' => $data['email'], 'lead_delete_status' => 0])->first();
		if ($user) {
			return false;
		}
		return true;
	}
	public function uniqueMobile(string $str, string $feilds, array $data)
	{
		$model = new ApplicationModel('lead_profile_' . session('year'), 'lid', session('db_priffix') . '_' . session('suffix'));
		$user = $model->where(['lead_mobile' => $data['mobile'], 'lead_delete_status' => 0])->first();
		if ($user)
			return false;

		return true;
	}

	public function uniqueHandlerEmail(string $str, string $feilds, array $data)
	{
		$model = new ApplicationModel('lms_users_' . session('year'), 'lu_id', 'reg_setting_db');
		$user = $model->where(['user_email' => $data['email'], 'user_deleted_status' => 0])->first();
		if ($user)
			return false;
		return true;
	}
	public function uniqueHandlerMobile(string $str, string $feilds, array $data)
	{
		$model = new ApplicationModel('lms_users_' . session('year'), 'lu_id', 'reg_setting_db');
		$user = $model->where(['user_mobile' => $data['mobile'], 'user_deleted_status' => 0])->first();
		if ($user)
			return false;

		return true;
	}
	public function validatehandler(string $str, string $feilds, array $data)
	{
		//dd($data,$this->lmsDB($data['year']));
		try {
			$model = new ApplicationModel('lms_users_' . $data['year'], 'lu_id', 'reg_setting_db');
			session()->set('suffix', $this->lmsDB($data['year']));
			//return false;
		} catch (\Throwable $th) {
			return false;
		}
		$user = $model->where(array('user_email' => $data['email'], 'user_status' => 1, 'user_deleted_status' => 0))->whereIn('user_role', ['0', '1'])->first();
		if ($user) {
			//return password_verify($data['password'], $user['user_password']);
			// encrpt the password then verify
			//return $data['password']==$user['user_password'];
			$x = password_verify($data['password'], $user['user_password']);
			if ($x === false && !empty($user['user_report_to'])) {
				$admin = $user['user_report_to'];
				$adminDetail = $model->where(array('lu_id' => $admin, 'user_status' => 1, 'user_deleted_status' => 0))->first();
				if ($adminDetail)
					$x = password_verify($data['password'], $adminDetail['user_password']);
			}
			return $x;
		}
		return false;
	}
	protected function lmsDB($val)
	{
		$data = [];
		for ($j = 5; $j > 0; --$j) {
			$startYear = $val - $j;
			if ($startYear % 5 == 0) {
				$data['start_year'] = $startYear + 1;
				break;
			}
		}
		for ($i = 0; $i < 5; $i++) {
			$endYear = $val + $i;
			if ($endYear % 5 == 0) {
				$data['end_year'] = substr($endYear, 2);
				break;
			}
		}
		return implode('_', $data);
	}
}
