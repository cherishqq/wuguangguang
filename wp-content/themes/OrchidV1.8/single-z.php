<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="main">
	<div class="main_left">
    <div class="mbx-dh">
<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
</div>
				<div class="list_content nobg">
			<h2 class="title"><?php the_title(); ?></h2>
			<div class="data">发布日期：<span><?php the_time('Y年n月j日') ?></span>　评论：<span><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></span></div>
			<!-- JiaThis Button BEGIN -->
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
			<div class="content">
			<?php the_content(); ?>
			</div>
			<div class="tags">
				<div class="fl">分类：<?php the_category(', ') ?></div>
				<div class="fr"><?php the_tags('标签：', ', ', ''); ?></div>
				<div class="clear"></div>
			</div>
			<div class="tags">文章为原创文章，转载请注明出处，否则将追究相关法律责任。</div>
			<div class="singlepage">
            <?php
$categories = get_the_category();
        $categoryIDS = array();
        foreach ($categories as $category) {
            array_push($categoryIDS, $category->term_id);
        }
        $categoryIDS = implode(",", $categoryIDS);
?>
				<div class="fl"><?php if (get_previous_post($categoryIDS)) { previous_post_link('上一篇: %link','%title',true);} else { echo '已是最后文章';} ?></div>
				<div class="fr"><?php if (get_next_post($categoryIDS)) { next_post_link('上一篇: %link','%title',true);} else { echo '已是最新文章';} ?></div>
				<div class="clear"></div>
			</div>
            
			<div class="clear"></div>
		</div>
						<h3 class="title_a">精品推荐</h3>
		<div class="single_ad">
			<?php echo $ashu_option['ashu']['_ashu_textnygg']; ?>
		</div>
				<div id="comments">

<div id="respond">
<?php comments_template(); ?>
</div>
</div>
	</div>
    <?php else : ?>
    <div class="errorbox">
        没有文章！
    </div>
    <?php endif; ?>
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
