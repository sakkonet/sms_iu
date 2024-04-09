<?php
// Author : Ajuna

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
        public function __construct()
        {
                parent::__construct();
                $this->load->library("session");
        }

        public function index()
        {
                if (!empty($this->session->userdata('id'))) {
                        redirect('home');
                }
                $this->load->view('login');
        }

        public function auth()
        {
                $post_data = $this->input->post();
                $userdata = array(
                        'id' => $post_data['user']['id'],
                        'firstname' => $post_data['user']['firstname'],
                        'lastname' => $post_data['user']['lastname'],
                        'email' => $post_data['user']['email'],
                        'mobile_number' => $post_data['user']['mobile_number'],
                        'role' => $post_data['user']['role'],
                        'organisation' => $post_data['user']['organisation'],
                        'auth_token' => $post_data['auth_token'],
                );
                return $this->session->set_userdata($userdata);
        }

        public function logout()
        {
                $this->session->sess_destroy();
                redirect("login", "refresh");
        }
}
