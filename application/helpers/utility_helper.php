<?php

/**
 * 
 * @param type $dob
 * @param type $input_format default 'd/m/Y'
 * @param type $output_format default 'Y-m-d'
 * @return type
 */
function get_date($dob = NULL, $input_format = 'd/m/Y', $output_format = 'Y-m-d') {
    if ((validateDate($dob, $input_format)) && (!empty($dob))) {
        $date = DateTime::createFromFormat($input_format, $dob);
        return $date->format($output_format);
    }
    return NULL;
}

function validateDate($date, $format = 'd/m/Y') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function country_name($code=NULL,$id=NULL) {
    if (!empty($code)) {
        $clist = [];
        $CI = & get_instance();
        $country = $CI->setting_model->get_country_cache();
        foreach ($country as $c) {
            $clist[$c->code] = $c->name;
        }
        return (!empty($clist[$code])) ? $clist[$code] : '';
    }
    if (!empty($id)) {
        $clist = [];
        $CI = & get_instance();
        $country = $CI->setting_model->get_country_cache();
        foreach ($country as $c) {
            $clist[$c->id] = $c->name;
        }
        return (!empty($clist[$id])) ? $clist[$id] : '';
    }
}

function apptype($type = 'up', $get = 'text') {
    $clist          =   [];
    $CI             =   & get_instance();
    $at             =   $CI->setting_model->get_application_type_cache();
    foreach ($at as $a) {
        $clist[$a->type] = $a->name;
    }
    return (!empty($clist[$type])) ? $clist[$type] : '';
}

function apptype_amount($type = 'up') {
    $clist          =   [];
    $CI             =   & get_instance();
    $at             =   $CI->setting_model->get_application_type_cache();
    foreach ($at as $a) {
        $clist[$a->type] = $a->amount;
    }
    return (!empty($clist[$type])) ? $clist[$type] : '';
}


function port_name($p_id) {
    $clist          =   [];
    $CI             =   & get_instance();
    $ap             =   $CI->setting_model->get_arrival_port_cache();
    foreach ($ap as $p) {
        $clist[$p->id] = $p->name;
    }
    return (!empty($clist[$p_id])) ? $clist[$p_id] : '';
}

function dataready($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 


function all_visa_types() {
    return [
        'bussiness'     =>  [
            'name'          =>  'Business',
            'duration'      =>  365,
            'entries_no'    =>  'Multiple'
        ],
        'medical'     =>  [
            'name'          =>  'Medical Treatement of Self',
            'duration'      =>  60,
            'entries_no'    =>  'Triple'
        ],
        'meeting'     =>  [
            'name'          =>  'Meeting friends/relatives',
            'duration'      =>  365,
            'entries_no'    =>  'Multiple'
        ],
        'tourism'     =>  [
            'name'          =>  'Tourism',
            'duration'      =>  365,
            'entries_no'    =>  'Multiple'
        ]
    ];
}

function get_visa_details($type='tourism',$key='name') {
    $all_visa = all_visa_types();
    $visatype = $all_visa[$type];
    return !empty($visatype) ? ($visatype[$key]?:null) : null ;
}
?>