<div class="row">
<?php if($type == 1): ?>
   
        <div class="form-group col-lg-12" >
            <label for="state">State:</label>
            <select id="state" name="state" class="form-control form-control-lg form-control-solid" onchange="getDistrictList($(this).find(':selected').attr('data-index')
                                );" required>
                <option value="">--select state--</option>
            </select>

        </div>
        <div class="form-group col-lg-12" >
            <label for="district">District:</label>
            <select id="district" name="district" class="form-control form-control-lg form-control-solid" required>
                <option value="">--select district--</option>
            </select>

        </div>
        
    
    
<?php else: ?>
    
    <div class="form-group col-lg-12" >
        <label for="district">District/City:</label>
        <input type="text" name="district" class="form-control form-control-lg form-control-solid" placeholder="Enter District/City name" value="<?= $dist ?>" required >

    </div>
    
<?php endif; ?>

</div>



