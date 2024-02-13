<?php

use App\Models\ApplicationModel;
$formStep = [
    '1'=>'Payment',
    '2'=>'Payment Done and now in Profile Step.',
    '3'=>'Profile Done and now in Academic Step.',
    '4'=>'Academic Step done and Document Upload step.',
    '5'=>'Document Uploaded and now in Review step.',
    '6'=>'Review is Done and now in Scrutinizer Desk.',
    '7'=>'Scutinizer Desk given status Cleared then now go to Senior Desk.',
    '8'=>'Senior Desk given status cleared then go to Finance Desk.',
    '9'=>'Finance Desk cleared status then go to Verify Desk.',
    '10'=>'Verify Desk cleared status then go to Enrollment Desk.',
    '11'=>'Enrollment Desk cleared then your Admission done.',
];
$lmsDb = session('db_priffix').'_'.session('suffix');
function checkSidCreated($lead_id) 
{
    $referModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', 'sso_' . session('suffix'));
    $sidDetail = $referModel->select(['lms_db_reference_' . session('year').'.sid', 'form_step', 'handler_id','password'])->join('student_login_' . session('year'), 'student_login_' . session('year') . '.sid=lms_db_reference_' . session('year') . '.sid')->where('lead_id', $lead_id)->where('admin_type',session('db_priffix'))->first();
    return $sidDetail ? $sidDetail : [];
}
function getMessage($leadId)
{
    
    $statusInfoModel = new ApplicationModel('lead_status_'.session('year'), 'ls_id', session('db_priffix').'_'.session('suffix'));
    return $statusInfoModel->select(['message','ls_time', 'ls_date'])->where(['lead_id'=> $leadId])->first()??'';
}

function getHandlerList($notIn = [])
{
    $handlerModel = new ApplicationModel('lms_users_'.session('year'), 'lu_id', 'reg_setting_db');
    $handlers = $handlerModel->select(['lu_id','user_name', 'user_role', 'user_report_to'])->where(['user_status'=>1, 'user_deleted_status'=>0, 'user_report_to'=>session('report_to')]);
    if(!empty($notIn)){
        $handlers->whereNotIn('lu_id', $notIn);
    }
    return $handlers->findAll()??[];
}
function getSinglehandler($handler)
{
    $handlerModel = new ApplicationModel('lms_users_'.session('year'), 'lu_id', 'reg_setting_db');
    $handler = $handlerModel->select(['user_name'])->where('lu_id',$handler)->first();
    return $handler?$handler['user_name']:'';
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

$handlers = getHandlerList([session('id')]);


$getMessage = getMessage($profileDetail['lid']);

$name = ucwords(trim($profileDetail['lead_first_name'] . ' ' . $profileDetail['lead_middle_name'] . ' ' . $profileDetail['lead_last_name']));

?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Education-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                    <!--begin::Nav Panel Widget 2-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body pt-2">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between flex-column h-100">
                                <!--begin::Container-->
                                <div class="pb-5">
                                    <!--begin::Header-->
                                    <div class="py-2">
                                        <h4 class="mb-0">Profile Details</h4>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex align-items-center mt-2">

                                        <div>
                                            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><b><?= $name ?></b></a>
                                            <div class="text-muted"><?= $profileDetail['coursename'] ?></div>

                                        </div>
                                    </div>
                                    
                                    <div class="pt-3 pb-3">
                                        <?php if ($sidData = checkSidCreated($profileDetail['lid'])) :  ?>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-weight-bold mr-2"><b>SID/Password:</b></span>
                                                <span class="text-muted"><?=  $sidData['sid'].'/'.base64_decode($sidData['password']) ?></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-weight-bold mr-2"><b>Form Step:</b></span>
                                                <span class="text-muted"><?=  $formStep[$sidData['form_step']]??'' ?></span>
                                            </div>
                                            <?php if($sidData['form_step'] <= 6): ?>
                                                <a href="<?= base_url('handler/process-application/'.$profileDetail['lid'].'/'.$sidData['sid']) ?>" target="_blank" class="btn btn-outline-success btn-sm mx-auto my-2">Proceed Application</a>
                                                
                                            <?php else: ?>
                                                <a href="<?= base_url('handler/process-application/'.$profileDetail['lid'].'/'.$sidData['sid']) ?>" class="btn btn-outline-success btn-sm mx-auto my-2">Appication Under Process</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="<?= base_url('handler/apply-now/'.$profileDetail['lid']) ?>" class="btn btn-outline-success btn-sm mx-auto my-2" target="_blank">Generate Sid</a>
                                        <?php endif; ?>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="font-weight-bold mr-2"><b>Email:</b></span>
                                            <a href="mailto:<?= $profileDetail['lead_email'] ?>" class="text-muted text-hover-primary"><?= $profileDetail['lead_email'] ?></a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="font-weight-bold mr-2"><b>Moblie:</b></span>
                                            <a href="tel:<?= $profileDetail['lead_country_code'] . $profileDetail['lead_mobile'] ?>" class="text-muted text-hover-primary">
                                            <span class="text-muted">(<?= $profileDetail['lead_country_code'] ?>)<?=$profileDetail['lead_mobile'] ?></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="py-2">
                                        <h4 class="mb-0">Contact To</h4>
                                    </div>
                                    <hr class="my-1">
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="mt-4">
                                        <!--begin::Text-->

                                        <!--end::Text-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-3">
                                            <!--begin::Symbol-->
                                            <div class="mx-auto">
                                                <a href="https://web.whatsapp.com/send?phone=<?= trim($profileDetail['lead_country_code'] . $profileDetail['lead_mobile']) ?>" class="symbol symbol-45 symbol-light mr-4" target="_blank"  title="Whatsapps">
                                                    <span class="symbol-label">
                                                        <i class="icon-2x la text-success socicon-whatsapp"></i>
                                                    </span>
                                                </a>
                                                <a href="tel:<?= $profileDetail['lead_country_code'] . $profileDetail['lead_mobile'] ?>" class="symbol symbol-45 symbol-light mr-4"  title="Phone Call">
                                                    <span class="symbol-label">
                                                        <i class="icon-2x la text-success socicon-viber"></i>
                                                    </span>
                                                </a>
                                                <a href="#sendSMSModel" data-toggle="modal" data-target="#sendSMSModel" class="symbol symbol-45 symbol-light mr-4" title="Send SMS">
                                                    <span class="symbol-label">
                                                        <i class="icon-2x la text-success socicon-stackexchange"></i>
                                                    </span>
                                                </a>
                                                <a href="#sendEmailModel" data-toggle="modal" data-target="#sendEmailModel" class="symbol symbol-45 symbol-light mr-4" title="Send Email">
                                                       <span class="symbol-label">
                                                        <i class="icon-2x la text-success socicon-mail"></i>
                                                    </span>
                                                </a>
                                                
                                            </div>
                                            <!--end::Symbol-->


                                        </div>
                                        <!--end::Item-->
                                        <div class="py-2">
                                            <h4 class="mb-0">More Action and Information</h4>
                                        </div>
                                        <hr class="my-1">
                                        <!--begin::Item-->
                                        <div class="d-none align-items-center mb-2 px-2 py-2" style="background: #efefef; border-radius: 5px;">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35 symbol-light mr-4">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5" />
                                                                <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5" />
                                                                <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero" />
                                                                <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <div class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                    Lead Score</div>

                                            </div>
                                            <!--end::Text-->
                                            <!--begin::label-->
                                            <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">7</span>
                                            <!--end::label-->
                                        </div>
                                        <!--end::Item-->
                                        
                                        <!--begin::Item-->
                                        <div data-toggle="modal" data-target="#alternatecontact" class="d-flex align-items-center mb-2 px-2 py-2" style="cursor: pointer;background: #efefef; border-radius: 5px;">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35 symbol-light mr-4">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M17,2 L19,2 C20.6568542,2 22,3.34314575 22,5 L22,19 C22,20.6568542 20.6568542,22 19,22 L17,22 L17,2 Z" fill="#000000" opacity="0.3" />
                                                                <path d="M4,2 L16,2 C17.6568542,2 19,3.34314575 19,5 L19,19 C19,20.6568542 17.6568542,22 16,22 L4,22 C3.44771525,22 3,21.5522847 3,21 L3,3 C3,2.44771525 3.44771525,2 4,2 Z M11.1176481,13.709585 C10.6725287,14.1547043 9.99251947,14.2650547 9.42948307,13.9835365 C8.86644666,13.7020183 8.18643739,13.8123686 7.74131803,14.2574879 L6.2303083,15.7684977 C6.17542087,15.8233851 6.13406645,15.8902979 6.10952004,15.9639372 C6.02219616,16.2259088 6.16377615,16.5090688 6.42574781,16.5963927 L7.77956724,17.0476658 C9.07965249,17.4810276 10.5130001,17.1426601 11.4820264,16.1736338 L15.4812434,12.1744168 C16.3714821,11.2841781 16.5921828,9.92415954 16.0291464,8.79808673 L15.3965752,7.53294436 C15.3725414,7.48487691 15.3409156,7.44099843 15.302915,7.40299777 C15.1076528,7.20773562 14.7910703,7.20773562 14.5958082,7.40299777 L13.0032662,8.99553978 C12.5581468,9.44065914 12.4477965,10.1206684 12.7293147,10.6837048 C13.0108329,11.2467412 12.9004826,11.9267505 12.4553632,12.3718698 L11.1176481,13.709585 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <div class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                    Alternate Contact</div>

                                            </div>
                                            <!--end::Text-->

                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div data-toggle="modal" data-target="#addressModel" class="d-flex align-items-center mb-2 px-2 py-2" style="cursor: pointer;background: #efefef; border-radius: 5px;">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35 symbol-light mr-4">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3" />
                                                                <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <div class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                    Address</div>

                                            </div>
                                            <!--end::Text-->

                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div data-toggle="modal" data-target="#transferlead" class="d-flex align-items-center mb-2 px-2 py-2" style="cursor: pointer;background: #efefef; border-radius: 5px;">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35 symbol-light mr-4">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) " />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <div class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                    Transfer Lead</div>

                                            </div>
                                            <!--end::Text-->

                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--eng::Container-->
                                <!--begin::Footer-->
                                <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1" data-toggle="tooltip" title="" data-placement="right">
                                    <button class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14" data-toggle="modal" data-target="#kt_chat_modal">Write a Message</button>
                                </div>
                                <!--end::Footer-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Nav Panel Widget 2-->

                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-4">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--Begin::Header-->
                        <div class="card-header card-header-tabs-line px-2">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                                    <li class="nav-item mr-2  d-inline-block d-lg-none"  id="kt_subheader_mobile_toggle">
                                        <div class="nav-link mr-0">

                                            <div class="mr-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <circle fill="#000000" cx="12" cy="5" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="19" r="2"></circle>
                                                    </g>
                                                </svg>
                                            </div>
                                            <span class="nav-text font-weight-bold">Menu</span>
                                        </div>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link active" data-toggle="tab" href="#personalinfo">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="nav-text font-weight-bold">Personal</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#history">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="nav-text font-weight-bold">History</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--Begin::Body-->
                        <div class="card-body px-0">
                            <div class="tab-content">
                                <!--begin::Tab Content-->
                                <div class="tab-pane active" id="personalinfo" role="tabpanel">
                                
                                    <form class="form" method="post" action="">
                                        <?= csrf_field() ?>
                                        <!--begin::Heading-->
                                        <div class="row mx-0">
                                            <div class="col-lg-12">
                                                <h3 class="font-size-h6 mb-3">Student Status:</h3>
                                            </div>

                                            <!--end::Heading-->
                                            <div class="form-group col-lg-12">
                                                <label for="status">Lead
                                                    Status</label>
                                               
                                                    <select  class="form-control form-control-lg form-control-solid" id="status" name="status" required="" onchange="getInfoProfile($(this).find(':selected').attr('data-getinfo')
                                                    );">
                                                        <?php foreach($status_list as $status): ?>
                                                            <option data-statusscore='<?= $status['score'] ?>' data-getinfo='<?= $status['status_get_more_info'] ?>' value="<?= $status['status_id'] ?>" <?= (old('status')?? $profileDetail['lead_status']) == $status['status_id'] ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
                                                        <?php endforeach; ?>
                                                        
                                                    </select>
                                                
                                            </div>
                                            <div id='getExtraField' class="col-lg-12">
                                                
                                            </div>

                                            
                                            <div class="form-group col-lg-2">

                                                <button class="form-control form-control-lg text-white btn btn-primary font-weight-bold" name="btn"  type="submit" value="update-status">Update</button>
                                            </div>

                                        </div>
                                    </form>
                                    
                                    <div class="separator separator-dashed my-2"></div>
                                    <!--begin::Heading-->
                                    <form class="form" method="post" action="">
                                        <?= csrf_field() ?>
                                        <div class="row mx-0">
                                            <div class="col-lg-12">
                                                <h3 class="font-size-h6 mb-3">Academics:</h3>
                                            </div>

                                            <!--end::Heading-->
                                            <div class="form-group col-lg-6">
                                                <label for="program">Program:</label>
                                                <select type="text" id="program" name="program" onchange="$('#level').val($(this).find(':selected').attr('data-level')); $('#dept').val($(this).find(':selected').attr('data-dept'));" class="form-control form-control-lg form-control-solid" required>
                                                    <option value="">--select program--</option>
                                                    <?php foreach($courses as $course): ?>
                                                        <option data-level='<?= $course['level_id'] ?>' data-dept='<?= $course['dept_id'] ?>' value="<?= $course['coi_id'] ?>" <?= (old('program')??$profileDetail['lead_programe']) == $course['coi_id'] ? 'selected' : null ?>><?= $course['course_name'] ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" name='level' value="" id="level">
                                                <input type="hidden" name='dept' value="" id="dept">
                                                
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="">&nbsp;</label>

                                                <button class="form-control form-control-lg text-white btn btn-primary font-weight-bold" type="submit" name='btn' value="lead-program">Update</button>
                                            </div>

                                        </div>

                                    </form>
                                    
                                    
                                    <!--begin::Heading-->
                                    <?php if($profileDetail['lead_email'] == 'demo@gmail.com'): ?>
                                    <div class="separator separator-dashed my-2"></div>
                                    <form class="form" method="post" action="">
                                        <?= csrf_field() ?>
                                        <div class="row mx-0">
                                            <div class="col-lg-12">
                                                <h3 class="font-size-h6 mb-3">Contact Info:</h3>
                                            </div>

                                            <!--end::Heading-->
                                            <div class="form-group col-lg-6">
                                                <label for="">Mobile No.</label>

                                                <div class="input-group input-group-lg">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="la la-phone"></i>
                                                        </span>
                                                    </div>
                                                    <input type="tel" class="form-control form-control-lg form-control-solid px-2" value="<?= $profileDetail['lead_mobile'] ?>" placeholder="Mobile No." disabled />
                                                </div>


                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="email">Email
                                                </label>
                                                <?php if($profileDetail['lead_email'] == 'demo@gmail.com'): ?>
                                                    <div class="input-group input-group-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-at"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" class="form-control form-control-lg form-control-solid px-2" id="email" name="email" value="<?= old('email')??''?>" placeholder="smile@sgvu.org" required />
                                                    </div>
                                                <?php else: ?>
                                                    <div class="input-group input-group-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-at"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" class="form-control form-control-lg form-control-solid px-2"  value="<?= $profileDetail['lead_email'] ?>" placeholder="Email" required />
                                                    </div>
                                                <?php endif; ?>

                                               

                                            </div>
                                            <div class="form-group col-lg-2">

                                                <button class="form-control btn btn-primary font-weight-bold" type="submit" name="btn" value="update-email">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php endif; ?>
                                    <div class="separator separator-dashed my-2"></div>
                                    <form class="form" method="post" action="">
                                        <?= csrf_field() ?>
                                        <!--begin::Heading-->
                                        <div class="row mx-0">
                                            <div class="col-lg-12">
                                                <h3 class="font-size-h6 mb-3">Student Info:</h3>
                                            </div>

                                            <!--end::Heading-->

                                            <div class="form-group col-lg-4">
                                                <label for="firstname">First Name:</label>
                                                <input type="text" id="firstname" name="firstname" class="form-control form-control-lg form-control-solid" placeholder="Enter first name" value="<?= old('firstname')?? $profileDetail['lead_first_name'] ?>" required>

                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="middlename">Middle Name:</label>
                                                <input type="text" id="middlename" name="middlename" class="form-control form-control-lg form-control-solid" placeholder="Enter last name" value="<?= old('middlename')?? ($profileDetail['lead_middle_name']??'') ?>">

                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="lastname">Last Name:</label>
                                                <input type="text" id="lastname" name="lastname" class="form-control form-control-lg form-control-solid" placeholder="Enter last name" value="<?= old('lastname')?? ($profileDetail['lead_last_name']??'') ?>">

                                            </div>
                                            <div class="form-group col-lg-2">

                                                <button class="form-control form-control-lg text-white btn btn-primary font-weight-bold" name="btn"  type="submit" value="update-name">Update</button>
                                            </div>

                                        </div>
                                    </form>

                                    

                                </div>
                                <!--end::Tab Content-->

                                <!--begin::Tab Content-->
                                <div class="tab-pane" id="history" role="tabpanel">
                                    <div class="container">

                                        <!--begin::Timeline-->
                                        <div class="timeline timeline-3">
                                            <div class="timeline-items">
                                                <?php foreach($remarks as $rmk): 
                                                    $remarkTypes = ['Status', 'Source', 'Program', 'Personal Detail', 'Transfer', 'Address', 'Alternative or Contact', 'SMS Send', 'Email Send', 'Remark Message'];
                                                    $remarkIcon = ['flaticon-medal', '
                                                    flaticon-customer', 'flaticon-clipboard', 'flaticon-clipboard', 'flaticon-more-v4', 'flaticon-map-location', 'flaticon2-phone', 'flaticon2-sms', 'flaticon2-mail', 'flaticon-interface-2'];
                                                    if($rmk['handler_id'] == session('id')):
                                                        $handlername = 'You';
                                                    else:
                                                        $handlername = getSinglehandler($rmk['handler_id']);
                                                    endif;
                                                ?>
                                                
                                                    <div class="timeline-item">
                                                        <div class="timeline-media">
                                                            <i class="<?= $remarkIcon[$rmk['lr_type']-1] ?> text-danger" title="<?= $remarkTypes[$rmk['lr_type']-1] ?>"></i>
                                                        </div>
                                                        <div class="timeline-content">
                                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                                <div class="mr-2">
                                                                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold"><?= $handlername ?></a>
                                                                    <span class="text-muted ml-2"><?= date('h:i A l d M Y', strtotime($rmk['lr_created_at'])) ?></span>
                                                                    
                                                                </div>

                                                            </div>
                                                            <p class="p-0"><?= $rmk['lr_remark'] ?></p>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                
                                                
                                            </div>
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                </div>
                                <!--end::Tab Content-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Education-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<!--begin::Chat Panel-->
<div class="modal modal-sticky modal-sticky-bottom-right w-30" id="kt_chat_modal" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header align-items-center px-4 py-3">

                    <div class="text-left flex-grow-1">
                        <div class="text-dark-75 font-weight-bold font-size-h5"><?= $name ?></div>
                        
                    </div>
                    <div class="text-right flex-grow-1">
                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-dismiss="modal">
                            <i class="ki ki-close icon-1x"></i>
                        </button>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="scroll scroll-pull" data-height="375" data-mobile-height="300">
                        <!--begin::Messages-->
                        <div class="messages">
                            <?php foreach($remarks as $remark): ?>
                                <?php if($remark['handler_id'] == session('id')): ?>
                                    <!--begin::Message Out-->
                                    <div class="d-flex flex-column mb-3 align-items-end">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <span class="text-muted font-size-sm"><?= time_elapsed_string($remark['lr_created_at']) ?></span>
                                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                                            </div>
                                            
                                        </div>
                                        <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">
                                            <?= $remark['lr_remark'] ?></div>
                                            <div class="mnt-1 rounded pt-0 text-dark-50 font-weight-bold font-size-lg text-right max-w-400px"><?= date('l d M Y h:i A', strtotime($remark['lr_created_at'])) ?></div>
                                    </div>
                                    <!--end::Message Out-->
                                <?php else: 
                                    
                                        $handlername = getSinglehandler($remark['handler_id']);
                                    
                                ?>
                                    <!--begin::Message In-->
                                    <div class="d-flex flex-column mb-3 align-items-start">
                                        <div class="d-flex align-items-center">
                                            
                                            <div>
                                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                                    <?= $handlername ?>
                                                </a>
                                                <span class="text-muted font-size-sm"><?= time_elapsed_string($remark['lr_created_at']) ?></span>
                                            </div>
                                        </div>
                                        <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
                                        <?= $remark['lr_remark'] ?></div>
                                        <div class="mnt-1 rounded pt-0 text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"><?= date('l d M Y h:i A', strtotime($remark['lr_created_at'])) ?></div>
                                    </div>
                                    <!--end::Message In-->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <!--end::Messages-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer align-items-center">
                    <!--begin::Compose-->
                    <form action="" method="post">
                        <?= csrf_field() ?>
                        <input name='remarkMessage' required class="form-control border-0 px-2" rows="2" placeholder="Type a message"/>
                        <div class="d-flex align-items-center justify-content-between mt-5">
                            
                            <div>
                                <button type="submit" name="btn" value="remark" class="btn btn-primary btn-md text-uppercase font-weight-bold  py-2 px-6">Send</button>
                            </div>
                        </div>
                    </form>
                    <!--begin::Compose-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
    </div>
</div>
<!--end::Chat Panel-->

<!-- alternate contact -->
<div class="modal fade" id="alternatecontact" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alternatecontact">Alternate Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" action="">
                    <div class="row mx-0">
                    <?= csrf_field() ?>
                        <!--end::Heading-->
                        <div class="form-group col-lg-12">
                            <label for="">Mobile No.</label>

                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-phone"></i>
                                    </span>
                                </div>
                                <input type="tel" name="alter_mobile" class="form-control form-control-lg form-control-solid px-2" value="<?= (old('alter_mobile')?? @$alternatives['ci_mobile'])??'' ?>" placeholder="Mobile No." required="" minlength="8" maxlength="12">
                            </div>


                        </div>
                        <div class="form-group col-lg-12">
                            <label for="email">Email
                            </label>

                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-at"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control form-control-lg form-control-solid px-2" id="email" name="alter_email" value="<?= (old('alter_email')?? @$alternatives['ci_email'])??'' ?>" placeholder="Email" required="">
                            </div>

                        </div>
                        <div class="form-group col-lg-12 mx-auto">

                            <button class=" btn btn-primary font-weight-bold" type="submit"  name = "btn" value="lead-alternative">Update</button>
                            <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end alternate contact -->
<!-- transfer lead -->
<div class="modal fade" id="transferlead" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transferlead">Transfer Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post">
                    <?= csrf_field() ?>
                    <div class="row mx-0">

                        <!--end::Heading-->
                        <div class="form-group col-lg-12">
                            <label for="handler">Choose Handler:</label>
                            <select  id="handler" name="handler" class="form-control form-control-lg form-control-solid" required="">
                                <option value="">--Choose Handler--</option>
                                <?php foreach($handlers as $handler): ?>
                                    <option value="<?= $handler['lu_id'] ?>"><?= $handler['user_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-12 mx-auto">

                            <button class=" btn btn-primary font-weight-bold" name='btn' type="submit" value="transfer">Transfer</button>
                            <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end Transfer  lead -->
<!-- alternate address -->
<div class="modal fade" id="addressModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModelTitle">Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post">
                <?= csrf_field() ?>
                    <!--begin::Heading-->
                    <div class="row ">

                        <!--end::Heading-->
                        <div class="form-group col-lg-12">
                            <label for="country">Country:</label>
                            <select id="country" name="country" onchange="countrySelect(this.value)" class="form-control form-control-lg form-control-solid" required>
                                <option value="">-- Select --</option>
                                <?php foreach($countries as $country): ?>
                                    <option  value="<?= $country['name'] ?>" <?php if(old('country') || isset($address['la_country'])): ?>
                                        <?= (old('country')?? ($address['la_country'])??'') == $country['name'] ? 'selected' : null ?>
                                        <?php else: ?>
                                            <?= 'India' == $country['name'] ? 'selected' : null ?>
                                        <?php endif; ?>><?= $country['name'] ?> </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div id="countryType" class="form-group col-lg-12 mb-0">
                            
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="street_address">Street:</label>
                            <input type="text" id="street_address" name="street_address" class="form-control form-control-lg form-control-solid" placeholder="Enter Street Address" value="<?= old('street_address')??($address['la_street_address']??'') ?>" required="">

                        </div>
                        <div class="form-group col-lg-12" >
                            <label for="zipcode">PIN/ZIP Code:</label>
                            <input type="tel" id="zipcode" name="zipcode" class="form-control form-control-lg form-control-solid" placeholder="Enter pin/zip code" value="<?= old('zipcode')??($address['la_zipcode']??'') ?>" required>

                        </div>
                        
                        <?php if (session('addressError')) : ?>
                            <fieldset class="col-lg-12 mx-auto">
                                <div class="alert alert-danger">
                                    <?php foreach(session('addressError') as $error): ?>
                                    <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </div>
                            </fieldset>
                        <?php endif; ?>

                        <div class="form-group col-lg-12 mx-auto">

                            <button class="btn btn-primary font-weight-bold" type="submit" name="btn" value="address-btn">submit</button>
                            <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end alternate address -->
<!-- SEND SMS -->
<div class="modal fade" id="sendSMSModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SNSModel">SEND SMS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post">  
                    <?= csrf_field() ?>
                    <!--begin::Heading-->
                    <div class="row mx-0">
                        <!--end::Heading-->
                        <div class="form-group col-lg-12">
                            <label for="sms">Select SMS Template:</label>
                            <select id="sms" name="sms" class="form-control form-control-lg form-control-solid" required>
                                <option value="">--select SMS Template--</option>
                                <?php foreach($smsTemplates as $sms): ?>
                                    <option value="<?= $sms['st_id'] ?>"><?= $sms['st_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-12 mx-auto">
                            <button class="btn btn-primary font-weight-bold" type="submit" name='btn' value="sendSMS">submit</button>
                            <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end SEND SMS -->
<!-- SEND Email -->
<div class="modal fade" id="sendEmailModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModel">SEND Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post" >  
                    <!--begin::Heading-->
                    <?= csrf_field() ?>
                    <div class="row mx-0">
                        <!--end::Heading-->
                        <div class="form-group col-lg-12">
                            <label for="email">Select Email Template:</label>
                            <select id="email" name="email" class="form-control form-control-lg form-control-solid" onchange="getAttachment($(this).find(':selected').attr('data-attachment'))" required>
                                <option value="">--Select Email Template--</option>
                                <?php foreach($emailTemplates as $email): ?>
                                    <option data-attachment='<?= $email['et_have_attachment'] ?>' value="<?= $email['et_id'] ?>"><?= $email['et_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id='attachment'></div>
                        
                        <div class="form-group col-lg-12 mx-auto">
                            <button class=" btn btn-primary font-weight-bold" type="submit" name='btn' value="sendEmail">submit</button>
                            <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end SEND Email -->
<script src="<?= base_url('assets/js/custum.js') ?>" ></script>

<script>
    const base_url = '<?= base_url() ?>'
    let stateList = [];
    function getAttachment(params) {
        if(params == 1){
            $('#attachment').html(`<label for="attach">Select Email Template:</label>
                            <select id="attach" name="attachment" class="form-control form-control-lg form-control-solid"  required>
                                <option value="">--Select Attachment Template--</option>
                                
                            </select>`).addClass('form-group col-lg-12')
        }else{
            $('#attachment').text("No Attachment").addClass('form-group col-lg-12')
        }
    }
    
    function getStateList(params='', dist='') {
        $.ajax({
            url: base_url+'/assets/json/india.json',
            type: 'get',
            dataType: 'JSON',
            async: false,
            success: function (result) {
                stateList = result
                $('#state').html(`<option value="">--select state--</option>`);
                
                for (let index = 0; index < result.length; index++) {
                    const stateIndex = index;
                    if(params == result[index].state){
                        $('#state').append($('<option>', { 
                            value: result[index].state,
                            "data-index": index,
                            text : result[index].state,
                            selected:true,
                        }))
                        getDistrictList(stateIndex, dist)
                    }else{
                        $('#state').append($('<option>', { 
                            value: result[index].state,
                            "data-index": index,
                            text : result[index].state,
                        }))
                    }
                    
                }
               
            },
            error: function(){
                //console.log(result)
                showFire(`error`, `Something Went Wrong on Server Side`);
            }
            
        });
        return
    }

    function getDistrictList(stateId = '', district='') {
        
        var districts = stateList[stateId].districts;
        $('#district').html(`<option value="">--select state--</option>`);
        for (let index = 0; index < districts.length; index++) {
            if(district == districts[index]){
                $('#district').append($('<option>', { 
                    value: districts[index],
                    text : districts[index],
                    selected:true,
                }))
            }else{
                $('#district').append($('<option>', { 
                    value: districts[index],
                    text : districts[index],
                }))
            }
            
        }
        return;
    }
    
    function countrySelect(p, s='', d='') {
        $.ajax({
            url: base_url+'/helper/countrySelect',
            type: 'POST',
            data: {'country':p,'dist':d},
            async: false,
            success: function (result) {
                //console.log(result)
                $('#countryType').html('');
                $('#countryType').html(result);
                if(p =='India'){
                    $('#zipcode').prop('required', true)
                    getStateList(s,d)
                }else{
                    $('#zipcode').prop('required', false)
                }
            },
            error: function(){
                //console.log(result)
                showFire(`error`, `Something Went Wrong on Server Side`);
            }
        })
        return;     
    }
    <?php if(old('country') || isset($address['la_country'])): ?>
        <?php if((old('country')??($address['la_country']??'')) == 'India'): ?>
            countrySelect(`<?= old('country')??($address['la_country']??'') ?>`,`<?= old('state')??($address['la_state']??'') ?>`, `<?= old('district')??($address['la_district']??'') ?>`)
        <?php else: ?>
            countrySelect(`<?= old('country')??($address['la_country']??'') ?>`,``, `<?= old('district')??($address['la_district']??'') ?>`)
        <?php endif; ?>
    <?php else: ?>
        countrySelect($('#country').val())
    <?php endif; ?>
    <?php if(old('program') || (isset($profileDetail['lead_programe']) && !empty($profileDetail['lead_programe']))): ?>
        $('#level').val($('#program').find(':selected').attr('data-level')); 
        $('#dept').val($('#program').find(':selected').attr('data-dept'))
    <?php endif; ?>

    <?php if (session('addressError')) : ?>
        $('#addressModel').modal('show')
    <?php endif; ?>
    <?php if(old('status')!==0 && old('statusinfo')): ?>
    console.log('te')
        getInfoProfile('<?= old('statusinfo') ?>', '<?= old('message') ?>', '<?= old('date') ?>', '<?= old('time') ?>');
    <?php else: ?>
        console.log('tes')

            getInfoProfile($('#status').find(':selected').attr('data-getinfo'), '<?= $getMessage['message']??'' ?>', '<?= $getMessage['ls_date']??'' ?>', '<?= $getMessage['ls_time']??'' ?>');
    <?php endif; ?>
    <?php if (session('alterError')) : ?>
        $('#alternatecontact').modal('show')
    <?php endif; ?>
    <?php if (session('transferError')) : ?>
        $('#transferlead').modal('show')
    <?php endif; ?>
</script>