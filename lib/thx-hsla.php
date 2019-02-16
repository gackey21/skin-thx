<?php

//カラーコードをHSLAに変換
if ( !function_exists( 'colorcode_to_hsla' ) ):
function colorcode_to_hsla($colorcode){
  $rgb = colorcode_to_rgb($colorcode);
  $r = $rgb['red'] / 255;
  $g = $rgb['green'] / 255;
  $b = $rgb['blue'] / 255;
  $max = max( $r, $g, $b );
  $min = min( $r, $g, $b );
  $h;
  $s;
  $l = ( $max + $min ) / 2;
  $d = $max - $min;

  if( $d == 0 ){
    $h = $s = 0;
  } else {
    $s = $d / ( 1 - abs( 2 * $l - 1 ) );
    switch( $max ){
      case $r:
      $h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
      if ($b > $g) {
        $h += 360;
      }
      break;
      case $g:
      $h = 60 * ( ( $b - $r ) / $d + 2 );
      break;
      case $b:
      $h = 60 * ( ( $r - $g ) / $d + 4 );
      break;
    }
  }
  $hsla['h'] = round( $h, 0 );
  $hsla['s'] = round( $s, 2 );
  $hsla['l'] = round( $l, 2 );
  $hsla['a'] = 1.0;
  return $hsla;
}
endif;

//HSLAを変調
if ( !function_exists( 'hsla_modulation' ) ):
function hsla_modulation(
  $hsla,
  $hue = 0,
  $saturation = 1.0,
  $lightness = 1.0,
  $opacity = 1.0)
{
  $hsla['h'] += $hue;

  $s = (mb_substr($saturation, -1) == '%')
    ? mb_substr($saturation, 0, -1) / 100
    : $hsla['s'] * $saturation;
  //$s == 0の時、何故か'%'が付加されない
  if ($s == 0) $s = 0.0001;
  $hsla['s'] = $s;

  $l = (mb_substr($lightness, -1) == '%')
    ? mb_substr($lightness, 0, -1) / 100
    : $hsla['l'] * $lightness;
  $hsla['l'] = $l;

  $a = (mb_substr($opacity, -1) == '%')
    ? mb_substr($opacity, 0, -1) / 100
    : $hsla['a'] * $opacity;
  $hsla['a'] = $a;
  return $hsla;
}
endif;

//HSLAをCSSコードに変換
if ( !function_exists( 'hsla_to_css_code' ) ):
function hsla_to_css_code($hsl, $lightness = 1.0, $opacity = 1.0){
  $hsla = hsla_modulation($hsl, 0, 1.0, $lightness, $opacity);
  $h = $hsla['h'];
  $s = $hsla['s'] * 100;
  $l = $hsla['l'] * 100;
  $a = $hsla['a'];
  return 'hsla('.$h.', '.$s.'%, '.$l.'%, '.$a.')';
}
endif;

//キーカラーからサブカラーを作成
if ( !function_exists( 'generate_sub_color' ) ):
function generate_sub_color($hsl){
  if ($hsl['l'] > 0.45) {
    $hsl['l'] -= 0.25;
  } else {
    $hsl['s'] += 0.25;
    $hsl['l'] += 0.25;
  };
  return $hsl;
}
endif;

//キーカラーから真逆の色を作成
if ( !function_exists( 'generate_counter_color' ) ):
function generate_counter_color($hsla){
  $ds = abs($hsla['s'] - 1.0) * 100;
  $dl = abs($hsla['l'] - 1.0) * 100;
  $ds .= '%';
  $dl .= '%';
  $hsla = hsla_modulation($hsla, 180, $ds, $dl);
  return $hsla;
}
endif;

 ?>
