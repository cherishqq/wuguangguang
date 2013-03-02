<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta property="wb:webmaster" content="0af3e216420007b8" />

<meta name="google-site-verification" content="uycYdhfe9siMw4hHQTvnOWOReFBDdQaWTt631SUysj0" />
<meta name="ujianVerification" content="b5be11d49250c35f2d276b448b22c88c" />
<meta name="msvalidate.01" content="F6D0D996B11C4E815DBAB9DD9BEEE678" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('url');?>/favicon.ico" type="image/x-icon" />
<?php if(get_option('iphoto_lib')!="") : ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js?v=20120401"></script>
<?php else : ?>	
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/jquery.min.js?v=20120401"></script>
<?php endif; ?>
<?php if (!(current_user_can('level_0'))){ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/all.js?v=20120401"></script>
<?php }?>
<?php if (is_home() || is_archive()) { ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/jquery.waterfall.min.js?v=20120401"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/jquery.colorTip.js?v=20120401"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/index.js?v=20120401"></script>
<?php } elseif (is_page('likes') || is_page('views')) { ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/jquery.waterfall.min.js?v=20120401"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/jquery.colorTip.js?v=20120401"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/index2.js?v=20120401"></script>
<?php } elseif (is_singular()){ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/comments-ajax.js?v=20120401"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/phzoom.js?v=20120401"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/single.js?v=20120401"></script>
<?php }?>
<?php wp_head(); ?>

<script type="text/javascript">
$(document).ready(function(){
$(".sub-menu").siblings("a").attr("href","#").css("background","url(<?php bloginfo('template_url'); ?>/images/dot_up.png) no-repeat right center");
	$(".sub-menu").siblings("a").hover(function(){
		$(this).css("background","url(<?php bloginfo('template_url'); ?>/images/dot_down.png) no-repeat right center");
	},function(){
		$(this).css("background","url(<?php bloginfo('template_url'); ?>/images/dot_up.png) no-repeat right center");
	});
});

</script>
</head>
<body <?php body_class(); ?>>
	<div id="header">
		<div id="header-inner">
			<div id="header-box">
				<div id="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" /></a>			
				</div>
				<?php wp_nav_menu(array( 'theme_location'=>'primary','container_id' => 'nav')); ?>				
				<div id="member">
					<ul>
						<li>
							<div id="search">
				<?php if(get_option('iphoto_gsearch')!=""){ ?>
					<form method="get" id="searchform" action="<?php echo home_url(); ?>">
						<input type="text" class="i_soso" value="keywords..." name="g" id="s" size="15" onfocus="this.value = this.value == this.defaultValue ? '' : this.value" onblur="this.value = this.value == '' ? this.defaultValue : this.value"/><input type="image" src="<?php bloginfo('template_url'); ?>/images/icosearch.png" id="searchsubmit" value="Go" />
					</form>
				<?php }else{?>	
					<form method="get" id="searchform" action="<?php echo home_url(); ?>">
						<input type="text" class="i_soso" value="keywords..." name="s" id="s" size="15" onfocus="this.value = this.value == this.defaultValue ? '' : this.value" onblur="this.value = this.value == '' ? this.defaultValue : this.value"/>
						<input type="image" src="<?php bloginfo('template_url'); ?>/images/icosearch.png" id="searchsubmit" value="Go" />
					</form>
				<?php }?>
			</div>
						</li>
						<li id="sina_gz">
							<iframe width="63" height="24" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0" scrolling="no" border="0" src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&width=63&height=24&uid=2970107592&style=1&btn=red&dpc=1"></iframe>
						</li>
						<li id="sina_gz">
							<iframe src="http://follow.v.t.qq.com/index.php?c=follow&a=quick&name=yunbizhi&style=5&t=1346902639614&f=0" marginwidth="0" marginheight="0" allowtransparency="true" frameborder="0" height="24" scrolling="no" width="60"></iframe>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
			</div><!--end header-box-->
		</div>


	</div><!--end header-->
	<?php if (is_home()) { ?>
		<div id="cate" data-animate="<?php echo get_option('iphoto_animate');?>" data-ajax="<?php echo get_option('iphoto_noajax');?>">home</div>
	<?php } elseif (is_archive()){?>
		<div id="cate" data-animate="<?php echo get_option('iphoto_animate');?>"  data-ajax="<?php echo get_option('iphoto_noajax');?>"><?php $category=get_the_category($post->ID);$name = $category[0]->slug;echo $name;?></div>
	<?php } elseif ((is_page('likes') || is_page('views')) && $paged<2){?>
		<div id="cate" data-animate="<?php echo get_option('iphoto_animate');?>"  data-ajax="<?php echo get_option('iphoto_noajax');?>"><?php $post_data = get_post($post->ID, ARRAY_A);$slug = $post_data['post_name'];echo $slug;?></div><!--end cate-->
	<?php }?>
	<div id="wrap">