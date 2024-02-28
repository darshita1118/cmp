<div class="col-md-6 mb-3">
    <label class="form-label" for="message">Message
    </label>
    <input type="message" class="form-control form-control-lg form-control-solid" name="message" id="message" placeholder="Enter Your Message Here" value="<?= $message ?? '' ?>" required data-validation-required-message="This Message field is required">
    <div class="help-block">
    </div>
</div>
<?php if ($type == 2) : ?>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="message">Date & Time </label>
        <div class="row">
            <div class="col-md-6">
                <input type="date" class="form-control form-control-lg form-control-solid" name="date" id="date" value="<?= $date ?? '' ?>" required>
                <div class="help-block"></div>
            </div>
            <div class="col-md-6">
                <input type="time" class="form-control form-control-lg form-control-solid" name="time" id="time" value="<?php if ($time) : $da = date("H:i", strtotime($time ?? ''));
                                                                                                                        endif;
                                                                                                                        echo $da ?? ''; ?>" required>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
<?php endif; ?>