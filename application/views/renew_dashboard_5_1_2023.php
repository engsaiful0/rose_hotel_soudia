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
                    ?>
                    <div class="container-room"
                         style="width: 15%;float: left;margin-right: 5px;background-color: #6AA42F;padding-top: 15px;margin-top: 5px;">
                        <div>
                            <p style="color: black;text-align: center"><?php
                                if ($language == 'english') {
                                    echo 'Room No <b>' . $room_renew->room_no_in_english . '</b>';
                                } else {
                                    echo '<b>غرفة لا ' . $room_renew->room_no_in_arabic . '</b>';
                                }
                                ?></p>
                            <?php
                            if ($checkin_details_renew->day_or_month == 'day') {
                                ?>
                                <a style="width: 100%" title="Details" class="btn btn-info"
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
                                <a style="width: 100%" title="Details" class="btn btn-info"
                                   href="<?php echo base_url() ?>renew-month/<?php echo $checkin_details_renew->checkin_details_id ?>"><?php
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