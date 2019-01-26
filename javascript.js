//ここにスキンで利用するJavaScriptを記入する

/* #main内にある半角英数字記号文字(列)にspan */
//alert('html');
jQuery(function(){
  jQuery("p").each(function() {
    var txt = jQuery(this).text();
    jQuery(this).html(
      txt.replace(
        /[\s!-;=-~]+/g,
        '<span class = "thx_q_space">$&</span>'
      )
    );
  });
});

/* スライドコンテンツ
jQuery(function(){
  jQuery('[data-slide-contents]').click(function(event) {
    event.preventDefault();
    var slideContents = jQuery(this).data('slide-contents');
    jQuery('#' + slideContents).slideToggle(400);
  });
});*/
