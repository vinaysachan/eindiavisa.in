<?php if (!empty($blogs)) : foreach ($blogs as $blog) : ?>
         <div style="border-bottom: 1px solid #e5e5e5; padding: 19px 0px;">
         	<a style=" font-size: 19px; text-decoration: none;" href="<?= base_url('blog').'/'.$blog->slug ?>"><?= $blog->heading ?></a>
         </div>
        <?php
    endforeach;
else :
    echo 'No Blogs Found';
endif;
?>
 
<div class="pull-left">
    <?= $this->paginator->display_page_record('Blogs') ?>
</div>
<div class="pull-right">
    <?= $this->paginator->display_pages() ?>
</div>
<div class="clearfix"></div>