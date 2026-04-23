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
    public function get_all_checkin_month($limit, $start,  $hotel_id, $from_date, $to_date,$guest_unique_id,$room_id)
    {
        $user_type = $this->session->userdata('type');
        $this->db->select('*');
        $this->db->limit($limit, $start);
        $this->db->where('checkin.is_deleted', '0');

        // die;
        if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
        } else if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
        } else if ($room_id == '' && $hotel_id != '' && $from_date == '' && $to_date == '') {
            $this->db->where('checkin_details.hotel_id', $hotel_id);

        } else if ($room_id == '' && $hotel_id == '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
        } else if ($room_id == '' && $hotel_id == '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);
        } else if ($room_id == '' && $hotel_id == '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
        }else if ($room_id != '' && $hotel_id != '' && $from_date == '' && $to_date == '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            //print_r('2');
        }
        else if ($room_id == '' && $hotel_id == '' && $from_date == '' && $to_date == '') {
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
    public function get_all_checkin_day($limit, $start,  $hotel_id, $from_date, $to_date,$guest_unique_id,$room_id)
    {
        $user_type = $this->session->userdata('type');
        $this->db->select('*');
        $this->db->limit($limit, $start);
        $this->db->where('checkin_details.is_deleted', '0');

        if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);

            // print_r('1');
        } else if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);

            //  print_r('2');
        } else if ($room_id != '' && $hotel_id != '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);

            //  print_r('2');
        }
        else if ($room_id == '' && $hotel_id != '' && $from_date == '' && $to_date == '') {
            $this->db->where('checkin_details.hotel_id', $hotel_id);

            // print_r('3');
            //  print_r('<br>'.$config['total_rows']);
        } else if ($room_id == '' && $hotel_id == '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);

            //print_r('4');
        } else if ($room_id == '' && $hotel_id == '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);

            // print_r('5');
        } else if ($room_id == '' && $hotel_id != '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);
            $this->db->where('checkin_details.hotel_id', $hotel_id);

            // print_r('5');
        }else if ($room_id == '' && $hotel_id != '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $this->db->where('checkin_details.hotel_id', $hotel_id);

            //print_r('6');
        }
        else if ($room_id == '' && $hotel_id == '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);

            print_r('6');
        } else if ($room_id != '' && $hotel_id != '' && $from_date == '' && $to_date == '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);

            // print_r('7');
        } else if ($room_id == '' && $hotel_id == '' && $from_date == '' && $to_date == '') {

            // print_r('8');
        }
        if ($guest_unique_id != '') {
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
