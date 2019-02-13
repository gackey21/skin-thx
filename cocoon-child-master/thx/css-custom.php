<?php //CSS設定用
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>


<?php //サイトキー色
if (get_site_key_sub_color()): ?>

.article h2,
#footer{
  background-color: <?php echo get_site_key_sub_color(); ?>;
}

<?php endif ?>
