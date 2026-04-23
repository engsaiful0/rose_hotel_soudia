<div class="card">
    <div class="card-header bg-info">
        <h3 style="text-align: center">
            <?php
            if ($language == 'english') {
                echo 'Free';
            } else {
                echo 'حر';
            }
            ?>
        </h3>

    </div>
    <div class="card-body">
        <div class="row" style="margin-top: 5px;">
            <div class="col-md-12">
                <?php
                $sl = 1;
                $rooms = $this->db->where('status', 'Free')->where('hotel_id', $hotel->hotel_id)->get('room')->result();
                foreach ($rooms as $room) {
                    ?>
                    <div class="container-room"
                         style="background-image: url('<?php base_url()?>assets/free_room.jpg');background-repeat: no-repeat;float: left;width: 110px;height: 200px;  ">
                        <div style="padding-top: 60px;padding-right: 20px;">
                            <p style="color: white;text-align: center;font-size: 15px;"><?php
                                if ($language == 'english') {
                                    echo $room->room_no_in_english . '</b>';
                                } else {
                                    echo $room->room_no_in_arabic . '</b>';
                                }
                                ?></p>
                        </div>

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>


    </div>

</div>