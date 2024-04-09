<?php
// Author : Ajuna

defined('BASEPATH') or exit('No direct script access allowed');

class Messages extends CI_Controller
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
        $this->data['title'] = $this->data['sub_title'] = "UCCFS SMS -Messages";
        // Load a view in the content partial
        $this->template->title = $this->data['title'];
        $this->template->content->view('messages/index', $this->data);
        // Publish the template
        $this->template->publish();
    }
    public function new()
    {
        $neededcss = array("");
        $neededjs = array("");
        $this->helpers->dynamic_script_tags($neededjs, $neededcss);
        $this->data['title'] = $this->data['sub_title'] = "UCCFS SMS - New Message";
        // Load a view in the content partial
        $this->template->title = $this->data['title'];
        $this->template->content->view('messages/new', $this->data);
        // Publish the template
        $this->template->publish();
    }
}
