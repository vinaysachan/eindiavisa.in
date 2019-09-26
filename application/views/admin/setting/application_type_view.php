<div class="box-header with-border">
    <h3 class="box-title">
        Manage Application type and their price
    </h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/app_type_ae') ?>"><i class="fa fa-file mr10" aria-hidden="true"></i> Add Application Type </a>
    </div>
</div>
<div class = "box-body">
    <table class="table pt10 table-bordered responsive-table">
        <thead>
            <tr>
                <th style="width:10%">#</th>
                <th style="width:60%">Application Type</th>
                <th style="width:20%">Update</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($application_type)) : 
                foreach ($application_type as $a) :
                    ?>
                    <tr class="<?= ($a->status == STATUS_ACTIVE) ? '' : 'warning' ?>">
                        <td><?= $i ?></td>
                        <td><?= $a->name ?></td>
                        <td>                            
                            <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/app_type_ae/' . $a->id) ?>">
                                <i class="fa fa-edit mr10" aria-hidden="true"></i> Update Application Type
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