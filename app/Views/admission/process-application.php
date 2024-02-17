<!-- Include jQuery -->
<script src="<?= base_url('assets/js/jquery-3.6.4.min.js') ?>"></script>
<!-- date -->
<link href=" <?= base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') ?>" rel="stylesheet" />
<script src=" <?= base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') ?>"></script>
<!-- drop down -->
<link href="<?= base_url('assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<style>
    .form-step {
        /* pointer-events: none;
        opacity: 0.5; */
        display: none;
    }

    .form-step.active {
        display: block;
    }

    button {
        margin-top: 10px;
    }
</style>

<div class="row ">
    <div class="col-md-2">
        <nav class="navbar navbar-sticky d-none d-xl-block  py-4 h-100 text-end">
            <nav class="nav">
                <?php $count = 1;
                foreach ($formSteps as $step) : ?>

                    <?php if ($availablePosition >= $step['position']) : ?>
                        <?php if (in_array($step['position'], [1, 2, 3]) !== false) : ?>
                            <?php if ($step['position'] == $currentPosition) : ?>
                                <a class="nav-link form-step-menu active" href="<?= base_url($route . $lid . '/' . $sid . '/' . $step['slug']) ?>"><?= $count++; ?> . <?= $step['fs_name'] ?></a>
                            <?php else : ?>
                                <a class="nav-link form-step-menu" href="javascript:showFire('info', 'This Form Step has been lock.')"><?= $count++; ?> .<?= $step['fs_name'] ?></a>

                            <?php endif; ?>
                        <?php else : ?>
                            <a class="nav-link form-step-menu <?= $step['position'] == $currentPosition ? 'active' : '' ?>" href="<?= base_url($route . $lid . '/' . $sid . '/' . $step['slug']) ?>"><?= $count++; ?> . <?= $step['fs_name'] ?></a>
                        <?php endif; ?>
                    <?php else : ?>
                        <a class="nav-link form-step-menu" href="javascript:showFire('error', 'This Form Step not available')"><?= $count++; ?> . <?= $step['fs_name'] ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>
        </nav>
    </div>
    <div class="col-xl-9 py-4">
        <!--begin::Wizard Form-->
        <?= $this->include($formView); ?>
        <!--end::Wizard Form-->
    </div>
</div>
<script src="<?= base_url('assets/js/iconify.min.js') ?>" type="text/javascript"></script>
<script>
    $("#datepicker-timeSedual").datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $("#datepicker-dob").datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $(".default-select2").select2();
</script>