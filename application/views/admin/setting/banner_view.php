<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/banner_ae') ?>">
            <i class="fa fa-plus mr10" aria-hidden="true"></i> Add new Banner
        </a>
    </div>
</div>
<div class="box-body table-responsive no-padding">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10%">#</th>
                <th style="width: 50%">Banner</th>
                <th style="width: 15%">Order</th>
                <th style="width: 15%">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $s = 1;
            if (!empty($banners)) : foreach ($banners as $b) :
                    ?>
                    <tr class="<?= ($b->status == STATUS_ACTIVE) ? '' : 'warning' ?>">    
                        <th><?= $s ?></th>
                        <td class="text-center">
                            <img width="200" style="max-height: 200px;" src="<?= $b->img ?>">
                            <div class="text-left">
                                <strong>Title : </strong><?= $b->title ?>
                            </div>
                        </td>
                        <td><?= $b->order ?></td>
                        <td><?= ($b->status == 1) ? 'Active' : 'In-Active' ?></td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="<?= base_url('admin/setting/banner_ae/' . $b->id) ?>" class="btn bg-blue btn-sm btn-flat"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/setting/del_banner/' . $b->id) ?>" class="btn bg-red btn-sm btn-flat confirm_a" data-title="Delete Banner?"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>

                    <?php
                    $s++;
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="4">No Banners Added</td>
                </tr>
            <?php endif; ?> 
        </tbody>
    </table>
</div>