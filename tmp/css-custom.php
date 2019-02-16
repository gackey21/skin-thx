<?php //CSS設定用
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>

<?php require_once get_template_directory().'/tmp/css-custom.php'; ?>

<?php
if (get_site_key_color()){//キーカラー
  $thx_key = get_site_key_color();
} else {
  $thx_key = '#808080';
}
$thx_key_hsla = colorcode_to_hsla($thx_key);

$thx_key_095 = hsla_to_css_code($thx_key_hsla,'95%');
$thx_key_080 = hsla_to_css_code($thx_key_hsla,'80%');
$thx_key_060 = hsla_to_css_code($thx_key_hsla,'60%');



if (get_site_key_sub_color()){//サブカラー
  $thx_sub = get_site_key_sub_color();
  $thx_sub_hsla = colorcode_to_hsla($thx_sub);
} else {
  $thx_sub_hsla = generate_sub_color($thx_key_hsla);
//  $thx_sub_hsla = generate_counter_color($thx_key_hsla);
}
$thx_sub = hsla_to_css_code($thx_sub_hsla);
$thx_sub__050 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.5);
$thx_sub__000 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.0);

$thx_counter_hsla = generate_counter_color($thx_key_hsla);
$thx_counter = hsla_to_css_code($thx_counter_hsla);



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



<?php //フォントサイズ
if (get_site_font_size()){
  $thx_fz = get_site_font_size();
} ?>

<?php //行の高さ
if (get_entry_content_line_hight()){
  $thx_lh = get_entry_content_line_hight();
  $thx_ls = round(($thx_lh - 1) * $thx_fz / 2) * 2;
  $thx_lh_px = $thx_fz + $thx_ls;
} ?>

.entry-content > *,
.demo .entry-content p {
  line-height: <?php echo $thx_lh_px; ?>px;
}
.entry-content > *,
.demo .entry-content p {
  margin-top: <?php echo $thx_ls; ?>px;
  margin-bottom: <?php echo $thx_ls; ?>px;
}

<?php //管理画面用
if(is_admin() && is_gutenberg_editor_enable()) ?>
.main p,
.main p.wp-block-paragraph {
  line-height: <?php echo $thx_lh_px; ?>px;
}
.entry-content > *,
.demo .entry-content p {
  margin-top: <?php echo $thx_ls; ?>px;
  margin-bottom: <?php echo $thx_ls; ?>px;
}



<?php //base ?>
body {
  background-color: <?php echo $thx_bg; ?>;
}
.pagination .current,
.page-numbers.current,
.page-numbers.dots{
  color: #fff;
  border-color: <?php echo $thx_sub; ?>;
  background: <?php echo $thx_sub; ?>;
}
.page-numbers,
.pagination-next-link{
  background: <?php echo $thx_key_095; ?>;
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
.comment-list{
  ul.children{
    padding: 0.6em;
    background-color: <?php echo $thx_key_095; ?>;
    border-left: 2px solid <?php echo $thx_sub; ?>;
  }
}
.widget-entry-cards.ranking-visible .card-thumb::before {
  background-color: <?php echo $thx_key; ?>;
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
