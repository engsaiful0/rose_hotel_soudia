<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #report,
        #report * {
            visibility: visible;
            overflow: visible;
        }

        #report {
            position: absolute;
            left: 0;
            top: 0;
        }

        .financial_cost_table {
            width: 600px;
            margin: 0 auto;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <button onclick="window.print()" class="btn btn-primary">Print</button>
        <?php
        error_reporting(0);
        $ids = $from_date . '_' . $to_date;
        ?>
        <a class="btn btn-success" href="<?php echo site_url("ReportController/income_report_load_pdf/$ids"); ?>">PDF</a>

    </div>
</div>
<div id="report">
    <?php
    $total_income = '';
    // print_r('$from_date=' . $from_date);
    // print_r('$to_date=' . $to_date);
    
    if ($from_date != '' and $to_date != '') {
        $total_income = $this->db
            ->where('type', 'income')
            ->where('date>=', date('Y-m-d', strtotime($from_date)))
            ->where('date<=', date('Y-m-d', strtotime($to_date)))
            ->get('transactions');
    } else if ($from_date != '' and $to_date == '') {
        $total_income = $this->db
            ->where('type', 'income')
            ->where('date', date('Y-m-d', strtotime($from_date)))
            ->get('transactions');
    } else if ($from_date == '' and $to_date != '') {
        $total_income = $this->db
            ->where('type', 'income')
            ->where('date', date('Y-m-d', strtotime($to_date)))
            ->get('transactions');
    } else {
        $total_income = $this->db
            ->select('*')
            ->where('type', 'income')
            ->get('transactions');
    }

    // }

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
                <div class="second">
                    <?php
                    //include 'report_header.php';
                    ?>
                    <table id="financial_cost_table" border="1" class="financial_cost_table" style="width: 700px!important;margin: 0 auto;color:black;border-collapse:collapse;">

                        <?php
                        if ($from_date != '' and $to_date != '') {
                        ?>
                            <tr>
                                <td colspan="6" style="text-align: center">Income Report From date <b><?php echo date('d-m-Y', strtotime($from_date)); ?></b> To date <b><?php echo date('d-m-Y', strtotime($to_date)); ?></b></td>
                            </tr>
                        <?php
                        } else if ($from_date != '' and $to_date == '') {
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: center">Income Report of date <b><?php echo date('d-m-Y', strtotime($from_date)); ?></b></td>
                            </tr>
                        <?php
                        } else if ($from_date == '' and $to_date != '') {
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: center">Income Report of date <b><?php echo date('d-m-Y', strtotime($to_date)); ?></b></td>
                            </tr>
                        <?php
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: center">Income Report</td>
                            </tr>
                        <?php
                        }
                        ?>

                        <tr>
                            <td>Sl</td>
                            <td>Description</td>
                            <td>Cash/Bank</td>
                            <td>Amount</td>
                            <td>Date</td>


                        </tr>
                        <?php
                        $from = $from + 45;
                        $query = '';
                        $grand_total_expenses = 0;
                        if ($from_date != '' and $to_date != '') {
                            //die;
                            $this->db->select('*');
                            $this->db
                                ->where('type', 'income')
                                ->where('date>=', date('Y-m-d', strtotime($from_date)))
                                ->where('date<=', date('Y-m-d', strtotime($to_date)));
                            $this->db->order_by('date','ASC')->from('transactions');
                            $this->db->limit(45, $from);
                            $query_get = $this->db->get();
                            $query = $query_get->result();
                        } else if ($from_date != '' and $to_date == '') {
                            $this->db->select('*');
                            $this->db->where('type', 'income')
                                ->where('date', date('Y-m-d', strtotime($from_date)));
                            $this->db->order_by('date','ASC')->from('transactions');

                            $this->db->limit(45, $from);
                            $query_get = $this->db->get();
                            $query = $query_get->result();
                        } else if ($from_date == '' and $to_date != '') {
                            $this->db->select('*');
                            $this->db->where('type', 'income')
                                ->where('date', date('Y-m-d', strtotime($to_date)));
                            $this->db->order_by('date','ASC')->from('transactions');

                            $this->db->limit(45, $from);
                            $query_get = $this->db->get();
                            $query = $query_get->result();
                        } else {
                            $this->db->select('*');
                            $this->db->where('type', 'income');
                            $this->db->order_by('date','ASC')->from('transactions');
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
                                    <?php echo $query_value->description ?>
                                </td>
                                <td>
                                    <?php echo $query_value->cash_or_bank ?>
                                </td>
                                <td>
                                    <?php
                                    echo $query_value->amount;
                                    $grand_total_income += $query_value->amount;
                                    ?>
                                </td>
                                <td>
                                    <?php echo date('d-m-Y', strtotime($query_value->date)) ?>
                                </td>



                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="" style="text-align: right;font-weight: bold">Total</td>
                            <td style="font-weight: bold"><?php echo number_format($grand_total_income, 0) ?></td>
                            <td></td>


                        </tr>
                    </table>
                </div>
            </div>
        </page>
    <?php
    endfor;
    ?>
</div>