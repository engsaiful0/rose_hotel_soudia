<?php

class CheckinController extends CI_Controller
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

    public function file_upload()
    {

        //upload file
        $config['upload_path'] = 'assets/images/';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;

        if (isset($_FILES['file']['name'])) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                echo $this->upload->display_errors();
            } else {
                $sdata = $this->upload->data();
                $image_1 = $sdata['file_name'];
                echo $image_1;
            }
        } else {
            echo 'Please choose a file';
        }
    }

    public function load_product_row()
    {
        $data['id'] = $_POST['id'];
        $this->load->view('checkin/load_product_row_day', $data);
    }

    public function load_product_row_month()
    {
        $data['id'] = $_POST['id'];
        $this->load->view('checkin/load_product_row_month', $data);
    }

    public function language_change()
    {
        $languageData = $_POST['languageData'];

        $data = array('language' => $languageData);
        $this->session->set_userdata($data);
        return true;
    }


    public function add_check_in_month()
    {

        $data['output_content'] = $this->load->view('checkin/add_check_in_month', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function add_check_in()
    {

        $data['output_content'] = $this->load->view('checkin/add_check_in', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function country_load()
    {
        $language = $this->session->userdata('language');
        $hotel_id = $this->session->userdata('hotel_id');
        $guest_unique_id = $_POST['guest_unique_id'];
        $guest = $this->db->where('guest_unique_id', $guest_unique_id)->get('checkin')->row();
        $country = $this->db->where('country_id', $guest->country_id)->get('countries')->row();
        ?>
        <option value="<?php echo $country->country_id ?>"><?php
            if ($language == 'english') {
                echo $country->country_enName;
            } else {
                echo $country->country_arName;

            }
            ?></option>
        <?php
        $countries = $this->db->select('*')->get('countries')->result();
        foreach ($countries as $countrie) {
            ?>
            <option value="<?php echo $countrie->country_id ?>"><?php
                if ($language == 'english') {
                    echo $countrie->country_enName;
                } else {
                    echo $countrie->country_arName;

                }
                ?></option>
            <?php
        }
    }

    public function infoLoad()
    {
        $guest_unique_id = $_POST['guest_unique_id'];
        $guest = $this->db->where('guest_unique_id', $guest_unique_id)->get('checkin')->row();
        $country = $this->db->where('country_id', $guest->country_id)->get('countries')->row();
        if ($guest != '') {
            print $guest->guest_name . '*' . $guest->place . '*' . $guest->mobile . '*' . 'old*' . date('d-m-Y', strtotime($guest->date_of_birth)) . '*' . $guest->profession_id . '*' . $country->country_id . '*' . $country->country_enName . '*' . $country->country_arName;
        } else {
            print $guest->guest_name . '*' . $guest->place . '*' . $guest->mobile . '*' . 'old*' . '' . '*' . $guest->profession_id . '*' . $country->country_id . '*' . $country->country_enName . '*' . $country->country_arName;
        }
    }

    public function add_check_in_edit_save()
    {
        $hotel_id = $this->input->get('hotel_id');
        $old_room_id = $this->input->get('old_room_id');
        $guest_unique_id = $this->input->get('guest_unique_id');
        $checkin_id = $this->input->get('checkin_id');
        $guest_type = $this->input->get('guest_type');
        if ($guest_type == 'new') {
            $data = array(
                'guest_unique_id' => $guest_unique_id,
                'hotel_id' => $hotel_id,
            );
            $this->db->insert('checkin_id', $data);
        }


        $data = array(
            'guest_name' => $this->input->get('guest_name'),
            'day_or_month' => $this->input->get('day_or_month'),

            'guest_unique_id' => $this->input->get('guest_unique_id'),
            'country_id' => $this->input->get('country_id'),
            'place' => $this->input->get('place'),
            'date_of_birth' => date('Y-m-d', strtotime($this->input->get('date_of_birth'))),
            'mobile' => $this->input->get('mobile'),
            'profession_id' => $this->input->get('profession_id'),
            'grandRent' => $this->input->get('grandRent'),
            'user_id' => $this->session->userdata('user_id'),
            'hotel_id' => $hotel_id,

        );
        $this->db->where('checkin_id', $checkin_id)->update('checkin', $data);
        $this->db->where('checkin_id', $checkin_id)->delete('checkin_details');/*To delete the previous*/
        $day_or_month_or_year = $this->input->get('day_or_month_or_year');
        $room_id = $this->input->get('room_id');
        $dateOfEntry = $this->input->get('dateOfEntry');
        $dateOfExit = $this->input->get('dateOfExit');
        $rent = $this->input->get('rent');
        $insurance = $this->input->get('insurance');
        $cash_or_credit = $this->input->get('cash_or_credit');
        $account_number = $this->input->get('account_number');
        $due = $this->input->get('due');

        $image_1 = '';
        if ($this->input->get('image_1_name') != '') {
            $image_1 = $this->input->get('image_1_name');
        }
        if ($image_1 == '') {
            $image_1 = $this->input->get('image_old_1');
        }


        $image_2 = '';
        if ($this->input->get('image_2_name') != '') {
            $image_2 = $this->input->get('image_2_name');
        }
        if ($image_2 == '') {
            $image_2 = $this->input->get('image_old_2');
        }

        $image_3 = '';
        if ($this->input->get('image_3_name') != '') {
            $image_3 = $this->input->get('image_3_name');
        }
        if ($image_3 == '') {
            $image_3 = $this->input->get('image_old_3');
        }

        $image_4 = '';
        if ($this->input->get('image_4_name') != '') {
            $image_4 = $this->input->get('image_4_name');
        }
        if ($image_4 == '') {
            $image_4 = $this->input->get('image_old_4');
        }

        $image_5 = '';
        if ($this->input->get('image_5_name') != '') {
            $image_5 = $this->input->get('image_5_name');
        }
        if ($image_5 == '') {
            $image_5 = $this->input->get('image_old_5');
        }

        $image_6 = '';
        if ($this->input->get('image_6_name') != '') {
            $image_6 = $this->input->get('image_6_name');
        }
        if ($image_6 == '') {
            $image_6 = $this->input->get('image_old_6');
        }

        $image_7 = '';
        if ($this->input->get('image_7_name') != '') {
            $image_7 = $this->input->get('image_7_name');
        }
        if ($image_7 == '') {
            $image_7 = $this->input->get('image_old_7');
        }

        $image_8 = '';
        if ($this->input->get('image_8_name') != '') {
            $image_8 = $this->input->get('image_8_name');
        }
        if ($image_8 == '') {
            $image_8 = $this->input->get('image_old_8');
        }

        $image_9 = '';
        if ($this->input->get('image_9_name') != '') {
            $image_9 = $this->input->get('image_9_name');
        }
        if ($image_9 == '') {
            $image_9 = $this->input->get('image_old_9');
        }

        $image_10 = '';
        if ($this->input->get('image_10_name') != '') {
            $image_10 = $this->input->get('image_10_name');
        }
        if ($image_10 == '') {
            $image_10 = $this->input->get('image_old_10');
        }

        $image = '';

        for ($i = 0; $i < count($rent); $i++) {
            if ($rent[$i] == '') {
                continue;
            }
            if ($i == 0) {
                $image = $image_1;
            } else if ($i == 1) {
                $image = $image_2;
            } else if ($i == 2) {
                $image = $image_3;
            } else if ($i == 3) {
                $image = $image_4;
            } else if ($i == 4) {
                $image = $image_5;
            } else if ($i == 5) {
                $image = $image_6;
            } else if ($i == 6) {
                $image = $image_7;
            } else if ($i == 7) {
                $image = $image_8;
            } else if ($i == 8) {
                $image = $image_9;
            } else if ($i == 9) {
                $image = $image_10;
            }

            $data_update_old_room = array('status' => 'Free');
            $this->db->where('room_id', $old_room_id)->where('hotel_id', $hotel_id)->update('room', $data_update_old_room);/*Old Room*/

            $data_update = array('status' => 'Booked', 'price' => $rent[$i], 'day_or_month' => 'day', 'checkin_id' => $checkin_id);
            $this->db->where('room_id', $room_id[$i])->where('hotel_id', $hotel_id)->update('room', $data_update);
            $data = array(
                'day_or_month_or_year' => $day_or_month_or_year[$i],
                'room_id' => $room_id[$i],
                'day_or_month' => 'day',
                'account_number' => $account_number[$i],
                'dateOfEntry' => date('Y-m-d', strtotime($dateOfEntry[$i])),
                'dateOfExit' => date('Y-m-d', strtotime($dateOfExit[$i])),
                'rent' => $rent[$i],
                'due' => $due[$i],
                'image' => $image,
                'cash_or_credit' => $cash_or_credit[$i],
                'insurance' => $insurance[$i],
                'checkin_id' => $checkin_id,
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $hotel_id,
            );
            $this->db->insert('checkin_details', $data);
        }
        $sdata = array(
            'success' => 'Data has been saved successfully'
        );
        $this->session->set_userdata($sdata);
        $data['checkin_id'] = $checkin_id;
        $data['output_content'] = $this->load->view('checkin/print_checkin', $data, true);
        $this->load->view('admin_content', $data);

    }

    public function renew_save()
    {
        $data = array();
        $exist = $this->db->where('uniquid', $this->input->get('uniquid'))
            ->get('checkin')->result();
        if (count($exist) == 0) {
            $guest_unique_id = $this->input->get('guest_unique_id');
            $guest_type = $this->input->get('guest_type');
            if ($guest_type == 'new') {
                $data = array(
                    'guest_unique_id' => $guest_unique_id,
                    'hotel_id' => $this->session->userdata('hotel_id'),
                );
                $this->db->insert('checkin_id', $data);
            }

            $day_or_month_or_year = $this->input->get('day_or_month_or_year');
            $checkin_details_id = $this->input->get('checkin_details_id');
            $room_id = $this->input->get('room_id');
            $dateOfExit = $this->input->get('dateOfExit');
            $dateOfEntry = $this->input->get('dateOfEntry');
            $rent = $this->input->get('rent');
            $cash_or_credit = $this->input->get('cash_or_credit');
            $insurance = $this->input->get('insurance');
            $account_number = $this->input->get('account_number');
            $renew_comment = $this->input->get('renew_comment');
            $due = $this->input->get('due');
            $checkin_id = $this->input->get('checkin_id');
            $old_rent = $this->db->where('checkin_details_id', $checkin_details_id)->get('checkin_details')->row();
            $checkin = $this->db->where('checkin_id', $checkin_id)->get('checkin')->row();
//        echo '<pre>';
//        print_r($old_rent);

            $data_room_renew = array(
                'renew_status' => 'paid',
            );/*to update the renew*/
            //print_r('checkin_details_id='+$checkin_details_id);
            $this->db->where('checkin_details_id', $checkin_details_id)->update('checkin_details', $data_room_renew);


            $data_checkin = array(
                'grandRent' => $rent,
            );



            $image_1 = '';
            if ($this->input->get('image_1_name') != '') {
                $image_1 = $this->input->get('image_1_name');
            }
            $image_2 = '';
            if ($this->input->get('image_2_name') != '') {
                $image_2 = $this->input->get('image_2_name');
            }
            $image_3 = '';
            if ($this->input->get('image_3_name') != '') {
                $image_3 = $this->input->get('image_3_name');
            }
            $image_4 = '';
            if ($this->input->get('image_4_name') != '') {
                $image_4 = $this->input->get('image_4_name');
            }
            $image_5 = '';
            if ($this->input->get('image_5_name') != '') {
                $image_5 = $this->input->get('image_5_name');
            }
            $image_6 = '';
            if ($this->input->get('image_6_name') != '') {
                $image_6 = $this->input->get('image_6_name');
            }
            $image_7 = '';
            if ($this->input->get('image_7_name') != '') {
                $image_7 = $this->input->get('image_7_name');
            }
            $image_8 = '';
            if ($this->input->get('image_8_name') != '') {
                $image_8 = $this->input->get('image_8_name');
            }
            $image_9 = '';
            if ($this->input->get('image_9_name') != '') {
                $image_9 = $this->input->get('image_9_name');
            }
            $image_10 = '';
            if ($this->input->get('image_10_name') != '') {
                $image_10 = $this->input->get('image_10_name');
            }


            $image = '';
            for ($i = 0; $i < count($rent); $i++) {
                if ($rent[$i] == '') {
                    continue;
                }
                if ($i == 0) {
                    $image = $image_1;
                } else if ($i == 1) {
                    $image = $image_2;
                } else if ($i == 2) {
                    $image = $image_3;
                } else if ($i == 3) {
                    $image = $image_4;
                } else if ($i == 4) {
                    $image = $image_5;
                } else if ($i == 5) {
                    $image = $image_6;
                } else if ($i == 6) {
                    $image = $image_7;
                } else if ($i == 7) {
                    $image = $image_8;
                } else if ($i == 8) {
                    $image = $image_9;
                } else if ($i == 9) {
                    $image = $image_10;
                }
            }

            $data = array(
                'guest_name' => $this->input->get('guest_name'),
                'day_or_month' => 'day',
                'guest_unique_id' => $this->input->get('guest_unique_id'),
                'country_id' => $this->input->get('country_id'),
                'place' => $this->input->get('place'),
                'entry_time' => $this->input->get('entry_time'),
                'entry_date' => $this->input->get('entry_date'),
                'data_insert_time' => date('Y-m-d H:i:s'),
                'date_of_birth' => date('Y-m-d', strtotime($this->input->get('date_of_birth'))),
                'mobile' => $this->input->get('mobile'),
                'profession_id' => $this->input->get('profession_id'),
                'grandRent' => $this->input->get('grandRent'),
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $this->session->userdata('hotel_id'),

            );

            $insert_result = $this->db->insert('checkin', $data);
            $checkin_id = $this->db->insert_id();

            $data_room = array('status' => 'Booked', 'price' => $rent, 'day_or_month' => 'day', 'checkin_id' => $checkin_id);
            $this->db->where('room_id', $room_id)->update('room', $data_room);

            $data = array(
                'day_or_month_or_year' => $day_or_month_or_year,
                'dateOfExit' => date('Y-m-d', strtotime($dateOfExit)),
                'dateOfEntry' => date('Y-m-d', strtotime($dateOfEntry)),
                'rent' => $rent,
                'day_or_month' => 'day',
                'room_id' => $room_id,
                'image' => $image_1,
                'due' => $due,
                'checkin_id' => $checkin_id,
                'renew_status' => 'paid',
                'cash_or_credit' => $cash_or_credit,
                'exit_status' => 'no',
                'insurance' => $insurance,
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $this->session->userdata('hotel_id'),
            );
            $data_renew = array(
                'checkin_id' => $checkin_id,
                'checkin_details_id' => $checkin_details_id,
                'room_id' => $room_id,
                'dateOfExit' => date('Y-m-d', strtotime($dateOfExit)),
                'rent' => $rent,
                'due' => $due,
                'cash_or_credit' => $cash_or_credit,
                'insurance' => $insurance,
                'renew_comment' => $renew_comment,
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $this->session->userdata('hotel_id'),
            );

            $this->db->insert('checkin_details', $data);
            $this->db->insert('renew', $data_renew);
            $sdata = array(
                'success' => 'Payment Completed'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-check-in');
        } else {
            redirect(base_url() . 'view-check-in');
        }

    }

    public function renew_month_save()
    {
        $data = array();
        $exist = $this->db->where('uniquid', $this->input->get('uniquid'))
            ->get('checkin')->result();
        if (count($exist) == 0) {
            $guest_unique_id = $this->input->get('guest_unique_id');
            $guest_type = $this->input->get('guest_type');
            if ($guest_type == 'new') {
                $data = array(
                    'guest_unique_id' => $guest_unique_id,
                    'hotel_id' => $this->session->userdata('hotel_id'),
                );
                $this->db->insert('checkin_id', $data);
            }

            $day_or_month_or_year = $this->input->get('day_or_month_or_year');
            $dateOfEntry = $this->input->get('dateOfEntry');

            $checkin_details_id = $this->input->get('checkin_details_id');
            $room_id = $this->input->get('room_id');
            $dateOfExit = $this->input->get('dateOfExit');
            $rent = $this->input->get('rent');
            $cash_or_credit = $this->input->get('cash_or_credit');
            $insurance = $this->input->get('insurance');
            $renew_comment = $this->input->get('renew_comment');
            $checkin_id = $this->input->get('checkin_id');
            $account_number = $this->input->get('account_number');
            $due = $this->input->get('due');


            $image_1 = '';
            if ($this->input->get('image_1_name') != '') {
                $image_1 = $this->input->get('image_1_name');
            }
            $image_2 = '';
            if ($this->input->get('image_2_name') != '') {
                $image_2 = $this->input->get('image_2_name');
            }
            $image_3 = '';
            if ($this->input->get('image_3_name') != '') {
                $image_3 = $this->input->get('image_3_name');
            }
            $image_4 = '';
            if ($this->input->get('image_4_name') != '') {
                $image_4 = $this->input->get('image_4_name');
            }
            $image_5 = '';
            if ($this->input->get('image_5_name') != '') {
                $image_5 = $this->input->get('image_5_name');
            }
            $image_6 = '';
            if ($this->input->get('image_6_name') != '') {
                $image_6 = $this->input->get('image_6_name');
            }
            $image_7 = '';
            if ($this->input->get('image_7_name') != '') {
                $image_7 = $this->input->get('image_7_name');
            }
            $image_8 = '';
            if ($this->input->get('image_8_name') != '') {
                $image_8 = $this->input->get('image_8_name');
            }
            $image_9 = '';
            if ($this->input->get('image_9_name') != '') {
                $image_9 = $this->input->get('image_9_name');
            }
            $image_10 = '';
            if ($this->input->get('image_10_name') != '') {
                $image_10 = $this->input->get('image_10_name');
            }


            $image = '';
            for ($i = 0; $i < count($rent); $i++) {
                if ($rent[$i] == '') {
                    continue;
                }
                if ($i == 0) {
                    $image = $image_1;
                } else if ($i == 1) {
                    $image = $image_2;
                } else if ($i == 2) {
                    $image = $image_3;
                } else if ($i == 3) {
                    $image = $image_4;
                } else if ($i == 4) {
                    $image = $image_5;
                } else if ($i == 5) {
                    $image = $image_6;
                } else if ($i == 6) {
                    $image = $image_7;
                } else if ($i == 7) {
                    $image = $image_8;
                } else if ($i == 8) {
                    $image = $image_9;
                } else if ($i == 9) {
                    $image = $image_10;
                }
            }
                $data_room_renew = array(
                'renew_status' => 'paid',
                'account_number' => $account_number[0],
            );/*to update the renew*/
            //print_r('checkin_details_id='+$checkin_details_id);
            $this->db->where('checkin_details_id', $checkin_details_id)->update('checkin_details', $data_room_renew);

            $data = array(
                'guest_name' => $this->input->get('guest_name'),
                'day_or_month' => 'month',

                'guest_unique_id' => $this->input->get('guest_unique_id'),
                'country_id' => $this->input->get('country_id'),
                'place' => $this->input->get('place'),
                'date_of_birth' => date('Y-m-d', strtotime($this->input->get('date_of_birth'))),
                'mobile' => $this->input->get('mobile'),
                'entry_time' => $this->input->get('entry_time'),
                'entry_date' => $this->input->get('entry_date'),
                'data_insert_time' => date('Y-m-d H:i:s'),
                'profession_id' => $this->input->get('profession_id'),
                'grandRent' => $this->input->get('grandRent'),
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $this->session->userdata('hotel_id'),

            );


            $insert_result = $this->db->insert('checkin', $data);
            $checkin_id = $this->db->insert_id();

            $data_room = array('status' => 'Booked', 'price' => $rent, 'day_or_month' => 'month', 'checkin_id' => $checkin_id);
            $this->db->where('room_id', $room_id)->update('room', $data_room);
            $data = array(
                'day_or_month_or_year' => $day_or_month_or_year,
                'dateOfExit' => date('Y-m-d', strtotime($dateOfExit)),
                'dateOfEntry' => date('Y-m-d', strtotime($dateOfEntry)),
                'rent' => $rent,
                'day_or_month' => 'month',
                'checkin_id' => $checkin_id,
                'room_id' => $room_id,
                'renew_status' => 'paid',
                'image' => $image_1,
                'due' => $due,
                'data_insert_time' => date('Y-m-d H:i:s'),
                'cash_or_credit' => $cash_or_credit,
                'exit_status' => 'no',
                'insurance' => $insurance,
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $this->session->userdata('hotel_id'),
            );
            $data_renew = array(
                'checkin_id' => $checkin_id,
                'checkin_details_id' => $checkin_details_id,
                'room_id' => $room_id,
                'dateOfExit' => date('Y-m-d', strtotime($dateOfExit)),
                'rent' => $rent,
                'cash_or_credit' => $cash_or_credit,
                'insurance' => $insurance,
                'data_insert_time' => date('Y-m-d H:i:s'),
                'renew_comment' => $renew_comment,
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $this->session->userdata('hotel_id'),
            );

            $this->db->insert('checkin_details', $data);
            $this->db->insert('renew', $data_renew);

            $sdata = array(
                'success' => 'Payment Completed'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-check-in-month');
        } else {
            redirect(base_url() . 'view-check-in-month');
        }

    }

    public function renew($checkin_details_id)
    {
        $data['checkin_details_id'] = $checkin_details_id;
        $data['output_content'] = $this->load->view('checkin/renew', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function start_renew_day($checkin_details_id)
    {
        $checkin_details = $this->db->where('checkin_details_id', $checkin_details_id)->get('checkin_details')->row();
        $room_status = $this->db->where('room_id', $checkin_details->room_id)->get('room')->row();
        if ($checkin_details->exit_status == 'yes' && $room_status->status == 'Free') {
            $data_room = array(
                'renew_status' => 'renew_sarted',
            );
            $this->db->where('checkin_details_id', $checkin_details_id)->update('checkin_details', $data_room);
            $data_room = array(
                'status' => 'Renew'
            );

            $checkin_details = $this->db->where('checkin_details_id', $checkin_details_id)->get('checkin_details')->row();
//        echo '<pre>';
//        print_r($checkin_details);
            $this->db->where('room_id', $checkin_details->room_id)->update('room', $data_room);
            $sdata = array(
                'success' => 'Renew started'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-check-in');
        } else {
            $sdata = array(
                'success' => 'Failed!! Please exit <b>' . $room_status->room_no_in_english . '</b> no room and try again'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-check-in');
        }

    }

    public function start_renew_month($checkin_details_id)
    {
        $checkin_details = $this->db->where('checkin_details_id', $checkin_details_id)->get('checkin_details')->row();
        $room_status = $this->db->where('room_id', $checkin_details->room_id)->get('room')->row();
        if ($checkin_details->exit_status == 'yes' && $room_status->status == 'Free') {
            $data_room = array(
                'renew_status' => 'renew_sarted',
            );
            $this->db->where('checkin_details_id', $checkin_details_id)->update('checkin_details', $data_room);
            $data_room = array(
                'status' => 'Renew'
            );

            $checkin_details = $this->db->where('checkin_details_id', $checkin_details_id)->get('checkin_details')->row();
            $this->db->where('room_id', $checkin_details->room_id)->update('room', $data_room);

            $sdata = array(
                'success' => 'Renew started'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-check-in-month');
        } else {
            $sdata = array(
                'success' => 'Failed!! Please exit <b>' . $room_status->room_no_in_english . '</b> no room and try again'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-check-in-month');
        }

    }

    public function renew_month($checkin_details_id)
    {
        $data['checkin_details_id'] = $checkin_details_id;
        $data['output_content'] = $this->load->view('checkin/renew_month', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function exit_save()
    {
        $checkin_details_id = $this->input->post('checkin_details_id');
        $room_id = $this->input->post('room_id');

        $data = array(
            'exit_status' => 'yes'
        );
        $data_room = array(
            'status' => 'Free'
        );
        $sdata = array(
            'success' => 'Data has been saved successfully'
        );
        $this->session->set_userdata($sdata);
        $this->db->where('checkin_details_id', $checkin_details_id)->update('checkin_details', $data);
        $this->db->where('room_id', $room_id)->update('room', $data_room);
        redirect(base_url() . 'view-check-in');
    }

    public function exit_month_save()
    {
        $checkin_details_id = $this->input->post('checkin_details_id');
        $room_id = $this->input->post('room_id');

        $data = array(
            'exit_status' => 'yes'
        );
        $data_room = array(
            'status' => 'Free'
        );
        $sdata = array(
            'success' => 'Data has been saved successfully'
        );
        $this->db->where('checkin_details_id', $checkin_details_id)->update('checkin_details', $data);
        $this->db->where('room_id', $room_id)->update('room', $data_room);
        redirect(base_url() . 'view-check-in-month');
    }

    public function add_check_in_month_edit_save()
    {
        $hotel_id = $this->input->get('hotel_id');
        $old_room_id = $this->input->get('old_room_id');
        $guest_unique_id = $this->input->get('guest_unique_id');
        $checkin_id = $this->input->get('checkin_id');
        $guest_type = $this->input->get('guest_type');
        if ($guest_type == 'new') {
            $data = array(
                'guest_unique_id' => $guest_unique_id,
                'hotel_id' => $hotel_id,
            );
            $this->db->insert('checkin_id', $data);
        }


        $data = array(
            'guest_name' => $this->input->get('guest_name'),
            'day_or_month' => $this->input->get('day_or_month'),

            'guest_unique_id' => $this->input->get('guest_unique_id'),
            'country_id' => $this->input->get('country_id'),
            'place' => $this->input->get('place'),
            'date_of_birth' => date('Y-m-d', strtotime($this->input->get('date_of_birth'))),
            'mobile' => $this->input->get('mobile'),
            'profession_id' => $this->input->get('profession_id'),
            'grandRent' => $this->input->get('grandRent'),
            'user_id' => $this->session->userdata('user_id'),
            'hotel_id' => $hotel_id,

        );
        $this->db->where('checkin_id', $checkin_id)->update('checkin', $data);
        $this->db->where('checkin_id', $checkin_id)->delete('checkin_details');/*To delete the previous*/
        $day_or_month_or_year = $this->input->get('day_or_month_or_year');
        $room_id = $this->input->get('room_id');
        $dateOfEntry = $this->input->get('dateOfEntry');
        $dateOfExit = $this->input->get('dateOfExit');
        $rent = $this->input->get('rent');
        $insurance = $this->input->get('insurance');
        $cash_or_credit = $this->input->get('cash_or_credit');
        $account_number = $this->input->get('account_number');
        $due = $this->input->get('due');

        $image_1 = '';
        if ($this->input->get('image_1_name') != '') {
            $image_1 = $this->input->get('image_1_name');
        }
        if ($image_1 == '') {
            $image_1 = $this->input->get('image_old_1');
        }


        $image_2 = '';
        if ($this->input->get('image_2_name') != '') {
            $image_2 = $this->input->get('image_2_name');
        }
        if ($image_2 == '') {
            $image_2 = $this->input->get('image_old_2');
        }

        $image_3 = '';
        if ($this->input->get('image_3_name') != '') {
            $image_3 = $this->input->get('image_3_name');
        }
        if ($image_3 == '') {
            $image_3 = $this->input->get('image_old_3');
        }

        $image_4 = '';
        if ($this->input->get('image_4_name') != '') {
            $image_4 = $this->input->get('image_4_name');
        }
        if ($image_4 == '') {
            $image_4 = $this->input->get('image_old_4');
        }

        $image_5 = '';
        if ($this->input->get('image_5_name') != '') {
            $image_5 = $this->input->get('image_5_name');
        }
        if ($image_5 == '') {
            $image_5 = $this->input->get('image_old_5');
        }

        $image_6 = '';
        if ($this->input->get('image_6_name') != '') {
            $image_6 = $this->input->get('image_6_name');
        }
        if ($image_6 == '') {
            $image_6 = $this->input->get('image_old_6');
        }

        $image_7 = '';
        if ($this->input->get('image_7_name') != '') {
            $image_7 = $this->input->get('image_7_name');
        }
        if ($image_7 == '') {
            $image_7 = $this->input->get('image_old_7');
        }

        $image_8 = '';
        if ($this->input->get('image_8_name') != '') {
            $image_8 = $this->input->get('image_8_name');
        }
        if ($image_8 == '') {
            $image_8 = $this->input->get('image_old_8');
        }

        $image_9 = '';
        if ($this->input->get('image_9_name') != '') {
            $image_9 = $this->input->get('image_9_name');
        }
        if ($image_9 == '') {
            $image_9 = $this->input->get('image_old_9');
        }

        $image_10 = '';
        if ($this->input->get('image_10_name') != '') {
            $image_10 = $this->input->get('image_10_name');
        }
        if ($image_10 == '') {
            $image_10 = $this->input->get('image_old_10');
        }

        $image = '';

        for ($i = 0; $i < count($rent); $i++) {
            if ($rent[$i] == '') {
                continue;
            }
            if ($i == 0) {
                $image = $image_1;
            } else if ($i == 1) {
                $image = $image_2;
            } else if ($i == 2) {
                $image = $image_3;
            } else if ($i == 3) {
                $image = $image_4;
            } else if ($i == 4) {
                $image = $image_5;
            } else if ($i == 5) {
                $image = $image_6;
            } else if ($i == 6) {
                $image = $image_7;
            } else if ($i == 7) {
                $image = $image_8;
            } else if ($i == 8) {
                $image = $image_9;
            } else if ($i == 9) {
                $image = $image_10;
            }

            $data_update_old_room = array('status' => 'Free');
            $this->db->where('room_id', $old_room_id)->where('hotel_id', $hotel_id)->update('room', $data_update_old_room);

            $data_update = array('status' => 'Booked', 'price' => $rent[$i], 'day_or_month' => 'month', 'checkin_id' => $checkin_id);
            $this->db->where('room_id', $room_id[$i])->where('hotel_id', $hotel_id)->update('room', $data_update);
            $data = array(
                'day_or_month_or_year' => $day_or_month_or_year[$i],
                'room_id' => $room_id[$i],
                'day_or_month' => 'month',
                'account_number' => $account_number[$i],
                'dateOfEntry' => date('Y-m-d', strtotime($dateOfEntry[$i])),
                'dateOfExit' => date('Y-m-d', strtotime($dateOfExit[$i])),
                'rent' => $rent[$i],
                'due' => $due[$i],
                'image' => $image,
                'cash_or_credit' => $cash_or_credit[$i],
                'insurance' => $insurance[$i],
                'checkin_id' => $checkin_id,
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $hotel_id,
            );
            $this->db->insert('checkin_details', $data);
        }
        $sdata = array(
            'success' => 'Data has been saved successfully'
        );
        $this->session->set_userdata($sdata);
        $data['checkin_id'] = $checkin_id;
        $data['output_content'] = $this->load->view('checkin/print_checkin_month', $data, true);
        $this->load->view('admin_content', $data);
    }

    public function add_check_in_save()
    {
        $data = array();
        $is_ajax = $this->input->is_ajax_request();
        $request_value = function ($key) {
            $value = $this->input->post($key);
            return $value !== null ? $value : $this->input->get($key);
        };
        $exist = $this->db->where('uniquid', $request_value('uniquid'))
            ->get('checkin')->result();
        if (count($exist) == 0) {
            $guest_unique_id = $request_value('guest_unique_id');
            $guest_type = $request_value('guest_type');
            if ($guest_type == 'new') {
                $data = array(
                    'guest_unique_id' => $guest_unique_id,
                    'hotel_id' => $this->session->userdata('hotel_id'),
                );
                $this->db->insert('checkin_id', $data);
            }


            $data = array(
                'guest_name' => $request_value('guest_name'),
                'day_or_month' => $request_value('day_or_month'),
                'uniquid' => $request_value('uniquid'),
                'guest_unique_id' => $request_value('guest_unique_id'),
                'country_id' => $request_value('country_id'),
                'place' => $request_value('place'),
                'date_of_birth' => date('Y-m-d', strtotime($request_value('date_of_birth'))),
                'mobile' => $request_value('mobile'),
                'entry_time' => $request_value('entry_time'),
                'entry_date' => $request_value('entry_date'),
                'data_insert_time' => date('Y-m-d H:i:s'),
                
                'profession_id' => $request_value('profession_id'),
                'grandRent' => $request_value('grandRent'),
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $this->session->userdata('hotel_id'),

            );
            $day_or_month_or_year = $request_value('day_or_month_or_year');
            $room_id = $request_value('room_id');
            $dateOfEntry = $request_value('dateOfEntry');
            $dateOfExit = $request_value('dateOfExit');
            $rent = $request_value('rent');
            $insurance = $request_value('insurance');
            $cash_or_credit = $request_value('cash_or_credit');
            $account_number = $request_value('account_number');
            $due = $request_value('due');

            $insert_result = $this->db->insert('checkin', $data);
            $insert_id = $this->db->insert_id();

            // Update guest information in all checkin records with the same guest_unique_id
            $guest_update_data = array(
                'guest_name' => $request_value('guest_name'),
                'mobile' => $request_value('mobile'),
                'profession_id' => $request_value('profession_id'),
                'place' => $request_value('place'),
            );
            $this->db->where('guest_unique_id', $request_value('guest_unique_id'))
                     ->update('checkin', $guest_update_data);

            $image_1 = '';
            if ($request_value('image_1_name') != '') {
                $image_1 = $request_value('image_1_name');
            }
            $image_2 = '';
            if ($request_value('image_2_name') != '') {
                $image_2 = $request_value('image_2_name');
            }
            $image_3 = '';
            if ($request_value('image_3_name') != '') {
                $image_3 = $request_value('image_3_name');
            }
            $image_4 = '';
            if ($request_value('image_4_name') != '') {
                $image_4 = $request_value('image_4_name');
            }
            $image_5 = '';
            if ($request_value('image_5_name') != '') {
                $image_5 = $request_value('image_5_name');
            }
            $image_6 = '';
            if ($request_value('image_6_name') != '') {
                $image_6 = $request_value('image_6_name');
            }
            $image_7 = '';
            if ($request_value('image_7_name') != '') {
                $image_7 = $request_value('image_7_name');
            }
            $image_8 = '';
            if ($request_value('image_8_name') != '') {
                $image_8 = $request_value('image_8_name');
            }
            $image_9 = '';
            if ($request_value('image_9_name') != '') {
                $image_9 = $request_value('image_9_name');
            }
            $image_10 = '';
            if ($request_value('image_10_name') != '') {
                $image_10 = $request_value('image_10_name');
            }

            $image = '';
            for ($i = 0; $i < count($rent); $i++) {
                if ($rent[$i] == '') {
                    continue;
                }
                if ($i == 0) {
                    $image = $image_1;
                } else if ($i == 1) {
                    $image = $image_2;
                } else if ($i == 2) {
                    $image = $image_3;
                } else if ($i == 3) {
                    $image = $image_4;
                } else if ($i == 4) {
                    $image = $image_5;
                } else if ($i == 5) {
                    $image = $image_6;
                } else if ($i == 6) {
                    $image = $image_7;
                } else if ($i == 7) {
                    $image = $image_8;
                } else if ($i == 8) {
                    $image = $image_9;
                } else if ($i == 9) {
                    $image = $image_10;
                }
                $data_update = array('status' => 'Booked', 'price' => $rent[$i], 'day_or_month' => 'day', 'checkin_id' => $insert_id);
                $this->db->where('room_id', $room_id[$i])->where('hotel_id', $this->session->userdata('hotel_id'))->update('room', $data_update);
                $data = array(
                    'day_or_month_or_year' => $day_or_month_or_year[$i],
                    'room_id' => $room_id[$i],
                    'day_or_month' => 'day',
                    'account_number' => $account_number[$i],
                    'cash_or_credit' => $cash_or_credit[$i],
                    'dateOfEntry' => date('Y-m-d', strtotime($dateOfEntry[$i])),
                    'dateOfExit' => date('Y-m-d', strtotime($dateOfExit[$i])),
                    'rent' => $rent[$i],
                    'due' => $due[$i],
                    'image' => $image,
                    'data_insert_time' => date('Y-m-d H:i:s'),
                    'insurance' => $insurance[$i],
                    'checkin_id' => $insert_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'hotel_id' => $this->session->userdata('hotel_id'),
                );
                $this->db->insert('checkin_details', $data);
            }
            $sdata = array(
                'success' => 'Data has been saved successfully'
            );
            $this->session->set_userdata($sdata);

            if ($is_ajax) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Data has been saved successfully',
                    'redirect_url' => base_url('checkin-print/' . $insert_id),
                ));
                return;
            }

            $data['checkin_id'] = $insert_id;
            $data['output_content'] = $this->load->view('checkin/print_checkin', $data, true);
            $this->load->view('admin_content', $data);
        } else {
            if ($is_ajax) {
                echo json_encode(array(
                    'status' => 'duplicate',
                    'message' => 'This data has already been saved.',
                ));
                return;
            }
            $data['output_content'] = $this->load->view('checkin/print_checkin', $data, true);
            $this->load->view('admin_content', $data);
        }
    }

    public function add_check_in_save_month()
    {
        $data = array();
        $is_ajax = $this->input->is_ajax_request();
        $request_value = function ($key) {
            $value = $this->input->post($key);
            return $value !== null ? $value : $this->input->get($key);
        };
        $exist = $this->db->where('uniquid', $request_value('uniquid'))
            ->get('checkin')->result();
        if (count($exist) == 0) {
            $guest_unique_id = $request_value('guest_unique_id');
            $guest_type = $request_value('guest_type');
            if ($guest_type == 'new') {
                $data = array(
                    'guest_unique_id' => $guest_unique_id,
                    'hotel_id' => $this->session->userdata('hotel_id'),
                );
                $this->db->insert('checkin_id', $data);
            }


            $data = array(
                'guest_name' => $request_value('guest_name'),
                'day_or_month' => $request_value('day_or_month'),
                'uniquid' => $request_value('uniquid'),

                'guest_unique_id' => $request_value('guest_unique_id'),
                'country_id' => $request_value('country_id'),
                'place' => $request_value('place'),
                'date_of_birth' => date('Y-m-d', strtotime($request_value('date_of_birth'))),
                'mobile' => $request_value('mobile'),
                'entry_time' => $request_value('entry_time'),
                'entry_date' => $request_value('entry_date'),
                'data_insert_time' => date('Y-m-d H:i:s'),
                'profession_id' => $request_value('profession_id'),
                'grandRent' => $request_value('grandRent'),
                'user_id' => $this->session->userdata('user_id'),
                'hotel_id' => $this->session->userdata('hotel_id'),

            );
            $day_or_month_or_year = $request_value('day_or_month_or_year');
            $room_id = $request_value('room_id');
            $dateOfEntry = $request_value('dateOfEntry');
            $dateOfExit = $request_value('dateOfExit');
            $rent = $request_value('rent');
            $insurance = $request_value('insurance');
            $cash_or_credit = $request_value('cash_or_credit');
            $account_number = $request_value('account_number');
            $insert_result = $this->db->insert('checkin', $data);
            $due = $request_value('due');
            $insert_id = $this->db->insert_id();

            // Update guest information in all checkin records with the same guest_unique_id
            $guest_update_data = array(
                'guest_name' => $request_value('guest_name'),
                'mobile' => $request_value('mobile'),
                'profession_id' => $request_value('profession_id'),
                'place' => $request_value('place'),
            );
            $this->db->where('guest_unique_id', $request_value('guest_unique_id'))
                     ->update('checkin', $guest_update_data);

            $image_1 = '';
            if ($request_value('image_1_name') != '') {
                $image_1 = $request_value('image_1_name');
            }
            $image_2 = '';
            if ($request_value('image_2_name') != '') {
                $image_2 = $request_value('image_2_name');
            }
            $image_3 = '';
            if ($request_value('image_3_name') != '') {
                $image_3 = $request_value('image_3_name');
            }
            $image_4 = '';
            if ($request_value('image_4_name') != '') {
                $image_4 = $request_value('image_4_name');
            }
            $image_5 = '';
            if ($request_value('image_5_name') != '') {
                $image_5 = $request_value('image_5_name');
            }
            $image_6 = '';
            if ($request_value('image_6_name') != '') {
                $image_6 = $request_value('image_6_name');
            }
            $image_7 = '';
            if ($request_value('image_7_name') != '') {
                $image_7 = $request_value('image_7_name');
            }
            $image_8 = '';
            if ($request_value('image_8_name') != '') {
                $image_8 = $request_value('image_8_name');
            }
            $image_9 = '';
            if ($request_value('image_9_name') != '') {
                $image_9 = $request_value('image_9_name');
            }
            $image_10 = '';
            if ($request_value('image_10_name') != '') {
                $image_10 = $request_value('image_10_name');
            }


            $image = '';
            for ($i = 0; $i < count($rent); $i++) {
                if ($rent[$i] == '') {
                    continue;
                }
                if ($i == 0) {
                    $image = $image_1;
                } else if ($i == 1) {
                    $image = $image_2;
                } else if ($i == 2) {
                    $image = $image_3;
                } else if ($i == 3) {
                    $image = $image_4;
                } else if ($i == 4) {
                    $image = $image_5;
                } else if ($i == 5) {
                    $image = $image_6;
                } else if ($i == 6) {
                    $image = $image_7;
                } else if ($i == 7) {
                    $image = $image_8;
                } else if ($i == 8) {
                    $image = $image_9;
                } else if ($i == 9) {
                    $image = $image_10;
                }

                $data_update = array('status' => 'Booked', 'price' => $rent[$i], 'day_or_month' => 'month', 'checkin_id' => $insert_id);
                $this->db->where('room_id', $room_id[$i])->where('hotel_id', $this->session->userdata('hotel_id'))->update('room', $data_update);
                $data = array(
                    'day_or_month_or_year' => $day_or_month_or_year[$i],
                    'room_id' => $room_id[$i],
                    'cash_or_credit' => $cash_or_credit[$i],
                    'day_or_month' => 'month',
                    'account_number' => $account_number[$i],
                    'dateOfEntry' => date('Y-m-d', strtotime($dateOfEntry[$i])),
                    'dateOfExit' => date('Y-m-d', strtotime($dateOfExit[$i])),
                    'rent' => $rent[$i],
                    'due' => $due[$i],
                    'image' => $image,
                    'data_insert_time' => date('Y-m-d H:i:s'),
                    'insurance' => $insurance[$i],
                    'checkin_id' => $insert_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'hotel_id' => $this->session->userdata('hotel_id'),
                );
                $this->db->insert('checkin_details', $data);
            }
            $sdata = array(
                'success' => 'Data has been saved successfully'
            );
            $this->session->set_userdata($sdata);

            if ($is_ajax) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Data has been saved successfully',
                    'redirect_url' => base_url('checkin-print-month/' . $insert_id),
                ));
                return;
            }

            $data['checkin_id'] = $insert_id;
            $data['output_content'] = $this->load->view('checkin/print_checkin_month', $data, true);
            $this->load->view('admin_content', $data);
        } else {
            if ($is_ajax) {
                echo json_encode(array(
                    'status' => 'duplicate',
                    'message' => 'This data has already been saved.',
                ));
                return;
            }
            $data['output_content'] = $this->load->view('checkin/print_checkin_month', $data, true);
            $this->load->view('admin_content', $data);
        }
    }

    public function old_patient_show()
    {
        $patients = $this->db->select('*')->get('checkin')->result();
        ?>
        <option selected disabled value="">Select Patient</option>
        <?php
        foreach ($patients as $patient) {
            ?>
            <option value="<?php echo $patient->patient_id ?>"><?php echo $patient->patient_name . '-' . $patient->contact_number ?></option>
            <?php
        }
    }


    //put your code here
    public function checkin_print_month($checkin_id)
    {
        $data['checkin_id'] = $checkin_id;
        $data['output_content'] = $this->load->view('checkin/print_checkin_month', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function checkin_print_day($checkin_id)
    {
        $data['checkin_id'] = $checkin_id;
        $data['output_content'] = $this->load->view('checkin/print_checkin', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }


    public function view_check_in_month()
    {
        if(current_url()=='http://rosehotel.bijoylab.com/index.php/view-check-in-month'||current_url()=='https://rosehotel.bijoylab.com/index.php/view-check-in-month')
        {

            $sdata = array(
                'search_hotel_id' => '',
            );
            $this->session->set_userdata($sdata);


            $sdata = array(
                'search_room_id' => '',
            );
            $this->session->set_userdata($sdata);


            $sdata = array(
                'search_from_date' => '',
            );
            $this->session->set_userdata($sdata);


            $sdata = array(
                'search_to_date' => '',
            );
            $this->session->set_userdata($sdata);
        }
        $hotel_id = '';
        $hotel_id = $_SESSION['hotel_id'] != '' ? $_SESSION['hotel_id'] : $this->input->post('hotel_id');
        $room_id = $this->input->post('room_id');
        if ($this->input->post('from_date') != '') {
            $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
        }
        if ($this->input->post('to_date') != '') {
            $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
        }
        if($hotel_id!='')
        {
            $sdata = array(
                'search_hotel_id' => $hotel_id,
            );
            $this->session->set_userdata($sdata);
        }
        if($room_id!='')
        {
            $sdata = array(
                'search_room_id' => $room_id,
            );
            $this->session->set_userdata($sdata);
        }
        if($from_date!='')
        {
            $sdata = array(
                'search_from_date' => $from_date,
            );
            $this->session->set_userdata($sdata);
        }
        if($to_date!='')
        {
            $sdata = array(
                'search_to_date' => $to_date,
            );
            $this->session->set_userdata($sdata);
        }

        $guest_unique_id = $this->input->post('guest_unique_id');

        $config['base_url'] = site_url('CheckinController/view_check_in_month');

        $hotel_id = $this->session->userdata('search_hotel_id');
        $room_id = $this->session->userdata('search_room_id');
        $from_date = $this->session->userdata('search_from_date');
        $to_date = $this->session->userdata('search_to_date');

        $this->db->where('checkin_details.is_deleted', '0');
        $this->db->where('checkin_details.day_or_month', 'month');
        if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('1');
        } else if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            //  print_r('2');
        } else if ($room_id != '' && $hotel_id != '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            //  print_r('2');
        }
        else if ($room_id == '' && $hotel_id != '' && $from_date == '' && $to_date == '') {
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('3');
            //  print_r('<br>'.$config['total_rows']);
        } else if ($room_id == '' && $hotel_id == '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            //print_r('4');
        } else if ($room_id == '' && $hotel_id == '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('5');
        } else if ($room_id == '' && $hotel_id != '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('5');
        }else if ($room_id == '' && $hotel_id != '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            //print_r('6');
        }
        else if ($room_id == '' && $hotel_id == '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            print_r('6');
        } else if ($room_id != '' && $hotel_id != '' && $from_date == '' && $to_date == '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('7');
        } else if ($room_id == '' && $hotel_id == '' && $from_date == '' && $to_date == '') {
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('8');
        }

        $config['per_page'] = 20;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 5;
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

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // get books list
        $patient_id = NULL;


        $data['result'] = $this->CheckInModel->get_all_checkin_month($config["per_page"], $data['page'], $hotel_id, $from_date, $to_date, $guest_unique_id, $room_id);
        $data['pagination'] = $this->pagination->create_links();
        $this->defaults['productname'] = '';
        $data['flag'] = '';
        $data['output_content'] = $this->load->view('checkin/view_checkin_month', $data, true);
        $this->load->view('admin_content', $data);
    }

    public function view_check_in_day()
    {
        if(current_url()=='http://rosehotel.bijoylab.com/index.php/view-check-in'||current_url()=='https://rosehotel.bijoylab.com/index.php/view-check-in')
        {
            $sdata = array(
                'search_hotel_id' => '',
            );
            $this->session->set_userdata($sdata);


            $sdata = array(
                'search_room_id' => '',
            );
            $this->session->set_userdata($sdata);


            $sdata = array(
                'search_from_date' => '',
            );
            $this->session->set_userdata($sdata);


            $sdata = array(
                'search_to_date' => '',
            );
            $this->session->set_userdata($sdata);
        }

        $hotel_id = $_SESSION['hotel_id'] != '' ? $_SESSION['hotel_id'] : $this->input->post('hotel_id');
        $room_id = $this->input->post('room_id');
        if ($this->input->post('from_date') != '') {
            $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
        }
        if ($this->input->post('to_date') != '') {
            $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
        }
        $guest_unique_id = $this->input->post('guest_unique_id');
        if (isset($_POST['room_id'])) {
            $room_id = $this->input->post('room_id');
        }


        if($hotel_id!='')
        {
            $sdata = array(
                'search_hotel_id' => $hotel_id,
            );
            $this->session->set_userdata($sdata);
        }
        if($room_id!='')
        {
            $sdata = array(
                'search_room_id' => $room_id,
            );
            $this->session->set_userdata($sdata);
        }
        if($from_date!='')
        {
            $sdata = array(
                'search_from_date' => $from_date,
            );
            $this->session->set_userdata($sdata);
        }
        if($to_date!='')
        {
            $sdata = array(
                'search_to_date' => $to_date,
            );
            $this->session->set_userdata($sdata);
        }

        $hotel_id = $this->session->userdata('search_hotel_id');
        $room_id = $this->session->userdata('search_room_id');
        $from_date = $this->session->userdata('search_from_date');
        $to_date = $this->session->userdata('search_to_date');


        $this->db->where('checkin_details.is_deleted', '0');
        $this->db->where('checkin_details.day_or_month', 'day');
        if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('1');
        } else if ($room_id != '' && $hotel_id != '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            //  print_r('2');
        } else if ($room_id != '' && $hotel_id != '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            //  print_r('2');
        }
        else if ($room_id == '' && $hotel_id != '' && $from_date == '' && $to_date == '') {
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('3');
            //  print_r('<br>'.$config['total_rows']);
        } else if ($room_id == '' && $hotel_id == '' && $from_date != '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            //print_r('4');
        } else if ($room_id == '' && $hotel_id == '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('5');
        } else if ($room_id == '' && $hotel_id != '' && $from_date != '' && $to_date == '') {
            $this->db->where('checkin_details.dateOfEntry>=', $from_date);
            $this->db->where('checkin_details.dateOfEntry<=', $from_date);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('5');
        }else if ($room_id == '' && $hotel_id != '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            //print_r('6');
        }
        else if ($room_id == '' && $hotel_id == '' && $from_date == '' && $to_date != '') {
            $this->db->where('checkin_details.dateOfEntry>=', $to_date);
            $this->db->where('checkin_details.dateOfEntry<=', $to_date);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            print_r('6');
        } else if ($room_id != '' && $hotel_id != '' && $from_date == '' && $to_date == '') {
            $this->db->where('checkin_details.room_id', $room_id);
            $this->db->where('checkin_details.hotel_id', $hotel_id);
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('7');
        } else if ($room_id == '' && $hotel_id == '' && $from_date == '' && $to_date == '') {
            $config['total_rows'] = $this->db->get('checkin_details')->num_rows();
            // print_r('8');
        }

//print_r('<br>'.$config['total_rows']);


        $config['base_url'] = site_url('CheckinController/view_check_in_day');

        $config['per_page'] = 20;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
          $config['num_links'] = 5; 
        // integrate bootstrap pagination
       
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

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //print_r($data['page']);

        // get books list
        $patient_id = NULL;


        $data['result'] = $this->CheckInModel->get_all_checkin_day($config["per_page"], $data['page'], $hotel_id, $from_date, $to_date, $guest_unique_id, $room_id);

        $data['pagination'] = $this->pagination->create_links();


        $this->defaults['productname'] = '';
        // $data['manufacture_id'] = $manufacture_id;
        //  $this->load->view('sale_register/sale_register_details_print',$data);

        $data['flag'] = '';
        $data['output_content'] = $this->load->view('checkin/view_checkin_day', $data, true);
        $this->load->view('admin_content', $data);
    }

    public function room_load()
    {
        $language = $this->session->userdata('language');
        $hotel_id = $_POST['hotel_id'];
        $rooms = $this->db->where('hotel_id', $hotel_id)->order_by('room_no_in_english', 'asc')->get('room')->result();
        ?>

        <option value="">Select Room</option>
        <?php
        foreach ($rooms as $room) {
            ?>
            <option value="<?php echo $room->room_id ?>"><?php
                if ($language == 'english') {
                    echo $room->room_no_in_english;
                } else {
                    echo $room->room_no_in_arabic;
                }
                ?></option>
            <?php
        }
    }

    public function balance_load()
    {
        //print_r('hi');
        $language = $this->session->userdata('language');
        $from_date = date('Y-m-d', strtotime($_POST['from_date']));
        $to_date = date('Y-m-d', strtotime($_POST['to_date']));
        $hotel_id = $_POST['hotel_id'];
        ?>
        <div class="col-md-2">
            <div class="container-room bg-primary"
                 style="width: 100%;float: left;margin-right: 5px;padding-top: 15px;height: 80px;">

                <div>
                    <p style="color: white;text-align: center"><?php
                        if ($language == 'english') {
                            echo 'Total Income';
                        } else {
                            echo 'إجمالي الدخل';
                        }
                        ?></p>
                    <?php
                    $income = $this->db->select_sum('rent', 'amount')
                        ->where('hotel_id', $hotel_id)
                        ->where('dateOfEntry>=', date('Y-m-d', strtotime($from_date)))
                        ->where('dateOfEntry<=', date('Y-m-d', strtotime($to_date)))
                        ->where('is_deleted', 0)->get('checkin_details')->result();
                    ?>
                    <p style="text-align: center;color: white"><?php echo $income[0]->amount; ?></p>
                </div>

            </div>
        </div>
        <div class="col-md-2">
            <div class="container-room bg-primary"
                 style="width: 100%;float: left;margin-right: 5px;padding-top: 15px;height: 80px;">
                <div>
                    <p style="color: white;text-align: center"><?php
                        if ($language == 'english') {
                            echo 'Total Expense';
                        } else {
                            echo 'المصاريف الكلية';
                        }
                        ?></p>
                    <?php
                    $expense = $this->db->select_sum('amount', 'amount')
                        ->where('hotel_id', $hotel_id)
                        ->where('date>=', date('Y-m-d', strtotime($from_date)))
                        ->where('date<=', date('Y-m-d', strtotime($to_date)))
                        ->get('expense')->result();
                    ?>
                    <p style="text-align: center;color: white"><?php echo $expense[0]->amount; ?></p>
                </div>

            </div>
        </div>
        <div class="col-md-2">
            <div class="container-room bg-primary"
                 style="width: 100%;float: left;margin-right: 5px;padding-top: 15px;height: 80px;">
                <div>
                    <p style="color: white;text-align: center"><?php
                        if ($language == 'english') {
                            echo 'Balance';
                        } else {
                            echo 'الرصيد';
                        }
                        ?></p>
                    <p style="text-align: center;color: white"><?php echo $income[0]->amount - $expense[0]->amount; ?></p>
                </div>

            </div>
        </div>
        </div>

        <?php

    }

    //put your code here
    public function checkin_delete($checkin_id)
    {

        $delete = array('is_deleted' => '1');
        $delete_status = $this->db->where('checkin_id', $checkin_id)->delete('checkin');
        $delete_status = $this->db->where('checkin_id', $checkin_id)->delete('checkin_details');
        if ($delete_status) {
            $sdata = array(
                'success' => 'Data has been deleted successfully'
            );
            $this->session->set_userdata($sdata);

            redirect(base_url() . 'view-check-in');
        } else {
            $sdata = array(
                'success' => 'Error!!Data has not been deleted successfully'
            );
            $this->session->set_userdata($sdata);
            redirect(base_url() . 'view-checkin');
        }

        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function checkin_edit($checkin_id)
    {
        $data['checkin_id'] = $checkin_id;
        $data['output_content'] = $this->load->view('checkin/checkin_edit', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function checkin_edit_month($checkin_id)
    {
        $data['checkin_id'] = $checkin_id;
        $data['output_content'] = $this->load->view('checkin/checkin_edit_month', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

}
