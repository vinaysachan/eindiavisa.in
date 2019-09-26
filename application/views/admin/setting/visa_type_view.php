<div class="box-header with-border">
    <h3 class="box-title">
        Manage Visa type and their price
    </h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/visa_type_ae') ?>"><i class="fa fa-file mr10" aria-hidden="true"></i> Add Visa Type </a>
    </div>
</div>
<div class="box-body">
    <table class="table pt10 table-bordered responsive-table">
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th style="width:30%">Application Type</th>
                <th style="width:28%">Visa Type (Duration)</th>
                <th style="width:22%">Entry</th>
                <th style="width:15%">Visa Price</th>
                <th style="width:20%">Update</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($visa_types)) :
                foreach ($visa_types as $visa_type) :
                    ?>
                    <tr class="<?= ($visa_type->status == STATUS_ACTIVE) ? 'info' : 'warning' ?>">
                        <td><?= $i ?></td>
                        <td><?= $visa_type->application_type_name ?></td>
                        <td><?= $visa_type->name ?> <?= empty($visa_type->validitiy) ? '' : ('('.$visa_type->validitiy . ' days)') ?></td>
                        <td><?= empty($visa_type->entry) ? '' : ($visa_type->entry.' Entry') ?></td>
                        <td>
                            <?= $visa_type->currency_code == 'USD' ? '<i class="fa fa-dollar"></i>' : '<i class="fa fa-euro"></i>' ?>
                            <?= $visa_type->amount ?>
                        </td>
                        <td>                            
                            <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/visa_type_ae/' . $visa_type->id) ?>">
                                <i class="fa fa-edit mr10" aria-hidden="true"></i> Update Visa Type
                            </a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
</div>