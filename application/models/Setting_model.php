<?php

class Setting_model extends CORE_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_banners($data = NULL) {
        $this->db->select();
        $this->db->from(TBL_BANNERS . ' as b');

        if (!empty($data['where']['id'])) {
            $this->db->where('id', $data['where']['id']);
        }
        if (!empty($data['where']['status'])) {
            $this->db->where('status', $data['where']['status']);
        }

        $this->db->order_by("order", "ASC");
        return $this->db->get()->result();
    }

    public function get_banners_cache($data = NULL) {
        $this->db->cache_on();
        $result = $this->get_banners($data);
        $this->db->cache_off();
        return $result;
    }

    public function save_banner($data) {
        $this->db->cache_delete_all();
        if ($this->db->insert(TBL_BANNERS, $data))
            return TRUE;
        return FALSE;
    }

    public function update_banner($data, $b_id) {
        $this->db->cache_delete_all();
        if ($this->db->update(TBL_BANNERS, $data, ['id' => $b_id]))
            return TRUE;
        return FALSE;
    }

    public function delete_banner($b_id) {
        $this->db->cache_delete_all();
        if ($this->db->delete(TBL_BANNERS, ['id' => $b_id]))
            return TRUE;
        return FALSE;
    }

    public function getPages($offset = NULL, $limit = NULL, $count = NULL) {
        $this->db->select();
        $this->db->from(TBL_PAGES);
        if (!empty($count)) {
            return $this->db->get()->num_rows();
        } else {
            $this->db->order_by('slug', 'DESC');
            $this->db->limit($limit, $offset);
            return $this->db->get()->result();
        }
    }

    public function save_page($data) {
        $this->db->cache_delete_all();
        if ($this->db->insert(TBL_PAGES, $data))
            return TRUE;
        return FALSE;
    }

    public function page_data($pid) {
        $sql = 'SELECT *, (SELECT GROUP_CONCAT(slug) FROM '.TBL_PAGES.') as all_slugs FROM '.TBL_PAGES.' p WHERE p.id = "' . $pid . '"';
        if ($query = $this->db->query($sql)) {
            return $query->result();
        }
        return FALSE;
    }

    public function all_saved_page() {
        $sql = 'SELECT GROUP_CONCAT(slug) as all_slugs FROM '.TBL_PAGES;
        if ($query = $this->db->query($sql)) {
            return $query->result();
        }
        return FALSE;
    }

    public function all_available_pages() {
        if (file_exists($this->_page_file)) {
            $str = @file_get_contents($this->_page_file);
            return json_decode($str, true);
        }
    }

    public function page_name_by_slug($slug) {
        if (file_exists($this->_page_file)) {
            $str = @file_get_contents($this->_page_file);
            return json_decode($str, true)[$slug];
        }
    }

    public function update_page($data, $id) {
        $this->db->cache_delete_all();
        if ($this->db->update(TBL_PAGES, $data, ['id' => $id]))
            return TRUE;
        return FALSE;
    }

    public function delete_page($id) {
        $this->db->cache_delete_all();
        if ($this->db->delete(TBL_PAGES, ['id' => $id]))
            return TRUE;
        return FALSE;
    }

    public function get_application_type($data = NULL) {
        $this->db->select();
        $this->db->from(TBL_APPLICATION_TYPE . ' as at');
        if(!empty($data)) {
            if (!empty($data['where']['id'])) {
                $this->db->where('id', $data['where']['id']);
            }
            if (!empty($data['where']['status'])) {
                $this->db->where('status', $data['where']['status']);
            }
        }
        $this->db->order_by("order", "ASC");
        return $this->db->get()->result();
    }

    public function get_application_type_cache($data = NULL) {
        $this->db->cache_on();
        $result = $this->get_application_type($data);
        $this->db->cache_off();
        return $result;
    }
    
    public function save_application_type($data) {
        $this->db->cache_delete_all();
        if ($this->db->insert(TBL_APPLICATION_TYPE, $data))
            return TRUE;
        return FALSE;
    }

    public function update_application_type($data, $b_id) {
        $this->db->cache_delete_all();
        if ($this->db->update(TBL_APPLICATION_TYPE, $data, ['id' => $b_id]))
            return TRUE;
        return FALSE;
    }
    
    
    public function get_visa_type($data = NULL) {
        $this->db->select('vt.*,at.name as application_type_name');
        $this->db->from(TBL_VISA_TYPE . ' as vt');
        $this->db->join(TBL_APPLICATION_TYPE .' as at' , 'at.id = vt.application_type_id');
        if(!empty($data)) {
            if (!empty($data['where']['id'])) {
                $this->db->where('vt.id', $data['where']['id']);
            }
            if (!empty($data['where']['application_type_id'])) {
                $this->db->where('vt.application_type_id', $data['where']['application_type_id']);
            }
            if (!empty($data['where']['status'])) {
                $this->db->where('vt.status', $data['where']['status']);
            }
        }
        $this->db->order_by("vt.name", "ASC")->order_by("vt.validitiy", "ASC")->order_by("vt.application_type_id", "ASC")->order_by("vt.order_list", "ASC");
        return $this->db->get()->result();
    }

    public function get_visa_type_cache($data = NULL) {
        $this->db->cache_on();
        $result = $this->get_visa_type($data);
        $this->db->cache_off();
        return $result;
    }
    
    public function save_visa_type($data) {
        $this->db->cache_delete_all();
        if ($this->db->insert(TBL_VISA_TYPE, $data))
            return TRUE;
        return FALSE;
    }
    
    public function update_visa_type($data, $vid) {
        $this->db->cache_delete_all();
        if ($this->db->update(TBL_VISA_TYPE, $data, ['id' => $vid]))
            return TRUE;
        return FALSE;
    }
 
    public function get_country_cache($data = NULL) {
        $this->db->cache_on();
        $this->db->select();
        $this->db->from(TBL_COUNTRY);

        if (!empty($data['where']['id'])) {
            $this->db->where('id', $data['where']['id']);
        }
        if (!empty($data['where']['status'])) {
            $this->db->where('status', $data['where']['status']);
        }
        $result = $this->db->get()->result();
        $this->db->cache_off();
        return $result;
    }

    public function get_country($data = NULL) {
        $this->db->select();
        $this->db->from(TBL_COUNTRY);

        if (!empty($data['where']['id'])) {
            $this->db->where('id', $data['where']['id']);
        }
        if (!empty($data['where']['status'])) {
            $this->db->where('status', $data['where']['status']);
        }
        return $this->db->get()->result();
    }

    public function change_country_status($status, $id) {
        $this->db->cache_delete_all();
        if ($this->db->update(TBL_COUNTRY, ['status' => $status], ['id' => $id]))
            return TRUE;
        return FALSE;
    }

    public function get_arrival_port($data = NULL) {
        $this->db->select();
        $this->db->from(TBL_ARRIVAL_PORT);

        if (!empty($data['where']['id'])) {
            $this->db->where('id', $data['where']['id']);
        }
        if (!empty($data['where']['status'])) {
            $this->db->where('status', $data['where']['status']);
        }
        return $this->db->get()->result();
    }

    public function get_arrival_port_cache($data = NULL) {
        $this->db->cache_on();
        $result = $this->get_arrival_port($data);
        $this->db->cache_off();
        return $result;
    }

    public function save_arrival_port($data) {
        $this->db->cache_delete_all();
        if ($this->db->insert(TBL_ARRIVAL_PORT, $data))
            return TRUE;
        return FALSE;
    }

    public function update_arrival_port($data, $id) {
        $this->db->cache_delete_all();
        if ($this->db->update(TBL_ARRIVAL_PORT, $data, ['id' => $id]))
            return TRUE;
        return FALSE;
    }

    public function get_setting_value($key) {
        $this->db->select();
        $this->db->from(TBL_SETTING . ' as s');
        $this->db->where('key', $key);
        $data = $this->db->get()->row();
        if (!empty($data)) {
            return $data->value;
        }
        return NULL;
    }

    public function update_setting_value($key, $value) {
        if ($this->db->update(TBL_SETTING, ['value' => $value], ['key' => $key]))
            return TRUE;
        return FALSE;
    }
     public function save_blog($data) {
        $this->db->cache_delete_all();
        if ($this->db->insert(TBL_BLOG, $data))
            return $this->db->insert_id();
        return FALSE;
    }
    
    public function update_blog($data, $id) {
        $this->db->cache_delete_all();
        if ($this->db->update(TBL_BLOG, $data, ['id' => $id]))
            return TRUE;
        return FALSE;
    }
    
    public function check_blog($data,$blog_id=NULL) {
        $msg = '';
        $this->db->select();
        $this->db->from(TBL_BLOG);
        if (!empty($blog_id)) {
            $this->db->where('id !=', $blog_id);
        }
        $where_au = '(slug = "'.$data['slug'].'" OR heading = "'.$data['slug'].'")';
        $this->db->where($where_au);
        $data =  $this->db->get()->result();
        if (!empty($data)) {
            $msg    = 'Blog Url , Blog Title or Heading already exist';
        }
        if(empty($msg)) {
            return ['status' => STATUS_SUCCESS];
        } else {
            return ['status' => STATUS_ERROR, 'msg' => $msg];
        }
    }
    
    public function blog_data($bid) {
        $sql = 'SELECT * FROM '.TBL_BLOG.' WHERE id = "' . $bid . '"';
        if ($query = $this->db->query($sql)) {
            return $query->result();
        }
        return FALSE;
    }
    
    public function save_blog_content($content_data,$blog_content_id=NULL) {
        $this->db->cache_delete_all();
        if(empty($blog_content_id)) {
            $this->db->insert(TBL_BLOG_CONTENT, $content_data);
        } else {
            //Update Old Record of $blog_content_id
            $this->db->update(TBL_BLOG_CONTENT,$content_data,['id' => $blog_content_id]) ;
        }
        return true;
    }
    
    public function blog_content_data($bid) {
        $sql = 'SELECT * FROM '.TBL_BLOG_CONTENT.' WHERE blog_id = "' . $bid . '" ORDER BY `id` ASC';
        if ($query = $this->db->query($sql)) {
            return $query->result();
        }
        return FALSE;
    }

    public function get_blog_by_slug($slug) {
        $blogsql        =   'SELECT * FROM '.TBL_BLOG.' WHERE slug = "' . $slug . '" AND is_active = 1';
        $blog           =   [];
        if ($query      =   $this->db->query($blogsql)) {
            $data       =   $query->result();
            if(!empty($data)) {
                $blog   = $data[0];
                //Get all content List of this Blog :-
                $blog_id =  $blog->id ; 
                $blog->contents =   $this->blog_content_data($blog_id);
            }
        }
        return $blog;
    }

    public function get_blog_by_slug_cache($slug) {
        $this->db->cache_on();
        $result = $this->get_blog_by_slug($slug); 
        $this->db->cache_off();
        return $result;
    }

    public function get_latest_five_blog_list_cache() {
        $sql            =   'SELECT b.slug,b.heading FROM '.TBL_BLOG.' b LEFT JOIN '.TBL_BLOG_CONTENT.' bc ON bc.blog_id = b.id WHERE b.is_active = 1 GROUP BY bc.blog_id ORDER BY b.id DESC LIMIT 0,5';
        $query          =   $this->db->query($sql);
        return $query->result();
    }

    public function get_blog_content_by_id($id) {
        $sql = 'SELECT * FROM '.TBL_BLOG_CONTENT.' WHERE id = "' . $id . '"';
        if ($query = $this->db->query($sql)) {
            return $query->first_row();
        }
        return FALSE;
    }

    public function delete_blog_content($id) {
        $this->db->cache_delete_all();
        if ($this->db->delete(TBL_BLOG_CONTENT, ['id' => $id]))
            return TRUE;
        return FALSE;
    }

    public function trash_blog($blog_id) {
        $this->db->cache_delete_all();
        $this->db->delete(TBL_BLOG, ['id' => $blog_id]);
        $this->db->delete(TBL_BLOG_CONTENT, ['blog_id' => $blog_id]);
        return true;
    }

    public function seo_meta_data($slug) {
        $sql = 'SELECT * FROM '.TBL_SEO.' WHERE slug = "' . $slug . '"';
        if ($query = $this->db->query($sql)) {
            return $query->first_row();
        }
        return FALSE;
    }

    public function seo_meta_data_cache($slug='home') {
        $this->db->cache_on();
        $result = $this->seo_meta_data($slug); 
        $this->db->cache_off();
        return $result;
    }

    public function save_seo_data($data) {
        $slug                   =   $data['slug'];
        $slug_data              =   $this->seo_meta_data($slug);
        $this->db->cache_delete_all();
        if(empty($slug_data)) {
            return $this->db->insert(TBL_SEO, $data);
        } else {
            unset($data['slug']);
            return $this->db->update(TBL_SEO, $data, ['slug' => $slug]) ;
        }
        return FALSE;
    }

    public function getBlogsListing($offset = NULL, $limit = NULL, $count = NULL) {
        $this->db->select();
        $this->db->from(TBL_BLOG);
        if (!empty($count)) {
            return $this->db->get()->num_rows();
        } else {
            $this->db->order_by('id', 'DESC');
            $this->db->limit($limit, $offset);
            return $this->db->get()->result();
        }
    }

    public function getBlogsListinCache($offset = NULL, $limit = NULL, $count = NULL) {
        $this->db->cache_on();
        $result = $this->getBlogsListing($offset,$limit,$count); 
        $this->db->cache_off();
        return $result;
    }
}
