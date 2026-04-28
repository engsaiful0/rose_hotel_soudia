<?php
function Convertnumber2english($srting)
{

    $srting = str_replace('۰', '0', $srting);
    $srting = str_replace('۱', '1', $srting);
    $srting = str_replace('۲', '2', $srting);
    $srting = str_replace('۳', '3', $srting);
    $srting = str_replace('۴', '4', $srting);
    $srting = str_replace('۵', '5', $srting);
    $srting = str_replace('۶', '6', $srting);
    $srting = str_replace('۷', '7', $srting);
    $srting = str_replace('۸', '8', $srting);
    $srting = str_replace('۹', '9', $srting);

    return $srting;
}

function Convertnumber2arabic($srting)
{
    $srting = str_replace('0', '۰', $srting);
    $srting = str_replace('1', '۱', $srting);
    $srting = str_replace('2', '۲', $srting);
    $srting = str_replace('3', '۳', $srting);
    $srting = str_replace('4', '۴', $srting);
    $srting = str_replace('5', '۵', $srting);
    $srting = str_replace('6', '۶', $srting);
    $srting = str_replace('7', '۷', $srting);
    $srting = str_replace('8', '۸', $srting);
    $srting = str_replace('9', '۹', $srting);

    return $srting;
}

if (!function_exists('hotel_business_date_now')) {
    /**
     * Business "day" for cash/credit totals from checkin_details.data_insert_time (Y-m-d H:i:s).
     * Each period is [business_date 05:00:00, next calendar day 05:00:00).
     * Before 05:00, totals still belong to the previous calendar business_date (shift that started yesterday at 05:00).
     *
     * @param int|null $timestamp Unix timestamp; null = now. Uses date_default_timezone_get().
     * @return string Business date Y-m-d
     */
    function hotel_business_date_now($timestamp = null)
    {
        $tzName = @date_default_timezone_get() ?: 'UTC';
        try {
            $tz = new DateTimeZone($tzName);
        } catch (Exception $e) {
            $tz = new DateTimeZone('UTC');
        }
        if ($timestamp === null || $timestamp === '') {
            $dt = new DateTime('now', $tz);
        } else {
            $dt = new DateTime('@' . (int) $timestamp);
            $dt->setTimezone($tz);
        }
        $fiveAm = clone $dt;
        $fiveAm->setTime(5, 0, 0);
        if ($dt < $fiveAm) {
            $fiveAm->modify('-1 day');
        }
        return $fiveAm->format('Y-m-d');
    }
}

if (!function_exists('hotel_checkin_cash_window_for_business_date')) {
    /**
     * Half-open window [start, end) for SQL on data_insert_time matching one business day.
     *
     * @param string $business_date Y-m-d
     * @return array{start:string,end:string}
     */
    function hotel_checkin_cash_window_for_business_date($business_date)
    {
        $tzName = @date_default_timezone_get() ?: 'UTC';
        try {
            $tz = new DateTimeZone($tzName);
        } catch (Exception $e) {
            $tz = new DateTimeZone('UTC');
        }
        $start = DateTime::createFromFormat('Y-m-d', $business_date, $tz);
        if (!$start) {
            $start = new DateTime('now', $tz);
        }
        $start->setTime(5, 0, 0);
        $end = clone $start;
        $end->modify('+1 day');
        return array(
            'start' => $start->format('Y-m-d H:i:s'),
            'end' => $end->format('Y-m-d H:i:s'),
        );
    }
}
?>