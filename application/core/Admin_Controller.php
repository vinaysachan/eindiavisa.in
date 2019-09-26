<?php

/**
 * Description of Admin_Controller
 *
 * @author Vinay Sachan
 */
class Admin_Controller extends CORE_Controller {

//    public $data;

    public function __construct() {
        parent::__construct();

        $this->append_jc(['js' => [
                'public/js/jquery.min.js',
                'public/plugins/bootstrap/js/bootstrap.min.js',
                'public/jquery-ui/jquery-ui.min.js',
                'public/plugins/jquery_validation/jquery.validate.min.js',
                'public/plugins/jq-confirm/jquery-confirm.min.js',
                'public/js/main.js',
                'public/js/admin/admin.js',
                'public/themes/admin/js/script.js'
            ],
            'css' => [
                'public/plugins/bootstrap/css/bootstrap.min.css',
                'public/plugins/font-awesome/css/font-awesome.min.css',
                'public/jquery-ui/jquery-ui.css',
                'public/jquery-ui/jquery-ui.theme.css',
                'public/plugins/jq-confirm/jquery-confirm.css',
                'public/themes/admin/css/style.css'
            ]
        ]);
        
        //Check for Login 
        if ($this->checkLogin()) {
            redirect(base_url('admin/login'));
            exit();
        }
    }

    protected function checkLogin() {
        return ((!in_array($this->router->fetch_method(), ['login', 'logout'])) && (empty($this->session->userdata(SESSION_ADMIN))));
    }

}
