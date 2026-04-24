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
                Balance Report
                <?php
            } else {
                ?>
                تقرير الرصيد
                <?php
            }
            ?></h6>
    </div>
    <div class="card-content" style="min-height: 500px;">
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="balance_hotel_id"><?php echo $language == 'english' ? 'Hotel' : 'الفندق'; ?></label>
                        <select id="balance_hotel_id" name="hotel_id" class="form-control">
                            <option disabled="" selected="" value="">
                                <?php echo $language == 'english' ? 'Hotel' : 'الفندق'; ?>
                            </option>
                            <?php
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
                        <label for="balance_from_date">
                            <?php echo $language == 'english' ? 'From Date' : 'من التاريخ'; ?>
                        </label>
                        <input type="text" class="form-control datepicker" value="" name="from_date" id="balance_from_date" placeholder="From Date">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="balance_to_date">
                            <?php echo $language == 'english' ? 'To Date' : 'إلى التاريخ'; ?>
                        </label>
                        <input type="text" class="form-control datepicker" value="" id="balance_to_date" name="to_date" placeholder="To Date">
                    </div>
                    <div class="form-group col-md-2">
                        <label>&nbsp;</label>
                        <button onclick="balance_report_load()" style="color: white" type="button" class="form-control bg-primary" id="balance_submit_button">
                            <?php echo $language == 'english' ? 'Submit' : 'يُقدِّم'; ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div id="balance_report_details">

        </div>
    </div>
</div>

<script>
    function balance_report_load() {
        var hotel_id = document.getElementById('balance_hotel_id').value;
        var from_date = document.getElementById('balance_from_date').value;
        var to_date = document.getElementById('balance_to_date').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('balance_report_details').innerHTML = xhttp.responseText;
            }
        };
        xhttp.open('POST', '<?php echo site_url('ReportController/balance_report_load'); ?>', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('from_date=' + encodeURIComponent(from_date) + '&to_date=' + encodeURIComponent(to_date) + '&hotel_id=' + encodeURIComponent(hotel_id));
    }
</script>
