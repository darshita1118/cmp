<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="teamLeader">Team Leader</label>
            <select class="form-control" name="teamLeader" id="teamLeader" required>
                <option value="">--Select Team Leader--</option>
                <?php foreach($teamLeaders as $tl): ?>
                    <option value="<?= $tl['lu_id'] ?>"><?= $tl['user_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group text-center">
            <label for="">&nbsp;</label>
            <button name="btn" value="handlerBulk" class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</div>