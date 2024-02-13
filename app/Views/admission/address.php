<?php

use App\Models\ApplicationModel;

$contactModel = new ApplicationModel('student_contact_info_' . session('year'), 'sci_id', 'sso_' . session('suffix'));
$studentContact = $contactModel->where(['sid' => $sid])->first() ?? [];


function getAddress($sid, $type)
{
    $studentAdderssModel = new ApplicationModel('student_address_' . session('year'), 'sa_id', 'sso_' . session('suffix'));
    return $studentAdderssModel->join('addresses_' . session('year'), 'addresses_' . session('year') . '.a_id=student_address_' . session('year') . '.address_id')->where(['sid' => $sid, 'address_type' => $type])->first() ?? [];
}

$countryName = 'India';
if (!(int)($studentContact['sci_country_code'] ?? 0) == '91') {
    $getCountry = json_decode(file_get_contents('./assets/json/country.json'), true) ?? [];
    if (($key = array_search($studentContact['sci_country_code'] ?? 0, array_column($getCountry, 'code'))) !== false) {
        $key = (int)$key;
        $countryName = $getCountry[$key]['name'];
    }
}

$permanentAddress = getAddress($sid, 0);
$currentAddress = getAddress($sid, 1);
$index = array_search($subStep,$validSubSlug);

//dd($permanentAddress, $currentAddress);
?>
<!--begin::Form-->
<form class="px-1" method="post" action="<?= base_url($actionUrl . $lid . '/' . $sid) ?>">
    <!--begin: Wizard Step 3-->
    <div class="pb-5" >
        <!--begin::Input-->
        <?= csrf_field() ?>
        <h5>Permanent Address</h5>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Your Nationality.</p>">Country <i class="fa fa-question-circle"></i></label>
                    <input type="text" class="form-control form-control-solid form-control-lg" name="country" value="<?= old('country') ?? ($permanentAddress['country'] ?? $countryName) ?>" placeholder="Country" readonly required />
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('country'); ?></span>
                </div>
            </div>
            <div class="col-lg-4">
                <!--begin::Select-->
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Select the name of the State corresponding to your address.</p>">State <i class="fa fa-question-circle"></i></label>
                    <?php if ($countryName == 'India') { ?>
                        <select id="state" onchange="statelists('state', 'district', this.value)" name="state" class="form-control form-control-solid form-control-lg" required>
                            <option value="">Select</option>
                        </select>
                    <?php } else { ?>
                        <input id="state" name="state" value="<?= old('state') ?? ($permanentAddress['state'] ?? '') ?>" placeholder="State Name" class="form-control form-control-solid form-control-lg" required>
                    <?php } ?>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('state'); ?></span>

                </div>
                <!--end::Select-->
            </div>
            <div class="col-lg-4">
                <!--begin::Select-->
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Select the name of the District to which you belong to.</p>">District <i class="fa fa-question-circle"></i></label>
                    <?php if ($countryName == 'India') { ?>
                        <select id="district" name="district" class="form-control form-control-solid form-control-lg" required>
                            <option value="">Select</option>
                        </select>
                    <?php } else { ?>
                        <input id="district" name="district" value="<?= old('district') ?? ($permanentAddress['district'] ?? '') ?>" placeholder="District/City Name" class="form-control form-control-solid form-control-lg" required>
                    <?php } ?>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('district'); ?></span>

                </div>
                <!--end::Select-->
            </div>
            <div class="col-lg-8">
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Here you are required to mention your House or Flat No, Name of the Society, Street Name/Village Name</p>">Address
                        Line 1 <i class="fa fa-question-circle"></i></label>
                    <input type="text" class="form-control form-control-solid form-control-lg" name="street_address" value="<?= old('street_address') ?? ($permanentAddress['street_address'] ?? '') ?>" placeholder="House or Flat No, Street Name/Village Name" required />
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('street_address'); ?></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Mention the exact pincode to your area of residence.</p>">Pincode <i class="fa fa-question-circle"></i></label>
                    <input type="text" class="form-control form-control-solid form-control-lg" name="zipcode" value="<?= old('zipcode') ?? ($permanentAddress['zipcode'] ?? '') ?>" placeholder="Pincode" required />
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('zipcode'); ?></span>

                </div>
            </div>
            <input type="hidden" name="permanent" value="<?= $permanentAddress['address_id'] ?? '' ?>">
        </div>
        <h5> Current Address</h5>
        <input type="checkbox" class="currentaddress" value='1' name="same" id="currentaddress" <?php if (old('same') == '1') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    if ($currentAddress) echo "";
                                                                                                    else echo "checked";
                                                                                                } ?> onclick="valueChanged()" /> <label for="currentaddress">Same as permanent address</label>
        <div id="sameas" style="display: <?php if (old('same') == '1') {
                                                echo "block";
                                            } else {
                                                if ($currentAddress) echo "block";
                                                else echo "none";
                                            } ?>">
            <div class="row">

                <div class="col-lg-4">
                    <div class="form-group">
                        <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Your Nationality.</p>">Country <i class="fa fa-question-circle"></i></label>
                        <input type="text" class="form-control form-control-solid form-control-lg" name="country1" value="<?= old('country1') ?? ($currentAddress['country'] ?? $countryName) ?>" placeholder="Country" readonly />
                        <span class="form-text text-danger"><?= \Config\Services::validation()->showError('country1'); ?></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!--begin::Select-->
                    <div class="form-group">
                        <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Select the name of the State corresponding to your address.</p>">State <i class="fa fa-question-circle"></i></label>
                        <?php if ($countryName == 'India') { ?>
                            <select id="state1" name="state1" onchange="statelists('state1', 'district1', this.value)" class="form-control form-control-solid form-control-lg">
                                <option value="">Select</option>
                            </select>
                        <?php } else { ?>
                            <input id="state1" name="state1" value="<?= old('state1') ?? ($currentAddress['state'] ?? '') ?>" placeholder="State Name" class="form-control form-control-solid form-control-lg">
                        <?php } ?>
                        <span class="form-text text-danger"><?= \Config\Services::validation()->showError('state1'); ?></span>

                    </div>
                    <!--end::Select-->
                </div>
                <div class="col-lg-4">
                    <!--begin::Select-->
                    <div class="form-group">
                        <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Select the name of the District to which you belong to.</p>">District <i class="fa fa-question-circle"></i></label>
                        <?php if ($countryName == 'India') { ?>
                            <select id="district1" name="district1" class="form-control form-control-solid form-control-lg">
                                <option value="">Select</option>
                            </select>
                        <?php } else { ?>
                            <input id="district1" name="district1" value="<?= old('district1') ?? ($currentAddress['district'] ?? '') ?>" placeholder="District/City Name" class="form-control form-control-solid form-control-lg">
                        <?php } ?>
                        <span class="form-text text-danger"><?= \Config\Services::validation()->showError('district1'); ?></span>
                    </div>
                    <!--end::Select-->
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Here you are required to mention your House or Flat No, Name of the Society, Street Name/Village Name</p>">Address
                            Line 1 <i class="fa fa-question-circle"></i></label>
                        <input type="text" class="form-control form-control-solid form-control-lg" name="street_address1" value="<?= old('street_address1') ?? ($currentAddress['street_address'] ?? '') ?>" placeholder="House or Flat No, Street Name/Village Name" />
                        <span class="form-text text-danger"><?= \Config\Services::validation()->showError('street_address1'); ?></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Mention the exact pincode to your area of residence.</p>">Pincode <i class="fa fa-question-circle"></i></label>
                        <input type="text" class="form-control form-control-solid form-control-lg" name="zipcode1" value="<?= old('zipcode1') ?? ($currentAddress['zipcode'] ?? '') ?>" placeholder="Pincode" />
                        <span class="form-text text-danger"><?= \Config\Services::validation()->showError('zipcode1'); ?></span>
                    </div>
                </div>
                <input type="hidden" name="current" value="<?= $currentAddress['address_id'] ?? '' ?>">
            </div>
        </div>
    </div>
    <!--end: Wizard Step 3-->
    <!--begin: Wizard Actions-->
    <div class="d-flex justify-content-between pt-3">
        <div class="mr-2">
            <a href="<?= base_url($route . $lid . '/' . $sid .'/'.$slug.'/'.$validSubSlug[$index-1]) ?>" class="btn btn-light-primary font-weight-bolder text-uppercase">
                Previous</a>
        </div>
        <div>
            <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase" name="btn" value="address-detail">Save & Next</button>
        </div>
    </div>
    <!--end: Wizard Actions-->
</form>
<!--end::Form-->
<script>
    const HOSTURL = '<?= base_url() ?>'

    function statelists(stateId, districtId, statename = '', districtname = '') {
        var state = document.getElementById(stateId);

        var district = $('#' + districtId);

        $.ajax({
            url: HOSTURL + '/assets/json/india.json',
            type: 'post',
            dataType: 'json',
            async: false,
            success: function(data) {
                statelist = data;
                for (var val in data) {
                    if (data[val].state === statename) {
                        $("<option />", {
                            value: data[val].state,
                            text: data[val].state,
                            selected: 'selected'
                        }).appendTo(state);
                        getDistrictList(state, district, districtname);
                    } else {
                        $("<option />", {
                            value: data[val].state,
                            text: data[val].state
                        }).appendTo(state);
                    }

                }
            }
        });
    }

    function getDistrictList(state, district, districtname) {
        district.find('option').not(':first').remove();
        var state_selected = state.options[state.selectedIndex].text;
        var result = statelist.find(({
            state
        }) => state === state_selected);
        var districtlist = statelist[statelist.indexOf(result)].districts;
        for (val in districtlist) {
            if (districtlist[val] === districtname) {
                $("<option />", {
                    value: districtlist[val],
                    text: districtlist[val],
                    selected: 'selected'
                }).appendTo(district);
            } else {
                $("<option />", {
                    value: districtlist[val],
                    text: districtlist[val]
                }).appendTo(district);
            }

        }
    }

    function valueChanged() {
        if ($('#currentaddress').is(":checked")) {
            $("#sameas").hide();
            $('#country1').prop('required', false)
            $('#state1').prop('required', false)
            $('#district1').prop('required', false)
            $('#zipcode1').prop('required', false)
            $('#street_address1').prop('required', false)
        } else {
            $('#country1').prop('required', true)
            $('#state1').prop('required', true)
            $('#district1').prop('required', true)
            $('#zipcode1').prop('required', true)
            $('#street_address1').prop('required', true)
            $("#sameas").show();
        }

    }
</script>
<script type="text/javascript">
    <?php if ($countryName == 'India') : ?>
        statelists('state', 'district', `<?= old('state') ?? ($permanentAddress['state'] ?? '') ?>`, `<?= old('district') ?? ($permanentAddress['district'] ?? '') ?>`);
        statelists('state1', 'district1', `<?= old('state1') ?? ($currentAddress['state'] ?? '') ?>`, `<?= old('district1') ?? ($currentAddress['district'] ?? '') ?>`);
    <?php endif; ?>
    <?php if (old('state1') || old('district1') || old('street_address1') || old('zipcode1')) : ?>
        $("#sameas").show();
        // required true
        $('#country1').prop('required', true)
        $('#state1').prop('required', true)
        $('#district1').prop('required', true)
        $('#zipcode1').prop('required', true)
        $('#street_address1').prop('required', true)
        $('#currentaddress').prop('checked', false)
    <?php endif; ?>
</script>