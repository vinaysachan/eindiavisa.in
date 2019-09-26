<?php

class Operation_model extends CORE_Model {

    public function __construct() {
        parent::__construct();
    }

    public function do_Login($data) {
        try {
            $encrypt_pass = $this->util->hash_create('sha256', $data['password'], HASH_PASSWORD_KEY);
            $sql = 'SELECT au.id,au.name,au.username,au.img,au.designation FROM ' . TBL_ADMIN_USER . ' au WHERE au.username = "' . $data['username'] . '" AND au.pass ="'.$encrypt_pass.'" ';
            if ($query = $this->db->query($sql)) {
                if (!empty($u = $query->result())) {
                    $this->session->set_userdata(SESSION_ADMIN, [
                        'id' => $u[0]->id,
                        'name' => $u[0]->name,
                        'username' => $u[0]->username,
                        'designation' => $u[0]->designation,
                        'img' => $u[0]->img,
                    ]);
                    return TRUE;
                }
                return FALSE;
            } else {
                throw new Exception($this->db->error()['message']);
            }
        } catch (Exception $e) {
            $this->global_model->saveErrorLogs($e);
            return FALSE;
        }
    }
    
    public function getAdminById($id) {
        $sql            =   'SELECT * FROM ' . TBL_ADMIN_USER . ' au  WHERE au.id ="' . $id . '"';
        $query          =   $this->db->query($sql);
        return $query->result();
    }
    
    public function update_account_password($data, $id) {
        if ($data['old_password'] == $data['new_password']) {
            return ['sts' => STATUS_ERROR, 'msg' => 'New password can not be same as old password'];
        } else {
            $sql        =   'SELECT u.name, u.pass FROM ' . TBL_ADMIN_USER . ' u WHERE u.id = "' . $id . '" ';
            $query      =   $this->db->query($sql);
            $u          =   $query->result();
            if (empty($u)) {
                return ['sts' => STATUS_ERROR, 'msg' => 'No Account found.'];
            }
            if ($u[0]->pass == $this->util->hash_create('sha256', $data['old_password'], HASH_PASSWORD_KEY)) {
                $encrypt_pass       =   $this->util->hash_create('sha256', $data['new_password'], HASH_PASSWORD_KEY);
                $sql                =   'UPDATE ' . TBL_ADMIN_USER . ' SET pass = "'.$encrypt_pass.'" WHERE id = "' . $id . '"';
                if ($this->db->query($sql)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulations!', 'You have successfully changed your password.']);
                    return ['sts' => STATUS_SUCCESS, 'msg' => 'You have successfully changed your password.'];
                }
                return ['sts' => STATUS_ERROR, 'msg' => 'OK WE WILL CHNAGE PASSWORD'];
            } else {
                return ['sts' => STATUS_ERROR, 'msg' => 'Unable to change password, the old password is not correct.'];
            }
        }
    }

    
    public function update_account($data, $uid) {
        $update_arr             =   [
            'name'                  =>  $data['name'],
            'mobile'                =>  $data['mobile'],
            'designation'           =>  $data['designation'],
            'email'                 =>  $data['email'],
        ];
        $photo                  =   $this->util->fileUpload(ADMIN_PHOTO_PATH, 'photo', $data['name'], 'jpeg|jpg|png');
        if(!empty($photo['error'])) {
            $this->session->set_flashdata(ERROR_MSG, $photo['error']);
            redirect(base_url('admin/home/my_profile'));
        }
        if ($photo) {
            $update_arr['img']  =   $photo;
            //unlink old photo
            $old_img_path       =   ADMIN_PHOTO_PATH . $data['old_photo'];
            if (file_exists($old_img_path))
                @unlink($old_img_path);
        }
        if ($this->db->update(TBL_ADMIN_USER, $update_arr, ['id' => $uid])) {
            //Update Session
            $sdata              =   $this->session->userdata(SESSION_ADMIN);
            $this->session->unset_userdata(SESSION_ADMIN);
            $this->session->set_userdata(SESSION_ADMIN, [
                'id'                =>  $sdata['id'],
                'name'              =>  $data['name'],
                'username'          =>  $sdata['username'],
                'designation'       =>  $data['designation'],
                'img'               =>  ($photo) ? $photo : $data['old_photo'],
            ]);
            return TRUE;
        }
    } 
    
    function app_step1($nationality_code) {
        $data                       = array(
            'app_type'                  =>  $this->input->post('app_type'),
            'fname'                     =>  $this->util->get_concatenated_string([$this->input->post('fname'), $this->input->post('mname')], ' '),
            'lname'                     =>  $this->input->post('lname'),
            'passport_type'             =>  $this->input->post('passportType'),
            'nationality'               =>  $this->input->post('nationality'),
            'portofarrival'             =>  $this->input->post('portofarrival'),
            'passport_no'               =>  $this->input->post('passportno'),
            'dob'                       =>  get_date($this->input->post('dob')),
            'expected_date_arrival'     =>  get_date($this->input->post('date_of_arrival')),
            'email'                     =>  $this->input->post('email'),
            'phone'                     =>  $this->input->post('phone'),
            'visa_type'                 =>  $this->input->post('visa_type'),
            'status'                    =>  1,
            'application_status'        =>  1
        );
        $app_type                   =   $this->setting_model->get_application_type_cache(['where' => ['id' => $this->input->post('app_type')]]) ;
        $data['app_type_name']      =   $app_type[0]->name;
        
        $visa_type                  =   $this->setting_model->get_visa_type_cache(['where' => ['id' => $this->input->post('visa_type')]]) ;
        $data['visa_type_name']     =   $visa_type[0]->name;
        $data['visa_validitiy']     =   $visa_type[0]->validitiy;
        $data['visa_entry']         =   $visa_type[0]->entry;
        $data['visa_currency_code'] =   $visa_type[0]->currency_code;
        $data['visa_amount']        =   $visa_type[0]->amount;
        $this->db->insert(TBL_APPLICATIONS, $data);
        $id                         =   $this->db->insert_id();
        $application                =   $nationality_code . $id;
        $this->db->where('id', $id)->update(TBL_APPLICATIONS, ['app_id' => $application]);
        return $application;
    }

    function get_application_details() {
        $application_id = $this->session->userdata('application_id');
        $this->db->where('app_id', $application_id);
        $query = $this->db->get(TBL_APPLICATIONS);
        return $result = $query->result();
    }

    function set_visa_reg() {
        $curdate                =   date('Y-m-d');
        $identity_certificate   =   $this->input->post('ic');
        $acquire_nationality    =   $this->input->post('acquire_nationality');
        $applicationid          =   $this->input->post('applicationid');
        $have_prev_name         =   $this->input->post('have_previous_name');
        $data                   =   array(
            'lname'                 =>  $this->input->post('surname'),
            'fname'                 =>  $this->input->post('fname'),
            'have_previous_name'    =>  $have_prev_name,
            'sex'                   =>  $this->input->post('sex'),
            'birth_city'            =>  $this->input->post('birthofcity'),
            'two_year_live'         =>  $this->input->post('two_year_live'),
            'passport_no'           =>  $this->input->post('passportno'),
            'birth_country'         =>  $this->input->post('birthofcountry'),
            'national_id'           =>  $this->input->post('natinalid'),
            'religion'              =>  $this->input->post('religion'),
            'visible_identification_marks' =>   $this->input->post('identification'),
            'qualification'         =>  $this->input->post('qualification'),
            'acquire_nationality'   =>  $acquire_nationality,
            'pass_place_of_Issue'   =>  $this->input->post('placeofissue'),
            'pass_date_of_Issue'    =>  get_date($this->input->post('dateofissue')),
            'pass_date_of_expiry'   =>  get_date($this->input->post('dateofexpiry')),
            'ldentity_certificate'  =>  $identity_certificate,
            'last_update'           =>  $curdate,
            'status'                =>  2
        );
        if ($have_prev_name == 'y') {
            $data['prev_name']      =   $this->input->post('prev_name');
            $data['prev_surname']   =   $this->input->post('prev_surname');
        }
        if ($identity_certificate == 'yes') {
            $data['ic_country_of_Issue']    =   $this->input->post('issueofcountry');
            $data['ic_passport_no']         =   $this->input->post('icpassportno');
            $data['ic_date_of_Issue']       =   get_date($this->input->post('icdateofexpiry'));
            $data['ic_place_of_Issue']      =   $this->input->post('icplaceofissue');
            $data['ic_nationality']         =   $this->input->post('icnatinality');
        } else {
            $data['ic_country_of_Issue']    =   '';
            $data['ic_passport_no']         =   '';
            $data['ic_date_of_Issue']       =   null;
            $data['ic_place_of_Issue']      =   '';
            $data['ic_nationality']         =   '';
        }
        if ($acquire_nationality == 'Naturalization') {
            $data['pre_nationality']        =   $this->input->post('prev_nationality');
        }
        $this->db->where('app_id', $applicationid);
        if ($this->db->update(TBL_APPLICATIONS, $data)) {
            return 1;
        }
    }

    function set_visareg3() {
        $curdate = date('Y-m-d');
        $grand_pak = $this->input->post('grand_pak');
        $maritalstatus = $this->input->post('maritalstatus');
        $military = $this->input->post('military');
        $applicationid = $this->input->post('applicationid');
        $data = array(
            'houseno' => $this->input->post('houseno'),
            'city' => $this->input->post('city'),
            'district' => $this->input->post('district'),
            'zipcode' => $this->input->post('zipcode'),
            'mobileno' => $this->input->post('mobileno'),
            'adress_country' => $this->input->post('adress_country'),
            'perma_city' => $this->input->post('pcity'),
            'perma_houseno' => $this->input->post('phouseno'),
            'perma_district' => $this->input->post('pdistrict'),
            'father_nationality' => $this->input->post('father_nationality'),
            'father_name' => $this->input->post('father_name'),
            'father_birth_place' => $this->input->post('fatherbirthplace'),
            'father_country' => $this->input->post('father_country'),
            'father_prenationality' => $this->input->post('father_prenationality'),
            'mother_name' => $this->input->post('mother_name'),
            'mother_nationality' => $this->input->post('mothernationality'),
            'mother_prenationality' => $this->input->post('motherprenationality'),
            'mother_birth_place' => $this->input->post('motherbirthplace'),
            'mother_country' => $this->input->post('mothercountry'),
            'present_occupation' => $this->input->post('occupation'),
            'Employer_or_business' => $this->input->post('Employer_or_business'),
            'designation' => $this->input->post('designation'),
            'address' => $this->input->post('baddress'),
            'prof_phone' => $this->input->post('bPhone'),
            'past_occupation' => $this->input->post('past_occupation'),
            'marital_status' => $maritalstatus,
            'grand_parent_pakistan' => $grand_pak,
            'last_update' => $curdate,
            'military' => $military,
            'status' => 3
        );
        if ($military == 'yes') {
            $data['mil_organisation'] = $this->input->post('morganisation');
            $data['mil_designation'] = $this->input->post('mdesignation');
            $data['mil_rank'] = $this->input->post('rank');
            $data['mil_place_of_posting'] = $this->input->post('posting');
        } else {
            $data['mil_organisation'] = '';
            $data['mil_designation'] = '';
            $data['mil_rank'] = '';
            $data['mil_place_of_posting'] = '';
        }
        if ($maritalstatus == 'Married') {
            $data['spouse_name'] = $this->input->post('spousename');
            $data['spouse_nationlity'] = $this->input->post('spousenationality');
            $data['spouse_prenationality'] = $this->input->post('spouseprenationality');
            $data['spouse_birth_place'] = $this->input->post('spousebirthplace');
            $data['spouse_birth_country'] = $this->input->post('spousecountry');
        }
        if ($grand_pak == 'yes') {
            $data['pakistan_nationality_detail'] = $this->input->post('pakistan_nationality_detail');
        }
        $this->db->where('app_id', $applicationid);
        if ($this->db->update(TBL_APPLICATIONS, $data)) {
            return 1;
        }
    }



    function app_step4($img = NULL) {
        $curdate                    =   date('Y-m-d');
        $visitedbefore              =   $this->input->post('visitedbefore');
        $extendstay                 =   $this->input->post('extendstay');
        $applicationid              =   $this->input->post('applicationid');
        $data                       =   array(
            'app_type'                  =>  $this->input->post('app_type'),
            'expected_date_arrival'     =>  get_date($this->input->post('expected_date_arrival')),
            'port_of_exit'              =>  $this->input->post('port_of_exit'),
            'places_likely_to_visit'    =>  $this->input->post('visitedplace'),
            'visited_India'             =>  $visitedbefore,
            'ref_name'                  =>  $this->input->post('refindia'),
            'ref_address'               =>  $this->input->post('refaddress'),
            'ref_phone'                 =>  $this->input->post('ref_phone'),
            'ref_home_name'             =>  $this->input->post('ref_home'),
            'ref_home_address'          =>  $this->input->post('ref_homeaddress'),
            'ref_home_phone'            =>  $this->input->post('ref_homephone'),
            'image'                     =>  $img,
            'last_update'               =>  $curdate,
            'visited10Countries'        =>  $this->input->post('visited10Countries'),
            'status'                    =>  4
        );
        $app_type                   =   $this->setting_model->get_application_type_cache(['where' => ['id' => $this->input->post('app_type')]]) ;
        $data['app_type_name']      =   $app_type[0]->name;
        
        $visa_type                  =   $this->setting_model->get_visa_type_cache(['where' => ['id' => $this->input->post('visa_type')]]) ;
        $data['visa_type_name']     =   $visa_type[0]->name;
        $data['visa_validitiy']     =   $visa_type[0]->validitiy;
        $data['visa_entry']         =   $visa_type[0]->entry;
        $data['visa_currency_code'] =   $visa_type[0]->currency_code;
        $data['visa_amount']        =   $visa_type[0]->amount;
        
        if ($visitedbefore == 'yes') {
            $data['visited_address']            =   $this->input->post('visitedaddress');
            $data['previously_visited_city']    =   $this->input->post('visitedcities');
            $data['last_Indian_visa_no']        =   $this->input->post('visitedvisano');
            $data['visited_type_Visa']          =   $this->input->post('visitedvisatype');
            $data['visited_visa_issue_place']   =   $this->input->post('visitedplaceissue');
            $data['visited_visa_issue_date']    =   get_date($this->input->post('visitedissuedate'));
        }
        if ($extendstay == 'yes') {
            $data['extend_visa_details']        =   $this->input->post('extendstaydetails');
        } else {
            $data['extend_visa_details']        =   '';
        }
        $this->db->where('app_id', $applicationid);
        if ($this->db->update(TBL_APPLICATIONS, $data)) {
            return 1;
        }
    }
    
    public function uploadpassport($pass_img) {
        $curdate = date('Y-m-d');
        $application_id = $this->session->userdata('application_id');
        $data = array(
            'passport_img' => $pass_img,
            'last_update' => $curdate,
            'status' => 5
        );
        $this->db->where('app_id', $application_id);
        $this->db->update(TBL_APPLICATIONS, $data);
        return TRUE;
    }

    function payment_status($status) {
        $application_id = $this->session->userdata('application_id');
        $curdate = date('Y-m-d');
        $data = array(
            'app_id' => $application_id,
            'payment_status' => $status,
        );
        $result = $this->db->insert(TBL_PAYMENT, $data);
        if ($result) {
            if ($status == 1) { // On Successfull Payment :-
                $data = array(
                    'payment_status' => $status,
                    'last_update' => $curdate,
                    'application_status' => 2
                );
            } else { // Payment Fail
                $data = array(
                    'payment_status' => 2,
                    'last_update' => $curdate,
                    'application_status' => 2
                );
            }
            $this->db->where('app_id', $application_id);
            $this->db->update(TBL_APPLICATIONS, $data);
        }
    }

    function search_app() {
        $appid = $this->input->post('appID');
        $sql = 'SELECT * FROM '.TBL_APPLICATIONS.' WHERE app_id ="' . $appid . '"';
        $query = $this->db->query($sql);
        return $query->result();
    }



}
