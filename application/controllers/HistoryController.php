<?php

class HistoryController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("pagination");
        $user_id = $this->session->userdata('id');
        if ($user_id == '') {
            redirect(base_url() . 'login');
        }
    }

    public function history_delete($history_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('history_id', $history_id)->update('history', $data);
        $sdata['deleted'] = 'Data has been deleted successully';
        $this->session->set_userdata($sdata);
        redirect(base_url() . 'view-history');
    }
    public function add_history()
    {
//die;
        $data['output_content'] = $this->load->view('history/add_history', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function history_save()
    {

        $history_auto_id = $this->input->post('history_auto_id');
        $exist_status = $this->db->where('history_auto_id', $history_auto_id)->get('history')->result();
        if (count($exist_status) == 0) {/*0 means not exit in the purchase details*/

            $config['upload_path'] = 'assets/history_file/';
            $config['allowed_types'] = '*';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = TRUE;
            $error = array();
            $sdata = array();
            $this->load->library('upload', $config);
            $history_file = '';
            if (!$this->upload->do_upload('history_file')) {
                $error = $this->upload->display_errors();
            } else {
                $this->upload->do_upload('history_file');
                $sdata = $this->upload->data();
                $history_file = $sdata['file_name'];
            }


            $last_all_drug_id = $this->input->post('last_all_drug_id');
            $last_all_drugs = '';
            for ($i = 0; $i < count($last_all_drug_id); $i++) {
                $last_all_drugs = $last_all_drugs . '*' . $last_all_drug_id[$i];
            }

            $choose_drug_id = $this->input->post('choose_drug_id');
            $choose_drug = '';
            for ($i = 0; $i < count($choose_drug_id); $i++) {
                $choose_drug = $choose_drug . '*' . $choose_drug_id[$i];
            }

            $cash_received = array(
                'history_auto_id' => $this->input->post('history_auto_id'),
                'patient_id' => $this->input->post('patient_id'),
                'year_id' => $this->input->post('year_id'),
                'asokti_kal' => $this->input->post('asokti_kal'),
                'history_file' => $history_file,

                'first_drug_id' => $this->input->post('first_drug_id'),
                'last_drug_id' => $this->input->post('last_drug_id'),
                'casue' => $this->input->post('casue'),
                'choose_drug_id' => $this->input->post('choose_drug_id'),
                'remarks' => $this->input->post('remarks'),

                'last_all_drug_id' => $last_all_drugs,
                'eager_of_avoid' => $this->input->post('eager_of_avoid'),
                'previous_treatment_history' => $this->input->post('previous_treatment_history'),
                'choose_drug_id' => $choose_drug,

                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'user_id' => $this->session->userdata('id'),
            );
            $data['flag'] = '';
            if ($this->db->insert('history', $cash_received)) {
                $sdata = array(
                    'success' => 'Data has been saved successfully'
                );
                $this->session->set_userdata($sdata);

                $data['output_content'] = $this->load->view('history/add_history', '', true);
            } else {
                $sdata = array(
                    'success' => 'Error!!Data has not been saved successfully'
                );
                $this->session->set_userdata($sdata);
                $data['output_content'] = $this->load->view('history/add_history', '', true);
            }
        } else {
            $sdata = array(
                'success' => ''
            );
            $this->session->set_userdata($sdata);
            $data['output_content'] = $this->load->view('history/add_history', '', true);

        }
        $this->load->view('admin_content', $data);
    }


    //put your code here

    public function view_history()
    {
        $config['base_url'] = site_url('HistoryController/view_history');
        $config['total_rows'] = $this->db->where('is_deleted', '0')->count_all('history');
        $config['per_page'] = 300;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // get books list
        $patient_id = NULL;
        $patient_id = $this->input->post('patient_id');
        $mobile_number = $this->input->post('mobile_number');
        $registration_number = $this->input->post('registration_number');
        $data['result']= $this->HistoryModel->get_all_history($config["per_page"], $data['page'], $patient_id, $mobile_number, $registration_number);
        $data['pagination'] = $this->pagination->create_links();
        $this->defaults['productname'] = '';
//        echo  '<pre>';
//        print_r(  $data['result']);
//        die;
        $data['flag'] = '';
        $data['output_content'] = $this->load->view('history/view_history', $data, true);
        $this->load->view('admin_content', $data);
    }

    public function history_print($history_id)
    {
        $data['history_id'] = $history_id;
        $data['output_content'] = $this->load->view('history/history_print', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function history_edit($history_id)
    {

        $data['history_id'] = $history_id;
        $data['output_content'] = $this->load->view('history/history_edit', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function history_edit_save()
    {
        $history_id = $this->input->post('history_id');

        $config['upload_path'] = 'assets/history_file/';
        $config['allowed_types'] = '*';
        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;
        $error = array();
        $sdata = array();
        $this->load->library('upload', $config);
        $history_file = '';
        if (!$this->upload->do_upload('history_file')) {
            $error = $this->upload->display_errors();
        } else {
            $this->upload->do_upload('history_file');
            $sdata = $this->upload->data();
            $history_file = $sdata['file_name'];
        }


        $last_all_drug_id = $this->input->post('last_all_drug_id');
        $last_all_drugs = '';
        for ($i = 0; $i < count($last_all_drug_id); $i++) {
            $last_all_drugs = $last_all_drugs . '*' . $last_all_drug_id[$i];
        }

        $choose_drug_id = $this->input->post('choose_drug_id');
        $choose_drug = '';
        for ($i = 0; $i < count($choose_drug_id); $i++) {
            $choose_drug = $choose_drug . '*' . $choose_drug_id[$i];
        }

        $cash_received = array(
            'history_auto_id' => $this->input->post('history_auto_id'),
            'patient_id' => $this->input->post('patient_id'),
            'year_id' => $this->input->post('year_id'),
            'asokti_kal' => $this->input->post('asokti_kal'),
            'history_file' => $history_file,

            'first_drug_id' => $this->input->post('first_drug_id'),
            'last_drug_id' => $this->input->post('last_drug_id'),
            'casue' => $this->input->post('casue'),
            'choose_drug_id' => $this->input->post('choose_drug_id'),
            'remarks' => $this->input->post('remarks'),

            'last_all_drug_id' => $last_all_drugs,
            'eager_of_avoid' => $this->input->post('eager_of_avoid'),
            'previous_treatment_history' => $this->input->post('previous_treatment_history'),
            'choose_drug_id' => $choose_drug,

            'date' => date('Y-m-d', strtotime($this->input->post('date'))),
            'user_id' => $this->session->userdata('id'),
        );
        $data['flag'] = '';
        if ($this->db->where('history_id', $history_id)->update('history', $cash_received)) {
            $sdata = array(
                'success' => 'Data has been updated successfully'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-history');
        } else {
            $sdata = array(
                'success' => 'Error!!Data has not been updated successfully'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-history');
        }
        $this->load->view('admin_content', $data);
    }

}
