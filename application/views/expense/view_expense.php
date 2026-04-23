<!-- START: Card Data-->
<style>
    .pagination {
        display: inline-block;
        padding: 10px;
    }

    .pagination li {
        display: inline;
        margin: 0 5px;
    }

    .pagination li a {
        text-decoration: none;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        color: #333;
    }

    .pagination li a:hover {
        background-color: #007bff;
        color: white;
    }

    .pagination .active a {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
</style>
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header bg-primary justify-content-between align-items-center">
                <h4 class="card-title" style="text-align: center;color: white">View expense</h4>
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
                <form method="post" action="<?php echo base_url('view-expense') ?>">
                    <table class="table table-bordered table-hover table-condensed table-responsive" style="width: 100%;">
                        <tr>
                            <td>From Date</td>
                            <td>To Date</td>
                            <td>
                                <?php
                                if ($language == 'english') {
                                ?>
                                    Select Hotel
                                <?php
                                } else {
                                ?>
                                    الفندق
                                <?php
                                }
                                ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>

                            <td>
                                <input id="from_date" name="from_date" class="form-control datepicker">
                            </td>
                            <td>
                                <input id="to_date" name="to_date" class="form-control datepicker">
                            </td>
                            <td>
                                <select id="hotel_id" name="hotel_id" class="form-control">
                                    <option value="">
                                        <?php
                                        if ($language == 'english') {
                                        ?>
                                            Select Hotel
                                        <?php
                                        } else {
                                        ?>
                                            الفندق
                                        <?php
                                        }
                                        ?>
                                    </option>
                                    <?php
                                    $language = $this->session->userdata('language');
                                    $hotels = $this->db->select('*')->get('hotel')->result();

                                    foreach ($hotels as $hotel) {
                                    ?>
                                        <option <?php $transaction->hotel_id == $hotel->hotel_id ? "selected" : "" ?> value="<?php echo $hotel->hotel_id ?>"><?php echo $hotel->hotel_name_in_english ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="submit" value="Submit" class="btn btn-primary"></td>
                        </tr>

                    </table>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <th>Description</th>
                                <th>Hotel</th>
                                <th>Amount</th>
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
                            foreach ($expense_data as $expense) {
                                $expense_id = $expense->expense_id;
                                $hotel = $this->db->where('hotel_id', $expense->hotel_id)->get('hotel')->row();

                            ?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td><?php echo $expense->description ?></td>
                                    <td><?php echo $hotel->hotel_name_in_english ?></td>
                                    <td><?php echo $expense->amount ?></td>

                                    <td><?php echo date('d-m-Y', strtotime($expense->date)) ?></td>
                                    <td>
                                        <?php
                                        if ($expense->attachment != '') {
                                        ?>
                                            <a title="Click to download" href="<?php echo base_url() ?>assets/attachment/<?php echo $expense->attachment ?>" download="">
                                                <img style="height: 50px;width: 100px;" src="<?php echo base_url() ?>assets/attachment/<?php echo $expense->attachment ?>">
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    if ($_SESSION['type'] == 'admin' || $_SESSION['type'] == 'superadmin') :
                                    ?>
                                        <td>
                                            <a title="Edit" class="btn btn-primary" href="<?php echo base_url() ?>expense-edit/<?php echo $expense_id ?>"><i class="fa fa-pen "></i></a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Do you want to delete this head?')" title="Delete" class="btn btn-danger" href="<?php echo base_url() ?>expense-delete/<?php echo $expense_id ?>"><i class="fa fa-trash "></i></a>
                                        </td>
                                    <?php
                                    endif
                                    ?>
                                </tr>

                            <?php
                            }
                            ?>


                    </table>
                    <div style="width:70%; margin:0 auto; text-align:center">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <?php echo $pagination; ?>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>