<div class="card ">
    <div class="card-header bg-primary">
        <h6 class="card-title" style="text-align: center;color: white" Check In Report</h6>
    </div>
    <?php
    $language = $this->session->userdata('language');
    $hotel_id = $this->session->userdata('hotel_id');
    ?>
    <div class="card-content" style="min-height: 500px;">
        <div class="card-body">
            <form >
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">From Date</label>
                        <input type="text" class="form-control datepicker" value="<?php echo date('d-m-Y') ?>"
                               name="from_date" id="from_date" placeholder="From Date">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">To Date</label>
                        <input type="text" class="form-control datepicker" value="<?php echo date('d-m-Y') ?>"
                               id="to_date" name="to_date" placeholder="To Date">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4"><?php
                            if ($language == 'english') {
                                ?>
                                Hotel
                                <?php
                            } else {
                                ?>
                                الفندق
                                <?php
                            }
                            ?></label>
                        <select id="hotel_id" name="hotel_id" class="form-control">
                            <option  selected="" value="">

                            </option>
                            <?php
                            $language = $this->session->userdata('language');
                            $hotel_id = $this->session->userdata('hotel_id');
                            // print_r('$hotel_id'.$hotel_id);
                            //die;
                            $hotels='';
                            $user_type = $this->session->userdata('type');
                            if ($user_type == 'superadmin') {
                                $hotels = $this->db->select('*')->get('hotel')->result();
                            }else
                            {
                                $hotels = $this->db->where('hotel_id', $hotel_id)->get('hotel')->result();
                            }

                            foreach ($hotels as $hotel) {
                                ?>
                                <option value="<?php echo $hotel->hotel_id ?>"><?php echo $hotel->hotel_name_in_english ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2" style="display: none">
                        <label for="inputPassword4">Day/Month/Year</label>
                        <select class="form-control" required name="day_or_month_or_year"
                                id="day_or_month_or_year_5">
                            <option>Day</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4"></label>
                        <input onclick="checkinday_report_load()" style="color: white" type="button"
                               class="form-control bg-primary" id="submit_button" value="Submit">
                    </div>
                </div>
            </form>
        </div>
        <div id="checkinday_report_load">

        </div>
    </div>
</div>

<script>
    function checkinday_report_load() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var hotel_id = $('#hotel_id').val();
        var day_or_month_or_year = $('#day_or_month_or_year').val();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                document.getElementById("checkinday_report_load").innerHTML = xhttp.responseText;

            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('ReportController/checkinday_report_load'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("from_date=" + from_date + "&to_date=" + to_date + "&hotel_id=" + hotel_id + "&day_or_month_or_year=" + day_or_month_or_year);
    }
</script>