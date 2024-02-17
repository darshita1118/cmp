<style>
    @media (min-width: 600px) {
        .timeline .timeline-content::before {
            border-right-color: #dfdede;
        }

        .timeline .timeline-content {
            background: #dfdede;
        }
    }

    @media (max-width: 575.98px) {
        .timeline .timeline-content::before {
            border-bottom-color: #dfdede;
        }

        .timeline .timeline-content {
            background: #dfdede;
        }
    }
</style>
<div class="card p-3">
    <div class="row">
        <h4><?= $title ?></h4>
        <!--Stats -->
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #f64e60;">
                <div class="card-body px-3">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex flex-column">
                            <span class="fw-bolder fs-20px"> <?= array_sum(array_column($statusWise, 'total_leads')); ?></span>
                            <span class="fw-bold text-muted mt-2">Leads
                            </span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:sticker-smile-circle-2-bold-duotone"></span>
                    </div>
                </div>
            </div>
            <!--End -->
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #3699ff;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-muted mt-2"> Not Given
                            </span>
                            <span class="fw-bolder fs-20px">528</span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:refresh-circle-bold-duotone"></span>
                    </div>
                </div>
            </div>
            <!--Stats -->
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #32ccc4;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-muted mt-2"> Marketing Qualifying
                            </span>
                            <span class="fw-bolder fs-20px"> 191 </span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:refresh-circle-bold-duotone"></span>
                    </div>

                </div>

            </div>
            <!--Stats -->
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #3699ff;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-muted mt-2"> Sales Qualifying
                            </span>
                            <span class="fw-bolder fs-20px"> 19 </span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:refresh-circle-bold-duotone"></span>
                    </div>

                </div>

            </div>
            <!--Stats -->
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #32ccc4;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-muted mt-2"> SID Generated
                            </span>
                            <span class="fw-bolder fs-20px"> 3 </span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:refresh-circle-bold-duotone"></span>
                    </div>

                </div>

            </div>
            <!--Stats -->
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #ffa800;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-muted mt-2"> Sales Qualifying
                            </span>
                            <span class="fw-bolder fs-20px"> 19 </span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:refresh-circle-bold-duotone"></span>
                    </div>

                </div>

            </div>
            <!--Stats -->
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #3699ff;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-muted mt-2"> Admission Done
                            </span>
                            <span class="fw-bolder fs-20px"> 1</span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:refresh-circle-bold-duotone"></span>
                    </div>

                </div>

            </div>
            <!--Stats -->
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #ffa800;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-muted mt-2"> Fall Out
                            </span>
                            <span class="fw-bolder fs-20px"> 352 </span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:refresh-circle-bold-duotone"></span>
                    </div>

                </div>

            </div>
            <!--Stats -->
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card " style="border: 1px solid #f64e60;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-muted mt-2"> Call Back Not Answer
                            </span>
                            <span class="fw-bolder fs-20px"> 52 </span>
                        </div>
                        <span class="iconify fs-35px" data-icon="solar:refresh-circle-bold-duotone"></span>
                    </div>

                </div>

            </div>
            <!--Stats -->
        </div>

    </div>
    <div class="row">
        <div class="card-body  fw-bold">
            <div class="profile-content">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="profile-post">
                        <div class="timeline">
                            <div class="timeline-item handler-worker-report">
                                <div class="timeline-time">
                                    <span class="date">15-02-2024</span>
                                    <span class="time">04:20</span>
                                </div>
                                <div class="timeline-icon">
                                    <a href="javascript:;">&nbsp;</a>
                                </div>
                                <div class="timeline-content ">
                                    <div class="timeline-header">
                                        <div class="username">
                                            <a href="javascript:;">John Smith <i class="fa fa-check-circle text-blue ms-1"></i></a>
                                            <div class="text-muted fs-12px"><span class="date">today</span>
                                                <span class="time">04:20</span> <i class="fa fa-globe-americas opacity-5 "></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-body">
                                        <small> Enquery For: DIPLOMA</small><br>
                                        <small>lead status: Not Given</small><br>
                                        <small>Source Of Lead: : Apply Now</small><br>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-time">
                                    <span class="date">15-02-2024</span>
                                    <span class="time">04:20</span>
                                </div>
                                <div class="timeline-icon">
                                    <a href="javascript:;">&nbsp;</a>
                                </div>
                                <div class="timeline-content ">
                                    <div class="timeline-header">
                                        <div class="username">
                                            <a href="javascript:;">Darren Parrase</a>
                                            <div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
                                        </div>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="mb-2">Location: United States</div>
                                        <p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
                                            turpis quis tincidunt luctus.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-time">
                                    <span class="date">15-02-2024</span>
                                    <span class="time">04:20</span>
                                </div>
                                <div class="timeline-icon">
                                    <a href="javascript:;">&nbsp;</a>

                                </div>
                                <div class="timeline-content ">
                                    <div class="timeline-header">
                                        <div class="username">
                                            <a href="javascript:;">Darren Parrase</a>
                                            <div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
                                        </div>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="mb-2">Location: United States</div>
                                        <p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
                                            turpis quis tincidunt luctus.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-time">
                                    <span class="date">15-02-2024</span>
                                    <span class="time">04:20</span>
                                </div>
                                <div class="timeline-icon">
                                    <a href="javascript:;">&nbsp;</a>

                                </div>
                                <div class="timeline-content ">
                                    <div class="timeline-header">
                                        <div class="username">
                                            <a href="javascript:;">Darren Parrase</a>
                                            <div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
                                        </div>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="mb-2">Location: United States</div>
                                        <p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
                                            turpis quis tincidunt luctus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/iconify.min.js') ?>" type="text/javascript"></script>