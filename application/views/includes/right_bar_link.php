<div class="right-box"> 
    <h3>VISA INFORMATION</h3>
    <div class="right-box-content"> 
        <ul class="blog-popular-post">
            <?php
            foreach ($page_list as $pl) :
                if (($pl['slug'] != 'home') && (in_array('left', $pl['menu_location']))) :
                    ?>
                    <li class=""><a href="<?= base_url($pl['slug']) ?>"><?= $this->setting_model->page_name_by_slug($pl['slug']) ?></a></li>
                    <?php
                endif;
            endforeach;
            ?>
        </ul>
    </div>
</div>