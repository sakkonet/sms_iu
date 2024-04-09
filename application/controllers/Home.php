<?php
// Author : Ajuna

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->library('helpers');
    }

    public function index()
    {
        $neededcss = array("");
        $neededjs = array("");
        $this->helpers->dynamic_script_tags($neededjs, $neededcss);
        $this->data['title'] = $this->data['sub_title'] = "UCCFS SMS -HOME";
        // Load a view in the content partial
        $this->template->title = $this->data['title'];
        $this->template->content->view('home/dashboard', $this->data);
        // Publish the template
        $this->template->publish();
    }
    public function apiKey()
    {
        $neededcss = array("");
        $neededjs = array("");
        $this->helpers->dynamic_script_tags($neededjs, $neededcss);
        $this->data['title'] = $this->data['sub_title'] = "UCCFS SMS -API KEY";
        // Load a view in the content partial
        $this->template->title = $this->data['title'];
        $this->template->content->view('settings/api', $this->data);
        // Publish the template
        $this->template->publish();
    }
    public function topUp()
    {
        $neededcss = array("");
        $neededjs = array("");
        $this->helpers->dynamic_script_tags($neededjs, $neededcss);
        $this->data['title'] = $this->data['sub_title'] = "UCCFS SMS -TOP UP";
        // Load a view in the content partial
        $this->template->title = $this->data['title'];
        $this->template->content->view('transactions/top_up', $this->data);
        // Publish the template
        $this->template->publish();
    }
    public function transactions()
    {
        $neededcss = array("");
        $neededjs = array("");
        $this->helpers->dynamic_script_tags($neededjs, $neededcss);
        $this->data['title'] = $this->data['sub_title'] = "UCCFS SMS -TRANSACTIONS";
        // Load a view in the content partial
        $this->template->title = $this->data['title'];
        $this->template->content->view('transactions/index', $this->data);
        // Publish the template
        $this->template->publish();
    }
}
