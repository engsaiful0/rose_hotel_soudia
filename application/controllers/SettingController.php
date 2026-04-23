<?php

class SettingController extends CI_Controller
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


    public function company_setting()
    {
        $data['output_content'] = $this->load->view('setting/company_setting', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function company_setting_edit_save()
    {
        $banner_id = $this->input->post('banner_id');

        $config['upload_path'] = 'assets/uploads/banner';
        $config['allowed_types'] = '*';
        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;
        $error = array();
        $sdata = array();
        $this->load->library('upload', $config);
        $banner_image = '';
        if (!$this->upload->do_upload('banner_image')) {
            $error = $this->upload->display_errors();
        } else {
            $this->upload->do_upload('banner_image');
            $sdata = $this->upload->data();
            $banner_image = $sdata['file_name'];
        }
        if($banner_image=='')
        {
            $banner_image=$this->input->post('banner_image_edit');
        }

        $favicon = '';
        if (!$this->upload->do_upload('favicon')) {
            $error = $this->upload->display_errors();
        } else {
            $this->upload->do_upload('favicon');
            $sdata = $this->upload->data();
            $favicon = $sdata['file_name'];
        }
        if($favicon=='')
        {
            $favicon=$this->input->post('favicon_edit');
        }

        $logo = '';
        if (!$this->upload->do_upload('logo')) {
            $error = $this->upload->display_errors();
        } else {
            $this->upload->do_upload('logo');
            $sdata = $this->upload->data();
            $logo = $sdata['file_name'];
        }
        if($logo=='')
        {
            $logo=$this->input->post('logo_edit');
        }

        $report_banner = '';
        if (!$this->upload->do_upload('report_banner')) {
            $error = $this->upload->display_errors();
        } else {
            $this->upload->do_upload('report_banner');
            $sdata = $this->upload->data();
            $report_banner = $sdata['file_name'];
        }
        if($report_banner=='')
        {
            $report_banner=$this->input->post('report_banner_edit');
        }


        $company = array(
            'title' => $this->input->post('title'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'hotel_id' => $this->input->post('hotel_id'),
            'website' => $this->input->post('website'),
            'address' => $this->input->post('address'),
            'banner_image' => $banner_image,
            'favicon' => $favicon,
            'logo' => $logo,
            'report_banner' => $report_banner,
        );
        $data['flag'] = '';
        $result='';
        if($banner_id=='')
        {
            $result= $this->db->insert('company', $company);
        }else
        {
            $result=$this->db->where('banner_id',$banner_id)->update('company', $company);
        }

        if ($result) {
            $sdata = array(
                'success' => 'Data has been updated successfully'
            );
            $this->session->set_userdata($sdata);

            $data['output_content'] = $this->load->view('setting/company_setting', '', true);
        } else {
            $sdata = array(
                'success' => 'Error!!Data has not been updated successfully'
            );
            $this->session->set_userdata($sdata);
            $data['output_content'] = $this->load->view('setting/company_setting', '', true);
        }

        $this->load->view('admin_content', $data);
    }
}
