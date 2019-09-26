<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/blog') ?>">
            <i class="fa fa-arrow-left mr10" aria-hidden="true"></i> View All Blogs
        </a>
    </div>
</div>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#tab_1" aria-expanded="true">Blog Details</a>
        </li>
        <li>
            <a data-toggle="tab" href="#tab_2" aria-expanded="false">Blog's Content</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="tab_1" class="tab-pane active">
            <form name="blog_form" action="<?= base_url('admin/setting/blog_ae') ?>" method="post" enctype="multipart/form-data" id="blog_form" class="form-horizontal">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label require" for="blog_name">Blog Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" maxlength="300" name="blog_name" id="blog_name" label-name="Blog name" value="<?= (!empty($blog_data[0]->blog_name)) ? $blog_data[0]->blog_name : NULL ?>" required="" placeholder="Enter Blog Name" />
                                    <input type="hidden" class="" name="blog_id" id="blog_id" value="<?= (!empty($blog_data[0]->id)) ? $blog_data[0]->id : NULL ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label require" for="slug">Blog Url</label>
                                <div class="col-sm-4">
                                    <?= base_url('blog') ?>/
                                    <input type="text" class="form-inline" maxlength="300" name="slug" id="slug" label-name="Blog Url" value="<?= (!empty($blog_data[0]->slug)) ? $blog_data[0]->slug : NULL ?>" required="" placeholder="Blog Url" />

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label require" for="">Blog Heading</label>
                                <div class="col-sm-8">
                                    <textarea name="heading" id="heading" maxlength="300" rows="2" class="form-control" label-name="Blog Heading" required><?= (!empty($blog_data[0]->heading)) ? $blog_data[0]->heading : NULL ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label require">Meta Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description" id="description" rows="7" class="form-control" label-name="Meta Description" required><?= (!empty($blog_data[0]->description)) ? $blog_data[0]->description : NULL ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label require">Meta Title</label>
                                <div class="col-sm-8">
                                    <textarea name="title" id="title" maxlength="300" rows="3" class="form-control" label-name="Meta Title" required><?= (!empty($blog_data[0]->title)) ? $blog_data[0]->title : NULL ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label require">Meta Keywords</label>
                                <div class="col-sm-8">
                                    <textarea name="keywords" id="keywords" rows="6" class="form-control" label-name="Meta Keywords" required><?= (!empty($blog_data[0]->keywords)) ? $blog_data[0]->keywords : NULL ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">				
                                <label class="col-sm-2 control-label require">Blog Main Image</label>
                                <div class="col-sm-5">
                                    <?= form_upload('img', NULL, (empty($blog_data[0]->img)) ? ['class' => 'view_photo mt10', 'accept' => 'image/.jpe,.jpg,.jpeg,.png', 'label-name' => 'Blog Image'] : ['class' => 'view_photo mt10', 'accept' => 'image/.jpe,.jpg,.jpeg,.png']) ?>
                                    <?php if (!empty($blog_data[0]->img)) : ?>
                                        <input type="hidden" name="old_img" value="<?= $blog_data[0]->img ?>" >
                                        <div class="show_images">
                                            <img src="<?= $blog_data[0]->img ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label require">Blog Status</label>
                                <?php $sts = (!empty($blog_data[0]->is_active)) ? $blog_data[0]->is_active : ''; ?>
                                <div class="col-sm-4">
                                    <div class="form-group ml0">
                                        <label for="status_y" class="radio-inline">
                                            <input <?= ($sts == STATUS_ACTIVE) ? 'checked=""' : '' ?> type="radio" value="<?= STATUS_ACTIVE ?>" name="is_active" id="status_y" > Active
                                        </label>
                                        <label for="status_n" class="radio-inline">
                                            <input <?= ($sts == STATUS_IN_ACTIVE) ? 'checked=""' : '' ?> type="radio" value="<?= STATUS_IN_ACTIVE ?>" name="is_active" id="status_n"> In-active 
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-2">
                        <button class="btn btn-default btn-sm btn-flat" type="reset">Cancel</button>
                    </div>
                    <div class="col-sm-2 col-sm-offset-8 text-right">
                        <button name="save_blog" value="<?= (!empty($blog_data[0])) ? 'update' : 'add' ?>" class="btn bg-blue change_pass btn-sm btn-flat" type="submit">Save Blog Detail</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="tab_2" class="tab-pane">
            <?php if (empty($blog_data)) : ?>
                <div class="pad margin no-print">
                    <div class="callout callout-warning" style="margin-bottom: 0!important;">
                        <h4><i class="fa fa-info"></i> Note:</h4>To add Blog's Content please add Blog detail first.
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <?php foreach ($blog_content_data as $bcd)  : ?>
                    <div style="">
                        <div class="col-sm-9" style="border: solid 1px #ccc ;">
                            <?php if($bcd->type == 'image') : ?>
                            <img src="<?=$bcd->content?>" height=200>
                            <?php elseif($bcd->type == 'content') : 
                                echo html_entity_decode($bcd->content);
                            endif; ?>
                        </div>
                        <div class="col-sm-3 text-right">
                            <div class="btn-group">
                                <button type="button" class="btn bg-blue btn-sm btn-flat update_bcd" data-content_type="<?=$bcd->type?>" data-bcid="<?=$bcd->id?>" data-content="<?=$bcd->content?>">
                                    <i class="fa fa-pencil mr15"></i> Update
                                </button>
                                <button type="button" class="btn bg-red btn-sm btn-flat delete_bcd" data-bcid="<?=$bcd->id?>">
                                    <i class="fa fa-trash mr15"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="row text-center mt30">
                    <button type="button" class="btn bg-aqua change_pass btn-sm btn-flat pl30 pr30 mr45" id="add_img">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>Add Image
                    </button>
                    <button type="button" class="btn bg-aqua change_pass btn-sm btn-flat pl30 pr30 ml45" id="add_content">
                        <i class="fa fa-file-word-o" aria-hidden="true"></i> Add Content
                    </button>
                </div>
            <?php endif; ?>
            <!-- Blog Content Box -->
            <div class="blog_content_ae_box" id="blogPageContent" style="display:none; border:10px #ccc solid; border-radius:20px; margin-top: 10px;padding:10px;">
                <h3 id="blogContentLabel" class="text-center" style="background-color: #EDEDED;padding: 10px 0px;">Blog</h3>
                <form name="blog_content_form" class="mt15" action="<?= base_url('admin/setting/blog_ae') ?>" method="post" enctype="multipart/form-data" id="blog_content_form">
                    <input type="hidden" class="" name="blog_id" id="blog_id" value="<?= (!empty($blog_data[0]->id)) ? $blog_data[0]->id : NULL ?>">
                    <div class="boxBody text-center"></div>
                    <div class="boxFooter text-right">
                        <button type="button" class="btn btn-secondary btn-flat btnContentBoxClose">Close</button>
                        <button type="submit" name="save_blog_content" value="1" class="btn btn-primary btn-flat">Submit Blog Content</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>