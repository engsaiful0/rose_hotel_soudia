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
        // Initialize form validation on the expense_form form element
        $j("#expense_form").validate({
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
                $('#expense_form :input').prop('disabled', true);
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');


                $j.ajax({
                    type: "POST",
                    url: "<?php echo base_url('expenseController/expense_edit_save'); ?>",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        if (response.success) {
                            // alert(response.message);
                            form.reset();

                            $('#expense_form :input').prop('disabled', false);
                            submitBtn.prop('disabled', false).html('Save');
                            window.location.href = "<?php echo base_url('view-expense') ?>";
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
            <h6 style="color:white;text-align:center" class="card-title">Edit Expense</h6>
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
                        $expense = $this->db->where('expense_id', $expense_id)->get('expense')->row();
                        // print_r( $expense );
                        // die;
                        ?>
                        <form class="form-horizontal" id="expense_form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="expense_id" id="expense_id" value="<?php echo $expense_id ?>">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter description"><?php echo $expense->description ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="description"> <?php
                                                                if ($language == 'english') {
                                                                ?>
                                            Select Hotel
                                        <?php
                                                                } else {
                                        ?>
                                            الفندق
                                        <?php
                                                                }
                                        ?></label>
                                    <select id="hotel_id" name="hotel_id" class="form-control">
                                        <?php
                                        $session_hotel_id = $this->session->userdata('hotel_id');
                                        $user_type = $this->session->userdata('type');
                                        if ($user_type == 'superadmin') {
                                            $hotels = $this->db->select('*')->get('hotel')->result();
                                        } else {
                                            $hotels = $this->db->where('hotel_id', $session_hotel_id)->get('hotel')->result();
                                        }
                                        ?>
                                        <option value="" disabled="">
                                            <?php
                                            if ($language == 'english') {
                                                echo "Hotel";
                                            } else {
                                                echo "الفندق";
                                            }
                                            ?>
                                        </option>
                                        <?php
                                        foreach ($hotels as $hotel) {
                                        ?>
                                            <option value="<?php echo $hotel->hotel_id; ?>"
                                                <?php echo ((int) $expense->hotel_id === (int) $hotel->hotel_id) ? 'selected' : ''; ?>>
                                                <?php echo $hotel->hotel_name_in_english; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Amount *</label>
                                    <input class="form-control" value="<?php echo $expense->amount ?>" onkeypress="return isNumberKey(this, event);" required name="amount" id="amount" placeholder="Enter the amount">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Date *</label>
                                    <input class="form-control datepicker" value="<?php echo date('d-m-Y', strtotime($expense->date)) ?>" required name="date" id="date" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">File</label>
                                    <input class="form-control" name="attachment" id="attachment" type="file">
                                    <input class="form-control" name="attachment_edit" value="<?php echo $expense->attachment ?>" id="attachment_edit" type="hidden">
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