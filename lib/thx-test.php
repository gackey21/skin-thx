<?php

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
add_shortcode('thx_test_02', 'thx_test_02');

function thx_test_03() {
	$url = 'https://booklive.jp/product/index/title_id/60000492';
	$url = strip_tags($url);//URL
  if (preg_match('/.+(\.mp3|\.midi|\.mp4|\.mpeg|\.mpg|\.jpg|\.jpeg|\.png|\.gif|\.svg|\.pdf)$/i', $url, $m)) {
    return;
  }
  $url = ampersand_urldecode($url);
  $params = get_url_params($url);
  $user_title = !empty($params['title']) ? $params['title'] : null;
  $user_snipet = !empty($params['snipet']) ? $params['snipet'] : null;
  $url = add_query_arg(array('title' => null, 'snipet' => null), $url);

  $url_hash = TRANSIENT_BLOGCARD_PREFIX.md5( $url );
  $error_title = $url; //エラーの場合はURLを表示
  $title = $error_title;
  $error_image = get_site_screenshot_url($url);

  $image = $error_image;
  $snipet = '';
  $error_rel_nofollow = ' rel="nofollow"';



  /*require_once*/ abspath(__FILE__).'open-graph.php';
  //ブログカードキャッシュ更新モード、もしくはログインユーザー以外のときはキャッシュの取得
  if ( !(is_external_blogcard_refresh_mode() && is_user_administrator()) ) {
    //保存したキャッシュを取得
    $ogp = get_transient( $url_hash );
  }

  if ( empty($ogp) ) {
    $ogp = OpenGraphGetter::fetch( $url );
    if ( $ogp == false ) {
      $ogp = 'error';
    } else {
      //キャッシュ画像の取得
      $res = fetch_card_image($ogp->image);

      if ( $res ) {
        $ogp->image = $res;
      }

      if ( isset( $ogp->title ) )
        $title = $ogp->title;//タイトルの取得

      if ( isset( $ogp->description ) )
        $snipet = $ogp->description;//ディスクリプションの取得

      if ( isset( $ogp->image ) )
        $image = $ogp->image;////画像URLの取得

      $error_rel_nofollow = null;
    }

    set_transient( $url_hash, $ogp,
                   DAY_IN_SECONDS * intval(get_external_blogcard_cache_retention_period()) );

  } elseif ( $ogp == 'error' ) {
    //前回取得したとき404ページだったら何も出力しない
  } else {
    if ( isset( $ogp->title ) )
      $title = $ogp->title;//タイトルの取得

    if ( isset( $ogp->description ) )
      $snipet = $ogp->description;//ディスクリプションの取得

    if ( isset( $ogp->image ) )
      $image = $ogp->image;//画像URLの取得

    $error_rel_nofollow = null;
  }
	//var_dump($image);

  //ドメイン名を取得
  $domain = get_domain_name(isset($ogp->url) ? punycode_decode($ogp->url) : punycode_decode($url));

  //og:imageが相対パスのとき
  if(!$image || (strpos($image, '//') === false) || (is_ssl() && (strpos($image, 'https:') === false))){    // //OGPのURL情報があるか
    //相対パスの時はエラー用の画像を表示
    $image = $error_image;
  }
  $title = strip_tags($title);
  if ($user_title) {
    $title = $user_title;
  }


  $image = strip_tags($image);

  $snipet = get_content_excerpt( $snipet, 160 );
  $snipet = strip_tags($snipet);
  if ($user_snipet) {
    $snipet = $user_snipet;
  }

  //新しいタブで開く場合
  $target = is_external_blogcard_target_blank() ? ' target="_blank"' : '';

  //コメント内でブログカード呼び出しが行われた際はnofollowをつける
  global $comment; //コメント内以外で$commentを呼び出すとnullになる
  $nofollow = $comment || $error_rel_nofollow ? ' rel="nofollow"' : null;

  //GoogleファビコンAPIを利用する
  ////www.google.com/s2/favicons?domain=nelog.jp
  $favicon_tag = '<div class="blogcard-favicon external-blogcard-favicon"><img src="//www.google.com/s2/favicons?domain='.$domain.'" class="blogcard-favicon-image" alt="" width="16" height="16" /></div>';

  //サイトロゴ
  $site_logo_tag = '<div class="blogcard-domain external-blogcard-domain">'.$domain.'</div>';
  $site_logo_tag = '<div class="blogcard-site external-blogcard-site">'.$favicon_tag.$site_logo_tag.'</div>';

  //サムネイルを取得できた場合
  if ( $image ) {
//    $thumbnail = '<img src="'.$image.'" alt="" class="blogcard-thumb-image external-blogcard-thumb-image" />';
    $thumbnail = '<img src="https://res.booklive.jp/60000492/001/thumbnail/2L.jpg" alt="" class="blogcard-thumb-image external-blogcard-thumb-image" />';
  }

  //取得した情報からブログカードのHTMLタグを作成
  $tag =

    '<div class="blogcard external-blogcard'.get_additional_external_blogcard_classes().' cf">'.
      '<figure class="blogcard-thumbnail external-blogcard-thumbnail">'.$thumbnail.'</figure>'.
      '<div class="blogcard-content external-blogcard-content">'.
        '<div class="blogcard-title external-blogcard-title">'.$title.'</div>'.
        '<div class="blogcard-snipet external-blogcard-snipet">'.$snipet.'</div>'.
      '</div>'.
	  '<div class="blogcard-footer external-blogcard-footer cf">'.
	  '<a href="'.$url.'" class="a-wrap cf"'.$target.$nofollow.'>'.$site_logo_tag.'</a>'.'</div>'.
    '</div>';

  return $tag;}
add_shortcode('thx_test_03', 'thx_test_03');

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


function thx_test_05($atts, $text) {
//	$text = '<p>'.$text.'</p>';
//	$text .= '<br>'.$text;

	$pattern = '/(?:\G|>)[^<]*/u';
//	$pattern = '/>.*?([\x01-\x7E]+).*</u';
//	$pattern = '/>([\x01-\x7E]+)</u';
//	$replacement = '>$1<span class = "thx_auto_space">$2</span>$3<';

//	$pattern = '/([^\x01-\x7E]+)/';//２バイトのみ選択
	$replacement = '<span>$0</span>';

//	$pattern = '/^(<\/?[^>]*>)/';
//	$replacement = '<span class = "thx_auto_space">$1</span>';

	$result = preg_replace($pattern, $replacement, $text);
//	$result = preg_replace_callback($pattern, function($match){
//$match[0]:_a
//$match[1]:a
//    return '>'.$match[1].'<span class = "thx_auto_space">'.$match[2].'</span>'.$match[3].'<';
//    return '<span class = "thx_auto_space">'.$match[1].'</span>';
//	}, $text);
	return $result;
}
add_shortcode('thx_test_05', 'thx_test_05');

function thx_test_06($atts, $text) {
	$text = '<p>'.$text.'</p>';
	$pattern = '/(^.*?)([^\x01-\x7E]+)(.*)/';//２バイトのみ選択
	$replacement = '$1</span>$2<span>$3';
//	while($i = 2){
		preg_match($pattern, $text, $matches);
		$result = $matches[1].'</span>'.$matches[2].'<span>';
		$text = preg_replace($pattern, '$3', $text);
		preg_match($pattern, $text, $matches);
		$result .= $matches[1].'</span>'.$matches[2].'<span>';
		$text = preg_replace($pattern, '$3', $text);
		preg_match($pattern, $text, $matches);
		$result .= $matches[1].'</span>'.$matches[2].'<span>';
		$text = preg_replace($pattern, '$3', $text);
		preg_match($pattern, $text, $matches);
		$result .= $matches[1].'</span>'.$matches[2].'<span>';
//		$text = preg_replace($pattern, '', $text);
//		$i++;
//	}
//	return $text2.'</span>';
//	return $result.$result2.'</span>';
//	return $result.'</span>';
	return $result;
}
add_shortcode('thx_test_06', 'thx_test_06');

function thx_test_07($atts, $text) {
	$text = '<p>'.$text.'</p>';
	$text .= '<br>'.$text;
//	$text = '<a href="https://thx.jp" title="コンテンツ" class="blogcard-wrap internal-blogcard-wrap a-wrap cf typesquare_tags"><div class="blogcard internal-blogcard ib-left cf typesquare_tags"><figure class="blogcard-thumbnail internal-blogcard-thumbnail typesquare_tags"><img data-src="https://thx.jp/wp/wp-content/themes/cocoon-master/images/no-image-160.png.pagespeed.ce.qkrm99g2U8.png" alt="" class="blogcard-thumb-image internal-blogcard-thumb-image lozad lozad-img" width="160" height="90" src="https://thx.jp/wp/wp-content/themes/cocoon-master/images/no-image-160.png.pagespeed.ce.qkrm99g2U8.png" data-loaded="true"><noscript class="typesquare_tags">&lt;img src="https://thx.jp/wp/wp-content/themes/cocoon-master/images/no-image-160.png.pagespeed.ce.qkrm99g2U8.png" alt="" class="blogcard-thumb-image internal-blogcard-thumb-image" width="160" height="90"/&gt;</noscript></figure><div class="blogcard-content internal-blogcard-content typesquare_tags"><div class="blogcard-title internal-blogcard-title typesquare_tags">コンテンツ</div><div class="blogcard-snipet internal-blogcard-snipet typesquare_tags">thx.jp にて運営されているコンテンツです。</div></div><div class="blogcard-footer internal-blogcard-footer cf typesquare_tags"><div class="blogcard-site internal-blogcard-site typesquare_tags"><div class="blogcard-favicon internal-blogcard-favicon typesquare_tags"><img data-src="//www.google.com/s2/favicons?domain=thx.jp" class="blogcard-favicon-image internal-blogcard-favicon-image lozad lozad-img" alt="" width="16" height="16" src="//www.google.com/s2/favicons?domain=thx.jp" data-loaded="true"><noscript class="typesquare_tags">&lt;img src="//www.google.com/s2/favicons?domain=thx.jp" class="blogcard-favicon-image internal-blogcard-favicon-image" alt="" width="16" height="16"/&gt;</noscript></div><div class="blogcard-domain internal-blogcard-domain typesquare_tags">thx.jp</div></div><div class="blogcard-date internal-blogcard-date typesquare_tags"><div class="blogcard-post-date internal-blogcard-post-date typesquare_tags">2018.10.20</div></div></div></div></a>';
	$pattern = '/(^.*?)([^\x01-\x7E]+)(.*)/';//２バイトのみ選択
	while(preg_match($pattern, $text, $matches)){
		$result .= $matches[1].'</span>'.$matches[2].'<span class = "thx_auto_space">';
		$text = preg_replace($pattern, '$3', $text);
	}
	return $result;
}
add_shortcode('thx_test_07', 'thx_test_07');

function thx_css_accordion($atts, $hide) {
    extract(shortcode_atts(array(
		'id' => '1',
		'string' => 'クリックで表示',
//		'tag' => 'span'
	),$atts));

	$result =	'<div class="accbox">'.
//					'<'.$tag.'>'.
						'<label for="label'.$id.'">'.$string.'</label>'.
//					'</'.$tag.'>'.
//					'<label for="label'.$id.'">'.
//						'<'.$tag.'>'.
//							$string.
//						'</'.$tag.'>'.
//					'</label>'.
					'<input type="checkbox" id="label'.$id.'" class="cssacc" />'.
					'<div class="accshow">'.
						$hide.
					'</div>'.
				'</div>';
	return $result;
}
add_shortcode('thx_acd', 'thx_css_accordion');

 ?>
