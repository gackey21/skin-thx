<?php

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

 ?>
