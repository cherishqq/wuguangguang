<?php
/*
Plugin Name: Extra User Fields
Plugin URI: http://www.feweb.net/wordpressplugin_extrauserfields.htm
Description: Provide simple configs for extra user fields.
Version: 1.0.2
Author: Frank Koenen
Author URI: http://www.frankkoenen.com
*/

add_action('admin_menu','extrauserfields_admin',3);
add_action('personal_options_update','extrauserfields_save');
add_action('edit_user_profile_update','extrauserfields_save');
add_action('show_user_profile','extrauserfields_showedit');
add_action('edit_user_profile','extrauserfields_showedit');
add_action('after_plugin_row','extrauserfields_pluginrow');
add_filter('plugin_action_links','extrauserfields_action_links', 10, 2 );

function extrauserfields_admin() {
  if ( defined('EXTRAUSERFIELDS2') ) return;
  add_options_page( 'Extra User Fields', 'Extra User Fields', 'administrator', 'extrauserfields', 'extrauserfields_menu');
}

function extrauserfields_action_links($links, $file) {
  if ( defined('EXTRAUSERFIELDS2') ) return $links;
  if ( $file != 'extra-user-fields/extra-user-fields.php' ) return $links;
  $settings_link = '<a href="/wp-admin/options-general.php?page=extrauserfields">' . esc_html( __( 'Settings') ) . '</a>';
  array_unshift( $links, $settings_link );
  return $links;
}

function extrauserfields_pluginrow($plugin='') {
  if ( $plugin.'x' != 'extra-user-fields/extra-user-fields.phpx' ) return;
  echo '<td></td><td></td><td>';
  if ( defined('EXTRAUSERFIELDS2') )
    echo '<span style="color:green"><a style="color:green;font-weight:bold" href="http://www.feweb.net/wordpressplugin_extrauserfields.htm">Full-featured version is installed, <b style="color:red">please disable this plugin</b></a></span>';
  else
    echo '<span style="color:green"><a style="color:green;font-weight:bold" href="http://www.feweb.net/wordpressplugin_extrauserfields.htm">Check out the full-featured version, here!</a></span>';
  echo '</td>';
}

function extrauserfields_menu() {

  if ( current_user_can('manage_options') && wp_verify_nonce($_POST['extrauserfields_nonce'], 'extrauserfields' ) ) {
    list($ok,$str,$oo) = extrauserfields_class::extrauserfields_parser(trim($_POST['userfields']));
    update_option('extrauserfields_userfields',$str);
    if ( $ok !== true ) $erroruser = __('One or more lines did not properly parse. Please check your settings <u>before leaving this page</u>');
  }

  $html = file_get_contents( WP_PLUGIN_DIR . '/extra-user-fields/admin.pg');

  $op = get_option('extrauserfields_userfields');
  $html = str_replace('@@VALUEUSER@@',( ( trim($_POST['userfields']).'x' != 'x' ) ? trim($_POST['userfields']) : $op),$html);
  $html = str_replace('@@CURRENTSETTINGSUSER@@',htmlspecialchars($op),$html);
  $html = str_replace('@@ERRORUSER@@',$erroruser,$html);

  $h = preg_replace('/^.*<body>(.*?)<.body>.*$/mi','\1', implode(' ',explode("\n", @file_get_contents('http://www.feweb.net/wordpressplugin_support/extra-user-fields.htm'))));
  $html = str_replace('@@FULLAD@@',$h,$html);

  $nonce = wp_nonce_field('extrauserfields', 'extrauserfields_nonce', true, false );
  $html = str_replace('</form>',$nonce,$html);

  echo $html;
}

function extrauserfields_showedit($user) {
  if ( defined('EXTRAUSERFIELDS2') ) return;
  list($ok,$str,$opu) = extrauserfields_class::extrauserfields_parser(trim(get_option('extrauserfields_userfields')));

  echo '<h3>' . __('Extra User Fields Settings', 'blank') . '</h3><table class="form-table">';

  foreach($opu as $k => $v) extrauserfields_class::profilefield($v);

  echo '</table>';

}

function extrauserfields_save($user_id) {
  if ( defined('EXTRAUSERFIELDS2') ) return;
  if ( !current_user_can( 'edit_user', $user_id ) ) return false;
  list($ok,$str,$opu) = extrauserfields_class::extrauserfields_parser(trim(get_option('extrauserfields_userfields')));

  foreach($opu as $k => $v) {
    $k = 'euf_' . preg_replace(array('/^euf_/','/[^a-z]*/'),'',$k);
    if ( ! is_array($_POST[$k]) && $_POST[$k].'x' == 'x' ) continue;
    if ( is_array($_POST[$k]) ) update_user_meta( $user_id, $k, implode(' ',$_POST[$k]) );
    else update_user_meta( $user_id, $k, $_POST[$k] );
  }
}

class extrauserfields_class {

  public static function extrauserfields_parser($ss) {
    $a = explode("\n",trim($ss));
    $str = '';
    $oo = array();
    $formatok = true;
    foreach($a as $k => $v) {
      if ( $v.'x' == 'x' ) continue;
      $b = explode(' ',trim(preg_replace('/ +/',' ',$v)),3);
      if ( @count($b) < 3 ) { $formatok = false; continue; }
      $b[0] = strtoupper($b[0]);
      $b[1] = strtolower($b[1]);
      if ( $b[0].'x' != 'TEXTx' && $b[0].'x' != 'SELECTx' && $b[0].'x' != 'CHECKBOXx' && $b[0].'x' != 'RADIOx' && $b[0].'x' != 'TEXTAREAx' ) { $formatok = false; continue; }
      $meta = preg_replace('/[^a-z]*/','',$b[1]);
      if ( $meta.'x' != $b[1].'x' ) { $formatok = false; continue; }
      preg_match_all('/^{(.*?)} *{*([^}]*)}*$/',$b[2],$m);
      if ( $m[1][0].'x' == 'x' ) { $formatok = false; continue; }
      $l = '';
      $itemlist = array();
      if ( $b[0].'x' == 'SELECTx' || $b[0].'x' == 'CHECKBOXx' || $b[0].'x' == 'RADIOx' ) {
        if ( $m[2][0].'x' == 'x' && $b[0].'x' != 'CHECKBOXx' ) { $formatok = false; continue; }
        $c = explode(',',preg_replace(array('/^,/','/,$/'),'',$m[2][0]));
        foreach($c as $kk => $vv) {
          $cc = explode(':',$vv);
          if ( @count($cc) > 2 ) { $formatok = false; continue 2; }
          $itemlist[] = $cc;
          if ( preg_match('/^__[A-Z]+__$/',trim($cc[0])) ) $l .= ',' . strtoupper(trim($cc[0]));
          else $l .= ',' . strtolower(trim($cc[0])) . ( ( trim($cc[1]).'x' != 'x' ) ? ':' . trim($cc[1]) : '' );
        }
      } else $l = ',' . $m[2][0];
      list($ll1,$ll2) = explode(':',$m[1][0],2);
      $m[1][0] = trim($ll1) . ( ($ll2.'x'!='x') ? ':' . trim($ll2) : '');
      $str .= $b[0] . ' ' . $meta . ' {' . $m[1][0] . '}' . ( ( $m[2][0].'x' != 'x' ) ? ' {' . substr($l,1) . '}' : '' ) . "\n";

      $oo[$meta] = array(
       'type' => $b[0],
       'meta' => 'euf_' . $meta,
       'label' => $ll1,
       'helper' => $ll2,
       'itemlist' => $itemlist
      );
    }
    return array($formatok,$str,$oo);
  }

  public static function profilefield($item,$admitem=false) {
    global $current_user;

    $isadmin = (current_user_can('administrator'));
    $id = ( $isadmin && (int)$_GET['user_id'] > 0 ) ? (int)$_GET['user_id'] : $current_user->ID;

    switch($item['type']) {

      case 'TEXT':
        ?>
        <tr><th><label for="<?php esc_attr_e($item['meta']); ?>"><?php esc_html_e($item['label']); ?></label></th><td>
        <input name="<?php esc_attr_e($item['meta']); ?>" id="<?php esc_attr_e($item['meta']); ?>" type="text" value="<?php esc_attr_e(get_user_meta($id, $item['meta'],true) ); ?>" class="regular-text extrauserfields" />
        <br/><?php if ( $item['helper'].'x' != 'x' ) echo '<span class="description">' . esc_html($item['helper']) . '</span>' ?>
        </td></tr><?php
        break;

      case 'TEXTAREA':
        ?>
        <tr><th><label for="<?php esc_attr_e($item['meta']); ?>"><?php esc_html_e($item['label']); ?></label></th><td>
        <textarea name="<?php esc_attr_e($item['meta']); ?>" id="<?php esc_attr_e($item['meta']); ?>" class="large-text extrauserfields"><?php echo get_user_meta($id, $item['meta'],true); ?></textarea>
        <br/><?php if ( $item['helper'].'x' != 'x' ) echo '<span class="description">' . esc_html($item['helper']) . '</span>' ?>
        </td></tr><?php
        break;

      case 'RADIO':
        ?>
        <tr><th><label for="<?php esc_attr_e($item['meta']); ?>"><?php esc_html_e($item['label']); ?></label></th><td>
        <fieldset><?php
        $s = get_user_meta($id, $item['meta'],true);
        foreach($item['itemlist'] as $k => $v){
          $c = ( $s.'x' == $v[0].'x'  ) ? 'checked="checked" ' : '';
          echo '<label class="extrauserfields"><input name="' . esc_attr($item['meta']) . '" ' . $c . 'id="' . esc_attr($item['meta']) . '_' . esc_attr($v[0]) . '" type="radio" value="' . esc_attr($v[0]) . '"> <span class="extrauserfields">' . esc_html($v[1]) . '</span></label><br>';
        }
        ?></fieldset>
        <br/><?php if ( $item['helper'].'x' != 'x' ) echo '<span class="description">' . esc_html($item['helper']) . '</span>' ?>
        </td></tr><?php
        break;

      case 'SELECT':
        ?>
        <tr><th><label for="<?php esc_attr_e($item['meta']); ?>"><?php esc_html_e($item['label']); ?></label></th><td>
        <select name="<?php esc_attr_e($item['meta']); ?>" id="<?php esc_attr_e($item['meta']); ?>" class="extrauserfields"><?php
        $s = get_user_meta($id, $item['meta'],true);
        foreach($item['itemlist'] as $k => $v){
          $c = ( $s.'x' == $v[0].'x'  ) ? 'selected="selected" ' : '';
          echo '<option ' . $c . 'id="' . esc_attr($item['meta']) . '_' . esc_attr($v[0]) . '" value="' . esc_attr($v[0]) . '">' . esc_attr($v[1]) . '</option>';
        }
        ?></select>
        <br/><?php if ( $item['helper'].'x' != 'x' ) echo '<span class="description">' . esc_html($item['helper']) . '</span>' ?>
        </td></tr><?php
        break;

      case 'CHECKBOX':
        ?>
        <tr><th><label for="<?php esc_attr_e($item['meta']); ?>"><?php esc_html_e($item['label']); ?></label></th><td>
        <fieldset><?php
        $s = get_user_meta($id, $item['meta'],true);
        $a = explode(' ',trim($s));
        foreach($item['itemlist'] as $k => $v){
          $c = ( in_array($v[0],$a) ) ? 'checked="checked" ' : '';
          echo '<label class="extrauserfields"><input name="' . esc_attr($item['meta']) . '[]" ' . $c . 'id="' . esc_attr($item['meta']) . '_' . esc_attr($v[0]) . '" type="checkbox" value="' . esc_attr($v[0]) . '"> <span class="extrauserfields">' . esc_html($v[1]) . '</span></label><br>';
        }
        ?></fieldset>
        <br/><?php if ( $item['helper'].'x' != 'x' ) echo '<span class="description">' . esc_html($item['helper']) . '</span>' ?>
        </td></tr><?php
        break;

    }
  }
}
