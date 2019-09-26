<?php

class Home extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [
            'heading' => 'Dashboard',
            'sub_heading' => '',
            'breadcrumb' => [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Dashborad']
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function login() {
        if (!empty($this->session->userdata(SESSION_ADMIN))) {
            redirect(base_url('admin'));
            exit();
        }
        if (!empty($this->input->post('submit')) && ($this->input->post('submit') == 'login')) {
            $post = $this->input->post();
            unset($post['submit']);
            if ($this->operation_model->do_login($post)) {
                $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton! Login successfull', 'Congratulaton! Login successfull']);
                echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => 'Congratulaton Login successfull.', 'url' => base_url('admin')]);
            } else {
                echo json_encode(['sts' => STATUS_ERROR, 'msg' => 'Password and username not match']);
            }
            exit();
        }
        $this->append_jc([
            'js' => ['public/js/admin/home/login.js'],
            'css' => ['public/css/admin/login.css']]);

        $data = [
            'title' => 'Admin Login',
            'heading' => 'Please sign in',
        ];
        $this->load->view('admin/admin_login_view', array_merge($this->data, $data));
    }

    public function logout() {
        $this->session->unset_userdata(SESSION_ADMIN);
        redirect(base_url('admin/login'));
        exit();
    }

    public function my_profile() {
        $this->append_jc(['js' => ['public/js/admin/profile.js']]);
        //Update Admin Profile
        if (!empty($this->input->post('update_profile'))) {
            $post = $this->input->post();
            unset($post['update_profile']);
            if ($this->operation_model->update_account($post, $this->session->userdata(SESSION_ADMIN)['id'])) {
                $this->session->set_flashdata(SUCCESS_MSG, 'You have successfully updated your profile.');
                redirect(base_url('admin/home/my_profile'));
            }
        }
        //Update Admin password
        if (!empty($this->input->post('update_password'))) {
            $post = $this->input->post();
            unset($post['update_password']);
            echo json_encode($this->operation_model->update_account_password($post, $this->session->userdata(SESSION_ADMIN)['id']));
            exit();
        }
        $data = [
            'heading' => 'Update Profile',
            'breadcrumb' => [
                base_url('ops-admin') => '<i class="fa fa-dashboard"></i> Home',
                'Update Profile'
            ],
            'profile' => $this->operation_model->getAdminById($this->session->userdata(SESSION_ADMIN)['id'])
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function enquiry($status = STATUS_IN_ACTIVE, $page = NULL) {
        if ($status == STATUS_IN_ACTIVE) {
            $heading = '<i class="fa fa-envelope-o mr10"></i> New Enquiries';
        } else {
            $status == STATUS_ACTIVE;
            $heading = '<i class="fa fa-envelope-open-o mr10"></i> Closed Enquiries';
        }
        $this->load->library('paginator');
        $this->paginator->initialize([
            'base_url' => base_url('admin/home/enquiry/' . $status),
            'total_items' => (int) $this->global_model->getEnqs(NULL, NULL, 'count', $status),
            'current_page' => $page
        ]);
        $limit = $this->paginator->limit_end;
        $offset = $this->paginator->limit_start;
        $data = [
            'heading' => $heading,
            'sub_heading' => '',
            'page' => $offset,
            'status' => $status,
            'breadcrumb' => [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Enquiry'],
            'enqs' => $this->global_model->getEnqs($offset, $limit, NULL, $status)
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function change_sts() {
        if ($this->global_model->change_status($this->input->post('sts'), $this->input->post('id'))) {
            $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Your Enquiry status change successfully.']);
            echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => 'Your Enquiry status change successfully.']);
        } else {
            echo json_encode(['sts' => STATUS_ERROR, 'msg' => 'Unable to change Enquiry status.']);
        }
        exit();
    }

    function applicationDetails($page = NULL) {
        $heading = '<i class="fa fa-envelope-o mr10"></i> Visa Applications';

        $this->load->library('paginator');
        $this->paginator->initialize([
            'base_url' => base_url('admin/home/applicationDetails'),
            'total_items' => (int) $this->global_model->getApplication(NULL, NULL, 'count'),
            'current_page' => $page
        ]);
        $limit = $this->paginator->limit_end;
        $offset = $this->paginator->limit_start;
        $data = [
            'heading' => $heading,
            'page' => $offset,
            'sub_heading' => '',
            'getCounrty' => $this->setting_model->get_country_cache(['where' => ['status' => STATUS_ACTIVE]]),
            'breadcrumb' => [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Visa Applications'],
            'application' => $this->global_model->getApplication($offset, $limit, NULL),
            'application_type' => $this->setting_model->get_application_type_cache(['where' => ['status' => STATUS_ACTIVE]])
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function appDetails($app_id) {
        $heading = '<i class="fa fa-envelope-o mr10"></i> Application Detail : ' . $app_id;

        $data = [
            'heading' => $heading,
            'sub_heading' => '',
            'breadcrumb' => [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'applicationDetails'],
            'application' => $this->global_model->getAppDetails($app_id)
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function close_sts() {
        if ($this->global_model->close_status($this->input->post('app_id'))) {
            $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Your Application status change successfully.']);
            echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => 'Your Application status change successfully.']);
        } else {
            echo json_encode(['sts' => STATUS_ERROR, 'msg' => 'Unable to change Application status.']);
        }
        exit();
    }
    

}
