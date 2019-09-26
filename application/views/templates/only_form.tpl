<!DOCTYPE html>
<html lang="en">
    <head>
        <?php /* Meta Header */ $this->load->view('includes/meta_header'); ?>
        <?php /* Google Analytics */ $this->load->view('web_parts/analyticstracking'); ?>
    </head>
    <body class=" form_page">
        <?php /* Google Conversion Rate */ $this->load->view('web_parts/google_conversion.php'); ?>
        <?php /* Tawk Plugin */ $this->load->view('web_parts/tawk.to.php'); ?>
        <?php /* Top Menu */ $this->load->view('includes/front_header'); ?>
        <?php /* Top Haeder Part */ $this->load->view('includes/header'); ?>
        <div class="">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mx-auto bg-white page_content">
                            <?php if (empty($banners)) : ?>
                                <div class="banner_top">
                                    <img src="<?= (empty($form_banner)) ? base_url('public/img/mumbai.jpg') : $form_banner ?>">
                                </div>
                            <?php endif; ?>
                            <h1><?= (!empty($heading)) ? $heading : '' ?></h1>
                            <?= $this->util->show_flash_message() ?>
                            <?php (!empty($view)) ? $this->load->view($view) : $this->load->view($this->router->fetch_class() . '/' . $this->router->fetch_method() . '_view'); ?> 
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-1"> </div>
                                    <div class="col-sm-10">
                                        <h1><?= (!empty($heading)) ? $heading : '' ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript"> base_url = '<?= base_url() ?>';</script>
        <?php /* Footer */ $this->load->view('includes/footer_copyright'); ?>
        <?= /* Page JS */ (!empty($js)) ? $this->util->jsList($js) : '' ?>
    </body>
</html>