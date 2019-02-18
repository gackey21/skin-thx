<?php

// 引用符解除
remove_filter("the_content", "wptexturize");
remove_filter("the_excerpt", "wptexturize");
remove_filter("the_title", "wptexturize");

// カスタムフィールドでショートコード
echo apply_filters('the_content', get_post_meta($post->ID, 'custom_field', true));

// <body>にクラス追加
add_filter('body_class', 'thx_body_class_additional');
if ( !function_exists( 'thx_body_class_additional' ) ):
function thx_body_class_additional($classes) {
  global $post;
  $classes[] = 'thx';
  return apply_filters('thx_body_class_additional', $classes);
}//body_class_additional
endif;

// スマホ判別
function is_mobile() {
    $useragents = array(
        'iPhone',          // iPhone
        'iPod',            // iPod touch
        '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
        'dream',           // Pre 1.5 Android
        'CUPCAKE',         // 1.5+ Android
        'blackberry9500',  // Storm
        'blackberry9530',  // Storm
        'blackberry9520',  // Storm v2
        'blackberry9550',  // Storm v2
        'blackberry9800',  // Torch
        'webOS',           // Palm Pre Experimental
        'incognito',       // Other iPhone browser
        'webmate'          // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

// style.php読み込み
function thx_enqueue_styles() {
  wp_enqueue_style( 'thx-style', get_stylesheet_directory_uri().'/skins/skin-thx/tmp/css_php/style.php' );
}
add_action( 'wp_enqueue_scripts', 'thx_enqueue_styles' );

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

 ?>
