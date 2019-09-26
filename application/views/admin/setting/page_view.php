<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/page_ae') ?>">
            <i class="fa fa-plus mr10" aria-hidden="true"></i> Add New Page
        </a>
    </div>
</div>
<div class = "box-body">
    <?= $this->paginator->dispaly_page_record_ipp() ?> 
    <table class="table pt10 table-bordered responsive-table">
        <thead>
            <tr>
                <th style="width:10%">#</th>
                <th style="width:30%">Page Name</th>
                <th style="width:30%">Page Heading</th>
                <th style="width:30%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = $page + 1;
            if (!empty($pages)) : foreach ($pages as $p) :
                    ?>
                    <tr class="<?= ($p->is_active == STATUS_ACTIVE) ? '' : 'warning' ?>">  
                        <td><?= $i ?></td>
                        <td><?= $this->setting_model->page_name_by_slug($p->slug) ?></td>
                        <td><?= $p->heading ?></td> 
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="<?= base_url('admin/setting/page_ae/' . $p->id) ?>" class="btn bg-blue btn-sm btn-flat"><i class="fa fa-pencil mr10"></i> Edit</a>
                                <a href="<?= base_url('admin/setting/trash_page/' . $p->id) ?>" class="btn bg-red btn-sm btn-flat confirm_a" data-title="Delete Page?"><i class="fa fa-trash mr10"></i> Delete</a>
                            </div>
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
<div class="box-footer clearfix">
    <?= $this->paginator->display_jump_menu_pages() ?>
</div>