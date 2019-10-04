<?php

/**
 * Description of Admin_Controller
 *
 * @author vinay
 */
class FRONT_Controller extends CORE_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->append_jc(['js' => [
                'public/js/jquery.min.js',
                'public/jquery-ui/jquery-ui.min.js', 
                'public/plugins/bootstrap4/popper/popper.min.js',
                'public/plugins/bootstrap4/js/bootstrap.min.js',
                'public/plugins/jquery_validation/jquery.validate.min.js',
//                'public/plugins/jq-confirm/jquery-confirm.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js',
                'public/js/main.js?version='.VERSION,
                'public/js/site.js?version='.VERSION
            ],
            'css' => [
                'public/jquery-ui/jquery-ui.css',
                'public/jquery-ui/jquery-ui.theme.css', 
                'https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css',
                'public/plugins/bootstrap4/css/bootstrap.min.css',
                'public/plugins/font-awesome/css/font-awesome.min.css',
                'public/css/front.css?version='.VERSION
            ]
        ]);
 
        $this->load->library('pages');
        $this->data['page_list']            =   $this->pages->get_data();
        $this->data['class']                =   $this->router->fetch_class();
        $this->data['method']               =   $this->router->fetch_method();
        
    }

}
