<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/page') ?>">
            <i class="fa fa-arrow-left mr10" aria-hidden="true"></i> View All Pages
        </a>
    </div>
</div>
<form name="pageForm" action="" method="post" id="pageForm" class="form-horizontal">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label require">Page Name</label>
                    <div class="col-sm-8">
                        <?php
                        if (empty($pid)) {
                            $availabe_page = $all_pages;
                            if ((!empty($all_saved_page)) && (!empty($all_saved_page[0]->all_slugs))) {
                                $saved_slug = explode(',', $all_saved_page[0]->all_slugs);
                                $saved_slug = array_combine($saved_slug, $saved_slug);
                                $availabe_page = array_diff_key($all_pages, $saved_slug);
                            }
                            echo form_dropdown('slug', array_merge(['' => 'Select Page Name'], $availabe_page), NULL, ['class' => 'form-control', 'required' => "", 'label-name' => "Page Name", 'placeholder' => "Enter Page Name"]);
                        } else {
                            echo '<span class="lead p0">' . $this->setting_model->page_name_by_slug($page_data[0]->slug) . '</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group mt5">
                    <label class="col-sm-4 control-label require">Page Heading</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" maxlength="300" name="heading"  label-name="Page Heading" value="<?= (!empty($page_data[0]->heading)) ? $page_data[0]->heading : NULL ?>" required="" placeholder="Enter Page Heading" >
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label require">Meta Title</label>
                    <div class="col-sm-8">
                        <textarea name="title" id="title" maxlength="300" rows="3" class="form-control" label-name="Meta Title" required><?= (!empty($page_data[0]->title)) ? $page_data[0]->title : NULL ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label require">Meta Description</label>
            <div class="col-sm-4">
                <textarea name="description" id="description" rows="5" class="form-control" label-name="Meta Description" required><?= (!empty($page_data[0]->description)) ? $page_data[0]->description : NULL ?></textarea>
            </div>
            <label class="col-sm-2 control-label require">Meta Keywords</label>
            <div class="col-sm-4">
                <textarea name="keywords" id="keywords" rows="5" class="form-control" label-name="Meta Keywords" required><?= (!empty($page_data[0]->keywords)) ? $page_data[0]->keywords : NULL ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12 control-label require">Page Content : </label>
            <div class="col-sm-12 mt20">			
                <textarea name="page_content" required="" class="ck_editor" id="page_content" label-name="Page Content"><?= (!empty($page_data[0]->page_content)) ? $page_data[0]->page_content : '' ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <?php $location = (!empty($page_data[0])) ? json_decode($page_data[0]->menu_location) : ''; ?>
            <label class="col-sm-2 control-label require">Menu Location</label>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input required="" label-name="Menu Location" name="menu_location[]" id="menu_location_top" <?= (!empty($location)) ? (in_array('top', $location)) ? 'checked=""' : '' : '' ?>  value="top" type="checkbox"> Top Menu
                    </label>
                    <label class="ml20">
                        <input required="" label-name="Menu Location" name="menu_location[]" id="menu_location_buttom" <?= (!empty($location)) ? ( in_array('left', $location)) ? 'checked=""' : '' : '' ?> value="left" type="checkbox"> Left Part
                    </label>
                </div>
            </div>
            <label class="col-sm-2 control-label">Page Order</label>
            <div class="col-sm-4">
                <input type="text" class="form-control onlyNumeric" name="order" id="order" placeholder="" value="<?= (!empty($page_data[0]->order)) ? $page_data[0]->order : '' ?>" maxlength="3" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label require">Page Status</label>
            <?php $sts = (!empty($page_data[0]->is_active)) ? $page_data[0]->is_active : ''; ?>
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
    <div class="box-footer">
        <div class="col-sm-6">
            <button class="btn btn-default btn-sm btn-flat" type="reset">Reset</button>
        </div>
        <div class="col-sm-6 text-right">
            <button name="save_page" value="<?= (!empty($page_data[0])) ? 'update' : 'add' ?>" class="btn bg-blue change_pass btn-sm btn-flat" type="submit">Save Page Content</button>
        </div>
    </div>
</form>