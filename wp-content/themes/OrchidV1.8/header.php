<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title><?php if ( is_home() ) {   
        bloginfo('name'); echo " - "; bloginfo('description');   
    } elseif ( is_category() ) {
        global $wp_query;
        $cat_id = $wp_query->get_queried_object_id();
        echo get_term_meta($cat_id,'_seo_ke',true ); single_cat_title();
    } elseif (is_page() ) {   
        single_post_title();   
    } elseif (is_single()) {   
        echo $title = get_post_meta($post->ID, "_meta_title_value", true); single_post_title();
    } elseif (is_search() ) {   
        echo "搜索结果"; echo " - "; bloginfo('name');   
    } elseif (is_404() ) {   
        echo '页面未找到!';   
    } else {   
        wp_title('',true);   
    } ?></title>
<?php global $ashu_option;?>
<?php
if (is_home() || is_page()) {
    // 将以下引号中的内容改成你的主页description
    $description = $ashu_option['ashu']['_syms'];

    // 将以下引号中的内容改成你的主页keywords
    $keywords = $ashu_option['ashu']['_sygjz'];
}
elseif (is_single()) {
    $description1 = get_post_meta($post->ID, "_meta_description_value", true);
    $description2 = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");

    // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
    $description = $description1 ? $description1 : $description2;
   
    // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
    $keywords = get_post_meta($post->ID, "_meta_keywords_value", true);
    if($keywords == '') {
        $tags = wp_get_post_tags($post->ID);    
        foreach ($tags as $tag ) {        
            $keywords = $keywords . $tag->name . ", ";    
        }
        $keywords = rtrim($keywords, ', ');
    }
}
elseif (is_category()) {
    $description =get_term_meta($cat_id,'_seo_description',true );
    $keywords = get_term_meta($cat_id,'_seo_keywords',true );
}
elseif (is_tag()){
    $description = tag_description();
    $keywords = single_tag_title('', false);
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/hoverIntent.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/superfish.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/slides.jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/atooltip.jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/scrolltopcontrol.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/effect.js"></script>
</head>

<body>
<div class="header">
	<div class="logo"><a href="<?php bloginfo('siteurl');?>/"></a></div>  
    <?php wp_nav_menu(array('container'=>'ul','menu_class'=>'nav','container_class'=>'nav','container_id'=>'menu-home','menu_id'=>'menu-home','depth'=>'0','echo'=>true)); ?>
</div>