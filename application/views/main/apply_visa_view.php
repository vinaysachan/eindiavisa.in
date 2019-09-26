<div class="p10">
    <form name="applyVisaFrm" id="applyVisaFrm" method="post" class="form-horizontal" data-action="<?= base_url('apply_visa_post') ?>" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10" style="background-color: antiquewhite; padding-top: 10px; padding-bottom: 10px; margin-bottom: 5px;">
                    <div class="form-group row">
                        <label for="app_type" class="col-sm-6 require">Application Type </label>
                        <div class="col-sm-4">
                            <select name="app_type" id="app_type" required="" label-name="Application Type" class="form-control">
                                <option value="">Select</option>
                                <?php if (!empty($application_type)) : foreach ($application_type as $a) : ?>
                                        <option value="<?= $a->id ?>"><?= $a->name ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                            <br/>
                            <div class="selected_app_type"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="fname" class="col-sm-6 require">First Name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="fname" required="" label-name="First Name" placeholder="First Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="mname" class="col-sm-6">Middle Name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="mname" placeholder="Middle Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="lname" class="col-sm-6 require">Last Name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="lname" required="Last Name" label-name="Last Name" placeholder="Last Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="passportType" class="col-sm-6 require">Passport Type</label>
            <div class="col-sm-3">
                <select name="passportType" required="" label-name="Passport Type" name="passportno" class="form-control" id="passportType">
                    <option value="Ordinary Passport" title="Ordinary Passport">Ordinary Passport</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nationality" class="col-sm-6 require">Nationality</label>
            <div class="col-sm-3">
                <select name="nationality" required="" label-name="Nationality" class="form-control" id="nationality">
                    <option value="">Select Nationality...</option>
                    <?php foreach ($getCounrty as $counrty) : ?>
                        <option value="<?= $counrty->id; ?>" title="<?= $counrty->name; ?>"> <?= $counrty->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="portofarrival" class="col-sm-6 require">Port Of Arrival</label>
            <div class="col-sm-3">
                <select name="portofarrival" required="" label-name="Port Of Arrival" class="form-control" id="portofarrival">
                    <option value="" selected="selected">Select ...</option>
                    <?php foreach ($ports as $p) : ?>
                        <option value="<?= $p->id; ?>" title="<?= $p->name; ?>"> <?= $p->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="passportno" class="col-sm-6 require">Passport No</label>
            <div class="col-sm-3">
                <input type="text" name="passportno" required="" label-name="Passport No" class="form-control" id="passportno" placeholder="Passport No">
            </div>
        </div>
        <div class="form-group row">
            <label for="visa_type" class="col-sm-6 require">Visa Type</label>
            <div class="col-sm-3">
                <select name="visa_type" required="" class="form-control" id="visa_type">
                    <option value="">Please Select Application Type First</option>
                </select>
            </div>
        </div>
        <script type="text/javascript">
            var visa_types = <?= json_encode($visa_types); ?> ;
        </script>
        <div class="form-group row">
            <label for="dob" class="col-sm-6 require">Date of Birth</label>
            <div class="col-sm-2">
                <input type="text" required="" label-name="Date of Birth" data-max_date="<?= date('Y,m,d', strtotime("-0 year")) ?>" class="form-control date_picker" name="dob" id="dob" placeholder="Date of Birth" >
            </div>
            <div class="col-sm-2 fs11 text-left">(DD/MM/YYYY)</div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-6 require">Email</label>
            <div class="col-sm-3">
                <input type="email" class="form-control" required="" label-name="Email" id="email" name="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="re_email" class="col-sm-6 require">Re-enter Email ID </label>
            <div class="col-sm-3">
                <input name="re_email" type="text" required="" label-name="Email" class="form-control" placeholder="Re-Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-6 require">Telephone Number</label>
            <div class="col-sm-3">
                <input name="phone" type="text" required="" label-name="Telephone Number" class="form-control" placeholder="Telephone Number">
            </div>
        </div>
        <div class="form-group row">
            <label for="dob" class="col-sm-6 require">Expected Date of Arrival</label>
            <div class="col-sm-2">
                <input type="text" label-name="Expected Date of Arrival" data-min_date="<?= date('Y,m,d', strtotime("+1 day")) ?>"  class="form-control date_picker" name="date_of_arrival" id="date_of_arrival" placeholder="Expected Date of Arrival" >
            </div>
            <div class="col-sm-2 fs11 text-left">(DD/MM/YYYY)</div>
        </div>
        <div class="form-group row">
            <label for="v_code" class="col-sm-6 col-form-label">Access Code</label>
            <div class="col-sm-3">
                <span class="captcha"></span><br/>
                <input required="" name="v_code" id="v_code" minlength="4" type="text" maxlength="4" class="form-control" label-name="Please enter Verification Code" placeholder="Please enter Verification Code">
                <p class="fs12">Can't read the image? click <a href="javascript:void(0)" class="captcha_new"> here </a> to refresh.</p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-danger" name="step1" value="Continue">Continue</button>
            </div>
        </div>
    </form>
</div>


