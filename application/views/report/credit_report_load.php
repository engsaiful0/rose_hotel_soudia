<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #report, #report * {
            visibility: visible;
            overflow: visible;
        }
        #report {
            position: absolute;
            left: 0;
            top: 0;
        }
        .financial_cost_table
        {
            width: 600px;
            margin:0 auto;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <button onclick="window.print()" class="btn btn-primary" >Print</button>
        <?php
        //        error_reporting(0);
        //        $ids = $from_date . '_' . $to_date . '_' . $lobbeying_cost_head_id.'_'.$project_id;
        ?>
        <!--        <a class="btn btn-success" href="--><?php //echo site_url("ReportController/lobbeying_cost_report_load_pdf/$ids"); ?><!--">PDF</a>-->

    </div>
</div>
<div id="report">
    <?php
    $total_expense = '';
    if ($hotel_id != 'null') {
        $total_expense = $this->db
            ->where('hotel_id', $hotel_id)
            ->get('checkin_details');
    } else {
        $total_expense = $this->db
            ->select('*')
            ->get('checkin_details');

    }

    // }

    $total_expense_rows = $total_expense->num_rows();
    $page_limit = ceil($total_expense_rows / 45);
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

    include 'report_header.php';
    ?>
    <table id="financial_cost_table" border="1" class="financial_cost_table" style="width: 100%;!important;margin: 0 auto;color:black;border-collapse:collapse;">
        <tr>
            <!--                            <td colspan="6" style="text-align: center">Lobbeying Cost Report From date <b>--><?php //echo date('d-m-Y', strtotime($from_date)); ?><!--</b> To date <b>--><?php //echo date('d-m-Y', strtotime($to_date)); ?><!--</b></td>-->
            <td colspan="8" style="text-align: center">Credit Report</td>
        </tr>
        <tr>
            <td>Sl</td>
            <td>Hotel</td>
            <td>Room</td>
            <td>Account Number</td>
            <td>Amount</td>
            <td>Date</td>
            <td>Remarks</td>

        </tr>
        <?php
        $from = $from + 45;
        $query = '';
        $grand_total_expenses=0;
        if ($hotel_id != 'null' && $from_date!='null'&& $to_date!='null') {
            //die;
            $this->db->select('*');
            $this->db
                ->where('checkin_details.cash_or_credit', 'credit')
                ->where('checkin_details.hotel_id', $hotel_id)
                ->where('dateOfEntry>=', date('Y-m-d', strtotime($from_date)))
                ->where('dateOfEntry<=', date('Y-m-d', strtotime($to_date)));
            $this->db->from('checkin_details');
            $this->db->join('hotel', 'hotel.hotel_id  = checkin_details.hotel_id');
            $this->db->join('room', 'room.room_id  = checkin_details.room_id');
//                            $this->db->limit(45, $from);
            $query_blend = $this->db->get();
            $query = $query_blend->result();
        }
        else {
            $this->db->select('*');
            $this->db->where('checkin_details.cash_or_credit', 'credit');
            $this->db->from('checkin_details');
            $this->db->join('hotel', 'hotel.hotel_id  = checkin_details.hotel_id');
            $this->db->join('room', 'room.room_id  = checkin_details.room_id');
//                            $this->db->limit(45, $from);
            $query_blend = $this->db->get();
            $query = $query_blend->result();
        }

        foreach ($query as $query_value) {

            ?>
            <tr>
                <td>
                    <?php echo $sl++ ?>
                </td>
                <td>
                    <?php echo $query_value->hotel_name_in_english ?>
                </td>
                <td>
                    <?php echo $query_value->room_no_in_english ?>
                </td>
                <td>
                    <?php echo $query_value->account_number ?>
                </td>

                <td>
                    <?php
                    echo $query_value->rent;
                    $grand_total_expenses += $query_value->rent;
                    ?>
                </td>
                <td>
                    <?php echo date('d-m-Y',strtotime($query_value->dateOfEntry)) ?>
                </td>
                <td>
                    <?php echo $query_value->remarks ?>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="" style="text-align: right;font-weight: bold">Total</td>
            <td style="font-weight: bold"><?php echo number_format($grand_total_expenses, 0) ?></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
</div>

</div>