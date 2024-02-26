<div class="row mx-0">
    <div class="col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="handler"><b>Handlers</b></label>
            <select name="handler" id="handler" class="form-control" required>
                <option value="">-- Select Handler --</option>
                <?php foreach ($handlers as $handler) : ?>
                    <option value="<?= $handler['lu_id'] ?>"><?= $handler['user_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-lg-1 col-xl-1">
        <div class="form-group text-center">
            <label for="">&nbsp;</label>
            <button name="btn" value="btn-submit" class="btn btn-primary" type="submit" style="padding:3px 5px">Submit</button>
        </div>
    </div>
</div>