<?php

class IncomeModel extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function get_income($limit, $offset, $from_date = '', $to_date = '')
    {
        $query = '';
        if ($from_date != '' and $to_date != '') {
            $query = $this->db
                ->where('type', 'income')
                ->where('date>=', date('Y-m-d', strtotime($from_date)))
                ->where('date<=', date('Y-m-d', strtotime($to_date)))->order_by('transaction_id','DESC')
                ->get('transactions', $limit, $offset);
        } else if ($from_date != '' and $to_date == '') {
            $query = $this->db
                ->where('type', 'income')
                ->where('date', date('Y-m-d', strtotime($from_date)))->order_by('transaction_id','DESC')
                ->get('transactions', $limit, $offset);
        } else if ($from_date == '' and $to_date != '') {
            $query = $this->db
                ->where('type', 'income')
                ->where('date', date('Y-m-d', strtotime($to_date)))
                ->order_by('transaction_id','DESC')
                ->get('transactions', $limit, $offset);
        } else if ($from_date == '' and $to_date == '') {
            $query = $this->db->where('type', 'income')->order_by('transaction_id','DESC')->get('transactions', $limit, $offset);
        }
    
        return $query->result();
    }

    public function count_all_income($from_date = '', $to_date = '')
    {
        $query = '';
        if ($from_date != '' and $to_date != '') {
            $query = $this->db
                ->where('type', 'income')
                ->where('date>=', date('Y-m-d', strtotime($from_date)))
                ->where('date<=', date('Y-m-d', strtotime($to_date)))
                ->count_all('transactions');
        } else if ($from_date != '' and $to_date == '') {
            $query = $this->db
                ->where('type', 'income')
                ->where('date', date('Y-m-d', strtotime($from_date)))
                ->count_all('transactions');
        } else if ($from_date == '' and $to_date != '') {
            $query = $this->db
                ->where('type', 'income')
                ->where('date', date('Y-m-d', strtotime($to_date)))
                ->count_all('transactions');
        } else if ($from_date == '' and $to_date == '') {
            return $this->db->where('type', 'income')->count_all('transactions');
        }
    }
}
