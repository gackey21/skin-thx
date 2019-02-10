//ここにスキンで利用するJavaScriptを記入する

/* thx-set-gridのトグル */
jQuery(function() {
  jQuery("main").click(function() {
    jQuery(this).children(".article").toggleClass("thx-set-grid");
  });
});



/* ルビ */
jQuery(window).on('load', function (){
  var fz = parseInt(jQuery('body').css('font-size'));
  jQuery('ruby').each(function() {
    var ow = jQuery(this).outerWidth();
    var ruby_html;
    var yomigana;
    var yomigana_span = '<div class="thx_yomi">';

    ruby_html = jQuery(this).html();
    yomigana = jQuery(this).children("rt").text();
    yomigana_length = yomigana.length * fz / 2;
//    yomigana_space = yomigana_length + fz;

    if (yomigana.length == 1) {
      yomigana_span = '<div class="thx_yomi thx_yomi_mono">';
    }

    if (yomigana_length + fz / 2 > ow) {
      yomigana_span = '<div class="thx_yomi thx_yomi_long">';
    }

    if(yomigana_length > ow){
      jQuery(this).css('width', yomigana_length);
    }
    for(var i=0; i< yomigana.length; i++) {
      yomigana_span += '<span>'+yomigana.substr(i, 1)+'</span>';
    }
    yomigana_span += '</div>';
    jQuery(this).html(ruby_html+yomigana_span);
  });
});



/* 行取り */
jQuery(function(){
  var wh = jQuery(window).height();
  var fz = parseInt(jQuery('body').css('font-size'));
  var lh = parseInt(jQuery('body').css('line-height'));
  var ls = lh - fz;
  var lineUpOnce = jQuery(`
    .sns-buttons,
    .entry-categories-tags,
    .blogcard-content,
    .wp-block-spacer,
    blockquote,
    pre
  `);
  var lineUp = jQuery(`
    .ad-area,
    .wp-block-image,
    .wp-block-gallery,
    .blogcard-thumbnail,
    table
  `);

  jQuery(window).on('load', function (){
    lineUpOnce.each(function () {
      var oh = jQuery(this).outerHeight();
      oh = oh - fz;
      oh = Math.ceil(oh / lh) * lh;
      oh = oh + fz;

      jQuery(this).outerHeight(oh);
    });
  });

  jQuery(window).on('scroll', function (){
    lineUp.each(function () {
      var scrollPos = jQuery(window).scrollTop();
      var elemOffset = jQuery(this).offset().top;
      var oh = jQuery(this).outerHeight();
      oh = oh - fz;
      if((oh % lh) != 0){
        oh = Math.ceil(oh / lh) * lh;
        oh = oh + fz;

        if(scrollPos > elemOffset - wh + (wh * 0 / 1) ){
          jQuery(this).outerHeight(oh);
        }
      }
    });
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
