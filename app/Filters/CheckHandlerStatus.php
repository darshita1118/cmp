<?php

namespace App\Filters;

use App\Models\ApplicationModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use function App\Helpers\getHelper;

class CheckHandlerStatus implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // it execute when call logout function
        //if ($request->uri->getPath() == 'handler/logout') {
        if (url_is('handler/logout')) {
            return true;
        }

        if (!session('suffix') || !session('year') || !session('db_priffix') || !session('admission_source')) {
            return redirect()->to('/handler/logout');
        }

        // by default session expire than it call
        if (!session('id') && !session('history') || !session('isLoggedIn')) {
            return redirect()->to('/handler/logout');
        }
        //dd($_SESSION);
        try {

            $model = new ApplicationModel('lms_users_' . session('year'), 'lu_id', 'reg_setting_db');
            $user = $model->where(array('lu_id' => session()->get('id'), 'user_status' => 1, 'user_deleted_status' => 0))->first();
            if (!$user) {
                //echo "Not User";
                return redirect()->to('/handler/logout');
            }
            $data = [
                'hlh_id' => session('history'),
                'logout_time' => time(),
            ];
            $admin = new ApplicationModel('handler_login_history_' . session('year'), 'hlh_id', session('db_priffix') . '_' . session('suffix'));
            $admin->save($data);
            if (url_is('handler/add-lead') || url_is('handler/lead-action') || url_is('handler/apply-now/*') || url_is('handler/create-member')) {
                helper('DBHelper');
                $detail = getHelper();
                if (!$detail) {
                    session()->setFlashdata('toastr', ['error' => 'Session ' . session('year') . '-' . (session('year') + 1) . ' admission has been close.']);
                    return redirect()->back();
                }
                if (in_array(session('year'), ['2022'])) { // , '2023'
                    session()->setFlashdata('toastr', ['error' => 'Session ' . session('year') . '-' . (session('year') + 1) . ' admission has been close.']);
                    return redirect()->back();
                }
            }
            return true;
        } catch (\Throwable $th) {
            return redirect()->to('/handler/logout');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
