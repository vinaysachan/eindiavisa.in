<?php

class Util {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function cssList($a) {
        $c = '';
        foreach ($a as $s) :
            if (!self::checkValidURL($s))
                $c .= link_tag(base_url($s));
            else
                $c .= link_tag($s);
        endforeach;
        return $c;
    }

    public static function jsList($a) {
        $j = '';
        foreach ($a as $s):
            if (!self::checkValidURL($s))
                $j .= '<script type="text/javascript" src="' . base_url() . $s . '"></script>';
            else
                $j .= '<script type="text/javascript" src="' . $s . '"></script>';
        endforeach;
        return $j;
    }

    public static function checkValidURL($w) {
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $w)) {
            return FALSE;
        } return TRUE;
    }

    /**
     * 
     * @param type $b
     * @param type $class
     * @param type $list
     * @return string
     */
    public function createBreadcrumb($b, $class = 'breadcrumbs', $list = 'ul') {
        $r = '<' . $list . ' class="' . $class . '">';
        foreach ($b as $url => $name) {
            $r .= (!empty($url) && (!is_int($url))) ? '<li><a href="' . $url . '">' . $name . '</a></li>' : '<li>' . $name . '</li>';
        }
        $r .= '</' . $list . '>';
        return $r;
    }

    /**
     * 
     * @param type $algo
     * @param type $data
     * @param type $salt
     * @return type
     */
    public function hash_create($algo, $data, $salt) {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return hash_final($context);
    }

    /**
     * 
     * @param type $path
     * @param type $input_name
     * @param type $title
     * @param type $allowed_types 'jpg|jpeg|png'
     * @param type $resize array ([h],[w])
     * @param type $thumb array (['path] , [[size]=>[w],[h]] )
     * @param type $file_name Name of File
     * @return boolean
     */
    public function fileUpload($path, $input_name, $title, $allowed_types = NULL, $resize = NULL, $thumb = NULL, $file_name = NULL) {
        if (empty($_FILES[$input_name]['name'])) {
            return FALSE;
        } else {
            if (!file_exists($path)) {
                @mkdir($path, 0777, true);
                @chmod($path, 0777);
            }
            if (!empty($file_name)) {
                $fname = pathinfo($file_name, PATHINFO_FILENAME) . '.' . pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION);
                if (pathinfo($file_name, PATHINFO_EXTENSION) == pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION)) {
                    $fname = $file_name;
                }
            } else {
                $fname = underscore($title . '_' . date('YmdHis') . $_FILES[$input_name]['name']);
            }
            $config = [
                'upload_path' => $path,
                'allowed_types' => (empty($allowed_types)) ? '*' : $allowed_types,
                'overwrite' => true,
                'remove_spaces' => true,
                'file_name' => $fname
            ];
            $this->CI->load->library(['image_lib', 'upload']);
            $this->CI->upload->initialize($config);
            if (!$this->CI->upload->do_upload($input_name)) {
                $error = array('error' => $this->CI->upload->display_errors());
                return $error;
//                print_r($error);
            } else {
                $upload_img_data = array('upload_data' => $this->CI->upload->data());
                @chmod($upload_img_data['upload_data']['full_path'], 0777);
                if (!empty($resize)) {
//                    if ($upload_img_data['upload_data']['image_width'] > $resize['w']) {
                    $resize_config = array();
                    $resize_config['image_library'] = 'gd2';
                    $resize_config['source_image'] = $upload_img_data['upload_data']['full_path'];
                    $resize_config['maintain_ratio'] = TRUE;
                    if (!empty($resize['w']))
                        $resize_config['width'] = $resize['w'];
                    if (!empty($resize['h']))
                        $resize_config['height'] = $resize['h'];
                    $this->CI->image_lib->initialize($resize_config);
                    if (!$this->CI->image_lib->resize()) {
                        echo $this->CI->image_lib->display_errors();
                    }
//                    }
                }
                if (!empty($thumb)) {
                    if (!file_exists($thumb['path'])) {
                        @mkdir($thumb['path'], 0777, true);
                        @chmod($thumb['path'], 0777);
                    }
                    $rthum_config = [
                        'image_library' => 'gd2',
                        'source_image' => $upload_img_data['upload_data']['full_path'],
                        'new_image' => $thumb['path'],
                        'maintain_ratio' => TRUE,
                        'width' => $thumb['size']['w']
                    ];
                    if (!empty($thumb['size']['h']))
                        $rthum_config['height'] = $thumb['size']['h'];
                    $this->CI->image_lib->initialize($rthum_config);
                    $this->CI->image_lib->resize();
                }
                return $upload_img_data['upload_data']['file_name'];
            }
        }
    }

    /**
     * 
     * @param type $path
     * @param type $input_name
     * @param type $title
     * @param type $allowed_types 'jpg|jpeg|png'
     * @param type $resize array ([h],[w])
     * @param type $thumb array (['path] , [[h],[w]] )
     * @param type $file_name Name of File
     * @return boolean
     */
    public function filesUpload($path, $input_name, $title, $allowed_types = NULL, $resize = NULL, $thumb = NULL, $file_name = NULL) {
        if (empty($_FILES[$input_name]['name'][0])) {
            return FALSE;
        } else {
            if (!file_exists($path)) {
                @mkdir($path, 0777, true);
                @chmod($path, 0777);
            }
            $config = [
                'upload_path' => $path,
                'allowed_types' => (empty($allowed_types)) ? '*' : $allowed_types,
                'overwrite' => true,
                'remove_spaces' => true
            ];
            $images = array();
            $this->CI->load->library('upload');
            $this->CI->load->library('image_lib');
            $files = $_FILES;
            $count = count($_FILES[$input_name]['name']);
            for ($i = 0; $i < $count; $i++) {
                if (!empty($file_name)) {
                    $fileName = pathinfo($file_name, PATHINFO_FILENAME) . $i . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                } else {
                    $fileName = underscore($title . '_' . time() . $files[$input_name]['name'][$i]);
                }
                $_FILES[$input_name]['type'] = $files[$input_name]['type'][$i];
                $_FILES[$input_name]['tmp_name'] = $files[$input_name]['tmp_name'][$i];
                $_FILES[$input_name]['error'] = $files[$input_name]['error'][$i];
                $_FILES[$input_name]['size'] = $files[$input_name]['size'][$i];
                $images[] = $fileName;
                $config['file_name'] = underscore($fileName);
                $this->CI->upload->initialize($config);
                if ($this->CI->upload->do_upload($input_name)) {
                    $upload_img_data = array('upload_data' => $this->CI->upload->data());
                    if (!empty($resize)) {
                        if ($upload_img_data['upload_data']['image_width'] > $resize['w']) {
                            $resize_config = array();
                            $resize_config['image_library'] = 'gd2';
                            $resize_config['source_image'] = $upload_img_data['upload_data']['full_path'];
                            $resize_config['maintain_ratio'] = TRUE;
                            $config['create_thumb'] = TRUE;
                            $resize_config['width'] = $resize['w'];
                            $resize_config['height'] = $resize['h'];
                            $this->CI->image_lib->initialize($resize_config);
                            $this->CI->image_lib->resize();
                        }
                    }
                    if (!empty($thumb)) {
                        if (!empty($thumb['path']) && !file_exists($thumb['path'])) {
                            @mkdir($thumb['path'], 0777, true);
                            @chmod($thumb['path'], 0777);
                        }
                        $rthum_config = [
                            'image_library' => 'gd2',
                            'source_image' => $upload_img_data['upload_data']['full_path'],
                            'new_image' => $thumb['path'],
                            'maintain_ratio' => TRUE,
                            'width' => $thumb['size']['w']
                        ];
                        if (!empty($thumb['size']['h']))
                            $rthum_config['height'] = $thumb['size']['h'];
                        $this->CI->image_lib->initialize($rthum_config);
                        $this->CI->image_lib->resize();
                    }
                    $emp_photo[] = $upload_img_data['upload_data']['file_name'];
                } else {
                    $this->CI->upload->display_errors('', '');
                    $return['status'] = 'danger';
                }
            }
            return $emp_photo;
        }
    }

    public function return_msg_box($msg_type) {
        $msg = $this->CI->session->flashdata($msg_type);
        if (is_array($msg)) {
            list($h, $m) = $msg;
            $fm = '<div role="alert" class="alert ' . $msg_type . ' alert-dismissible"> <a aria-label="Close" data-dismiss="alert" class="closed fa fa-times pull-right"></a><h6>' . $h . '</h6><p>' . urldecode($m) . '</p></div>';
        } else {
            $fm = '<div role="alert" class="alert  ' . $msg_type . ' alert-dismissible"><a aria-label="Close " data-dismiss="alert" class="closed pull-right fa fa-times"></a><p>' . urldecode($msg) . '</p></div>';
        }
        return $fm;
    }

    public function show_flash_message() {
        $this->CI->load->library('session');
        if (!empty($this->CI->session->flashdata())) {
            return $this->return_msg_box(array_keys($this->CI->session->flashdata())[0]);
        }
    }

    /**
     * 
     * @param type $l INT (length of output string)
     * @param type $t
     * @return type STRING (X1234ABC)
     */
    public function random_string($l = 6, $t = 'alnum') {
        switch ($t) {
            case 'alpha': $pool = 'abcdefghijklmnopqrstuvwxyz';
                break;
            case 'alnum': $pool = '0123456789abcdefghijklmnopqrstuvwxyz';
                break;
            case 'numeric': $pool = '0123456789';
                break;
            case 'nozero': $pool = '123456789';
                break;
        }
        return (!is_int($l)) ? FALSE : substr(str_shuffle(str_repeat($pool, ceil($l / strlen($pool)))), 0, $l);
    }

    /**
     * 
     * @return Public ip of client
     */
    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        elseif (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        elseif (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        elseif (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        elseif (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        elseif (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     * Return array as concatenated string
     * @param type $arr ['vinay ', 'singh', 'sachan'] // vinay, singh, sachan
     * @param type $arr ['vinay ', ' ', 'sachan'] // vinay, sachan
     * @param type $arr ['vinay ', ' ', ' '] // vinay
     * @param type $im
     * @return type
     * @uses $this->util->get_concatenated_string($ar, ', '); 
     */
    public function get_concatenated_string($arr, $im = ' ') {
        return implode($im, array_filter(array_map('trim', $arr)));
    }

    public function all_page_list() {
        
    }

}
