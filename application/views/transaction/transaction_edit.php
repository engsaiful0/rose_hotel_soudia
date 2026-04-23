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
    function total_income_calculate() {
        var cash_amount = $('#cash_amount').val();
        var bank_amount = $('#bank_amount').val();
        $('#total_amount').val(Number(cash_amount) + Number(bank_amount));
    }

    function total_remaining_calculate() {
        var total_amount = $('#total_amount').val();
        var total_expense = $('#total_expense').val();
        if (Number(total_expense) > Number(total_amount)) {
            alert("The expense can't be greater than income");
            $('#total_expense').val("");
            $('#total_expense').focus;

        } else {
            $('#total_remaining').val(Number(total_amount) - Number(total_expense));
        }
    }
    $j(document).ready(function() {
        // Initialize form validation on the transaction_form form element
        $j("#transaction_form").validate({
            rules: {
                description: "required",
                hotel_id: "required",

                cash_amount: {
                    required: true,
                    number: true
                },
                bank_amount: {
                    required: true,
                    number: true
                },
                total_amount: {
                    required: true,
                    number: true
                },
                total_expense: {
                    required: true,
                    number: true
                },
                total_remaining: {
                    required: true,
                    number: true
                },
                date: "required",



            },
            messages: {
                description: "Please enter description",
                hotel_id: "Please select a hotel",

                cash_amount: {
                    required: "Please enter cash amount",
                    number: "Please enter valid amount"
                },
                total_amount: {
                    required: "Please enter total amount",
                    number: "Please enter valid amount"
                },
                total_remaining: {
                    required: "Please enter remaining amount",
                    number: "Please enter valid amount"
                },
                bank_amount: {
                    required: "Please enter bank amount",
                    number: "Please enter valid amount"
                },
                total_expense: {
                    required: "Please enter total expense",
                    number: "Please enter valid amount"
                },
                date: "Please enter date",
            },
            submitHandler: function(form) {
                var submitBtn = $j('#submit_button');
                var formData = new FormData(form);
                $('#transaction_form :input').prop('disabled', true);
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                $j.ajax({
                    type: "POST",
                    url: "<?php echo base_url('TransactionController/transaction_edit_save'); ?>",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        if (response.success) {
                            // alert(response.message);
                            form.reset();

                            $('#transaction_form :input').prop('disabled', false);
                            submitBtn.prop('disabled', false).html('Save');
                            window.location.href = "<?php echo base_url('view-transaction') ?>";
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
<?php
$language = $this->session->userdata('language');
$hotel_id = $this->session->userdata('hotel_id');
?>
<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header bg-primary ">
            <h6 style="color:white;text-align:center" class="card-title">
                <?php
                if ($language == 'english') {
                ?>
                    Edit Transaction
                <?php
                } else {
                ?>
                    تحرير المعاملة
                <?php
                }
                ?>
            </h6>
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
                        <form class="form-horizontal" id="transaction_form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="transaction_id" id="transaction_id" value="<?php echo $transaction_id ?>">

                            <div class="row">
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label for="amount">
                                            <?php
                                            if ($language == 'english') {
                                            ?>
                                                Cash Amount
                                            <?php
                                            } else {
                                            ?>
                                                مبلغ نقدي
                                            <?php
                                            }
                                            ?></label>
                                        <input class="form-control" type="text" oninput="total_income_calculate()" onkeypress="return isNumberKey(this, event);" value="<?php echo $transaction->cash_amount ?>" name="cash_amount" id="cash_amount" placeholder="Enter cash amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">
                                            <?php
                                            if ($language == 'english') {
                                            ?>
                                                Bank Amount
                                            <?php
                                            } else {
                                            ?>
                                                مبلغ البنك
                                            <?php
                                            }
                                            ?> </label>
                                        <input class="form-control" type="text" oninput="total_income_calculate()" onkeypress="return isNumberKey(this, event);" value="<?php echo $transaction->bank_amount ?>" name="bank_amount" id="bank_amount" placeholder="Enter bank amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">
                                            <?php
                                            if ($language == 'english') {
                                            ?>
                                                Total Income
                                            <?php
                                            } else {
                                            ?>
                                                إجمالي الدخل
                                            <?php
                                            }
                                            ?>
                                        </label>
                                        <input onchange="total_remaining_calculate()" readonly class="form-control" type="text" onkeypress="return isNumberKey(this, event);" value="<?php echo $transaction->total_amount ?>" name="total_amount" id="total_amount" placeholder="Total Income">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">
                                            <?php
                                            if ($language == 'english') {
                                            ?>
                                                Total Expense
                                            <?php
                                            } else {
                                            ?>
                                                المصاريف الكلية
                                            <?php
                                            }
                                            ?> </label>
                                        <input onchange="total_remaining_calculate()" class="form-control" type="text" onkeypress="return isNumberKey(this, event);" name="total_expense" value="<?php echo $transaction->total_expense ?>" id="total_expense" placeholder="Enter the total expense">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">
                                            <?php
                                            if ($language == 'english') {
                                            ?>
                                                Total Remaining
                                            <?php
                                            } else {
                                            ?>
                                                المجموع المتبقي
                                            <?php
                                            }
                                            ?>
                                        </label>
                                        <input readonly class="form-control" type="text" onkeypress="return isNumberKey(this, event);" name="total_remaining" id="total_remaining" value="<?php echo $transaction->total_remaining ?>" placeholder="Total Remaining">
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword4">
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
                                        </label>
                                        <select id="hotel_id" name="hotel_id" class="form-control">
                                            <option disabled="" selected="" value="">
                                                <?php
                                                if ($language == 'english') {
                                                ?>
                                                    Select Hotel
                                                <?php
                                                } else {
                                                ?>
                                                    اختر الفندق
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
                                                <option <?php echo $transaction->hotel_id == $hotel->hotel_id ? "selected" : '' ?> value="<?php echo $hotel->hotel_id ?>"><?php echo $hotel->hotel_name_in_english ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-row">

                                        <label for="description">
                                            <?php
                                            if ($language == 'english') {
                                            ?>
                                                Description
                                            <?php
                                            } else {
                                            ?>
                                                وصف
                                            <?php
                                            }
                                            ?>
                                        </label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter description"><?php echo $transaction->description ?></textarea>

                                    </div>
                                    <div class="form-row">

                                        <label for="inputEmail4"> <?php
                                                                    if ($language == 'english') {
                                                                    ?>
                                                Date
                                            <?php
                                                                    } else {
                                            ?>
                                                تاريخ
                                            <?php
                                                                    }
                                            ?> *</label>
                                        <input class="form-control datepicker" value="<?php echo date('d-m-Y', strtotime($transaction->date)) ?>" required name="date" id="date" placeholder="">

                                    </div>
                                    <div class="form-row">

                                        <label for="inputEmail4"><?php
                                                                    if ($language == 'english') {
                                                                    ?>
                                                File
                                            <?php
                                                                    } else {
                                            ?>
                                                ملف
                                            <?php
                                                                    }
                                            ?></label>
                                        <input class="form-control" name="attachment" id="attachment" type="file">
                                        <input class="form-control" name="attachment_edit" value="<?php echo $transaction->attachment ?>" id="attachment_edit" type="hidden">

                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <?php
                                if ($language == 'english') {
                                ?>
                                    Update
                                <?php
                                } else {
                                ?>
                                    تحديث
                                <?php
                                }
                                ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>