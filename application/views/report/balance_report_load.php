<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #balance_report_print_area, #balance_report_print_area * {
            visibility: visible;
        }
        #balance_report_print_area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
    .balance_report_table {
        border: 2px solid #222 !important;
        border-collapse: collapse !important;
    }
    .balance_report_table thead th,
    .balance_report_table tbody td {
        border: 1px solid #222 !important;
        padding: 8px;
    }
    .balance_report_table tbody tr:last-child td {
        border: 1px solid #222 !important;
    }
    @media print {
        .balance_report_table,
        .balance_report_table thead th,
        .balance_report_table tbody td {
            border: 1px solid #000 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
    .balance_report_doc_header {
        width: 1000px;
        max-width: 100%;
        margin: 0 auto 16px auto;
        padding: 12px 16px;
        border: 2px solid #222;
        background: #f8f9fa;
        color: #000;
        text-align: center;
    }
    .balance_report_doc_header .hotel-name {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 8px;
    }
    .balance_report_doc_header .date-range {
        font-size: 1rem;
    }
</style>
<?php
date_default_timezone_set('Asia/Riyadh');
include __DIR__ . '/../functions.php';
$language = $this->session->userdata('language');

if ($hotel_id === '' || $hotel_id === null) {
    echo '<p class="text-danger">' . ($language == 'english' ? 'Please select a hotel.' : 'يرجى اختيار الفندق.') . '</p>';
    return;
}
if ($from_date === '' || $to_date === '') {
    echo '<p class="text-danger">' . ($language == 'english' ? 'Please select from and to dates.' : 'يرجى اختيار من التاريخ وإلى التاريخ.') . '</p>';
    return;
}
if (strtotime($from_date) > strtotime($to_date)) {
    echo '<p class="text-danger">' . ($language == 'english' ? 'From date cannot be after to date.' : 'تاريخ البداية لا يمكن أن يكون بعد تاريخ النهاية.') . '</p>';
    return;
}

$hotel_row = $this->db->where('hotel_id', $hotel_id)->get('hotel')->row();
$hotel_display_name = $hotel_row
    ? ($language == 'english' ? $hotel_row->hotel_name_in_english : $hotel_row->hotel_name_in_arabic)
    : '';
$range_from_display = date('d/m/Y', strtotime($from_date));
$range_to_display = date('d/m/Y', strtotime($to_date));
$date_range_label = $language == 'english'
    ? ('Date range: ' . $range_from_display . ' — ' . $range_to_display)
    : ('الفترة: من ' . $range_from_display . ' إلى ' . $range_to_display);
?>
<div class="row">
    <div class="col-md-12">
        <button onclick="window.print()" type="button" class="btn btn-primary"><?php echo $language == 'english' ? 'Print' : 'طباعة'; ?></button>
    </div>
</div>
<div id="balance_report_print_area" class="mt-3">
    <div class="balance_report_doc_header">
        <div class="hotel-name"><?php echo htmlspecialchars($hotel_display_name, ENT_QUOTES, 'UTF-8'); ?><br> Balance Report</div>
        <div class="date-range"><?php echo htmlspecialchars($date_range_label, ENT_QUOTES, 'UTF-8'); ?></div>
    </div>
    <table class="table balance_report_table" style="width:1000px;max-width:100%;margin:0 auto;color:#000;">
        <thead >
        <tr>
            <th><?php echo $language == 'english' ? 'Date' : 'التاريخ'; ?></th>
            <th><?php echo $language == 'english' ? 'Total Income(Cash)' : 'إجمالي الدخل (نقدي)'; ?></th>
            <th><?php echo $language == 'english' ? 'Total Income(Credit)' : 'إجمالي الدخل (الائتماني)'; ?></th>
            <th><?php echo $language == 'english' ? 'Total Expense' : 'إجمالي المصروف'; ?></th>
            <th><?php echo $language == 'english' ? 'Description(Expense)' :'الوصف (المصروفات)'; ?></th>
            <th><?php echo $language == 'english' ? 'Balance' : 'الرصيد'; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $grand_cash = 0;
        $grand_credit = 0;
        $grand_expense = 0;
        $grand_balance = 0;

        for ($t = strtotime($from_date); $t <= strtotime($to_date); $t = strtotime('+1 day', $t)) {
            $business_date = date('Y-m-d', $t);
            // data_insert_time (TIMESTAMP): match calendar day, same as admin panel
            $cash_window_start = $business_date . ' 00:00:00';
            $cash_window_end = date('Y-m-d H:i:s', strtotime($business_date . ' +1 day'));

            $income_cash_row = $this->db->select_sum('rent', 'amount')
                ->where('cash_or_credit', 'cash')
                ->where('hotel_id', $hotel_id)
                ->where('is_deleted', 0)
                ->where('data_insert_time >=', $cash_window_start)
                ->where('data_insert_time <', $cash_window_end)
                ->get('checkin_details')->row();

            $income_credit_row = $this->db->select_sum('rent', 'amount')
                ->where('cash_or_credit', 'credit')
                ->where('hotel_id', $hotel_id)
                ->where('is_deleted', 0)
                ->where('data_insert_time >=', $cash_window_start)
                ->where('data_insert_time <', $cash_window_end)
                ->get('checkin_details')->row();

            $late_row = $this->db->select_sum('amount', 'amount')
                ->where('hotel_id', $hotel_id)
                ->where('date', $business_date)
                ->get('late')->row();

            $expense_sum_row = $this->db->select_sum('amount', 'amount')
                ->where('hotel_id', $hotel_id)
                ->where('date', $business_date)
                ->get('expense')->row();

            $expense_lines = $this->db->select('description, amount')
                ->where('hotel_id', $hotel_id)
                ->where('date', $business_date)
                ->order_by('expense_id', 'ASC')
                ->get('expense')->result();

            $cash = (float)($income_cash_row && $income_cash_row->amount !== null ? $income_cash_row->amount : 0);
            $cash += (float)($late_row && $late_row->amount !== null ? $late_row->amount : 0);
            $credit = (float)($income_credit_row && $income_credit_row->amount !== null ? $income_credit_row->amount : 0);
            $expense = (float)($expense_sum_row && $expense_sum_row->amount !== null ? $expense_sum_row->amount : 0);

            $desc_parts = array();
            foreach ($expense_lines as $line) {
                $d = trim((string)$line->description);
                if ($d === '') {
                    $d = '-';
                }
                $desc_parts[] = $d . ' (' . number_format((float)$line->amount, 0, '.', '') . ')';
            }
            $expense_description = count($desc_parts) ? implode('; ', $desc_parts) : '';

            $balance = $cash + $credit - $expense;

            $all_zero = (abs($cash) < 0.00001 && abs($credit) < 0.00001 && abs($expense) < 0.00001 && abs($balance) < 0.00001);
            if ($all_zero) {
                continue;
            }

            $grand_cash += $cash;
            $grand_credit += $credit;
            $grand_expense += $expense;
            $grand_balance += $balance;
            ?>
            <tr>
                <td><?php echo date('d/m/Y', strtotime($business_date)); ?></td>
                <td style="text-align:right"><?php echo number_format($cash, 0, '.', ''); ?></td>
                <td style="text-align:right"><?php echo number_format($credit, 0, '.', ''); ?></td>
                <td style="text-align:right"><?php echo number_format($expense, 0, '.', ''); ?></td>
                <td><?php echo htmlspecialchars($expense_description, ENT_QUOTES, 'UTF-8'); ?></td>
                <td style="text-align:right"><?php echo number_format($balance, 0, '.', ''); ?></td>
            </tr>
            <?php
        }
        ?>
        <tr style="font-weight:bold;background:#f0f0f0;">
            <td><?php echo $language == 'english' ? 'Total' : 'الإجمالي'; ?></td>
            <td style="text-align:right"><?php echo number_format($grand_cash, 0, '.', ''); ?></td>
            <td style="text-align:right"><?php echo number_format($grand_credit, 0, '.', ''); ?></td>
            <td style="text-align:right"><?php echo number_format($grand_expense, 0, '.', ''); ?></td>
            <td></td>
            <td style="text-align:right"><?php echo number_format($grand_balance, 0, '.', ''); ?></td>
        </tr>
        </tbody>
    </table>
</div>
