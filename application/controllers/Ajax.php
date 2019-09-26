<?php

class Ajax extends CORE_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function sendenq() {
        $post = $this->input->post();
        if ((!empty($post)) && ($this->global_model->save_enq($post))) {
            echo json_encode(['sts' => STATUS_SUCCESS,'title'=>'Your Enquiry sent successfully' ,'msg' => 'We wil get back to you sortly.']);
        } else {
            echo json_encode(['sts' => STATUS_ERROR, 'msg' => 'Unable to save your ENQUIRY']);
        }
        exit();
    }

}
