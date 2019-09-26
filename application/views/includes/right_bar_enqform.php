<div class="right-box"> 
    <h3>ENQUIRY FORM</h3>
    <div class="right-box-content"> 
        <form action="<?= base_url('ajax/sendenq') ?>" autocomplete="off" name="enqFrm" id="enqFrm" method="post" class="">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name" required="" label-name='name' minlength="2" maxlength="100" value="">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control cntgrp" placeholder="Email" svalue="">
            </div>
            <div class="form-group">
                <input type="text" name="mobile" class="form-control cntgrp onlyNumeric" minlength="9" maxlength="15" placeholder="Mobile" value="">
            </div>
            <div class="form-group">
                <textarea maxlength="1000" name="message" placeholder="Enter Message" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div> 
</div>