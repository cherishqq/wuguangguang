<?php get_header(); ?>
<div class="main">
	<div class="main_left">
		<div class="slides">
			<div class="slides_container">
            <?php query_posts("showposts=4&category_name=tuijian"); ?>
            <?php while (have_posts()) : the_post(); ?>
            
				<div class="slide">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=330&w=500&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></a>
					<div class="caption">
						<div class="cap">
							<h2><span><?php echo $leixings = get_post_meta($post->ID, "_meta_leixings_value", true); ?></span><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
            <?php endwhile; ?>
</div>
</div>
<?php query_posts('caller_get_posts=1&showposts=4&cat='.$ashu_option['ashu']['_ashu_textwa']); ?>
		<h3 class="title_a"><span class="fl"><?php single_cat_title(); ?></span>
        <?php
if(is_category($ashu_option['ashu']['_ashu_textwa'])) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);}
$catt=get_category_by_slug($yourcat->slug); //获取分类别名
$cat_links=get_category_link($catt->term_id); // 通过$cat数组里面的分类id获取分类链接
?>
        <a class="fr" href="<?php echo $cat_links; ?>/" target="_blank">查看更多</a></h3>
		<div class="recommend">
            <?php while (have_posts()) : the_post(); ?>
			<div class="recommend_top">
				<div class="fl"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=100&w=100&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></div>
				<div class="fr">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div><?php the_excerpt(); ?></div>
				</div>
				<div class="clear"></div>
</div>
<?php endwhile; ?>
</div>
<?php query_posts('caller_get_posts=1&showposts=3&cat='.$ashu_option['ashu']['_ashu_textta']); ?>
<h3 class="title_a"><span class="fl"><?php single_cat_title(); ?></span>
<?php
if(is_category($ashu_option['ashu']['_ashu_textta'])) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);}
$catt=get_category_by_slug($yourcat->slug); //获取分类别名
$cat_links=get_category_link($catt->term_id); // 通过$cat数组里面的分类id获取分类链接
?>
        <a class="fr" href="<?php echo $cat_links; ?>/" target="_blank">查看更多</a></h3>
		<ul class="list_shop">
        <?php while (have_posts()) : the_post(); ?>
			<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=90&w=155&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			<div class="clear"></div>
		</ul>
        <?php query_posts('caller_get_posts=1&showposts=4&cat='.$ashu_option['ashu']['_ashu_textwb']); ?>
		<h3 class="title_a"><span class="fl"><?php single_cat_title(); ?></span>
        <?php
if(is_category($ashu_option['ashu']['_ashu_textwb'])) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);}
$catt=get_category_by_slug($yourcat->slug); //获取分类别名
$cat_links=get_category_link($catt->term_id); // 通过$cat数组里面的分类id获取分类链接
?>
        <a class="fr" href="<?php echo $cat_links; ?>/" target="_blank">查看更多</a></h3>
		<div class="recommend">
		<ul class="list_shop">
        <?php $maxCount=0; while ( $maxCount<3 && have_posts()) : the_post();$maxCount++;
		?>
			<li>
				<a href="<?php the_permalink() ?>" title="" target="_blank"> 
					<img src = "<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=100&w=100&zc=1" alt="<?php the_title(); ?>" width=155 height=90
					  style = "display: block;">
					  <?php the_title(); ?>
				</a>
			</li>	
		    <!--
			<div class="recommend_top">
				<div class="fl"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=100&w=100&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></div>
				<div class="fr">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div><?php the_excerpt(); ?></div>
				</div>
				<div class="clear"></div>
</div>
-->
<?php endwhile; ?>	
</ul>	
		</div>
		<?php query_posts('caller_get_posts=1&showposts=3&cat='.$ashu_option['ashu']['_ashu_texttb']); ?>
<h3 class="title_a"><span class="fl"><?php single_cat_title(); ?></span>
<?php
if(is_category($ashu_option['ashu']['_ashu_texttb'])) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);}
$catt=get_category_by_slug($yourcat->slug); //获取分类别名
$cat_links=get_category_link($catt->term_id); // 通过$cat数组里面的分类id获取分类链接
?>
        <a class="fr" href="<?php echo $cat_links; ?>/" target="_blank">查看更多</a></h3>
		<ul class="list_shop">
        <?php while (have_posts()) : the_post(); ?>
			<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=103&w=155&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			<div class="clear"></div>
		</ul>
	</div>
	<?php get_sidebar(); ?>
<div class="clear"></div></div>
		</li>	</ul>
	<div class="clear"></div>
</div>
<div class="graphic clearfix">
	<div class="graphic_body clearfix">
		<div class="grap">
        <?php query_posts('caller_get_posts=1&showposts=1&cat='.$ashu_option['ashu']['_ashu_textda']); ?>
			<h3>
            <?php
if(is_category($ashu_option['ashu']['_ashu_textda'])) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);}
$catt=get_category_by_slug($yourcat->slug); //获取分类别名
$cat_links=get_category_link($catt->term_id); // 通过$cat数组里面的分类id获取分类链接
?>
        <a href="<?php echo $cat_links; ?>/" target="_blank"><?php single_cat_title(); ?></a></h3>
        <?php while (have_posts()) : the_post(); ?>
			<div><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=190&w=190&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></a></div>
            <?php endwhile; ?>
            <?php query_posts('caller_get_posts=1&showposts=6&cat='.$ashu_option['ashu']['_ashu_textda']); ?>
			<ul><?php while (have_posts()) : the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</div>
		<div class="grap">
        <?php query_posts('caller_get_posts=1&showposts=1&cat='.$ashu_option['ashu']['_ashu_textdb']); ?>
			<h3 class="t2"><?php
if(is_category($ashu_option['ashu']['_ashu_textdb'])) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);}
$catt=get_category_by_slug($yourcat->slug); //获取分类别名
$cat_links=get_category_link($catt->term_id); // 通过$cat数组里面的分类id获取分类链接
?>
        <a href="<?php echo $cat_links; ?>/" target="_blank"><?php single_cat_title(); ?></a></h3>
        <?php while (have_posts()) : the_post(); ?>
			<div><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=190&w=190&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></a></div>
            <?php endwhile; ?>
            <?php query_posts('caller_get_posts=1&showposts=6&cat='.$ashu_option['ashu']['_ashu_textdb']); ?>
			<ul><?php while (have_posts()) : the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</div>
		<div class="grap">
        <?php query_posts('caller_get_posts=1&showposts=1&cat='.$ashu_option['ashu']['_ashu_textdc']); ?>
			<h3 class="t3"><?php
if(is_category($ashu_option['ashu']['_ashu_textdc'])) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);}
$catt=get_category_by_slug($yourcat->slug); //获取分类别名
$cat_links=get_category_link($catt->term_id); // 通过$cat数组里面的分类id获取分类链接
?>
        <a href="<?php echo $cat_links; ?>/" target="_blank"><?php single_cat_title(); ?></a></h3>
        <?php while (have_posts()) : the_post(); ?>
			<div><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=190&w=190&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></a></div>
            <?php endwhile; ?>
            <?php query_posts('caller_get_posts=1&showposts=6&cat='.$ashu_option['ashu']['_ashu_textdc']); ?>
			<ul><?php while (have_posts()) : the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</div>
		<div class="grap last">
        <?php query_posts('caller_get_posts=1&showposts=1&cat='.$ashu_option['ashu']['_ashu_textdd']); ?>
			<h3 class="t4"><?php
if(is_category($ashu_option['ashu']['_ashu_textdd'])) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);}
$catt=get_category_by_slug($yourcat->slug); //获取分类别名
$cat_links=get_category_link($catt->term_id); // 通过$cat数组里面的分类id获取分类链接
?>
        <a href="<?php echo $cat_links; ?>/" target="_blank"><?php single_cat_title(); ?></a></h3>
        <?php while (have_posts()) : the_post(); ?>
			<div><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=190&w=190&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></a></div>
            <?php endwhile; ?>
            <?php query_posts('caller_get_posts=1&showposts=6&cat='.$ashu_option['ashu']['_ashu_textdd']); ?>
			<ul><?php while (have_posts()) : the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
<div class="footer">
	<div class="carte">
		<ul>
			<li>友情链接：</li>
			<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
			<div class="clear"></div>
		</ul>
	</div>
	<?php get_footer(); ?>
</div>
</body>
</html>
