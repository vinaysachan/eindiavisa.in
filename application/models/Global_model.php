<?php

class Global_model extends CORE_Model {

    public function __construct() {
        parent::__construct();
    }

    public function page_data($slug) {
        $sql = 'SELECT * FROM '.TBL_PAGES.' WHERE slug = "' . $slug . '"';
        if ($query = $this->db->query($sql))
            return $query->row();
        return FALSE;
    }
    
    public function save_enq($data) {
        if ($this->db->insert(TBL_ENQUIRY, $data))
            return TRUE;
        return FALSE;
    }
    
    
    public function saveErrorLogs($data) {
        $this->db->insert(TBL_ERROR, ['data' => json_encode($data)]);
    }

    public function getEnqs($offset = NULL, $limit = NULL, $count = NULL, $status = STATUS_IN_ACTIVE) {
        $this->db->select();
        $this->db->from(TBL_ENQUIRY);
        $this->db->where('status', $status);
        if (!empty($count)) {
            return $this->db->get()->num_rows();
        } else {
            $this->db->order_by('date_created', 'DESC');
            $this->db->limit($limit, $offset);
            return $this->db->get()->result();
        }
    }

    public function change_status($status, $id) {
        if ($this->db->update(TBL_ENQUIRY, ['status' => $status], ['id' => $id]))
            return TRUE;
        return FALSE;
    }
    
    public function getApplication($offset = NULL, $limit = NULL, $count = NULL) {
        $this->db->select();
        $this->db->from(TBL_APPLICATIONS);

        if (!empty($this->input->get('name'))) {
            $this->db->or_like('fname', $this->input->get('name'));
            $this->db->or_like('lname', $this->input->get('name'));
        }

        if (!empty($this->input->get('app_id')))
            $this->db->where('app_id', $this->input->get('app_id'));

        if (!empty($this->input->get('passport_no')))
            $this->db->where('passport_no', $this->input->get('passport_no'));

        if (!empty($this->input->get('email')))
            $this->db->where('email', $this->input->get('email'));

        if (!empty($this->input->get('phone')))
            $this->db->where('phone', $this->input->get('phone'));

        if (!empty($this->input->get('birth_country')))
            $this->db->where('birth_country', $this->input->get('birth_country'));

        if (!empty($this->input->get('app_status'))) {
            if ($this->input->get('app_status') == 'payment_pending') {
                $this->db->where('application_status', 1);
            } elseif ($this->input->get('app_status') == 'pdnc') {
                $this->db->where('application_status', 2);
                $this->db->where('payment_status', 1);
            } elseif ($this->input->get('app_status') == 'pfnc') {
                $this->db->where('application_status', 2);
                $this->db->where('payment_status !=', 1);
            } elseif ($this->input->get('app_status') == 'closed') {
                $this->db->where('application_status', 3);
            }
        }
 
        if (!empty($count)) {
            return $this->db->get()->num_rows();
        } else {
            $this->db->order_by('date_created', 'DESC');
            $this->db->limit($limit, $offset);
            return $this->db->get()->result();
        }
    }
    
    function getAppDetails($app_id) {
        $sql = 'SELECT * FROM '.TBL_APPLICATIONS.' where app_id= "' . $app_id . '"';
        if ($query = $this->db->query($sql)) {
            return $query->result();
        }
        return FALSE;
    }

    public function close_status($app_id) {
        if ($this->db->update(TBL_APPLICATIONS, ['application_status' => 3], ['app_id' => $app_id]))
            return TRUE;
        return FALSE;
    }
 
    public function all_saved_page() {
        $sql = 'SELECT GROUP_CONCAT(slug) as all_slugs FROM '.TBL_PAGES.' WHERE is_active = "' . STATUS_ACTIVE . '"';
        if ($query = $this->db->query($sql)) {
            return $query->result();
        }
        return FALSE;
    }

}
