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
        $this->db->select('checkin_details.*, checkin.*, countries.country_enName, countries.country_arName, hotel.hotel_name_in_english, hotel.hotel_name_in_arabic, room.room_no_in_english, room.room_no_in_arabic');
        $this->db->limit($limit, $start);
        $this->db->where('checkin.is_deleted', '0');

        // die;
        if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
        } else if ($room_id == '' && $hotel_id != '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry >=', $from_date);
            $this->db->where('checkin_details.dateOfEntry <=', $to_date);
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
        $this->db->join('countries', 'countries.country_id = checkin.country_id', 'left');
        $this->db->join('hotel', 'hotel.hotel_id = checkin_details.hotel_id', 'left');
        $this->db->join('room', 'room.room_id = checkin_details.room_id', 'left');
        $this->db->where('checkin.day_or_month', 'month');
        $this->db->order_by('checkin.checkin_id', 'desc');
        $query = $this->db->get("checkin_details");
//        print_r($query->result());
//        die;
        return $query->result();
    }
    /**
     * List filters (hotel, room, date range) used by day check-in list and its count.
     * Empty string means "no filter" for that dimension.
     */
    private function apply_checkin_day_list_filters($hotel_id, $room_id, $from_date, $to_date)
    {
        if ((string) $hotel_id !== '') {
            $this->db->where('checkin_details.hotel_id', $hotel_id);
        }
        if ((string) $room_id !== '') {
            $this->db->where('checkin_details.room_id', $room_id);
        }
        $f = (string) $from_date;
        $t = (string) $to_date;
        if ($f !== '' && $t !== '') {
            $this->db->where('checkin_details.dateOfEntry >=', $f);
            $this->db->where('checkin_details.dateOfEntry <=', $t);
        } elseif ($f !== '' && $t === '') {
            $this->db->where('checkin_details.dateOfEntry >=', $f);
            $this->db->where('checkin_details.dateOfEntry <=', $f);
        } elseif ($f === '' && $t !== '') {
            $this->db->where('checkin_details.dateOfEntry >=', $t);
            $this->db->where('checkin_details.dateOfEntry <=', $t);
        }
    }

    public function count_checkin_details_day($hotel_id, $room_id, $from_date, $to_date)
    {
        $this->db->from('checkin_details');
        $this->db->where('checkin_details.is_deleted', '0');
        $this->db->where('checkin_details.day_or_month', 'day');
        $this->apply_checkin_day_list_filters($hotel_id, $room_id, $from_date, $to_date);
        return (int) $this->db->count_all_results();
    }

    public function get_all_checkin_day($limit, $start,  $hotel_id, $from_date, $to_date,$guest_unique_id,$room_id)
    {
        $this->db->select('checkin_details.*, checkin.*, countries.country_enName, countries.country_arName, hotel.hotel_name_in_english, hotel.hotel_name_in_arabic, room.room_no_in_english, room.room_no_in_arabic');
        $this->db->from('checkin_details');
        $this->db->where('checkin_details.is_deleted', '0');
        $this->apply_checkin_day_list_filters($hotel_id, $room_id, $from_date, $to_date);
        $this->db->where('checkin_details.day_or_month', 'day');
        $this->db->join('checkin', 'checkin.checkin_id  = checkin_details.checkin_id');
        $this->db->join('countries', 'countries.country_id = checkin.country_id', 'left');
        $this->db->join('hotel', 'hotel.hotel_id = checkin_details.hotel_id', 'left');
        $this->db->join('room', 'room.room_id = checkin_details.room_id', 'left');
        if ($guest_unique_id != '') {
            $this->db->where('checkin.guest_unique_id', $guest_unique_id);
        }
        $this->db->order_by('checkin.checkin_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
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
