<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <?= ($status == STATUS_ACTIVE) ? anchor(base_url('admin/home/enquiry/' . STATUS_IN_ACTIVE), '<i class = "fa fa-envelope-o mr10"></i> View Open Enquiries', ['class' => 'btn bg-blue btn-flat btn-sm']) : anchor(base_url('admin/home/enquiry/' . STATUS_ACTIVE), '<i class = "fa fa-envelope-open-o mr10" aria-hidden = "true"></i> View Closed Enquiries', ['class' => 'btn bg-blue btn-flat btn-sm']) ?>
    </div>
</div>
<div class = "box-body">
    <?= $this->paginator->dispaly_page_record_ipp() ?> 
    <table class="table pt10 table-bordered responsive-table">
        <thead>
            <tr>
                <th style="width:3%">#</th>
                <th style="width:22%">Enquiry Detail</th>
                <th style="width:60%">Enquiry Message</th>
                <th style="width:15%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = $page + 1;
            if (!empty($enqs)) : foreach ($enqs as $e) :
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>
                            <div><strong>Name : </strong><?= $e->name ?></div>
                            <div><strong>Mobile : </strong><?= $e->mobile ?></div>
                            <div><strong>Email : </strong><?= $e->email ?></div>
                        </td>
                        <td><?= $e->message ?></td> 
                        <td class="text-right">
                            <div class="checkbox">
                                <label>
                                    <?php if ($status == STATUS_ACTIVE) : ?>
                                        <input data-enq_id="<?=$e->id?>" class="enq_sts" name="status" value="1" checked="" type="checkbox">   Mark this Enquiry as Open
                                    <?php else : ?>
                                        <input data-enq_id="<?=$e->id?>" class="enq_sts" name="status" value="1" type="checkbox">   Mark this Enquiry as close
                                    <?php endif; ?>
                                </label>
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