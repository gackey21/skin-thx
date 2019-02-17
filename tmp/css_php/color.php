<?php
///////////////////////////////////////
// キーカラー
///////////////////////////////////////
?>
.entry-title,
.archive-title {
  <?php
  if ($thx_key_text) {
    echo "color: ".$thx_key_text.";";
  }else {
    echo "color: #fff;";
  };
  ?>;
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
.widget-entry-cards.ranking-visible .card-thumb::before {
  background-color: <?php echo $thx_key; ?>;
}
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
<?php
///////////////////////////////////////
// サブカラー
///////////////////////////////////////
?>
.pagination .current,
.page-numbers.current,
.page-numbers.dots{
  color: #fff;
  border-color: <?php echo $thx_sub; ?>;
  background: <?php echo $thx_sub; ?>;
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
    border-left: 2px solid <?php echo $thx_sub; ?>;
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
