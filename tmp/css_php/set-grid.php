<?php $grid_color = $thx_sub_080; ?>

.thx-set-grid {
  line-height: <?=$thx_glh_px?>;
  background-image:
  linear-gradient(
    to bottom,
    <?=$grid_color?> 2%,
    transparent 0%,
    transparent <?=1 / $thx_lh * 100 - 2?>%,
    <?=$grid_color?> 0%,
    <?=$grid_color?> <?=1 / $thx_lh * 100?>%,
    <?=$white?> 0  ),
  linear-gradient(
  to right,
    <?=$grid_color?> 3%,
    transparent 0%,
    transparent 95%,
    <?=$grid_color?> 0%  );
  background-position:
  top <?=$thx_gls / 2 - 2?>px
    left
  ;
  background-size:
    <?=$thx_fz_px?>
    <?=$thx_glh_px?>
  ;
}
