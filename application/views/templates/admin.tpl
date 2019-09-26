<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content = "width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name = "viewport">
        <title><?= (!empty($title)) ? $title : SITE_NAME ?></title>
        <?= /* Page CSS */ (!empty($css)) ? $this->util->cssList($css) : NULL ?>
        <link rel="shortcut icon" href="<?= base_url('public/img/favicon.ico') ?>" type="image/x-icon">
        <link rel="icon" href="<?= base_url('public/img/favicon.ico') ?>" type="image/x-icon">
    </head>
    <body class="sidebar-mini skin-blue-light">
        <div class="wrapper">
            <?php $this->load->view('admin/common/header'); ?>
            <?php $this->load->view('admin/common/left'); ?>
            <div class="content-wrapper">		
                <section class="content-header">
                    <h1><?= (!empty($heading)) ? $heading : '' ?><small><?= (!empty($sub_heading)) ? " ($sub_heading)" : '' ?></small></h1>
                    <?= /* Page Breadcum */ (!empty($breadcrumb)) ? $this->util->createBreadcrumb($breadcrumb, 'breadcrumb', 'ul') : NULL ?>
                </section>
                <section class="content">
                    <div class="box">
                        <?= $this->util->show_flash_message() ?>
                        <?php (!empty($view)) ? $this->load->view($view) : $this->load->view('admin/' . $this->router->fetch_class() . '/' . $this->router->fetch_method() . '_view'); ?>
                    </div>
                </section>
            </div>
            <?php $this->load->view('admin/common/footer'); ?>
        </div>
        <div id="modal-placeholder"></div>
        <p id="overlay" class="text-center load-overlay"  >
            <i class="fa fa-spinner fa-pulse fa-5x"></i>
        </p>
        <script type="text/javascript"> base_url = '<?= base_url() ?>';</script>
        <?= /* Page Js */ (!empty($js)) ? $this->util->jsList($js) : NULL ?>
    </body>
</html>