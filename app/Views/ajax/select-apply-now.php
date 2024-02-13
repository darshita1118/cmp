<?php
use App\Models\ApplicationModel;
use CodeIgniter\Database\BaseBuilder;
?>
<?php if($nature == 1): 
    function getStreamGroup($courseId, $session, $year)
    {
        $model = new ApplicationModel('stream_groups', 'sg_id', $session);
        return $model->select(['sg_name', 'sg_id'])->whereIn('sg_id', function(BaseBuilder $builder)use($courseId, $year){
            return $builder->select('group_id')->from('course_allocated_groups_'.$year)->where(['ses_course_id'=>$courseId]);
        })->where(['sg_status'=>1])->findAll()??[];
    }
    $groups = getStreamGroup($courseId, $session, $year);
?>
<label for="course_type">Select Course Group</label>
<select name="course_type" id="course_type" class="form-control form-control-solid form-control-lg"  required>
	<option value="">Select Course Group</option>
    <?php foreach($groups as $row): ?>
        <option value="<?= $row['sg_id'] ?>" <?= $row['sg_id'] == $default? 'selected' :null ?> ><?= $row['sg_name'] ?></option>
    <?php endforeach; ?>
</select>
<?php elseif($nature == 2): 
    function getStreams($courseId, $session, $year)
    {
        $model = new ApplicationModel('course_streams', 'cs_id', $session);
        return $model->select(['cs_name', 'cs_id'])->whereIn('cs_id', function(BaseBuilder $builder)use($courseId, $year){
            return $builder->select('stream_id')->from('course_allocated_streams_'.$year)->where(['ses_course_id'=>$courseId]);
        })->where(['cs_status'=>1, 'cs_deleted_at'=>0])->findAll()??[];
    }
    $groups = getStreams($courseId, $session, $year);
    $default = json_decode($default??'[]', true)??[];
?>
<label for="course_type">Select Course Streams </label>
<select name="course_type[]" id="course_type" data-max-options="3" title="Choose any three of the following" data-header="Select three options" class="form-control form-control-solid form-control-lg selectpicker" multiple  required>
    <?php foreach($groups as $row): ?>
        <option value="<?= $row['cs_id'] ?>" <?= (in_array($row['cs_id'], $default)!==false)?'selected':null ?> ><?= $row['cs_name'] ?></option>
    <?php endforeach; ?>
</select>
<script>
    // Class definition
    var KTBootstrapSelect = function () {
        // Private functions
        var demos = function () {
            // minimum setup
            $('.selectpicker').selectpicker();
        }
        return {
            // public functions
            init: function() {
                demos(); 
            }
        };
    }();
    jQuery(document).ready(function() {
        KTBootstrapSelect.init();
    });
</script> 
<?php elseif($nature == 3): 
    function getSpecialization($courseId, $session, $year)
    {
        $model = new ApplicationModel('specializations', 'sz_id', $session);
        return $model->select(['sz_name', 'sz_id'])->whereIn('sz_id', function(BaseBuilder $builder)use($courseId, $year){
            return $builder->select('spz_id')->from('course_allocated_specialization_'.$year)->where(['ses_course_id'=>$courseId]);
        })->where(['sz_status'=>1])->findAll()??[];
    }
    $groups = getSpecialization($courseId, $session, $year);
?>
<label for="course_type">Select Course Specialization/Honour's</label>
<select name="course_type" id="course_type" class="form-control form-control-solid form-control-lg"  required>
	<option value="">Select Specialization/Honour's</option>
    <?php foreach($groups as $row): ?>
        <option value="<?= $row['sz_id'] ?>" <?= $row['sz_id'] == $default? 'selected' :null ?>><?= $row['sz_name'] ?></option>
    <?php endforeach; ?>
</select>
<?php else: ?>
    Something Went Wrong;
<?php endif; ?>