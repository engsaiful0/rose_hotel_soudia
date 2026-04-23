<?php

class Pagmodel extends CI_Model
{

    public function communication_data_save($data)
    {
        if ($this->db->insert('query', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function total_purchase()
    {
        $this->db->where('is_deleted', '0');
        $query = $this->db->get('purchase');
        return $query->num_rows();
    }

    public function get_all_dope_test($limit, $start, $patient_id, $mobile_number, $registration_number)
    {


        $this->db->limit($limit, $start);
        if ($patient_id != NULL) {
            $this->db->where('checkin.patient_id', $patient_id);
        }
        if ($mobile_number != NULL) {
            $this->db->where('checkin.patient_id', $mobile_number);
        }
        if ($registration_number != NULL) {
            $this->db->where('checkin.patient_id', $registration_number);
        }
        $this->db->where('dope_test.is_deleted', '0');
        $this->db->join('checkin', 'checkin.patient_id = dope_test.patient_id');

        $this->db->order_by('dope_test.dope_test_id', 'desc');
        $query = $this->db->get("dope_test");
return $query->result();
//        print_r();
//        die;
    }
    function prescription_details($limit, $start = '', $patient_id, $mobile_number, $registration_number) {

        $this->db->limit($limit, $start);
        if ($patient_id != '') {
            $this->db->where('prescription.patient_id', $patient_id);
        }
        if ($mobile_number != NULL) {
            $this->db->where('prescription.patient_id', $mobile_number);
        }
        if ($registration_number != NULL) {
            $this->db->where('prescription.patient_id', $registration_number);
        }
        $this->db->where('prescription.is_deleted', '0');
        $query = $this->db->get("prescription");
        //var_dump($query->result());
        return $query->result();
    }
    public function get_all_counselling($limit, $start, $patient_id = '', $mobile_number = '', $registration_number = '')
    {
        $this->db->limit($limit, $start);
        if ($patient_id != NULL) {
            $this->db->where('counseling.patient_id', $patient_id);
        }
        if ($mobile_number != NULL) {
            $this->db->where('counseling.patient_id', $mobile_number);
        }
        if ($registration_number != NULL) {
            $this->db->where('counseling.patient_id', $registration_number);
        }


        $this->db->where('counseling.is_deleted', '0');
        $this->db->join('checkin', 'checkin.patient_id = counseling.patient_id');
        $this->db->order_by('counseling.counseling_id', 'desc');
        $query = $this->db->get("counseling");

        return $query->result();
    }
    public function get_all_patient($limit, $start, $patient_id = '', $mobile_number = '', $registration_number = '',$from_date,$to_date)
    {

        $this->db->select('admission.date_of_admission as admissionDate,admission.patient_id,admission.registration_number as registrationNumber,admission.admission_id,checkin.*');
        $this->db->limit($limit, $start);
        $this->db->where('admission.is_deleted', '0');
        if ($from_date != NULL&&$to_date != NULL) {
            $this->db->where('admission.date_of_admission>=', date('Y-m-d', strtotime($from_date)));
            $this->db->where('admission.date_of_admission<=', date('Y-m-d', strtotime($to_date)));
//                        print_r($from_date);
//            print_r($to_date);
//        die();

        }else if ($from_date != NULL&& $to_date == NULL) {
            $this->db->where('admission.date_of_admission', date('Y-m-d', strtotime($from_date)));

        }
        else if ($from_date == NULL&& $to_date != NULL) {
            $this->db->where('admission.date_of_admission', date('Y-m-d', strtotime($to_date)));


        }
        if ($patient_id != NULL) {
            $this->db->where('admission.patient_id', $patient_id);
        }
        if ($mobile_number != NULL) {
            $this->db->where('admission.patient_id', $mobile_number);
        }
        if ($registration_number != NULL) {
            $this->db->where('admission.patient_id', $registration_number);
        }

        $this->db->join('checkin', 'checkin.patient_id = admission.patient_id');
        $this->db->order_by('checkin.patient_id', 'desc');
        $query = $this->db->get("admission");
        return $query->result();
    }
}
