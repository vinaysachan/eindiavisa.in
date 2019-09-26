<div class="box box-theme">
    <div>
        <h3>Please upload a scanned copy of your original passport on this page. Please do not upload your digital picture on this page which you uploaded on the last page. </h3>
    </div>
    <div>
        Please note down the Temporary Application ID : <span class="text-uppercase fs17 ml15"><?= $this->session->userdata('application_id'); ?></span>
    </div>
</div>
<div class="p10">
    <form name="passport_uploadFrm" id="passport_uploadFrm" method="post" class="form-horizontal" action="<?=  base_url('uploadPassport')?>" enctype="multipart/form-data"> 
        <p class="text-blue" style="color: #0066CC;font-size: 13px;text-align: center;">Upload A Scanned Copy Of Your Original Coloured Passport Or Take A Picture Of Your Passport and Uploaded.</p>
        <div class="form-group row">
            <label for="" class="col-sm-2 require">Passport Image</label>
            <div class="col-sm-5">
                <?php if (!empty($apply_details[0]->passport_img)) : ?>
                    <input type="hidden" name="old_passport" value="<?= $apply_details[0]->passport_img ?>">
                    <input type="file" accept="image/.jpe,.jpg,.jpeg,.png" class="form-control view_photo" id="passport" name="passport" >
                    <div class="show_images mt5">
                        <img style="max-width: 150px" src="<?= base_url(PASSPORT_IMG . $apply_details[0]->passport_img) ?>">
                    </div>
                <?php else : ?>
                    <input type="file" required="" data-label="passport" accept="image/.jpe,.jpg,.jpeg,.png" class="form-control view_photo" id="passport" name="passport" >
                <?php endif; ?>
            </div>
            <div class="col-sm-5">
                <h4>Sample Passport Image :- </h4>
                <img src="<?=  base_url('public/img/sample_passport.jpg')?>" width="300">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4"></div><div class="col-sm-3">
                <button type="submit" name="uploadpassport" class="btn btn-primary" value="Save and Continue">Save and Continue</button>
            </div>
        </div>
    </form>
    <div class="p10">
        <p>Kindly ensure that the document is as per specifications mentioned below.</p>
        <span class="red_heading text_bold" style="margin-left:24px">Document Specifications</span>
        <ol class="instructions_ul text_bold">
            <li>
                - Passport Upload- Photo page of Passport containing personal details like name,date of birth, nationality , expiry date etc. to be uploaded by the applicant. 
            </li> 
            <li> 
                - Photo page of Passport uploaded should be of the same passport whose details are provided in Passport Details section. 
            </li> 
            <li> 
                - The application is liable to be rejected if the uploaded document is not clear and as per specification. 
            </li>
        </ol>
    </div>
</div>