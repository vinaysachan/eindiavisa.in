<div class="box box-theme fs13 ml15">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th colspan="2">
                    Please note down the Temporary Application ID : <span class="text-uppercase fs17 ml15"><?= $this->session->userdata('application_id'); ?></span>
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    Your Information will be saved and you are redirected to next page for complete application. 
                </th>
            </tr>
            <tr>
                <th>Application Type : </th>
                <td><?= $apply_details[0]->app_type_name ?></td>
            </tr>
            <tr>
                <th>Visa Type : </th>
                <td><?= $apply_details[0]->visa_type_name ?> <?= empty($apply_details[0]->visa_validitiy) ? '' : ('('.$apply_details[0]->visa_validitiy . ' days)') ?></td>
            </tr>
            <tr>
                <th>Application Amount :</th>
                <td>
                    <?= $apply_details[0]->visa_currency_code == 'USD' ? '<i class="fa fa-dollar"></i>' : '<i class="fa fa-euro"></i>' ?>
                    <?= $apply_details[0]->visa_amount ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><p id="after_apply_visa_link" link="<?= base_url('visa_reg') ?>">You will be redirect to next page automatic. if not please click on <a href="<?= base_url('visa_reg') ?>">Proceed to next</a></p></td>
            </tr>
        </tbody>
    </table>

    <p></p>
    <p></p> 
    <p></p>
    <p> </p>
</div>
