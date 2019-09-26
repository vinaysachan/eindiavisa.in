<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/application_type') ?>">
            <i class="fa fa-arrow-left mr10" aria-hidden="true"></i> View All Application Type
        </a>
    </div>
</div>
<form name="applicatin_typeForm" id="applicatin_typeForm" action="" method="post" id="pageForm" class="form-horizontal">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group mt5">
                    <label class="col-sm-2 control-label require">Application Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" maxlength="300" name="name" label-name="Application Name" value="<?= (!empty($app_type[0]->name)) ? $app_type[0]->name : NULL ?>" required="" placeholder="Enter Application Name" >
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label require">Application type</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" maxlength="2" name="type"  label-name="Application type" value="<?= (!empty($app_type[0]->type)) ? $app_type[0]->type : NULL ?>" required="" placeholder="Application type" >
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label require">Application Status</label>
            <?php $sts = (!empty($app_type[0]->status)) ? $app_type[0]->status : ''; ?>
            <div class="col-sm-4">
                <div class="form-group ml0">
                    <label for="status_y" class="radio-inline">
                        <input <?= ($sts == STATUS_ACTIVE) ? 'checked=""' : '' ?> type="radio" value="<?= STATUS_ACTIVE ?>" name="status" id="status_y" > Active
                    </label>
                    <label for="status_n" class="radio-inline">
                        <input <?= ($sts == STATUS_IN_ACTIVE) ? 'checked=""' : '' ?> type="radio" value="<?= STATUS_IN_ACTIVE ?>" name="status" id="status_n"> In-active 
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
            <button name="submit" value="<?= (!empty($app_type[0])) ? 'update' : 'add' ?>" class="btn bg-blue change_pass btn-sm btn-flat" type="submit">Save Application Type</button>
        </div>
    </div>
</form>