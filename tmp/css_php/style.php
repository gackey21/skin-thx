<?php
include_once(__DIR__. '/../../../../../../../wp-load.php');
header('Content-Type: text/css; charset=utf-8');
//include_once('_var.php');
?>
<?php require '_var.php'; ?>
<?php $grid_color = $thx_sub_080; ?>

.thx-set-grid {
  line-height: <?php echo $thx_lh_px; ?>px;
  background-image:
  linear-gradient(
    to bottom,
    <?php echo $grid_color; ?> 2%,
    transparent 0%,
    transparent <?php echo 1 / $thx_lh * 100 - 2; ?>%,
    <?php echo $grid_color; ?> 0%,
    <?php echo $grid_color; ?> <?php echo 1 / $thx_lh * 100; ?>%,
    <?php echo $white; ?> 0  ),
  linear-gradient(
  to right,
    <?php echo $grid_color; ?> 3%,
    transparent 0%,
    transparent 95%,
    <?php echo $grid_color; ?> 0%  );
  background-position:
  top <?php echo $thx_ls / 2 - 2; ?>px
    left
  ;
  background-size:
    <?php echo $thx_fz; ?>
    <?php echo $thx_lh_px; ?>px
  ;
}
