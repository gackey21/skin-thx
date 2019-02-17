<?php
///////////////////////////////////////
// 背景色
///////////////////////////////////////

if (!get_site_background_color()):
echo "
body {
  background-color: ".$thx_bg.";
}
.page-numbers,
.pagination-next-link{
  background: ".$thx_bg.";
}
.comment-list ul.children {
    background-color: ".$thx_bg.";
}

";
endif;
?>
<?php
///////////////////////////////////////
// ボタンカラー
///////////////////////////////////////
?>
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
