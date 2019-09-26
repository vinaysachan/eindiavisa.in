<div class="p10">
    <h4>Payment Failed</h4>
    <h5>Your Application is successfully submitted. Please keep your Application Id <?= $this->session->userdata('application_id'); ?> for further Communication.</h5> 
</div>
<div class="text-right mr10 mt10">
    <a class="btn btn-primary" style="width: 200px" href="<?= base_url('payment') ?>"><i class="fa fa-refresh mr10"></i> Try Again</a>
</div>