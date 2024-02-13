<?php
use App\Models\ApplicationModel;

$studentInfoModel = new ApplicationModel('student_info_' . session('year'), 'si_id', 'sso_' . session('suffix'));
$studentInfo = $studentInfoModel->where(['sid' => $sid])->first() ?? [];

$courseModel = new ApplicationModel('session_courses_'. session('year'), 'sc_id', 'sso_' . session('suffix'));
$courseInfo = $courseModel->select(['validation_level'])->join('course_info', 'session_courses_'. session('year').'.course_id=course_info.coi_id')->where('sc_id', $studentInfo['program_id']??'')->first();
	

$elModel = new ApplicationModel('document_type', 'dt_id', 'sso_' . session('suffix'));
$require = $elModel->select(['dt_id', 'dt_name'])->whereIn('dt_equivalent', json_decode($courseInfo['validation_level'] ?? ''))->orWhereIn('dt_id',[1,2])->where('dt_status', 0)->orderBy('dt_id', 'ASC')->findAll()??[];

$academicModel = new ApplicationModel('student_document_' . session('year'), 'sd_id', 'sso_' . session('suffix'));
$student_docs = $academicModel->select(['document_type','sd_url','dt_name','sd_id'])->join('document_type','document_type.dt_id=student_document_' . session('year').'.document_type')->where('sd_url!=','')->where('sid', $sid)->orderBy('document_type', 'ASC')->findAll() ?? [];

$levels = $elModel->select(['dt_id','dt_name'])->where('dt_status', 0)->orderBy('dt_id','ASC')->findAll();
    
$url = '//sso.gyanvihar.org/';
$previousPositionKey  = array_search($currentPosition-1, array_column($formSteps, 'position'));
$previous = $formSteps[$previousPositionKey??'']['slug'] ?? '';
?>
<div class="text-white text-center d-block d-lg-none py-2 bg-primary">
    <h4 class="mb-0 font-weight-normal">Documents Upload</h4>
</div>
<div class="px-4 py-2">
    <!--begin::Wizard Step 1-->
    <div class="pb-5" >
        <form class="form" id="kt_forms" action="<?= base_url($actionUrlDoc.$lid.'/'.$sid) ?>" method="post" enctype="multipart/form-data">
            <div class="row mb-3 ">
                <?= csrf_field() ?>
                <div class="col-xl-5">
                    <!--begin::Select-->
                    <div class="form-group">
                        <label for="document_type">Choose upload </label>
                        <select name="document_type" id="document_type" onChange="typeChange(this.value);" class="form-control form-control-solid form-control-lg">
                            <option value="">Select Document type</option>
                            <?php foreach ($levels as $lev) : ?>
                                <?php if (!in_array($lev['dt_id'], array_column($student_docs, 'document_type')) !== false) : ?>
                                    <option value="<?= $lev['dt_id']; ?>"><?= $lev['dt_name']; ?></option>
                            <?php endif;
                            endforeach; ?>
                        </select>
                        <span class="form-text text-danger"><?= \Config\Services::validation()->showError('document_type') ?></span>
                    </div>
                    <!--end::Select-->
                </div>
                <div class="col-xl-5">
                    <!--begin::Select-->
                    <div class="form-group">
                        <label for="document">Document <span id="typeText" class="text-danger">(Max. size Image = 500 kb)</span></label>
                        <input type="file" id="document" class="form-control form-control-solid form-control-lg" name="document" accept="image/jpeg,image/gif,image/png" />
                        <span class="form-text text-danger"><?= \Config\Services::validation()->showError('document') ?></span>

                    </div>
                    <!--end::Select-->
                </div>

                <div class="col-xl-2">
                    <!--begin::Select-->
                    <div class="">
                        <label for="submit" class="d-block">&nbsp;</label>
                        <input type="submit" id="submit" class=" btn btn-primary" name="document" value="Upload" />

                    </div>
                    <!--end::Select-->
                </div>

            </div>
        </form>
        <div class="mb-3" style="border-bottom: 1px solid #ebedf3;">
            <h5>Uploaded Documents</h5>
        </div>
        <div class="row mb-3">

            <?php foreach ($student_docs as $student) : ?>
                <div class="col-lg-3 my-3">
                    <h6 class="mb-2 text-center" style="border-bottom: 1px solid #ebedf3;"><?= $student['dt_name'] ?></h6>
                    <div class="card">
                        <?php if (pathinfo($student['sd_url'], PATHINFO_EXTENSION) == 'pdf') : ?>
                            <a href="<?= base_url($student['sd_url']) ?>" target="_blank">
                                <iframe class="card-img" src="https://docs.google.com/gview?url=https:<?= $url.substr($student['sd_url'],'1') ?>&embedded=true"></iframe>

                            </a>
                        <?php else : ?>
                            <img class="card-img" src="<?= $url.substr($student['sd_url'],'1') ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="text-center my-3" style="position: absolute;top: 5px;right: 5px;width: 25px;background: #fff;height: 25px;padding: 5px 5px;border-radius: 50%;box-shadow: 4px 4px 5px 0px #dddcdc, -4px -4px 5px 0px #dddcdc, 4px -4px 5px 0px #dddcdc, -4px 4px 5px 0px #dddcdc;">
                        <a href="<?= base_url($actionUrlDoc.$lid.'/'.$sid) ?><?='?delete=' . $student['sd_id'] ?>" style="color:red; font-size: 1rem; font-weight: 500;"><i style="color:red; font-size: 1.3rem;" class="fa fa-trash"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div>
            <h6>You have to upload following mandatory documents to complete the application process</h6>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <ol type="1">
                    <?php foreach ($require as $lev) :
                        if (in_array($lev['dt_id'], array_column($student_docs, 'document_type')) !== false) : ?>
                            <li><del class="text-success"><?= $lev['dt_name']; ?> </del><span data-toggle="tooltip" data-theme="dark" data-html="true" title="<p><?= $lev['dt_name']; ?></p>"><i class="fa fa-question-circle text-success"></i></span><span><i class="fa fa-check-circle text-success" data-html="true" data-toggle="tooltip" data-theme="dark" title="Uploaded"></i></span></li>
                        <?php else : ?>
                            <li><span class="text-danger"><?= $lev['dt_name']; ?></span><span data-toggle="tooltip" data-theme="dark" data-html="true" title="<p><?= $lev['dt_name']; ?></p>"><i class="fa fa-question-circle text-danger"></i></span><span><i class="fa fa-times-circle text-danger" data-html="true" data-toggle="tooltip" data-theme="dark" title="Not Uploaded"></i></span></li>

                    <?php endif;
                    endforeach; ?>
                </ol>
            </div>
        </div>

    </div>
    <!--end::Wizard Step 1-->

    <form class="form" action="<?= base_url($actionUrl.$lid.'/'.$sid) ?>" method="post">
        <?= csrf_field() ?>
        <!--begin::Wizard Actions-->
        <div class="d-flex justify-content-between border-top mt-5 pt-5">
            <div class="mr-2">
                <a href="<?= base_url($route . $lid . '/' . $sid . '/'.$previous) ?>" class="btn btn-light-primary font-weight-bolder text-uppercase">Previous</a>
            </div>
            <div>
                <?php
                    $stuDocs = (array_column($student_docs??[], 'document_type'))??[];
                    $reqDocs = (array_column($require, 'dt_id'));
                    $ch = true;
                    if(empty($stuDocs) || empty($reqDocs) ){
                        $ch = false;
                        sort($stuDocs);
                        sort($reqDocs);
                    }
                    
                ?>
                <?php foreach ($require as $lev) :
                        if (!in_array($lev['dt_id'], array_column($student_docs, 'document_type')) !== false) : ?>
                            <input type="hidden" name="require[]" value="<?= $lev['dt_name']; ?>">
                    <?php endif;
                endforeach; ?>                                   
                <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase" name="btn" value="document-upload">Save & Next</button>
            </div>
        </div>
        <!--end::Wizard Actions-->
    </form>
</div>
<script>
	function typeChange(id){
		if(id==6){
			$("#typeText").text("(Max. size Image = 500 kb and PDF = 2MB)");
			$("#document").attr("accept","image/jpeg,image/gif,image/png,,application/pdf");
		}else{
			$("#typeText").text("(Max. size Image = 500 kb)");
			$("#document").attr("accept","image/jpeg,image/gif,image/png");
		}
	}
</script>