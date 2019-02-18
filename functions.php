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

$thx_lib = 'skins/skin-thx/lib/thx';

get_template_part($thx_lib,'etc');
get_template_part($thx_lib,'hsla');
get_template_part($thx_lib,'cat-label');
get_template_part($thx_lib,'amp');
get_template_part($thx_lib,'anime');
get_template_part($thx_lib,'test');
