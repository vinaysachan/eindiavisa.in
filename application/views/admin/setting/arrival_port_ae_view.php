<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/arrival_port') ?>">
            <i class="fa fa-arrow-left mr10" aria-hidden="true"></i> View All Arrival Port
        </a>
    </div>
</div>
<form name="arrivalPortForm" id="arrivalPortForm" action="" method="post" id="pageForm" class="form-horizontal">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group mt5">
                    <label class="col-sm-2 control-label require">Port Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" maxlength="300" name="name" label-name="Port Name" value="<?= (!empty($port[0]->name)) ? $port[0]->name : NULL ?>" required="" placeholder="Enter Port Name" >
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label require">Application Status</label>
            <?php $sts = (!empty($port[0]->status)) ? $port[0]->status : ''; ?>
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
            <button name="submit" value="<?= (!empty($port[0])) ? 'update' : 'add' ?>" class="btn bg-blue change_pass btn-sm btn-flat" type="submit">Save Application Type</button>
        </div>
    </div>
</form>