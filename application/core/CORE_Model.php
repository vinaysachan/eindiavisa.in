<?php

class CORE_Model extends CI_Model {

    protected $_path = APPPATH . "data";
    protected $_page_file = APPPATH . "data/page.json";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

}
