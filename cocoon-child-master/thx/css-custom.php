<?php //CSS設定用
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>


<?php
if (get_site_key_color()){//キーカラー
  $thx_key = get_site_key_color();
} else {
  $thx_key = '#808080';
}
$thx_key_hsl = colorcode_to_hsl($thx_key);

$thx_key_095 = hsl_to_hsla_css_code($thx_key_hsl,'95%',1.0);
$thx_key_080 = hsl_to_hsla_css_code($thx_key_hsl,'80%',1.0);
$thx_key_060 = hsl_to_hsla_css_code($thx_key_hsl,'60%',1.0);



if (get_site_key_sub_color()){//サブカラー
  $thx_sub = get_site_key_sub_color();
  $thx_sub_hsl = colorcode_to_hsl($thx_sub);
} else {
  $thx_sub_hsl = generate_sub_color($thx_key_hsl);
}
$thx_sub = hsl_to_hsla_css_code($thx_sub_hsl);
$thx_sub__050 = hsl_to_hsla_css_code($thx_sub_hsl, 1.0, 0.5);
$thx_sub__000 = hsl_to_hsla_css_code($thx_sub_hsl, 1.0, 0.0);



if (get_site_background_color()){//背景色
  $thx_bg = get_site_background_color();
} else {
  $thx_bg = $thx_key_095;
}

?>


<?php //打ち消し ?>
.a-wrap:hover {
  background-color:initial;
}
.blogcard-wrap:hover {
  background-color:#fff;
}



<?php //base ?>
body {
  background-color: <?php echo $thx_bg; ?>;
}
.page-numbers,
.tagcloud a,
.author-box,
.ranking-item,
.pagination-next-link,
.comment-reply-link,
.article .toc{
  border: 1px solid <?php echo $thx_sub; ?>;
}
.pagination .current,
.page-numbers.current,
.page-numbers.dots{
  color: #fff;
  border-color: <?php echo $thx_sub; ?>;
  background: <?php echo $thx_sub; ?>;
}
.comment-list{
  ul.children{
    padding: 0.6em;
    background-color: <?php echo $thx_key_095; ?>;
    border-left: 2px solid <?php echo $thx_sub; ?>;
  }
}



<?php //thx ?>
.entry-title,
.archive-title {
  color: #fff;
  background-color: <?php echo $thx_key; ?>;
}
.article h3 {
  background: linear-gradient(90deg, <?php echo $thx_key_080; ?>, #fff);
}
.article h4,
.article h5,
.article h6 {
  border-color: <?php echo $thx_key_060; ?>;
}

.article h2::after,
.article h3::after,
.article h4::after,
.article h5::after,
.article h6::after {
  color: <?php echo $thx_sub__050; ?>;
}

.article h2:hover::after,
.article h3:hover::after,
.article h4:hover::after,
.article h5:hover::after,
.article h6:hover::after {
	color: <?php echo $thx_sub__000; ?>;
}

.go-to-top-button{
  color: #fff;
  background-color: <?php echo $thx_sub; ?>;
}
