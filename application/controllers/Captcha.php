<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Captcha extends CORE_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $captcha = $this->util->random_string(4,'numeric');
        $this->session->set_userdata('captcha', $captcha);
        $data = [
            'captcha' => $captcha
        ];
        $this->load->view('captcha', $data);
    }

    public function check() {
        echo json_encode(['sts' => (($this->session->userdata('captcha') == $this->input->get('val')) ? STATUS_SUCCESS : STATUS_ERROR)]);
        exit();
    }

}

?>