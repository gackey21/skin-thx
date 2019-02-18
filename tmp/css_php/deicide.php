<?php
///////////////////////////////////////
// 打ち消し
///////////////////////////////////////
?>
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

<?php
///////////////////////////////////////
// 管理画面用
///////////////////////////////////////
?>
<?php
if(is_admin() && is_gutenberg_editor_enable()): ?>
.main p,
.main p.wp-block-paragraph {
  line-height: <?php echo $thx_lh_px; ?>px;
}
.entry-content > *,
.demo .entry-content p {
  margin-top: <?php echo $thx_ls; ?>px;
  margin-bottom: <?php echo $thx_ls; ?>px;
}
<?php endif ?>
