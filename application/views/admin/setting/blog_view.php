<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <button type="button" class="btn bg-green btn-flat btn-sm" blog_meta_url="<?=base_url('admin/setting/get_seo_data/blog')?>" id="btn_meta_update">Update Blog Meta Content</button>
        <?= anchor(base_url('admin/setting/blog_ae'), '<i class = "fa fa-envelope-o mr10"></i> Add New Blog', ['class' => 'btn bg-blue btn-flat btn-sm']) ?>
    </div>

</div>
<div class = "box-body">
    <?= $this->paginator->dispaly_page_record_ipp() ?> 
    <div class="table-responsive">
        <table class="table pt10 table-bordered responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width:30%">Blog Name</th>
                    <th style="width:30%">Blog Heading</th>
                    <th style="width:30%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i = $page + 1;
                if (!empty($blogs)) : foreach ($blogs as $b) :
                    ?>
                <tr class="<?= ($b->is_active == STATUS_ACTIVE) ? '' : 'warning' ?>">  
                    <td><?= $i ?></td>
                    <td><?= $b->blog_name ?></td>
                    <td><?= $b->heading ?></td> 
                    <td class="text-right">
                        <div class="btn-group">
                        <a href="<?= base_url('admin/setting/blog_ae/' . $b->id) ?>" class="btn bg-blue btn-sm btn-flat"><i class="fa fa-pencil mr10"></i> Edit Blog</a>
                        <a href="<?= base_url('admin/setting/trash_blog/' . $b->id) ?>" class="btn bg-red btn-sm btn-flat confirm_a" data-title="Delete Blog?"><i class="fa fa-trash mr10"></i> Delete Blog</a>
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
</div>
<div class="box-footer clearfix">
    <?= $this->paginator->display_jump_menu_pages() ?>
</div>
<!-- Blog Meta Content Modal -->
<div class="modal fade" id="blogMeta" tabindex="-1" role="dialog" aria-labelledby="blogMetaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blogMetaLabel">Blog Page Meta content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="blog_meta_form" action="<?= base_url('admin/setting/save_seo') ?>" method="post" id="blog_meta_form">
                <input type="hidden" class="" name="slug" id="slug" value="blog">
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label require" for="">Page Heading</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="heading" value="" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mt10">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label require">Meta Title</label>
                                    <div class="col-sm-8">
                                        <textarea name="title" id="title" maxlength="300" rows="3" class="form-control" label-name="Meta Title" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mt10">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label require">Meta Description</label>
                                    <div class="col-sm-8">
                                        <textarea name="description" rows="3" class="form-control" label-name="Meta Description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mt10">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label require">Meta Keywords</label>
                                    <div class="col-sm-8">
                                        <textarea name="keywords" id="keywords" rows="6" class="form-control" label-name="Meta Keywords" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" name="save_blog_meta" value="1" class="btn btn-primary btn-flat">Submit Blog Meta Content</button>
                </div>
            </form>
        </div>
    </div>
</div>