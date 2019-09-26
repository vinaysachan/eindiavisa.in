<style> .alert { padding: 0px !important; } .table td, .table th {padding: 0.25rem}</style>
<table class="table fs13">
    <tbody>
        <tr><td colspan="2">Please note down the Temporary Application Details :</td></tr>
        <tr><th>Application ID : </th><th class="fs15"><?= $apply_details[0]->app_id ?></th></tr>
        <tr><th style="width: 20%">Application Type : </th><td><?= $apply_details[0]->app_type_name ?></td></tr>
        <tr><th colspan="2">Your Information will be saved if you click save button or continue to next page. If you exit without doing either of that, your information will be lost.</th></tr> 
    </tbody>
</table>
<hr/>
<div class="p10">
    <form name="visa_regFrm" id="visa_regFrm" method="post" class="form-horizontal" action="" >
        <div class="form-group row">
            <label for="surname" class="col-sm-4 require">Surname</label>
            <div class="col-sm-7">
                <input type="hidden" class="form-control" name="applicationid" id="applicationid" value="<?= $this->session->userdata('application_id') ?>" >
                <input type="text" class="form-control" name="surname" id="surname" value="<?= $apply_details[0]->lname; ?>" placeholder="Surname" required="" label-name="Surname">
            </div>
        </div>
        <div class="form-group row">
            <label for="fname" class="col-sm-4 require">Given Name/s</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="fname" id="fname" value="<?= $apply_details[0]->fname; ?>" placeholder="Name" required="" label-name="Given Name">
            </div>
        </div>
        <div class="form-group row text-center">
            <div class=" ">
                <label class="inline">Have you ever changed your name? If yes,</label>
                <label class="radio-inline">
                    <input name="have_previous_name" value="y"  <?= ((empty($apply_details[0]->have_previous_name)) || ($apply_details[0]->have_previous_name != 'y')) ? '' : 'checked=""' ?> type="checkbox">
                    <strong>Click the box and give details.</strong>
                </label>
            </div>
        </div>
        <div id="previous_name" style="display: <?= ((empty($apply_details[0]->have_previous_name)) || ($apply_details[0]->have_previous_name != 'y')) ? 'none' : 'block' ?>;">
            <div class="form-group row">
                <label for="prev_surname" class="col-sm-4">Previous Surname</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="prev_surname" id="prev_surname" value="<?= $apply_details[0]->prev_surname; ?>" placeholder="Previous Surname">
                </div>
            </div>
            <div class="form-group row">
                <label for="prev_name" class="col-sm-4">Previous Name</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="prev_name" id="prev_name" value="<?= $apply_details[0]->prev_name; ?>" placeholder="Previous Name">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="sex" class="col-sm-4 require">Sex </label>
            <div class="col-sm-7">
                <select name="sex" id="sex" class="form-control" required="" Label-name="Sex">
                    <option value="">Select</option>
                    <option <?= ($apply_details[0]->sex == 'M') ? 'selected=""' : '' ?> value="M" >Male</option>
                    <option <?= ($apply_details[0]->sex == 'F') ? 'selected=""' : '' ?> value="F">Female</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 require">Date of Birth</label>
            <div class="col-sm-7">
                <input disabled="" value="<?= get_date($apply_details[0]->dob, 'Y-m-d', 'd/m/Y') ?>" type="text" class="form-control" placeholder="Date of Birth" >
            </div>
        </div>
        <div class="form-group row">
            <label for="birthofcity" class="col-sm-4 require">Town/City of birth</label>
            <div class="col-sm-7">
                <input type="text" value="<?= $apply_details[0]->birth_city ?>" class="form-control" name="birthofcity" id="birthofcity" placeholder="Town/City of birth" required="" label-name="Town/City of Birth">
            </div>
        </div>
        <div class="form-group row">
            <label for="nationality" class="col-sm-4 require">Country of birth </label>
            <div class="col-sm-7">
                <select name="birthofcountry" class="form-control" id="nationality" required="" label-name="Country of birth">
                    <option value="">Select Country</option>
                    <?php foreach ($getAllCounrty as $counrty) : ?>
                    <option <?=($apply_details[0]->birth_country == $counrty->id) ? 'selected=""' :''?> value="<?= $counrty->id; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="natinalid" class="col-sm-4 require">Citizenship/National Id No.</label>
            <div class="col-sm-7">
                <input type="text" value="<?= $apply_details[0]->national_id ?>" class="form-control" name="natinalid" id="natinalid" placeholder="Citizenship/National Id No" required="" label-name="Citizenship/National Id No">
            </div>
        </div>				
        <div class="form-group row">
            <label for="row" class="col-sm-4 require">Religion</label>
            <div class="col-sm-3">
                <select name="religion" class="form-control" required="" label-name="Religion">
                    <option value="" selected="selected">Select Religion</option>
                    <option <?= ($apply_details[0]->religion == 'BAHAI') ? 'selected=""' : '' ?> value="BAHAI">BAHAI</option>
                    <option <?= ($apply_details[0]->religion == 'BUDDHISM') ? 'selected=""' : '' ?> value="BUDDHISM">BUDDHISM</option>
                    <option <?= ($apply_details[0]->religion == 'CHRISTIAN') ? 'selected=""' : '' ?> value="CHRISTIAN">CHRISTIAN</option>
                    <option <?= ($apply_details[0]->religion == 'HINDU') ? 'selected=""' : '' ?> value="HINDU">HINDU</option>
                    <option <?= ($apply_details[0]->religion == 'ISLAM') ? 'selected=""' : '' ?> value="ISLAM">ISLAM</option>
                    <option <?= ($apply_details[0]->religion == 'JUDAISM') ? 'selected=""' : '' ?> value="JUDAISM">JUDAISM</option>
                    <option <?= ($apply_details[0]->religion == 'PARSI') ? 'selected=""' : '' ?> value="PARSI">PARSI</option>
                    <option <?= ($apply_details[0]->religion == 'SIKH') ? 'selected=""' : '' ?> value="SIKH">SIKH</option>
                    <option <?= ($apply_details[0]->religion == 'ZOROASTRIAN') ? 'selected=""' : '' ?> value="ZOROASTRIAN">ZOROASTRIAN</option>
                    <option <?= ($apply_details[0]->religion == 'Others') ? 'selected=""' : '' ?> value="Others">Others</option>
                </select>
            </div>
            <div class="col-sm-4">
                <input placeholder="" type="text" id="other_relation" name="other_relation" class="form-control" disabled="">
            </div>
        </div>
        <div class="form-group row">
            <label for="identification" class="col-sm-4 require">Visible identification marks</label>
            <div class="col-sm-7">
                <input type="text" name="identification" class="form-control" id="identification" placeholder="Visible identification marks" required="" value="<?= $apply_details[0]->visible_identification_marks ?>" label-name="Visible identification marks">
            </div>
        </div>
        <div class="form-group row">
            <label for="row" class="col-sm-4 require">Educational Qualification</label>
            <div class="col-sm-7">
                <select name="qualification" class="form-control" id="passportType" required="" label-name="Educational Qualification">
                    <option value="" >Select Educational Qualification</option>
                    <option <?= ($apply_details[0]->qualification == 'BELOW MATRICULATION') ? 'selected=""' : '' ?> value="BELOW MATRICULATION"> BELOW MATRICULATION</option>
                    <option <?= ($apply_details[0]->qualification == 'GRADUATE') ? 'selected=""' : '' ?> value="GRADUATE"> GRADUATE</option>
                    <option <?= ($apply_details[0]->qualification == 'HIGHER SECONDARY') ? 'selected=""' : '' ?>  value="HIGHER SECONDARY"> HIGHER SECONDARY</option>
                    <option <?= ($apply_details[0]->qualification == 'ILLITERATE') ? 'selected=""' : '' ?>  value="ILLITERATE"> ILLITERATE</option>
                    <option <?= ($apply_details[0]->qualification == 'MATRICULATION') ? 'selected=""' : '' ?>  value="MATRICULATION"> MATRICULATION</option>
                    <option <?= ($apply_details[0]->qualification == 'NA BEING MINOR') ? 'selected=""' : '' ?>  value="NA BEING MINOR"> NA BEING MINOR</option>
                    <option <?= ($apply_details[0]->qualification == 'OTHERS') ? 'selected=""' : '' ?>  value="OTHERS"> OTHERS</option>
                    <option <?= ($apply_details[0]->qualification == 'POST GRADUATE') ? 'selected=""' : '' ?>  value="POST GRADUATE"> POST GRADUATE</option>
                    <option <?= ($apply_details[0]->qualification == 'PROFESSIONAL') ? 'selected=""' : '' ?>  value="PROFESSIONAL"> PROFESSIONAL</option>
                </select>
            </div>
        </div>				
        <div class="form-group row">
            <label class="col-sm-4">Nationality</label>
            <div class="col-sm-7"><?= country_name(NULL,$apply_details[0]->nationality) ?></div> 
        </div>
        <div class="form-group row">
            <label for="acquire_nationality" class="col-sm-4 require">Did you acquire Nationality by birth or by Naturalization?</label>
            <div class="col-sm-7">
                <select name="acquire_nationality" class="form-control" id="acquire_nationality" onchange="acquire_naturalization(this.value)" required="" label-name="">
                    <option value="">Select One</option>
                    <option <?= ($apply_details[0]->acquire_nationality == 'By Birth') ? 'selected=""' : '' ?>  value="By Birth">By Birth</option>
                    <option <?= ($apply_details[0]->acquire_nationality == 'Naturalization') ? 'selected=""' : '' ?>  value="Naturalization">Naturalization</option>
                </select>
            </div>
        </div>
        <div class="form-group row" id="prev_nationality" style="display:<?= (!empty($apply_details[0]->pre_nationality)) ? '' : 'none' ?>">
            <label for="prev_nationality" class="col-sm-4 ">Prev. Nationality </label>
            <div class="col-sm-7">
                <select name="prev_nationality" class="form-control" id="nationality" >
                    <option value="">Select Country...</option>
                    <?php foreach ($getCounrty as $counrty) { ?>
                        <option <?= ($apply_details[0]->pre_nationality == $counrty->code) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group text-center row">
            <label class="require">
                Have you lived for at least two years in the country from where you are applying visa?
            </label>
            <div class=" ">
                <label class="radio-inline">
                    <input name="two_year_live" checked="" required="" value="y" type="radio"> YES
                </label>
                <label class="radio-inline">
                    <input name="two_year_live" required="" value="n" type="radio"> NO
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="passportno" class="col-sm-4 require">Passport NO</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="passportno" name="passportno" value="<?= $apply_details[0]->passport_no; ?>" placeholder="Passport No" required="" label-name="Passport No">
            </div>
        </div>
        <div class="form-group row">
            <label for="placeofissue" class="col-sm-4 col-require">Place of Issue</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="placeofissue" value="<?= $apply_details[0]->pass_place_of_Issue; ?>" name="placeofissue" placeholder="Place of Issue" required="">
            </div>
        </div>
        <div class="form-group row">
            <label for="dtp_input2" class="col-sm-4 require">Date of Issue</label>
            <div class="col-sm-7"> 
                <input type="text" required="" label-name="Date of Issue" data-max_date="<?= date('Y,m,d', strtotime("-0 year")) ?>" class="form-control date_picker" name="dateofissue" id="dateofissue" placeholder="Date of Issue" value="<?= get_date($apply_details[0]->pass_date_of_Issue, 'Y-m-d', 'd/m/Y') ?>" >
            </div>
        </div>
        <div class="form-group row">
            <label for="dtp_input2" class="col-sm-4 require">Date of Expiry</label>
            <div class="col-sm-7"> 
                <input type="text" required="" label-name="Date of Expiry" data-min_date="<?= date('Y,m,d', strtotime("-0 year")) ?>" class="form-control date_picker" name="dateofexpiry" id="dateofexpiry" placeholder="Date of Expiry" value="<?= get_date($apply_details[0]->pass_date_of_expiry, 'Y-m-d', 'd/m/Y') ?>" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4">Any other valid Passport/Identity Certificate(IC) held *</label>
            <div class="col-sm-7">
                <label class="radio-inline">
                    <input type="radio" name="ic" id="inlineRadio1" <?= (empty($apply_details[0]->ic_country_of_Issue)) ? '' : 'checked="checked"' ?> value="yes"> YES
                </label>
                <label class="radio-inline">
                    <input type="radio" name="ic" id="inlineRadio2" <?= (empty($apply_details[0]->ic_country_of_Issue)) ? 'checked="checked"' : '' ?> value="no"> NO
                </label>
            </div>
        </div>

        <!--------------------IC Form ------------------------------------>				
        <div id="ic_form" style="display: <?= (empty($apply_details[0]->ic_country_of_Issue)) ? 'none' : 'block' ?>">
            <div class="form-group row">
                <label for="row" class="col-sm-4 ">Country of Issue</label>
                <div class="col-sm-7"> 
                    <select name="issueofcountry" class="form-control" id="issueofcountry">
                        <option value="">Select Country...</option>
                        <?php foreach ($getCounrty as $counrty) { ?>
                            <option <?= ($apply_details[0]->ic_country_of_Issue == $counrty->code) ? 'selected=""' : '' ?>  value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>				
            <div class="form-group row">
                <label for="icpassportno" class="col-sm-4 ">Passport/IC No. </label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="icpassportno" name="icpassportno" placeholder="Passport/IC No" value="<?= $apply_details[0]->ic_passport_no ?>">
                </div>
            </div> 
            <div class="form-group row">
                <label for="dtp_input2" class="col-sm-4 require">Date of Expiry</label>
                <div class="col-sm-7"> 
                    <input type="text" required="" label-name="Date of Expiry" data-min_date="<?= date('Y,m,d', strtotime("-0 year")) ?>" class="form-control date_picker" name="icdateofexpiry" id="icdateofexpiry" placeholder="Date of Expiry" value="<?= get_date($apply_details[0]->ic_date_of_Issue, 'Y-m-d', 'd/m/Y') ?>" >
                </div>
            </div> 
            <div class="form-group row">
                <label for="icplaceofissue" class="col-sm-4 ">Place of Issue </label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="icplaceofissue" name="icplaceofissue" placeholder="Place of Issue" value="<?= $apply_details[0]->ic_place_of_Issue ?>"  >
                </div>
            </div>
            <div class="form-group row">
                <label for="row" class="col-sm-4 ">Nationality mentioned therein  </label>
                <div class="col-sm-7">
                    <select name="icnatinality" class="form-control" id="nationality" data-parsley-required="" >
                        <option value="">Select Country...</option>
                        <?php foreach ($getCounrty as $counrty) { ?>
                            <option <?= ($apply_details[0]->ic_nationality == $counrty->code) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-offset-4 col-sm-3">
                <input type="submit" class="btn btn-primary" name="step1" value="Save and Continue" />
            </div>
        </div>
    </form>
</div>