<style>
    @media print {
        .displaynone
        {
            display: none;
        }
    }

</style>
<div class="container-fluid site-width">
    <!-- START: Card Data-->
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h6 class="card-title">Project Details Report</h6>
                        </div>
                        <div class="col-md-2">
                            <button onclick="window.print()"  class="btn btn-primary displaynone pull-right " >Print</button>
                        </div>
                    </div>


                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?php
                        error_reporting(0);
                        $projoct = $this->db->where('project_id', $project_id)->get('project')->row();
                        $total_project_price = 0;
                        $total_grand_cost = 0;
                        $total_grand_income = 0;
                        $total_grand_income_cost = 0;
                        $project_security_and_vat = 0;
                        $total_grand_other_income = 0;

                        $final_project_price = 0;
                        $final_project_revised_price = 0;
                        $final_project_vat = 0;
                        $final_project_security_money = 0;
                        $total_grand_other_cost = 0;
                        $total_grand_financial_cost=0;
                        $total_grand_labor_cost = 0;
                        $total_lobbeying_cost = 0;
                        $total_salvage_cost=0;
                        ?>
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="4">
                                    Project Details
                                </td>
                            </tr>
                            <tr>
                                <td>Project Name</td>
                                <td style="font-weight: bold">
                                    <?php echo $projoct->project_name ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td style="font-weight: bold">
                                    <?php echo $projoct->description ?>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="4">
                                    Project price
                                </td>
                            </tr>
                            <tr>
                                <td>Total Price(+)</td>
                                <td>
                                    <?php echo $projoct->price;
                                    $final_project_price = $projoct->price;
                                    $total_project_price += $projoct->price;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a style="color: black;text-decoration:none " href="<?php echo base_url() ?>revised-price-report">
                                        Revised Price(+)
                                    </a>

                                </td>
                                <td>
                                    <?php

                                    $revised_price = $this->db
                                        ->select_sum('amount', 'amount')
                                        ->where('project_id',$project_id)
                                        ->where('is_deleted', '0')
                                        ->get('revised_price')->result();
                                    $revised_price = $revised_price[0]->amount;
                                    echo $revised_price;
                                    $final_project_revised_price =$total_project_price+$revised_price;

                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a style="color: black;text-decoration:none " href="<?php echo base_url() ?>salvage-cost-report">
                                        Selvage Cost(-)
                                    </a>
                                   </td>
                                <td>
                                    <?php
                                    $salvage_costs = $this->db
                                        ->select_sum('amount', 'amount')
                                        ->where('project_id', $project_id)
                                        ->where('is_deleted','0')
                                        ->get('salvage')->result();
                                    echo $projoct->salvage_cost+$salvage_costs[0]->amount;
                                    $total_salvage_cost=$salvage_costs[0]->amount;

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;background-color:#1C7EC2;color: white;text-align: right">Final Price</td>
                                <td>
                                    <?php echo $total_project_price+$revised_price-$total_salvage_cost;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a style="color: black;text-decoration:none " href="<?php echo base_url() ?>bill-amount-report">
                                        Bill Amount
                                    </a>

                                </td>
                                <td>
                                    <?php

                                    $partial_project_bill = $this->db
                                        ->select_sum('amount', 'amount')
                                        ->where('project_id',$project_id)
                                        ->where('is_deleted', '0')
                                        ->get('partial_project_bill')->result();
                                    $partial_project_bill = $partial_project_bill[0]->amount;
                                    echo $partial_project_bill;

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a style="color: black;text-decoration:none " href="<?php echo base_url() ?>vat-tax-report">
                                        Vat & Tax(-)
                                    </a>
                                   </td>
                                <td style="font-weight: bold">
                                    <?php
                                    $total_tax = $this->db
                                        ->select_sum('amount', 'amount')
                                        ->where('project_id',$projoct->project_id)
                                        ->where('is_deleted', '0')
                                        ->get('tax')->result();
                                    $total_tax = $total_tax[0]->amount;
                                    echo $total_tax;
                                    $final_project_vat = $total_tax;

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a style="color: black;text-decoration:none " href="<?php echo base_url() ?>security-money-report">
                                        Security Money(-)
                                    </a>
                                  </td>
                                <td style="font-weight: bold">
                                    <?php
                                    $total_security_money = $this->db
                                        ->select_sum('amount', 'amount')
                                        ->where('project_id',$projoct->project_id)
                                        ->where('is_deleted', '0')
                                        ->get('security_money')->result();
                                    $total_security_money = $total_security_money[0]->amount;
                                    echo $total_security_money;
                                    $final_project_security_money = $total_security_money;

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a style="color: black;text-decoration:none " href="<?php echo base_url() ?>bill-amount-report">
                                        Bill Received (Cash)
                                    </a>

                                </td>
                                <td>
                                    <?php

                                    $bill_received = $this->db
                                        ->select_sum('amount', 'amount')
                                        ->where('project_id',$project_id)
                                        ->where('is_deleted', '0')
                                        ->get('bill_received')->result();
                                    echo $bill_received[0]->amount;;

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Balance Fund</td>
                                <td style="font-weight: bold"
                                    colspan="3"><?php echo $total_project_price - $final_project_security_money-$final_project_vat-$total_salvage_cost ?></td>
                            </tr>

                        </table>
                        <table class="table table-striped table-bordered table-hover">

                            <tr>

                                    <td style="text-align: center;background-color:#131440;color: white " colspan="3">
                                        <a style="color: white;text-decoration:none " href="<?php echo base_url() ?>material-purchase-report">
                                            Cost of Material
                                        </a>
                                    </td>


                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Head Name</td>
                                <td>
                                     Amount
                                </td>

                            </tr>
                            <?php
                            $sl = 1;
                            $material_heads = $this->db->where('is_deleted','0')->get('history')->result();
                            $grand_material_cost=0;
                            foreach ($material_heads as $material_head) {

                                $project = $this->db->where('project_id', $project_id)
                                    ->get('project')->row();
                                $total_income_cost = $this->db
                                    ->select_sum('total_price', 'amount')
                                    ->where('project_id', $project_id)
                                    ->where('is_deleted','0')
                                    ->where('material_head_id  ', $material_head->material_head_id )
                                    ->get('purchase_details')->result();
                                $material_cost = $total_income_cost[0]->amount;
                                if ($material_cost > 0) {


                                    ?>
                                    <tr>
                                        <td><?php echo $sl++ ?></td>
                                        <td><?php echo $material_head->material_head_name ?></td>
                                        <td><?php echo $material_cost;
                                            $grand_material_cost += $material_cost;
                                            ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="2" style="text-align: right">Total  Cost of Material</td>
                                <td style="font-weight: bold"><?php echo number_format($grand_material_cost, 0) ?></td>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered table-hover">

                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="4">
                                    <a style="color: white;text-decoration:none " href="<?php echo base_url() ?>labor-cost-report">
                                        Labor Cost
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Head Name</td>
                                <td>
                                     Amount
                                </td>
                                <td>
                                    Date
                                </td>

                            </tr>
                            <?php
                            $sl = 1;


                            $project = $this->db->where('project_id', $project_id)
                                ->get('project')->row();

                            $total_labor_costs = $this->db
                                ->where('project_id', $project_id)
                                ->where('is_deleted','0')
                                ->get('counseling')->result();
                            foreach ($total_labor_costs as $total_labor_cost) {
                                $labor_cost_head = $this->db->where('labor_cost_head_id', $total_labor_cost->labor_cost_head_id)
                                    ->get('labor_cost_head')->row();
                                ?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td><?php echo $labor_cost_head->labor_cost_head_name ?></td>
                                    <td><?php echo $total_labor_cost->amount;
                                        $total_grand_labor_cost += $total_labor_cost->amount;
                                        ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($total_labor_cost->date));

                                        ?></td>
                                </tr>
                                <?php
                            }


                            ?>
                            <tr>
                                <td colspan="2" style="text-align: right">Total Labor Cost</td>
                                <td style="font-weight: bold"><?php echo number_format($total_grand_labor_cost, 0) ?></td>
                                <td></td>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered table-hover">

                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="4">

                                    <a style="color: white;text-decoration:none " href="<?php echo base_url() ?>lobbeying-cost-report">
                                        Lobbeying/Marketing Cost
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Head Name</td>
                                <td>
                                     Amount
                                </td>
                                <td>
                                    Date
                                </td>

                            </tr>
                            <?php
                            $sl = 1;
                            $project = $this->db->where('project_id', $project_id)
                                ->get('project')->row();

                            $lobbeying_costs = $this->db
                                ->where('project_id', $project_id)
                                ->where('is_deleted','0')
                                ->get('medication')->result();
                            foreach ($lobbeying_costs as $lobbeying_cost) {
                                $lobbeying_cost_head = $this->db->where('lobbeying_cost_head_id', $lobbeying_cost->lobbeying_cost_head_id)->get('lobbeying_cost_head')->row();
                                ?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td><?php echo $lobbeying_cost_head->lobbeying_cost_head_name ?></td>
                                    <td><?php echo $lobbeying_cost->amount;
                                        $total_lobbeying_cost += $lobbeying_cost->amount;
                                        ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($lobbeying_cost->date));

                                        ?></td>
                                </tr>
                                <?php
                            }


                            ?>
                            <tr>
                                <td colspan="2" style="text-align: right">Total Lobbeying/Marketing Cost</td>
                                <td style="font-weight: bold"><?php echo number_format($total_lobbeying_cost, 0) ?></td>
                                <td></td>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered table-hover">

                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="4">
                                    <a style="color: white;text-decoration:none " href="<?php echo base_url() ?>financial-cost-report">
                                        Financial Cost
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Cost Head</td>
                                <td>
                                     Amount
                                </td>

                            </tr>
                            <?php
                            $sl = 1;
                            $financial_cost_heads = $this->db->where('is_deleted','0')->get('financial_cost_head')->result();
                            foreach ($financial_cost_heads as $financial_cost_head) {

                                $project = $this->db->where('project_id', $project_id)
                                    ->get('project')->row();

                                $total_other_cost = $this->db
                                    ->select_sum('amount', 'amount')
                                    ->where('project_id', $project_id)
                                    ->where('is_deleted','0')
                                    ->where('financial_cost_head_id', $financial_cost_head->financial_cost_head_id)
                                    ->get('financial_cost')->result();
                                $total_other_financial_cost = $total_other_cost[0]->amount;
                                if ($total_other_financial_cost > 0) {


                                    ?>
                                    <tr>
                                        <td><?php echo $sl++ ?></td>
                                        <td><?php echo $financial_cost_head->financial_cost_head_name ?></td>
                                        <td><?php echo $total_other_financial_cost;
                                            $total_grand_financial_cost += $total_other_financial_cost;
                                            ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="2" style="text-align: right">Total Financial Cost</td>
                                <td style="font-weight: bold"><?php echo number_format($total_grand_financial_cost, 0) ?></td>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered table-hover">

                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="3">
                                    <a style="color: white;text-decoration:none " href="<?php echo base_url() ?>operation-cost-report">
                                        Operation & Admin Cost
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Head Name</td>
                                <td>Amount</td>

                            </tr>

                            <?php
                            $sl = 1;
                            $admin_cost_heads = $this->db->where('is_deleted','0')->get('admin_cost_head')->result();
                            foreach ($admin_cost_heads as $admin_cost_head) {

                                $project = $this->db->where('project_id', $project_id)
                                    ->get('project')->row();

                                $total_admin_cost = $this->db
                                    ->select_sum('amount', 'amount')
                                    ->where('project_id', $project_id)
                                    ->where('is_deleted','0')
                                    ->where('admin_cost_head_id', $admin_cost_head->admin_cost_head_id)
                                    ->get('admin_cost')->result();
                                $total_admin_cost = $total_admin_cost[0]->amount;
                                if ($total_admin_cost > 0) {


                                    ?>
                                    <tr>
                                        <td><?php echo $sl++ ?></td>
                                        <td><?php echo $admin_cost_head->admin_cost_head_name ?></td>
                                        <td><?php echo $total_admin_cost;
                                            $total_operation_admin_cost += $total_admin_cost;
                                            ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="2" style="text-align: right">Total Operation & Admin Cost</td>
                                <td style="font-weight: bold"><?php echo number_format($total_operation_admin_cost, 0) ?></td>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered table-hover">

                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="3">
                                    <a style="color: white;text-decoration:none " href="<?php echo base_url() ?>authority-cost-report">
                                        Authority Office Cost
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Head Name</td>
                                <td>Amount</td>

                            </tr>
                            <?php
                            $sl = 1;
                            $office_cost_heads = $this->db->where('is_deleted','0')->get('office_cost_head')->result();
                            foreach ($office_cost_heads as $office_cost_head) {

                                $project = $this->db->where('project_id', $project_id)
                                    ->get('project')->row();

                                $office_cost = $this->db
                                    ->select_sum('amount', 'amount')
                                    ->where('project_id', $project_id)
                                    ->where('is_deleted','0')
                                    ->where('office_cost_head_id', $office_cost_head->office_cost_head_id)
                                    ->get('office_cost')->result();
                                $office_cost = $office_cost[0]->amount;
                                if ($office_cost > 0) {


                                    ?>
                                    <tr>
                                        <td><?php echo $sl++ ?></td>
                                        <td><?php echo $office_cost_head->office_cost_head_name ?></td>
                                        <td><?php echo $office_cost;
                                            $total_office_cost += $office_cost;
                                            ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="2" style="text-align: right">Total Authority Office Cost</td>
                                <td style="font-weight: bold"><?php echo number_format($total_office_cost, 0) ?></td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered table-hover">

                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="3">
                                    <a style="color: white;text-decoration:none " href="<?php echo base_url() ?>other-cost-report">
                                        Other Cost
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Cost Head</td>
                                <td>
                                     Amount
                                </td>

                            </tr>
                            <?php
                            $sl = 1;
                            $other_cost_heads = $this->db ->where('is_deleted','0')->get('other_cost_head')->result();
                            foreach ($other_cost_heads as $other_cost_head) {

                                $project = $this->db->where('project_id', $project_id)
                                    ->get('project')->row();

                                $total_other_cost = $this->db
                                    ->select_sum('amount', 'amount')
                                    ->where('project_id', $project_id)
                                    ->where('is_deleted','0')
                                    ->where('other_cost_head_id', $other_cost_head->other_cost_head_id)
                                    ->get('other_cost')->result();
                                $total_other_cost = $total_other_cost[0]->amount;
                                if ($total_other_cost > 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sl++ ?></td>
                                        <td><?php echo $other_cost_head->other_cost_head_name ?></td>
                                        <td><?php echo $total_other_cost;
                                            $total_grand_other_cost += $total_other_cost;
                                            ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="2" style="text-align: right">Total Other Cost</td>
                                <td style="font-weight: bold"><?php echo number_format($total_grand_other_cost, 0) ?></td>
                            </tr>
                        </table>
                        <table class="table table-striped table-bordered table-hover">

                            <tr>
                                <td style="text-align: center;background-color:#131440;color: white " colspan="3">
                                    Project Summary
                                </td>
                            </tr>
                            <tr>
                                <td>Total Project Price (+)</td>
                                <td>
                                    <?php echo number_format($final_project_price, 0) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Project Revised Price (+)</td>
                                <td>
                                    <?php echo number_format($final_project_revised_price, 0) ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Total Salvage Cost (-)</td>
                                <td>
                                    <?php echo number_format($total_salvage_cost, 0) ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Total Vat & Tax (-)
                                <td>
                                    <?php echo number_format($final_project_vat, 0) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Security Money (-)
                                <td>
                                    <?php echo number_format($final_project_security_money, 0) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Material Cost (-)
                                <td>
                                    <?php echo number_format($grand_material_cost, 0) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Labor Cost (-)
                                <td>
                                    <?php echo number_format($total_grand_labor_cost, 0) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Lobbeying/Marketing Cost (-)
                                <td>
                                    <?php echo number_format($total_lobbeying_cost, 0) ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Total Financial Cost (-)
                                <td>
                                    <?php echo number_format($total_grand_financial_cost, 0) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Operation & Admin Cost (-)
                                <td>
                                    <?php echo number_format($total_operation_admin_cost, 0) ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Total Authority Office Cost (-)
                                <td>
                                    <?php echo number_format($total_office_cost, 0) ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Total Other Cost (-)
                                <td>
                                    <?php echo number_format($total_grand_other_cost, 0) ?>
                                </td>
                            </tr>
                            <tr style="background-color:#131440;color: white ">
                                <td style="text-align: right">Total Profit/Loss
                                <td>
                                    <?php echo number_format(($final_project_price+$final_project_revised_price) - ($total_grand_financial_cost+$total_salvage_cost+$final_project_vat+$final_project_security_money+$grand_material_cost+$total_grand_labor_cost+$total_lobbeying_cost+$total_grand_other_cost+$total_operation_admin_cost+$total_office_cost), 0) ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Card DATA-->
</div>