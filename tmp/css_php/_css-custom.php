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
<?php require 'color.php'; ?>



<?php //打ち消し ?>
.entry-content > *,
.demo .entry-content p {
  line-height: <?php echo $thx_lh_px; ?>px;
}
.entry-content > *,
.demo .entry-content p {
  margin-top: <?php echo $thx_ls; ?>px;
  margin-bottom: <?php echo $thx_ls; ?>px;
}
.a-wrap:hover {
  background-color:initial;
}
.blogcard-wrap:hover {
  background-color:#fff;
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
