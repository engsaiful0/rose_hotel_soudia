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
    public function get_all_checkin_month($limit, $start,  $hotel_id=NULL, $from_date, $to_date,$guest_unique_id,$room_id=NULL)
    {
        $user_type = $this->session->userdata('type');
        if ($user_type != 'superadmin') {
            $hotel_id = $this->session->userdata('hotel_id');
        }
        $this->db->select('*');
        $this->db->limit($limit, $start);
        $this->db->where('checkin.is_deleted', '0');

        // die;
        if ($from_date != ''&&$to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);

        }
        else if ($from_date != ''&& $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin.data_insert_time<=', $from_date);
//            die('2');
//die;    die('1');
        }
        else if ($from_date == ''&& $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin.data_insert_time<=', $to_date);
//            die('3');
        }
        if ($hotel_id != NULL) {
            $this->db->where('checkin.hotel_id', $hotel_id);
        }
        if ($room_id != NULL) {
            $this->db->where('checkin_details.room_id', $room_id);
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
    public function get_all_checkin_day($limit, $start,  $hotel_id=NULL, $from_date, $to_date,$guest_unique_id,$room_id = NULL)
    {
        $user_type = $this->session->userdata('type');
        if ($user_type != 'superadmin') {
            $hotel_id = $this->session->userdata('hotel_id');
        }

        $this->db->select('*');
        $this->db->limit($limit, $start);
        $this->db->where('checkin_details.is_deleted', '0');

        if ($from_date != ''&&$to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);

        }
        else if ($from_date != ''&& $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry', $from_date);
        }
        else if ($from_date == ''&& $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry', $to_date);
        }
        if ($room_id != NULL) {
            $this->db->where('checkin_details.room_id', $room_id);
        }
        if ($hotel_id != NULL) {
            $this->db->where('checkin_details.hotel_id', $hotel_id);
        }
        if ($guest_unique_id != NULL) {
            $this->db->where('checkin.guest_unique_id', $guest_unique_id);
        }
        $this->db->where('checkin_details.day_or_month', 'day');
        $this->db->join('checkin', 'checkin.checkin_id  = checkin_details.checkin_id');
        $this->db->order_by('checkin.checkin_id', 'desc');
        $query = $this->db->get("checkin_details");
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
