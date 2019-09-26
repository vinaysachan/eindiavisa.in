<div class="box-header with-border">
    <h3 class="box-title">
        Manage List of ports
    </h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/arrival_port_ae') ?>"><i class="fa fa-file mr10" aria-hidden="true"></i> Add New Arrival of Port</a>
    </div>
</div>
<div class = "box-body">
    <table class="table pt10 table-bordered responsive-table">
        <thead>
            <tr>
                <th style="width:10%">#</th>
                <th style="width:80%">Name</th>
                <th style="width:20%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($ports)) :
                foreach ($ports as $p) :
                    ?>
                    <tr class="<?= ($p->status == STATUS_ACTIVE) ? '' : 'warning' ?>">
                        <td><?= $i ?></td>
                        <td><?= $p->name ?></td>
                        <td>
                            <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/arrival_port_ae/' . $p->id) ?>">
                                <i class="fa fa-edit mr10" aria-hidden="true"></i> Update Port
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