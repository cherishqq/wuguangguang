<?php
/**************************************/
/***************给分类法添加自定义字段类文件************************/
/*****************作者：阿树工作室 www.ashuwp.com*************************/
class ashu_taxonomy_feild{
	var $options;
	var $taxonomyinfo;
	
	function ashu_taxonomy_feild($options,$taxonomyinfo){
		$this->options = $options;
		$this->taxonomyinfo = $taxonomyinfo;
		
		foreach($this->taxonomyinfo as $taxonomy){
				add_action($taxonomy.'_add_form_fields', array(&$this, 'taxonomy_fields_adds'), 10, 2);
				add_action($taxonomy.'_edit_form_fields', array(&$this, 'taxonomy_metabox_edit'), 10, 2);
				add_action('created_'.$taxonomy, array(&$this, 'save_taxonomy_metadata'), 10, 1);	
				add_action('edited_'.$taxonomy,array(&$this, 'save_taxonomy_metadata'), 10, 1);
		}
	}
	/*********添加分类页面*******/
	function taxonomy_fields_adds($tag){
		foreach($this->options as $option){
			if (method_exists($this, $option['type'])){
				echo '<div class="form-field">';
				echo '<label for="'.$option['id'].'" >'.$option['name'].'</label>';
				$this->$option['type']($option);
				echo '</div>';
			}
		}
	}
	/*************编辑分类页面*****************/
	function taxonomy_metabox_edit($tag){
		foreach($this->options as $option){
			if (method_exists($this, $option['type'])){
				if(get_term_meta($tag->term_id , $option['id']) !== ""){
					$option['std'] = get_term_meta($tag->term_id,$option['id'], true);
				}
			
				echo '<tr class="form-field">';
				echo '<th scope="row" valign="top">';
				echo '<label for="'.$option['id'].'" >'.$option['name'].'</label>';
				echo '</th>';
				echo '<td>';
				$this->$option['type']($option);
				echo '</td>';
				echo '</tr>';
			}
		}
	}
	/**************保存数据*****************/
	function save_taxonomy_metadata($term_id){
		foreach($this->options as $option){
			
			if(isset($_POST[$option['id']])){
				if(!current_user_can('manage_categories')){
					return $term_id ;
				}
				
				$data = htmlspecialchars($_POST[$option['id']], ENT_QUOTES,"UTF-8");
				$data = $_POST[$option['id']];
				if(get_term_meta($term_id , $option['id']) == "")
					add_term_meta($term_id , $option['id'], $data, true);
				elseif($data != get_term_meta($term_id , $option['id'], true))
					update_term_meta($term_id , $option['id'], $data);
				elseif($data == "")
					delete_term_meta($term_id , $option['id'], get_term_meta($term_id , $option['id'], true));
				
			}
		}
	}
	
	/******提示信息******/
	function info($option){
		echo '<p>'.$option['desc'].'</p>';
	}
	
	/*******文本输入框text*******/
	function text($option){
			echo '<input type="text" size="'.$option['size'].'" value="';
			echo $option['std'];
			echo '" id="'.$option['id'].'" name="'.$option['id'].'"/>';
			echo '<p>'.$option['desc'].'</p>';
	}
	
	/******文本域***********/
	function textarea($option){
		echo '<textarea cols="40" rows="5" id="'.$option['id'].'" name="'.$option['id'].'">'.$option['std'].'</textarea>';
		echo '<p>'.$option['desc'].'</p>';
	}
	
	
	/**********单选框************/
	function radio( $option ){
		$counter = 1;
		foreach( $option['buttons'] as $radiobutton ) {
			$checked ="";
			if(isset($option['std']) && $option['std'] == $counter) {
				$checked = 'checked = "checked"';
			}
			echo '<input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" name="'.$option['id'].'"/>'.$radiobutton;
			$counter++;
		}
	}
	
	/***********下拉选择***********/
	function dropdown($option){
		echo '<select class="postform" id="'. $option['id'] .'" name="'. $option['id'] .'"> ';
			echo '<option value="">请选择...</option>  ';
			
			foreach ($option['selects'] as $key => $entry){
				if($key = $old_value ){
					$selected = "selected='selected'";
				}
				echo"<option $selected value='". $key."'>". $entry."</option>";
			}
		echo '</select>';
		echo '<p>'.$option['desc'].'</p>';
	}
	
}

$options = array();

$taxonomyinfo = array('category');
$options[] = array(	"name" => "分类标题关键字",
			"desc" => "",
			"id" => "_seo_ke",
			"std" => "",
			"size" => 40,
			"type" => "text");
			
$options[] = array(	"name" => "分类关键词",
			"desc" => "",
			"id" => "_seo_keywords",
			"std" => "",
			"size" => 40,
			"type" => "text");
			
$options[] = array(	"name" => "分类描述信息",
			"desc" => "",
			"id" => "_seo_description",
			"std" => "",
			"size" => 40,
			"type" => "textarea");
			

$new_taxonomy_feild = new ashu_taxonomy_feild($options, $taxonomyinfo);
?>