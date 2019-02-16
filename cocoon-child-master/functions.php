<?php //子テーマ用関数

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く
get_template_part('skins/skin-thx/lib/thx','cat-label');
//get_template_part('skins/skin-thx/functions');

//リンクのないカテゴリーの取得
/*if ( !function_exists( 'get_the_nolink_category' ) ):
function get_the_nolink_category($id = null, $is_display = true){
  $categories = null;
  $categories = '<div class="thx_category_space">';
  foreach((get_the_category()) as $category){
    $categories .= '<div class="entry-category thx-label cat-label cat-label-'.$category->cat_ID.'">'.$category->cat_name.'</div>';
  }
  $categories .= '</div>';
  return $categories;
}
endif;*/

//設定変更CSSを読み込む
if ( !function_exists( 'wp_add_css_custome_to_inline_style' ) ):
function wp_add_css_custome_to_inline_style(){
  ob_start();//バッファリング
  get_template_part('tmp/css-custom');
  get_template_part('thx/css-custom');
  $css_custom = ob_get_clean();
  //CSSの縮小化
  $css_custom = minify_css($css_custom);
  //HTMLにインラインでスタイルを書く
  if (get_skin_url()) {
    //スキンがある場合
    wp_add_inline_style( THEME_NAME.'-skin-style', $css_custom );
  } else {
    //スキンを使用しない場合
    wp_add_inline_style( THEME_NAME.'-style', $css_custom );
  }
}
endif;

//サイトキーサブカラー
define('OP_SITE_KEY_SUB_COLOR', 'site_key_sub_color');
if ( !function_exists( 'get_site_key_sub_color' ) ):
function get_site_key_sub_color(){
  return get_theme_option(OP_SITE_KEY_SUB_COLOR);
}
endif;
