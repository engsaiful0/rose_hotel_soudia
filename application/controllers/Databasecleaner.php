<?php

class Databasecleaner extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $user_id = $this->session->userdata('id');

    }

    public function index()
    {
        $this->db->query('TRUNCATE TABLE `salvage`');
        $this->db->query('TRUNCATE TABLE `admin_cost`');
        $this->db->query('TRUNCATE TABLE `admin_cost_head`');
        $this->db->query('TRUNCATE TABLE `client`');
        $this->db->query('TRUNCATE TABLE `financial_cost`');
        $this->db->query('TRUNCATE TABLE `financial_cost_head`');
        $this->db->query('TRUNCATE TABLE `other_cost`');
        $this->db->query('TRUNCATE TABLE `income_head`');
        $this->db->query('TRUNCATE TABLE `counseling`');
        $this->db->query('TRUNCATE TABLE `labor_cost_head`');
        $this->db->query('TRUNCATE TABLE `medication`');
        $this->db->query('TRUNCATE TABLE `lobbeying_cost_head`');
        $this->db->query('TRUNCATE TABLE `history`');
        $this->db->query('TRUNCATE TABLE `office_cost`');
        $this->db->query('TRUNCATE TABLE `office_cost_head`');
        $this->db->query('TRUNCATE TABLE `operation_admin_cost`');
        $this->db->query('TRUNCATE TABLE `project`');
        $this->db->query('TRUNCATE TABLE `purchase`');
        $this->db->query('TRUNCATE TABLE `purchase_details`');
        $this->load->view('backend/login_view');
    }
    public function database_backup()
    {
        $this->load->dbutil();
        $backup =$this->dbutil->backup();
        $this->load->helper('file');
        write_file('downloads', $backup);
        $this->load->helper('download');
        force_download(date('d-m-Y-h:i:s') . 'bencmark_databae.sql', $backup);
    }
}
