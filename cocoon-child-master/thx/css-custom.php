<?php //CSS設定用
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>


<?php
if (get_site_key_color()){
  $key_color = get_site_key_color();
} else {
  $key_color = '#555';
}
if (get_site_key_sub_color()){
  $key_sub_color = get_site_key_sub_color();
} else {//要改良
  $key_sub_color = colorcode_to_hsl_css_code($key_color,1.4);
}?>



<?php //base ?>
body {
  background-color: <?php echo colorcode_to_hsl_css_code($key_color,'95%'); ?>;
}
.page-numbers,
.tagcloud a,
// #list .a-wrap,
// #related-entries .a-wrap,
// .post-navi-square.post-navi-border a,
.author-box,
.ranking-item,
.pagination-next-link,
.comment-reply-link,
.toc{
  border: 1px solid <?php echo $key_sub_color; ?>;
}
.pagination .current,
.page-numbers.current,
.page-numbers.dots{
  background: <?php echo $key_sub_color; ?>;
}
.comment-list{
  ul.children{
    padding: 0.6em;
    background-color: <?php echo colorcode_to_rgb_css_code(get_site_key_color(), 0.95); ?>;
    border-left: 2px solid <?php echo $key_sub_color; ?>;
  }
}



<?php //thx ?>
.entry-title,
.archive-title {
  color: #fff;
  background-color: <?php echo $key_color; ?>;
}
.article h3 {
  background: linear-gradient(90deg, <?php echo colorcode_to_hsl_css_code($key_color,1.4); ?>, #fff);
}
.article h4,
.article h5,
.article h6 {
  border-color: <?php echo colorcode_to_hsl_css_code($key_color,1.4); ?>;
}

.article h2::after,
.article h3::after,
.article h4::after,
.article h5::after,
.article h6::after {
  color: <?php echo colorcode_to_rgb_css_code($key_sub_color, 0.5); ?>;
}

.article h2:hover::after,
.article h3:hover::after,
.article h4:hover::after,
.article h5:hover::after,
.article h6:hover::after {
	color: <?php echo colorcode_to_rgb_css_code($key_sub_color, 0.0); ?>;
}

.go-to-top-button{
  background-color: <?php echo $key_sub_color; ?>;
}
