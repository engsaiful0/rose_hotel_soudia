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
                         style="width: 15%;float: left;margin-right: 5px;background-color:red;color:white;padding-top: 15px;margin-top: 5px;">
                        <div>
                            <p style="color: white;text-align: center"><?php
                                if ($language == 'english') {
                                    echo 'Room No <b>' . $room->room_no_in_english . '</b>';
                                } else {
                                    echo '<b>غرفة لا ' . $room->room_no_in_arabic . '</b>';
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