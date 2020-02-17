<?php ob_start("sanitize_output");?>
<!doctype html>
<html class="no-js" lang="<?php echo LANG_SITE; ?>">
<?php echo $siteDescription;?>
<head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo isset($d->title) ? $d->title .' | '. get_site_name() : 'Bienvenido | '. get_site_name()?></title>
    <meta name="description" content="<?php echo isset($d->description) ? $d->description  :  SITE_DESCRIPTION ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="keywords" content="<?php echo isset($d->keywords) ? $d->keywords  :  SITE_KEYWORDS ?>">
    <meta name="theme-color" content="<?php echo isset($d->theme_color) ? $d->theme_color  :  THEME_COLOR ?>">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo isset($d->title) ? $d->title .' | '. get_site_name() : 'Bienvenido | '. get_site_name()?>">
    <meta name="twitter:description" content="<?php echo isset($d->description) ? $d->description  :  SITE_DESCRIPTION ?>">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="<?php echo IMG;?>social-image.jpg">
    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo isset($d->title) ? $d->title .' | '. get_site_name() : 'Bienvenido | '. get_site_name()?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php echo URL; ?>" />
    <meta property="og:image" content="<?php echo IMG;?>social-image.jpg" />
    <meta property="og:description" content="<?php echo isset($d->description) ? $d->description  :  SITE_DESCRIPTION ?>" />
    <meta property="og:site_name" content="<?php echo SITE_NAME; ?>, i.e. Moz" /meta property="fb:admins" content="Facebook numeric ID" />

    <link rel="author" href="<?php echo URL; ?>humans.txt<?=get_version(); ?>">
    <link rel="manifest" href="<?php echo URL; ?>site.webmanifest">
    <link rel="apple-touch-icon" href="<?php echo IMG; ?>icon.png">
    <link rel="icon" type="image/png" href="<?php echo IMG ; ?>icon.png">
    <link rel="stylesheet" href="<?php echo CSS; ?>styles.css<?=get_version();?>">
    

</head>

<body>

<!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<?php if(!$d->e404) :?>
<div class='ginger-loader' id="ginger-loader">
    <div class='lds-ripple'>
        <div></div>
        <div></div>
    </div>
</div>
<?php endif; ?>
<div id="app" v-cloak>
    
    