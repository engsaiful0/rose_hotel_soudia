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

    }
</style>
<div class="row">
    <div class="col-md-12">
        <button onclick="window.print()" class="btn btn-primary" >Print</button>
    </div>
</div>
<div id="report">
    <?php
    $total_checkin_details = '';
    if ($hotel_id != -1) {
        $total_checkin_details = $this->db
            ->where('hotel_id', $hotel_id)
            ->get('checkin_details');
    } else {
        $total_checkin_details = $this->db
            ->select('*')
            ->get('checkin_details');

    }
    // }
    $total_checkin_details = $total_checkin_details->num_rows();
    $page_limit = ceil($total_checkin_details / 45);
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
                    <table  id="financial_cost_table" border="1" class="financial_cost_table" style="width: 100%!important;margin: 0 auto;color:black;border-collapse:collapse;position: absolute">
                        <tr>
                            <td colspan="5" style="text-align: center">Checkin Report</td>
                        </tr>
                        <tr>
                            <td>Sl</td>
                            <td>Month</td>
                            <td>Room</td>
                            <td>Rent</td>
                            <td>Date</td>

                        </tr>
                        <?php
                        $from = $from + 45;
                        $query = '';
                        $grand_total_other_cost=0;
                        if ($hotel_id!=-1) {
                            //die;
                            $this->db->select('*');
                            $this->db
                                ->where('checkin_details.hotel_id', $hotel_id)
                                ->where('checkin_details.is_deleted', '0')
                                ->where('checkin_details.dateOfEntry>=', date('Y-m-d', strtotime($from_date)))
                                ->where('checkin_details.dateOfEntry<=', date('Y-m-d', strtotime($to_date)));
                            $this->db->from('checkin_details');
                            $this->db->join('room', 'room.room_id  = checkin_details.room_id');
                            $this->db->join('checkin', 'checkin.checkin_id  = checkin_details.checkin_id');
//                            $this->db->limit(45, $from);
                            $query_blend = $this->db->get();
                            $query = $query_blend->result();
                        }
                        else {
                            $this->db->select('*');
                            $this->db
                                ->where('checkin_details.is_deleted', '0')
                                ->where('checkin_details.dateOfEntry>=', date('Y-m-d', strtotime($from_date)))
                                ->where('checkin_details.dateOfEntry<=', date('Y-m-d', strtotime($to_date)));
                            $this->db->from('checkin_details');
                            $this->db->join('room', 'room.room_id  = checkin_details.room_id');
                            $this->db->join('checkin', 'checkin.checkin_id  = checkin_details.checkin_id');
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
                                    <?php echo $query_value->day_or_month_or_year ?>
                                </td>
                                <td>
                                    <?php
                                    echo $query_value->room_no_in_english;
                                    ?>
                                </td>
                                <td>
                                    <?php echo date('d-m-Y',strtotime($query_value->dateOfEntry)) ?>
                                </td>

                                <td>
                                    <?php echo $query_value->rent;
                                    $all_grand_net_total+=$query_value->rent;
                                    ?>
                                </td>


                            </tr>
                            <?php
                        }
                        ?>
                        <tr>

                            <td colspan="3" style="text-align: right;font-weight: bold">Total</td>
                            <td style="font-weight: bold"><?php echo number_format($all_grand_net_total, 0) ?></td>

                            <td></td>

                        </tr>
                    </table>
                </div>
            </div>

</div>