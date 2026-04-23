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

    </div>
</div>
<div id="report">
    <?php
    $total_expense = '';
    if ($hotel_id != 'null') {
        $total_expense = $this->db
            ->where('hotel_id', $hotel_id)
            ->get('expense');
    } else {
        $total_expense = $this->db
            ->select('*')
            ->get('expense');

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
            <td colspan="6" style="text-align: center">Expense Report</td>
        </tr>
        <tr>
            <td>Sl</td>
            <td>Hotel</td>
            <td>Amount</td>
            <td>Date</td>


        </tr>
        <?php
        $from = $from + 45;
        $query = '';
        $grand_total_expenses=0;
        $from_date_explote=explode('-',date('Y-m-d', strtotime($from_date)));
        $to_date_explote=explode('-',date('Y-m-d', strtotime($to_date)));
        $from_day=$from_date_explote[2];
        $to_day=$to_date_explote[2];
        for($i=$from_day;$i<=$to_day;$i++)
        {
            $new_date=$from_date_explote[0].'-'.$from_date_explote[1].'-'.$i;
            $this->db->select_sum('amount', 'amount')
                ->where('expense.hotel_id', $hotel_id)
                ->where('date', $new_date);
            $this->db->from('expense');
            $query_blend = $this->db->get();
            $query_total = $query_blend->result();

            $hotels = $this->db->where('hotel_id', $hotel_id)->get('hotel')->row();
            if($query_total[0]->amount!=''||$query_total[0]->amount!=0)
            {
            ?>
            <tr>
                <td>
                    <?php echo $sl++ ?>
                </td>
                <td>
                    <?php echo $hotels->hotel_name_in_english ?>
                </td>
                <td>
                    <?php
                    echo $query_total[0]->amount;
                    $grand_total_expenses += $query_total[0]->amount;
                    ?>
                </td>
                <td>
                    <?php echo date('d-m-Y',strtotime($new_date)) ?>
                </td>
            </tr>
            <?php
            }
        }
        ?>
        <tr>
            <td></td>
            <td colspan="" style="text-align: right;font-weight: bold">Total</td>
            <td style="font-weight: bold"><?php echo number_format($grand_total_expenses, 0) ?></td>
            <td></td>
        </tr>
    </table>
</div>
</div>

</div>