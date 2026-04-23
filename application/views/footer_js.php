<!-- END: Footer-->


<!-- START: Back to top-->
<a href="#" class="scrollup text-center">
    <i class="icon-arrow-up"></i>
</a>
<!-- END: Back to top-->


<!-- START: Template JS-->
<script src="<?php echo base_url(); ?>dist/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<!-- END: Template JS-->

<!-- START: APP JS-->
<script src="<?php echo base_url(); ?>dist/js/app.js"></script>
<!-- END: APP JS-->

<!-- START: Page Vendor JS-->
<script src="<?php echo base_url(); ?>dist/vendors/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/starrr/starrr.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/apexcharts/apexcharts.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- START: Page JS-->
<script src="<?php echo base_url(); ?>dist/js/home.script.js"></script>
<script src="<?php echo base_url(); ?>select2/js/select2.js"></script>
<script src="<?php echo base_url(); ?>select2/js/select2.min.js"></script>
<!-- END: Page JS-->
</body>
<!-- END: Body-->
</html>
<script>

    $(document).ready(function () {
        $('#language_change').select2();
        $('#guest_unique_id_view').select2();
        $('#country_id').select2();
        $('#hotel_id').select2();
        $('#room_id').select2();
        $('#country_id_all').select2();
        $('#day_or_month_or_year_2').select2();
        $('#day_or_month_or_year_1').select2();
        $('#day_or_month_or_year_3').select2();
        $('#roomnumberid_2').select2();
        $('#roomnumberid_1').select2();
        $('#roomnumberid_3').select2();
        $('#cash_or_credit_1').select2();
        $('#cash_or_credit_2').select2();
        $('#cash_or_credit_3').select2();
        $('#cash_or_credit_4').select2();
        $('#cash_or_credit_5').select2();
    });

    $('li').on('click', function () {
        if (!$(this).parents().hasClass('open')) {
            $('li').removeClass('open');
        }
        $(this).parent().addClass('open');
    });

    function language_change(languageData) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                window.location.reload();
            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('CheckinController/language_change'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("languageData=" + languageData);
    }

    function balance_load3() {
        var from_date = $('#datepicker5').val();
        var to_date = $('#datepicker6').val();
        var hotel_id = $('#hotel3_id').val();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('balance_load3').innerHTML = xhttp.responseText;
            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('CheckinController/balance_load'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("from_date=" + from_date + "&to_date=" + to_date + "&hotel_id=" + hotel_id);
    }

    function balance_load2() {
        var from_date = $('#datepicker3').val();
        var to_date = $('#datepicker4').val();
        var hotel_id = $('#hotel2_id').val();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('balance_load2').innerHTML = xhttp.responseText;
            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('CheckinController/balance_load'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("from_date=" + from_date + "&to_date=" + to_date + "&hotel_id=" + hotel_id);
    }

    function balance_load1() {
        var from_date = $('#datepicker1').val();
        var to_date = $('#datepicker2').val();
        var hotel_id = $('#hotel1_id').val();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('balance_load1').innerHTML = xhttp.responseText;
            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('CheckinController/balance_load'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("from_date=" + from_date + "&to_date=" + to_date + "&hotel_id=" + hotel_id);
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datepicker').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker1').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker2').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker3').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker4').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker5').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker6').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker7').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker8').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker9').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker10').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });

    });

</script>