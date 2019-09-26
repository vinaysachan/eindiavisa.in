<div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools">
        <a class="btn bg-blue btn-flat btn-sm" href="<?= base_url('admin/setting/visa_type') ?>">
            <i class="fa fa-arrow-left mr10" aria-hidden="true"></i> View All Visa Type
        </a>
    </div>
</div>
<form name="visa_typeForm" id="visa_typeForm" action="" method="post" id="pageForm" class="form-horizontal">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group mt5">
                    <label for="application_type_id" class="col-sm-2 control-label require">Application Type</label>
                    <div class="col-sm-5">
                        <select required="" name="application_type_id" label-name="Application Type" class="form-control">
                            <option value="">Application Type</option>
                            <?php foreach ($application_types as $application_type) : ?>
                                <option <?= (!empty($visa_type[0])) ? (($visa_type[0]->application_type_id == $application_type->id) ? 'selected=""' : '') : '' ?>  value="<?= $application_type->id ?>"><?= $application_type->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group mt5">
                    <label for="name" class="col-sm-2 control-label require">Visa Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" maxlength="300" name="name" label-name="visa Name" value="<?= (!empty($visa_type[0]->name)) ? $visa_type[0]->name : NULL ?>" required="" placeholder="Enter visa name" >
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group mt5">
                    <label for="validitiy" class="col-sm-2 control-label">Validity</label>
                    <div class="col-sm-5">
                        <input type="number" min="1" class="form-control" name="validitiy" label-name="validitiy" value="<?= (!empty($visa_type[0]->validitiy)) ? $visa_type[0]->validitiy : NULL ?>" placeholder="Enter validitiy period" >
                    </div>
                    <div class="col-sm-5 text-danger">Please enter visa duration in days.(leave it blank if visa duration is not exist)</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group mt5">
                    <label for="entry" class="col-sm-2 control-label">Entry</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="entry" label-name="entry" value="<?= (!empty($visa_type[0]->entry)) ? $visa_type[0]->entry : NULL ?>" placeholder="Enter entry" >
                    </div>
                    <div class="col-sm-5 text-danger">Single / double / multiple. (leave it blank if visa duration is not exist)</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group mt5">
                    <label for="entry" class="col-sm-2 control-label require">Visa Amount</label>
                    <?php $currency_code = (!empty($visa_type[0]->currency_code)) ? $visa_type[0]->currency_code : 'USD'; ?>
                    <div class="col-sm-2">
                        <div class="form-group ml0">
                            <label for="USD" class="radio-inline">
                                <input type="radio" value="USD" <?= ($currency_code == 'USD') ? 'checked=""' : '' ?> name="currency_code" id="USD" > <i class="fa fa-dollar"></i> (US Dollar)
                            </label>
                            <label for="GBP" class="radio-inline">
                                <input type="radio" value="GBP" <?= ($currency_code == 'GBP') ? 'checked=""' : '' ?> name="currency_code" id="GBP" > <i class="fa fa-euro"></i> (Euro)
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="amount" label-name="amount" id="amount" placeholder="" value="<?= (!empty($visa_type[0]->amount)) ? $visa_type[0]->amount : NULL ?>" maxlength="10" >
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label require">Visa Status</label>
            <?php $sts = (!empty($visa_type[0]->status)) ? $visa_type[0]->status : ''; ?>
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
            <button name="submit" value="<?= (!empty($visa_type[0])) ? 'update' : 'add' ?>" class="btn bg-blue change_pass btn-sm btn-flat" type="submit">Save Application Type</button>
        </div>
    </div>
</form>