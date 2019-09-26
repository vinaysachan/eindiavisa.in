<?php if (!empty($banners)) : ?>
    <header class="bg-light text-white banner">
        <div class="bd-example" data-example-id="">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php /* foreach ($banners as $k => $b) : ?>
                      <li data-target="#carouselExampleIndicators" data-slide-to="<?=$k?>" class="<?=($k==0)?'active':''?>"></li>
                      <?php endforeach; */ ?>
                </ol>
                <div class="carousel-inner">
                    <?php foreach ($banners as $k => $b) : ?>
                        <div class="carousel-item <?= ($k == 0) ? 'active' : '' ?>">
                            <img class="d-block w-100 banner" src="<?= $b->img ?>" >
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </header>
<?php endif; ?>
<?php if (!empty($show_application_link)) : ?>
    <div id="application_btn" class="container text-center">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box bg-orange">
                    <a href="<?= base_url('apply_visa') ?>">
                        <div>Click Here Apply <br/>for Visa</div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box bg-green">
                    <a href="<?= base_url('serach_app') ?>">
                        <div>Complete Partially<br/>Filled Form</div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box bg-red">
                    <a href="<?= base_url('serach_app') ?>">
                        <div>Make Payment For<br/>Completed Form</div>
                    </a>
                </div>
            </div>
            <!--            <div class="col-6 col-md-3">
                            <div class="info-box bg-blue">
                                <span class="step">Step 4</span>
                                <a href="<?= base_url('app_status') ?>">
                                    <div class="mt5">Check Applications</div>
                                    <h4 class="fs18 m0 p0 mt5">Status</h4>
                                </a>
                            </div>
                        </div>-->
        </div>
    </div>
<?php endif; ?>