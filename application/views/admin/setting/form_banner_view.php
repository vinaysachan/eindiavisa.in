<div class="box-body pt15">
    <form name="fbanner_aeFrm" id="fbanner_aeFrm" method="post" action="<?= base_url('admin/setting/form_banner') ?>" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">				
            <label class="col-sm-2 control-label require">Banner Image</label>
            <div class="col-sm-5">
                <?= form_upload('img', NULL, ['id' => 'img', 'class' => 'view_photo mt10', 'accept' => 'image/.jpe,.jpg,.jpeg,.png', 'required' => '', 'label-name' => 'Banner']) ?>
            </div>
        </div>
        <div class="mt30">
            <h4>Banner Specifications :- </h4>
            <ul>
                <li><strong>Format</strong> - JPEG/PNG</li>
                <li><strong>Size - </strong> Maximum 1 MB</li>
                <li>The minimum dimensions are 1100 pixels (width) x 125 pixels (height).</li>
            </ul>
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
    <hr/><hr/>
    <h4>Current Banner :-</h4>
    <hr/><hr/>
    <img src="<?=$old_img?>" height="125" width="100%" />
</div>