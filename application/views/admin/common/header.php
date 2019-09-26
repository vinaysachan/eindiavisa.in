<header class="main-header">
    <a href="<?= base_url('admin') ?>" class="logo">
        <span class="logo-mini"><b><?= SITE_MIN_NAME ?></b></span>
        <span class="logo-lg"><?= SITE_NAME ?></span>
    </a>		
    <nav class="navbar navbar-static-top">		 
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url(ADMIN_PHOTO_PATH . $this->session->userdata(SESSION_ADMIN)['img']) ?>" class="user-image" alt="User Image"> 
                        <span class="hidden-xs"><?= $this->session->userdata(SESSION_ADMIN)['name'] ?></span>
                    </a>
                    <ul class="dropdown-menu">				   
                        <li class="user-header">
                            <img src="<?= base_url(ADMIN_PHOTO_PATH . $this->session->userdata(SESSION_ADMIN)['img']) ?>" class="img-circle" alt="User Image">
                            <p>
                                <?= $this->session->userdata(SESSION_ADMIN)['name'] ?> -  <?= $this->session->userdata(SESSION_ADMIN)['designation'] ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <?= '<div class="pull-left">' . anchor(base_url('admin/home/my_profile'), 'Profile', ['class' => 'btn btn-default btn-flat']) . '</div>' ?>
                            <div class="pull-right">
                                <a href="<?= base_url('admin/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>