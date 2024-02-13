<?php if($option == 'group'): ?>
    Comming Soon
<?php elseif($option == 'team'): ?>
    <?php if($teamLeaders):  ?>
        <div class="row mx-0">
            <div class="col-lg-5 col-xl-5">
                <div class="form-group">
                    <label for="handler">Team Leader</label>
                    <select name="handler" id="handler" class="form-control" required>
                        <option value="">-- Select Team Leader --</option>
                        <?php foreach($teamLeaders as $handler): ?>
                        
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
    <?php  else: ?>
        Their are no Team Leader
    <?php endif; ?>
<?php elseif($option == 'specific-persons'): ?>
    <?php if($handlers): ?>
        <div class="row mx-0">
            <div class="col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="handler">Handlers</label>
                    <select name="handler[]" id="handler" class="form-control selectpicker" multiple required>
                        <?php foreach($handlers as $handler): ?>
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
    <?php  else: ?>
        Their are no Handlers
    <?php endif; ?>
<?php else: ?>
    Please Select a valid Roastr By
<?php endif; ?>
