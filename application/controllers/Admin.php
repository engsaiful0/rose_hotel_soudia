<?php

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id=$this->session->userdata('id');

    }

    public function index() {
        $this->load->view('backend/login_view');
    }

    public function login_function() {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');

        if ($this->Login_model->login_fn($user_name, $password)) {

            $user = $this->db->get_where('user', array('user_name' => $user_name, 'password' => $password))->row();
            $sdata = array();
            $sdata['user_name'] = $user_name;
            $sdata['id'] = $user->id;
            $sdata['type'] = $user->type;
            $sdata['hotel_id'] = $user->hotel_id;
            $this->session->set_userdata($sdata);
            $data = array();
            $sdata['message'] = '';
            $data['output_content'] = '';
            $sdata['message_save'] = '';
            $data['flag'] = '';
            $this->load->view('admin_panel_responsiv', $data);
        } else {

            $sdata = array();
            $sdata['message_save'] = '';
            $sdata['message'] = 'User name or password error! Try again.';
            $this->session->set_userdata($sdata);
            redirect('admin');
        }
    }

    public function log_out() {
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('message');
        $this->session->sess_destroy();
        $sedata = array();

        $sedata['message'] = "You have successfully log out!";

        $this->session->set_userdata($sedata);
        redirect('admin');
    }

    //put your code here
}
