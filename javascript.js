//ここにスキンで利用するJavaScriptを記入する

/* .article内の<p>、<li>にある半角英数字記号文字(列)にspan */
jQuery(function(){
  jQuery('.article p,.article li[class != "blocks-gallery-item"]').each(function() {
    jQuery(this).html(
      jQuery(this).html().replace(
        /(<\/?[^>]+>)|([\s!-;=-~]+)/g,
        function(){
          if( arguments[1] ) return arguments[1] ;
          if( arguments[2] ) return '<span class = "thx_wao">' + arguments[2] + '</span>' ;
        }
      )
    );
  });
});

/* スライドコンテンツ*/
jQuery(function(){
  jQuery('[data-slide-contents]').click(function(event) {
    event.preventDefault();
    var slideContents = jQuery(this).data('slide-contents');
    jQuery('#' + slideContents).slideToggle(400);
  });
});
