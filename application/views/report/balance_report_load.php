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
    .balance_report_table td,
    .balance_report_table th {
        padding: 8px;
        border: 1px solid #333;
    }
</style>
<?php
date_default_timezone_set('Asia/Riyadh');
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
?>
<div class="row">
    <div class="col-md-12">
        <button onclick="window.print()" type="button" class="btn btn-primary"><?php echo $language == 'english' ? 'Print' : 'طباعة'; ?></button>
    </div>
</div>
<div id="balance_report_print_area" class="mt-3">
    <table class="table table-bordered balance_report_table" style="width: 1000px!important;margin: 0 auto;color:black;border-collapse:collapse;;border-collapse:collapse;">
        <thead class="bg-primary text-white">
        <tr>
            <th><?php echo $language == 'english' ? 'Date' : 'التاريخ'; ?></th>
            <th><?php echo $language == 'english' ? 'Total Income(Cash)' : 'إجمالي الدخل (نقدي)'; ?></th>
            <th><?php echo $language == 'english' ? 'Total Income(Credit)' : 'إجمالي الدخل (آجل)'; ?></th>
            <th><?php echo $language == 'english' ? 'Total Expense' : 'إجمالي المصروف'; ?></th>
            <th><?php echo $language == 'english' ? 'Description(Expense)' : 'وصف المصروف'; ?></th>
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
            $cash_window_start = $business_date . ' 05:00:00';
            $cash_window_end = date('Y-m-d 05:00:00', strtotime($business_date . ' +1 day'));

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
    <p class="text-muted small mt-2">
        <?php
        if ($language == 'english') {
            echo 'Income (cash/credit) uses check-in rows by data_insert_time from 05:00 on the date until 05:00 the next day (Asia/Riyadh). Late fees use the calendar date. Expenses use the expense date.';
        } else {
            echo 'الدخل (نقدي/آجل) حسب وقت الإدخال من 05:00 لذلك اليوم حتى 05:00 اليوم التالي (توقيت الرياض). المتأخرات حسب تاريخ التقويم. المصروفات حسب تاريخ المصروف.';
        }
        ?>
    </p>
</div>
