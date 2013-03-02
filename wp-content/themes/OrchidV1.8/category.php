<?php get_header(); ?>
<div class="main">
	<div class="main_left">
		<div class="mbx-dh">
<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
</div>
<?php query_posts( $query_string . '&posts_per_page=10' ); ?>
		<ul class="list clearfix">
        <?php while (have_posts()) : the_post(); ?>
						<li>
				<div class="thumbnail"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=158&w=240&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></a></div>
				<h2><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			</li><?php endwhile; ?>
								</ul>
		<div class="page_navi"><?php par_pagenavi(9); ?></div>
	</div>
	<?php get_sidebar(); ?>
<div class="clear"></div></div>
		</li>	</ul>
	<div class="clear"></div>
</div>
<div class="footer">
	<?php get_footer(); ?>
</div>

</body>
</html>
