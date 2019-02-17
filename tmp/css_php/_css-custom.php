<?php //CSS設定用
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>

<?php //require_once get_template_directory().'/tmp/css-custom.php'; ?>

<?php require '_var.php'; ?>



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
.comment-list ul.children {
    padding: 0.6em;
    background-color: <?php echo $thx_key_095; ?>;
    border-left: 2px solid <?php echo $thx_sub; ?>;
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

.go-to-top-button {
  <?php
  if (!get_go_to_top_background_color()) {
    echo "background-color: ".$thx_sub.";";
  };
  if (!get_go_to_top_text_color()) {
    echo "color: #ddd;";
  };
  ?>;
}
.go-to-top-button:hover {
  <?php
  if (!get_go_to_top_text_color()) {
    echo "color: #fff;";
  };
  ?>;
}
