<?php

class UserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("pagination");
        $user_id=$this->session->userdata('id');
        if($user_id=='')
        {
            redirect(base_url().'login');
        }
    }


    public function add_user()
    {
        $data['output_content'] = $this->load->view('user/add_user', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function user_save()
    {

        $user_id_no = $this->input->post('user_id_no');
        $exist_status = $this->db->where('user_id_no', $user_id_no)->get('user')->result();
        if (count($exist_status) == 0) {/*0 means not exit in the purchase details*/
            $config['upload_path'] = 'assets/user/';
            $config['allowed_types'] = '*';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = TRUE;
            $error = array();
            $sdata = array();
            $this->load->library('upload', $config);
            $user_file = 0;
            if (!$this->upload->do_upload('picture')) {
                $error = $this->upload->display_errors();
            } else {
                $this->upload->do_upload('picture');
                $sdata = $this->upload->data();
                $user_file = $sdata['file_name'];
            }


            $user = array(
                'user_name' => $this->input->post('user_name'),
                'password' => $this->input->post('password'),
                'type' => $this->input->post('type'),
                'hotel_id' => $this->input->post('hotel_id'),
                'picture' => $user_file,
            );
            $data['flag'] = '';
            if ($this->db->insert('user', $user)) {
                $sdata = array(
                    'success' => 'Data has been saved successfully'
                );
                $this->session->set_userdata($sdata);

                $data['output_content'] = $this->load->view('user/add_user', '', true);
            } else {
                $sdata = array(
                    'success' => 'Error!!Data has not been saved successfully'
                );
                $this->session->set_userdata($sdata);
                $data['output_content'] = $this->load->view('user/add_user', '', true);
            }
        } else {
            $sdata = array(
                'success' => ''
            );
            $this->session->set_userdata($sdata);
            $data['output_content'] = $this->load->view('user/add_user', '', true);

        }
        $this->load->view('admin_content', $data);
    }

    public function view_user()
    {
        $data['flag'] = '';
        $data['output_content'] = $this->load->view('user/view_user', '', true);
        $this->load->view('admin_content', $data);
    }
    //put your code here
    public function user_delete($user_id)
    {
        $delete=array('is_deleted'=>'1');
        $delete_status = $this->db->where('id', $user_id)->delete('user');
        if ($delete_status) {
            $sdata = array(
                'success' => 'Data has been deleted successfully'
            );
            $this->session->set_userdata($sdata);

            $data['output_content'] = $this->load->view('user/view_user', '', true);
        } else {
            $sdata = array(
                'success' => 'Error!!Data has not been deleted successfully'
            );
            $this->session->set_userdata($sdata);
            $data['output_content'] = $this->load->view('user/view_user', '', true);
        }

        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function user_edit($user_id)
    {
        $data['user_id'] = $user_id;
        $data['output_content'] = $this->load->view('user/user_edit', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function user_edit_save()
    {
        $user_id = $this->input->post('user_id');

        $config['upload_path'] = 'assets/user/';
        $config['allowed_types'] = '*';
        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;
        $error = array();
        $sdata = array();
        $this->load->library('upload', $config);
        $user_file = '';
        if (!$this->upload->do_upload('picture')) {
            $error = $this->upload->display_errors();
        } else {
            $this->upload->do_upload('picture');
            $sdata = $this->upload->data();
            $user_file = $sdata['file_name'];
        }
        if($user_file=='')
        {
            $user_file=$this->input->post('picture_edit');
        }

        $user = array(
            'user_name' => $this->input->post('user_name'),
            'password' => $this->input->post('password'),
            'type' => $this->input->post('type'),
            'hotel_id' => $this->input->post('hotel_id'),
            'picture' => $user_file,
        );
        $data['flag'] = '';
        if ($this->db->where('id',$user_id)->update('user', $user)) {
            $sdata = array(
                'success' => 'Data has been updated successfully'
            );
            $this->session->set_userdata($sdata);

            $data['output_content'] = $this->load->view('user/view_user', '', true);
        } else {
            $sdata = array(
                'success' => 'Error!!Data has not been updated successfully'
            );
            $this->session->set_userdata($sdata);
            $data['output_content'] = $this->load->view('user/view_user', '', true);
        }

        $this->load->view('admin_content', $data);
    }
}
