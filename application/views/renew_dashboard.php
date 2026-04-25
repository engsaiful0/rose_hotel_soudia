<div class="card">
    <div class="card-header bg-info">
        <h3 style="text-align: center">
            <?php
            if ($language == 'english') {
                echo 'Renew';
            } else {
                ?>
                تجديد
                <?php
            }
            ?>
        </h3>

    </div>
    <div class="card-body">
        <div class="row" style="margin-top: 5px;">
            <div class="col-md-12">
                <?php
                $sl = 1;
                $checkin_details_renews = $this->db->where('renew_status', 'renew_sarted')->where('hotel_id', $hotel->hotel_id)->get('checkin_details')->result();
                //                                echo '<pre>';
                //                                print_r($checkin_details_renews);
                //                                die;
                foreach ($checkin_details_renews as $checkin_details_renew) {
                    $room_renew = $this->db->where('room_id', $checkin_details_renew->room_id)->get('room')->row();
                    $renew_due = isset($checkin_details_renew->due) ? (float) $checkin_details_renew->due : 0.0;
                    ?>
                    <div class="container-room"
                         style="background-image: url('<?php base_url()?>assets/renew.jpg');background-repeat: no-repeat;float: left;width: 110px;height: 200px;  ">
                        <div style="padding-top: 64px;padding-right: 20px;">
                       
                            <p style="color: white;text-align: center;font-size: 15px;"><?php
                                if ($language == 'english') {
                                    echo $room_renew->room_no_in_english . '</b>';
                                } else {
                                    echo  $room_renew->room_no_in_arabic . '</b>';
                                }
                                ?></p>
                            <?php
                            if ($renew_due > 0) {
                                ?>
                                <p style="color: #ffeb3b;text-align: center;font-size: 12px;font-weight: bold;margin: 2px 0 0;line-height: 1.2;"><?php
                                if ($language == 'english') {
                                    echo 'Due: ';
                                } else {
                                    echo 'بسبب:';
                                }
                                echo $language == 'english' ? $renew_due : Convertnumber2arabic((string) $renew_due);
                                ?></p>
                                <?php
                            }
                            ?>
                            <?php
                            if ($checkin_details_renew->day_or_month == 'day') {
                                ?>
                                <a style="width: 100%;font-weight: bold;color: red;padding-left: 35px;font-size: 15px;" title="Details"
                                   href="<?php echo base_url() ?>renew/<?php echo $checkin_details_renew->checkin_details_id ?>"><?php
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
                                <?php
                            } else {
                                ?>
                                <a style="width: 100%;font-weight: bold;color: red;padding-left: 35px;" title="Details"
                                   href="<?php echo base_url() ?>renew-month/<?php echo $checkin_details_renew->checkin_details_id ?>"><?php
                                    if ($language == 'english') {
                                      echo $checkin_details_renew->rent;
                                    } else {
                                        echo $checkin_details_renew->rent; 
                                    }
                                    ?></a>
                                <?php
                            }
                            ?>

                        </div>

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>


    </div>

</div>