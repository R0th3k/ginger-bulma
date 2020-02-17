<?php

function sanitize_output($buffer) {

  $search = array(
      '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
      '/[^\S ]+\</s',     // strip whitespaces before tags, except space
      '/(\s)+/s',         // shorten multiple whitespace sequences
      '/<!--(.|\s)*?-->/' // Remove HTML comments
  );

  $replace = array(
      '>',
      '<',
      '\\1',
      ''
  );

  $buffer = preg_replace($search, $replace, $buffer);

  return $buffer;
}

function to_object($array){
  return json_decode(json_encode($array));
}

function get_site_name(){
  return SITE_NAME;
}

function get_version(){
  return '?v='.ASSETS_VERSION;
}

function now(){
  return date('Y-m-d H:i:s');
}

//Funcion para imprimir imagenes
function img( $image, $type='png', $class = null, $alt = null, $external=false){

  $img_external = '
    <img src="'.$image.$type.get_version().'" alt="'.$alt.'" class="'.$class.'">
  ';

  $img_inner = '
  <picture>
      <source srcset="'.IMG.$image.'.webp'.get_version().'" type="image/webp" class="'.$class.'">
      <img src="'.IMG.$image.'.'.$type.get_version().'" alt="'.$alt.'" class="'.$class.'">
  </picture>
  ';

  ($external) ? $the_img = $img_external: $the_img = $img_inner;
  
return  $the_img;
}

//Funcion para imprimir imagenes con carga diferida
function lazy($image, $type='png', $class = null, $alt = null, $external=false){
  
  $img_external = '
    <img data-src="'.$image.$type.get_version().'" alt="'.$alt.'" class="lazy '.$class.'">
  ';
    
  $img_inner = '
  <picture>
      <source data-srcset="'.IMG.$image.'.webp'.get_version().'" type="image/webp" class="lazy '.$class.'">
      <img data-src="'.IMG.$image.'.'.$type.get_version().'" alt="'.$alt.'" class="lazy '.$class.'">
  </picture>
  ';

  ($external) ? $the_img = $img_external: $the_img = $img_inner;

  return  $the_img;
}

//Imprime un array formateado
function print_array($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}


function the_ip() {
  if (isset($_SERVER)) { 
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) { 
     $ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; 
    } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) { 
     $ip = $_SERVER["HTTP_CLIENT_IP"]; 
    } else { 
     $ip = $_SERVER["REMOTE_ADDR"]; 
    }
   } else { 
    if (getenv('HTTP_X_FORWARDED_FOR')) { 
     $ip = getenv('HTTP_X_FORWARDED_FOR'); 
    } elseif (getenv('HTTP_CLIENT_IP')) { 
     $ip = getenv('HTTP_CLIENT_IP'); 
    } else { 
     $ip = getenv('REMOTE_ADDR'); 
    }
   }
  
   if($ip=='::1') $ip='127.0.0.1';
   return $ip;
  }

  function to_code($code){
    highlight_string($code);
  }

  function the_url(){
    return URL;
  }

  function the_browser(){
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    return "<b>Tu navegador es</b>: " . $useragent;
  }

  function gfonts($fonts){
    $link='
    <link rel="stylesheet" href="'.$fonts.'" media="none" onload="if(media!="all")media="all"">
    <noscript><link rel="stylesheet" href="'.$fonts.'"></noscript>';
    return $link;
  }

  function ginger_loader($n=null,$color='black',$bg='white'){

  $css_comun = "
  :root{
    --loader-color: ".$color.";
    --bg-loader-color: ".$bg.";
  }
  .ginger-loader{
    background: var(--bg-loader-color);
    width:100%;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    position:fixed;
    top:0;
    left:0;
    z-index:9999;
    -webkit-backdrop-filter: saturate(180%) blur(10px);
    backdrop-filter: saturate(180%) blur(10px);
  }
  ";

  $script_comun ="
    <script>
      window.onload = function(){
        jQuery('.ginger-loader').fadeOut();
      }
    </script>
  ";
    
  $loader_1 = "
    <style>
    ".$css_comun."
      .lds-ripple {
        display: inline-block;
        position: relative;
        width: 64px;
        height: 64px;
      }
      .lds-ripple div {
        position: absolute;
        border: 4px solid var(--loader-color);
        opacity: 1;
        border-radius: 50%;
        animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
      }
      .lds-ripple div:nth-child(2) {
        animation-delay: -0.5s;
      }
      @keyframes lds-ripple {
        0% {
          top: 28px;
          left: 28px;
          width: 0;
          height: 0;
          opacity: 1;
        }
        100% {
          top: -1px;
          left: -1px;
          width: 58px;
          height: 58px;
          opacity: 0;
        }
      }
      </style>
      <div class='ginger-loader'><div class='lds-ripple'><div></div><div></div></div></div>
      ".$script_comun."
    ";

    $loader_2 = "
    <style>
    ".$css_comun."
    .lds-roller {
      display: inline-block;
      position: relative;
      width: 64px;
      height: 64px;
    }
    .lds-roller div {
      animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
      transform-origin: 32px 32px;
    }
    .lds-roller div:after {
      content: '';
      display: block;
      position: absolute;
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: ".$color.";
      margin: -3px 0 0 -3px;
    }
    .lds-roller div:nth-child(1) {
      animation-delay: -0.036s;
    }
    .lds-roller div:nth-child(1):after {
      top: 50px;
      left: 50px;
    }
    .lds-roller div:nth-child(2) {
      animation-delay: -0.072s;
    }
    .lds-roller div:nth-child(2):after {
      top: 54px;
      left: 45px;
    }
    .lds-roller div:nth-child(3) {
      animation-delay: -0.108s;
    }
    .lds-roller div:nth-child(3):after {
      top: 57px;
      left: 39px;
    }
    .lds-roller div:nth-child(4) {
      animation-delay: -0.144s;
    }
    .lds-roller div:nth-child(4):after {
      top: 58px;
      left: 32px;
    }
    .lds-roller div:nth-child(5) {
      animation-delay: -0.18s;
    }
    .lds-roller div:nth-child(5):after {
      top: 57px;
      left: 25px;
    }
    .lds-roller div:nth-child(6) {
      animation-delay: -0.216s;
    }
    .lds-roller div:nth-child(6):after {
      top: 54px;
      left: 19px;
    }
    .lds-roller div:nth-child(7) {
      animation-delay: -0.252s;
    }
    .lds-roller div:nth-child(7):after {
      top: 50px;
      left: 14px;
    }
    .lds-roller div:nth-child(8) {
      animation-delay: -0.288s;
    }
    .lds-roller div:nth-child(8):after {
      top: 45px;
      left: 10px;
    }
    @keyframes lds-roller {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    </style>
    <div class='ginger-loader'><div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
    ".$script_comun."
    ";

    $loader_3 = "
      <style>
      ".$css_comun."
      .lds-spinner {
        color: official;
        display: inline-block;
        position: relative;
        width: 64px;
        height: 64px;
      }
      .lds-spinner div {
        transform-origin: 32px 32px;
        animation: lds-spinner 1.2s linear infinite;
      }
      .lds-spinner div:after {
        content: '';
        display: block;
        position: absolute;
        top: 3px;
        left: 29px;
        width: 5px;
        height: 14px;
        border-radius: 20%;
        background: ".$color.";
      }
      .lds-spinner div:nth-child(1) {
        transform: rotate(0deg);
        animation-delay: -1.1s;
      }
      .lds-spinner div:nth-child(2) {
        transform: rotate(30deg);
        animation-delay: -1s;
      }
      .lds-spinner div:nth-child(3) {
        transform: rotate(60deg);
        animation-delay: -0.9s;
      }
      .lds-spinner div:nth-child(4) {
        transform: rotate(90deg);
        animation-delay: -0.8s;
      }
      .lds-spinner div:nth-child(5) {
        transform: rotate(120deg);
        animation-delay: -0.7s;
      }
      .lds-spinner div:nth-child(6) {
        transform: rotate(150deg);
        animation-delay: -0.6s;
      }
      .lds-spinner div:nth-child(7) {
        transform: rotate(180deg);
        animation-delay: -0.5s;
      }
      .lds-spinner div:nth-child(8) {
        transform: rotate(210deg);
        animation-delay: -0.4s;
      }
      .lds-spinner div:nth-child(9) {
        transform: rotate(240deg);
        animation-delay: -0.3s;
      }
      .lds-spinner div:nth-child(10) {
        transform: rotate(270deg);
        animation-delay: -0.2s;
      }
      .lds-spinner div:nth-child(11) {
        transform: rotate(300deg);
        animation-delay: -0.1s;
      }
      .lds-spinner div:nth-child(12) {
        transform: rotate(330deg);
        animation-delay: 0s;
      }
      @keyframes lds-spinner {
        0% {
          opacity: 1;
        }
        100% {
          opacity: 0;
        }
      }   
      
      </style>
      <div class='ginger-loader'><div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
      ".$script_comun."
    ";

    $loader_4 = "
    <style>
    ".$css_comun."
    .lds-circle {
      display: inline-block;
      transform: translateZ(1px);
    }
    .lds-circle > div {
      display: inline-block;
      width: 51px;
      height: 51px;
      margin: 6px;
      border-radius: 50%;
      background: ".$color.";
      animation: lds-circle 2.4s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }
    @keyframes lds-circle {
      0%, 100% {
        animation-timing-function: cubic-bezier(0.5, 0, 1, 0.5);
      }
      0% {
        transform: rotateY(0deg);
      }
      50% {
        transform: rotateY(1800deg);
        animation-timing-function: cubic-bezier(0, 0.5, 0.5, 1);
      }
      100% {
        transform: rotateY(3600deg);
      }
    }
    
    </style>
    <div class='ginger-loader'><div class='lds-circle'><div></div></div></div>
    ".$script_comun."
    ";

    $loader_5 = "
    <style>
    ".$css_comun."
    .lds-hourglass {
      display: inline-block;
      position: relative;
      width: 64px;
      height: 64px;
    }
    .lds-hourglass:after {
      content: '';
      display: block;
      border-radius: 50%;
      width: 0;
      height: 0;
      margin: 6px;
      box-sizing: border-box;
      border: 26px solid ".$color.";
      border-color: ".$color." transparent ".$color." transparent;
      animation: lds-hourglass 1.2s infinite;
    }
    @keyframes lds-hourglass {
      0% {
        transform: rotate(0);
        animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
      }
      50% {
        transform: rotate(900deg);
        animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
      }
      100% {
        transform: rotate(1800deg);
      }
    }
    
    </style>
    <div class='ginger-loader'><div class='lds-hourglass'></div></div>
    ".$script_comun."
    ";

    $loader_6 = "
    <style>
    ".$css_comun."
    </style>
    <div class='ginger-loader'></div>
    ".$script_comun."
    ";

    switch ($n) {
      case 1:
          return $loader_1;
          break;
      case 2:
          return $loader_2;
          break;
      case 3:
          return $loader_3;
          break;
      case 4:
          return $loader_4;
          break;
      case 5:
          return $loader_5;
          break;
    }
  }
