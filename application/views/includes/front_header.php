<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container-fluid align-items-start">
        <div class="col-md-2">
            <a title="<?= SITE_NAME ?>" href="<?= base_url() ?>" class="navbar-brand js-scroll-trigger">
                <img style="display: block;" alt="<?= SITE_NAME ?>" class="site_img" src="<?= base_url('public/img/logo.png') ?>">
            </a>
        </div>
        <div class="col-md-10 text-right align-items-end">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path></svg>
            </button>
            <div class="col-12 fs12">
                <span><img src="<?= base_url('public/img/in.png') ?>" class="mr20" >IND <?= CONTACT_NO1 ?></span>
                <!-- <span><img src="<?= base_url('public/img/uk.png') ?>" class="mr20" >UK <?= CONTACT_NO_UK ?></span> -->
                <span class="ml25"><i class="fa fa-envelope fs20 mr10"></i><?= CONTACT_EMAIL1 ?></span>
            </div>

            <div class="collapse navbar-collapse text-right" id="navbarResponsive">
                <div class="container">
                    <ul class="navbar-nav ml-auto pull-right">
                        <li class="nav-item <?= ($class == 'main' && $method == 'index') ? 'active' : '' ?>">
                            <a class="nav-link js-scroll-trigger" title="<?= SITE_NAME ?>" href="<?= base_url() ?>">Home</a>
                        </li>
                        <?php foreach ($page_list as $pl) : if (($pl['slug'] != 'home') && (in_array('top', $pl['menu_location']))) : ?>
                                <li class="nav-item <?= (($class == 'main') && ($method == 'page') && (!empty($slug)) && ($slug == $pl['slug'])) ? 'active' : '' ?>">
                                    <a class="nav-link js-scroll-trigger" href="<?= base_url($pl['slug']) ?>"><?= $this->setting_model->page_name_by_slug($pl['slug']) ?></a></li>
                                <?php
                            endif;
                        endforeach;
                        ?>
                        <li class="nav-item <?= ($class == 'main' && $method == 'contact_us') ? 'active' : '' ?>"> 
                            <a class="nav-link js-scroll-trigger" title="Contact us" href="<?= base_url('contact_us') ?>">Contact Us</a>
                        </li>
                        <li class="nav-item <?= ($class == 'main' && $method == 'free_assessment') ? 'active' : '' ?>"> 
                            <a class="nav-link js-scroll-trigger" title="FREE ASSESSMENT" href="<?= base_url('free_assessment') ?>">Free Assessment</a>
                        </li>
                        <li class="nav-item <?= ($class == 'main' && in_array($method, ['blog','blog_detail'])) ? 'active' : '' ?>"> 
                            <a class="nav-link js-scroll-trigger" title="Blogs" href="<?= base_url('blog') ?>">Blogs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
