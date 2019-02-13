<?php //CSS設定用
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>


<?php //サイトキーカラー
if (get_site_key_color()): ?>

<?php //thx ?>
.entry-title,
.archive-title {
  color: #fff;
  background-color: <?php echo get_site_key_color(); ?>;
}

<?php endif ?>



<?php //サイトキーサブカラー
if (get_site_key_sub_color()): ?>

<?php //base ?>
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
  border: 1px solid <?php echo get_site_key_sub_color(); ?>;
}
.pagination .current,
.page-numbers.current,
.page-numbers.dots{
  background: <?php echo get_site_key_sub_color(); ?>;
}
.comment-list{
  ul.children{
    padding: 0.6em;
    background-color: <?php echo colorcode_to_rgb_css_code(get_site_key_color(), 0.95); ?>;
    border-left: 2px solid <?php echo get_site_key_sub_color(); ?>;
  }
}

<?php //thx ?>
.go-to-top-button{
  background-color: <?php echo get_site_key_sub_color(); ?>;
}
.article h2::after,
.article h3::after,
.article h4::after,
.article h5::after,
.article h6::after {
	position: absolute;
	right: 4px;
	bottom: 0px;
	font-family: "Hiragino Sans", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
	font-weight: 800;
	line-height: 1em;
  color: <?php echo colorcode_to_rgb_css_code(get_site_key_sub_color(), 0.5); ?>;
	transition-duration: 0.3s;
}

.article h2:hover::after,
.article h3:hover::after,
.article h4:hover::after,
.article h5:hover::after,
.article h6:hover::after {
	color: <?php echo colorcode_to_rgb_css_code(get_site_key_sub_color(), 0.0); ?>;
	transition-duration: 0.3s;
}


<?php endif ?>
