<?php

class FrontEndcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");

        $this->load->library("pagination");
    }

    public function index() {
        $this->load->view('admin_panel');
    }

    public function member_show_to_user() {
        $this->load->view('content_to_user.php');
    }

    public function sign_in_check() {
        if ($this->session->userdata('name') == '') {
            echo 'no';
        }
    }

    public function hotel_book_now() {
        $data = array();
        $hotel_date_array = $this->input->post('hotel_id');

//        var_dump($hotel_date_array);
//        die;

        $hotel_room_date_array = $this->input->post('hotel_room_id');
        $hotel_room_id = '';
        for ($i = 0; $i < count($hotel_room_date_array); $i++) {
            $hotel_room_id = $hotel_room_date_array[$i];
        }

        $hotel_id = '';
        for ($i = 0; $i < count($hotel_date_array); $i++) {
            $hotel_id = $hotel_date_array[$i];
        }

        $check_in_date = date_create(date('Y-m-d', strtotime($this->input->post('check_id_date'))));
        $check_out_date = date_create(date('Y-m-d', strtotime($this->input->post('check_out_date'))));

        $sdata['redirect_back'] = 'hotel-seat-availability-details/' . $hotel_id;

        $this->session->set_userdata($sdata);
        $data['hotel_id'] = $hotel_id;
        $data['hotel_room_id'] = $hotel_room_id;
        $data['check_id_date'] = $check_in_date;
        $data['check_out_date'] = $check_out_date;

        $diff = date_diff($check_out_date, $check_in_date);
        $total_days = $diff->format("%a");

        $data['total_days'] = $total_days;

        $this->load->view('frontend/hotel_book_now', $data, TRUE);
        $page_data = array(
            'page_name' => 'frontend/hotel_book_now',
            'page_title' => 'Hotel Book Now',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function hotel_seat_availability_details($hotel_id) {

        print_r($hotel_id);
        //die;
        $sdata['redirect_back'] = 'hotels';
        $this->session->set_userdata($sdata);
        $data['hotel_id'] = $hotel_id;

        $this->load->view('frontend/hotel_seat_availability_details', $data, TRUE);
        $page_data = array(
            'page_name' => 'frontend/hotel_seat_availability_details',
            'page_title' => 'Hotel Seat Availability Details',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function flights() {
        $sdata['redirect_back'] = 'flights';
        $this->session->set_userdata($sdata);


        $page_data = array(
            'page_name' => 'frontend/flights',
            'page_title' => 'Flight',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function car() {
        $data = array();
        $sdata['redirect_back'] = 'car';
        $this->session->set_userdata($sdata);

        $page_data = array(
            'page_name' => 'frontend/car',
            'page_title' => 'Car',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function hotels() {
        $sdata['redirect_back'] = 'hotels';
        $this->session->set_userdata($sdata);

        $page_data = array(
            'page_name' => 'frontend/hotels',
            'page_title' => 'Hotels',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function vacation_rental() {
        $sdata['redirect_back'] = 'vacation-rental';
        $this->session->set_userdata($sdata);


        $page_data = array(
            'page_name' => 'frontend/vacation_rental',
            'page_title' => 'Vacation Rental',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function page_load() {
        $page = $_POST['page'];
        $this->load->view('frontend/list_your_property');
    }

    public function about_us() {
        $sdata['redirect_back'] = 'about-us';
        $this->session->set_userdata($sdata);


        $page_data = array(
            'page_name' => 'frontend/about_us',
            'page_title' => 'About Us',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function list_your_property() {
        $sdata['redirect_back'] = 'list-your-property';
        $this->session->set_userdata($sdata);


        $page_data = array(
            'page_name' => 'frontend/list_your_property',
            'page_title' => 'List Your Property',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function cruise() {
        $sdata['redirect_back'] = 'cruise';
        $this->session->set_userdata($sdata);


        $page_data = array(
            'page_name' => 'frontend/cruise',
            'page_title' => 'Cruise',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function sign_up_save() {
        $all = $_POST['all'];
        $all = explode("_", $all);
        $data = array(
            'email' => $all[0],
            'mobile' => $all[1],
            'password' => $all[2],
            'name' => $all[3],
        );
        $save = $this->db->insert('sign_up', $data);
        if ($save) {
            echo 'success';
        } else {
            echo 'failed';
        }
    }

    public function sub_property_load() {
        $property_id = $_POST['property_id'];
        $property = $this->db->where('property_id', $property_id)->get('property')->result();
        ?>
        <option disabled="" selected="" value="">Select Sub Property</option>
        <?php
        foreach ($property as $property_value) {
            ?>
            <option value="<?php echo $property_value->property_id ?>"><?php echo $property_value->property_name ?></option>
            <?php
        }
    }

    public function property_list_save() {

        $config['upload_path'] = './images/property_picture/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $error = array();

        $sdata = array();
        $this->load->library('upload', $config);
        $property_picture = '';

        if (!$this->upload->do_upload('property_picture')) {
            $error = $this->upload->display_errors();
            $error = $this->upload->display_errors();
        } else {
            $sdata = $this->upload->data('property_picture');

            $property_picture = $sdata['file_name'];
        }
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'property_id' => $this->input->post('property_id'),
            'sub_property_id' => $this->input->post('sub_property_id'),
            'property_picture' => $property_picture,
        );
        $this->db->insert('property_list', $data);
        $sdata['success'] = 'saved successully';
        $this->session->set_userdata($sdata);
        //redirect('Content_controller/list_your_property');

        redirect(base_url() . 'list-your-property');
    }

    public function booking_save() {
        $data = array(
            'hotel_id' => $this->input->post('hotel_id'),
            'hotel_room_id' => $this->input->post('hotel_room_id'),
            'total_days' => $this->input->post('total_days'),
            'check_id_date' => $this->input->post('check_id_date'),
            'check_out_date' => $this->input->post('check_out_date'),
            'unit_price' => $this->input->post('unit_price'),
            'total_price' => $this->input->post('total_price'),
            'vat' => $this->input->post('vat'),
            'total_payable' => $this->input->post('total_payable'),
            'address' => $this->input->post('address'),
            'date' =>date('Y-m-d', strtotime($this->input->post('date'))),            
        );
        $this->db->insert('booking_save', $data);
        $sdata['success'] = 'saved successully';
        $this->session->set_userdata($sdata);
     

        redirect(base_url() . 'hotel-seat-availability-details/'.$this->input->post('hotel_id'));
    }

    public function feature_listing_details($feature_listing_id) {
        $data = array();
        $data['feature_listing_id'] = $feature_listing_id;

        $this->load->view('feature_listing_details', $data);
    }

    public function search_result() {
        //die;
        $data = array('video_blog_id' => '');
        $this->load->view('welcome_message', $data);
    }

    public function text_blog_details($news_events_id) {
        $data = array();
        $data['news_events_id'] = $news_events_id;

        $this->load->view('text_blog_details', $data);
    }

    public function individual_member_show() {
        $data = array();
        $data['id'] = $this->input->post('id');
        $data['name'] = $this->input->post('name');

        $data['output_content_user'] = $this->load->view('individual_member_show_to_user', $data, true);
        $this->load->view('content_to_user', $data);
    }

    public function individual_member_show_id($id) {
        $data = array();
        $data['id'] = $id;


        $data['output_content_user'] = $this->load->view('individual_member_show_to_user', $data, true);
        $this->load->view('content_to_user', $data);
    }

    public function notic_details($id) {
        $data = array();
        $data['id'] = $id;


        $data['output_content_user'] = $this->load->view('notice_details_show', $data, true);
        $this->load->view('content_to_user', $data);
    }

    public function company_profile() {
        $data = array();


        $data['output_content_user'] = $this->load->view('company_profile', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function company_brochure() {
        $data = array();


        $data['output_content_user'] = $this->load->view('company_brochure', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function company_video() {
        $data = array();
        $data['output_content_user'] = $this->load->view('company_video', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function cold_rolling() {
        $data = array();


        $data['output_content_user'] = $this->load->view('cold_rolling', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function text_blog() {
        $data = array();
        $this->load->view('text_blog', $data);
    }

    public function amar_orange() {
        $data = array();
        $this->load->view('amar_orange', $data);
    }

    public function amar_led_light() {
        $data = array();
        $this->load->view('amar_led_light', $data);
    }

    public function janata_tasty_saline() {
        $data = array();
        $this->load->view('janata_tasty_saline', $data);
    }

    public function amar_detergent_powder() {
        $data = array();
        $this->load->view('amar_detergent_powder', $data);
    }

    public function amar_ball_pen() {
        $data = array();
        $this->load->view('amar_ball_pen', $data);
    }

    public function janata_tea() {
        $data = array();
        $this->load->view('janata_tea', $data);
    }

    public function download() {
        $data = array();
        $this->load->view('download', $data);
    }

    public function application() {
        $data = array();
        $this->load->view('application', $data);
    }

    public function online_application() {
        $data = array();
        $this->load->view('online_application', $data);
    }

    public function circular() {
        $data = array();
        $this->load->view('circular', $data);
    }

    public function dengu_boma_mosquito_coil() {
        $data = array();
        $this->load->view('dengu_boma_mosquito_coil', $data);
    }

    public function testimonial_details() {
        $data = array();
        $this->load->view('testimonials_details', $data);
    }

    public function video_blog() {
        $data = array();
        $data = array('video_blog_id' => '');
        $this->load->view('video_blog', $data);
    }

    public function fabrication() {
        $data = array();


        $data['output_content_user'] = $this->load->view('fabrication', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function privacy_policy() {
        $sdata['redirect_back'] = 'privacy-policy';
        $this->session->set_userdata($sdata);
        $page_data = array(
            'page_name' => 'frontend/privacy_policy',
            'page_title' => 'Privacy Policy',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function terms_of_use() {
        $sdata['redirect_back'] = 'terms-of-use';
        $this->session->set_userdata($sdata);
        $page_data = array(
            'page_name' => 'frontend/terms_of_use',
            'page_title' => 'Terms of Use',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function faq() {
        $sdata['redirect_back'] = 'faq';
        $this->session->set_userdata($sdata);


        $page_data = array(
            'page_name' => 'frontend/faq',
            'page_title' => 'FAQ',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function support() {
        $sdata['redirect_back'] = 'support';
        $this->session->set_userdata($sdata);


        $page_data = array(
            'page_name' => 'frontend/support',
            'page_title' => 'Support',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function contact_us() {
        $sdata['redirect_back'] = 'contack-us';
        $this->session->set_userdata($sdata);


        $page_data = array(
            'page_name' => 'frontend/contact_us',
            'page_title' => 'Contact Us',
        );
        $this->load->view('frontend/frontend_container', $page_data);
    }

    public function special_info() {
        $data = array();
        $data['output_content_user'] = $this->load->view('special_info', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function news_events() {
        $data = array();
        $data['output_content_user'] = $this->load->view('news_events', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function product_service() {
        $data = array();
        $data['output_content_user'] = $this->load->view('product_service', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function feature_listing() {
        $data = array();
        //$data['output_content_user'] = $this->load->view('about_me', '', true);
        $this->load->view('feature_listing', $data);
    }

    public function about_me() {
        $data = array();
        //$data['output_content_user'] = $this->load->view('about_me', '', true);
        $this->load->view('about_me', $data);
    }

    public function contact() {
        $data = array();


        $data['output_content_user'] = $this->load->view('contact_show', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function our_team() {
        $data = array();


        $data['output_content_user'] = $this->load->view('our_team', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function venture() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/venture";
        $config["total_rows"] = $this->pag->total_venture();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_venture($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('venture_show', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function upcoming_product() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/upcoming_product";
        $config["total_rows"] = $this->pag->total_upcomming_product();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_upcoming_product($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('upcoming_product_show', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function elevator() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/elevator";
        $config["total_rows"] = $this->pag->total_rotary_screw_air_compressor();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_rotary_screw_air_compressor($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('elevator', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function generator() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/generator";
        $config["total_rows"] = $this->pag->total_reciprocating_air_compressor();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_reciprocating_air_compressor($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('generator', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function generator_kj_recardo() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/generator_kj_recardo";
        $config["total_rows"] = $this->db->count_all('generator_kj_recardo');
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_generator_kj_recardo($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('generator_kj_recardo', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function aoyama_elevator_japan() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/aoyama_elevator_japan";
        $config["total_rows"] = $this->db->count_all('aoyama_elevator_japan');
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_aoyama_elevaltor($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('aoyama_elevator_japan', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function escalator() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/escalator";
        $config["total_rows"] = $this->pag->total_air_treatment();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_air_treatment($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('escalator', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function colour_sorter() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/colour_sorter";
        $config["total_rows"] = $this->pag->total_colour_sorter();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_colour_sorter($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('colour_sorter', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function tyre_changer() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/tyre_changer";
        $config["total_rows"] = $this->pag->total_tyre_changer();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_tyre_changer($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('tyre_changer', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function power_trowel() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/power_trowel";
        $config["total_rows"] = $this->pag->total_power_trowel();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_power_trowel($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('power_trowel', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function diesel_generator() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/diesel_generator";
        $config["total_rows"] = $this->pag->total_diesel_generator();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_diesel_generator($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('diesel_generator', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function spare_parts_screw_air_compressor() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/spare_parts_screw_air_compressor";
        $config["total_rows"] = $this->pag->total_spare_parts_screw_air_compressor();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_spare_parts_screw_air_compressor($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('spare_parts_screw_air_compressor', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function construction_equipment() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/construction_equipment";
        $config["total_rows"] = $this->pag->total_construction_equipment();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_construction_equipment($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('construction_equipment', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function submersible_pump() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/submersible_pump";
        $config["total_rows"] = $this->pag->total_submersible_pump();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_submersible_pump($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('submersible_pump', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function play_next_video($video_blog_id) {
        $data = array('video_blog_id' => $video_blog_id);
        $this->load->view('video_blog', $data);
    }

    public function home() {
        $this->load->view('welcome_message');
    }

    public function communication_save_from_home() {
        $data = array();
        $data['first_name'] = $this->input->post('first_name');
        $data['last_name'] = $this->input->post('last_name');
        $data['email'] = $this->input->post('email');

        $data['phone'] = $this->input->post('phone');
        $data['message'] = $this->input->post('message');
        if ($this->Content_model->communication_data_save($data)) {
            $sdata = array();

            $sdata['message_save'] = 'saved';
            $this->session->set_userdata($sdata);

            redirect('Content_controller/home', 'refresh');
        } else {
            $sdata = array();
            $sdata['message_save'] = 'not_saved';
            $this->session->set_userdata($sdata);
            redirect('Content_controller/home', 'refresh');
        }
    }

    public function communication_save() {
        $data = array();
        $data['name'] = $this->input->post('name');

        $data['email'] = $this->input->post('email');

        $data['mobile'] = $this->input->post('mobile');
        $data['message'] = $this->input->post('message');
        if ($this->Content_model->communication_data_save($data)) {
            $sdata = array();

            $sdata['message_save'] = 'saved';
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'support');
        } else {
            $sdata = array();
            $sdata['message_save'] = 'not_saved';
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'support');
        }
    }

    public function publication_gallery() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/publication_gallery";
        $config["total_rows"] = $this->pag->total_publication_photo();
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_publication_image($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('publication_photo_show', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function social_activitires() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/social_activitires";
        $config["total_rows"] = $this->pag->total_social_activities_photo();
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_social_activities_photo($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('social_activities_photo', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function photo_gallery() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/photo_gallery";
        $config["total_rows"] = $this->pag->total_photogallery();
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_photo_gallery_image($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('photo_gallery_show', $result, true);
        $this->load->view('content_to_user', $data);
    }

    Public function clients() {
        $config = array();
        $config["base_url"] = base_url() . "content_controller/clients";
        $config["total_rows"] = $this->pag->total_clients();
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pag->
                get_clients($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('clients_show', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function message_from_show($person) {
        $result = array();

        $result['designation'] = $person;
        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('message_from_show', $result, true);
        $this->load->view('content_to_user', $data);
    }

    public function committee_show() {
        $result = array();


        $data = array();
        $data['flag'] = '';
        $data['output_content_user'] = $this->load->view('committee_show', '', true);
        $this->load->view('content_to_user', $data);
    }

    public function product_details($id) {
        $result = array();


        $data = array();
        $data['flag'] = '';
        $data['id'] = $id;
        $data['output_content_user'] = $this->load->view('product_details_show', $data, true);
        $this->load->view('content_to_user', $data);
    }

    //put your code here
}
