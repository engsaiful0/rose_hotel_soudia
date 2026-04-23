<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("pagination");
        $user_id=$this->session->userdata('id');
        if($user_id=='')
        {
            redirect(base_url().'login');
        }
    }

    public function index() {
        $sdata['redirect_back'] = 'home';
        $this->load->view('welcome_message');
    }

}
