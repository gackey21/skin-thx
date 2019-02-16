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



get_template_part('skins/skin-thx/lib/thx','hsla');
get_template_part('skins/skin-thx/lib/thx','cat-label');
get_template_part('skins/skin-thx/lib/thx','amp');
get_template_part('skins/skin-thx/lib/thx','anime');
get_template_part('skins/skin-thx/lib/thx','test');







// 引用符解除
remove_filter("the_content", "wptexturize");
remove_filter("the_excerpt", "wptexturize");
remove_filter("the_title", "wptexturize");







/* JS非同期読み込み
if (!(is_admin() )) {
function add_defer_to_enqueue_script( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.min.js' ) ) return $url;
    if ( strpos( $url, 'highlight.min.js' ) ) return $url;
    return "$url' defer charset='UTF-8";
}
add_filter( 'clean_url', 'add_defer_to_enqueue_script', 11, 1 );
}*/


/* カスタムフィールドでショートコード */
echo apply_filters('the_content', get_post_meta($post->ID, 'custom_field', true));



/* <body>にクラス追加 */
add_filter('body_class', 'thx_body_class_additional');
if ( !function_exists( 'thx_body_class_additional' ) ):
function thx_body_class_additional($classes) {
  global $post;
  $classes[] = 'thx';
  return apply_filters('thx_body_class_additional', $classes);
}//body_class_additional
endif;
