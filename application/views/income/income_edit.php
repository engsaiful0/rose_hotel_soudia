<script src="<?php echo base_url() ?>form_validation/jquery.min.js"></script>
<!-- Include jQuery in noConflict mode -->
<script>
    // Use jQuery in noConflict mode and assign it to a different variable
    var $j = jQuery.noConflict();
    // Now use $j instead of $ to reference jQuery
</script>
<!-- Include jQuery Validation Plugin using $j -->

<script src="<?php echo base_url() ?>form_validation/jquery.validate.min.js"></script>

<!-- Your script using $j for jQuery -->
<script>
    $j(document).ready(function() {
        // Initialize form validation on the income_form form element
        $j("#income_form").validate({
            rules: {
                description: "required",
                amount: {
                    required: true,
                    number: true
                },
                date: "required",

            },
            messages: {
                description: "Please enter description",
                amount: {
                    required: "Please enter amount",
                    number: "Please enter valid amount"
                },
                date: "Please enter date",

            },
            submitHandler: function(form) {
                var submitBtn = $j('#submit_button');
                var formData = new FormData(form);
                $('#income_form :input').prop('disabled', true);
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                $j.ajax({
                    type: "POST",
                    url: "<?php echo base_url('IncomeController/income_edit_save'); ?>",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        if (response.success) {
                            // alert(response.message);
                            form.reset();

                            $('#income_form :input').prop('disabled', false);
                            submitBtn.prop('disabled', false).html('Save');
                            window.location.href = "<?php echo base_url('add-income') ?>";
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred: " + error);
                    },
                    complete: function() {
                        $j(form).find(':input').prop('disabled', false);
                        submitBtn.prop('disabled', false).html('Save');
                    }
                });
            }
        });
    });
</script>

<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header bg-primary ">
            <h6 style="color:white;text-align:center" class="card-title">Edit Revised Price</h6>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <?php
                        if ($this->session->userdata('success') != '') {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>
                                    <?php
                                    echo $this->session->userdata('success');
                                    $sdata = array(
                                        'success' => ''
                                    );
                                    $this->session->set_userdata($sdata);
                                    ?>
                                </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        $transaction = $this->db->where('transaction_id', $transaction_id)->get('transactions')->row();
                        ?>
                        <form class="form-horizontal" id="income_form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="transaction_id" id="transaction_id" value="<?php echo $transaction_id ?>">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter description"><?php echo $transaction->description ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="amount">Amount</label>
                                    <select class="form-control" type="text" name="cash_or_bank" id="cash_or_bank" placeholder="Enter the amount">
                                        <option selected disabled value="">Select Cash Or Bank</option>
                                        <option <?php echo $transaction->cash_or_bank == 'Cash' ? 'selected' : '' ?>>Cash</option>
                                        <option <?php echo $transaction->cash_or_bank == 'Bank' ? 'selected' : '' ?>>Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Amount *</label>
                                    <input class="form-control" value="<?php echo $transaction->amount ?>" onkeypress="return isNumberKey(this, event);" required name="amount" id="amount" placeholder="Enter the amount">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Date *</label>
                                    <input class="form-control datepicker" value="<?php echo date('d-m-Y', strtotime($transaction->date)) ?>" required name="date" id="date" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">File</label>
                                    <input class="form-control" name="attachment" id="attachment" type="file">
                                    <input class="form-control" name="attachment_edit" value="<?php echo $transaction->attachment ?>" id="attachment_edit" type="hidden">
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>