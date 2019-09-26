<?php

/**
 * PHP Pagination Class
 * @author vinay@onlinephpstudy.com - http://www.onlinephpstudy.com
 * @version 1.2.0
 * @date December 6, 2015
 * @copyright (c) vinay@onlinephpstudy.com (www.onlinephpstudy.com)
 * @license CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 */
error_reporting(-1);

class Paginator {

    public $current_page;
    public $items_per_page;
    public $limit_end;
    public $limit_start;
    public $num_pages;
    public $total_items;
    protected $ipp_array = array(10, 5, 1, 15, 20, 25, 30, 40, 50, 75, 100);
    protected $limit;
    protected $mid_range = 9;
    protected $querystring;
    protected $return;
    protected $get_ipp;
    protected $base_url;
    public $cur_page = 0;

    public function __construct() {
        
    }

//    public function initialize($total, $mid_range, $ipp_array) {
    public function initialize(array $params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }

        $this->total_items = (int) $this->total_items;
        $this->mid_range = (int) $this->mid_range;
        if (!is_array($this->ipp_array))
            exit("Unable to paginate: Invalid ipp_array value");
        $this->ipp_array = $this->ipp_array;

        if (empty(($this->base_url)))
            exit("Unable to paginate: base_url Not found in your initilazation");

        $this->base_url = trim($this->base_url);

        if (!empty(parse_url($this->base_url, PHP_URL_QUERY))) {
            $this->base_url = substr($this->base_url, 0, strrpos($this->base_url, "?"));
        }

        // must be numeric > 0
        $this->current_page = (isset($this->current_page)) ? (int) $this->current_page : 1;

        if ($this->total_items <= 0) {
            $this->return = "";
//	    exit("Unable to paginate: Invalid total value (must be an integer > 0)");
        } elseif ($this->mid_range % 2 == 0 Or $this->mid_range < 1) {
            $this->return = "";
//	    exit("Unable to paginate: Invalid mid_range value (must be an odd integer >= 1)");
        } else {
            $this->items_per_page = (isset($_GET["ipp"])) ? $_GET["ipp"] : $this->ipp_array[0];
            $this->default_ipp = $this->ipp_array[0];
            if ($this->items_per_page == "All") {
                $this->num_pages = 1;
            } else {
                if (!is_numeric($this->items_per_page) OR $this->items_per_page <= 0)
                    $this->items_per_page = $this->ipp_array[0];
                $this->num_pages = ceil($this->total_items / $this->items_per_page);
            }

            if ($_GET) {
                $args = explode("&", $_SERVER["QUERY_STRING"]);
                foreach ($args as $arg) {
                    $keyval = explode("=", $arg);
                    if ($keyval[0] != "page" And $keyval[0] != "ipp")
                        $this->querystring .= "&" . $arg;
                }
            }
            if ($_POST) {
                foreach ($_POST as $key => $val) {
                    if ($key != "page" And $key != "ipp")
                        $this->querystring .= "&$key=$val";
                }
            }
            if ($this->num_pages > 10) {
                if ($this->current_page > 1 And $this->total_items >= 10) { //" . "/".($this->current_page - 1) . "?
                    $this->return = "<a class=\"paginate\" href=\"$this->base_url" . "/" . ($this->current_page - 1) . "?ipp=$this->items_per_page$this->querystring\">Previous</a>";
                } else {
                    $this->return = "<span class=\"inactive\" href=\"javascript:void(0);\">Previous</span> ";
                }

                $this->start_range = $this->current_page - floor($this->mid_range / 2);
                $this->end_range = $this->current_page + floor($this->mid_range / 2);
                if ($this->start_range <= 0) {
                    $this->end_range += abs($this->start_range) + 1;
                    $this->start_range = 1;
                }
                if ($this->end_range > $this->num_pages) {
                    $this->start_range -= $this->end_range - $this->num_pages;
                    $this->end_range = $this->num_pages;
                }
                $this->range = range($this->start_range, $this->end_range);
                for ($i = 1; $i <= $this->num_pages; $i++) {
                    if ($this->range[0] > 2 And $i == $this->range[0])
                        $this->return .= "<span class=\"paginate\"> ... </span>";
                    // loop through all pages. if first, last, or in range, display  $i == $this->num_pages
                    if ((in_array($i, [1])) Or ( in_array($i, [/* ($this->num_pages - 2),($this->num_pages - 1), */$this->num_pages])) Or in_array($i, $this->range))
                        $this->return .= ($i == $this->current_page And $this->items_per_page != "All") ? "<a title=\"Go to page $i of $this->num_pages\" class=\"paginatecurrent\" href=\"javascript:void(0);\">$i</a>\n" : "<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=\"$this->base_url/$i?ipp=$this->items_per_page$this->querystring\">$i</a>\n";
                    if ($this->range[$this->mid_range - 1] < $this->num_pages - 1 And $i == $this->range[$this->mid_range - 1])
                        $this->return .= "<span class=\"paginate\">  ...  </span>";
                }//" . "/".($this->current_page - 1) . "?
                $this->return .= (($this->current_page < $this->num_pages And $this->total_items >= 10) And ( $this->items_per_page != "All") And $this->current_page > 0) ? "<a class=\"paginate\" href=\"$this->base_url/" . ($this->current_page + 1) . "?ipp=$this->items_per_page$this->querystring\">Next</a>\n" : "<span class=\"inactive\" href=\"javascript:void(0);\">Next</span>\n";
//                $this->return .= ($this->items_per_page == "All") ? "<a class=\"paginatecurrent\" style=\"margin-left:10px\" href=\"javascript:void(0);\">All</a>\n" : "<a class=\"paginate\" href=\"$this->base_url/1?ipp=All$this->querystring\">All</a>\n";
            } else {
                for ($i = 1; $i <= $this->num_pages; $i++) {
                    $this->return .= ($i == $this->current_page) ? "<a class=\"paginatecurrent\" href=\"javascript:void(0);\">$i</a> " : "<a class=\"paginate\" href=\"$this->base_url/$i?ipp=$this->items_per_page$this->querystring\">$i</a>";
                }
//                $this->return .= "<a class=\"paginate\" href=\"$this->base_url/1?ipp=All$this->querystring\">All</a>\n";
            }
            $this->return = str_replace("&", "&amp;", $this->return);
            $this->limit_start = ($this->current_page <= 0) ? 0 : ($this->current_page - 1) * $this->items_per_page;
            if ($this->current_page <= 0)
                $this->items_per_page = 0;
            $this->limit_end = ($this->items_per_page == "All") ? (int) $this->total_items : (int) $this->items_per_page;
        }
    }

    public function display_items_per_page() {
        if (!empty($this->return)) {
            $items = NULL;
            natsort($this->ipp_array); // This sorts the drop down menu options array in numeric order (with 'all' last after the default value is picked up from the first slot
            foreach ($this->ipp_array as $ipp_opt)
                $items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n" : "<option value=\"$ipp_opt\">$ipp_opt</option>\n";
            return "<span>Records per page : </span><select style=\"width: 100px;display: inline\" onchange=\"window.location='$this->base_url/1?ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>\n";
        }
    }

    public function display_jump_menu() {
        if (!empty($this->return)) {
            $option = NULL;
            for ($i = 1; $i <= $this->num_pages; $i++) {
                $option .= ($i == $this->current_page) ? "<option value=\"$i\" selected>$i</option>\n" : "<option value=\"$i\">$i</option>\n";
            }
            return "<span class=\"\">Go To Page Number : </span><select style=\"width: 100px;display: inline\" onchange=\"window.location='$this->base_url/'+this[this.selectedIndex].value+'?ipp=$this->items_per_page$this->querystring';return false\">$option</select>\n";
        }
    }

    public function display_page_number() {
        if (!empty($this->return)) {
            return "Page : " . $this->current_page . " of " . $this->num_pages;
        }
    }

    public function display_page_record() {
        if (!empty($this->return)) {
            $showing_endrec = $this->limit_start + $this->limit_end;
            $showing_endrec = ($this->total_items <= $showing_endrec) ? $this->total_items : $showing_endrec;
            return "Showing " . ($this->limit_start + 1) . " to " . $showing_endrec . " of " . $this->total_items . " Records";
        }
    }

    public function dispaly_page_record_ipp() {
        if (!empty($this->return)) {
            return "<div class=\"row mb10 mr0 ml0 \"><div class=\"col-sm-6 pt5 pl0 bold\">" . $this->display_page_record() . "</div><div class=\"text-right col-sm-6 pl0\">" . $this->display_items_per_page() . "</div></div>";
        }
    }

    public function display_pages() {
        if (!empty($this->return)) {
            return "<span class=\"paging_list\">" . $this->return . "</span>";
        }
    }

    public function display_jump_menu_pages() {
        if (!empty($this->return)) {
            return "<div class=\"row\"><div class=\"col-sm-3\">" . $this->display_jump_menu() . "</div><div class=\"col-sm-9 text-right mt5\">" . $this->display_pages() . "</div></div>";
        }
    }

}