<!-- Script -->
<script src="<?php echo base_url()?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url()?>vendor/owl.carousel/owl.carousel.min.js"></script> 
<script src="<?php echo base_url()?>vendor/bootstrap-spinner/bootstrap-spinner.js"></script> 
<script src="<?php echo base_url()?>vendor/daterangepicker/moment.min.js"></script> 
<script src="<?php echo base_url()?>vendor/daterangepicker/daterangepicker.js"></script> 
<script>
    $(function () {
        'use strict';
        // Hotels Check In Date
        $('#hotelsCheckIn').daterangepicker({
            singleDatePicker: true,
            minDate: moment(),
            autoUpdateInput: false,
        }, function (chosen_date) {
            $('#hotelsCheckIn').val(chosen_date.format('MM-DD-YYYY'));
        });

        // Hotels Check Out Date
        $('#hotelsCheckOut').daterangepicker({
            singleDatePicker: true,
            minDate: moment(),
            autoUpdateInput: false,
        }, function (chosen_date) {
            $('#hotelsCheckOut').val(chosen_date.format('MM-DD-YYYY'));
        });
        
        
    });
</script>
<script src="<?php echo base_url()?>js/theme.js"></script> 