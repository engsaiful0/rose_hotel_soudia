<div class="card">
    <div class="card-header bg-info">
        <h3 style="text-align: center">Due Payment</h3>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php } ?>
        <p><strong>Customer:</strong> <?php echo htmlspecialchars($checkin->guest_name, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Outstanding due:</strong> <?php echo number_format((float) $outstanding_due, 2); ?></p>
        <form method="post" action="<?php echo base_url(); ?>due-payment-save">
            <input type="hidden" name="checkin_details_id" value="<?php echo (int) $checkin_details->checkin_details_id; ?>">
            <div class="form-group">
                <label for="due_payment_amount">Payment amount</label>
                <input type="number" min="0.01" max="<?php echo htmlspecialchars((string) $outstanding_due, ENT_QUOTES, 'UTF-8'); ?>" value="<?php echo htmlspecialchars((string) $outstanding_due, ENT_QUOTES, 'UTF-8'); ?>" step="0.01" required class="form-control" id="due_payment_amount" name="amount">
            </div>
            <div class="form-group">
                <label for="due_payment_method">Payment method</label>
                <select class="form-control" id="due_payment_method" name="cash_or_credit">
                    <option value="cash">Cash</option>
                    <option value="credit">Credit</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Due Payment</button>
        </form>
    </div>
</div>