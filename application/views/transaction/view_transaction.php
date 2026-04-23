<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header bg-primary justify-content-between align-items-center">
                <h4 class="card-title" style="text-align: center;color: white">View transaction</h4>
            </div>
            <div class="card-body">
                <?php
                // echo '<pre>';
                // print_r($_SESSION);
                // die;
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
                $language = $this->session->userdata('language');
                $hotel_id = $this->session->userdata('hotel_id');
                ?>
                <form method="post" action="<?php echo base_url('view-transaction') ?>">
                    <table class="table table-bordered table-hover table-condensed table-responsive" style="width: 100%;">
                        <tr>
                            <td>Hotel</td>
                            <td>From Date</td>
                            <td>To Date</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
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
                                        foreach ($hotels as $hotel) {
                                            ?>
                                                <option value="<?php echo $hotel->hotel_id ?>"><?php echo $hotel->hotel_name_in_english ?></option>
                                            <?php
                                            }
                                    } else {
                                        $hotels = $this->db->where('hotel_id', $hotel_id)->get('hotel')->result();
                                        foreach ($hotels as $hotel) {
                                            ?>
                                                <option selected value="<?php echo $hotel->hotel_id ?>"><?php echo $hotel->hotel_name_in_english ?></option>
                                            <?php
                                            }
                                    }

                                    
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input id="from_date" name="from_date" class="form-control datepicker">
                            </td>
                            <td>
                                <input id="to_date" name="to_date" class="form-control datepicker">
                            </td>
                            <td><input type="submit" value="Submit" class="btn btn-primary"></td>
                        </tr>

                    </table>
                </form>
                <div class="table-responsive">
                    <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <th>Hotel</th>
                                <th>Description</th>
                                <th>Cash Amount</th>
                                <th>Bank Amount</th>
                                <th>Income</th>
                                <th>Expense</th>
                                <th>Remaining</th>
                                <th>Date</th>
                                <th>File</th>
                                <?php
                                if ($_SESSION['type'] == 'admin' || $_SESSION['type'] == 'superadmin') :
                                ?>
                                    <th>Edit</th>
                                    <th>Delete</th>
                            </tr>
                        <?php
                                endif
                        ?>
                        </thead>
                        <tbody>
                            <?php


                            $sl = 1;
                            foreach ($transaction_data as $transaction) {
                                $transaction_id = $transaction->transaction_id;
                                $hotel = $this->db->select('*')
                                ->where('hotel_id', $transaction->hotel_id)
                                ->get('hotel')->row();
                            ?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td><?php echo $hotel->hotel_name_in_english ?></td>
                                    <td><?php echo $transaction->description ?></td>
                                    <td><?php echo $transaction->cash_amount ?></td>
                                    <td><?php echo $transaction->bank_amount ?></td>
                                    <td><?php echo $transaction->total_amount ?></td>
                                    <td><?php echo $transaction->total_expense ?></td>
                                    <td><?php echo $transaction->total_remaining ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($transaction->date)) ?></td>
                                    <td>
                                        <?php
                                        if ($transaction->attachment != '') {
                                        ?>
                                            <a title="Click to download" href="<?php echo base_url() ?>assets/attachment/<?php echo $transaction->attachment ?>" download="">
                                                <img style="height: 50px;width: 100px;" src="<?php echo base_url() ?>assets/attachment/<?php echo $transaction->attachment ?>">
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    if ($_SESSION['type'] == 'admin' || $_SESSION['type'] == 'superadmin') :
                                    ?>
                                        <td>
                                            <a title="Edit" class="btn btn-primary" href="<?php echo base_url() ?>transaction-edit/<?php echo $transaction_id ?>"><i class="fa fa-pen "></i></a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Do you want to delete this head?')" title="Delete" class="btn btn-danger" href="<?php echo base_url() ?>transaction-delete/<?php echo $transaction_id ?>"><i class="fa fa-trash "></i></a>
                                        </td>
                                    <?php
                                    endif
                                    ?>
                                </tr>

                            <?php
                            }
                            ?>


                    </table>
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>

    </div>
</div>