<?php
if (get_site_key_color()){//キーカラー
  $thx_key = get_site_key_color();
} else {
  $thx_key = '#808080';
}
$thx_key_hsla = colorcode_to_hsla($thx_key);

$thx_key_095 = hsla_to_css_code($thx_key_hsla,'95%');
$thx_key_080 = hsla_to_css_code($thx_key_hsla,'80%');
$thx_key_060 = hsla_to_css_code($thx_key_hsla,'60%');



//サイトキーサブカラー
define('OP_SITE_KEY_SUB_COLOR', 'site_key_sub_color');
if ( !function_exists( 'get_site_key_sub_color' ) ):
function get_site_key_sub_color(){
  return get_theme_option(OP_SITE_KEY_SUB_COLOR);
}
endif;
if (get_site_key_sub_color()){//サブカラー
  $thx_sub = get_site_key_sub_color();
  $thx_sub_hsla = colorcode_to_hsla($thx_sub);
} else {
  $thx_sub_hsla = generate_sub_color($thx_key_hsla);
//  $thx_sub_hsla = generate_counter_color($thx_key_hsla);
}
$thx_sub = hsla_to_css_code($thx_sub_hsla);
$thx_sub__050 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.5);
$thx_sub__000 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.0);

$thx_counter_hsla = generate_counter_color($thx_key_hsla);
$thx_counter = hsla_to_css_code($thx_counter_hsla);



if (get_site_background_color()){//背景色
  $thx_bg = get_site_background_color();
} else {
  $thx_bg = $thx_key_095;
}

?>
