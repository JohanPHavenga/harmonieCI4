<?php
// ================================================================
// Formulate display of race distance
// ================================================================

if (!function_exists('fraceDistance')) {
    function fraceDistance($distance)
    {
        if ($distance) {
            return floatval($distance) . "km";
        } else {
            return false;
        }
    }
}

// ================================================================
// Formulate Currency
// ================================================================
if (!function_exists('fdisplayCurrency')) {
    function fdisplayCurrency($amount, $des = 0)
    {
        if ($amount) {
            return "R " . number_format($amount, $des, '.', ' ');
        } else {
            return false;
        }
    }
}


// ================================================================
// Formulate Dates / TIME
// ================================================================
if (!function_exists('fdateShort')) {
    function fdateShort($date)
    {
        if ($date) {
            return date("Y-m-d", strtotime($date));
        } else {
            return false;
        }
    }
}

if (!function_exists('fdateLong')) {
    function fdateLong($date, $show_sec = TRUE)
    {
        if ($date) {
            if ($show_sec) {
                return date("Y-m-d H:i:s", strtotime($date));
            } else {
                return date("Y-m-d H:i", strtotime($date));
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('fdateYear')) {
    function fdateYear($date)
    {
        if ($date) {
            return date("Y", strtotime($date));
        } else {
            return false;
        }
    }
}

if (!function_exists('ftimeSort')) {
    function ftimeSort($time)
    {
        if ($time) {
            return date("H:i", strtotime($time));
        } else {
            return false;
        }
    }
}

if (!function_exists('fdateToCal')) {
    function fdateToCal($timestamp)
    {
        if ($timestamp) {
            return date('Ymd\THis', $timestamp);
            //            return date('Ymd\THis\Z', $timestamp-(2*60*60)); // google does not like the Z
        } else {
            return false;
        }
    }
}

// ================================================================
// Formulate Lables
// ================================================================
if (!function_exists('flable')) {
    function flable($text = "", $status = "default", $size = NULL)
    {
        if ($size) {
            $l_size = "label-" . $size;
        } else {
            $l_size = NULL;
        }
        return "<span class='label $l_size label-$status'> $text </span>";
    }
}


if (!function_exists('flableStatus')) {
    function flableStatus($status_num)
    {
        switch ($status_num) {
            case 1:
                $text = "Published";
                $status = "success";
                break;
            default:
                $text = "Not Published";
                $status = "danger";
                break;
        }

        return flable($text, $status, "sm");
    }
}

if (!function_exists('flableFeatured')) {
    function flableFeatured($code)
    {
        return flable($code, "primary", "med");
    }
}



// ================================================================
// Formulate Buttons
// ================================================================
if (!function_exists('fbutton')) {
    function fbutton($text = "Submit", $type = "submit", $status = "default", $size = NULL, $name = "", $value = "")
    {
        // status: default|primary|success|warning|danger|link
        // size: lg|sm|xs

        if ($size) {
            $btn_size = "btn-" . $size;
        } else {
            $btn_size = NULL;
        }
        return "<button type='$type' name='$name' class='btn btn-$status $btn_size' value='$value'>$text</button>";
    }
}

if (!function_exists('fbuttonLink')) {
    function fbuttonLink($url, $text, $status = "default", $size = NULL)
    {
        // status: default|primary|success|warning|danger|link
        // size: lg|sm|xs        
        if ($size) {
            $btn_size = "btn-" . $size;
        } else {
            $btn_size = NULL;
        }
        return "<a href='$url' class='btn btn-$status $btn_size' role='button'>$text</a>";
    }
}


if (!function_exists('fbuttonLinkGroup')) {
    function fbuttonLinkGroup($action_array)
    {
        $html = "<div class='btn-group'>";
        foreach ($action_array as $text => $link) {
            if ($text == "Delete") {
                $btn_color = "danger";
            } else {
                $btn_color = "default";
            }
            $html .= "<a href='$link' class='btn btn-$btn_color btn-xs' role='button'>$text</a>";
        }
        $html .= "</div>";

        return $html;
    }
}


if (!function_exists('fbuttonActionGroup')) {
    function fbuttonActionGroup($action_array)
    {
        $html = "<div class='btn-group'>";
        foreach ($action_array as $action_item) {
            // confirmation
            if (isset($action_item['confirmation_text'])) {
                $confirm = "data-toggle='confirmation' data-original-title='" . $action_item['confirmation_text'] . "'";
            } else {
                $confirm = "";
            }
            if ($action_item['text'] == "Delete") {
                $btn_color = "danger";
            } else {
                $btn_color = "default";
            }
            $html .= "<a href='" . $action_item['url'] . "' class='btn btn-$btn_color btn-xs' role='button' $confirm>" . $action_item['text'] . " </a>";
        }
        $html .= "</div>";

        return $html;
    }

    function fbuttonActionGroup2($action_array)
    {
        $html = "<div class='btn-group'>";
        $html .= "<button class='btn btn-xs default dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'> Actions <i class='fa fa-angle-down'></i></button>";
        $html .= "<ul class='dropdown-menu pull-left' role='menu'>";
        foreach ($action_array as $action_item) {
            // confirmation
            if (isset($action_item['confirmation_text'])) {
                $confirm = "data-toggle='confirmation' data-original-title='" . $action_item['confirmation_text'] . "'";
            } else {
                $confirm = "";
            }
            $html .= "<li><a href='" . $action_item['url'] . "' $confirm><i class='" . $action_item['icon'] . "'></i> " . $action_item['text'] . " </a>";
        }
        $html .= "</ul></div>";

        return $html;
    }
}

// ====================================s============================
// Formulate Tables
// ================================================================

if (!function_exists('ftable')) {
    function ftable($id = "")
    {
        $template = array(
            'table_open' => '<table class="table table-striped table-bordered table-hover order-column" id="' . $id . '">'
        );
        return $template;
    }
}


if (!function_exists('ftableHeading')) {
    function ftableHeading($heading_list, $blank_columns = 0)
    {
        foreach ($heading_list as $heading) :
            $fheading_list[] = str_replace("Id", "ID", str_replace("_", "&nbsp;", ucwords($heading, "_")));
        endforeach;
        $return['heading'] = $fheading_list;

        for ($n = 0; $n < $blank_columns; $n++) {
            $return['heading'][] = "";
        }
        return $return['heading'];
    }
}


// ================================================================
// Formulate Pagenation
// ================================================================
if (!function_exists('fpagination')) {
    function fpagination($p)
    {
        return $p;
    }
}

if (!function_exists('fpaginationConfig')) {
    function fpaginationConfig($url, $per_page, $total, $uri_segment)
    {
        $config["base_url"] = $url;
        $config["total_rows"] = $total;
        $config["per_page"] = $per_page;
        $config["uri_segment"] = $uri_segment;

        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['next_link'] = "Next &rsaquo;";
        $config['prev_link'] = "&lsaquo; Previous";

        $open_tag_list = ['first_tag_open', 'next_tag_open', 'prev_tag_open', 'last_tag_open', 'num_tag_open'];
        foreach ($open_tag_list as $tag) :
            $config[$tag] = '<li>';
        endforeach;

        $open_tag_list = ['first_tag_close', 'next_tag_close', 'prev_tag_close', 'last_tag_close', 'num_tag_close'];
        foreach ($open_tag_list as $tag) :
            $config[$tag] = '</li>';
        endforeach;

        $config['cur_tag_open'] = "<li><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";
        return $config;
    }
}
