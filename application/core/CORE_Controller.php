<?php

class CORE_Controller extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'util','image_lib']);
//		$this->load->helper('captcha');
        $this->load->helper(['html', 'utility', 'url', 'form', 'inflector']);

        // Load CSS Files :-
        $this->data['css'] = [];
        // Load JS Files :-
        $this->data['js'] = [];

        $this->load->model([
            'operation_model',
            'setting_model',
            'global_model'
        ]);
    }

    protected function append_jc($jc) {
        $this->data['js'] = (!empty($jc['js'])) ? array_merge($this->data['js'], $jc['js']) : $this->data['js'];
        $this->data['css'] = (!empty($jc['css'])) ? array_merge($this->data['css'], $jc['css']) : $this->data['css'];
    }

}
