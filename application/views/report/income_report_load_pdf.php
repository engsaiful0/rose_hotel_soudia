<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style>
        body {
            width: 100%;
            background: white;
            overflow-x: hidden;
            font-size: 12px;

        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.5);
            -o-box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.5);
            -webkit-box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.5);
            -moz-box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.5);

        }

        @media print {

            body,
            page[size="A4"] {
                margin: 0;
                box-shadow: 0;

            }
        }

        .first {
            width: 100%;

            margin: auto;
            padding: 5px 0px 0px 0px;
        }

        .second {
            width: 728px;
            height: 600px;
            margin: auto;
            margin-top: 40px
        }

        .third {
            width: 607px;
            height: 820px;
            margin: auto;
        }

        h2 {
            font-size: 24px;
        }

        #footer {
            width: 400px;
            margin: auto;
            background-color: #FFF;
        }

        #footer a {
            text-decoration: none;
            text-align: center;
            font-size: 10px;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .first {

                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
                -webkit-print-color-adjust: exact;
                font-size: 12px !important;
            }
        }

        @media print {
            #print {
                display: none;
            }

            .print {
                display: none;
            }
        }

        .upon {
            width: 70%;
            height: auto;
            margin: auto;

        }

        #site_header_logo {
            position: relative;
            width: 15%;
            height: 100px;
            float: left;
            margin-top: 10px;
            padding-left: 80px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a.tooltip {
            outline: none;
        }

        a.tooltip strong {
            line-height: 30px;
        }

        a.tooltip:hover {
            text-decoration: none;
        }

        a.tooltip span {
            z-index: 10;
            display: none;
            padding: 14px 20px;
            margin-top: 30px;
            margin-left: 2px;
            width: 300px;
            line-height: 16px;
        }

        a.tooltip:hover span {
            display: inline;
            position: absolute;
            color: #111;
            border: 1px solid #DCA;
            background: #fffAF0;
            font-size: 10px;
        }

        .callout {
            z-index: 20;
            position: absolute;
            top: 30px;
            border: 0;
            left: -12px;
        }

        /*CSS3 extras*/
        a.tooltip span {
            border-radius: 4px;
            box-shadow: 5px 5px 8px #CCC;
        }

        .boxright {
            width: 35%;
            height: 100px;
            float: left;
        }

        .fbox1 {
            width: 320px;
            float: left;
            margin-left: 39px;
            border-collapse: collapse;
            text-align: left;
            font-size: 10px;
        }

        .fbox1 td {
            height: 25px;
            line-height: 16px
        }

        @media print {
            .offs {
                display: none;
            }
        }

        tr:hover {
            background-color: #91b8f7
        }

        @font-face {
            font-family: 'NikoshBAN';
            src: url('../assets/fonts/NikoshBAN.ttf') format('truetype');

        }
    </style>

    <title>Lobbeing Cost Report Print</title>
</head>

<body> <?php
        $total_income = '';
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

        <div class="second">
            <?php
            // include 'report_header_pdf.php';
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
                    $this->db->order_by('date', 'ASC')->from('transactions');
                    $this->db->limit(45, $from);
                    $query_get = $this->db->get();
                    $query = $query_get->result();
                } else if ($from_date != '' and $to_date == '') {
                    $this->db->select('*');
                    $this->db->where('type', 'income')
                        ->where('date', date('Y-m-d', strtotime($from_date)));
                    $this->db->order_by('date', 'ASC')->from('transactions');

                    $this->db->limit(45, $from);
                    $query_get = $this->db->get();
                    $query = $query_get->result();
                } else if ($from_date == '' and $to_date != '') {
                    $this->db->select('*');
                    $this->db->where('type', 'income')
                        ->where('date', date('Y-m-d', strtotime($to_date)));
                    $this->db->order_by('date', 'ASC')->from('transactions');

                    $this->db->limit(45, $from);
                    $query_get = $this->db->get();
                    $query = $query_get->result();
                } else {
                    $this->db->select('*');
                    $this->db->where('type', 'income');
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

    <?php
        endfor;
    ?>
</body>

</html>