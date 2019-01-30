//ここにスキンで利用するJavaScriptを記入する

/* 行取り */
jQuery(window).on('scroll', function (){
  var scrollPos = jQuery(window).scrollTop();
  var wh = jQuery(window).height();
  var fz = parseInt(jQuery('body').css('font-size'));
  var lh = parseInt(jQuery('body').css('line-height'));
  var ls = lh - fz;

  jQuery('.thx .wp-block-image figure').each(function() {
    var elemOffset = jQuery(this).offset().top;
    var oh = jQuery(this).outerHeight();

    oh = oh - fz - ls / 2;
    if((oh % lh) != 0){
      oh = Math.ceil(oh / lh) * lh;
      oh = oh + fz + ls /2;

      if(scrollPos > elemOffset - wh + (wh / 1) ){
        jQuery(this).outerHeight(oh);
      }
    }
  });

  jQuery('pre,.ad-wrap').each(function() {
    var elemOffset = jQuery(this).offset().top;
    var oh = jQuery(this).outerHeight();

    oh = oh - fz;
    if((oh % lh) != 0){
      oh = Math.ceil(oh / lh) * lh;
      oh = oh + fz;

      if(scrollPos > elemOffset - wh + (wh / 2) ){
        jQuery(this).outerHeight(oh);
      }
    }
  });

});

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
