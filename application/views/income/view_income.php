<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header bg-primary justify-content-between align-items-center">
                <h4 class="card-title" style="text-align: center;color: white">View Income</h4>
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
                ?>
                <form method="post" action="<?php echo base_url('view-income') ?>">
                    <table class="table table-bordered table-hover table-condensed table-responsive" style="width: 100%;">
                        <tr>
                            <td>From Date</td>
                            <td>To Date</td>
                            <td></td>
                        </tr>
                        <tr>

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
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Cash/Bank</th>
                                <th>Date</th>
                                <th>File</th>
                                <?php
                                 if ($_SESSION['type'] == 'admin'||$_SESSION['type'] == 'superadmin') :
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
                            foreach ($income_data as $income) {
                                $transaction_id = $income->transaction_id;
                            ?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td><?php echo $income->description ?></td>
                                    <td><?php echo $income->amount ?></td>
                                    <td><?php echo $income->cash_or_bank ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($income->date)) ?></td>
                                    <td>
                                        <?php
                                        if ($income->attachment != '') {
                                        ?>
                                            <a title="Click to download" href="<?php echo base_url() ?>assets/attachment/<?php echo $income->attachment ?>" download="">
                                                <img style="height: 50px;width: 100px;" src="<?php echo base_url() ?>assets/attachment/<?php echo $income->attachment ?>">
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <?php
                                if ($_SESSION['type'] == 'admin'||$_SESSION['type'] == 'superadmin') :
                                ?>
                                    <td>
                                        <a title="Edit" class="btn btn-primary" href="<?php echo base_url() ?>income-edit/<?php echo $transaction_id ?>"><i class="fa fa-pen "></i></a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Do you want to delete this head?')" title="Delete" class="btn btn-danger" href="<?php echo base_url() ?>income-delete/<?php echo $transaction_id ?>"><i class="fa fa-trash "></i></a>
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