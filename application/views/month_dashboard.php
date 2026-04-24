<div class="card">
    <div class="card-header bg-info">
        <h3 style="text-align: center">
            <?php
            if ($language == 'english') {
                echo 'Month';
            } else {
                echo 'شهر';
            }
            ?>
        </h3>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                $sl = 1;
                $rooms = $this->db->where('status', 'booked')->where('day_or_month', 'month')->where('hotel_id', $hotel->hotel_id)->order_by('room_no_in_english','ASC')->get('room')->result();
                foreach ($rooms as $room) {
                    $checkin_details_id_for_renew = 0;
                    $active_due_row = $this->db->select('due')
                        ->where('checkin_id', $room->checkin_id)
                        ->where('room_id', $room->room_id)
                        ->where('exit_status', 'no')
                        ->where('is_deleted', 0)
                        ->order_by('checkin_details_id', 'DESC')
                        ->limit(1)
                        ->get('checkin_details')
                        ->row();
                    $room_due = $active_due_row ? (float) $active_due_row->due : 0.0;
                    ?>
                    <div class="container-room" data-toggle="modal"
                         data-target="#exampleModal<?php echo $room->checkin_id ?>"
                         style="background-image: url('<?php base_url()?>assets/month2.jpg');background-repeat: no-repeat;float: left;width: 108px;height: 200px;margin-right: 6px;  ">
                        <div style="padding-top: 40px;padding-left: 15px;">
                            <p style="color: black;text-align: center;font-size: 15px;"><?php
                                if ($language == 'english') {
                                    echo $room->room_no_in_english . '</b>';
                                } else {
                                    echo $room->room_no_in_arabic . '</b>';
                                }
                                ?></p>
                            <?php
                            if ($room_due > 0) {
                                ?>
                                <p style="color: #ffeb3b;text-align: center;font-size: 12px;font-weight: bold;margin: 2px 0 0;line-height: 1.2;"><?php
                                  if ($language == 'english') {
                                    echo 'Due: ';
                                } else {
                                    echo 'حق:';
                                }
                                echo $language == 'english' ? $room_due : Convertnumber2arabic((string) $room_due);
                                ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div style="padding-top: 20px">

                            <p style="color: white;text-align: center;font-weight: bold;font-size: 15px;"><?php
                                if ($language == 'english') {
                                    echo $room->price;
                                } else {
                                    echo Convertnumber2arabic($room->price);
                                }
                                ?></p>
                            <div class="modal fade" id="exampleModal<?php echo $room->checkin_id ?>"
                                 tabindex="-1"
                                 role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document"
                                     style="max-width: 1100px!important;">
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
                                                ->where('checkin_id', $room->checkin_id)
                                                ->order_by('checkin_id', 'DESC')
                                                ->get('checkin')->row();

                                            $country = $this->db->select('*')
                                                ->where('country_id', $checkin->country_id)
                                                ->get('countries')->row();

                                            $profession = $this->db->select('*')
                                                ->where('profession_id', $checkin->profession_id)
                                                ->get('profession')->row();

                                            $checkin_details = $this->db->select('*')
                                                ->where('checkin_id', $room->checkin_id)
                                                ->order_by('checkin_details_id', 'DESC')
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
                                                <?php
                                                include 'day_header.php';
                                                ?>
                                                <?php
                                                foreach ($checkin_details as $checkin_detail) {
                                                    $checkin_details_id_for_renew = $checkin_detail->checkin_details_id;
                                                    $room = $this->db->select('*')
                                                        ->where('room_id', $checkin_detail->room_id)
                                                        ->get('room')->row();

                                                    $data = date('Y-m-d');
                                                    $time = date('H');
                                                    $min = date('i');

//                                                    if ( $data>=$checkin_detail->dateOfExit) {
//                                                        if (($time >= 15 && $min > 0 && $checkin_detail->exit_status == 'no')) {
                                                    if (($data == $checkin_detail->dateOfExit && $time >= 15 && $min > 0 && $checkin_detail->exit_status == 'no')||($data > $checkin_detail->dateOfExit  && $checkin_detail->exit_status == 'no')) {

                                                            $data = array(
                                                                'exit_status' => 'yes'
                                                            );
                                                            $data_room = array(
                                                                'status' => 'Free'
                                                            );

                                                            $this->db->where('checkin_details_id', $checkin_detail->checkin_details_id)->update('checkin_details', $data);
                                                            $this->db->where('room_id', $checkin_detail->room_id)->where('checkin_id', $checkin_detail->checkin_id)->update('room', $data_room);


                                                        //}
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $checkin_detail->day_or_month_or_year ?></td>
                                                        <td><?php echo $room->room_no_in_english ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($checkin_detail->dateOfEntry)) ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($checkin_detail->dateOfExit)) ?></td>
                                                        <td><?php echo $checkin_detail->rent ?></td>
                                                        <td><?php echo $checkin_detail->due ?></td>
                                                        <td><?php echo $checkin_detail->cash_or_credit ?></td>
                                                        <td><?php echo $checkin_detail->insurance ?></td>
                                                    </tr>
                                                    <?php
                                                    if ($checkin_detail->image != '') {
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">
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
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>