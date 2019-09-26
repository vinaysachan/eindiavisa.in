<style> .alert { padding: 0px !important; } .table td, .table th {padding: 0.25rem}</style>
<table class="table fs13">
    <tbody>
        <tr><td colspan="2">
                The applicant is requested to verify the particulars filled in the application Form.The applicant may face legal action(including refusal to enter India or deportation) in case of provision of wrong information.<br/>
                Please verify your Registration Details.   If all details are correct please Press "<b>Verified and Continue</b>". <br/>
                For any corrections press "<b>Modify/Edit</b>"
            </td></tr>
        <tr><th>Application ID : </th><th class="fs15"><?= $apply_details[0]->app_id ?></th></tr>
        <tr><th style="width: 20%">Application Type : </th><td><?= $apply_details[0]->app_type_name ?></td></tr>
    </tbody>
</table>
<div class="mt15 clearfix"></div>
<div class="col-md-12 box_heading">Applicant Details</div>
<div class="row">
    <label class="col-sm-5">Name</label>
    <div class="col-sm-6"><?= $apply_details[0]->fname ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Surname</label>
    <div class="col-sm-6"><?= $apply_details[0]->lname ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Applicant Profile Image</label>
    <div class="col-sm-6"><img src="<?= base_url(APPLICATION_IMG . $apply_details[0]->image) ?>" style="height:120px;"></div>
</div>
<div class="row">
    <label class="col-sm-5">Previous Surname</label>
    <div class="col-sm-6"><?= $apply_details[0]->prev_surname ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Previous Name</label>
    <div class="col-sm-6"><?= $apply_details[0]->prev_name ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Sex</label>
    <div class="col-sm-6"><?= ($apply_details[0]->sex == 'M') ? 'Male' : 'Female'; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Birthdate</label>
    <div class="col-sm-6"><?= get_date($apply_details[0]->dob, 'Y-m-d', 'd/m/Y') ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Town/City of birth</label>
    <div class="col-sm-6"><?= $apply_details[0]->birth_city ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Country of birth</label>
    <div class="col-sm-6"><?= country_name(NULL,$apply_details[0]->birth_country) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Citizenship/National Id No.</label>
    <div class="col-sm-6"><?= $apply_details[0]->national_id ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Religion</label>
    <div class="col-sm-6"><?= $apply_details[0]->religion ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Visible Identification Marks</label>
    <div class="col-sm-6"><?= $apply_details[0]->visible_identification_marks ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Educational Qualification</label>
    <div class="col-sm-6"><?= $apply_details[0]->qualification; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Nationality</label>
    <div class="col-sm-6"><?= country_name(NULL,$apply_details[0]->nationality) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Acquire Nationality by</label>
    <div class="col-sm-6"><?= $apply_details[0]->acquire_nationality ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Previous Nationality</label>
    <div class="col-sm-6"><?= country_name(NULL,$apply_details[0]->pre_nationality) ?></div>
</div>
<div class="col-md-12 box_heading">Passport Details</div>
<div class="row">
    <label class="col-sm-5"> Passport No</label>
    <div class="col-sm-6"><?= $apply_details[0]->passport_no ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Issue Place</label>
    <div class="col-sm-6"><?= $apply_details[0]->pass_place_of_Issue; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Issue Date</label>
    <div class="col-sm-6"><?= get_date($apply_details[0]->pass_date_of_Issue, 'Y-m-d', 'd/m/Y') ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Expiry Date</label>
    <div class="col-sm-6"><?= get_date($apply_details[0]->pass_date_of_expiry, 'Y-m-d', 'd/m/Y') ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Issue of Other Passport</label>
    <div class="col-sm-6"><?= $apply_details[0]->ic_passport_no; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Country of Issue of Other Passport</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->ic_country_of_Issue) ?></div>
</div>
<div class="row">
    <label class="col-sm-5"> Other Passport Issue Place</label>
    <div class="col-sm-6"><?= $apply_details[0]->ic_place_of_Issue; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Date of Expiry</label>
    <div class="col-sm-6">
        <?= get_date($apply_details[0]->ic_date_of_Issue, 'Y-m-d', 'd/m/Y') ?>
    </div>
</div>
<div class="row">
    <label class="col-sm-5">Nationality Described Therein</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->ic_nationality) ?></div>
</div>
<div class="col-md-12 box_heading">Applicant's Address Details</div>
<div class="row">
    <label class="col-sm-5">Present Address</label>
    <div class="col-sm-6"><p><?= $apply_details[0]->houseno; ?></p><p><?= $apply_details[0]->city; ?></p><p><?= $apply_details[0]->district; ?></p></div>
</div>
<div class="row">
    <label class="col-sm-5">Postal/Zip Code</label>
    <div class="col-sm-6"><?= $apply_details[0]->zipcode; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Mobile</label>
    <div class="col-sm-6"><?= $apply_details[0]->mobileno; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Email</label>
    <div class="col-sm-6"><?= $apply_details[0]->email; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Telephone Number</label>
    <div class="col-sm-6"><?= $apply_details[0]->phone ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Permanent Address House No./Street</label>
    <div class="col-sm-6"><?= $apply_details[0]->perma_houseno ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Permanent Address Village/Town/City</label>
    <div class="col-sm-6"><?= $apply_details[0]->perma_city ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Permanent Address State/Province/District</label>
    <div class="col-sm-6"><?= $apply_details[0]->perma_district ?></div>
</div>
<div class="col-md-12 box_heading">Family Details</div>
<div class="row">
    <label class="col-sm-5">Father Name</label>
    <div class="col-sm-6"><?= $apply_details[0]->father_name; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Father Nationality</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->father_nationality) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Father Previous Nationality</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->father_prenationality) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Father Place of Birth</label>
    <div class="col-sm-6"><?= $apply_details[0]->father_birth_place; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Father Country of Birth</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->father_country) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Mother Name</label>
    <div class="col-sm-6"><?= $apply_details[0]->mother_name; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Mother Nationality</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->mother_nationality) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Mother Previous Nationality</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->mother_prenationality) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Mother Place of Birth</label>
    <div class="col-sm-6"><?= $apply_details[0]->mother_birth_place; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Mother Country</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->mother_country) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Spouse Name</label>
    <div class="col-sm-6"><?= $apply_details[0]->spouse_name; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Spouse Nationality</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->spouse_nationlity) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Spouse Previous Nationality</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->spouse_prenationality) ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Spouse Place of Birth</label>
    <div class="col-sm-6"><?= $apply_details[0]->spouse_birth_place; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Spouse Country of Birth</label>
    <div class="col-sm-6"><?= country_name($apply_details[0]->spouse_birth_country)?></div>
</div>
<div class="row">
    <label class="col-sm-5">Grandparent details yes/no</label>
    <div class="col-sm-6"><?= $apply_details[0]->grand_parent_pakistan; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">If Yes, give details</label>
    <div class="col-sm-6"><?= $apply_details[0]->pakistan_nationality_detail; ?></div>
</div>
<div class="col-md-12 box_heading">Profession / Occupation Details of Applicant</div>
<div class="row">
    <label class="col-sm-5">Occupation</label>
    <div class="col-sm-6"><?= $apply_details[0]->present_occupation; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Employee Designation</label>
    <div class="col-sm-6"><?= $apply_details[0]->Employer_or_business; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Employer Name</label>
    <div class="col-sm-6"><?= $apply_details[0]->designation; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Employer Address</label>
    <div class="col-sm-6"><?= $apply_details[0]->address; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Employer Phone</label>
    <div class="col-sm-6"><?= $apply_details[0]->prof_phone; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Previous Occupation</label>
    <div class="col-sm-6"><?= $apply_details[0]->past_occupation; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Security Agency/Organisation</label>
    <div class="col-sm-6"><?= $apply_details[0]->military; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Designation</label>
    <div class="col-sm-6"><?= $apply_details[0]->mil_designation; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Posting</label>
    <div class="col-sm-6"><?= $apply_details[0]->mil_place_of_posting; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Rank</label>
    <div class="col-sm-6"><?= $apply_details[0]->mil_rank; ?></div>
</div>
<div class="col-md-12 box_heading">Details of Visa Sought</div>
<div class="row">
    <label class="col-sm-5">Application Type</label>
    <div class="col-sm-6"><?= $apply_details[0]->app_type_name?></div>
</div>
<div class="row">
    <label class="col-sm-5">Visa Type</label>
    <div class="col-sm-6"><?= $apply_details[0]->visa_type_name?></div>
</div>
<div class="row">
    <label class="col-sm-5">No of Entries</label>
    <div class="col-sm-6"><?= $apply_details[0]->visa_entry; ?> Entries</div>
</div>
<div class="row">
    <label class="col-sm-5">Duration</label>
    <div class="col-sm-6"><?= $apply_details[0]->visa_validitiy; ?> Days</div>
</div>
<div class="row">
    <label class="col-sm-5">Journey Date</label>
    <div class="col-sm-6"><?= get_date($apply_details[0]->expected_date_arrival, 'Y-m-d', 'd/m/Y') ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Port of Arrival in India</label>
    <div class="col-sm-6"><?= port_name($apply_details[0]->portofarrival); ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Expected Port of Exit from India</label>
    <div class="col-sm-6"><?= port_name($apply_details[0]->port_of_exit) ?></div>
</div>
<div class="col-md-12 box_heading">Previous Visit Details</div>
<div class="row">
    <label class="col-sm-5">Old Visa Issue</label>
    <div class="col-sm-6"><?= $apply_details[0]->visited_India ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Old Visa Type</label>
    <div class="col-sm-6"><?= $apply_details[0]->visited_type_Visa; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Old Visa No</label>
    <div class="col-sm-6"><?= $apply_details[0]->last_Indian_visa_no; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Old Visa Issue Place</label>
    <div class="col-sm-6"><?= $apply_details[0]->visited_visa_issue_place; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Old Visa Issue Date</label>
    <div class="col-sm-6"><?= get_date($apply_details[0]->visited_visa_issue_date, 'Y-m-d', 'd/m/Y') ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Previous Visit Address</label>
    <div class="col-sm-6"><?= $apply_details[0]->visited_address; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Visited Cities Details</label>
    <div class="col-sm-6"><?= $apply_details[0]->previously_visited_city; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Countries Visited Last 10 year</label>
    <div class="col-sm-6"><?= $apply_details[0]->countries_visitedlast; ?></div>
</div>
<div class="col-md-12 box_heading">Reference</div>
<div class="row">
    <label class="col-sm-5">Name of Sponsor in India</label>
    <div class="col-sm-6"><?= $apply_details[0]->ref_name; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Address of Sponsor in India</label>
    <div class="col-sm-6"><?= $apply_details[0]->ref_address; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Phone of Sponsor in India</label>
    <div class="col-sm-6"><?= $apply_details[0]->ref_phone; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Reference Name in Home Country</label>
    <div class="col-sm-6"><?= $apply_details[0]->ref_home_name; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Name of Sponsor in Home Country</label>
    <div class="col-sm-6"><?= $apply_details[0]->ref_home_phone; ?></div>
</div>
<div class="row">
    <label class="col-sm-5">Address of Sponsor in Home Country</label>
    <div class="col-sm-6"><?= $apply_details[0]->ref_home_address; ?></div>
</div> 
<div class="row">
    <label class="col-sm-5">Passport Image</label>
    <div class="col-sm-6"><img src="<?= base_url(PASSPORT_IMG . $apply_details[0]->passport_img) ?>" style="height:120px;"></div>
</div>
<div class="row row">
    <div class="col-sm-4 text-right">
        <a href="<?= base_url('main/visa_reg') ?>" class="btn btn-primary">Modify/Edit</a>
    </div>
    <div class="col-sm-2">
    </div>
    <div class="col-sm-4">
        <a href="<?= base_url('main/feepay') ?>" class="btn btn-primary">Verify/Continue</a>
    </div>
</div> 
<style>.row label { text-align: left !important; }</style>