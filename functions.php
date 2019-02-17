<?php //スキンから親テーマの定義済み関数をオーバーライドして設定の書き換えが可能
/*
///////////////////////////////////////////
// 設定操作サンプル
// lib\page-settings\内のXXXXX-funcs.phpに書かれている
// 定義済み関数をオーバーライドして設定を上書きできます。
///////////////////////////////////////////
//ヘッダーロゴを「トップメニューにするコードサンプル
function get_header_layout_type(){
  return 'top_menu';
}

//メインカラム幅を680pxにするサンプル
function get_main_column_contents_width(){
  return 680;
}

//エントリーカードの枠線を表示するサンプル
function is_entry_card_border_visible(){
  return true;
}
*/



get_template_part('skins/skin-thx/lib/thx','etc');
get_template_part('skins/skin-thx/lib/thx','hsla');
get_template_part('skins/skin-thx/lib/thx','cat-label');
get_template_part('skins/skin-thx/lib/thx','amp');
get_template_part('skins/skin-thx/lib/thx','anime');
get_template_part('skins/skin-thx/lib/thx','test');

function thx_enqueue_styles() {
  wp_enqueue_style( 'thx-style', get_stylesheet_directory_uri().'/skins/skin-thx/tmp/css_php/style.php' );
}

add_action( 'wp_enqueue_scripts', 'thx_enqueue_styles' );
