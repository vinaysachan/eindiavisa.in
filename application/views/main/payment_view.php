<div class="p10">
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <td>Application ID</td>
                <td><?= $apply_details[0]->app_id; ?></td>
            </tr>
            <tr>
                <td>Application Type</td>
                <td><?= $apply_details[0]->app_type_name; ?></td>
            </tr>
            <tr>
                <td>Visa Type</td>
                <td><?= $apply_details[0]->visa_type_name ?> (<?= $apply_details[0]->visa_entry; ?> Entries)</td>
            </tr>
            <tr>
                <td>Duration</td>
                <td><?= $apply_details[0]->visa_validitiy ?> Days</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td><?= $apply_details[0]->visa_currency_code ?> <?= $apply_details[0]->visa_amount ?></td>
            </tr>
            <tr>
                <td>
                    <img src="<?= base_url('public/img/paypal.png') ?>" alt="PayPal - The safer, easier way to pay online" height="30">
                </td>
                <td>
                    <form class="form-horizontal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                        <!-- <input type="hidden" name="cmd" value="_cart"> -->
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="<?=PAY_PAL_ACCOUNT?>">
                        <input type="hidden" name="item_name" value="<?= $apply_details[0]->app_type_name; ?>">
                        <input type="hidden" name="item_number" value="<?= $this->session->userdata('application_id'); ?>">
                        <input type="hidden" name="amount" value="<?= $apply_details[0]->visa_amount; ?>">
                        <input type="hidden" name="currency_code" value="<?=$apply_details[0]->visa_currency_code?>">
                        <input type='hidden' name='cancel_return' value='<?= base_url('main/payment_faild') ?>'>
                        <input type='hidden' name='return' value='<?= base_url('main/payment_success') ?>'>
                        <!--<input type="image" name="submit" border="0" src="<?= base_url('public/img/paypal.png') ?>" alt="PayPal - The safer, easier way to pay online" width="24%" height="66"/>-->
                        <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                        <button name="submit" type="submit" class="btn btn-primary pl30 pr30">Pay With Paypal</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</div>
