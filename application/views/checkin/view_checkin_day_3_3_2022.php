<!-- START: Card Data-->
<?php
date_default_timezone_set('Asia/Riyadh');
$language = $this->session->userdata('language');
$hotel_id = $this->session->userdata('hotel_id');
?>
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header bg-primary justify-content-between align-items-center">
                <h4 class="card-title" style="text-align: center;color: white">
                    <?php
                    if ($language == 'english') {
                        ?>
                        View Check In(Day)
                        <?php
                    } else {
                        ?>
                        عرض تسجيل الوصول(يوم)
                        <?php
                    }
                    ?>
                </h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->userdata('success') != '') {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>
                            <?php
                            echo $this->session->userdata('success');
                            $sdata = array(
                                'success' => ''
                            );
                            $this->session->set_userdata($sdata);
                            ?>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
                <div class="table-responsive">
                    <form method="post" action="<?php echo base_url() ?>view-check-in">
                        <table class="table table-bordered table-hover table-condensed table-responsive"
                               style="width: 90%;">
                            <tr>
                                <td>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        ID
                                        <?php
                                    } else {
                                        ?>
                                        هوية شخصية
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($language == 'english') {
                                        echo 'Room Number';
                                    } else {
                                        echo 'رقم الشقة';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Hotel
                                        <?php
                                    } else {
                                        ?>
                                        الفندق
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        From Date
                                        <?php
                                    } else {
                                        ?>
                                        من التاريخ
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        To Date
                                        <?php
                                    } else {
                                        ?>
                                        حتى الآن
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <select id="guest_unique_id_view" name="guest_unique_id" class="form-control">
                                        <option disabled="" selected="" value=""> <?php
                                            if ($language == 'english') {
                                                ?>
                                                ID
                                                <?php
                                            } else {
                                                ?>
                                                هوية شخصية
                                                <?php
                                            }
                                            ?></option>
                                        <?php
                                        $checkins = $this->db->where('is_deleted', '0')->get('checkin')->result();

                                        foreach ($checkins as $checkin) {
                                            ?>
                                            <option value="<?php echo $checkin->guest_unique_id ?>"><?php echo $checkin->guest_unique_id ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 150px" class="form-control" name="room_id"
                                            id="room_id">
                                        <option></option>
                                        <?php
                                        $rooms = $this->db->where('hotel_id', $hotel_id)->order_by('room_no_in_english', 'asc')->get('room')->result();
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
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select id="hotel_id" name="hotel_id" class="form-control">
                                        <option disabled="" selected="" value="">
                                            <?php
                                            if ($language == 'english') {
                                                ?>
                                                Hotel
                                                <?php
                                            } else {
                                                ?>
                                                الفندق
                                                <?php
                                            }
                                            ?>
                                        </option>
                                        <?php
                                        $language = $this->session->userdata('language');
                                        $hotel_id = $this->session->userdata('hotel_id');
                                        // print_r('$hotel_id'.$hotel_id);
                                        //die;
                                        $hotels = '';
                                        $user_type = $this->session->userdata('type');
                                        if ($user_type == 'superadmin') {
                                            $hotels = $this->db->select('*')->get('hotel')->result();
                                        } else {
                                            $hotels = $this->db->where('hotel_id', $hotel_id)->get('hotel')->result();
                                        }

                                        foreach ($hotels as $hotel) {
                                            ?>
                                            <option value="<?php echo $hotel->hotel_id ?>"><?php echo $hotel->hotel_name_in_english ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" value="" name="from_date" id="datepicker">
                                </td>
                                <td>
                                    <input class="form-control" value="" name="to_date" id="datepicker1">
                                </td>
                                <?php
                                $search = '';
                                if ($language == 'english') {
                                    $search = 'Search';
                                } else {
                                    $search = 'بحث';
                                }
                                ?>
                                <td><input type="submit" id="sumbit_button" value="<?php echo $search ?>"
                                           class="btn btn-primary"></td>
                            </tr>
                        </table>
                    </form>
                    <table class=" table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <td>
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Serial
                                    <?php
                                } else {
                                    ?>
                                    مسلسل
                                    <?php
                                }
                                ?>
                            </td>
                            <th> <?php
                                if ($language == 'english') {
                                    ?>
                                    Name
                                    <?php
                                } else {
                                    ?>
                                    اسم
                                    <?php
                                }
                                ?>
                            </th>
                            <th>
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    ID
                                    <?php
                                } else {
                                    ?>
                                    هوية شخصية
                                    <?php
                                }
                                ?>
                            </th>
                            <th>
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Country
                                    <?php
                                } else {
                                    ?>
                                    دولة
                                    <?php
                                }
                                ?>
                            </th>
                            <th>
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Mobile
                                    <?php
                                } else {
                                    ?>
                                    متحرك
                                    <?php
                                }
                                ?>
                            </th>
                            <th>

                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Total
                                    <?php
                                } else {
                                    ?>
                                    المجموع
                                    <?php
                                }
                                ?></th>
                            <th>
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Room
                                    <?php
                                } else {
                                    ?>
                                    غرفة
                                    <?php
                                }
                                ?>
                            </th>
                            <th>
                                <?php
                                $dateOfExitPlaceHolder = '';
                                if ($language == 'english') {
                                    echo 'Entry Date';
                                    $dateOfExitPlaceHolder = 'Date of Entry';
                                } else {
                                    echo 'تاربخ الدخول';
                                    $dateOfExitPlaceHolder = 'تاربخ الدخول';
                                }
                                ?>
                            </th>
                            <th>
                                <?php
                                $dateOfEntryPlaceHolder = '';
                                if ($language == 'english') {
                                    echo 'Exit Date';
                                    $dateOfEntryPlaceHolder = 'Date of Exit';
                                } else {
                                    echo 'تاربخ الخروج';
                                    $dateOfEntryPlaceHolder = 'تاربخ الخروج';
                                }
                                ?>
                            </th>

                            <th> <?php
                                if ($language == 'english') {
                                    ?>
                                    Print
                                    <?php
                                } else {
                                    ?>
                                    مطبعة
                                    <?php
                                }
                                ?>
                            </th>
                            <th> <?php
                                if ($language == 'english') {
                                    ?>
                                    Renew
                                    <?php
                                } else {
                                    ?>
                                    تجديد
                                    <?php
                                }
                                ?>
                            </th>
                            <th>
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Details
                                    <?php
                                } else {
                                    ?>
                                    تفاصيل
                                    <?php
                                }
                                ?>
                            </th>
                            <?php
                            $user_type = $this->session->userdata('type');
                            if ($user_type == 'superadmin') {
                                ?>
                                <th>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Edit
                                        <?php
                                    } else {
                                        ?>
                                        يحرر
                                        <?php
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Delete
                                        <?php
                                    } else {
                                        ?>
                                        حذف
                                        <?php
                                    }
                                    ?>
                                </th>
                                <?php
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sl = 1;
                        $grand_total = 0;

                        for ($i = 0; $i < count($result); ++$i) {
                            $checkin_id = $result[$i]->checkin_id;
                            $profession_id = $result[$i]->profession_id;
                            $country_id = $result[$i]->country_id;
                            $room_id = $result[$i]->room_id;
                            $profession = $this->db->where('profession_id', $profession_id)->get('profession')->row();
                            $country = $this->db->where('country_id', $country_id)->get('countries')->row();

                            $hotel_id = $result[$i]->hotel_id;
                            $hotel = $this->db->where('hotel_id', $hotel_id)->get('hotel')->row();
                            $room = $this->db->where('room_id', $room_id)->get('room')->row();
                            ?>
                            <tr>
                                <td><?php echo $sl++ ?></td>
                                <td><?php echo $result[$i]->guest_name ?></td>
                                <td><?php echo $result[$i]->guest_unique_id ?></td>
                                <td>
                                    <?php
                                    if ($language == 'english') {
                                        echo $country->country_enName;
                                    } else {
                                        echo $country->country_arName;
                                    }
                                    ?>
                                    <?php

                                    ?></td>
                                <td><?php echo $result[$i]->mobile ?></td>
                                <td><?php echo $result[$i]->rent;
                                    $grand_total += $result[$i]->rent;
                                    ?></td>
                                <td><?php
                                    if ($language == 'english') {
                                        echo $room->room_no_in_english;
                                    } else {
                                        echo $room->room_no_in_arabic;
                                    }
                                    ?></td>
                                <td><?php echo date('d-m-Y', strtotime($result[$i]->dateOfEntry)) ?></td>

                                <?php
                                $data = date('Y-m-d');
                                $time = date('H');
                                $min = date('i');
                                $checkin_details_id = $result[$i]->checkin_details_id;

                                if (($data >= $result[$i]->dateOfExit && $time >= 15 && $min > 0 && $result[$i]->exit_status == 'no')) {
                                    $data = array(
                                        'exit_status' => 'yes'
                                    );
                                    $data_room = array(
                                        'status' => 'Free'
                                    );

                                    $this->db->where('checkin_details_id', $checkin_details_id)->update('checkin_details', $data);
                                    //$this->db->where('room_id', $room_id)->update('room', $data_room);
                                    $this->db->where('room_id', $room_id)->where('checkin_id', $result[$i]->checkin_id)->update('room', $data_room);

                                    ?>
                                    <td style="background-color: red;color: white"><?php echo date('d-m-Y', strtotime($result[$i]->dateOfExit)) ?>

                                        <a title="Details" class="btn btn-primary" data-toggle="modal"
                                           data-target="#exitModal<?php echo $checkin_details_id ?>"
                                           href="#">
                                            <?php
                                            if ($language == 'english') {
                                                echo 'Exit';
                                            } else {
                                                echo 'مخرج';
                                            }
                                            ?>
                                        </a>

                                    </td>
                                    <?php
                                } else if ($result[$i]->dateOfExit <= $data && $result[$i]->exit_status == 'no') {
                                    ?>
                                    <td style="background-color: red;color: white"><?php echo date('d-m-Y', strtotime($result[$i]->dateOfExit)) ?>

                                        <a title="Details" class="btn btn-primary" data-toggle="modal"
                                           data-target="#exitModal<?php echo $checkin_details_id ?>"
                                           href="#">
                                            <?php
                                            if ($language == 'english') {
                                                echo 'Exit';
                                            } else {
                                                echo 'مخرج';
                                            }
                                            ?>
                                        </a>

                                    </td>
                                    <?php
                                } else if ($result[$i]->exit_status == 'no') {
                                    ?>
                                    <td><?php echo date('d-m-Y', strtotime($result[$i]->dateOfExit)) ?>

                                        <a title="Details" class="btn btn-primary" data-toggle="modal"
                                           data-target="#exitModal<?php echo $checkin_details_id ?>"
                                           href="#">
                                            <?php
                                            if ($language == 'english') {
                                                echo 'Exit';
                                            } else {
                                                echo 'مخرج';
                                            }
                                            ?>
                                        </a>

                                    </td>

                                    <?php
                                } else {
                                    ?>
                                    <td><?php echo date('d-m-Y', strtotime($result[$i]->dateOfExit)) ?>
                                    </td>

                                    <?php
                                }


                                ?>
                                <div class="modal fade" id="exitModal<?php echo $checkin_details_id ?>" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    <?php
                                                    if ($language == 'english') {
                                                        ?>
                                                        Exit
                                                        <?php
                                                    } else {
                                                        ?>
                                                        تفاصيل
                                                        <?php
                                                    }
                                                    ?>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo base_url() ?>exit-save">
                                                    <textarea name="exit_comment" class="form-control"></textarea>
                                                    <input name="checkin_details_id" class="form-control" type="hidden"
                                                           value="<?php echo $checkin_details_id ?>">
                                                    <input name="room_id" class="form-control" type="hidden"
                                                           value="<?php echo $room_id ?>">
                                                    <input type="submit" class="btn btn-primary" value="Exit Save">
                                                </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
                                                    <?php
                                                    if ($language == 'english') {
                                                        ?>
                                                        Close
                                                        <?php
                                                    } else {
                                                        ?>
                                                        قريب
                                                        <?php
                                                    }
                                                    ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td>
                                    <a title="Print" class="btn btn-primary"
                                       href="<?php echo base_url() ?>checkin-print/<?php echo $checkin_id ?>"><i
                                                class="fa fa-print "></i></a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Do you want to renew?')" title="Details"
                                       class="btn btn-primary"
                                       href="<?php echo base_url() ?>start-renew-day/<?php echo $checkin_details_id ?>"><?php
                                        if ($language == 'english') {
                                            ?>
                                            Renew
                                            <?php
                                        } else {
                                            ?>
                                            تجديد
                                            <?php
                                        }
                                        ?></a>
                                </td>
                                <td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $checkin_id ?>" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="max-width: 1100px!important;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        <?php
                                                        if ($language == 'english') {
                                                            ?>
                                                            Details
                                                            <?php
                                                        } else {
                                                            ?>
                                                            تفاصيل
                                                            <?php
                                                        }
                                                        ?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php

                                                    $checkin = $this->db->select('*')
                                                        ->where('checkin_id', $checkin_id)
                                                        ->get('checkin')->row();

                                                    $country = $this->db->select('*')
                                                        ->where('country_id', $checkin->country_id)
                                                        ->get('countries')->row();

                                                    $profession = $this->db->select('*')
                                                        ->where('profession_id', $checkin->profession_id)
                                                        ->get('profession')->row();

                                                    $checkin_details = $this->db->select('*')
                                                        ->where('checkin_id', $checkin_id)
                                                        ->get('checkin_details')->result();


                                                    ?>
                                                    <table class="table table-hover table-bordered table-striped"
                                                           border="1" style="border-collapse: collapse;">

                                                        <tr>
                                                            <td>
                                                                <?php
                                                                if ($language == 'english') {
                                                                    ?>
                                                                    Name
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    الإسم
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $checkin->guest_name ?></td>
                                                            <td>
                                                                <?php
                                                                if ($language == 'english') {
                                                                    ?>
                                                                    ID Number
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    رقم البطاقة
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $checkin->guest_unique_id ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                if ($language == 'english') {
                                                                    ?>
                                                                    Country
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    الجنسية
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php
                                                                if ($language == 'english') {
                                                                    echo $country->country_enName;
                                                                } else {
                                                                    echo $country->country_arName;
                                                                }
                                                                ?></td>
                                                            <td>
                                                                <?php
                                                                if ($language == 'english') {
                                                                    ?>
                                                                    Place
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    مكان الإصدار
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $checkin->place ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                if ($language == 'english') {
                                                                    ?>
                                                                    Birthday
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    الميلاد
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo date('d-m-Y', strtotime($checkin->date_of_birth)) ?></td>
                                                            <td>
                                                                <?php
                                                                if ($language == 'english') {
                                                                    ?>
                                                                    Mobile
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    جوال
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $checkin->mobile ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                if ($language == 'english') {
                                                                    ?>
                                                                    Profession
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    المهنة
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $checkin->profession_id ?></td>
                                                            <td>
                                                                <?php
                                                                if ($language == 'english') {
                                                                    ?>
                                                                    Total
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    المجموع
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $checkin->grandRent ?></td>
                                                        </tr>
                                                    </table>
                                                    <table class="table table-hover table-bordered table-striped"
                                                           border="1" style="border-collapse: collapse;">
                                                        <tr>
                                                            <td><?php
                                                                if ($language == 'english') {
                                                                    echo 'Day';
                                                                } else {
                                                                    echo 'المدة';
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                if ($language == 'english') {
                                                                    echo 'Room Number';
                                                                } else {
                                                                    echo 'رقم الشقة';
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                if ($language == 'english') {
                                                                    echo 'Date of Entry';
                                                                } else {
                                                                    echo 'تاربخ الدخول';
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                if ($language == 'english') {
                                                                    echo 'Date of Exit';
                                                                } else {
                                                                    echo 'تاربخ الخروج';
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                if ($language == 'english') {
                                                                    echo 'Rent';
                                                                } else {
                                                                    echo 'قيمة الإيجار';
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                if ($language == 'english') {
                                                                    echo 'Cash/Credit';
                                                                } else {
                                                                    echo 'السيولة النقدية/تنسب إليه';
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                if ($language == 'english') {
                                                                    echo 'Insurance';
                                                                } else {
                                                                    echo 'التامينات';
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($checkin_details as $checkin_detail) {
                                                            $room = $this->db->select('*')
                                                                ->where('room_id', $checkin_detail->room_id)
                                                                ->get('room')->row();
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $checkin_detail->day_or_month_or_year ?></td>
                                                                <td><?php echo $room->room_no_in_english ?></td>
                                                                <td><?php echo date('d-m-Y', strtotime($checkin_detail->dateOfEntry)) ?></td>
                                                                <td><?php echo date('d-m-Y', strtotime($checkin_detail->dateOfExit)) ?></td>
                                                                <td><?php echo $checkin_detail->rent ?></td>
                                                                <td><?php echo $checkin_detail->cash_or_credit ?></td>
                                                                <td><?php echo $checkin_detail->insurance ?></td>
                                                            </tr>
                                                            <?php
                                                            if ($checkin_detail->image != '') {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="7">
                                                                        <img src="<?php echo base_url() ?>assets/images/<?php echo $checkin_detail->image ?>">
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>

                                                            <?php
                                                        }
                                                        ?>
                                                    </table>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        <?php
                                                        if ($language == 'english') {
                                                            ?>
                                                            Close
                                                            <?php
                                                        } else {
                                                            ?>
                                                            قريب
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a title="Details" class="btn btn-primary" data-toggle="modal"
                                       data-target="#exampleModal<?php echo $checkin_id ?>"
                                       href="#"><i
                                                class="fa fa-clock "></i></a>
                                </td>
                                <?php
                                $user_type = $this->session->userdata('type');
                                if ($user_type == 'superadmin') { ?>
                                    <td>
                                        <a title="Edit" class="btn btn-primary"
                                           href="<?php echo base_url() ?>checkin-edit/<?php echo $checkin_id ?>"><i
                                                    class="fa fa-pen "></i></a>
                                    </td>

                                    <td>
                                        <a onclick="return confirm('Do you want to delete this head?')" title="Delete"
                                           class="btn btn-danger"
                                           href="<?php echo base_url() ?>checkin-delete/<?php echo $checkin_id ?>"><i
                                                    class="fa fa-trash "></i></a>
                                    </td>
                                    <?php
                                }
                                ?>
                            </tr>


                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="5" style="text-align: right ">
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Total
                                    <?php
                                } else {
                                    ?>
                                    المجموع
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $grand_total ?>
                            </td>
                            <td colspan="8"></td>
                        </tr>
                    </table>
                    <div class="container" style="width: 100%">
                        <div class="row" style="list-style: none ">
                            <?php echo $pagination; ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<style>

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>