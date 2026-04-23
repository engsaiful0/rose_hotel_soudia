<?php

class ExpenseModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_expense($limit, $offset, $from_date = '', $to_date = '', $hotel_id = '')
    {
        $this->db->order_by('expense_id', 'DESC');
        
        if (!empty($hotel_id)) {
            $this->db->where('hotel_id', $hotel_id);
        }

        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('date >=', date('Y-m-d', strtotime($from_date)))
                     ->where('date <=', date('Y-m-d', strtotime($to_date)));
        } elseif (!empty($from_date)) {
            $this->db->where('date', date('Y-m-d', strtotime($from_date)));
        } elseif (!empty($to_date)) {
            $this->db->where('date', date('Y-m-d', strtotime($to_date)));
        }

        return $this->db->get('expense', $limit, $offset)->result();
    }

    public function count_all_expense($from_date = '', $to_date = '', $hotel_id = '')
    {
      
        if (!empty($hotel_id)) {
            $this->db->where('hotel_id', $hotel_id);
        }

        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('date >=', date('Y-m-d', strtotime($from_date)))
                     ->where('date <=', date('Y-m-d', strtotime($to_date)));
        } elseif (!empty($from_date)) {
            $this->db->where('date', date('Y-m-d', strtotime($from_date)));
        } elseif (!empty($to_date)) {
            $this->db->where('date', date('Y-m-d', strtotime($to_date)));
        }

        return $this->db->count_all_results('expense');
    }
}
