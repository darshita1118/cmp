<?php
namespace App\Helpers;
use App\Models\ApplicationModel;

function getHelperOld():bool 
{
    
    $admin = new ApplicationModel('tbl_admission_session','sid','reg_setting_db');
    $getCurrentDb = $admin->asArray()->select(['start_year','admission_db_name'])->where(['status' =>1])->first();
    //dd($getCurrentDb);
    if(!session('current')){
        session()->set('current', ['s1'=>$getCurrentDb['admission_db_name'],'s2'=>$getCurrentDb['start_year']]);
    }
    
    return $getCurrentDb?true:false;
}


function getHelper():array
{
    $admin = new ApplicationModel('tbl_admission_session','sid','reg_setting_db');
    $getCurrentDb = $admin->asArray()->select(['start_year','admission_db_name'])->where(['status' =>1, 'start_year'=>session('year')])->first()??[];
    
    /*
    if(!session('current') && $getCurrentDb){
        session()->set('current', ['s1'=>$getCurrentDb['admission_db_name'],'s2'=>$getCurrentDb['start_year']]);
    }
    */
    
    return $getCurrentDb;
}


?>