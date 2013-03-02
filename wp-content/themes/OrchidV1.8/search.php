<?php get_header(); ?>
<div class="main">
	<div class="main_left">
		<div class="mbx-dh">
<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
</div>
		<ul class="list_txt">
        <?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
						<li>
				<h2 class="title"><a href="<?php  echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h2>
				<div class="data">发布日期：<?php the_time('Y-m-d'); ?> | 所属分类：<?php the_category(', ') ?></div>
			</li>
        <?php endwhile; ?>
<?php else : ?>
	<article>
<header class="entry-header">
<h1 class="entry-title"><?php _e( '没有找到该文章', 'leizi' ); ?></h1>
</header>

<div class="entry-content">
<p><?php _e( '抱歉没有找到该文章', 'leizi' ); ?></p>
<?php get_search_form(); ?>
</div>
</article>
<?php endif; ?>					
						
									<div class="clear"></div>
		</ul>
		<div class="page_navi"><?php par_pagenavi(9); ?></div>
		<div class="clear"></div>
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