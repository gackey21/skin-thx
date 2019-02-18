<?php

///////////////////////////////////////
// 新規パラメータ
///////////////////////////////////////

//サイトキーサブカラー
define('OP_SITE_KEY_SUB_COLOR', 'site_key_sub_color');
if ( !function_exists( 'get_site_key_sub_color' ) ):
function get_site_key_sub_color(){
  return get_theme_option(OP_SITE_KEY_SUB_COLOR);
}
endif;

///////////////////////////////////////
// 色の指定
///////////////////////////////////////
$white = '#fff';
//キーカラー
if (get_site_key_color()){
  $thx_key = get_site_key_color();
} else {
  $thx_key = '#808080';
}

$thx_key_hsla = colorcode_to_hsla($thx_key);

$thx_key_095 = hsla_to_css_code($thx_key_hsla,'95%');
$thx_key_080 = hsla_to_css_code($thx_key_hsla,'80%');
$thx_key_060 = hsla_to_css_code($thx_key_hsla,'60%');

//キーテキストカラー
if (get_site_key_text_color()){
  $thx_key_text = get_site_key_text_color();
}

//サイト背景色
if (get_site_background_color()){
  $thx_bg = get_site_background_color();
} else {
  $thx_bg = $thx_key_095;
}

//ボタン色
if (get_go_to_top_background_color()){
  $thx_sub = get_go_to_top_background_color();
} elseif (get_site_key_sub_color()) {
  $thx_sub = get_site_key_sub_color();
} else {
  $thx_sub_hsla = generate_sub_color($thx_key_hsla);
  $thx_sub = hsla_to_css_code($thx_sub_hsla);
  //$thx_sub_hsla = generate_counter_color($thx_key_hsla);
}

if (!$thx_sub_hsla) {
  $thx_sub_hsla = colorcode_to_hsla($thx_sub);
}

$thx_sub_090 = hsla_to_css_code($thx_sub_hsla,'90%');
$thx_sub_080 = hsla_to_css_code($thx_sub_hsla,'80%');
$thx_sub__050 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.5);
$thx_sub__000 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.0);

//カウンターカラー
$thx_counter_hsla = generate_counter_color($thx_key_hsla);
$thx_counter = hsla_to_css_code($thx_counter_hsla);

///////////////////////////////////////
// 文字サイズの指定
///////////////////////////////////////

//フォントサイズ
if (get_site_font_size()){
  $thx_fz_px = get_site_font_size();
  $thx_fz = mb_substr($thx_fz_px, 0, -2);
}

//モバイルフォントサイズ
if (get_mobile_site_font_size()){
  $thx_mb_fz_px = get_mobile_site_font_size();
  $thx_mb_fz = mb_substr($thx_mb_fz_px, 0, -2);
}

//行の高さ
if (get_entry_content_line_hight()){
  $thx_lh = get_entry_content_line_hight();
  //$thx_ls = round(($thx_lh - 1) * $thx_fz / 2) * 2;
  //$thx_lh_px = $thx_fz + $thx_ls;
}

//グリッド揃え用行間の設定
if ( !function_exists( 'get_grid_line_space' ) ):
function get_grid_line_space($fz, $lh){
  $gls = round(($lh - 1) * $fz / 2) * 2;
  return $gls;
}
endif;

//グリッド揃え用line-heightの設定
if ( !function_exists( 'get_grid_line_height' ) ):
function get_grid_line_height($fz, $lh){
  $gls = get_grid_line_space($fz, $lh);
  $glh = $fz + $gls;
  return $glh;
}
endif;

//スマホ判別
if (is_mobile()) {
  $thx_fz = $thx_mb_fz;
  $thx_fz_px = $thx_mb_fz_px;
}
$thx_gls = get_grid_line_space($thx_fz, $thx_lh);
$thx_gls_px = $thx_gls.'px';
$thx_glh = get_grid_line_height($thx_fz, $thx_lh);
$thx_glh_px = $thx_glh.'px';



?>
