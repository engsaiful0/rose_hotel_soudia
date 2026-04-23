<?php

class TransactionModel extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function get_transaction($limit, $offset, $hotel_id, $from_date = '', $to_date = '')
    {
        $query = '';
        if ($from_date != '' and $to_date != '' and $hotel_id != '') {
            $query = $this->db
                ->where('hotel_id', $hotel_id)
                ->where('date>=', date('Y-m-d', strtotime($from_date)))
                ->where('date<=', date('Y-m-d', strtotime($to_date)))->order_by('transaction_id', 'DESC')
                ->get('transactions', $limit, $offset);
        } else if ($from_date != '' and $to_date == ''  and $hotel_id == '') {
            $query = $this->db

                ->where('date', date('Y-m-d', strtotime($from_date)))->order_by('transaction_id', 'DESC')
                ->get('transactions', $limit, $offset);
        } else if ($from_date == '' and $to_date != '' and $hotel_id == '') {
            $query = $this->db
                ->where('date', date('Y-m-d', strtotime($to_date)))
                ->order_by('transaction_id', 'DESC')
                ->get('transactions', $limit, $offset);
        } else if ($from_date == '' and $to_date == '' and $hotel_id != '') {
            $query = $this->db
                ->where('hotel_id', $hotel_id)
                ->order_by('transaction_id', 'DESC')
                ->get('transactions', $limit, $offset);
        } else if ($from_date == '' and $to_date == '' and $hotel_id == '') {
            $query = $this->db->order_by('transaction_id', 'DESC')->get('transactions', $limit, $offset);
        }

        return $query->result();
    }

    public function count_all_transaction($hotel_id, $from_date = '', $to_date = '')
    {
        $query = '';
        if ($from_date != '' and $to_date != '' and $hotel_id != '') {
            $query = $this->db
                ->where('hotel_id', $hotel_id)
                ->where('date>=', date('Y-m-d', strtotime($from_date)))
                ->where('date<=', date('Y-m-d', strtotime($to_date)))
                ->count_all('transactions');
        } else if ($from_date != '' and $to_date == '' and $hotel_id == '') {
            $query = $this->db
                ->where('date', date('Y-m-d', strtotime($from_date)))
                ->count_all('transactions');
        } else if ($from_date == '' and $to_date != '' and $hotel_id == '') {
            $query = $this->db
                ->where('date', date('Y-m-d', strtotime($to_date)))
                ->count_all('transactions');
        } else if ($from_date == '' and $to_date == '' and $hotel_id != '') {
            $query = $this->db
                ->where('hotel_id', $hotel_id)
                ->count_all('transactions');
        } else if ($from_date == '' and $to_date == '' and $hotel_id == '') {
            return $this->db->count_all('transactions');
        }
    }
}
