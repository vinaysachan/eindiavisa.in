<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta name="author" content="Vinay Sachan" /> 
        <meta name="robots" content="noindex, nofollow" />
        <title><?= $title ?></title> 
        <?= /* Page CSS */ (!empty($css)) ? $this->util->cssList($css) : NULL ?>
    </head>
    <body>
        <div class="login_box">
            <form autocomplete="off" name="adminLogin" id="adminLogin" action="<?= base_url('admin/login') ?>" method="post" class="form-horizontal">
                <h2 class="form-signin-heading"><?= $heading ?></h2>
                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label">Username :</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user-secret"></i></span>
                            <input name="username" required="" label-name="username" type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                    </div> 
                </div> 
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Password :</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
                            <input type="password" label-name="password" required="" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                    </div> 
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-4  col-sm-8">
                        <button type="submit" name="submit" value="login" class="btn  btn-block">SIGN IN</button>
                    </div>
                </div>
            </form>
        </div>
        <?= (!empty($js)) ? $this->util->jsList($js) : NULL ?>
    </body>
</html>