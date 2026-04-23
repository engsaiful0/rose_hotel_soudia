<?php


class Admin_controller extends CI_Controller {
	 public function __construct()
    {
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
	     $data['project_id']=$this->input->post('project_id');
	     //print_r($_POST);
	    // die;
        $this->load->view('admin_panel_responsiv',$data);
        
    }

    //put your code here
}
