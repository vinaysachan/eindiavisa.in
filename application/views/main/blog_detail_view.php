<div class="mb15">
	<div class="sharethis-inline-share-buttons"></div>
</div>
<?php foreach ($blog_data->contents as $content) { ?>
	<div class="mb15">
		<?php if($content->type == 'image') { ?>
			<img src="<?=$content->content?>" style="width: 100%; max-height: 350px;" />
		<?php } elseif($content->type == 'content') {
	 		echo html_entity_decode($content->content) ;
		} ?>
	</div>
<?php } ?>
<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

var disqus_config = function () {
this.page.url = '<?=current_url()?>';  // Replace PAGE_URL with your page's canonical URL variable
//this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://www-e-touristvisa-com.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
