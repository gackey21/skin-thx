<?php //子テーマ用関数

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く

//リンクのないカテゴリーの取得
if ( !function_exists( 'get_the_nolink_category' ) ):
function get_the_nolink_category($id = null, $is_display = true){
  $categories = null;
  $categories = '<div class="thx_category_space">';
  foreach((get_the_category()) as $category){
    $categories .= '<div class="entry-category thx-label cat-label cat-label-'.$category->cat_ID.'">'.$category->cat_name.'</div>';
  }
  $categories .= '</div>';
  return $categories;
}
endif;
