<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/post.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="http://mufeng.me/favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<?php if (!(current_user_can('level_0'))){ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/all.js"></script>
<?php } else{ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/ajaxupload.js"></script>
<?php }?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="header">
		<div id="header-inner">
			<div id="header-box">
				<div id="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" /></a></div>
				<?php wp_nav_menu(array( 'theme_location'=>'primary','container_id' => 'nav')); ?>
				<div id="member">
					<?php if (!(current_user_can('level_0'))){ ?>
						<ul>
							<li id="login">
								<a id="login-trigger" href="#" class="login" title="<?php _e('Log in','iphoto'); ?>"><?php _e('Log in','iphoto'); ?></a>
								<div id="login-content" class="hidden">
									<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
										<div>
											<p><?php _e('Username','iphoto'); ?></p>
											<input id="log" type="text" name="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" />
											<p><?php _e('Password','iphoto'); ?><a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword"><?php _e('Forgot password ?','iphoto'); ?></a></p>
											<input type="password" name="pwd" id="pwd" size="20"  />
										</div>
										<div id="actions">
											<input type="submit" name="submit" value="Log in" class="button" />
											<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> <?php _e('Keep me signed in','iphoto'); ?></label>
											<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
										</div>
									</form>
								</div>
							</li>
						</ul>
					<?php } else { ?>
						<?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email, 25); ?><a href="<?php bloginfo('url'); ?>/post" title="<?php _e('Post','iphoto'); ?>"><?php _e('Post','iphoto'); ?></a><a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="<?php _e('Logout','iphoto'); ?>"><?php _e('Logout','iphoto'); ?></a>
					<?php }?>
				</div>
				<div class="clear"></div>
			</div><!--end header-box-->
		</div>
	</div><!--end header-->
	<div id="wrap">
<div id="single-content">
	<div id="single-inner">
<?php 
if(isset($_POST['new_post']) == '1') {
    $post_title = $_POST['post_title'];
    $post_category = $_POST['cat'];
	$post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $new_post = array(
          'ID' => '',
          'post_author' => $user->ID, 
          'post_category' => array($post_category),
		  'tags_input' => array($post_tags),
          'post_content' => $post_content, 
          'post_title' => $post_title,//pending
          'post_status' => 'publish'
        );
    $post_id = wp_insert_post($new_post);
	$post = get_post($post_id);
    wp_redirect($post->guid);
}      
?>
	<div id="new-post">
	<?php if ( is_user_logged_in() ) : ?>
	<div id="new-info">
		<?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email,64); ?>
		<p><?php echo $user_identity; ?> <?php _e('欢迎投稿.','iphoto'); ?></p>
		<p> <?php _e('您可以在这里发布您的音乐.','iphoto'); ?></p>
		<div class="clear"></div>
	</div>
	<form method="post" action="">
		<div id="left">
			<div id="new-title">
				<h3 id="Title"><?php _e('专辑或歌曲名称','iphoto'); ?></h3>
				<input type="text" name="post_title" size="100" id="input-title"/>
			</div>
			<div id="new-img">
				<a href="#" id="upload-button" data-url="<?php bloginfo('template_url'); ?>/timthumb.php">+ <?php _e('添加封面','iphoto'); ?></a>  <?php _e('jpg,gif,png or bmp','iphoto'); ?>
				<div id="upload-images" class="hidden">
					<span class="selected"><?php _e('Local photos','iphoto'); ?></span><span class="right"><?php _e('Network photos','iphoto'); ?></span>
					<div class="clear"></div>
					<ul>
					<li class="selected">
					<a href="#" class="ajaxupload_upload button" id="images"><?php _e('Add local photos','iphoto'); ?></a>
					<textarea rows="5" name="post_content" cols="66" id="text-desc"></textarea>
					</li>
					<li class="next-way"><?php _e('Input address','iphoto'); ?>: <input type="text" name="img_url" size="24" /><a href="#" class="url_button" id="images"><?php _e('Add','iphoto'); ?></a><p><?php _e('Please input the address','iphoto'); ?></p></li>
					</ul>
				</div>
			</div>
			<div id="img-preview"><ul></ul></div>
		</div>
		<div id="new-act">
			<h3 id="title"><?php _e('Cate','iphoto'); ?>:  <?php wp_dropdown_categories('orderby=name&hide_empty=0&hierarchical=1'); ?></h3>
			<h3 id="title"><?php _e('Tags','iphoto'); ?>:</h3><input type="text" name="post_tags" size="45" id="input-tags"/>
		<input id="newsubmit" class="subput round" type="submit" name="submit" value="<?php _e('Submit','iphoto'); ?>" <?php if(!is_user_logged_in()) echo 'disabled="disabled"';?> />
		</div>
		<input type="hidden" name="new_post" value="1"/> 
		<div class="clear"></div>
	</form>
	<?php endif; ?>
	</div>
</div>
	<div class="clear"></div>
</div>
	</div><!--end wrap-->
	<div id="footer">
		<p><?php if(stripslashes(get_option('iphoto_copyright'))!=''){echo stripslashes(get_option('iphoto_copyright'));}else{echo 'Copyright &copy; '.date("Y").' '.'<a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved';}?></p><p>Powered by <a href="http://wordpress.org/" title="Wordpress">WordPress <?php bloginfo('version');?></a>  |  Written by <a href="http://mufeng.me" title="MuFeng">MuFeng</a> </p>
	</div><!--end footer-->
<?php wp_footer(); ?>
</body>
</html>