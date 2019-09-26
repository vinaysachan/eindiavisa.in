<style> .alert { padding: 0px !important; } .table td, .table th {padding: 0.25rem}</style>
<table class="table fs13">
    <tbody>
        <tr><th>Application ID : </th><th class="fs15"><?= $apply_details[0]->app_id ?></th></tr>
        <tr><th style="width: 20%">Application Type : </th><td><?= $apply_details[0]->app_type_name ?></td></tr>
    </tbody>
</table>
<div class="p10 pt0">
    <form name="step3" id="step3" method="POST" >
        <div class="col-md-12 box_heading">Applicant's Address Details </div>			
        <h2>Present Address</h2>
        <div class="form-group row">
            <label for="" class="col-sm-4 require">House No./Street</label>
            <div class="col-sm-7">
                <input type="hidden" class="form-control" name="applicationid" id="applicationid" value="<?= $this->session->userdata('application_id'); ?>" >
                <input type="text" class="form-control" required="" label-name="House No./Street" name="houseno" id="houseno" value="<?= $apply_details[0]->houseno; ?>" placeholder="House No./Street">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-4 require">Village/Town/City</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Village/Town/City" value="<?= $apply_details[0]->city; ?>"  name="city" id="city"  placeholder="Village/Town/City">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-4 require">State/Province/District</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="State/Province/District" value="<?= $apply_details[0]->district; ?>" name="district" id="district"  placeholder="State/Province/District">
            </div>
        </div>
        <div class="form-group row">
            <label for="zipcode" class="col-sm-4 require">Postal/Zip Code</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Postal/Zip Code" value="<?= $apply_details[0]->zipcode; ?>" name="zipcode" id="zipcode"  placeholder="zipcode">
            </div>
        </div>
        <div class="form-group row">
            <label for="adress_country" class="col-sm-4 require">Country</label>
            <div class="col-sm-7">
                <select name="adress_country" required="" label-name="Country" class="form-control" id="adress_country" data-parsley-required="" >
                    <option value="">Select Country</option>
                    <?php foreach ($getCounrty as $counrty) { ?>
                        <option <?= ($counrty->code == $apply_details[0]->adress_country) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div> 
        <div class="form-group row">
            <label for="mobileno" class="col-sm-4 require">Mobile No.</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Mobile No." value="<?= $apply_details[0]->mobileno; ?>" name="mobileno" id="mobileno" placeholder="mobile no">
            </div>
        </div>	
        <div class="form-group row">
            <label for="" class="col-sm-4">Email</label>
            <div class="col-sm-7">
                <?= $apply_details[0]->email; ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-6">Click Here for Same Address</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="checkbox" name="sameAddress" id="sameAddress" value="yes" onclick="sameaddress(this.form)"> 
                </label>
            </div>
        </div>	
        <h2>Permanent Address</h2>
        <div class="form-group row">
            <label for="phouseno" class="col-sm-4 require">House No./Street</label>
            <div class="col-sm-7">
                <input type="hidden" class="form-control" name="applicationid" id="applicationid" value="<?= $this->session->userdata('application_id'); ?>" >
                <input type="text" class="form-control" required="" label-name="House No./Street" value="<?= $apply_details[0]->perma_houseno; ?>" name="phouseno" id="phouseno" value="" placeholder="House No">
            </div>
        </div>
        <div class="form-group row">
            <label for="pcity" class="col-sm-4 require">Village/Town/City</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Village/Town/City" value="<?= $apply_details[0]->perma_city; ?>" name="pcity" id="pcity" placeholder="Village/Town/City">
            </div>
        </div>
        <div class="form-group row">
            <label for="pdistrict" class="col-sm-4 require">State/Province/District</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="pdistrict" required="" label-name="Village/Town/City" value="<?= $apply_details[0]->perma_district; ?>" id="pdistrict" placeholder="State/Province/District">
            </div>
        </div>
        <div class="col-md-12 box_heading">Family Details</div>
        <h2>Father's Details</h2>				
        <div class="form-group row">
            <label for="father_name" class="col-sm-4 require">Father Name</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Father Name" value="<?= $apply_details[0]->father_name; ?>" name="father_name" id="father_name" placeholder="father Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="father_nationality" class="col-sm-4 require">Father Nationality</label>
            <div class="col-sm-7">
                <select name="father_nationality" class="form-control" required="" label-name="Father Nationality"  id="father_nationality" >
                    <option value="">Select Country</option>
                    <?php foreach ($getCounrty as $counrty) { ?>
                        <option <?= ($counrty->code == $apply_details[0]->father_nationality) ? 'selected=""' : '' ?> value="<?= $counrty->code ?>" title="<?= $counrty->name ?>"> <?= $counrty->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="father_prenationality" class="col-sm-4">Father Pre Nationality</label>
            <div class="col-sm-7">
                <select name="father_prenationality" class="form-control" id="father_prenationality" >
                    <option value="">Select Country</option>
                    <?php foreach ($getCounrty as $counrty) { ?>
                        <option <?= ($counrty->code == $apply_details[0]->father_prenationality) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="fatherbirthplace" class="col-sm-4 require">Father Birth Place</label>
            <div class="col-sm-7">
                <input type="text" value="<?= $apply_details[0]->father_name; ?>" class="form-control" name="fatherbirthplace" id="fatherbirthplace" placeholder="Father Birth Place">
            </div>
        </div>
        <div class="form-group row">
            <label for="father_country" class="col-sm-4 require">Father Country of Birth</label>
            <div class="col-sm-7">
                <select name="father_country" class="form-control" id="father_country" >
                    <option value="">Select Country...</option>
                    <?php foreach ($getCounrty as $counrty) { ?>
                        <option <?= ($counrty->code == $apply_details[0]->father_country) ? 'selected=""' : '' ?> value="<?= $counrty->code ?>" title="<?= $counrty->name ?>"><?= $counrty->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>	
        <h2>Mother's Details</h2>				
        <div class="form-group row">
            <label for="mother_name" class="col-sm-4 require">Mother Name</label>
            <div class="col-sm-7">
                <input type="text" required="" label-name="Mother Name" value="<?= $apply_details[0]->mother_name ?>" class="form-control" name="mother_name" id="mother_name" placeholder="Mother Name">
            </div>
        </div>				
        <div class="form-group row">
            <label for="mothernationality" class="col-sm-4 require">Mother Nationality</label>
            <div class="col-sm-7">
                <select name="mothernationality" class="form-control" id="mothernationality" >
                    <option value="">Select Country</option>
                    <?php foreach ($getCounrty as $counrty) { ?>
                        <option <?= ($counrty->code == $apply_details[0]->mother_nationality) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="motherprenationality" class="col-sm-4">Mother Pre Nationality</label>
            <div class="col-sm-7">
                <select name="motherprenationality" class="form-control" id="motherprenationality" >
                    <option value="">Select Country...</option>
                    <?php foreach ($getCounrty as $counrty) { ?>
                        <option <?= ($counrty->code == $apply_details[0]->mother_prenationality) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-4 require">Mother Birth Place</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Mother Birth Place" value="<?= $apply_details[0]->mother_birth_place ?>" name="motherbirthplace" id="" placeholder="Mother Birth Place">
            </div>
        </div>
        <div class="form-group row">
            <label for="mothercountry" class="col-sm-4">Mother Country</label>
            <div class="col-sm-7">
                <select name="mothercountry" class="form-control" id="mothercountry" >
                    <option value="">Select Country</option>
                    <?php foreach ($getCounrty as $counrty) { ?>
                        <option value="<?= $counrty->code; ?>" <?= ($counrty->code == $apply_details[0]->mother_country) ? 'selected=""' : '' ?> title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>	
        <hr>
        <div class="form-group row">
            <label for="maritalstatus" class="col-sm-4 require">Applicant's Marital Status</label>
            <div class="col-sm-7">
                <select name="maritalstatus" required="" label-name="Marital Status" class="form-control" id="maritalstatus" onchange="maritalStatus(this.value)"> 
                    <option value="">Select One</option>
                    <option <?= ('Married' == $apply_details[0]->marital_status) ? 'selected=""' : '' ?> value="Married">Married</option>
                    <option <?= ('Unmarried' == $apply_details[0]->marital_status) ? 'selected=""' : '' ?> value="Unmarried">Single</option>
                </select>
            </div>
        </div>
        <div id="spouse_form" style="display: <?= ('Married' == $apply_details[0]->marital_status) ? 'block' : 'none' ?>;">
            <h2>Spouse's Details</h2>				
            <div class="form-group row">
                <label for="spousename" class="col-sm-4 require">Spouse Name</label>
                <div class="col-sm-7">
                    <input type="text" required="" label-name="Spouse Name" value="<?= $apply_details[0]->spouse_name ?>" class="form-control" name="spousename" id="spousename" placeholder="Spouse Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="spousenationality" class="col-sm-4">Spouse Nationality</label>
                <div class="col-sm-7">
                    <select name="spousenationality" class="form-control" id="spousenationality" data-parsley-required="" >
                        <option value="">Select Country...</option>
                        <?php foreach ($getCounrty as $counrty) { ?>
                            <option <?= ($counrty->code == $apply_details[0]->spouse_nationlity) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="spouseprenationality" class="col-sm-4">Spouse Pre Nationality</label>
                <div class="col-sm-7">
                    <select name="spouseprenationality" class="form-control" id="spouseprenationality" data-parsley-required="" >
                        <option value="">Select Country...</option>
                        <?php foreach ($getCounrty as $counrty) { ?>
                            <option <?= ($counrty->code == $apply_details[0]->spouse_prenationality) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-4 require">Spouse Birth Place</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" required="" label-name="Spouse Birth Place" value="<?= $apply_details[0]->spouse_birth_place ?>" name="spousebirthplace" id="" placeholder="Spouse Birth Place">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Spouse Country</label>
                <div class="col-sm-7">
                    <select name="spousecountry" class="form-control" id="spousecountry" data-parsley-required="" >
                        <option value="">Select Country...</option>
                        <?php foreach ($getCounrty as $counrty) { ?>
                            <option <?= ($counrty->code == $apply_details[0]->spouse_birth_country) ? 'selected=""' : '' ?> value="<?= $counrty->code; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>	
        </div>
        <!--------------------spouse Form END------------------------------------>	
        <hr/>
        <div class="form-group row" >
            <label for="inputPassword3" class="col-sm-12 text-left">Were your Grandfather/ Grandmother (paternal/maternal) Pakistan Nationals or Belong to Pakistan held area.</label>
            <div class="col-sm-4"></div>
            <div class="col-sm-5">
                <label class="radio-inline">
                    <input type="radio" <?= (($apply_details[0]->grand_parent_pakistan == "yes") || (empty($apply_details[0]->grand_parent_pakistan))) ? 'checked="checked"' : '' ?> name="grand_pak" id="grand_pak" value="yes"> YES
                </label>
                <label class="radio-inline">
                    <input type="radio" <?= ($apply_details[0]->grand_parent_pakistan == "no") ? 'checked="checked"' : '' ?> name="grand_pak" id="grand_pak" value="no"> NO
                </label>
            </div>
        </div>
        <div id="pak_details" style="display:<?= (($apply_details[0]->grand_parent_pakistan == "yes") || (empty($apply_details[0]->grand_parent_pakistan))) ? 'block' : 'none' ?>">
            <div class="form-group row" >
                <label for="pakistan_nationality_detail" class="col-sm-4 require">If Yes, give details</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" required="" label-name="Details" value="<?= $apply_details[0]->pakistan_nationality_detail ?>" id="passportno" name="pakistan_nationality_detail"  >
                </div>
            </div>
        </div>
        <div class="col-md-12 box_heading">Profession / Occupation Details of Applicant </div>				
        <div class="form-group row">
            <label for="occupation" class="col-sm-4 require">Present Occupation</label>
            <div class="col-sm-7">
                <?php
                $occupations = array(
                    '' => 'Select Occupation',
                    'AIR FORCE' => 'AIR FORCE',
                    'BUSINESS PERSON' => 'BUSINESS PERSON',
                    'CAMERAMAN' => 'CAMERAMAN',
                    'CHARITY/SOCIAL WORKER' => 'CHARITY/SOCIAL WORKER',
                    'CHARTERED ACCOUNTANT' => 'CHARTERED ACCOUNTANT',
                    'COLLEGE/UNIVERSITY TEACHER' => 'COLLEGE/UNIVERSITY TEACHER',
                    'DIPLOMAT' => 'DIPLOMAT',
                    'DOCTOR' => 'DOCTOR',
                    'ENGINEER' => 'ENGINEER',
                    'FILM PRODUCER' => 'FILM PRODUCER',
                    'GOVERNMENT SERVICE' => 'GOVERNMENT SERVICE',
                    'HOUSE WIFE' => 'HOUSE WIFE',
                    'JOURNALIST' => 'JOURNALIST',
                    'LABOUR' => 'LABOUR',
                    'LAWYER' => 'LAWYER',
                    'MEDIA' => 'MEDIA',
                    'MILITARY' => 'MILITARY',
                    'MISSIONARY' => 'MISSIONARY',
                    'NAVY' => 'NAVY',
                    'NEWS BROADCASTER' => 'NEWS BROADCASTER',
                    'OFFICIAL' => 'OFFICIAL',
                    'POLICE' => 'POLICE',
                    'PRESS' => 'PRESS',
                    'PUBLISHER' => 'PUBLISHER',
                    'PRIVATE SERVICE' => 'PRIVATE SERVICE',
                    'REPORTER' => 'REPORTER',
                    'RESEARCHER' => 'RESEARCHER',
                    'RETIRED' => 'RETIRED',
                    'SEA MAN' => 'SEA MAN',
                    'SELF EMPLOYED/ FREELANCER' => 'SELF EMPLOYED/ FREELANCER',
                    'STUDENT' => 'STUDENT',
                    'TRADER' => 'TRADER',
                    'TV PRODUCER' => 'TV PRODUCER',
                    'UN-EMPLOYED' => 'UN-EMPLOYED',
                    'UN OFFICIAL' => 'UN OFFICIAL',
                    'WORKER' => 'WORKER',
                    'WRITER' => 'WRITER',
                    'OTHERS' => 'OTHERS'
                );
                echo form_dropdown('occupation', $occupations, $apply_details[0]->present_occupation, ['id' => 'occupation', 'class' => 'form-control', 'required' => 'required', 'label-name' => 'Occupation']);
                ?>
            </div>
        </div>				
        <div class="form-group row">
            <label for="Employer_or_business" class="col-sm-4 require">Employer Name/business</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Employer Name/business" value="<?= $apply_details[0]->Employer_or_business ?>" id="Employer_or_business" name="Employer_or_business" placeholder="Employer Name/business">
            </div>
        </div>
        <div class="form-group row">
            <label for="designation" class="col-sm-4 require">Designation</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Designation" value="<?= $apply_details[0]->designation ?>" id="designation" name="designation" placeholder="Designation">
            </div>
        </div>
        <div class="form-group row">
            <label for="baddress" class="col-sm-4 require">Address</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" required="" label-name="Address" value="<?= $apply_details[0]->address ?>" id="baddress" name="baddress" placeholder="Address">
            </div>
        </div>
        <div class="form-group row">
            <label for="bPhone" class="col-sm-4 require">Phone</label>
            <div class="col-sm-7">
                <input type="text" class="form-control onlyNumeric" required="" label-name="Phone" value="<?= $apply_details[0]->prof_phone ?>" id="bPhone" name="bPhone" placeholder="Phone">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-4 col-form-label">Past Occupation, if any</label>
            <div class="col-sm-7">
                <?php
                echo form_dropdown('past_occupation', $occupations, $apply_details[0]->past_occupation, ['id' => 'past_occupation', 'class' => 'form-control']);
                ?>
            </div>
        </div>
        <hr/>
        <div class="form-group row">				
            <label for="military" class="col-sm-12">
                <p class="text-center">Are/were you in a Military/Semi-Military/Police/Security. Organization? Yes / No </p>
            </label>
            <div class="col-sm-12 text-center">
                <label class="radio-inline">
                    <input type="radio" <?= ($apply_details[0]->military == "yes") ? 'checked="checked"' : '' ?> name="military" value="yes"> YES
                </label>
                <label class="radio-inline">
                    <input type="radio" <?= (($apply_details[0]->military == "no") || (empty($apply_details[0]->grand_parent_pakistan))) ? 'checked="checked"' : '' ?> name="military" value="no"> NO
                </label>
            </div>
        </div>
        <div id="military_form" style="display: <?= (($apply_details[0]->military == "no") || (empty($apply_details[0]->grand_parent_pakistan))) ? 'none' : 'block' ?>;">
            <div class="form-group row">
                <label for="morganisation" class="col-sm-4">Organisation</label>
                <div class="col-sm-7">
                    <input type="text" value="<?= $apply_details[0]->mil_organisation ?>" class="form-control" name="morganisation" id="morganisation" placeholder="">
                </div>
            </div>				

            <div class="form-group row">
                <label for="mdesignation" class="col-sm-4">Designation</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" value="<?= $apply_details[0]->mil_designation ?>" name="mdesignation" id="mdesignation" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="rank" class="col-sm-4">Rank</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" value="<?= $apply_details[0]->mil_rank ?>" name="rank" id="rank" >
                </div>
            </div>				

            <div class="form-group row">
                <label for="posting" class="col-sm-4">Place of Posting</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" value="<?= $apply_details[0]->mil_place_of_posting ?>" name="posting" id="posting" >
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <div class="col-sm-3">
                <input type="submit" class="btn btn-primary" name="visa_step3" value="Save and Continue" />
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-3">
                <input type="submit" class="btn btn-primary" name="visa_step3_exit" value="Save and Temporarily Exit" />
            </div>
        </div>
    </form>
</div>
