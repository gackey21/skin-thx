//ここにスキンで利用するJavaScriptを記入する

/* ルビ */
jQuery(window).on('load', function (){
  var fz = parseInt(jQuery('body').css('font-size'));
  jQuery('ruby').each(function() {
    var ow = jQuery(this).outerWidth();
//    var html;
    var yomigana;

//    html = jQuery(this).html();
    yomigana = jQuery(this).children("rt").text();
    yomigana_length = yomigana.length * fz / 2;

    if(yomigana_length > ow){
      jQuery(this).css('width', yomigana_length);
    }
    jQuery(this).attr('data-yomi', yomigana);
  });
});



/* 行取り */
jQuery(window).on('scroll', function (){
  var scrollPos = jQuery(window).scrollTop();
  var wh = jQuery(window).height();
  var fz = parseInt(jQuery('body').css('font-size'));
  var lh = parseInt(jQuery('body').css('line-height'));
  var ls = lh - fz;
  var lineUp = jQuery(`
    pre,
    table,
    .ad-area,
    .thx .wp-block-image,
    .wp-block-gallery,
    .blogcard-thumbnail,
    .blogcard-content
    `);

  /*jQuery('.thx .wp-block-image figure').each(function() {
    var elemOffset = jQuery(this).offset().top;
    var oh = jQuery(this).outerHeight();

    oh = oh - fz - ls / 2;
    if((oh % lh) != 0){
      oh = Math.ceil(oh / lh) * lh;
      oh = oh + fz + ls /2;

      if(scrollPos > elemOffset - wh - (wh / 2) ){
        jQuery(this).outerHeight(oh);
      }
    }
  });*/

  lineUp.each(function() {
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
