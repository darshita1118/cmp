
    <div class="form-group">
        <label class="col-form-label px-0" for="message">Message
            </label>
        <div class="col-lg-12 col-xl-12 px-0">
            <input type="message" class="form-control form-control-lg form-control-solid" name="message" id="message" placeholder="Enter Your Message Here" value="<?= $message ?? '' ?>" required data-validation-required-message="This Message field is required">
            <div class="help-block"></div>
        </div>
    </div>
    <?php if ($type == 2) : ?>
        <div class="form-group">
            <label class="col-form-label px-0" for="message">Date & Time </label>
            <div class="col-lg-12 col-xl-12">
                <div class="row">
                    <div class="col-lg-6 col-xl-6 form-group">
                        <input type="date" class="form-control form-control-lg form-control-solid"  name="date" id="date"  value="<?= $date ?? '' ?>" required >
                        <div class="help-block"></div>
                    </div>
                    <div class="col-lg-6 col-xl-6 form-group">
                        
                        <input type="time" class="form-control form-control-lg form-control-solid" name="time"  id="time" value="<?php if($time):$da = date("H:i", strtotime($time ?? '')); endif; echo $da??''; ?>" required >
                        <div class="help-block"></div>
                    </div>
                </div>
                
            </div>
        </div>

    <?php endif; ?>
