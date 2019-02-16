<?php

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

//カテゴリーをID順にソート
if ( !function_exists( 'get_the_category_orderby_id' ) ):
function get_the_category_orderby_id( $categories ) {
    usort( $categories, '_usort_terms_by_ID');
    return $categories;
}
add_filter( 'get_the_categories', 'get_the_category_orderby_id' );
endif;

 ?>
