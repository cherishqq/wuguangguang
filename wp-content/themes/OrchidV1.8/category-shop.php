<?php get_header(); ?>
<div class="main">
	<div class="main_center">
		<div class="mbx-dh">
<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
</div>
<h3 class="title_a nobg">美好店铺</h3>
<?php query_posts( $query_string . '&posts_per_page=24' ); ?>
<ul class="category_store">
                        <?php while (have_posts()) : the_post(); ?>
<li>
<div class="fl"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=100&w=100&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></a></div>
<div class="fr">
<h4><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
<?php the_excerpt(); ?>
<a class="more" href="<?php the_permalink() ?>">查看</a>
</div>
</li><?php endwhile; ?>
								</ul>
	<div class="clear"></div>
</div>
</div>
<div class="footer">
	<?php get_footer(); ?>
</div>

</body>
</html>