<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#tab_1" aria-expanded="true">Edit Profile Settings</a>
        </li>
        <li>
            <a data-toggle="tab" href="#tab_2" aria-expanded="false">Change Your Password</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="tab_1" class="tab-pane active">
            <form name="profile_form" action="<?= base_url('admin/home/my_profile') ?>" method="post" enctype="multipart/form-data" id="profile_form" class="form-horizontal">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label require">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" disabled="" readonly="" class="form-control" value="<?= $profile[0]->username ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label require" for="name">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" id="name" required="" label-name="name" value="<?= $profile[0]->name ?>" placeholder="enter your name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label require" for="email">Email Address</label>
                                <div class="col-sm-8">
                                    <input type="email" value="<?= $profile[0]->email ?>" placeholder="enter your email" name="email" id="email" class="form-control" required="" label-name="email" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="mobile">Mobile</label>
                                <div class="col-sm-8">
                                    <input type="text" name="mobile" value="<?= $profile[0]->mobile ?>" placeholder="enter your mobile number" id="mobile" class="form-control onlyNumeric" maxlength="10" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="role">Designation </label>
                                <div class="col-sm-8">
                                    <input type="text" name="designation" value="<?= $profile[0]->designation ?>" placeholder="enter your designation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">				
                                <label class="col-sm-4 control-label require">Profile Image</label>
                                <div class="col-sm-8">
                                    <?= form_upload('photo', NULL, ['class' => 'view_photo mt10', 'accept' => 'image/.jpe,.jpg,.jpeg,.png']) ?>
                                    <input type="hidden" name="old_photo" value="<?= $profile[0]->img ?>">
                                    <?php
                                    $uimg = ADMIN_PHOTO_PATH . $profile[0]->img;
                                    if (!file_exists($uimg)) {
                                        $uimg = 'public/images/profile-pic.jpg';
                                    }
                                    ?>
                                    <div class="show_images">
                                        <img width="180" src="<?= base_url($uimg) ?>" class="img-responsive load_img"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-2">
                        <button class="btn btn-default btn-sm btn-flat" type="reset">Cancel</button>
                    </div>
                    <div class="col-sm-2 col-sm-offset-6 text-right">
                        <button name="update_profile" value="1" class="btn btn-success btn-sm btn-flat" type="submit">Update profile</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="tab_2" class="tab-pane">
            <form name="profile_passwordform" action="<?= base_url('admin/home/my_profile') ?>" method="post" id="profile_passwordform" class="form-horizontal" autocomplete="off">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label require">Old Password</label>
                        <div class="col-sm-4">
                            <input placeholder="Old Password" type="password" autocomplete="off" name="old_password" label-name="Old Password" required="" class="form-control" value="" maxlength="30">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-7">
                            <hr/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label require">New Password</label>
                        <div class="col-sm-4">
                            <input placeholder="New Password" minlength="5" type="password" id="new_password" name="new_password" label-name="Password" required="" class="form-control " maxlength="30"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label require">Confirm New Password</label>
                        <div class="col-sm-4">
                            <input type="password" placeholder="Confirm New Password" name="new_password_repeat" label-name="Password" required="" class="form-control " maxlength="30"> 
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-2">
                        <button class="btn btn-default btn-sm btn-flat" type="reset">Cancel</button>
                    </div>
                    <div class="col-sm-2 col-sm-offset-3 text-right">
                        <button name="update_password" value="1" class="btn btn-success change_pass btn-sm btn-flat" type="submit">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>