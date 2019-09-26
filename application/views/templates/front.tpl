<!DOCTYPE html>
<html lang="en">
    <head>
        <?php /* Meta Header */ $this->load->view('includes/meta_header'); ?>
        <?php /* Google Analytics */ $this->load->view('web_parts/analyticstracking'); ?>
    </head>
    <body class="">
        <?php /* Google Conversion Rate */ $this->load->view('web_parts/google_conversion.php'); ?>
        <?php /* Tawk Plugin */ $this->load->view('web_parts/tawk.to.php'); ?>
        <?php /* Top Menu */ $this->load->view('includes/front_header'); ?>
        <?php /* Top Haeder Part */ $this->load->view('includes/header'); ?>
        <div class="">
            <section>
                <div class="page_container">
                    <div class="row">
                        <?php if (!empty($right_bar)) :
                        $this->load->view('includes/right_bar');
                        endif; ?>
                        <div class="<?= (!empty($right_bar)) ? 'col-md-9' : 'col-md-12' ?> mx-auto bg-white page_content">
                            <?php if (empty($banners) && empty($banner_not_show)) : ?>
                            <div class="banner_top">
                                <img src="<?= base_url('public/img/mumbai.jpg') ?>">
                            </div>
                            <?php endif; ?>
                            <h1><?= (!empty($heading)) ? $heading : '' ?></h1>
                            <?= $this->util->show_flash_message() ?>
                            <?php (!empty($view)) ? $this->load->view($view) : $this->load->view($this->router->fetch_class() . '/' . $this->router->fetch_method() . '_view'); ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript"> base_url = '<?= base_url() ?>';</script>
        <?php /* Footer */ $this->load->view('includes/front_footer_bottom'); ?>
        <?php /* Footer */ $this->load->view('includes/footer_copyright'); ?>
        <?= /* Page JS */ (!empty($js)) ? $this->util->jsList($js) : '' ?>
    </body>
</html>
