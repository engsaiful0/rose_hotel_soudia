<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class LoginController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->database();
        $this->load->helper('url');

        $this->load->library('Grocery_crud');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        $this->load->view('login');
    }

    /*     * *validate login*** */

    public function database_backup() {

        $this->load->dbutil();
        $prefs = array(
            'format' => 'zip',
            'filename' => 'my_db_backup.sql'
        );
        $backup = & $this->dbutil->backup($prefs);
        $db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
        $save = '/upload/_tmp/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    function FunctionLogin() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $login_query = $this->db->get_where('user', array('email' => $email, 'password' => $password));
        if ($login_query->num_rows() > 0) {

            $row = $login_query->row();

            $data = array('user_id' => $row->id,'hotel_id'=>$row->hotel_id);
            $this->session->set_userdata($data);

            $ip = $_SERVER['REMOTE_ADDR'];
            $data_session = array(
                'sign_up_id' => $row->sign_up_id,
                'sign_in_time' => date('Y-m-d H:i:s'),
                'ip' => $ip
            );
            $this->db->insert('user_session', $data_session);


            $redirect = $this->session->userdata('redirect_back');
            redirect(base_url() . $redirect);
        } else {

            $redirect = $this->session->userdata('redirect_back');
            redirect(base_url() . $redirect);
        }
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function FunctionLogout() {

        $ip = $_SERVER['REMOTE_ADDR'];
        $data_session = array(
            'sign_up_id' => $row->sign_up_id,
            'sign_out_time' => date('Y-m-d H:i:s'),
            'ip' => $ip
        );
        $this->db->insert('user_session', $data_session);
        $this->session->sess_destroy();
        $redirect = $this->session->userdata('redirect_back');
        redirect('welcome');
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */

    function reset_password() {
        
    }

    /*     * *LOGIN AS ANOTHER USER LIKE DOCTOR,PATIENT,PHARMACIST,LABORATORIST ETC***** */

    function login_as($user_type = '', $user_id = '') {
        
    }

}
