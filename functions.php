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

//アニメボタン
function thx_anime_btn($atts) {
    extract(shortcode_atts(array(
		'dis' => 'd',
		'url' => '',
		'str' => 'で視聴'
	),$atts));

	$checked_date = get_post_meta(get_the_ID(), 'thx_checked_date', true);

	if ($dis =='ma') {
		return '<div style="text-align: center;" class="mg-tp_025em">
					<style>
						.btn-wrap-amazon a:after {content: "本ページの情報は、'.$checked_date.'時点の情報です。";}
					</style>
					<span class="btn-wrap-amazon btn-wrap-w98">
					'.$url.'
				</span></div>';
	}

	else if ($dis == 'a') {
		$dis = 'amazon';
		$ret_02 = '本ページの情報は、'.$checked_date.'時点の情報です。';
	}
	else if ($dis == 'u') {
		$dis = 'unext';
		$ret_02 = '本ページの情報は'.$checked_date.'時点のものです。\A最新の配信状況はU-NEXTサイトにてご確認ください。';
	}
	else if ($dis == 'h') {
		$dis = 'hulu';
		$ret_02 = '紹介している作品は、'.$checked_date.'時点の情報です。\A現在は配信終了している場合もありますので、\A詳細はHuluの公式ホームページにてご確認ください。';
	}
	else if ($dis == 'd') {
		$dis = 'danime';
		$ret_02 = '本ページの情報は、'.$checked_date.'時点の情報です。';
	}

	$ret_01 = '<div style="text-align: center;" class="mg-tp_025em">
				<style>
					.btn-wrap-'.$dis.' a:after {content: "';
	$ret_03 = '";}
				</style>
				<span class="btn-wrap-'.$dis.' btn-wrap-w98">
					<a href="'.$url.'" target="_blank"> '.$str.'</a>
				</span></div>';
	return $ret_01.$ret_02.$ret_03;
}

add_shortcode('thx_anime_btn','thx_anime_btn');

/* <body>にクラス追加 */
add_filter('body_class', 'thx_body_class_additional');
if ( !function_exists( 'thx_body_class_additional' ) ):
function thx_body_class_additional($classes) {
  global $post;
  $classes[] = 'thx';
  return apply_filters('thx_body_class_additional', $classes);
}//body_class_additional
endif;
