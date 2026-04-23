<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #report,
        #report * {
            visibility: visible;
        }

        #report {
            position: absolute;
            left: 0;
            top: 0;
        }

        .background-color-text-color {
            background-color: #1E3D73 !important;
            color: white !important;
        }

        .financial_cost_table {
            width: 100% !important; /* Adjusted for responsiveness */
            margin: 0 auto;
        }

        td,
        th {
            font-size: 18px !important;
        }
    }
</style>

<div class="row">
    <div class="col-md-12">
        <button onclick="window.print()" class="btn btn-primary">Print</button>
        <?php

        $language = $this->session->userdata('language');


        error_reporting(0);
        $ids = $from_date . '_' . $to_date . '_' . $hotel_id;
        ?>
        <a  style="display: none;" class="btn btn-success" href="<?php echo site_url("ReportController/transaction_report_load_pdf/$ids"); ?>">PDF</a>

    </div>
</div>
<div id="report">
    <?php



    // Convert 'Y-m-d' format to textual representation
    function dateRangeToText($from_date, $to_date)
    {
        $from_timestamp = strtotime($from_date);
        $to_timestamp = strtotime($to_date);

        $from_month = date('F', $from_timestamp);
        $to_month = date('F', $to_timestamp);
        $from_year = date('Y', $from_timestamp);
        $to_year = date('Y', $to_timestamp);

        // Check if it's the same month and year
        if ($from_month === $to_month && $from_year === $to_year) {
            return "{$from_month} {$from_year}";
        } else {
            return "{$from_month} to {$to_month} {$from_year}";
        }
    }


    $total_income = '';
    // print_r('$from_date=' . $from_date);
    // print_r('$to_date=' . $to_date);

    if ($from_date != '' and $to_date != '' and $hotel_id != '') {
        $total_income = $this->db
            ->where('hotel_id', $hotel_id)
            ->where('date>=', date('Y-m-d', strtotime($from_date)))
            ->where('date<=', date('Y-m-d', strtotime($to_date)))
            ->get('transactions');
    } else if ($from_date != '' and $to_date == '' and $hotel_id == '') {
        $total_income = $this->db
            ->where('date', date('Y-m-d', strtotime($from_date)))
            ->get('transactions');
    } else if ($from_date == '' and $to_date != '' and $hotel_id == '') {
        $total_income = $this->db
            ->where('date', date('Y-m-d', strtotime($to_date)))
            ->get('transactions');
    } else if ($from_date == '' and $to_date == '' and $hotel_id != '') {
        $total_income = $this->db
            ->where('hotel_id', $hotel_id)
            ->get('transactions');
    } else if ($from_date == '' and $to_date == '' and $hotel_id == '') {
        $total_income = $this->db
            ->select('*')
            ->get('transactions');
    }

    $total_income_rows = $total_income->num_rows();
    $page_limit = ceil($total_income_rows / 45);
    //echo $page_limit;
    $from = -45;
    $start = 0;
    $all_grand_sub_total = 0;
    $all_grand_discount = 0;
    $all_grand_net_total = 0;
    $all_paid = 0;
    $all_due = 0;
    $sl = 1;
    //print_r($page_limit);
    for ($page_no = 1; $page_no <= $page_limit; $page_no++) :
    ?>
        <page size="A4">
            <div class="first">
                <div class="second" style="margin-left:auto">
                    <?php
                    //include 'report_header.php';
                    ?>
                    <table id="financial_cost_table" border="1" class="financial_cost_table" style="width: 1000px!important;margin: 0 auto;color:black;border-collapse:collapse;">

                        <?php
                        if ($from_date != '' and $to_date != '' and $hotel_id != '') {
                            $hotel = $this->db->select('*')
                                ->where('hotel_id', $hotel_id)
                                ->get('hotel')->row();
                        ?>
                            <tr style="background-color:#1E3D73;color:white" class="background-color-text-color">
                                <td colspan="8" style="text-align: center">
                                    <?php
                                    if ($language == 'english') {
                                    ?>
                                        Transaction Report for <b><?php echo $hotel->hotel_name_in_english ?> and <?php echo dateRangeToText($from_date, $to_date) ?></b>
                                    <?php
                                    } else {
                                    ?>
                                        تقرير المعاملات ل <b><?php echo $hotel->hotel_name_in_english ?> و <?php echo dateRangeToText($from_date, $to_date) ?></b>
                                    <?php
                                    }
                                    ?>


                                </td>
                            </tr>
                        <?php
                        } else if ($from_date != '' and $to_date == '' and $hotel_id == '') {
                        ?>
                            <tr style="background-color:#1E3D73;color:white" class="background-color-text-color">
                                <td colspan="8" style="text-align: center">
                                    <?php
                                    if ($language == 'english') {
                                    ?>
                                        Transaction Report of date <b><?php echo date('d-m-Y', strtotime($from_date)); ?></b>
                                    <?php
                                    } else {
                                    ?>
                                        تقرير المعاملات بالتاريخ <b><?php echo date('d-m-Y', strtotime($from_date)); ?></b>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        } else if ($from_date == '' and $to_date != '' and $hotel_id == '') {
                        ?>
                            <tr style="background-color:#1E3D73;color:white" class="background-color-text-color">
                                <td colspan="8" style="text-align: center">
                                    <?php
                                    if ($language == 'english') {
                                    ?>
                                        Transaction Report of date <b><?php echo date('d-m-Y', strtotime($to_date)); ?></b>
                                    <?php
                                    } else {
                                    ?>
                                        تقرير المعاملات بالتاريخ <b><?php echo date('d-m-Y', strtotime($to_date)); ?></b>
                                    <?php
                                    }
                                    ?>

                                </td>
                            </tr>
                        <?php
                        } else if ($from_date == '' and $to_date == '' and $hotel_id != '') {
                            $hotel = $this->db->select('*')
                                ->where('hotel_id', $hotel_id)
                                ->get('hotel')->row();
                        ?>
                            <tr style="background-color:#1E3D73;color:white" class="background-color-text-color">
                                <td colspan="8" style="text-align: center">
                                    <?php
                                    if ($language == 'english') {
                                    ?>
                                        Transaction Report for <b><?php echo $hotel->hotel_name_in_english ?></b>
                                    <?php
                                    } else {
                                    ?>
                                        تقرير المعاملات ل <b><?php echo $hotel->hotel_name_in_english ?></b>
                                    <?php
                                    }
                                    ?>


                                </td>
                            </tr>
                        <?php
                        } else if ($from_date == '' and $to_date == '' and $hotel_id == '') {
                        ?>
                            <tr style="background-color:#1E3D73;color:white" class="background-color-text-color">
                                <td colspan="8" style="text-align: center">
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
                                    ?>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                        <tr>
                            <td>
                                <?php
                                if ($language == 'english') {
                                ?>
                                    Sl
                                <?php
                                } else {
                                ?>
                                    س
                                <?php
                                }
                                ?>
                            </td>
                            <th>
                                <?php
                                if ($language == 'english') {
                                ?>
                                    Date
                                <?php
                                } else {
                                ?>
                                    تاريخ
                                <?php
                                }
                                ?>
                            </th>
                            <th> <?php
                                    if ($language == 'english') {
                                    ?>
                                    Cash Amount
                                <?php
                                    } else {
                                ?>
                                    مبلغ نقدي
                                <?php
                                    }
                                ?>
                            </th>
                            <th>
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
                                ?>
                            </th>
                            <th> <?php
                                    if ($language == 'english') {
                                    ?>
                                    Income
                                <?php
                                    } else {
                                ?>
                                    دخل
                                <?php
                                    }
                                ?></th>
                            <th><?php
                                if ($language == 'english') {
                                ?>
                                    Expense
                                <?php
                                } else {
                                ?>
                                    مصروف
                                <?php
                                }
                                ?></th>
                            <th><?php
                                if ($language == 'english') {
                                ?>
                                    Balance
                                <?php
                                } else {
                                ?>
                                    توازن
                                <?php
                                }
                                ?></th>
                            <th><?php
                                if ($language == 'english') {
                                ?>
                                    Description
                                <?php
                                } else {
                                ?>
                                    وصف
                                <?php
                                }
                                ?></th>

                        </tr>
                        <?php
                        $from = $from + 45;
                        $query = '';
                        $grand_total_cash_amount = 0;
                        $grand_total_bank_amount = 0;
                        $grand_total_total_amount = 0;
                        $grand_total_total_expense = 0;
                        $grand_total_total_remaining = 0;
                        if ($from_date != '' and $to_date != '' and $hotel_id != '') {
                            //die;
                            $this->db->select('*');
                            $this->db
                                ->where('hotel_id', $hotel_id)
                                ->where('date>=', date('Y-m-d', strtotime($from_date)))
                                ->where('date<=', date('Y-m-d', strtotime($to_date)));
                            $this->db->order_by('date', 'ASC')->from('transactions');
                            $this->db->limit(45, $from);
                            $query_get = $this->db->get();
                            $query = $query_get->result();
                        } else if ($from_date != '' and $to_date == '' and $hotel_id == '') {
                            $this->db->where('date', date('Y-m-d', strtotime($from_date)));
                            $this->db->order_by('date', 'ASC')->from('transactions');
                            $this->db->limit(45, $from);
                            $query_get = $this->db->get();
                            $query = $query_get->result();
                        } else if ($from_date == '' and $to_date != '' and $hotel_id == '') {
                            $this->db->where('date', date('Y-m-d', strtotime($to_date)));
                            $this->db->order_by('date', 'ASC')->from('transactions');
                            $this->db->limit(45, $from);
                            $query_get = $this->db->get();
                            $query = $query_get->result();
                        } else if ($from_date == '' and $to_date == '' and $hotel_id != '') {
                            $this->db->where('hotel_id', $hotel_id);
                            $this->db->limit(45, $from);
                            $query_get = $this->db->get();
                            $query = $query_get->result();
                        } else if ($from_date == '' and $to_date == '' and $hotel_id == '') {
                            $this->db->select('*');
                            $this->db->order_by('date', 'ASC')->from('transactions');
                            $this->db->limit(45, $from);
                            $query_get = $this->db->get();
                            $query = $query_get->result();
                        }

                        foreach ($query as $query_value) {

                        ?>
                            <tr>
                                <td>
                                    <?php echo $sl++ ?>
                                </td>
                                <td>
                                    <?php echo date('d-m-Y', strtotime($query_value->date)) ?>
                                </td>
                                <td>
                                    <?php echo $query_value->cash_amount;
                                    $grand_total_cash_amount += $query_value->cash_amount;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $query_value->bank_amount;
                                    $grand_total_bank_amount += $query_value->bank_amount;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $query_value->total_amount;
                                    $grand_total_total_amount += $query_value->total_amount;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $query_value->total_expense;
                                    $grand_total_total_expense += $query_value->total_expense;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $query_value->total_remaining;
                                    $grand_total_total_remaining += $query_value->total_remaining;
                                    ?>
                                </td>


                                <td>
                                    <?php echo $query_value->description ?>
                                </td>


                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td></td>

                            <td colspan="" style="text-align: right;font-weight: bold">
                            <?php
                                if ($language == 'english') {
                                ?>
                                    Total
                                <?php
                                } else {
                                ?>
                                    المجموع
                                <?php
                                }
                                ?>    
                            </td>
                            <td style="font-weight: bold"><?php echo number_format($grand_total_cash_amount, 0) ?></td>
                            <td style="font-weight: bold"><?php echo number_format($grand_total_bank_amount, 0) ?></td>
                            <td style="font-weight: bold"><?php echo number_format($grand_total_total_amount, 0) ?></td>
                            <td style="font-weight: bold"><?php echo number_format($grand_total_total_expense, 0) ?></td>
                            <td style="font-weight: bold"><?php echo number_format($grand_total_total_remaining, 0) ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="" style="text-align: right;font-weight: bold">
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
                            </td>
                            <td colspan="6" style="font-weight: bold"><?php echo number_format(($grand_total_total_amount), 0) ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="" style="text-align: right;font-weight: bold">
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
                                ?>
                            </td>
                            <td colspan="6" style="font-weight: bold"><?php echo number_format(($grand_total_total_expense), 0) ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="" style="text-align: right;font-weight: bold">
                                <?php
                                if ($language == 'english') {
                                ?>
                                    Total Balance
                                <?php
                                } else {
                                ?>
                                    الرصيد الإجمالي
                                <?php
                                }
                                ?>
                            </td>
                            <td colspan="6" style="font-weight: bold"><?php echo number_format(($grand_total_total_remaining), 0) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </page>
    <?php
    endfor;
    ?>
</div>