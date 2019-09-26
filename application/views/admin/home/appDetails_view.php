<div class="box-header with-border">
    <h3 class="box-title"></h3>
</div>
<div class = "box-body">
    <div class="row">
        <div class="well col-md-8" style="margin:0px 16% ;"> 
            <table class="table table-bordered"> 
                <tbody>
                    <tr class="info-bar">
                        <td>Application NO</td>
                        <td><?= $application[0]->app_id ?></td>
                    </tr>
                    <tr class="info-bar">
                        <td>Application Type</td>
                        <td><?= $application[0]->app_type_name ?></td>
                    </tr>
                    <tr class="info-bar">
                        <td>Visa Type (Purpose)</td>
                        <td><?= $application[0]->visa_type_name ?></td>
                    </tr>
                    <tr class="info-bar">
                        <td>No of Entries</td>
                        <td><?= $application[0]->visa_entry ?></td>
                    </tr>
                    <tr class="info-bar">
                        <td>Visa Duration</td>
                        <td><?= $application[0]->visa_validitiy ?> Days</td>
                    </tr>
                    <tr class="info-bar">
                        <td>Visa Amount</td>
                        <td><?= $application[0]->visa_currency_code ?> <?= $application[0]->visa_amount ?></td>
                    </tr>
                    <tr>
                        <td>Passport Type</td>
                        <td><?= $application[0]->passport_type ?></td>
                    </tr>    
                    <tr>
                        <td>Port of Arrival</td>
                        <td><?= port_name($application[0]->portofarrival) ?></td>
                    </tr>
                    <tr>
                        <td>Expected Port of Exit from India</td>
                        <td><?= port_name($application[0]->port_of_exit) ?></td>
                    </tr>
                    <tr>
                        <td>Nationality</td>
                        <td><?= country_name(NULL,$application[0]->nationality) ?></td>
                    </tr>
                    <tr>
                        <td>Date Of Birth</td>
                        <td><?= get_date($application[0]->dob, 'Y-m-d', 'd/m/Y') ?></td>
                    </tr>
                    <tr>
                        <td>Email ID</td>
                        <td><?= $application[0]->email ?></td>
                    </tr>
                    <tr>
                        <td>Phone No</td>
                        <td><?= $application[0]->phone ?></td>
                    </tr>
                    <tr>
                        <td>Expected Date of Arrival</td>
                        <td><?= get_date($application[0]->expected_date_arrival, 'Y-m-d', 'd/m/Y') ?></td>
                    </tr> 
                    <tr>
                        <td>First Name</td>
                        <td><?= $application[0]->fname ?></td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td><?= $application[0]->lname ?></td>
                    </tr>
                    <tr>
                        <td>Previous Name</td>
                        <td><?= $application[0]->prev_name ?></td>
                    </tr>
                    <tr>
                        <td>Previous Surname</td>
                        <td><?= $application[0]->prev_surname ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?= ($application[0]->sex == 'M') ? 'Male' : 'Female'; ?></td>

                    </tr>
                    <tr>
                        <td>Religion</td>
                        <td><?= $application[0]->religion ?></td>

                    </tr>
                    <tr>
                        <td>City Of Birth</td>
                        <td><?= $application[0]->birth_city ?></td>

                    </tr>
                    <tr>
                        <td>Country of Birth</td>
                        <td><?= country_name(NULL,$application[0]->birth_country) ?></td>

                    </tr>
                    <tr>
                        <td>National Id Number</td>
                        <td><?= $application[0]->national_id ?></td>

                    </tr>
                    <tr>
                        <td>Education Qulification</td>
                        <td><?= $application[0]->qualification ?></td>

                    </tr>
                    <tr>
                        <td>Visible Identification Marks</td>
                        <td><?= $application[0]->visible_identification_marks ?></td>

                    </tr>
                    <tr>
                        <td>Nationality By Birth</td>
                        <td><?=$application[0]->acquire_nationality?></td>

                    </tr>
                    <tr>
                        <td>Pre Nationality</td>
                        <td><?= country_name($application[0]->pre_nationality) ?></td>
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">Passport Details </td>
                    </tr>
                    <tr>
                        <td>Passport Type</td>
                        <td><?= $application[0]->passport_type ?></td>

                    </tr>
                    <tr>
                        <td>Passport Number</td>
                        <td><?= $application[0]->passport_no ?></td> 
                    </tr>
                    <tr>
                        <td>Passport Issue Place</td>
                        <td><?= $application[0]->pass_place_of_Issue ?></td> 
                    </tr>
                    <tr>
                        <td>Passport Issue Date</td>
                        <td><?= get_date($application[0]->pass_date_of_Issue, 'Y-m-d', 'd/m/Y') ?></td> 
                    </tr>
                    <tr>
                        <td>Passport Expry Date</td>
                        <td><?= get_date($application[0]->pass_date_of_expiry, 'Y-m-d', 'd/m/Y') ?></td> 
                    </tr>
                    <tr>
                        <td>Issue of Other Passport</td>
                        <td><?= $application[0]->ic_passport_no ?></td> 
                    </tr>
                    <tr>
                        <td>Country of Issue of Other Passport</td>
                        <td><?= country_name($application[0]->ic_country_of_Issue) ?></td> 
                    </tr>
                    <tr>
                        <td>Other Passport Issue Place</td>
                        <td><?= $application[0]->ic_place_of_Issue; ?></td> 
                    </tr>
                    <tr>
                        <td>Date of Expiry</td>
                        <td><?= get_date($application[0]->ic_date_of_Issue, 'Y-m-d', 'd/m/Y') ?></td> 
                    </tr>
                    <tr>
                        <td>Nationality Described Therein</td>
                        <td><?= country_name($application[0]->ic_nationality) ?></td> 
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">Present Address </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?= $application[0]->houseno ?></td>

                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?= $application[0]->city ?></td>

                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?= $application[0]->district ?></td>
                    </tr>
                    <tr>
                        <td>Zip Code</td>
                        <td><?= $application[0]->zipcode ?></td>

                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?= $application[0]->adress_country ?></td>
                    </tr>
                    <tr>
                        <td>Mobile Number</td>
                        <td><?= $application[0]->mobileno ?></td>
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">Permanent Address </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?= $application[0]->perma_houseno ?></td>
                    </tr>
                    <tr>
                        <td>District</td>
                        <td><?= $application[0]->perma_district ?></td>
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">Father Details</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?= $application[0]->father_name ?></td>
                    </tr>
                    <tr>
                        <td>Nationality</td>
                        <td><?= country_name($application[0]->father_nationality) ?></td>
                    </tr>
                    <tr>
                        <td>Father Previous Nationality</td>
                        <td><?= country_name($application[0]->father_prenationality) ?></td>
                    </tr>
                    <tr>
                        <td>Birth Place</td>
                        <td><?= $application[0]->father_birth_place ?></td>
                    </tr>
                    <tr>
                        <td>Birth Country</td>
                        <td><?= country_name($application[0]->father_country) ?></td>
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">Mother Details</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?= $application[0]->mother_name ?></td>
                    </tr>
                    <tr>
                        <td>Nationality</td>
                        <td><?= country_name($application[0]->mother_nationality) ?></td>
                    </tr>
                    <tr>
                        <td>Mother Previous Nationality</td>
                        <td><?= country_name($application[0]->mother_prenationality) ?></td>
                    </tr>
                    <tr>
                        <td>Birth Place</td>
                        <td><?= $application[0]->mother_birth_place ?></td>

                    </tr>
                    <tr>
                        <td>Birth Country</td>
                        <td><?= country_name($application[0]->mother_country) ?></td> 
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">Merrital Details</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?= $application[0]->marital_status ?></td>

                    </tr>
                    <tr>
                        <td>Spouse name</td>
                        <td><?= $application[0]->spouse_name ?></td>
                    </tr>
                    <tr>
                        <td>Spouse nationality</td>
                        <td><?= country_name($application[0]->spouse_nationlity) ?></td> 
                    </tr>
                    <tr>
                        <td>Spouse Previous Nationality</td>
                        <td><?= country_name($application[0]->spouse_prenationality) ?></td> 
                    </tr>
                    <tr>
                        <td>Spouse Birth Place</td>
                        <td><?= $application[0]->spouse_birth_place ?></td>
                    </tr>
                    <tr>
                        <td>Spouse Country of Birth</td>
                        <td><?= country_name($application[0]->spouse_birth_country) ?></td>
                    </tr> 
                    <tr>
                        <td>Spouse Pre Nationality</td>
                        <td><?= $application[0]->spouse_prenationality ?></td>

                    </tr>
                    <tr>
                        <td>Grand parent pakistan nationals</td>
                        <td><?= $application[0]->grand_parent_pakistan ?></td>
                    </tr>
                    <tr>
                        <td>Grand parent Details</td>
                        <td><?= $application[0]->pakistan_nationality_detail ?></td>
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">Occupation Details</td>
                    </tr>
                    <tr>
                        <td>Occupation</td>
                        <td><?= $application[0]->present_occupation ?></td>
                    </tr>
                    <tr>
                        <td>Employer Name/Business</td>
                        <td><?= $application[0]->Employer_or_business ?></td>
                    </tr>
                    <tr>
                        <td>Employer Name</td>
                        <td><?= $application[0]->designation ?></td>
                    </tr>
                    <tr>
                        <td>Employer Address</td>
                        <td><?= $application[0]->address ?></td>
                    </tr>
                    <tr>
                        <td>Employer Phone</td>
                        <td><?= $application[0]->prof_phone ?></td>
                    </tr>
                    <tr>
                        <td>Previous Occupation</td>
                        <td><?= $application[0]->past_occupation ?></td>
                    </tr>
                    <tr>
                        <td>Security Agency/Organisation</td>
                        <td><?= $application[0]->military ?></td>
                    </tr> 
                    <tr>
                        <td>Militry Organization </td>
                        <td><?= $application[0]->mil_organisation ?></td>
                    </tr>
                    <tr>
                        <td>Militry Designation</td>
                        <td><?= $application[0]->mil_designation ?></td>
                    </tr>
                    <tr>
                        <td>Militry Rank</td>
                        <td><?= $application[0]->mil_rank ?></td>
                    </tr>
                    <tr>
                        <td>Militry Last Posting</td>
                        <td><?= $application[0]->mil_place_of_posting ?></td>
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">Previous Visa/currently Valid Visa Details </td>
                    </tr> 
                    <tr>
                        <td>Visited India Before</td>
                        <td><?= $application[0]->visited_India ?></td>
                    </tr>
                    <tr>
                        <td>Indian Address</td>
                        <td><?= $application[0]->visited_address ?></td>
                    </tr>
                    <tr>
                        <td>indian Visited City</td>
                        <td><?= $application[0]->previously_visited_city ?></td>
                    </tr>
                    <tr>
                        <td>Last Indian Visa NO</td>
                        <td><?= $application[0]->last_Indian_visa_no ?></td>
                    </tr>
                    <tr>
                        <td>Type Of Visa </td>
                        <td><?= $application[0]->visited_type_Visa ?></td>
                    </tr>
                    <tr>
                        <td>Last Indian visa Issue Place</td>
                        <td><?= $application[0]->visited_visa_issue_place ?></td>
                    </tr>
                    <tr>
                        <td>Last Indian visa Issue Date</td>
                        <td><?= get_date($application[0]->visited_visa_issue_date, 'Y-m-d', 'd/m/Y') ?></td>
                    </tr>
                    <tr>
                        <td>Has Permission visit or extend Stay</td>
                        <td><?= $application[0]->extend_visa ?></td>

                    </tr>
                    <tr>
                        <td>Last India Visa extend by whom</td>
                        <td><?= $application[0]->extend_visa_details ?></td>
                    </tr>
                    <tr>
                        <td>Last Indian visa Issue Place</td>
                        <td><?= $application[0]->visited_visa_issue_date ?></td>
                    </tr>
                    <tr>
                        <td>Other Country visited in 10 years</td>
                        <td><?= $application[0]->countries_visitedlast; ?></td> 
                    </tr>
                    <tr class="info-bar" >
                        <td colspan="2">References</td>
                    </tr>
                    <tr>
                        <td>Reference Name</td>
                        <td><?= $application[0]->ref_name ?></td> 
                    </tr>
                    <tr>
                        <td>Address of Sponsor in India</td>
                        <td><?= $application[0]->ref_address ?></td> 
                    </tr>
                    <tr>
                        <td>Phone of Sponsor in India</td>
                        <td><?= $application[0]->ref_phone ?></td> 
                    </tr>
                    <tr>
                        <td>Reference Name in Home Country</td>
                        <td><?= $application[0]->ref_home_name ?></td> 
                    </tr>
                    <tr>
                        <td>Name of Sponsor in Home Country</td>
                        <td><?= $application[0]->ref_home_phone ?></td> 
                    </tr>
                    <tr>
                        <td>Address of Sponsor in Home Country</td>
                        <td><?= $application[0]->ref_home_address ?></td> 
                    </tr> 
                    <tr>
                        <td>Image</td>
                        <td>
                            <?php if ((!empty($application[0]->image)) && (file_exists(APPLICATION_IMG . $application[0]->image))) : ?>
                                <img style="max-height: 200px;" src="<?= base_url(APPLICATION_IMG . $application[0]->image) ?>"/>
                                <br/>
                                <a class="mt10" href="<?= base_url(APPLICATION_IMG . $application[0]->image) ?>" download="<?= base_url(APPLICATION_IMG . $application[0]->image) ?>">Download</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>PassPort</td> 
                        <td>
                            <?php if ((!empty($application[0]->passport_img)) && (file_exists(PASSPORT_IMG . $application[0]->passport_img))) : ?>
                                <img style="max-height: 200px;" src="<?= base_url(PASSPORT_IMG . $application[0]->passport_img) ?>"/> 
                                <br/>
                                <a class="mt10" href="<?= base_url(PASSPORT_IMG . $application[0]->passport_img) ?>" download="<?= base_url(PASSPORT_IMG . $application[0]->passport_img) ?>">Download</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Payment Status</td>
                        <td>
                            <?php
                            $payment_status = $application[0]->payment_status;
                            if ($payment_status == 1) {
                                echo "Payment Done";
                            } else {
                                echo "Payment Panding";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .img-bar { width:200px; height:200px; }
    .info-bar { background-color: orange; color:white; }
</style>