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



// 引用符解除
remove_filter("the_content", "wptexturize");
remove_filter("the_excerpt", "wptexturize");
remove_filter("the_title", "wptexturize");



//<style amp-custom>タグの作成
function generate_style_amp_custom_tag(){?>
<style amp-custom><?php
  $css_all = '';
  //AMPスタイルの取得（SCSSで出力したAMP用のCSS）
  $css_url = get_template_directory_uri().'/amp.css';
  $css = css_url_to_css_minify_code($css_url);
  if ($css !== false) {
    $css_all .= apply_filters( 'amp_parent_css', $css );
  }
  ///////////////////////////////////////////
  //IcoMoonのスタイル
  ///////////////////////////////////////////
  $css_icomoom = css_url_to_css_minify_code(get_template_directory_uri().'/webfonts/icomoon/style.css');
  if ($css_icomoom !== false) {
    $css_all .= apply_filters( 'amp_icomoon_css', $css_icomoom );
  }
  ///////////////////////////////////////////
  //スキンのスタイル
  ///////////////////////////////////////////
  if ( ($skin_url = get_skin_url()) && is_amp_skin_style_enable() ) {//設定されたスキンがある場合
    //通常のスキンスタイル
    $skin_css = css_url_to_css_minify_code($skin_url);
//    if ($skin_css !== false) {
//      $css_all .= apply_filters( 'amp_skin_css', $skin_css );
//    }
    //AMPのスキンスタイル
    $amp_css_url = str_replace('style.css', 'amp.css', $skin_url);
    $amp_css = css_url_to_css_minify_code($amp_css_url);
    if ($amp_css !== false) {
      $css_all .= apply_filters( 'amp_skin_amp_css', $amp_css );
    } elseif ($skin_css !== false) {
      $css_all .= apply_filters( 'amp_skin_css', $skin_css );
    }
  }
  /*
  ///////////////////////////////////////
  // 本文中に挿入されたスタイル（ギャラリーなど）
  ///////////////////////////////////////
  //$content = do_shortcode(get_the_content());
  //_v($content);
  $pattern = '{<style[^>]*?>(.+?)</style>}is';
  if (preg_match_all($pattern, $content, $m)) {
    $all_idx = 0;
    $css_idx = 1;
    //_v($m);
    if ($m[$css_idx]) {
      foreach ($m[$css_idx] as$key => $css) {
        //do_shortcodeすると、おそらくIDが一つ進むと思われ
        //それに対応するためID番号に＋1している
        if (preg_match('{#gallery-(\d+)}', $css, $n)) {
          $css = str_replace($n[$all_idx], '#gallery-'.strval(intval($n[1])+1), $css);
        }
        $css_all .= minify_css($css);
      }
    }
  }
  */
  ///////////////////////////////////////////
  //カスタマイザーのスタイル
  ///////////////////////////////////////////
  ob_start();//バッファリング
  get_template_part('tmp/css-custom');//カスタムテンプレートの呼び出し
  $css_custom = ob_get_clean();
  $css_all .= apply_filters( 'amp_custum_css', minify_css($css_custom) );
  ///////////////////////////////////////////
  //子テーマのスタイル
  ///////////////////////////////////////////
  if ( is_child_theme() && is_amp_child_theme_style_enable() ) {
    //通常のスキンスタイル
    $css_child_url = get_stylesheet_directory_uri().'/style.css';
    $child_css = css_url_to_css_minify_code($css_child_url);
    if ($child_css !== false) {
      $css_all .= apply_filters( 'amp_child_css', $child_css );
    }
    //AMPのスキンスタイル
    $css_child_url = get_stylesheet_directory_uri().'/amp.css';
    $child_amp_css = css_url_to_css_minify_code($css_child_url);
    if ($child_amp_css !== false) {
      $css_all .= apply_filters( 'amp_child_amp_css', $child_amp_css );
    }
  }
  ///////////////////////////////////////////
  //投稿・固定ページに記入されているカスタムCSS
  ///////////////////////////////////////////
  if ($custom_css = get_custom_css_code()) {
    $css_all .= apply_filters( 'amp_singular_custom_css', $custom_css );
  }
  //!importantの除去
  $css_all = preg_replace('/!important/i', '', $css_all);
  //CSSの縮小化
  $css_all = minify_css($css_all);
  //全てのCSSの出力
  echo apply_filters( 'amp_all_css', $css_all );
  //}?></style>
<?php
}



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



function thx_test_01() {
	$html = file_get_contents ( 'https://anime.dmkt-sp.jp/animestore/ci_pc?workId=22195' );
	$dom = @DomDocument::loadHTML ( $html );
	$xml = simplexml_import_dom ( $dom );
	foreach ($xml->xpath ( '//header[contains(@class, "attention")]/p/span' ) as $dataList){
		echo $dataList;
	}
}
add_shortcode('thx_test_01', 'thx_test_01');



function thx_test_02() {
	$html = file_get_contents ( 'https://video.unext.jp/title/SID0037201' );
	$dom = @DomDocument::loadHTML ( $html );
	$xml = simplexml_import_dom ( $dom );
	foreach ($xml->xpath ( '//div[contains(@class,"titleStageBottomRightDiv-kWRRtH")]/div/span' ) as $dataList){
		echo $dataList;
	}
}



function thx_test_04() {
	date_default_timezone_set('Asia/Tokyo');
//	$url = date('2019年12月12日 23:59まで配信');
//	$url = date('2018年12月25日 23時59分00秒');
	$url = date('2019-12-12 23:59');
	$now = date('Y-m-d H:i:s');
	if ($url > $now) {
		return 'まだいい 今：'.$now.'　期限：'.date('Y-m-d H:i:s', strtotime($url));
	} else {
		return 'もうだめ 今：'.$now.'　期限：'.date('Y-m-d H:i:s', strtotime($url));
	}
}
add_shortcode('thx_test_04', 'thx_test_04');
