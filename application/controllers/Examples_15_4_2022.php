<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examples extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('Grocery_crud');
        error_reporting(0);
    }

    public function _example_output($output = null)
    {
        $this->load->view('example.php', $output);
    }

    public function offices()
    {
        $output = $this->Grocery_crud->render();

        $this->_example_output($output);
    }

    public function index()
    {
        $this->_example_output((object)array('output' => '', 'js_files' => array(), 'css_files' => array()));
    }

    public function offices_management()
    {
        try {
            $crud = new Grocery_crud();


            $crud->set_table('offices');
            $crud->set_subject('Office');
            $crud->required_fields('city');
            $crud->columns('city', 'country', 'phone', 'addressLine1', 'postalCode');

            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function notice_function_iframe()
    {
        $crud = new Grocery_crud();


        $crud->set_table('notice');
        $crud->set_subject('Notice');
        $crud->required_fields('notice', 'date', 'notice_heading');
        $crud->columns('notice', 'date', 'notice_heading');
        $crud->display_as('notice', 'Notice')->display_as('date', 'Date')->display_as('notice_heading', 'Notice Heading');


        $output = $crud->render();

        $data = array();
        $data['flag'] = '';


        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function notice_function()
    {
        $data['output_content'] = 'examples/notice_function_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function clients()
    {
        $data['output_content'] = 'examples/clients_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function from_and_to_address()
    {
        $data['output_content'] = 'examples/from_and_to_address_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function add_room_type()
    {
        $data['output_content'] = 'examples/add_room_type_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function add_room_type_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('room_type');
        $crud->set_subject('Room Type');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('room_type_name');
        $crud->display_as('room_type_name', 'Room Type Name');
        $crud->columns('room_type_name');
        $crud->fields('room_type_name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function add_late()
    {
        $data['output_content'] = 'examples/add_late_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);

    }

    public function add_late_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('late');
        $crud->set_subject('Late');
        $user_type = $this->session->userdata('type');
        $hotel_id = $this->session->userdata('hotel_id');
        $language = $this->session->userdata('language');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }

        if ($user_type == 'superadmin') {
            $crud->required_fields('amount', 'date');

        } else {
            $crud->required_fields('amount', 'date');
            $crud->where('late.hotel_id', $hotel_id);
        }

        $crud->display_as('room_no_in_english', 'Room No in English');
        $crud->display_as('room_no_in_arabic', 'Room No in Arabic');

        $crud->display_as('features_in_english', 'Features No in English');
        $crud->display_as('features_in_arabic', 'Features No in Arabic');

        if ($language == 'english') {
            if ($user_type == 'superadmin') {
                $crud->set_relation('hotel_id', 'hotel', 'hotel_name_in_english');
            } else {
                $crud->field_type('hotel_id', 'invisible');

                $crud->callback_before_insert(array($this, 'hotel_callback_insert'));
                $crud->callback_before_update(array($this, 'hotel_callback_insert'));
            }
            $crud->display_as('hotel_id', 'Hotel Name in English');
        } else {
            if ($user_type == 'superadmin') {
                $crud->set_relation('hotel_id', 'hotel', 'hotel_name_in_arabic');
            } else {
                $crud->field_type('hotel_id', 'invisible');
                $crud->callback_before_insert(array($this, 'hotel_callback_insert'));
                $crud->callback_before_update(array($this, 'hotel_callback_insert'));
            }

            $crud->display_as('hotel_id', 'Hotel Name in Arabic');
        }


        $crud->columns('amount', 'date', 'hotel_id', 'remarks');
        $crud->fields('amount', 'date', 'hotel_id', 'remarks');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }


    public function add_expense()
    {
        $this->db->truncate('date_range');
        if (isset($_POST['from_date']) || isset($_POST['to_date'])) {
            $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
            $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
            $data['hotel_id'] = $_POST['hotel_id'];
            $this->db->insert('date_range', $data);
        }

        $data['output_content'] = 'examples/add_expense_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);

    }

    public function add_expense_iframe()
    {
        $data_range = $this->db->select('*')->order_by('id', 'DESC')->limit('1')->get('date_range')->row();

        $crud = new Grocery_crud();
        $crud->set_table('expense');
        $crud->set_subject('Expense');
        $user_type = $this->session->userdata('type');

        $language = $this->session->userdata('language');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $from_date = $data_range->from_date;
        $to_date = $data_range->to_date;
        $hotel_id = $data_range->hotel_id;
        if ($user_type == 'superadmin') {

            if ($from_date != '' && $to_date != '' && $hotel_id != '') {
                              $crud->required_fields('amount', 'date');
                if ($from_date != '' && $to_date != '') {
                    $this->db->where('expense.date>=', $from_date);
                    $this->db->where('expense.date<=', $to_date);
                } else if ($from_date != '' && $to_date == '') {
                    $this->db->where('expense.date>=', $from_date);
                    $this->db->where('expense.date<=', $from_date);
//            die('2');
//die;    die('1');
                } else if ($from_date == '' && $to_date != '') {
                    $this->db->where('expense.date>=', $to_date);
                    $this->db->where('expense.date<=', $to_date);
//            die('3');
                }
                if ($hotel_id != '') {
                    $crud->where('expense.hotel_id', $hotel_id);
                }
            }
            $crud->where('expense.type', 'superadmin');

        } else {
            if ($from_date != '' && $to_date != '' && $hotel_id != '') {

                $crud->required_fields('amount', 'date');
                if ($from_date != '' && $to_date != '') {
                    $this->db->where('expense.date>=', $from_date);
                    $this->db->where('expense.date<=', $to_date);

                } else if ($from_date != '' && $to_date == '') {
                    $this->db->where('expense.date>=', $from_date);
                    $this->db->where('expense.date<=', $from_date);
//            die('2');
//die;    die('1');
                } else if ($from_date == '' && $to_date != '') {
                    $this->db->where('expense.date>=', $to_date);
                    $this->db->where('expense.date<=', $to_date);
//            die('3');
                }
                if ($hotel_id != '') {
                    $crud->where('expense.hotel_id', $hotel_id);
                }
                $crud->where('expense.hotel_id', $hotel_id)->where('expense.type', 'admin');
            } else {
                $hotel_id = $this->session->userdata('hotel_id');
                $crud->where('expense.hotel_id', $hotel_id);
            }
        }

        $crud->display_as('room_no_in_english', 'Room No in English');
        $crud->display_as('room_no_in_arabic', 'Room No in Arabic');

        $crud->display_as('features_in_english', 'Features No in English');
        $crud->display_as('features_in_arabic', 'Features No in Arabic');

        if ($language == 'english') {
            if ($user_type == 'superadmin') {
                $crud->set_relation('hotel_id', 'hotel', 'hotel_name_in_english');
            } else {
                $crud->field_type('hotel_id', 'invisible');
                $crud->set_relation('hotel_id', 'hotel', 'hotel_name_in_english');
                $crud->callback_before_insert(array($this, 'hotel_callback_insert'));
                $crud->callback_before_update(array($this, 'hotel_callback_insert'));
            }
            $crud->display_as('hotel_id', 'Hotel Name in English');
        } else {
            if ($user_type == 'superadmin') {
                $crud->set_relation('hotel_id', 'hotel', 'hotel_name_in_arabic');
            } else {
                $crud->set_relation('hotel_id', 'hotel', 'hotel_name_in_english');
                $crud->field_type('hotel_id', 'invisible');
                $crud->callback_before_insert(array($this, 'hotel_callback_insert'));
                $crud->callback_before_update(array($this, 'hotel_callback_insert'));
            }

            $crud->display_as('hotel_id', 'Hotel Name in Arabic');
        }


        $crud->columns('amount', 'date', 'hotel_id', 'remarks');
        $crud->fields('amount', 'date', 'hotel_id', 'remarks', 'type');
        $crud->field_type('type', 'hidden', $user_type);
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }


    public function add_room()
    {
        $data['output_content'] = 'examples/add_room_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function add_room_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('room');
        $crud->set_subject('Room');
        $user_type = $this->session->userdata('type');
        $hotel_id = $this->session->userdata('hotel_id');
        $language = $this->session->userdata('language');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->where('room.hotel_id', $hotel_id);
        if ($user_type == 'superadmin') {
            $crud->required_fields('room_no_in_english', 'room_no_in_arabic', 'hotel_id');

        } else {
            $crud->required_fields('room_no_in_english', 'room_no_in_arabic');
        }

        $crud->display_as('room_no_in_english', 'Room No in English');
        $crud->display_as('room_no_in_arabic', 'Room No in Arabic');

        $crud->display_as('features_in_english', 'Features No in English');
        $crud->display_as('features_in_arabic', 'Features No in Arabic');
        if ($language == 'english') {
            if ($user_type == 'superadmin') {
                $crud->set_relation('hotel_id', 'hotel', 'hotel_name_in_english');
            } else {
                $crud->field_type('hotel_id', 'invisible');

                $crud->callback_before_insert(array($this, 'hotel_callback_insert'));
                $crud->callback_before_update(array($this, 'hotel_callback_insert'));
            }
            $crud->display_as('hotel_id', 'Hotel Name in English');
        } else {
            if ($user_type == 'superadmin') {
                $crud->set_relation('hotel_id', 'hotel', 'hotel_name_in_arabic');
            } else {
                $crud->field_type('hotel_id', 'invisible');
                $crud->callback_before_insert(array($this, 'hotel_callback_insert'));
                $crud->callback_before_update(array($this, 'hotel_callback_insert'));
            }

            $crud->display_as('hotel_id', 'Hotel Name in Arabic');
        }


        $crud->columns('room_no_in_english', 'room_no_in_arabic', 'hotel_id', 'price');
        $crud->fields('room_no_in_english', 'room_no_in_arabic', 'hotel_id', 'price');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    function hotel_callback_insert($post_array)
    {
        $post_array['hotel_id'] = $this->session->userdata('hotel_id');
        $post_array['type'] = $this->session->userdata('type');
        return $post_array;
    }

    public function add_hotel()
    {
        $data['output_content'] = 'examples/add_hotel_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function add_hotel_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('hotel');
        $crud->set_subject('Hotel');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('hotel_name_in_english', 'hotel_name_in_arabic', 'address_in_english', 'address_in_arabic', 'logo');
        $crud->display_as('hotel_name_in_english', 'Hotel Name in English');
        $crud->display_as('hotel_name_in_arabic', 'Hotel Name in Arabic');
        $crud->display_as('address_in_english', 'Address in English');
        $crud->display_as('address_in_arabic', 'Address in Arabic');
        $crud->columns('hotel_name_in_english', 'hotel_name_in_arabic', 'address_in_english', 'address_in_arabic');
        $crud->fields('hotel_name_in_english', 'hotel_name_in_arabic', 'address_in_english', 'address_in_arabic');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function profession_setting()
    {
        $data['output_content'] = 'examples/profession_setting_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function profession_setting_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('profession');
        $crud->set_subject('Profession');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('profession_name_english', 'profession_name_arabic');
        $crud->display_as('profession_name_english', 'Profession Name in English');
        $crud->display_as('profession_name_arabic', 'Profession Name in Arabic');
        $crud->columns('profession_name_english', 'profession_name_arabic');
        $crud->fields('profession_name_english', 'profession_name_arabic');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function add_bed()
    {
        $data['output_content'] = 'examples/add_bed_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function add_bed_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('bed');
        $crud->set_subject('bed');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('bed_name_in_english', 'bed_name_in_arabic');
        $crud->display_as('bed_name_in_english', 'Bed Name in English');
        $crud->display_as('bed_name_in_arabic', 'Bed Name in Arabic');
        $crud->columns('bed_name_in_english', 'bed_name_in_arabic');
        $crud->fields('bed_name_in_english', 'bed_name_in_arabic');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function add_floor()
    {
        $data['output_content'] = 'examples/add_floor_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function add_floor_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('floor');
        $crud->set_subject('floor');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('floor_name_in_english', 'floor_name_in_arabic');
        $crud->display_as('floor_name_in_english', 'Floor Name in English');
        $crud->display_as('floor_name_in_arabic', 'Floor Name in Arabic');
        $crud->columns('floor_name_in_english', 'floor_name_in_arabic');
        $crud->fields('floor_name_in_english', 'floor_name_in_arabic');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function drug_list()
    {
        $data['output_content'] = 'examples/drug_list_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function drug_list_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('drug');
        $crud->set_subject('Drug');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('drug_name');
        $crud->display_as('drug_name', 'Refferal Name');
        $crud->columns('drug_name');
        $crud->fields('drug_name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function referral_setting()
    {
        $data['output_content'] = 'examples/referral_setting_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function referral_setting_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('referral');
        $crud->set_subject('Referral');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('referral_name');
        $crud->display_as('referral_name', 'Refferal Name');
        $crud->columns('referral_name', 'phone', 'address');
        $crud->fields('referral_name', 'phone', 'address');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function religion_setting()
    {
        $data['output_content'] = 'examples/religion_setting_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function religion_setting_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('religion');
        $crud->set_subject('Religion');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('religion_name');
        $crud->display_as('religion_name', 'Religion Name');
        $crud->columns('religion_name');
        $crud->fields('religion_name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function income_head1()
    {
        $data['output_content'] = 'examples/income_head_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function income_head_iframe1()
    {
        $crud = new Grocery_crud();
        $crud->set_table('income_head');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->set_subject('other_cost Head');
        $crud->required_fields('income_head_name');
        $crud->columns('income_head_name');
        $crud->fields('income_head_name');
        $crud->display_as('income_head_name', 'other_cost Head Name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function project()
    {

        $data['output_content'] = 'Examples/project_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function project_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('project');
        $crud->set_subject('Project');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('project_name', 'description', 'address', 'start_date', 'end_date', 'client_id', 'price', 'salvage_cost');
        $crud->columns('project_name', 'description', 'address', 'start_date', 'end_date', 'client_id', 'price', 'salvage_cost', 'revised_price', 'security_money', 'vat_tax');
        $crud->fields('project_name', 'description', 'address', 'start_date', 'end_date', 'client_id', 'price', 'salvage_cost', 'revised_price', 'security_money', 'vat_tax');
        $crud->set_relation('client_id', 'client', 'company_name');
        $crud->display_as('project_name', 'Project Name');
        $crud->display_as('start_date', 'Start Date');
        $crud->display_as('client_id', 'Client Name');
        $crud->display_as('end_date', 'End Date');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function client()
    {
        $data['output_content'] = 'examples/client_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function client_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('client');
        $crud->set_subject('Client');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('company_name', 'address', 'website', 'phone', 'email');
        $crud->columns('company_name', 'address', 'website', 'phone', 'email');
        $crud->fields('company_name', 'address', 'website', 'phone', 'email');
        $crud->display_as('company_name', 'Company Name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function ark_gallery()
    {
        $data['output_content'] = 'examples/ark_gallery_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function ark_gallery_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('ark_gallery');
        $crud->set_subject('ARK Gallery');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('picture');
        $crud->columns('title', 'picture', 'date');
        $crud->fields('title', 'picture', 'date');
        $crud->set_field_upload('picture', 'assets/uploads/ark_gallery');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function user_setting()
    {
        $data['output_content'] = 'examples/user_setting_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function user_setting_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('user');
        $crud->set_subject('User');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('user_name', 'password', 'type');
        $crud->columns('user_name', 'password', 'type', 'picture');
        $crud->fields('user_name', 'password', 'type', 'picture');
        $crud->display_as('user_name', 'user Name');
        $crud->field_type('type', 'dropdown', array('admin' => 'Admin', 'user' => 'User'));
        $crud->set_field_upload('picture', 'assets/uploads/users');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function income_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('other_cost');
        $crud->set_subject('Income');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('income_head_id', 'project_id', 'amount', 'date');
        $crud->columns('income_head_id', 'project_id', 'amount', 'date', 'remarks', 'income_file');
        $crud->fields('income_head_id', 'project_id', 'amount', 'date', 'remarks', 'income_file');
        $crud->display_as('income_head_id', 'Income Head');
        $crud->display_as('project_id', 'Project Name');
        $crud->set_relation('project_id', 'project', 'project_name');
        $crud->set_relation('income_head_id', 'income_head', 'income_head_name');
        $crud->set_field_upload('income_file', 'assets/uploads/income_file');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function income()
    {
        $data['output_content'] = 'examples/income_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function lobbeying_cost_head_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('lobbeying_cost_head');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->set_subject('Lobbeying/Marketing Cost');
        $crud->required_fields('lobbeying_cost_head_name');
        $crud->columns('lobbeying_cost_head_name');
        $crud->fields('lobbeying_cost_head_name');
        $crud->display_as('lobbeying_cost_head_name', 'Head Name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function lobbeying_cost_head()
    {
        $data['output_content'] = 'examples/lobbeying_cost_head_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function labor_cost_head_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('labor_cost_head');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->set_subject('Labor Cost Head');
        $crud->required_fields('labor_cost_head_name');
        $crud->columns('labor_cost_head_name');
        $crud->fields('labor_cost_head_name');
        $crud->display_as('labor_cost_head_name', 'Head Name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function labor_cost_head()
    {
        $data['output_content'] = 'examples/labor_cost_head_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function laborcost_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('counseling');
        $crud->set_subject('Labor Cost');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('labor_cost_head_id', 'project_id', 'amount', 'date');
        $crud->columns('labor_cost_head_id', 'project_id', 'amount', 'date', 'laborcost_file');
        $crud->fields('labor_cost_head_id', 'project_id', 'amount', 'date', 'remarks', 'laborcost_file');
        $crud->set_relation('labor_cost_head_id', 'labor_cost_head', 'labor_cost_head_name');
        $crud->set_relation('project_id', 'project', 'project_name');
        $crud->display_as('labor_cost_head_id', 'Head Name');
        $crud->display_as('project_id', 'Project Name');
        $crud->display_as('laborcost_file', 'Attachment');
        $crud->set_field_upload('laborcost_file', 'assets/uploads/laborcost_file');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function laborcost()
    {
        $data['output_content'] = 'examples/laborcost_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function lobbeyinmarketingcost_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('medication');
        $crud->set_subject('Lobbeying/Marketing Cost');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('lobbeying_cost_head_id', 'project_id', 'amount', 'date');
        $crud->columns('lobbeying_cost_head_id', 'project_id', 'amount', 'date', 'lobbeying_cost_file');
        $crud->fields('lobbeying_cost_head_id', 'project_id', 'amount', 'date', 'remarks', 'lobbeying_cost_file');
        $crud->set_relation('lobbeying_cost_head_id', 'lobbeying_cost_head', 'lobbeying_cost_head_name');
        $crud->set_relation('project_id', 'project', 'project_name');
        $crud->display_as('lobbeying_cost_head_id', 'Head Name');
        $crud->display_as('project_id', 'Project Name');
        $crud->display_as('lobbeying_cost_file', 'Attachment');
        $crud->set_field_upload('lobbeying_cost_file', 'assets/uploads/lobbeying_cost_file');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function lobbeyinmarketingcost()
    {
        $data['output_content'] = 'examples/lobbeyinmarketingcost_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function car_rate_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('car_rate');
        $crud->set_subject('Car Rate');
        $crud->required_fields('car_rental_place_id', 'place', 'price');
        $crud->columns('car_rental_place_id', 'place', 'price');
        $crud->set_relation('car_rental_place_id', 'car_rental_place', 'place_name');
        $crud->fields('car_rental_place_id', 'place', 'price');
        $crud->display_as('car_rental_place_id', 'Place Name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function operationadmincost()
    {
        $data['output_content'] = 'examples/operationadmincost_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function operationadmincost_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('operation_admin_cost');
        $crud->set_subject('Operation & Admin Cost');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('project_id', 'amount', 'date');
        $crud->columns('project_id', 'amount', 'date', 'remarks', 'attachement');
        $crud->fields('project_id', 'amount', 'date', 'remarks', 'attachement');
        $crud->set_relation('project_id', 'project', 'project_name');
        $crud->set_field_upload('attachement', 'assets/uploads/attachement');
        $crud->display_as('project_id', 'Project Name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function authorityofficecost()
    {
        $data['output_content'] = 'examples/authorityofficecost_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function authorityofficecost_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('office_cost');
        $crud->set_subject('Authority Office Cost');
        $user_type = $this->session->userdata('type');
        if ($user_type == 'user') {
            $crud->unset_delete();
            $crud->unset_edit();
        }
        $crud->required_fields('project_id', 'amount', 'date');
        $crud->set_relation('project_id', 'project', 'project_name');
        $crud->columns('project_id', 'amount', 'date', 'remarks', 'attachement');
        $crud->fields('project_id', 'amount', 'date', 'remarks', 'attachement');
        $crud->set_field_upload('attachement', 'assets/uploads/attachement');
        $crud->display_as('project_id', 'Project Name');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }


    public function footer_content()
    {
        $data['output_content'] = 'examples/footer_content_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function footer_content_iframe()
    {
        $crud = new Grocery_crud();
        $crud->set_table('footer_content');
        $crud->set_subject('Footer Content');
        $crud->unset_add();
        $crud->unset_delete();
        $crud->required_fields('footer_text', 'logo_one', 'logo_two', 'logo_three');
        $crud->columns('footer_text', 'logo_one', 'logo_two', 'logo_three');
        $crud->display_as('footer_text', 'Footer Text');
        $crud->display_as('logo_one', 'Logo One');
        $crud->display_as('logo_two', 'Logo Two');
        $crud->display_as('logo_three', 'Logo Three');

        $crud->set_field_upload('logo_one', 'assets/uploads/logo_one');
        $crud->set_field_upload('logo_two', 'assets/uploads/logo_two');
        $crud->set_field_upload('logo_three', 'assets/uploads/logo_three');

        $output = $crud->render();

        $data = array();
        $data['flag'] = '';


        $this->load->view('backend/member_show_to_admin.php', $output);
    }

    public function company_setting()
    {
        $data['output_content'] = 'examples/company_setting_iframe';
        $data['flag'] = 'admin';
        $this->load->view('backend/admin_content', $data);
    }

    public function company_setting_iframe()
    {
        $crud = new Grocery_crud();
        $crud->unset_add();
        $crud->unset_delete();
        $crud->set_table('company');
        $crud->set_subject('Company');
        $crud->required_fields('banner_image', 'title', 'favicon', 'logo', 'mobile', 'email', 'website', 'address');
        $crud->columns('banner_image', 'title', 'favicon', 'logo', 'mobile', 'email', 'website', 'address');
        $crud->fields('banner_image', 'title', 'favicon', 'logo', 'mobile', 'email', 'website', 'address');
        $crud->display_as('banner_image', 'Banner Image');
        $crud->set_field_upload('banner_image', 'assets/uploads/banner');
        $crud->set_field_upload('favicon', 'assets/uploads/banner');
        $crud->set_field_upload('logo', 'assets/uploads/banner');
        $output = $crud->render();
        $data = array();
        $data['flag'] = '';
        $this->load->view('backend/member_show_to_admin.php', $output);
    }


}
