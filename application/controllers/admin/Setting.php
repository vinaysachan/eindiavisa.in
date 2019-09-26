<?php

class setting extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->append_jc(['js' => [
                'public/plugins/ckeditor/ckeditor.js',
                'public/js/admin/setting.js'
            ],
            'css' => []
        ]);
    }
    
    public function banner() {
        $data = [
            'heading' => 'Manage Front Page Banner',
            'sub_heading' => '',
            'breadcrumb' => [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Banners'],
            'banners' => $this->setting_model->get_banners()
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
     
    public function banner_ae($b_id = NULL) {
        if (!empty($this->input->post('submit'))) {
            $post = $this->input->post();
            $img = $this->util->fileUpload(BANNER_PATH, 'img', SITE_NAME, 'jpeg|jpg|png', $resize = ['h' => 400]);
            if ($post['submit'] == 'add') {
                unset($post['submit']);
                if (!empty($img))
                    $post['img'] = base_url(BANNER_PATH.$img);
                if ($this->setting_model->save_banner($post)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Banner Save successfully']);
                    redirect('admin/setting/banner');
                }
            } elseif ($post['submit'] == 'update') {
                $post['status'] = ($post['status'] == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_IN_ACTIVE;
                unset($post['submit']);
                if ($img) {
                    $post['img'] = base_url(BANNER_PATH.$img);
                    //Remove the old Image
                    $old_img = $post['old_img'];
                    //Get the old IMGAE :-
                    $old_img_path   =   ltrim($old_img,base_url());
                    if (file_exists($old_img_path)){
                        @unlink($old_img_path);
                    }
                }
                unset($post['old_img']);
                if ($this->setting_model->update_banner($post, $b_id)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Banner Update successfully']);
                    redirect('admin/setting/banner');
                }
            }
        }
        if (!empty($b_id)) {
            $heading = 'Update Banner';
            $banner = $this->setting_model->get_banners(['where' => ['id' => $b_id]]);
        } else {
            $heading = 'Add New Banner';
            $banner = '';
        }
        $data = [
            'heading' => $heading,
            'sub_heading' => '',
            'breadcrumb' => [
                base_url('admin') => '<i class="fa fa-dashboard"></i> Home',
                base_url('admin/setting/banner') => 'Banners',
                $heading
            ],
            'banner' => $banner
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
    
    public function form_banner() {
        $old_img        =   $this->setting_model->get_setting_value(SETTING_FORM_BANNER);
        if (!empty($this->input->post('submit'))) {
            $return             =   [];
            $img                =   $this->util->fileUpload(BANNER_FORM_PATH, 'img', SITE_NAME, 'jpeg|jpg|png', ['h' => 125]);    
            if (!empty($img['error']) && ($_FILES['img']['size'] != 0)) {
                $return         =   ['sts' => STATUS_ERROR, 'msg' => $img['error']];
                unset($img);
            }
            if(empty($img['error'])) {
                //Get the old IMGAE :-
                $old_img_path   =   ltrim($old_img,base_url());
                if (file_exists($old_img_path)){
                    @unlink($old_img_path);
                }
                //Update Imgae :-
                if($this->setting_model->update_setting_value(SETTING_FORM_BANNER,  base_url(BANNER_FORM_PATH.$img))) {
                    $this->session->set_flashdata(SUCCESS_MSG, 'Banner Save successfully.');
                    $return     =   ['sts' => STATUS_SUCCESS, 'msg' => 'Banner Save successfully.'];
                }
            }
            echo json_encode($return);
            exit();
        }
        $data               = [
            'heading'           =>  'Manage Form Page Banner',
            'sub_heading'       =>  '',
            'breadcrumb'        =>  [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Form Banner'],
            'old_img'           =>  $old_img
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
    
    public function del_banner($b_id = NULL) {
        if (empty($b_id)) {
            $this->session->set_flashdata(WARNING_MSG, ['Warning!', 'Bad URL']);
            redirect('admin/setting/banner');
        }
        $banner = $this->setting_model->get_banners(['where' => ['id' => $b_id]]);
        if (empty($banner)) {
            $this->session->set_flashdata(WARNING_MSG, ['Warning!', 'Previous URL was Bad.']);
            redirect('admin/setting/banner');
        }
        if ($this->setting_model->delete_banner($b_id)) {
            if ($banner[0]->img) {
                //Remove the old Image
                $old_img_path   =   ltrim($banner[0]->img,base_url());
                if (file_exists($old_img_path)) {
                    @unlink($old_img_path);
                }
            }
            $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Banner Deleted successfully']);
            redirect('admin/setting/banner');
        }
    }
    
    public function page($page = NULL) {
        $this->load->library('paginator');
        $this->paginator->initialize([
            'base_url' => base_url('admin/setting/page'),
            'total_items' => (int) $this->setting_model->getPages(NULL, NULL, 'count'),
            'current_page' => $page
        ]);
        $limit = $this->paginator->limit_end;
        $offset = $this->paginator->limit_start;
        $data = [
            'heading' => '<i class="fa fa-television"></i> Manage Page\'s Data',
            'sub_heading' => '',
            'page' => $offset,
            'breadcrumb' => [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Pages'],
            'pages' => $this->setting_model->getPages($offset, $limit, NULL)
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
    
    public function page_ae($pid = NULL) {
        if (!empty($pid)) {
            $heading = '<i class="fa fa-television"></i> Update Page Detail';
            $page_data = $this->setting_model->page_data($pid);
        } else {
            $heading = '<i class="fa fa-television"></i> Add Page Detail';
            $page_data = '';
        }
        $this->load->library('pages');
        if (!empty($this->input->post('save_page'))) {
            $post = $this->input->post();
            $post['menu_location'] = json_encode($post['menu_location']);
            if ($post['save_page'] == 'add') {
                unset($post['save_page']);
                if ($this->setting_model->save_page($post)) {
                    $this->pages->savefile();
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Page Added Successfully']);
                    redirect('admin/setting/page');
                    exit();
                }
            } else if ($post['save_page'] == 'update') {
                unset($post['save_page']);
                if ($this->setting_model->update_page($post, $pid)) {
                    $this->pages->savefile();
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Page Update Successfully']);
                    redirect('admin/setting/page');
                    exit();
                }
            }
        }
        $data = [
            'heading' => $heading,
            'sub_heading' => '',
            'breadcrumb' => [
                base_url('admin') => '<i class="fa fa-dashboard"></i> Home',
                $heading
            ],
            'pid' => $pid,
            'all_pages' => $this->setting_model->all_available_pages(),
            'all_saved_page' => $this->setting_model->all_saved_page(),
            'page_data' => $page_data
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function trash_page($id = NULL) {
        if (empty($id)) {
            $this->session->set_flashdata(WARNING_MSG, ['Warning!', 'Bad URL']);
            redirect('admin/setting/page');
        }
        if ($this->setting_model->delete_page($id)) {
            $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Page Deleted successfully']);
            redirect('admin/setting/page');
        }
    }
    
    public function application_type() {
        $data = [
            'heading' => '<i class="fa fa-television"></i> Application Type',
            'sub_heading' => '',
            'application_type' => $this->setting_model->get_application_type(),
            'breadcrumb' => [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Application Type']
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
    
    public function app_type_ae($a_id = NULL) {
        if (!empty($this->input->post('submit'))) {
            $post           =   $this->input->post();
            if ($post['submit'] == 'add') {
                unset($post['submit']);
                if ($this->setting_model->save_application_type($post)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Application Type Save successfully']);
                    redirect('admin/setting/application_type');
                }
            } elseif ($post['submit'] == 'update') {
                $post['status'] = ($post['status'] == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_IN_ACTIVE;
                unset($post['submit']);
                if ($this->setting_model->update_application_type($post, $a_id)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Application Type Update successfully']);
                    redirect('admin/setting/application_type');
                }
            }
        }
        if (!empty($a_id)) {
            $heading            =   'Update Application Type';
            $app_type           =   $this->setting_model->get_application_type(['where' => ['id' => $a_id]]);
        } else {
            $heading            =   'Add New Application Type';
            $app_type           =   '';
        }
        $data                   =   [
            'heading'               =>  $heading,
            'sub_heading'           =>  '',
            'breadcrumb'            =>  [
                base_url('admin')                               => '<i class="fa fa-dashboard"></i> Home',
                base_url('admin/setting/application_type')      => 'Application Types',
                $heading
            ],
            'app_type'          =>  $app_type
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
     
    public function country() {
         $data                  =   [
            'heading'               =>  '<i class="fa fa-map"></i> List of countries',
            'sub_heading'           =>  '',
            'country'               =>  $this->setting_model->get_country(),
            'breadcrumb'            =>  [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Country']
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function change_country_sts() {
        if ($this->setting_model->change_country_status($this->input->post('sts'), $this->input->post('id'))) {
            $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Your Country changre successfully.']);
            echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => 'Your Country status changre successfully.']);
        } else {
            echo json_encode(['sts' => STATUS_ERROR, 'msg' => 'Unable to change Country status.']);
        }
        exit();
    }
    
    public function arrival_port() {
        $data                   =   [
            'heading'               =>  '<i class="fa fa-plane"></i> Port Of Arrival',
            'sub_heading'           =>  '',
            'ports'                 =>  $this->setting_model->get_arrival_port(),
            'breadcrumb'            =>  [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Port Of Arrival']
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
    
    public function arrival_port_ae($id=NULL) {
        if (!empty($this->input->post('submit'))) {
            $post           =   $this->input->post();
            if ($post['submit'] == 'add') {
                unset($post['submit']);
                if ($this->setting_model->save_arrival_port($post)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Port Of Arrival Save successfully']);
                    redirect('admin/setting/arrival_port');
                }
            } elseif ($post['submit'] == 'update') {
                $post['status'] = ($post['status'] == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_IN_ACTIVE;
                unset($post['submit']);
                if ($this->setting_model->update_arrival_port($post, $id)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Port Of Arrival Update successfully']);
                    redirect('admin/setting/arrival_port');
                }
            }
        }
        if (!empty($id)) {
            $heading            =   'Update Port Of Arrival';
            $port               =   $this->setting_model->get_arrival_port(['where' => ['id' => $id]]);
        } else {
            $heading            =   'Add New Port Of Arrival';
            $port               =   '';
        }
        $data                   =   [
            'heading'               =>  $heading,
            'sub_heading'           =>  '',
            'breadcrumb'            =>  [
                base_url('admin')                               => '<i class="fa fa-dashboard"></i> Home',
                base_url('admin/setting/arrival_port')          => 'Arrival Ports',
                $heading
            ],
            'port'              =>  $port
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
       
    public function blog($page = NULL) {
        $heading                    =   '<i class="fa fa-envelope-o mr10"></i> Blog List';
        $this->load->library('paginator');
        $this->paginator->initialize([
            'base_url'              =>  base_url('admin/setting/blog'),
            'total_items'           =>  (int) $this->setting_model->getBlogsListing(NULL, NULL, 'count'),
            'current_page'          =>  $page
        ]);
        $limit                      =   $this->paginator->limit_end;
        $offset                     =   $this->paginator->limit_start;
        $data = [
            'heading'               =>  $heading,
            'page'                  =>  $offset,
            'sub_heading'           =>  '',
            'breadcrumb'            =>  [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Blogs'],
            'blogs'                 =>  $this->setting_model->getBlogsListing($offset, $limit, NULL)
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function blog_ae($blog_id = NULL) {
        if (!empty($blog_id)) {
            $heading                =   '<i class="fa fa-television"></i> Update Blog Detail';
            $blog_data              =   $this->setting_model->blog_data($blog_id);
            $blog_content_data      =   $this->setting_model->blog_content_data($blog_id);
        } else {
            $heading                =   '<i class="fa fa-television"></i> Add New Blog';
            $blog_data              =   '';
            $blog_content_data      =   '';
        }

        if (!empty($this->input->post('action')) && ($this->input->post('action') == 'delete_bcd')) {
            $blog_content_id        =   $this->input->post('blog_content_id');
            //Get the Detail of this Blog COntent :- 
            $blog_content           =   $this->setting_model->get_blog_content_by_id($blog_content_id);

            if($blog_content->type == 'image') {
                //Delete the imgae :- 
                $trash_img          =   $blog_content->content ;
                $trash_img_path     =   str_replace(base_url(), "", $trash_img);
                if (file_exists($trash_img_path)) {
                    @unlink($trash_img_path);
                }
            }
            //Remove the Contente :-
            if($this->setting_model->delete_blog_content($blog_content_id)) {
                $msg                    =   'Blog Content data delete successfully.';
                $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', $msg]);
                echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => $msg]);
                exit();
            }
        }
        if (!empty($this->input->post('save_blog'))) {
            $post                       =   $this->input->post();
            if ($post['save_blog'] == 'add') {
                unset($post['save_blog'], $post['blog_id']);
                $check_data             =   $this->setting_model->check_blog($post);
                if ($check_data['status'] == STATUS_ERROR) {
                    echo json_encode(['sts' => STATUS_ERROR, 'msg' => $check_data['msg']]);
                    exit();
                } else {
                    if (!empty($_FILES['img']['name'])) {
                        $img            =   $this->util->fileUpload(BLOG_PATH, 'img', SITE_NAME, 'jpeg|jpg|png');
                    }
                    if (!empty($img['error'])) {
                        echo json_encode(['sts' => STATUS_ERROR, 'msg' => $img['error']]);
                        exit();
                    }
                    if (!empty($img)) {
                        $post['img']    =   base_url(BLOG_PATH . $img);
                    }
                    if ($bid = $this->setting_model->save_blog($post)) {
                        $msg            =   'Blog data save successfully. Now Please add blog content.';
                        $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', $msg]);
                        echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => $msg, 'url' => base_url('admin/setting/blog_ae/' . $bid)]);
                        exit();
                    }
                }
            } elseif ($post['save_blog'] == 'update') {
                unset($post['save_blog'], $post['blog_id']);
                $check_data             =   $this->setting_model->check_blog($post, $blog_id);
                if ($check_data['status'] == STATUS_ERROR) {
                    echo json_encode(['sts' => STATUS_ERROR, 'msg' => $check_data['msg']]);
                    exit();
                } else {
                    if (!empty($_FILES['img']['name'])) {
                        $img            =   $this->util->fileUpload(BLOG_PATH, 'img', SITE_NAME, 'jpeg|jpg|png');
                    }
                    if (!empty($img['error'])) {
                        echo json_encode(['sts' => STATUS_ERROR, 'msg' => $img['error']]);
                        exit();
                    }
                    if (!empty($img)) {
                        $post['img']    =   base_url(BLOG_PATH . $img);
                        //Remove the old Image
                        $old_img        =   $post['old_img'];
                        //Get the old IMGAE :-
                        $old_img_path   =   ltrim($old_img, base_url());
                        if (file_exists($old_img_path)) {
                            @unlink($old_img_path);
                        }
                    }
                    unset($post['old_img']);
                    if ($this->setting_model->update_blog($post, $blog_id)) {
                        $msg            =   'Blog data update successfully. Now Please check blog content.';
                        $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', $msg]);
                        echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => $msg, 'url' => base_url('admin/setting/blog_ae/' . $blog_id)]);
                        exit();
                    }
                }
            }
        }
        if (!empty($this->input->post('save_blog_content'))) {
            $post                       =   $this->input->post();
            $data                       =   [];
            $data['type']               =   $post['type'];
            $data['blog_id']            =   $post['blog_id'];
            $blog_content_id            =   $post['blog_content_id'];
            
            if($post['type'] == 'image') {
            	if (!empty($_FILES['page_content']['name'])) {
                        $img            =   $this->util->fileUpload(BLOG_PATH, 'page_content', SITE_NAME, 'jpeg|jpg|png');
                }
                if (!empty($img['error'])) {
                    echo json_encode(['sts' => STATUS_ERROR, 'msg' => $img['error']]);
                    exit();
                }
                if (!empty($img)) {
                    $data['content']    =   base_url(BLOG_PATH . $img);
                    if(!empty($post['old_img'])) {
                        //Remove the old Image
                        $old_img            =   $post['old_img'];
                        //Get the old IMGAE :-
                        $base_url           =   base_url();
                        $old_img_path       =   str_replace($base_url, "", $old_img);
                        if (file_exists($old_img_path)) {
                            @unlink($old_img_path);
                        }
                    }
                }
            } elseif($post['type'] == 'content') {
                $data['content']        =   dataready($post['page_content']);
            }
            if(empty($data['content'])) {
                echo json_encode(['sts' => STATUS_ERROR, 'msg' => 'No Blog Content data to Add / update.']);
                exit();
            }
            if($this->setting_model->save_blog_content($data,$blog_content_id)){
                $msg                    =   'Blog Content data save successfully.';
                $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', $msg]);
                echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => $msg, 'url' => base_url('admin/setting/blog_ae/' . $data['blog_id'])]);
                exit();
            }
        }
        $data                       =   [
            'heading'                   =>  $heading,
            'sub_heading'               =>  '',
            'breadcrumb'                =>  [
                base_url('admin')           => '<i class="fa fa-dashboard"></i> Home',
                $heading
            ],
            'blog_id'                   =>  $blog_id,
            'blog_data'                 =>  $blog_data,
            'blog_content_data'         =>  $blog_content_data
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }

    public function trash_blog($bid=NULL) {
        if(empty($bid)) {
            $msg                    =   'Blog id can not empty.';
            $this->session->set_flashdata(ERROR_MSG, ['Congratulaton!', $msg]);
            redirect(base_url('/admin/setting/blog'));
        }
        //Get the Blog & Blog Contents :-
        $blog_contents              =   $this->setting_model->blog_content_data($bid);
        if(!empty($blog_contents)) {
            foreach ($blog_contents as $bc) {
                if($bc->type == 'image') {
                    //Remove all image :-
                    $img_path       =   str_replace(base_url(), "", $bc->content);
                    if (file_exists($img_path)) {
                        @unlink($img_path);
                    } 
                }
            }
        }
        if($this->setting_model->trash_blog($bid)) {
            $msg                    =   'Blog deleted successfully.';
            $this->session->set_flashdata(ERROR_MSG, ['Congratulaton!', $msg]);
            redirect(base_url('/admin/setting/blog'));
        }
    }

    public function save_seo() {
        $post                       =   $this->input->post();
        unset($post['save_blog_meta']);
        if($this->setting_model->save_seo_data($post)) {
            $msg                    =   'Meta Save successfully' ;
        } else {
            $msg                    =   'Unable to save meta successfully' ;
        }
        echo json_encode(['sts' => STATUS_SUCCESS, 'msg' => $msg]);
        exit();
    }

    public function get_seo_data($slug) {
        $data                       =   $this->setting_model->seo_meta_data($slug);
        echo json_encode(['sts' => STATUS_SUCCESS, 'data' => $data]);
        exit();
    }
 
    public function visa_type() {
        $data = [
            'heading'       =>  '<i class="fa fa-television"></i> Visa Type',
            'sub_heading'   =>  '',
            'visa_types'    =>  $this->setting_model->get_visa_type(),
            'breadcrumb'    =>  [base_url('admin') => '<i class="fa fa-dashboard"></i> Home', 'Visa Type']
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
    
    public function visa_type_ae($vid = NULL) {
        if (!empty($this->input->post('submit'))) {
            $post           =   $this->input->post();
             if ($post['submit'] == 'add') {
                unset($post['submit']);
                if ($this->setting_model->save_visa_type($post)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Visa Type Save successfully']);
                    redirect('admin/setting/visa_type');
                }
            } elseif ($post['submit'] == 'update') {
                $post['status'] = ($post['status'] == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_IN_ACTIVE;
                unset($post['submit']);
                if ($this->setting_model->update_visa_type($post, $vid)) {
                    $this->session->set_flashdata(SUCCESS_MSG, ['Congratulaton!', 'Visa Type Update successfully']);
                    redirect('admin/setting/visa_type');
                }
            }
        }
        if (!empty($vid)) {
            $heading            =   'Update Visa Type';
            $visa_type           =   $this->setting_model->get_visa_type(['where' => ['id' => $vid]]);
        } else {
            $heading            =   'Add New Visa Type';
            $visa_type           =   '';
        }
        $data                   =   [
            'heading'               =>  $heading,
            'application_types'     =>  $this->setting_model->get_application_type(['where' => ['status' => 1]]),
            'sub_heading'           =>  '',
            'breadcrumb'            =>  [
                base_url('admin')                               => '<i class="fa fa-dashboard"></i> Home',
                base_url('admin/setting/visa_type')             => 'Visa Types',
                $heading
            ],
            'visa_type'          =>  $visa_type
        ];
        $this->load->view('templates/admin.tpl', array_merge($this->data, $data));
    }
    

}
