<?php

class TransactionController extends CI_Controller
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


    public function add_transaction()
    {
        $data['output_content'] = $this->load->view('transaction/add_transaction', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function transaction_save()
    {

        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {

            $config['upload_path'] = 'assets/attachment';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = TRUE;
            $error = array();
            $sdata = array();
            $this->load->library('upload', $config);
            $attachment = '';
            $this->upload->do_upload('attachment');
            // echo '<pre>';
            //var_dump($this->upload->do_upload('attachment'));

            $sdata = $this->upload->data();
            $attachment = $sdata['file_name'];

            // Get form data
            $data = array(
                'hotel_id' => $this->input->post('hotel_id'),
                'description' => $this->input->post('description'),
                'cash_amount' => $this->input->post('cash_amount'),
                'total_amount' => $this->input->post('total_amount'),
                'total_remaining' => $this->input->post('total_remaining'),
                'bank_amount' => $this->input->post('bank_amount'),
                'total_expense' => $this->input->post('total_expense'),

                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'attachment' => $attachment,
                'user_id' => $this->session->userdata('id'),
            );
            $this->db->insert('transactions', $data);
            $transaction_id  = $this->db->insert_id();
            $activity_data = array(
                'user_id' => $this->session->userdata('id'),
                'activity' => 'transaction Info added and Transaction Id is=' . $transaction_id
            );
            $this->db->insert('activity_log', $activity_data);
            $response = array('success' => true, 'message' => 'Data saved successfully.');
            $sdata = array(
                'success' => 'Data has been saved successfully'
            );
            $this->session->set_userdata($sdata);

            // Return a JSON response
            echo json_encode($response);
        } else {
            // If it's not an AJAX request, show an error
            $response = array('error' => true, 'message' => 'Invalid request.');
            echo json_encode($response);
        }
    }


    public function view_transaction($offset = 0)
    {

        $data['flag'] = '';
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $hotel_id = '';
        $hotel_id = $this->input->post('hotel_id') ? $this->input->post('hotel_id') : $_SESSION['hotel_id'];
        
        $config['base_url'] = base_url('view-transaction');
        $config['total_rows'] = $this->TransactionModel->count_all_transaction($hotel_id,$from_date, $to_date);
        $config['per_page'] = 30;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $data['transaction_data'] = $this->TransactionModel->get_transaction($config['per_page'], $offset,$hotel_id, $from_date, $to_date);


        $data['output_content'] = $this->load->view('transaction/view_transaction', $data, true);
        $this->load->view('admin_content', $data);
    }
    public function transaction_edit_save()
    {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {

            $config['upload_path'] = 'assets/attachment/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = TRUE;
            $error = array();
            $sdata = array();
            $this->load->library('upload', $config);
            $attachment = '';
            $this->upload->do_upload('attachment');
            //echo '<pre>';
            // print_r($this->upload->do_upload('picture'));
            $sdata = $this->upload->data();
            $attachment = $sdata['file_name'];
            if ($attachment == '') {
                $attachment = $this->input->post('attachment_edit');
            }


            $transaction_id = $this->input->post('transaction_id');
            // Get form data
            // Get form data
            $data = array(
                'description' => $this->input->post('description'),
                'hotel_id' => $this->input->post('hotel_id'),

                'cash_amount' => $this->input->post('cash_amount'),
                'total_amount' => $this->input->post('total_amount'),
                'total_remaining' => $this->input->post('total_remaining'),
                'bank_amount' => $this->input->post('bank_amount'),
                'total_expense' => $this->input->post('total_expense'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'attachment' => $attachment,
                'user_id' => $this->session->userdata('id'),
            );


            $this->db->where('transaction_id', $transaction_id)->update('transactions', $data);

            $activity_data = array(
                'user_id' => $this->session->userdata('id'),
                'activity' => 'transaction Info Updated and Transaction Id is=' . $transaction_id
            );

            $this->db->insert('activity_log', $activity_data);
            $response = array('success' => true, 'message' => 'Data updated successfully.');
            $sdata = array(
                'success' => 'Data has been updated successfully'
            );
            $this->session->set_userdata($sdata);

            // Return a JSON response
            echo json_encode($response);
        } else {
            // If it's not an AJAX request, show an error
            $response = array('error' => true, 'message' => 'Invalid request.');
            echo json_encode($response);
        }
    }

    //put your code here
    public function transaction_delete($transaction_id)
    {
        $delete = array('is_deleted' => '1');
        $delete_status = $this->db->where('transaction_id ', $transaction_id)->delete('transactions');
        if ($delete_status) {
            $sdata = array(
                'success' => 'Data has been deleted successfully'
            );
            $this->session->set_userdata($sdata);
        } else {
            $sdata = array(
                'success' => 'Error!!Data has not been deleted successfully'
            );
            $this->session->set_userdata($sdata);
        }
        $data['flag'] = '';
        redirect(base_url('view-transaction'));
    }
    public function transaction_edit($transaction_id)
    {
        $data['transaction_id'] = $transaction_id;
        $data['output_content'] = $this->load->view('transaction/transaction_edit', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
}
