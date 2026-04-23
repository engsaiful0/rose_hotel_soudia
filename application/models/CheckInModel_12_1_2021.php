<?php

class CheckInModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function total_purchase() {
        $this->db->where('is_deleted','0');
        $query = $this->db->get('purchase');
        return $query->num_rows();
    }
    public function get_all_checkin_month($limit, $start,  $hotel_id, $from_date, $to_date,$guest_unique_id)
    {
        $hotel_id = $this->session->userdata('hotel_id');
        $this->db->select('*');
        $this->db->limit($limit, $start);
        $this->db->where('checkin.is_deleted', '0');
//        print_r('$from_date='.$from_date);
//        print_r('$to_date='.$to_date);
//        die;
        $this->db->where('checkin.hotel_id', $hotel_id);
        if ($from_date != '1970-01-01'&&$to_date != '1970-01-01') {
            $this->db->where('checkin.data_insert_time>=', date('Y-m-d', strtotime($from_date)));
            $this->db->where('checkin.data_insert_time<=', date('Y-m-d', strtotime($to_date)));
        }
        else if ($from_date != '1970-01-01'&& $to_date == '1970-01-01') {
            $this->db->where('checkin.data_insert_time', date('Y-m-d', strtotime($from_date)));

        }
        else if ($from_date == '1970-01-01'&& $to_date != '1970-01-01') {
            $this->db->where('checkin.data_insert_time', date('Y-m-d', strtotime($to_date)));

        }
        if ($hotel_id != NULL) {
            $this->db->where('checkin.hotel_id', $hotel_id);
        }
        if ($guest_unique_id != NULL) {
            $this->db->where('checkin.guest_unique_id', $guest_unique_id);
        }
        $this->db->join('checkin', 'checkin.checkin_id  = checkin_details.checkin_id');
        $this->db->where('checkin.day_or_month', 'month');
        $this->db->order_by('checkin.checkin_id', 'desc');
        $query = $this->db->get("checkin_details");
//        print_r($query->result());
//        die;
        return $query->result();
    }
    public function get_all_checkin_day($limit, $start,  $hotel_id, $from_date, $to_date,$guest_unique_id)
    {
        $hotel_id = $this->session->userdata('hotel_id');
        $this->db->select('*');
        $this->db->limit($limit, $start);
        $this->db->where('checkin.is_deleted', '0');
        $this->db->where('checkin.hotel_id', $hotel_id);
//        print_r('$from_date='.$from_date);
//        print_r('$to_date='.$to_date);
//        die;
        if ($from_date != '1970-01-01'&&$to_date != '1970-01-01') {
            $this->db->where('checkin.data_insert_time>=', date('Y-m-d', strtotime($from_date)));
            $this->db->where('checkin.data_insert_time<=', date('Y-m-d', strtotime($to_date)));
        }
        else if ($from_date != '1970-01-01'&& $to_date == '1970-01-01') {
            $this->db->where('checkin.data_insert_time', date('Y-m-d', strtotime($from_date)));

        }
        else if ($from_date == '1970-01-01'&& $to_date != '1970-01-01') {
            $this->db->where('checkin.data_insert_time', date('Y-m-d', strtotime($to_date)));


        }
        if ($hotel_id != NULL) {
            $this->db->where('checkin.hotel_id', $hotel_id);
        }
        if ($guest_unique_id != NULL) {
            $this->db->where('checkin.guest_unique_id', $guest_unique_id);
        }
        $this->db->where('checkin.day_or_month', 'day');
        $this->db->join('checkin', 'checkin.checkin_id  = checkin_details.checkin_id');
        $this->db->order_by('checkin.checkin_id', 'desc');
        $query = $this->db->get("checkin_details");
//        print_r($query->result());
//        die;
        return $query->result();
    }
    public function get_purchase($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->where('is_deleted','0')
            ->order_by('purchase_id','desc')
            ->get("purchase");
        return $query->result();
    }




}
