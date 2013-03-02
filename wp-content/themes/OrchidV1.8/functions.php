<?php
if(function_exists('register_nav_menus')){   
    register_nav_menus(   
    array(   
        'header-menu' => __( '导航自定义菜单' ),   
    )   
);   
//如果要注册多个菜单的话在arry数组再添加几个比如：   
//'menu1'=>'菜单1','menu2'=>'菜单2','menu3'=>'菜单3'   
} 
//分页代码----------------------------------------------------------
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}
	previous_posts_link(' 上一页 ');
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link(' 下一页 ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}}
}

//评论代码----------------------------------------------------------
function aurelius_comment($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
        <div class="gravatar"> <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
 <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?> </div>
        <div class="comment_content" id="comment-<?php comment_ID(); ?>">   
            <div class="clearfix">
                    <?php printf(__('<cite class="author_name">%s</cite>'), get_comment_author_link()); ?>
                    <div class="comment-meta commentmetadata">发表于：<?php echo get_comment_time('Y-m-d H:i'); ?></div>
                    &nbsp;&nbsp;&nbsp;<?php edit_comment_link('修改'); ?>
            </div>

            <div class="comment_text">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em>你的评论正在审核，稍后会显示出来！</em><br />
        <?php endif; ?>
        <?php comment_text(); ?>
            </div>
        </div>
    </li>
<?php } 
//图片+幻灯片调用代码---------------------------------------------------------------------
//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
 
//输出缩略图地址 From orchidfairy.com
function post_thumbnail_src(){
    global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches [1] [0];   //获取该图片 src
		if(empty($post_thumbnail_src)){	//如果日志中没有图片，则显示随机图片
			$random = mt_rand(1, 10);
			echo get_bloginfo('template_url');
			echo '/images/'.$random.'.gif';
			//如果日志中没有图片，则显示默认图片
			//echo '/images/none.gif';
		}
	};
	echo $post_thumbnail_src;
}
//文章页SEO---------------------------------------------------------------------------------------------------
$new_meta_boxes =    
array(   
    "title" => array(   
        "name" => "_meta_title",   
        "std" => "",   
        "title" => "页面标题关键字",   
        "type"=>"text"),      
     
    "keywords" => array(   
        "name" => "_meta_keywords",   
        "std" => "",      
        "title" => "页面关键字",   
        "type"=>"text"),   
           
    "description1" => array(   
        "name" => "_meta_description",   
        "std" => "",      
        "title" => "页面描述",   
        "type"=>"textarea"),    
		  
   "leixings" => array(   
        "name" => "_meta_leixings",   
        "std" => "",      
        "title" => "幻灯片关键字",   
        "type"=>"text"),
           
);
//创建的字段信息完毕

function new_meta_boxes() {   
    global $post, $new_meta_boxes;   
    foreach($new_meta_boxes as $meta_box) {   
        //获取保存的是   
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);   
        if($meta_box_value != "")      
            $meta_box['std'] = $meta_box_value;//将默认值替换为以保存的值   
           
        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';   
        //通过选择类型输出不同的html代码   
        switch ( $meta_box['type'] ){   
            case 'text':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                echo '<input type="text" size="40" name="'.$meta_box['name'].'_value" value="'.$meta_box['std'].'" /><br />';   
                break;   
            case 'text':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                echo '<input type="text" size="40" name="'.$meta_box['name'].'_value" value="'.$meta_box['std'].'" /><br />';   
                break;   
            case 'textarea':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box['std'].'</textarea><br />';   
                break;
			case 'text':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                echo '<input type="text" size="40" name="'.$meta_box['name'].'_value" value="'.$meta_box['std'].'" /><br />';   
                break;
			case 'text':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                echo '<input type="text" size="40" name="'.$meta_box['name'].'_value" value="'.$meta_box['std'].'" /><br />';   
                break; 
        }             
    }      
}  
//创建(显示)面板内容的函数完毕

function create_meta_box() {   
    global $theme_name;   
  
    if ( function_exists('add_meta_box') ) {   
        add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );   
    }   
}
//创建面板完毕

function save_postdata( $post_id ) {   
    global $post, $new_meta_boxes;   
  
    foreach($new_meta_boxes as $meta_box) {   
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {   
            return $post_id;   
        }   
  
        if ( 'page' == $_POST['post_type'] ) {   
            if ( !current_user_can( 'edit_page', $post_id ))   
                return $post_id;   
        }    
        else {   
            if ( !current_user_can( 'edit_post', $post_id ))   
                return $post_id;   
        }   
  
        $data = $_POST[$meta_box['name'].'_value'];   
  
        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")   
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);   
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))   
            update_post_meta($post_id, $meta_box['name'].'_value', $data);   
        elseif($data == "")   
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));   
    }   
}
//保存更新数据完毕
add_action('admin_menu', 'create_meta_box');   
add_action('save_post', 'save_postdata');
//触发分类
include("class-taxonomy-feild.php");
include("simple-term-meta.php");

//面包屑导航-----------------------------------------------------------------------------------------------------------------------------------------------
function dimox_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span>';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="crumbs">';
 
    global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . 'Archive by category &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}

/**********文章ID***************************************************************************************/  
add_filter('manage_posts_columns', 'add_new_posts_columns');   
function add_new_posts_columns($book_columns) {   
       
    $new_columns['cb'] = '<input type="checkbox" />';   
    $new_columns['id'] = __('ID');   
    $new_columns['title'] = _x( 'Title', 'column name' );   
    $new_columns['author'] = __('Author');   
    $new_columns['categories'] = __('Categories');   
    $new_columns['tags'] = __('Tags');   
    $new_columns['date'] = _x('Date', 'column name');   
    return $new_columns;   
}   
add_action('manage_posts_custom_column', 'manage_posts_columns', 10, 2);   
function manage_posts_columns($column_name, $id) {   
    global $wpdb;   
    switch ($column_name) {   
    case 'id':   
        echo $id;   
        break;   
    default:   
        break;   
    }   
}   
/**************页面ID**************************************************************************************/  
add_filter('manage_pages_columns', 'add_new_pages_columns');   
function add_new_pages_columns($book_columns) {   
       
    $new_columns['cb'] = '<input type="checkbox" />';   
    $new_columns['id'] = __('ID');   
    $new_columns['title'] = _x( 'Title', 'column name' );   
    $new_columns['author'] = __('Author');   
    $new_columns['date'] = _x('Date', 'column name');   
    return $new_columns;   
}   
add_action('manage_pages_custom_column', 'manage_pages_columns', 10, 2);   
function manage_pages_columns($column_name, $id) {   
    global $wpdb;   
    switch ($column_name) {   
    case 'id':   
        echo $id;   
        break;   
    default:   
        break;   
    }   
} 
 //后台设置面板类---------------------------------------------------------------------------------------------------------------------------开始
class ashu_option_class{   
  
    var $options;   
    var $pageinfo; 
    var $database_options;   
    var $saved_optionname;   
       
    //类的构建函数   
    function ashu_option_class($options, $pageinfo) {      
        $this->options = $options;    
        $this->pageinfo = $pageinfo;  
        $this->make_data_available(); //准备设置选项数据   
  
        add_action( 'admin_menu', array(&$this, 'add_admin_menu') );   
           
        if( isset($_GET['page']) && ($_GET['page'] == $this->pageinfo['filename']) ) {   
            //加载css js   
            add_action('admin_init', array(&$this, 'enqueue_head'));       
        }   
    }   
		
    function enqueue_head() {   
        //注意这里加载的js路径   
        wp_enqueue_script('ashu_options_js', get_bloginfo( 'stylesheet_directory' ) . '/js/ashu_options.js');    
        wp_enqueue_script('thickbox');   
        wp_enqueue_style('thickbox');   
    }   
       
    //创建菜单项函数   
    function add_admin_menu() {   
        //添加顶级菜单项   
        $top_level = "Orchid主题设置";   
        if(!$this->pageinfo['child']) {   
            add_menu_page($top_level, $top_level, 'edit_themes', $this->pageinfo['filename'], array(&$this, 'initialize'));   
            define('TOP_LEVEL_BASEAME', $this->pageinfo['filename']);   
        }   
        //添加子菜单项   
        else{   
            add_submenu_page(TOP_LEVEL_BASEAME, $this->pageinfo['full_name'], $this->pageinfo['full_name'], 'edit_themes', $this->pageinfo['filename'], array(&$this, 'initialize'));   
        }   
    }   
       
    function make_data_available() {   
        global $ashu_option; //申明全局变量   
           
        foreach ($this->options as $option) {   
            if( isset($option['std']) ) {   
                $ashu_option_std[$this->pageinfo['optionname']][$option['id']] = $option['std'];   
            }   
        }   
        //选项组名称   
        $this->saved_optionname = 'ashu_'.$this->pageinfo['optionname'];   
        $ashu_option[$this->pageinfo['optionname']] = get_option($this->saved_optionname);   
           
        //合并数组   
        $ashu_option[$this->pageinfo['optionname']] = array_merge((array)$ashu_option_std[$this->pageinfo['optionname']], (array)$ashu_option[$this->pageinfo['optionname']]);   
           
        //html实体转换   
        $ashu_option[$this->pageinfo['optionname']] = $this->htmlspecialchars_deep($ashu_option[$this->pageinfo['optionname']]);   
       
    }   
       
    //使用递归将预定义html实体转换为字符   
    function htmlspecialchars_deep($mixed, $quote_style = ENT_QUOTES, $charset = 'UTF-8') {   
        if (is_array($mixed) || is_object($mixed)) {   
            foreach($mixed as $key => $value) {   
                $mixed[$key] = $this->htmlspecialchars_deep($value, $quote_style, $charset);   
            }   
        }   
        elseif (is_string($mixed)) {   
            $mixed = htmlspecialchars_decode($mixed, $quote_style);   
        }   
        return $mixed;   
    }    
       
    function initialize() {   
        $this->get_save_options();   
        $this->display();   
    }   
       
    //显示表单项函数   
    function display() {       
        $saveoption = false;   
        echo '<div class="wrap">';   
        echo '<div class="icon32" id="icon-options-general"><br/></div>';   
        echo '<h2>'.$this->pageinfo['full_name'].'</h2>';   
		//分类ID数
		;echo ' 
<style>
.allcatsid{ float:left; border:1px solid #FFD59B;  background-color:#EFE8E7; clear:both;}
.allcatsid ul li{ float:left; margin-bottom:0px; padding:5px 5px; line-height:24px; text-align:center; border-right:1px solid #FFD59B; border-bottom:1px solid #FFD59B; color:#787878;}
.allcatsid ul li strong{ color:#222;}
</style>
		<div class="allcatsid">
                <ul>
                    <li><strong>分类名称</strong><br /><b>分类ID</b></li>
					';
$categories = get_categories('hide_empty=0&orderby=id');
$wp_cats = array();
foreach ($categories as $category_list ) {
$wp_cats[$category_list->cat_ID] = $category_list->cat_name;
;echo '                        <li>';echo $wp_cats[$category_list->cat_ID];;echo '<br />';echo $category_list->cat_ID;;echo '</li>
                    ';};echo '                </ul>
            </div><br/>';
//分类ID数结束 
        echo '<form method="post" action="">';   
           
        //根据选项类型执行对应函数   
        foreach ($this->options as $option) {   
            if (method_exists($this, $option['type'])) {   
                $this->$option['type']($option);   
                $saveoption = true;   
            }   
        } 

        if($saveoption) {   
            echo '<p class="submit">';   
            echo '<input type="hidden" value="1" name="save_my_options"/>';   
            echo '<input type="submit" name="Submit" class="button-primary autowidth" value="保存" /></p>';   
        }   
        echo '</form></div>';   
    }   
       
    //更新数据   
    function get_save_options() {   
	
        $options = $newoptions  = get_option($this->saved_optionname);  		
        if ( isset( $_POST['save_my_options'] ) ) {    
            echo '<div class="updated fade" id="message" style=""><p><strong>保存成功！</strong></p></div>';   
            foreach ($_POST as $key => $value) {   
                $value = stripslashes($value);   
                $newoptions[$key] = htmlspecialchars($value, ENT_QUOTES,"UTF-8");    
            }   
        }   
               
        if ( $options != $newoptions ) {   
            $options = $newoptions;   
            update_option($this->saved_optionname, $options);   
        }   
           
        if($options) {   
            foreach ($options as $key => $value) {   
                $options[$key] = empty($options[$key]) ? false : $options[$key];   
            }   
        }   
           
        $this->database_options = $options;   
    }   
       
    /************开头***************/  
    function open($values) {   
        if(!isset($values['desc'])) $values['desc'] = "";   
           
        echo '<table class="widefat">';   
        echo '<thead><tr><th colspan="2">'.$values['desc'].'&nbsp;</th></tr></thead>';   
    }   
       
    /***************结尾**************/  
    function close($values) {   
        echo '<tfoot><tr><th>&nbsp;</th><th>&nbsp;</th></tr></tfoot></table>';   
    }   
  
    /**********标题***********************/  
    function title($values) {   
        echo '<h3>'.$values['name'].'</h3>';   
        if (isset($values['desc'])) echo '<p>'.$values['desc'].'</p>';   
    }   

    /*****************************文本域**********************************/  
    function textarea($values) {   
        if(isset($this->database_options[$values['id']])) $values['std'] = $this->database_options[$values['id']];   
  
        echo '<tr valign="top" >';   
        echo '<th scope="row" width="200px">'.$values['name'].'</th>';   
        echo '<td>'.$values['desc'].'<br/>';   
        echo '<textarea name="'.$values['id'].'" cols="60" rows="7" id="'.$values['id'].'" style="width: 80%; font-size: 12px;" class="code">';   
        echo $values['std'].'</textarea><br/>';   
        echo '<br/></td>';   
        echo '</tr>';   
    }   
       
    /*********************文本框**************************/  
    function text($values) {       
        if(isset($this->database_options[$values['id']])) $values['std'] = $this->database_options[$values['id']];   
           
        echo '<tr valign="top" >';   
        echo '<th scope="row" width="200px">'.$values['name'].'</th>';   
        echo '<td>'.$values['desc'].'<br/>';   
        echo '<input type="text" size="'.$values['size'].'" value="'.$values['std'].'" id="'.$values['id'].'" name="'.$values['id'].'"/>';   
        echo '<br/><br/></td>';   
        echo '</tr>';   
    }   
       
    /*******************上传*****************************/  
    function upload($values) {     
        $prevImg = '';   
        if(isset($this->database_options[$values['id']])) $values['std'] = $this->database_options[$values['id']];   
        if($values['std'] != ''){$prevImg = '<img src='.$values['std'].' alt="" />';}   
           
        echo '<tr valign="top" >';   
        echo '<th scope="row" width="200px">'.$values['name'].'</th>';   
        echo '<td>';   
        echo '<div class="preview_pic_optionspage" id="'.$values['id'].'_div">'.$prevImg.'</div>';   
        echo $values['desc'].'<br/>';   
        echo '<input type="text" size="60" value="'.$values['std'].'" name="'.$values['id'].'" class="upload_pic_input" />';   
        echo '&nbsp;<a onclick="return false;" title="" class="k_hijack button thickbox" id="'.$values['id'].'" href="media-upload.php?type=image&amp;hijack_target='.$values['id'].'&amp;TB_iframe=true">Insert Image</a>';   
           
        echo '<br/><br/></td>';   
        echo '</tr>';   
    }   
  
    /**************复选框*******************/  
    function checkbox($values) {       
        if(isset($this->database_options[$values['id']]) && $this->database_options[$values['id']] !== '')   
            $checked = 'checked = "checked"';   
        else  
            $checked  = '';   
        echo '<tr valign="top">';   
        echo '<th scope="row" width="200px">'.$values['name'].'</th>';   
        echo '<td><input class="kcheck" type="checkbox" name="'.$values['id'].'" id="'.$values['id'].'" value="true"  '.$checked.' />';   
        echo '<label for="'.$values['id'].'">'.$values['desc'].'</label><br/>';   
        echo '<br/></td>';   
        echo '</tr>';   
    }   
  
  
    /**********************单选框******************************/  
    function radio($values) {      
           
        echo '<tr valign="top" >';   
        echo '<th scope="row" width="200px">'.$values['name'].'</th>';   
        echo '<td>'.$values['desc'].'<br/>';   
           
        $counter = 1;   
        foreach($values['buttons'] as $radiobutton) {      
            $checked ="";   
            if(isset($this->database_options[$values['id']])) {   
                if($this->database_options[$values['id']] == $counter)   
                {   
                    $checked = 'checked = "checked"';   
                }   
            }   
            else if(isset($values['std']) && $values['std'] == $counter) {   
                $checked = 'checked = "checked"';   
            }   
           
            echo '<p><input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" id="'.$values['id'].$counter.'" name="'.$values['id'].'"/>';   
            echo '<label for="'.$values['id'].$counter.'">'.$radiobutton.'</label></p>';   
            $counter++;   
        }   
           
        echo '<br/></td>';   
        echo '</tr>';   
    }   
 
    /********************下拉框*********************/  
    function dropdown($values) {       
        if(!isset($this->database_options[$values['id']]) && isset($values['std'])) $this->database_options[$values['id']] = $values['std'];   
                   
        echo '<tr valign="top" >';   
        echo '<th scope="row" width="200px">'.$values['name'].'</th>';   
        echo '<td>'.$values['desc'].'<br/>';   
           
            if($values['subtype'] == 'page') {   
                $select = 'Select page';   
                $entries = get_pages('title_li=&orderby=name');   
            }   
            else if($values['subtype'] == 'cat')   
            {   
                $select = 'Select category';   
                $entries = get_categories('title_li=&orderby=name&hide_empty=0');   
            }   
            else  
            {      
                $select = 'Select...';   
                $entries = $values['subtype'];   
            }   
           
            echo '<select class="postform" id="'. $values['id'] .'" name="'. $values['id'] .'"> ';   
            echo '<option value="">'.$select .'</option>  ';   
  
            foreach ($entries as $key => $entry) {   
                if($values['subtype'] == 'page')   
                {   
                    $id = $entry->ID;   
                    $title = $entry->post_title;   
                }   
                else if($values['subtype'] == 'cat')   
                {   
                    $id = $entry->term_id;   
                    $title = $entry->name;   
                }   
                else  
                {   
                    $id = $entry;   
                    $title = $key;                 
                }   
  
                if ($this->database_options[$values['id']] == $id )   
                {   
                    $selected = "selected='selected'";     
                }   
                else  
                {   
                    $selected = "";        
                }   
                   
                echo"<option $selected value='". $id."'>". $title."</option>";   
            }   
           
        echo '</select>';   
            
        echo '<br/><br/></td>';   
        echo '</tr>';   
    }   
  
}   
//后台设置面板类----------------------------------------------------------结束
//后台设置面板----------------------------------------------------------开始
$pageinfo = array('full_name' => 'Orchid网站主题设置;获取支持：http://www.orchidfairy.com' ,'optionname'=>'ashu', 'child'=>false, 'filename' => basename(__FILE__));   

$options = array();   
               
$options[] = array( "type" => "open");   
			
$options[] = array(   
                "name"=>"首页关键词",   
                "id"=>"_sygjz",   
                "std"=>"输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );  
			
$options[] = array(   
                "name"=>"首页描述",   
                "id"=>"_syms",   
                "std"=>"输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );   
			              
$options[] = array(   
                "name"=>"文块1ID",   
                "id"=>"_ashu_textwa",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );   
  
$options[] = array(   
                "name"=>"文块2ID",   
                "id"=>"_ashu_textwb",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );   
$options[] = array(   
                "name"=>"图块1ID",   
                "id"=>"_ashu_textta",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );   
  
$options[] = array(   
                "name"=>"图块2ID",   
                "id"=>"_ashu_texttb",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"底块1ID",   
                "id"=>"_ashu_textda",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"底块2ID",   
                "id"=>"_ashu_textdb",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"底块3ID",   
                "id"=>"_ashu_textdc",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"底块4ID",   
                "id"=>"_ashu_textdd",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"新浪微博地址",   
                "id"=>"_ashu_textsinadz",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"腾讯微博地址",   
                "id"=>"_ashu_textqqdz",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"豆瓣地址",   
                "id"=>"_ashu_textdbdz",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   

                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"订阅本站",   
                "id"=>"_ashu_textdybz",   
                "std"=>"ID输入框",   
                "desc"=>"Orchid版权所有",   
                "size"=>"60",   
                "type"=>"text"  
            );
$options[] = array(   
                "name"=>"联盟广告展示",   
                "id"=>"_ashu_textzzs",   
                "std"=>"广告代码",   
                "desc"=>"广告代码",   
                "size"=>"60",   
                "type"=>"textarea"  
            ); 
$options[] = array(   
                "name"=>"精品店铺推荐",   
                "id"=>"_ashu_textdptj",   
                "std"=>"地址",   
                "desc"=>"地址+图片，参见教程",   
                "size"=>"60",   
                "type"=>"textarea"  
            );  
$options[] = array(   
                "name"=>"流量统计代码",   
                "id"=>"_ashu_textlltj",   
                "std"=>"代码",   
                "desc"=>"流量代码",   
                "size"=>"60",   
                "type"=>"textarea"  
            );    
$options[] = array(   
                "name"=>"内页精品推荐",   
                "id"=>"_ashu_textnygg",   
                "std"=>"代码",   
                "desc"=>"广告代码",   
                "size"=>"60",   
                "type"=>"textarea"  
            );         
$options[] = array( "type" => "close");

$options_page = new ashu_option_class($options,$pageinfo);
//后台设置面板----------------------------------------------------------结束
//友情链接触发
add_filter( 'pre_option_link_manager_enabled', '__return_true' ); 
?>