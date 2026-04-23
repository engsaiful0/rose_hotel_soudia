<?php

class ExpenseController extends CI_Controller
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


    public function add_expense()
    {
        $data['output_content'] = $this->load->view('expense/add_expense', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function expense_save()
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
                'description' => $this->input->post('description'),
                'hotel_id' => $this->input->post('hotel_id'),
                'amount' => $this->input->post('amount'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'attachment' => $attachment,
                'user_id' => $this->session->userdata('id'),
            );
            $this->db->insert('expense', $data);
            $expense_id  = $this->db->insert_id();
            $activity_data = array(
                'user_id' => $this->session->userdata('id'),
                'activity' => 'expense Info added and Expense Id is=' . $expense_id
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

    public function view_expense()
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $hotel_id = $this->input->post('hotel_id');

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url() . "index.php/ExpenseController/view_expense";
        $config['total_rows'] =  $this->ExpenseModel->count_all_expense($from_date, $to_date, $hotel_id);
        $config['per_page'] = 30;
        $config['uri_segment'] = 3;

        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);
        $config['num_links'] = 2; // Number of page links to display on either side of the current page

        // Integrate bootstrap pagination
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i> Previous';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next <i class="fa fa-long-arrow-right"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_link'] = 'First'; // Optional: Add a "First" link
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_link'] = 'Last'; // Optional: Add a "Last" link

        // Ensure $page is an integer or zero

        $this->per_page = $config["per_page"];
        $this->pagination->initialize($config);
        // Get medicine sales list

        $data['expense_data'] = $this->ExpenseModel->get_expense($this->per_page, $page, $from_date, $to_date, $hotel_id);
        $data['pagination'] = $this->pagination->create_links();

        $data['output_content'] = $this->load->view('expense/view_expense', $data, true);

        $this->load->view('admin_content', $data); //123
    }

    public function expense_edit_save()
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

            $expense_id = $this->input->post('expense_id');
            // Get form data
            // Get form data
            $data = array(
                'description' => $this->input->post('description'),
                'hotel_id' => $this->input->post('hotel_id'),
                'amount' => $this->input->post('amount'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'attachment' => $attachment,
                'user_id' => $this->session->userdata('id'),
            );


            $this->db->where('expense_id', $expense_id)->update('expense', $data);

            $activity_data = array(
                'user_id' => $this->session->userdata('id'),
                'activity' => 'expense Info Updated and Expense Id is=' . $expense_id
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
    public function expense_delete($expense_id)
    {

        $delete_status = $this->db->where('expense_id ', $expense_id)->delete('expense');
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
        redirect(base_url('view-expense'));
    }
    public function expense_edit($expense_id)
    {
        $data['expense_id'] = $expense_id;
        $data['output_content'] = $this->load->view('expense/expense_edit', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
}
