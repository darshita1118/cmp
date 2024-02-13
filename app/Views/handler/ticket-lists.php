<div class="flex-row-fluid d-flex flex-column ml-lg-8">
    <div class="d-flex flex-column flex-grow-1">
        <div class="row">
        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom card-stretch" id="kt_todo_list">
                <!--begin::Header-->
                <div class="card-header align-items-center flex-wrap py-6 border-0 h-auto">
                    <!--begin::Toolbar-->
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="d-flex align-items-center mr-1 my-2">
                            <label data-inbox="group-select" class="checkbox checkbox-inline checkbox-primary mr-3">
                                <input type="checkbox" />
                                <span class="symbol-label"></span>
                            </label>
                            <div class="btn-group">
                                <span class="btn btn-clean btn-icon btn-sm mr-1" data-toggle="dropdown" role="button">
                                    <i class="ki ki-bold-arrow-down icon-sm"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-left p-0 m-0 dropdown-menu-sm">
                                    <ul class="navi py-3">
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">All</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">Read</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">Unread</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">Starred</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">Unstarred</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <span class="btn btn-clean btn-icon btn-sm mr-2" data-toggle="tooltip" title="Reload list">
                                <i class="ki ki-refresh icon-1x"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-center mr-1 my-2">
                            <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Archive">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
                                            <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Spam">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Warning-1-circle.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                            <rect fill="#000000" x="11" y="7" width="2" height="8" rx="1" />
                                            <rect fill="#000000" x="11" y="16" width="2" height="2" rx="1" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Move">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Files/Media-folder.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3" />
                                            <path d="M10.782158,17.5100514 L15.1856088,14.5000448 C15.4135806,14.3442132 15.4720618,14.0330791 15.3162302,13.8051073 C15.2814587,13.7542388 15.2375842,13.7102355 15.1868178,13.6753149 L10.783367,10.6463273 C10.5558531,10.489828 10.2445489,10.5473967 10.0880496,10.7749107 C10.0307022,10.8582806 10,10.9570884 10,11.0582777 L10,17.097272 C10,17.3734143 10.2238576,17.597272 10.5,17.597272 C10.6006894,17.597272 10.699033,17.566872 10.782158,17.5100514 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </div>
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center my-2">
                        <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                            <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
                                <i class="flaticon2-console icon-1x"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                <ul class="navi py-3">
                                    <li class="navi-item">
                                        <a href="#" class="navi-link active">
                                            <span class="navi-text">Newest</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">Olders</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">Unread</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <span class="btn btn-light-success btn-sm text-uppercase font-weight-bolder" data-toggle="tooltip" title="Previose page">New Task</span>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0">
                    <!--begin::Responsive container-->
                    <div class="table-responsive">
                        <!--begin::Items-->
                        <div class="list list-hover min-w-500px" data-inbox="list">
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <a href="<?= base_url('lms/tickets?step=ticket-view')?>" class="flex-grow-1 mt-1 mr-2">
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Digital PPV Customer Confirmation</div>
                                    <!--end::Title-->
                                    <!--begin::Labels-->
                                    <div class="mt-2">
                                        <span class="label label-light-primary font-weight-bold label-inline">inbox</span>
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                </a>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bolder" data-toggle="view">8:30 PM</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <span class="symbol symbol-30 ml-3">
                                        <span class="symbol-label" style="background-image: url('assets/media/users/100_13.jpg')"></span>
                                    </span>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Your iBuy.com grocery shopping confirmation</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bolder" data-toggle="view">day ago</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <div class="symbol symbol-light-danger symbol-30 ml-3">
                                        <span class="symbol-label font-weight-bolder">OJ</span>
                                    </div>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Your Order #224820998666029 has been Confirmed</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bold text-muted" data-toggle="view">11:20PM</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <div class="symbol symbol-light-primary symbol-30 ml-3">
                                        <span class="symbol-label font-weight-bolder">EF</span>
                                    </div>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Payment Notification DLOP2329KD</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bolder" data-toggle="view">2 days ago</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <span class="symbol symbol-30 ml-3">
                                        <span class="symbol-label" style="background-image: url('assets/media/users/100_2.jpg')"></span>
                                    </span>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Congratulations on your iRun Coach subscription</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bold text-muted" data-toggle="view">Jul 25</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <div class="symbol symbol-light-success symbol-30 ml-3">
                                        <span class="symbol-label font-weight-bolder">MP</span>
                                    </div>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Pay bills &amp; win up to 600$ Cashback!</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bold text-muted" data-toggle="view">July 24</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <span class="symbol symbol-30 ml-3">
                                        <span class="symbol-label" style="background-image: url('assets/media/users/100_4.jpg')"></span>
                                    </span>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Activate your LIPO Account today</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bolder" data-toggle="view">Jun 13</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <span class="symbol symbol-30 ml-3">
                                        <span class="symbol-label" style="background-image: url('assets/media/users/100_12.jpg')"></span>
                                    </span>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">About your request for PalmLake</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bold text-muted" data-toggle="view">25 May</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <div class="symbol symbol-light symbol-30 ml-3">
                                        <span class="symbol-label font-weight-bolder">WE</span>
                                    </div>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Verification of your card transaction</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bold text-muted" data-toggle="view">May 23</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <span class="symbol symbol-30 ml-3">
                                        <span class="symbol-label" style="background-image: url('assets/media/users/100_6.jpg')"></span>
                                    </span>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Payment Notification (DE223232034)</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bold text-muted" data-toggle="view">Apr 12</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <span class="symbol symbol-30 ml-3">
                                        <span class="symbol-label" style="background-image: url('assets/media/users/100_8.jpg')"></span>
                                    </span>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Welcome, Patty</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bold text-muted" data-toggle="view">Mar 1</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <span class="symbol symbol-30 ml-3">
                                        <span class="symbol-label" style="background-image: url('assets/media/users/100_9.jpg')"></span>
                                    </span>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Buttons-->
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                            <i class="flaticon-star text-muted"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                            <i class="flaticon-add-label-button text-muted"></i>
                                        </a>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                    <!--begin::Title-->
                                    <div class="font-weight-bolder mr-2">Optimize with Recommendations, now used by most</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Details-->
                                <div class="d-flex align-items-center justify-content-end flex-wrap" data-toggle="view">
                                    <!--begin::Datetime-->
                                    <div class="font-weight-bold text-muted" data-toggle="view">Feb 11</div>
                                    <!--end::Datetime-->
                                    <!--begin::User Photo-->
                                    <div class="symbol symbol-light-warning symbol-30 ml-3">
                                        <span class="symbol-label font-weight-bolder">RW</span>
                                    </div>
                                    <!--end::User Photo-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Responsive container-->
                    <!--begin::Pagination-->
                    <div class="d-flex align-items-center my-2 my-6 card-spacer-x justify-content-end">
                        <div class="d-flex align-items-center mr-2" data-toggle="tooltip" title="Records per page">
                            <span class="text-muted font-weight-bold mr-2" data-toggle="dropdown">1 - 50 of 235</span>
                            <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                <ul class="navi py-3">
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">20 per page</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link active">
                                            <span class="navi-text">50 par page</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">100 per page</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Previose page">
                            <i class="ki ki-bold-arrow-back icon-sm"></i>
                        </span>
                        <span class="btn btn-default btn-icon btn-sm" data-toggle="tooltip" title="Next page">
                            <i class="ki ki-bold-arrow-next icon-sm"></i>
                        </span>
                    </div>
                    <!--end::Pagination-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        </div>
    </div>
</div>