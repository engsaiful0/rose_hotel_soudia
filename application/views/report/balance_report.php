<?php
$language = $this->session->userdata('language');
$hotel_id = $this->session->userdata('hotel_id');
?>
<div class="card ">
    <div class="card-header bg-primary">
        <h6 class="card-title" style="text-align: center;color: white">
            <?php
            if ($language == 'english') {
            ?>
                Transaction Report
            <?php
            } else {
            ?>
                تقرير المعاملات
            <?php
            }
            ?></h6>
    </div>
    <div class="card-content" style="min-height: 500px;">
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Hotel</label>
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
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">
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
                        </label>
                        <input type="text" class="form-control datepicker" value="" name="from_date" id="from_date" placeholder="From Date">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">
                            <?php
                            if ($language == 'english') {
                            ?>
                                To Date
                            <?php
                            } else {
                            ?>
                                ان يذهب في موعد
                            <?php
                            }
                            ?>
                        </label>
                        <input type="text" class="form-control datepicker" value="" id="to_date" name="to_date" placeholder="To Date">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="inputPassword4"></label>
                        <button onclick="transaction_report_load()" style="color: white" type="button" class="form-control bg-primary" id="submit_button"><?php
                                                                                                                                                            if ($language == 'english') {
                                                                                                                                                            ?>
                                Submit
                            <?php
                                                                                                                                                            } else {
                            ?>
                                يُقدِّم
                            <?php
                                                                                                                                                            }
                            ?></button>
                    </div>
                </div>
            </form>
        </div>
        <div id="transaction_report">

        </div>
    </div>
</div>

<script>
    function transaction_report_load() {

        var hotel_id = $('#hotel_id').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("transaction_report").innerHTML = xhttp.responseText;
            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('ReportController/transaction_report_load'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("from_date=" + from_date + "&to_date=" + to_date + "&hotel_id=" + hotel_id);
    }
</script>