<?php

//<style amp-custom>タグの作成
if ( !function_exists( 'generate_style_amp_custom_tag' ) ):
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
//  get_template_part('thx/css-custom');
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
endif;

 ?>
