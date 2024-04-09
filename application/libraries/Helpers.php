<?php

/**
 * Description of Helper
 *
 * @author reagan
 */
#required for Africaistalking API
use AfricasTalking\SDK\AfricasTalking;
use HTTP\Request2; // Only when installed with PEAR

if (!defined('BASEPATH'))
    exit("No direct script access allowed");

class Helpers
{

    protected $CI;
    protected $org_details;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
    }

    public function dynamic_script_tags($js = false, $css = false)
    {

        $requiredjs = "";
        $requiredcss = "";
        $assets_folder = "assets/";
        if (!($js === false)) {
            foreach ($js as $key => $link) {
                $requiredjs .= $this->CI->template->javascript->add(base_url($assets_folder . "js/" . $link));
            }
        }
        if (!($css === false)) {
            foreach ($css as $key => $link) {
                $requiredcss .= $this->CI->template->stylesheet->add(base_url($assets_folder . "css/" . $link), array('media' => 'all'));
            }
        }

        return json_encode($requiredjs . '' . $requiredcss);
    }

    public function yr_transformer($form_date)
    {
        $exploded_date = explode('-', $form_date, 3);
        $new_date = count($exploded_date) === 3 ? ($exploded_date[2] . "-" . $exploded_date[1] . "-" . $exploded_date[0]) : null;
        return preg_replace("/^19/", "20", $new_date);
    }
    public function get_date_time($date)
    {
        if ($date != null) {
            $t = microtime(true);
            $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
            $d2 = new DateTime($date . " " . date('H:i:s.' . $micro, $t));
            return $d2->format("Y-m-d H:i:s.u");
        } else {
            return null;
        }
    }

    public function pure_phone_no($messy_phone_no = "")
    {
        return preg_replace(["/\s/", "/-/"], "", $messy_phone_no);
    }

    public function valid_email($email)
    {
        if (preg_match('/^((?=[A-Z0-9][A-Z0-9@._%+-]{5,253}+$)[A-Z0-9._%+-]{1,64}+@(?:(?=[A-Z0-9-]{1,63}+\.)[A-Z0-9]++(?:-[A-Z0-9]++)*+\.){1,8}+[A-Z]{2,63}+)$/', $email)) {
            return TRUE;
        }
        return FALSE;
    }

    public function extract_date_time($date_time_string, $return_format = "U")
    {
        $date_format = "d/m/Y" . (strlen($date_time_string) > 10 ? " H:i:s" : "");
        $date_time_obj = DateTime::createFromFormat($date_format, $date_time_string);
        return $date_time_obj->format($return_format);
    }

    public function extract_date_time_hyphen($date_time_string, $return_format = "U")
    {
        $date_format = "Y-m-d" . (strlen($date_time_string) > 10 ? " H:i:s" : "");
        $date_time_obj = DateTime::createFromFormat($date_format, $date_time_string);
        return $date_time_obj->format($return_format);
    }
    public function extract_date_time_dot($date_time_string, $return_format = "U")
    {
        $date_format = "d.m.Y" . (strlen($date_time_string) > 10 ? " H:i:s" : "");
        $date_time_obj = DateTime::createFromFormat($date_format, $date_time_string);
        return $date_time_obj->format($return_format);
    }
}
