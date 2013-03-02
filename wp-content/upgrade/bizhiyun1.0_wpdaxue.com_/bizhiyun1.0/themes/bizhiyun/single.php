<?php get_header(); ?>
<div id="single-content">
		<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-home">
			<div class="post-inner">
			<div id="post-header">
			<h1 id="post-title"><?php the_title_attribute(); ?></h1>
			<div id="post-msg">by <?php the_author_link(); ?> &#160;&#124;&#160;<?php the_time('M d, Y'); ?>&#160;&#124;&#160;in <?php the_category(', '); ?></div>
			<div id="post-msg2">
				<ul>
					<li><?php if(function_exists('the_views')) {$views = the_views(0);preg_match('/\d+/', $views, $match);echo '<span>'.$match[0].'</span>';} ?><span class="meta"><?php _e( 'Views',iphoto);?></span></li>
					<li><?php if(function_exists('wizylike')) wizylike('button');  ?><span class="meta"><?php _e( 'Likes',iphoto);?></span></li>
					<li><?php comments_popup_link('0', '1', '%'); ?><span class="meta"><?php _e( 'Comments',iphoto);?></span></li>
					<li><span class="meta" id="imgdown"><a target="_blank" id="downimg">下载</a></span></li>
				</ul>
			</div>
			<img src="" id="hideimg"/>
			<script type="text/javascript">
				//得到图片的原始连接
					$(document).ready(function(){
						 $imgdoadurl=$(".phzoom").attr("href");
						 $("#downimg").attr("href",$imgdoadurl);
						 $("#hideimg").attr("src",$imgdoadurl).hide();
						 
						 var hidimg_w=$("#hideimg").width();
						 
						 var hidimg_h=$("#hideimg").height();
						 var win_w=window.screen.width;
						 var win_h=window.screen.height;
						 
						 
						 //alert(hidimg_w);
						 //1024以下
						 var yles="<a href='#' onclick='selectImg(1024,768)'>1024*768</a>";
						 //1366 以下
						 var ysll="<a href='#' onclick='selectImg(1024,768)'>1024*768</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1366,768)'>1366*768</a>";
						 //1400
						 var yssl="<a href='#' onclick='selectImg(1024,768)'>1024*768</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1366,768)'>1366*768</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1400,900)'>1400*900</a>";
						 //1920
						 var yjel="<a href='#' onclick='selectImg(1024,768)'>1024*768</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1366,768)'>1366*768</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1400,900)'>1400*900</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1920,1080)'>1920*1080</a>";
						//2560
						 var ewll="<a href='#' onclick='selectImg(1024,768)'>1024*768</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1366,768)'>1366*768</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1400,900)'>1400*900</a><span class='se_span'>|</span><a href='#' onclick='selectImg(1920,1080)'>1920*1080</a><span class='se_span'>|</span><a href='#' onclick='selectImg(2560,1600)'>2560*1600</a>";
						 //alert(hidimg_w);
						 if(hidimg_w<=1025){
							$(".selsize").html("您的分辨率为：<a href='' onclick='selectImg("+win_w+","+win_h+")'>"+win_w+"*"+win_h+"</a><span class='se_span'></span>"+"选择下载；"+yles+"<span class='se_span'>|</span><a href="+$imgdoadurl+" target='_blank'>原图</a>");
						 }else if(hidimg_w<=1367){
							$(".selsize").html("您的分辨率为：<a href='' onclick='selectImg("+win_w+","+win_h+")'>"+win_w+"*"+win_h+"</a><span class='se_span'></span>"+"选择下载；"+yles+"<span class='se_span'>|</span><a href="+$imgdoadurl+" target='_blank'>原图</a>");
						 }else if(hidimg_w<=1620){
							$(".selsize").html("您的分辨率为：<a href='' onclick='selectImg("+win_w+","+win_h+")'>"+win_w+"*"+win_h+"</a><span class='se_span'></span>"+"选择下载；"+yssl+"<span class='se_span'>|</span><a href="+$imgdoadurl+" target='_blank'>原图</a>");
						 }else if(hidimg_w<=2000){
							$(".selsize").html("您的分辨率为：<a href='' onclick='selectImg("+win_w+","+win_h+")'>"+win_w+"*"+win_h+"</a><span class='se_span'></span>"+"选择下载；"+yjel+"<span class='se_span'>|</span><a href="+$imgdoadurl+" target='_blank'>原图</a>");
						 //}else if(hidimg_w<=3000){
						 //	$(".selsize").html("请选择下载；"+ewll);
						 }else{
							$(".selsize").html("您的分辨率为：<a href='' onclick='selectImg("+win_w+","+win_h+")'>"+win_w+"*"+win_h+"</a><span class='se_span'></span>"+"选择下载；"+yjel+"<span class='se_span'>|</span><a href="+$imgdoadurl+" target='_blank'>原图</a>");
						 }
						 
						//下载不同的分辨率图片
						
						});
					
				
				
				var sqphp="<?php bloginfo('template_url'); ?>"+"/timthumb.php?src=";
				
				function selectImg(width,height){
					window.open(sqphp+$imgdoadurl+"&w="+width+"&h="+height+"&zc=1&q=90");							
				}
				
			</script>
		
			<div class="clear"></div>
		</div>
		
		<div class="post-content">		
			<?php the_content(''); ?>
			
			<div class="selsize">			
				
			</div>
		</div>
		<p id="con_tag">所属分类: <?php the_category(', '); ?></p>
		<p id="con_tag" style="margin-bottom:20px;"><?php the_tags(); ?></p>
		
		<!--你可能感兴趣开始-->
			
			<div class="widgets border_b">
			<?php _e('<h2>相关壁纸</h2>','iphoto');?>
			<ul>
				<?php
					foreach(get_the_category() as $category){
					$cat = $category->cat_ID;
					}
					query_posts('cat=' . $cat . '&orderby=rand&showposts=10');
					while (have_posts()) : the_post();
					$output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); 
					$imgnum = count($matches);
				?>
				<li>
				<?php if ( $imgnum > 0 ) {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo '<img src="'.get_bloginfo('template_url').'/timthumb.php?src='.$matches[1].'&amp;w=110&amp;h=70&amp;zc=1" />';?></a>
				<?php } else {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php bloginfo('template_url'); ?>/timthumb.php?src=<?php bloginfo('template_url'); ?>/images/default.jpg&amp;w=110&amp;h=70&amp;zc=1" /></a>
				<?php } ?>
				</li>
				<?php endwhile; wp_reset_query(); ?>
			</ul>
			<div class="clear"></div>
		</div>
			<!--你可能感兴趣结束-->			
		<?php endwhile; endif; ?>
		<div id="comments">
			<?php comments_template('', true); ?>
			<p style="width:592px; margin:0 auto; height:auto; border:1px solid #dcdcdc; background:#fff; margin-top:30px;">
				<img src="<?php bloginfo('template_url'); ?>/images/default_img.jpg" width="592"/>
			</p>
			
			
		</div><!--end comments-->
		<!-- UJian Button BEGIN -->
<div class="ujian-hook"></div>
<script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js?uid=1683570"></script>
<!-- UJian Button END -->
		
		</div>
	</div>
	<div id="sidebar">
		<div id="sidebar-inner">
		
			<div class="sidebar-inner">
<div id="navigation">
			<div class="prev">
			<?php if(get_next_post()) {next_post_link('%link'); } else { echo '<span class="disabled"></span>'; }; ?>
			</div>
			<div class="next">
			<?php if(get_previous_post()) {previous_post_link('%link');_e('next page','iphoto');} else{ echo '<span class="disabled"></span>'; }; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div id="popular" class="widgets">
                    
				<?php _e('<h2>热门图集</h2>','iphoto');?>
				<ul>
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'meta_key' => 'views',
					'orderby'   => 'meta_value_num',
					'paged' => $paged,
					'order' => DESC,
					'showposts' => 9
				);
				query_posts($args);
					while (have_posts()) : the_post();
					$output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $imgs); 
					$cnt = count($imgs);
				?>
				<li>
				<?php if ( $cnt > 0 ) {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo '<img src="'.get_bloginfo('template_url').'/timthumb.php?src='.$imgs[1].'&amp;w=60&amp;h=60&amp;zc=1" />';?></a>
				<?php } else {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php bloginfo('template_url'); ?>/timthumb.php?src=<?php bloginfo('template_url'); ?>/images/default.jpg&amp;w=60&amp;h=60&amp;zc=1" /></a>
				<?php } ?>
				</li>
				<?php endwhile; wp_reset_query(); ?>
				</ul>
				<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
		<!--广告开始-->
		<div class="widgets">
			<h2>热门推荐</h2>
			<script type="text/javascript"> 
alimama_pid="mm_14033530_3168968_10717785"; 
alimama_width=200; 
alimama_height=200; 
</script> 
<script src="http://a.alimama.cn/inf.js" type="text/javascript"> 
</script>
		</div>
		<!--广告结束-->
		<div class="clear"></div>		
		
		<!-- Popular Articles -->
		<?php if(function_exists(ti_popular_posts) && get_option('alltuts_popular_posts')!='no'): ?>
		<div class="box_popular">
		<h2>热点排行</h2>
			<?php ti_popular_posts(10); ?>
		</div>
		<?php endif; ?>
		<!--广告开始-->
		<div class="widgets" style="margin-top:20px; text-align:center;">
		<?php wp125_write_ads(); ?>
		</div>
		
		
	</div>
	</div>
	</div>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>
<!--<script src="http://u.diangao.com/site.ashx?website=634833428999990234" type="text/javascript"></script>-->
