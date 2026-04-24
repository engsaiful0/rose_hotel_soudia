<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->
<head>
    <meta charset="UTF-8">
    <?php
    date_default_timezone_set('Asia/Riyadh');
    $banner = $this->db->where('banner_id', '1')->get('company')->row();
    $title = $this->db->where('banner_id', '1')->get('company')->row();
    $hotel_id = $this->session->userdata('hotel_id');
    ?>
    <title><?php echo $banner->title ?></title>
    <link rel="icon" type="image/x-icon"
          href="<?php echo base_url() ?>assets/uploads/banner/<?php echo $title->favicon ?>"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php
    include 'header_css.php';
    ?>
</head>
<!-- END Head-->

<!-- START: Body-->
<body id="main-container" class="default">
<?php
include 'header.php';
?>
<!-- END: Header-->

<!-- START: Main Menu-->
<div class="sidebar" style="background-color:#1E3D73;">
    <?php
    include 'backend/left_nav.php';
    ?>
</div>
<!-- END: Main Menu-->
<!-- START: Main Content-->
<main id="report">
    <div class="container-fluid site-width">
        <?php
        $data = date('Y-m-d');
        // KSA business day: 05:00 today → 05:00 next day (Asia/Riyadh, set in <head>).
        // Before 05:00 we still attribute totals to the calendar day that started at yesterday 05:00.
        $today_5am = strtotime(date('Y-m-d') . ' 05:00:00');
        $business_date = (time() < $today_5am)
            ? date('Y-m-d', strtotime('-1 day', $today_5am))
            : date('Y-m-d');
        // Same KSA window as datetime range for checkin.data_insert_time (Total Income Cash).
        $tz_riyadh = new DateTimeZone('Asia/Riyadh');
        $now_riyadh = new DateTime('now', $tz_riyadh);
        $today_at_5 = DateTime::createFromFormat('!Y-m-d H:i:s', $now_riyadh->format('Y-m-d') . ' 05:00:00', $tz_riyadh);
        if ($now_riyadh < $today_at_5) {
            $income_cash_window_start = (clone $today_at_5)->modify('-1 day');
            $income_cash_window_end = $today_at_5;
        } else {
            $income_cash_window_start = $today_at_5;
            $income_cash_window_end = (clone $today_at_5)->modify('+1 day');
        }
        $income_cash_window_start_str = $income_cash_window_start->format('Y-m-d H:i:s');
        $income_cash_window_end_str = $income_cash_window_end->format('Y-m-d H:i:s');
//        $time = date('i');
//        print_r($time);
        //die;
        include 'functions.php';
        $language = $this->session->userdata('language');
        $user_type = $this->session->userdata('type');
        $hotels = '';
        if ($user_type == 'superadmin') {
            $hotels = $this->db->where('disappear', '1')->get('hotel')->result();
        } else {
            $hotels = $this->db->where('hotel_id', $hotel_id)->get('hotel')->result();
        }
        $datepicker_serial = 1;
        $balance_load = 1;
        foreach ($hotels
                 as $hotel) {
            $hotel_id = $hotel->hotel_id;
            ?>
            <input type="hidden" id="hotel<?php echo $balance_load ?>_id" value="<?php echo $hotel->hotel_id ?>">
            <div class="card" style="width: 100% ">
                <div class="card-heading  bg-primary">
                    <h4 style="text-align: center;color: white"><?php
                        if ($language == 'english') {
                            echo $hotel->hotel_name_in_english;
                        } else {
                            echo $hotel->hotel_name_in_arabic;
                        }
                        ?></h4>

                </div>
                <div class="card-body">
                    <?php
                    include 'hotel_summary.php';
                    include 'day_dashboard.php';
                    include 'month_dashboard.php';
                    include 'renew_dashboard.php';
                    include 'free_dashboard.php';
                    ?>
                    <?php
                    $user_type = $this->session->userdata('type');
                    if ($user_type == 'superadmin') {
                        ?>
                        <div class="row" style="margin-top: 10px">
                            <table class="table table-bordered table-hover table-condensed table-responsive"
                                   style="width: 90%;">
                                <tr>

                                    <td>
                                        <?php
                                        if ($language == 'english') {
                                            ?>
                                            From Date
                                            <?php
                                        } else {
                                            ?>
                                            من التاريخ
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($language == 'english') {
                                            ?>
                                            To Date
                                            <?php
                                        } else {
                                            ?>
                                            حتى الآن
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control" value="" name="from_date"
                                               id="datepicker<?php echo $datepicker_serial++ ?>">
                                    </td>
                                    <td>
                                        <input class="form-control" value="" name="to_date"
                                               id="datepicker<?php echo $datepicker_serial++ ?>">
                                    </td>
                                    <?php
                                    $search = '';
                                    if ($language == 'english') {
                                        $search = 'Search';
                                    } else {
                                        $search = 'بحث';
                                    }
                                    ?>
                                    <td><input onclick="balance_load<?php echo $balance_load ?>()" type="submit"
                                               id="sumbit_button" value="<?php echo $search ?>"
                                               class="btn btn-primary"></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row" id="balance_load<?php echo $balance_load ?>">
                        <div class="col-md-2">
                            <div class="container-room bg-primary"
                                 style="width: 100%;float: left;margin-right: 5px;padding-top: 15px;height: 80px;margin-top: 5px;">

                                <div>
                                    <p style="color: white;text-align: center"><?php
                                        if ($language == 'english') {
                                            echo 'Total Income(Cash)';
                                        } else {
                                            echo '(السيولة النقدية)إجمالي الدخل';
                                        }
                                        ?></p>
                                    <?php
                                    $income_cash = $this->db->select_sum('rent', 'amount')
                                        ->where('cash_or_credit', 'cash')
                                        ->where('hotel_id', $hotel->hotel_id)
                                        ->where('dateOfEntry', $business_date)
                                        ->where('is_deleted', 0)->get('checkin_details')->result();

                                    $late = $this->db->select_sum('amount', 'amount')
                                        ->where('hotel_id', $hotel->hotel_id)
                                        ->where('date', $business_date)
                                       ->get('late')->result();
                                    ?>
                                    <p style="text-align: center;color: white"><?php echo $income_cash[0]->amount+$late[0]->amount; ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2" style="display: none;">
                            <div class="container-room bg-primary"
                                 style="width: 100%;float: left;margin-right: 5px;padding-top: 15px;height: 80px;margin-top: 5px;">

                                <div>
                                    <p style="color: white;text-align: center"><?php
                                        if ($language == 'english') {
                                            echo 'Late';
                                        } else {
                                            echo 'متأخر';
                                        }
                                        ?></p>
                                    <?php
                                    $late = $this->db->select_sum('amount', 'amount')
                                        ->where('hotel_id', $hotel->hotel_id)
                                        ->where('date', $business_date)
                                        ->get('late')->result();
                                    ?>
                                    <p style="text-align: center;color: white"><?php echo $late[0]->amount; ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="container-room bg-primary"
                                 style="width: 100%;float: left;margin-right: 5px;padding-top: 15px;height: 80px;margin-top: 5px;">

                                <div>
                                    <p style="color: white;text-align: center"><?php
                                        if ($language == 'english') {
                                            echo 'Total Income(Credit)';
                                        } else {
                                            echo 'إجمالي الدخل(تنسب إليه)';
                                        }
                                        ?></p>
                                    <?php
                                    $income_credit = $this->db->select_sum('rent', 'amount')
                                        ->where('cash_or_credit', 'credit')
                                        ->where('hotel_id', $hotel->hotel_id)
                                        ->where('dateOfEntry', $business_date)
                                        ->where('is_deleted', 0)->get('checkin_details')->result();
                                    ?>
                                    <p style="text-align: center;color: white"><?php echo $income_credit[0]->amount; ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="container-room bg-primary"
                                 style="width: 100%;float: left;margin-right: 5px;padding-top: 15px;height: 80px;">
                                <div>
                                    <p style="color: white;text-align: center"><?php
                                        if ($language == 'english') {
                                            echo 'Total Expense';
                                        } else {
                                            echo 'المصاريف الكلية';
                                        }
                                        ?></p>
                                    <?php
                                    $expense = $this->db->select_sum('amount', 'amount')
                                        ->where('hotel_id', $hotel->hotel_id)
                                        ->where('date', $business_date)
                                        ->get('expense')->result();
                                    ?>
                                    <p style="text-align: center;color: white"><?php echo $expense[0]->amount; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="container-room bg-primary"
                                 style="width: 100%;float: left;margin-right: 5px;padding-top: 15px;height: 80px;">
                                <div>
                                    <p style="color: white;text-align: center"><?php
                                        if ($language == 'english') {
                                            echo 'Balance';
                                        } else {
                                            echo 'الرصيد';
                                        }
                                        ?></p>
                                    <p style="text-align: center;color: white"><?php echo $income_cash[0]->amount+$late[0]->amount + $income_credit[0]->amount - $expense[0]->amount; ?></p>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <?php
            $balance_load++;
        }
        ?>
        <!-- START: Breadcrumbs-->
    </div>
    <?php
    ?>
</main>
<!-- END: Content-->
<!-- START: Footer-->
<div class="footer">
    <?php
    include 'backend/footer.php';
    ?>
</div>
<?php
include 'footer_js.php';
?>