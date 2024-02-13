<div class="flex-row-fluid d-flex flex-column ml-lg-8">
    <div class="d-flex flex-column flex-grow-1">
        <div class="row">
            <div class="col-xl-12">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Header-->
                    <div class="card-header py-1">
                        <div class="card-title my-0">
                            <h3 class="card-label font-weight-bolder text-dark">Create New Ticket</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="<?= base_url('admin/tickets') ?>" class="btn btn-secondary py-1">Cancel</a>
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Form-->

                        <form name="once" class="form" id="ticketcreate" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label class="form-label" for="title">Title<span style="color:red">*</span></label>
                                <div>
                                    <select id="title" class="form-control form-control-lg form-control-solid" name="title" onchange="change(this.value);" required>
                                        <option value="">---Select---</option>
                                        <?php foreach ($titles as $title) { ?>
                                            <option value="<?= $title['t_id'] ?>" <?php if ($title['t_id'] == set_value('title'))
                                                                                    echo 'selected'; ?>>
                                                <?= $title['title'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <span class="form-text text-danger">
                                        <?= \Config\Services::validation()->showError('title'); ?>
                                    </span>
                                </div>
                            </div>
                            <div id="too" class="form-group" style="display:none">
                                <label class="form-label">To<span style="color:red">*</span></label>
                                <div>
                                    <select id="touser" name="to[]" class="form-control form-control-lg form-control-solid selectpicker" multiple>
                                        <?php foreach ($members as $member) { ?>
                                            <option value="<?= $member['lu_id'] ?>-3" <?php if (@in_array($member['lu_id'] . '-3', set_value('to'))) echo 'selected'; ?>><?= ucfirst($member['user_name']) ?> (<?= ($member['user_role'] == 0) ? 'Handler' : (($member['user_role'] == 1) ? 'Team-Leader' : 'Admin') ?>)</option>
                                        <?php } ?>
                                        <?php foreach ($desks as $desk) { ?>
                                            <option value="<?= $desk['dr_id'] ?>-2" <?php if (@in_array($desk['dr_id'] . '-2', set_value('to'))) echo 'selected'; ?>><?= ucfirst($desk['dr_name']) ?> Desk</option>
                                        <?php } ?>
                                    </select>
                                    <span class="form-text text-danger"></span>
                                    <input id="titletype" type="hidden" name="titletype" value="">
                                </div>
                            </div>
                            <div id="cc" class="form-group" style="display:none">
                                <label class="form-label">CC</label>
                                <div>
                                    <select name="cc[]" class="form-control form-control-lg form-control-solid selectpicker" multiple>
                                        <?php foreach ($members as $member) { ?>
                                            <option value="<?= $member['lu_id'] ?>-3" <?php if (@in_array($member['lu_id'] . '-3', set_value('to'))) echo 'selected'; ?>><?= ucfirst($member['user_name']) ?> (<?= ($member['user_role'] == 0) ? 'Handler' : (($member['user_role'] == 1) ? 'Team-Leader' : 'Admin') ?>)</option>
                                        <?php } ?>
                                        <?php foreach ($desks as $desk) { ?>
                                            <option value="<?= $desk['dr_id'] ?>-2" <?php if (@in_array($desk['dr_id'] . '-2', set_value('cc'))) echo 'selected'; ?>><?= ucfirst($desk['dr_name']) ?> Desk</option>
                                        <?php } ?>
                                    </select>
                                    <span class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="subject">Subject<span style="color:red">*</span></label>
                                <div>
                                    <input class="form-control form-control-lg form-control-solid" name="subject" type="text" value="<?= set_value('subject', @$leads['subject'] ?? ''); ?>" placeholder="Subject" required />
                                    <span class="form-text text-danger">
                                        <?= \Config\Services::validation()->showError('subject'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="description">Description<span style="color:red">*</span></label>
                                <div>
                                    <textarea class="form-control form-control-lg form-control-solid" rows="3" name="description" id="kt-tinymce-4" placeholder="Description"><?= set_value('description', @$leads['description'] ?? ''); ?></textarea>
                                    <span class="form-text text-danger">
                                        <?= \Config\Services::validation()->showError('description'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Attachment (Max. size 500 kb for image file and 2 mb for pdf file.)</label>
                                <div>
                                    <input class="form-control form-control-lg form-control-solid" name="attachment" type="file" value="<?= set_value('attachment', @$leads['attachment'] ?? ''); ?>" accept="application/pdf, image/*" />
                                    <span class="form-text text-danger">
                                        <?= \Config\Services::validation()->showError('attachment'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="create-ticket" value="Submit" class="btn btn-success mr-2 py-1">Submit</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
</div>
<script>
    function change(id) {
        if (id != null) {
            $.ajax({
                url: "<?= base_url() ?>/helper/check_ticket_to",
                method: "POST",
                data: {
                    id: id,
                },
                success: function(dataa) {
                    if (dataa == '') {
                        $('#too').show();
                        $('#cc').show();
                        $('#touser').attr('required',true);
                        $('#titletype').val('yes');
                    }else{
                        $('#too').hide();
                        $('#cc').hide();
                        $('#touser').attr('required',false);
                        $('#titletype').val('no');
                    }
                }
            });
        }
    }
    <?=(set_value('title')!=null)?'change('.set_value('title').');':null?>
</script>