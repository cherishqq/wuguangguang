<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="main">
	<div class="main_center">
		<div class="crumbs">
			<div class="mbx-dh">
<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
</div>
			<div class="fr"><!-- JiaThis Button BEGIN -->
<div id="ckepop">
	<span class="jiathis_txt">分享到：</span>
	<a class="jiathis_button_tsina">新浪微博</a>
	<a class="jiathis_button_tqq">腾讯微博</a>
	<a class="jiathis_button_fav">收藏夹</a>
	<a class="jiathis_button_douban">豆瓣</a>
	<a class="jiathis_button_fanfou">饭否</a>
	<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
	<a class="jiathis_counter_style"></a>
</div>
<script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
</div>
		</div>

		<div class="pb_main clearfix">
			<div class="pb_left">
								<div class="pb_top clearfix">
<div class="list_content nobg">
			
			<h2 class="title"><?php the_title(); ?></h2>
</div>
	<?php the_content(); ?>
</div>										
		</div>
	</div>
</div>
				
<div id="comments">

<div id="respond">
<?php comments_template(); ?>
</div>
</div>
    <?php else : ?>
    <div class="errorbox">
        没有文章！
    </div>
    <?php endif; ?>

<div class="footer">
	<?php get_footer(); ?>
</div>

</body>
</html>
