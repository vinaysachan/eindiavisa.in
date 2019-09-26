<div> 
    <form action="<?= base_url('ajax/sendenq') ?>" autocomplete="off" name="enqFrm" id="enqFrm" method="post" class="form-horizontal">
        <div class="form-group mt15 mb15">
            <label for="name" class="col-sm-1"></label>
            <div class="col-sm-6">
                <input type="text" name="name" class="form-control" placeholder="Name" required="" label-name='name' minlength="2" maxlength="100" value="">    
            </div>
        </div>
        <div class="form-group mb15">
            <label for="email" class="col-sm-1"></label>
            <div class="col-sm-6">
                <input type="email" name="email" class="form-control cntgrp" placeholder="Email" svalue="">    
            </div>
        </div>
        <div class="form-group mb15">
            <label for="mobile" class="col-sm-1"></label>
            <div class="col-sm-6">
                <input type="text" name="mobile" class="form-control cntgrp onlyNumeric" minlength="9" maxlength="15" placeholder="Mobile" value="">
            </div>
        </div>
        <div class="form-group mb15">
            <label for="visaType" class="col-sm-1"></label>
            <div class="col-sm-10">
                <textarea maxlength="5000" name="message" placeholder="Enter Message" class="form-control" rows="7"></textarea>
            </div>
        </div>
        <div class="form-group mb15">
            <label class="col-sm-1"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div> 
    </form>
</div>