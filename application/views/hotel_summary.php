<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <table style="width: 100%"
               class="table table-striped table-responsive table-bordered table-hover">
            <tr style="background-color:#1E3D73;color:white">
                <td style="width: 25%"><?php
                    if ($language == 'english') {
                        echo 'Total Room';
                    } else {
                        echo 'مجموع الغرفة';
                    }
                    ?></td>

                <td style="width: 25%"><?php
                    if ($language == 'english') {
                        echo 'Day';
                    } else {
                        echo 'يوم';
                    }
                    ?></td>
                <td style="width: 25%"><?php
                    if ($language == 'english') {
                        echo 'Month';
                    } else {
                        echo 'شهر';
                    }
                    ?></td>
                <td style="width: 25%"><?php
                    if ($language == 'english') {
                        echo 'Free';
                    } else {
                        echo 'حر';
                    }
                    ?></td>
                <td style="width: 25%"><?php
                    if ($language == 'english') {
                        echo 'Time';
                    } else {
                        echo 'زمن';
                    }
                    ?></td>
            </tr>
            <tr style="background-color:#0F9D58;color:white">
                <td>
                    <?php
                    $total_rooms = $this->db->where('hotel_id', $hotel_id)->order_by('room_no_in_english', 'asc')->get('room')->num_rows();

                    if ($language == 'english') {
                        echo $total_rooms;
                    } else {
                        echo Convertnumber2arabic($total_rooms);;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $rooms_rent_day = $this->db->where('status', 'booked')->where('day_or_month', 'day')->where('hotel_id', $hotel->hotel_id)->get('room')->num_rows();
                    if ($language == 'english') {
                        echo $rooms_rent_day;
                    } else {
                        echo Convertnumber2arabic($rooms_rent_day);;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $rooms_rent_month = $this->db->where('status', 'booked')->where('day_or_month', 'month')->where('hotel_id', $hotel->hotel_id)->get('room')->num_rows();
                    if ($language == 'english') {
                        echo $rooms_rent_month;
                    } else {
                        echo Convertnumber2arabic($rooms_rent_month);
                    }
                    ?>
                </td>
                <td style="background-color: red;color: white ">
                    <?php
                    $rooms_free = $this->db->where('status', 'Free')->where('hotel_id', $hotel->hotel_id)->get('room')->num_rows();
                    if ($language == 'english') {
                        echo  $rooms_free;
                    } else {
                        echo Convertnumber2arabic( $rooms_free);
                    }
                    ?>
                </td>
                <td>
                    <?php
                    //$time = time();
                    //echo $time;
                    $myDate = date("d-m-y h:i:s");

                    // Display the date and time
                    echo $myDate;
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
    </div>

</div>