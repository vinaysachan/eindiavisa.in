<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/banner') ?>">
            <i class="fa fa-image mr10" aria-hidden="true"></i> View All Banners
        </a>
    </div>
</div>
<div class="box-body pt15">
    <form name="banner_aeFrm" id="banner_aeFrm" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="title">Banner Title</label>
            <div class="col-sm-7">
                <input placeholder="Banner Title" name="title" class="form-control" required="" label-name="Banner Title" value="<?= (!empty($banner[0]->title)) ? $banner[0]->title : '' ?>" type="text" maxlength="200"  >
            </div>
        </div>
        <div class="form-group">				
            <label class="col-sm-2 control-label require">Banner Image</label>
            <div class="col-sm-5">
                <?= form_upload('img', NULL, (empty($banner[0]->img)) ? ['class' => 'view_photo mt10', 'accept' => 'image/.jpe,.jpg,.jpeg,.png', 'required' => '', 'label-name' => 'Banner'] : ['class' => 'view_photo mt10', 'accept' => 'image/.jpe,.jpg,.jpeg,.png']) ?>
                <?php if (!empty($banner[0]->img)) : ?>
                    <input type="hidden" name="old_img" value="<?= $banner[0]->img ?>" >
                    <div class="show_images">
                        <img src="<?= $banner[0]->img ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Banner Order</label>
            <div class="col-sm-2">
                <input placeholder="Banner Order" name="order" class="form-control onlyNumeric" value="<?= (!empty($banner[0]->order)) ? $banner[0]->order : '' ?>" type="text" maxlength="3"  >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label require">Banner Status</label>
            <div class="col-sm-10">
                <div class="checkbox">
                    <label>
                        <input name="status" value="1" type="checkbox" <?= (!empty($banner[0]->status) && ($banner[0]->status == STATUS_ACTIVE)) ? 'checked=""' : NULL ?>> Active
                    </label>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-2">
                <button class="btn btn-default btn-sm btn-flat" type="reset">Cancel</button>
            </div>
            <div class="col-sm-2 col-sm-offset-5 text-right">
                <button name="submit" value="<?= (!empty($banner[0]->title)) ? 'update' : 'add' ?>" class="btn bg-green btn-sm btn-flat" type="submit">Submit Banner</button>
            </div>
        </div>
    </form>
</div>