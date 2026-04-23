<?php

class HistoryModel extends CI_Model
{

    public function communication_data_save($data)
    {
        if ($this->db->insert('query', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_all_history($limit, $start, $patient_id, $mobile_number, $registration_number)
    {
        $this->db->limit($limit, $start);
        if ($patient_id != NULL) {
            $this->db->where('history.patient_id', $patient_id);
        }
        if ($mobile_number != NULL) {
            $this->db->where('history.patient_id', $mobile_number);
        }
        if ($registration_number != NULL) {
            $this->db->where('history.patient_id', $registration_number);
        }
        $this->db->where('history.is_deleted', '0');
        $this->db->join('checkin', 'checkin.patient_id = history.patient_id');
        $this->db->order_by('history.history_id', 'desc');
        $query = $this->db->get("history");
//        echo  '<pre>';
//        print_r($query->result());
//        die;
        return $query->result();
    }
}

