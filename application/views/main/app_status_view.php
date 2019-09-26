<div class="p10">
    <form name="searchAppstsFrm" id="searchAppstsFrm" method="post" class="form-horizontal" action="<?= base_url('app_status') ?>" >
        <div class="form-group row">
            <label for="visaType" class="col-sm-4 require">Temporary Application ID</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="appID" required="" label-name="Temporary Application ID"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="v_code" class="col-sm-4 col-form-label">Verification Code</label>
            <div class="col-sm-4">
                <span class="captcha"></span>
                <a href="javascript:void(0)" class="captcha_new"><i class="fa fa-refresh mr10"></i>Change text.</a><br/><br/>
                <input required="" name="v_code" id="v_code" minlength="4" type="text" maxlength="4" class="form-control" placeholder="Please enter Verification Code" label-name="Please enter Verification Code"><br/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="submit" class="btn btn-block btn-primary" name="search" value="Continue">Continue</button>
            </div>
        </div>
    </form>
</div>